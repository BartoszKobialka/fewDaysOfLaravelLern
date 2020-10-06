<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Schema\Blueprint;
use Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Admin;
use App\Models\User;
use App\Models\ForVer;
use App\Mail\OrderMail;
use App\Mail\VerifyMail;


class PagesController extends Controller
{
    public function login(){
        return view('layouts.login');
    }
    
    public function userLogin(Request $req){
        $req->validate([
            'name' => 'required|email',
            'password' => 'required'
        ]);
        $user_data = array(
            'email' => $req->get('name'),
            'password' => $req->get('password')
        );

        if(Auth::attempt($user_data)){
            $isAdmin = Admin::where('email', '=', Auth::user()->email)->count();
            session(['isAdmin' => $isAdmin]);
           
            return redirect('main');
        }
        else{
            return back()->with('error', 'Wrong login details');
        }

    }

    public function main(){
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function logout(){
        Auth::logout();
        session(['isAdmin' => false]);
        return redirect('login');
    }

    public function addToCart($id){
        $cart = new Cart();
        $cart->user_email = Auth::user()->email;
        $cart->product_id = $id;
        $cart->save();
    }

    public function removeFromCart($id){
        Cart::where('user_email', '=', Auth::user()->email)->where('product_id', '=', $id)->delete();
    }

    public function cart(){
        $cart = new Cart();
        $products = json_decode($cart->products(Auth::user()->email), true);
        return view('cart', compact('products'));
    }


    public function addProduct(Request $req) {
        $req->validate([
            'name' => 'required',
            'cost' => 'required',
            'description' => 'required'
        ]);
        $data = [
            'name' => $req->get('name'),
            'cost' => $req->get('cost'),
            'description' => $req->get('description')
        ];
        Product::create($data);
        return redirect('/main');
    }

    public function orderMail() {
        
        $cart = new Cart();
        $products = json_decode($cart->products(Auth::user()->email), true);
        Mail::to(Auth::user()->email)->send(new OrderMail($products));
        Cart::where('user_email', '=', Auth::user()->email)->delete();
        return redirect('/main');
    }

    public function register() {


        return view('layouts.register');
    }

    public function userRegister(Request $req) {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
            'password2' => 'required|min:3',
            'name' => 'required|min:3'
        ]);

        if($req->get('password') !== $req->get('password2')){
            return back()->with('error', 'Hasła są różne.');
        }
        $user_count = User::where('email', '=', $req->get('email'))->count();
        $forver = ForVer::where('email', '=', $req->get('email'))->count();
        if($user_count > 0 || $forver > 0){
            return back()->with('error', 'Podany email już znajduje się w bazie.');
        }

        $token = base64_encode ($user_count);
        for($i = 0; ForVer::where('token', '=', $token)->count() > 0; $i++){
            $token = base64_encode ($user_count+$i);
        }

        $user_data = array(
            'email' => $req->get('email'),
            'password' => Hash::make($req->get('password')),
            'name' => $req->get('name'),
            'token' => $token
        );

        ForVer::create($user_data);
        Mail::to($req->get('email'))->send(new VerifyMail($token, $req->get('email')));
        return redirect('/login');
    }

    public function verify($email, $token) {
        if(ForVer::where('email', '=', $email)->where('token', '=', $token)->count() > 0){
            $user = json_decode(ForVer::where('email', '=', $email)->select('forvers.name', 'forvers.email', 'forvers.password')->get(), true);
            User::create($user[0]);
            ForVer::where('email', '=', $email)->delete();
            return redirect('/login');
        }
    }
}

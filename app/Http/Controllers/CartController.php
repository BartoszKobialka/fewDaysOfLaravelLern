<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Auth;
use App\Mail\OrderMail;
use App\Models\Cart;

class CartController extends Controller
{
    public function addToCart($id){
        $cart = new Cart();
        $cart->user_email = Auth::user()->email;
        $cart->product_id = $id;
        $cart->save();
    }

    public function removeFromCart($id){
        $cart = new Cart();
        $cart->removeProductFormCartById(Auth::user()->email, $id);
    }

    public function cart(){
        $cart = new Cart();
        $products = json_decode($cart->products(Auth::user()->email), true);
        return view('cart', compact('products'));
    }

    public function orderMail() {
        $cart = new Cart();
        $products = json_decode($cart->products(Auth::user()->email), true);
        Mail::to(Auth::user()->email)->send(new OrderMail($products));
        $cart->removeProductsFormCart(Auth::user()->email);
        return redirect('/main')->with('message', 'Dziękujemy za zamówienie, sprawdź swój e-mail.');
    }
}

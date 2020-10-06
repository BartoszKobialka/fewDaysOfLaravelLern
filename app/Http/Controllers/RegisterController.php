<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\ForVer;
use App\Mail\VerifyMail;
use App\Models\User;

class RegisterController extends Controller
{
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
        $user = new User();
        $user_count = $user->isUserExist($req->get('email'));
        $forver = new ForVer();
        $forver_count = $forver->isUserExist($req->get('email'));
        if($user_count > 0 || $forver_count > 0){
            return back()->with('error', 'Podany email już znajduje się w bazie.');
        }

        $token = base64_encode ($user_count);
        for($i = 0; $forver->isTokenExist($token) > 0; $i++){
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
        return redirect('/login')->with('message', 'Dziękujemy za rejestrację, zweryfikuj swój e-mail.');
    }

    public function verify($email, $token) {
        $forver = new ForVer();
        if($forver->verifyToken($email, $token)){
            $user = json_decode($forver->getUser($email), true);
            User::create($user[0]);
            $forver->deleteVerifiedUser($email);
            return redirect('/login')->with('message', 'Zweryfikowano pomyślnie, możesz się zalogować');
        }
        return redirect('/register');
    }
}

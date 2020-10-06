<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;

class LoginController extends Controller
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
            $admin = new Admin();
            $isAdmin = $admin->isAdmin($req->get('name'));
            session(['isAdmin' => $isAdmin]);
           
            return redirect('main');
        }
        else{
            return back()->with('error', 'Nie prawidłowy login lub hasło.');
        }
    }

    public function logout(){
        Auth::logout();
        session(['isAdmin' => false]);
        return redirect('login');
    }
}

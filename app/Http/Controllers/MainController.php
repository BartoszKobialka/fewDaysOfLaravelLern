<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Admin;

class MainController extends Controller
{
    public function main(){
        $products = Product::all();
        return view('products', compact('products'));
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
}

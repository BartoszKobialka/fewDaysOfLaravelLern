<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;
    public $table = 'cart';

    public $fillable = ['users_mail', 'product_id'];
    public $timestamps = false;

    
    public function products($u_email)
    {
        $prod = $this->leftJoin('products', 'products.id', '=', 'cart.product_id')->where('user_email', '=', $u_email)->select('products.*')->get();
        return $prod;
    }

    public function removeProductFormCartById($email, $id){
        $this->where('user_email', '=', $email)->where('product_id', '=', $id)->delete();
    }

    public function removeProductsFormCart($email){
        $this->where('user_email', '=', $email)->delete();
    }
}

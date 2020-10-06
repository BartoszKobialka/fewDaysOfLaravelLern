<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $fillable = ['email'];
    public $timestamps = false;
    //Admin::where('email', '=', Auth::user()->email)->count();
    public function isAdmin($email){
        return $this->where('email', '=', $email)->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use DB;

class ForVer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'token'
    ];
    public $timestamps = false;
    protected $table = 'forvers';
    //ForVer::where('email', '=', $email)->select('forvers.name', 'forvers.email', 'forvers.password')->get()
    public function getUser($email){
        $user = $this->where('email', '=', $email)->select('forvers.name', 'forvers.email', 'forvers.password')->get();
        return $user;
    }

    public function deleteVerifiedUser($email){
        $this->where('email', '=', $email)->delete();
    }

    public function verifyToken($email, $token) {
        return $this->where('email', '=', $email)->where('token', '=', $token)->count();
    }

    public function isUserExist($email) {
        return $this->where('email', '=', $email)->count();
    }

    public function isTokenExist($token) {
        return $this->where('token', '=', $token)->count();
    }
}

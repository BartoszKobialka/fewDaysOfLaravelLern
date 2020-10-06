<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'login']);
Route::post('user', [LoginController::class, 'userLogin']);
Route::get('/main', [MainController::class, 'main']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/main/add/{id}', [CartController::class, 'addToCart']);
Route::get('/main/remove/{id}', [CartController::class, 'removeFromCart']);
Route::get('/main/cart', [CartController::class, 'cart']);
Route::post('/addprod', [MainController::class, 'addProduct']);
Route::post('/userregister', [RegisterController::class, 'userRegister']);
Route::post('/mail/order', [CartController::class, 'orderMail']);
Route::get('/register', [RegisterController::class, 'register']);
Route::get('/verify/{email}/{token}', [RegisterController::class, 'verify']);

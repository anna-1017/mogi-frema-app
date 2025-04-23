<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use Laravel\Fortify\Fortify;


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

Route::get('/', [ItemController::class, 'index']);
Route::get('/register', function(){
    return view('register');
});
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLogin'])->name('login');

Route::get('/item/{item}', [ItemController::class, 'getDetail']);

Route::middleware('auth')->group(function(){
    Route::get('/mypage/profile', function(){
    return view('edit_profile');
    });
    Route::post('/purchase/{item}', [ItemController::class, 'purchase']);
    
    Route::post('/comment/{item_id}', [CommentController::class, 'store'])->name('comment.store');

    Route::post('/item/{item_id}/like', [ItemController::class, 'toggleLike'])->name('item.toggle_like');
    // /item/ はパスのベース（＝商品関連）
    // {item_id} は「この商品のIDだよ〜」ってLaravelに教えてる。/like は「このURLで、いいね処理したいよ〜」って意味！
    


    
});
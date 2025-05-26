<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
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

// =====================
// 認証外ルート
// =====================
Route::get('/', [ItemController::class, 'index'])->name('products.index');
Route::get('/register', function(){
    return view('register');
});
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLogin'])->name('login');

Route::get('/item/{item}', [ItemController::class, 'getDetail']);

// =====================
// 認証後ルート
// =====================
Route::middleware('auth')->group(function(){
    Route::get('/mypage', [ProfileController::class, 'show'])->name('profile.show');
    
    
    Route::post('/comment/{item_id}', [CommentController::class, 'store'])->name('comment.store');

    Route::post('/item/{item_id}/like', [ItemController::class, 'toggleLike'])->name('item.toggle_like');
    
    Route::get('/mypage/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'showConfirm'])->name('purchase.showConfirm');

    Route::post('/purchase/confirm/{item_id}', [PurchaseController::class, 'confirm'])->name('purchase.confirm');

    Route::get('/address/change/{item_id}', [AddressController::class, 'showChangeForm'])->name('address.change');

    Route::post('/purchase/address/{item}', [ProfileController::class, 'updateAddress'])->name('address.update');
    
    Route::get('/purchase/complete', [PurchaseController::class, 'complete'])->name('purchase.complete');

    Route::get('/sell', [ItemController::class, 'create'])->name('items.create');

    Route::post('/sell', [ItemController::class, 'store'])->name('items.store');

    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    
});
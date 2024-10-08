<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::post('/cart/clear', [AdminController::class, 'clearCart'])->name('cart.clear');

Route::get('/search',[AdminController::class, 'search'])->name('search');

Route::post('/checkout',[AdminController::class, 'checkout'])->name('checkout');
Route::delete('/cart/destroy/{rowId}', [AdminController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/store/{id}', [AdminController::class, 'addToCart'])->name('cart.store');
Route::get('/cart',[AdminController::class, 'cart'])->name('cart');


Route::get('/addcart/{id}', [AdminController::class, 'addcart'])->name('addcart');
// Route::get('/cart', [AdminController::class, 'cart'])->name('cart');


Route::get('/pricerange/{id}', [AdminController::class, 'pricerange'])->name('pricerange');

Route::get('/viewproduct/{id}', [AdminController::class, 'viewproduct'])->name('viewproduct');

Route::get('/categories/{id}', [AdminController::class, 'categories'])->name('categories');
Route::get('/welcome', [AdminController::class, 'welcome']);

Route::get('/delete/{id}',[AdminController::class,'delete'])->name('delete');
Route::get('/deletecategory/{id}',[AdminController::class,'deletecategory'])->name('deletecategory');

Route::get('/edit/{id}',[AdminController::class,'edit'])->name('edit');
Route::post('/update/{id}',[AdminController::class,'update'])->name('update');

Route::get('/editcategory/{id}',[AdminController::class,'editcategory'])->name('editcategory');
Route::post('/updatecategory/{id}',[AdminController::class,'updatecategory'])->name('updatecategory');

Route::get('/manageAllproducts', [AdminController::class, 'manageproducts']);
Route::get('/Allproducts', [AdminController::class, 'Allproducts']);

Route::get('/createproducts',[AdminController::class,'createproducts']);
Route::post('/insertproducts', [AdminController::class, 'insertproducts']);



Route::get('/createcategory',[AdminController::class,'createcategory']);
Route::post('/insertcategory', [AdminController::class, 'insertcategory']);

Route::get('/CheckOut', function () {
        return view('CheckOut');
    });
    
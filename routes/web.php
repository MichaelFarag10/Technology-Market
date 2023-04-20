<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/view_catagory', [AdminController::class, 'view_catagory']);
Route::post('/add_catagory', [AdminController::class, 'add_catagory']);
Route::get('/update_catagory/{id}', [AdminController::class, 'update_catagory']);
Route::post('/edit_catagory/{id}', [AdminController::class, 'edit_catagory']);
Route::get('/delete_catagory/{id}', [AdminController::class, 'delete_catagory']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/show_product', [AdminController::class, 'show_product']);
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
Route::post('/edit_product/{id}', [AdminController::class, 'edit_product']);
Route::get('/product_details/{id}',[HomeController::class, 'product_details']);
Route::post('/add_cart/{id}',[HomeController::class, 'add_cart']);
Route::get('show_cart',[HomeController::class, 'show_cart']);
Route::get('remove_product/{id}',[HomeController::class, 'remove_product']);
Route::get('cash_order',[HomeController::class, 'cash_order']);
Route::get('/stripe/{totalprice}',[HomeController::class, 'stripe']);
Route::post('stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/order', [AdminController::class, 'order']);
Route::get('/delivred/{id}', [AdminController::class, 'delivred']);
Route::get('/delete_order/{id}', [AdminController::class, 'delete_order']);
Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);
Route::get('/show_pdf/{id}', [AdminController::class, 'show_pdf']);
Route::get('/search', [AdminController::class, 'search']);
Route::get('/account_settings/{id}', [AdminController::class, 'account_settings']);
Route::get('/ show_order', [HomeController::class, 'show_order']);
Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);
Route::post('/add_comment', [HomeController::class, 'add_comment']);
Route::post('/add_reply', [HomeController::class, 'add_reply']);
Route::get('/product_search', [HomeController::class, 'product_search']);
Route::get('/products', [HomeController::class, 'product']);
Route::get('/search_product', [HomeController::class, 'search_product']);
Route::get('/contact', [HomeController::class, 'contact_view']);
Route::post('/add_contact', [HomeController::class, 'add_contact']);
Route::get('/show_comment', [AdminController::class, 'show_comment']);
Route::get('/delete_comment/{id}', [AdminController::class, 'delete_comment']);
Route::get('/show_one_comment/{id}', [AdminController::class, 'one_comment']);
Route::get('/mark_as_read_all', [AdminController::class, 'mark_as_read_all']);
Route::get('/show_users', [AdminController::class, 'show_users']);
Route::get('/delete_user/{id}', [AdminController::class, 'delete_user']);
Route::get('/update_users/{id}', [AdminController::class, 'update_users']);
Route::post('/edit_user/{id}', [AdminController::class, 'edit_user']);
Route::get('/contact_view', [AdminController::class, 'contact_view']);
Route::get('/delet_contact/{id}', [AdminController::class, 'contact_view']);

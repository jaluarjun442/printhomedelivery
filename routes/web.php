<?php

use App\Http\Controllers\Insta10kFollowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InstaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
// Auth::routes(['register' => false]);

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/logout', [FrontController::class, 'logout'])
    ->name('logout');
Route::get('/calculator', [FrontController::class, 'calculator'])->name('calculator');
Route::post('/calculator/calculate', [FrontController::class, 'calculateCalculatorPrice'])
    ->name('calculator.calculate');

Route::get('/upload', [UploadController::class, 'upload'])->name('upload');
Route::get('/upload/verification-status', [UploadController::class, 'status'])->name('upload.status');
Route::post('/upload/send-otp', [UploadController::class, 'sendOtp'])->name('upload.sendOtp');
Route::post('/upload/verify-otp', [UploadController::class, 'verifyOtp'])->name('upload.verifyOtp');
Route::post('/upload/documents', [UploadController::class, 'upload_documents'])->name('upload.upload_documents');
Route::get('/upload/previous-files', [UploadController::class, 'previousFiles'])->name('upload.previousFiles');
Route::post('/upload/save-selected-files', [UploadController::class, 'saveSelectedFiles'])->name('upload.saveSelectedFiles');
Route::get('/print-options', [UploadController::class, 'printOptions'])->name('print.options');
Route::get('/print-options/prices', [UploadController::class, 'printOptionPrices'])->name('print-options.prices');
Route::post('/print-options/remove-file', [UploadController::class, 'removePrintOptionFile'])->name('print-options.remove-file');
Route::get('/print-options/previous-files', [UploadController::class, 'previousPrintFiles'])->name('print-options.previous-files');
Route::post('/print-options/add-files', [UploadController::class, 'addPreviousPrintFiles'])->name('print-options.add-files');
Route::post('/print-options/save', [UploadController::class, 'savePrintOptions'])->name('print-options.save');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/calculate-shipping', [CheckoutController::class, 'calculateShipping'])
    ->name('checkout.calculate.shipping');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
Route::get('/order/success/{order}', [CheckoutController::class, 'success'])->name('order.success');


// Route::get('/about_us', [FrontController::class, 'about_us'])->name('about_us');
// Route::get('/contact_us', [FrontController::class, 'contact_us'])->name('contact_us');
Route::get('/categories', [FrontController::class, 'categories'])->name('categories');
Route::get('/category/{slug}', [FrontController::class, 'category'])->name('category');
Route::get('/product/{id}/{slug}', [FrontController::class, 'product'])->name('product');
Route::get('/go_to_product/{product_id}', [FrontController::class, 'go_to_product'])->name('go_to_product');

Route::get('/page/{slug}', [FrontController::class, 'page'])->name('page');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin_index');
    Route::get('/home', [AdminController::class, 'index'])->name('admin_home');

    Route::get('/setting', [AdminController::class, 'setting'])->name('admin_setting');

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/get_orders', [OrderController::class, 'get_orders'])->name('admin.get_orders');
    Route::get('/order/{order_id}', [OrderController::class, 'view_order'])->name('admin.view_order');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');

    Route::get('/price', [PriceController::class, 'index'])->name('admin.price');
    Route::get('/get_price', [PriceController::class, 'get_price'])->name('admin.get_price');
    Route::get('/add_price', [PriceController::class, 'add_price'])->name('admin.add_price');
    Route::post('/save_price', [PriceController::class, 'save_price'])->name('admin.save_price');
    Route::get('/edit_price/{price_id}', [PriceController::class, 'edit_price'])->name('admin.edit_price');
    Route::post('/update_price', [PriceController::class, 'update_price'])->name('admin.update_price');

    Route::get('/category', [AdminController::class, 'category'])->name('admin.category');
    Route::get('/get_category', [AdminController::class, 'get_category'])->name('admin.get_category');
    Route::get('/add_category', [AdminController::class, 'add_category'])->name('admin.add_category');
    Route::post('/save_category', [AdminController::class, 'save_category'])->name('admin.save_category');
    Route::get('/edit_category/{category_id}', [AdminController::class, 'edit_category'])->name('admin.edit_category');
    Route::post('/update_category', [AdminController::class, 'update_category'])->name('admin.update_category');

    Route::get('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/get_store', [AdminController::class, 'get_store'])->name('admin.get_store');
    Route::get('/add_store', [AdminController::class, 'add_store'])->name('admin.add_store');
    Route::post('/save_store', [AdminController::class, 'save_store'])->name('admin.save_store');
    Route::get('/edit_store/{store_id}', [AdminController::class, 'edit_store'])->name('admin.edit_store');
    Route::post('/update_store', [AdminController::class, 'update_store'])->name('admin.update_store');
    Route::get('/store_links/{store_id}', [AdminController::class, 'store_links'])->name('admin.store_links');
    Route::post('/save_store_links', [AdminController::class, 'save_store_links'])->name('admin.save_store_links');

    Route::get('/product', [AdminController::class, 'product'])->name('admin.product');
    Route::get('/get_product', [AdminController::class, 'get_product'])->name('admin.get_product');
    Route::get('/add_product', [AdminController::class, 'add_product'])->name('admin.add_product');
    Route::post('/save_product', [AdminController::class, 'save_product'])->name('admin.save_product');
    Route::get('/edit_product/{product_id}', [AdminController::class, 'edit_product'])->name('admin.edit_product');
    Route::post('/update_product', [AdminController::class, 'update_product'])->name('admin.update_product');
    Route::delete('/delete_product_image/{id}', [AdminController::class, 'delete_product_image'])->name('admin.delete_product_image');
    Route::delete('/delete_product_attribute/{id}', [AdminController::class, 'delete_product_attribute'])->name('admin.delete_product_attribute');

    Route::get('/add_product_widget/{product_id}', [AdminController::class, 'add_product_widget'])->name('admin.add_product_widget');
    Route::post('/save_product_widget', [AdminController::class, 'save_product_widget'])->name('admin.save_product_widget');
});

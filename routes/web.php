<?php


use App\Http\Controllers\CollectPrideLinksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScrappingController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [HomePageController::class, 'homePage'])->name('homePage');
Route::get('/brand_models/{brand}', [ProductController::class, 'brandModels'])->name('brand.models');
Route::get('/request/{value}', [ProductController::class, 'request'])->name('request');
Route::get('/product-details/{product_id}', [ProductController::class, 'productDetails'])->name('product.details');
Route::get('/product/{watch_id}', [ProductController::class, 'product'])->name('product');


Route::get('/collect_links', [LinksController::class, 'collectLinks'])->name('collect.links');
Route::get('/pride_links', [LinksController::class, 'collectPrideLinks'])->name('pride.links');
Route::get('/gentleman_links', [LinksController::class, 'gentlemanCollectLinks'])->name('gentleman.links');
Route::get('/scrapping', [ScrappingController::class, 'scrapping'])->name('scrap');
Route::get('/pride_scrapping', [ScrappingController::class, 'prideScrapping'])->name('pride.scrapping');
Route::get('/gentleman_scrapping', [ScrappingController::class, 'gentlemanScrapping'])->name('gentleman.scrapping');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::match(['get', 'post'],'/add/cart/{productId}', [CartController::class, 'addToCart'])->name('add.cart');
Route::match(['get', 'post'],'/add/subtract/cart/{productId}', [CartController::class, 'addSubtractToCart'])->name('add.subtract.cart');

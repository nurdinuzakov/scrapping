<?php


use App\Http\Controllers\CollectPrideLinksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\ScrappingController;
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


Route::get('/collect_links', [LinksController::class, 'collectLinks'])->name('collect.links');
Route::get('/pride_links', [LinksController::class, 'collectPrideLinks'])->name('pride.links');
Route::get('/gentleman_links', [LinksController::class, 'gentlemanCollectLinks'])->name('gentleman.links');
Route::get('/scrapping', [ScrappingController::class, 'scrapping'])->name('scrap');
Route::get('/pride_scrapping', [ScrappingController::class, 'prideScrapping'])->name('pride.scrapping');

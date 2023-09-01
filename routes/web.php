<?php

use Illuminate\Support\Facades\Route;

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



// routes/web.php

use App\Http\Controllers\ShortenedUrlController;

Route::get('/', [ShortenedUrlController::class, 'create']);
Route::post('/shorten', [ShortenedUrlController::class, 'store']);
Route::get('/{shortened}', [ShortenedUrlController::class, 'redirect']);
Route::delete('/{shortened}', [ShortenedUrlController::class, 'delete'])->name("link_delete");




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

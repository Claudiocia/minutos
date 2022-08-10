<?php

use App\Http\Controllers\ClienteAutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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

Route::get('/', [SiteController::class, 'publico'])->name('/');
Route::resource('clientes', ClienteAutoController::class);

Route::group([
    'prefix' => 'admin', 'as' => 'admin.', 'middleware' => [
        'can:admin', 'auth:sanctum',
        config('jetstream.auth_session'),
        'verified']
], function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('sites', SiteController::class);
    Route::resource('fotos', FotoController::class);
    Route::resource('clientes', ClienteController::class);

});

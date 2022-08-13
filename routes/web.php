<?php

use App\Http\Controllers\ClienteAutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RateAdminController;
use App\Http\Controllers\RateController;
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
//rotas site
Route::get('/', [SiteController::class, 'publico'])->name('/');

//rota email
Route::get('/send-email', [MailController::class, 'sendEmail']);

//rotas clientes
Route::resource('clientes', ClienteAutoController::class);
Route::get('/email-verify/{id}/{token}', [ClienteAutoController::class, 'verifyEmailCliente'])
    ->name('clientes.verify');
Route::post('/clientes/sendemail', [ClienteAutoController::class, 'reenviarEmail'])
    ->name('clientes.sendemail');
Route::get('cancelar', [ClienteAutoController::class, 'cancelar'])
    ->name('clientes.cancelar');
Route::post('clientes/cancelar/assin', [ClienteAutoController::class, 'deleteAssinatura'])
    ->name('clientes.deletar');
Route::get('/reativa/{id}', [ClienteAutoController::class, 'reativaAssinatura'])
    ->name('clientes.reativa');
//rotas rate clientes
Route::resource('rates', RateController::class);

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
    Route::resource('rates', RateAdminController::class);

});

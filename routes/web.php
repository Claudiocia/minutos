<?php

use App\Http\Controllers\ClienteAutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CookieConsentController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\RateAdminController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RetrancaController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Mail\SendMailCliente;
use App\Mail\SendMailNews;
use App\Models\User;
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
Route::get('/', [SiteController::class, 'index'])->name('/');
Route::get('/newsletters', [SiteController::class, 'oldnews'])->name('oldnews');
Route::get('/newsletters/{newsletter}', [SiteController::class, 'show'])->name('newsletters.show');
Route::get('/cookie-consent/{kook}', CookieConsentController::class)->name('cookieConsent');

//rota email
Route::get('/send-email', [MailController::class, 'sendEmail']);
Route::get('/preview-email', [NewsletterController::class, 'disparaNews']);
Route::get('/teste-email', [NewsletterController::class, 'testeEmail']);


Route::get('/noticias/{id}', [NoticiaController::class, 'showPublic'])->name('noticias.show');

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
    Route::resource('retrancas', RetrancaController::class);
    Route::get('retrancas/apagar/{id}', [RetrancaController::class, 'apagar'])->name('retrancas.apagar');
    Route::resource('noticias', NoticiaController::class);
    Route::get('noticias/{noticia}/photo-rel', [NoticiaController::class, 'photorel'])->name('noticias.photorel');
    Route::resource('newsletters', NewsletterController::class);
    Route::get('newsletters/{newsletter}/photo-rel', [NewsletterController::class, 'photorel'])->name('newsletters.photorel');
    Route::get('/newsletters/sendmail/{newsletter}', [NewsletterController::class, 'disparaNews'])->name('newsletters.sendmail');

});

<?php

use App\Http\Controllers\ClienteAutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CookieConsentController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NossotimeController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\RateAdminController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RazionController;
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
Route::get('/', [SiteController::class, 'canalminutos'])->name('/');
Route::get('/newsletters', [SiteController::class, 'oldnews'])->name('oldnews');
Route::get('/newsletters/{newsletter}', [SiteController::class, 'show'])->name('newsletters.show');
Route::get('/cookie-consent/{kook}', CookieConsentController::class)->name('cookieConsent');
Route::get('/nosso-time', [SiteController::class, 'nossoTime'])->name('nossotime');
Route::get('/fale-conosco', [SiteController::class, 'faleConosco'])->name('faleconosco');
Route::post('/mensagem', [SiteController::class, 'enviaMensagem'])->name('envia-mensagem');
Route::resource('/indicators', IndicatorController::class);
Route::get('/indicators/{token}', [IndicatorController::class, 'assinaInd'])->name('indicators.assina-ind');

//rota email
Route::get('/send-email', [MailController::class, 'sendEmail']);
//Route::get('/preview-email/{newsletter}', [NewsletterController::class, 'disparaNews']);
Route::get('/teste-email/{newsletter}', [NewsletterController::class, 'testeEmail'])->name('testemail');


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
    Route::get('/dashboard', [UserController::class, 'dashboardAdmin'])->name('dashboard');

    Route::resource('users', UserController::class);

    //Route::resource('sites', SiteController::class);
    Route::post('sites', [SiteController::class, 'store'])->name('sites.store');
    Route::get('sites', [SiteController::class, 'index'])->name('sites.index');
    Route::get('sites/create', [SiteController::class, 'create'])->name('sites.create');
    Route::delete('sites/{site}', [SiteController::class, 'destroy'])->name('sites.destroy');
    Route::put('sites/{site}', [SiteController::class, 'update'])->name('sites.update');
    Route::get('sites/{site}', [SiteController::class, 'show'])->name('sites.show');
    Route::get('sites/{site}/edit', [SiteController::class, 'edit'])->name('sites.edit');

    //
    Route::resource('fotos', FotoController::class);
    Route::resource('nossotimes', NossotimeController::class);
    Route::resource('razions', RazionController::class);
    Route::get('nossotimes/{nossotime}/photo-rel', [NossotimeController::class, 'photorel'])->name('nossotimes.photorel');
    Route::resource('clientes', ClienteController::class);
    Route::get('clientes/lembrete/{cliente}', [ClienteController::class, 'lembreteEmail'])->name('clientes.lembrete');
    Route::resource('rates', RateAdminController::class);
    Route::resource('retrancas', RetrancaController::class);
    Route::get('retrancas/apagar/{id}', [RetrancaController::class, 'apagar'])->name('retrancas.apagar');
    Route::resource('noticias', NoticiaController::class);
    Route::get('noticias-dia', [NoticiaController::class, 'noticiasDia'])->name('noticias.noticias-dia');
    Route::get('noticias/{noticia}/photo-rel', [NoticiaController::class, 'photorel'])->name('noticias.photorel');
    Route::resource('newsletters', NewsletterController::class);
    Route::get('newsletters/{newsletter}/photo-rel', [NewsletterController::class, 'photorel'])->name('newsletters.photorel');
    Route::get('/newsletters/sendmail/{newsletter}', [NewsletterController::class, 'disparaNews'])->name('newsletters.sendmail');
    Route::resource('premios', PremioController::class);

});

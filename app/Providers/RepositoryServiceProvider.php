<?php

namespace App\Providers;

use App\Repositories\ClienteRepository;
use App\Repositories\ClienteRepositoryEloquent;
use App\Repositories\EmailRepository;
use App\Repositories\EmailRepositoryEloquent;
use App\Repositories\FotoRepository;
use App\Repositories\FotoRepositoryEloquent;
use App\Repositories\NewsletterRepository;
use App\Repositories\NewsletterRepositoryEloquent;
use App\Repositories\NoticiaRepository;
use App\Repositories\NoticiaRepositoryEloquent;
use App\Repositories\ParceiroRepository;
use App\Repositories\ParceiroRepositoryEloquent;
use App\Repositories\RateRepository;
use App\Repositories\RateRepositoryEloquent;
use App\Repositories\RazionRepository;
use App\Repositories\RazionRepositoryEloquent;
use App\Repositories\RetrancaRepository;
use App\Repositories\RetrancaRepositoryEloquent;
use App\Repositories\SiteRepository;
use App\Repositories\SiteRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SiteRepository::class, SiteRepositoryEloquent::class);
        $this->app->bind(ClienteRepository::class, ClienteRepositoryEloquent::class);
        $this->app->bind(NoticiaRepository::class, NoticiaRepositoryEloquent::class);
        $this->app->bind(NewsletterRepository::class, NewsletterRepositoryEloquent::class);
        $this->app->bind(RateRepository::class, RateRepositoryEloquent::class);
        $this->app->bind(FotoRepository::class, FotoRepositoryEloquent::class);
        $this->app->bind(RazionRepository::class, RazionRepositoryEloquent::class);
        $this->app->bind(RetrancaRepository::class, RetrancaRepositoryEloquent::class);
        $this->app->bind(ParceiroRepository::class, ParceiroRepositoryEloquent::class);
        //:end-bindings:
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

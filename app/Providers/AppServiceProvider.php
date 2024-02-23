<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Registra a implementação do Repositório de Usuários.
         *
         * Este trecho de código configura como a aplicação resolve a interface UserRepositoryInterface.
         * A implementação EloquentUserRepository é registrada como a implementação para essa interface. Isso permite
         * que possamos substituir facilmente a implementação do repositório sem afetar outros componentes.
         *
         * Importância:
         * Facilita a manutenção e a flexibilidade do código, seguindo o princípio de inversão de controle.
         */
        $this->app->singleton('App\Repositories\Interfaces\UserRepositoryInterface', function () {
            $baseRepopository = new EloquentUserRepository(new \App\Models\User());
            return $baseRepopository;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

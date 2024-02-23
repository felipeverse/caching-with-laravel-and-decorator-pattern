<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentUserRepository;
use App\Repositories\Decorators\CachingUserRepository;

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
         * Registra a implementação do Repositório de Usuários com caching.
         *
         * Este trecho de código configura como a aplicação resolve a interface UserRepositoryInterface.
         * A implementação EloquentUserRepository é registrada como a implementação base para essa interface.
         * Em seguida, criamos uma instância do CachingUserRepository, que serve como um decorador para o repositório base,
         * adicionando caching às consultas de banco de dados.
         *
         * Importância:
         * Facilita a manutenção e a flexibilidade do código, seguindo o princípio de inversão de controle.
         * Adiciona uma camada de caching ao repositório de usuários, melhorando o desempenho ao armazenar em cache
         * os resultados das consultas frequentes.
         */
        $this->app->singleton('App\Repositories\Interfaces\UserRepositoryInterface', function () {
            $baseRepository = new EloquentUserRepository(new User);
            $cachingRepository = new CachingUserRepository($baseRepository, $this->app['cache.store']);
            return $cachingRepository;
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

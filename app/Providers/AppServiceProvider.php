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
        // Registra a implementação EloquentUserRepository para a interface UserRepositoryInterface
        $this->app->singleton('App\Repositories\Interfaces\UserRepositoryInterface', function () {
            // Cria uma instância de EloquentUserRepository, passando uma instância de User como modelo e a retorna
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

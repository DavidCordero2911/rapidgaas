<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', fn($user) => $user->hasRole('admin'));
        Gate::define('mecanico', fn($user) => $user->hasRole('mecanico'));
        Gate::define('cliente', fn($user) => $user->hasRole('cliente'));
        Gate::define('mecanico_o_admin', fn($user) => $user->hasRole(['admin', 'mecanico']));
    }
}

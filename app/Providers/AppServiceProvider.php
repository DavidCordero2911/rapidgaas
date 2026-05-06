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
        Gate::define('superadmin', fn($user) => $user->hasRole('superadmin'));
        Gate::define('admin_taller', fn($user) => $user->hasRole('admin_taller'));
        Gate::define('mecanico', fn($user) => $user->hasRole('mecanico'));
        Gate::define('cliente', fn($user) => $user->hasRole('cliente'));
    }
}

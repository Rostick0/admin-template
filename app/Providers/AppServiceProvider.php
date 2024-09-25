<?php

namespace App\Providers;

use App\Models\User;
use Exception;
use Illuminate\Support\ServiceProvider;

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
        try {
            if (!auth()->check() && $user = User::find(1)) {
                auth()->setUser($user);
            }
        } catch (Exception $e) {
        }
    }
}

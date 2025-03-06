<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(database_path('migrations/views'));
        $this->loadMigrationsFrom(database_path('migrations/triggers'));
        $this->loadMigrationsFrom(database_path('migrations/procedures'));
        $this->loadMigrationsFrom(database_path('migrations/constraints'));
        // Added to ensure additional migrations
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}

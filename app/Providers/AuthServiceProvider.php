<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // The registerPolicies() method no longer exists in Laravel 11

        // Configure Passport
        //		Passport::tokensExpireIn(now()->addDays(15));
        //		Passport::refreshTokensExpireIn(now()->addDays(30));
        //		Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}

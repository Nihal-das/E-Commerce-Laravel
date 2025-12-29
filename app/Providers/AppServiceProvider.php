<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\URL;


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
    public function boot()
    {
        View::composer('components.nav', function ($view) {
            $cartCount = Cart::where('user_id', Auth::id())->count();


            $view->with('cartCount', $cartCount);
        });

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}

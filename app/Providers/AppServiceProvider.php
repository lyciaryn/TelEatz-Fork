<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;

use App\Models\CartItem;

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
        view()->composer('*', function ($view) {
            $userId = Auth::id();

            if ($userId) {
                $totalCartCount = CartItem::whereHas('cart', function ($q) use ($userId) {
                    $q->where('buyer_id', $userId);
                })->sum('quantity');
            } else {
                $totalCartCount = 0;
            }

            $view->with('cartItemCount', $totalCartCount);
        });

        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        $path = public_path('images');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}
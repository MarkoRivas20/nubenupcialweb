<?php

namespace App\Providers;

use App\Models\Cover;
use App\Models\Product;
use App\Models\Variant;
use App\Observers\CoverObserver;
use App\Observers\ProductObserver;
use App\Observers\VariantObserver;
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
        Cover::observe(CoverObserver::class);
        Product::observe(ProductObserver::class);
        Variant::observe(VariantObserver::class);
    }
}

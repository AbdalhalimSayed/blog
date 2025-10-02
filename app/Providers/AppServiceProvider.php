<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewClass;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

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
        //
        Route::pattern("category", '[0-9]+');
        Route::pattern("user", '[0-9]+');
        Route::pattern("post", '[0-9]+');
        Route::pattern("comment", '[0-9]+');

        View::composer('*', function (ViewClass $view) {
            $view->with("categories", Category::where("type", 0)->get());
        });

        Paginator::useBootstrapFive();
    }
}

<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
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

    public function boot(): void{

        Paginator::useBootstrapFive();
        View()->composer('layouts.FrontendLayout', function ($view) {
          $view->with('cart',Cart::where('customer_id',auth('customer')->id())->count() ?? 0)->with('categories',Category::with('subcategories')->whereNull('category_id')->select('id','slug','title','category_id')->get());
        });
    }


}

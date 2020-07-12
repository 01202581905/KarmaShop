<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductCategory;
use App\ProductType;
use Order;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('pagesF/master',function($view){
            $cats = ProductCategory::select('slug','name')->get();
             $types = ProductType::select('slug','name')->get();
            $view->with(['cats'=>$cats,'types'=>$types]);
        });
    }
}

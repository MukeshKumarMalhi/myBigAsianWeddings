<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;

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
        Schema::defaultStringLength(191);
        view()->composer(
            'layouts.app',
            function ($view) {
                $view->with('categories', DB::table('categories')->where('parent_category_id', null)->get());
            }
        );
        // view()->composer(
        //     'website.master',
        //     function ($view) {
        //         $view->with('categories', DB::table('categories')->where('parent_category_id', null)->get());
        //     }
        // );
    }
}

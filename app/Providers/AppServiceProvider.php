<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * For Laravel 8+ The paginator now uses the Tailwind CSS framework
     * for its default styling. In order to keep using Bootstrap,
     * you should add the Illuminate\Pagination\Paginator::useBootstrap()
     * method call to the boot method of your application's AppServiceProvider
     *
     * @return void
     */
    public function boot()
    {
				Paginator::useBootstrap();
	 			View::addNamespace('themes', resource_path('views/themes'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
     public function register()
     {

         if ($this->app->environment() !== 'production') {

         }

         if ($this->app->environment() == 'local') {
              $this->app->register('Iber\Generator\ModelGeneratorProvider');
         }
         // ...
     }
}

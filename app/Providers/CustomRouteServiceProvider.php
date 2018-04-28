<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class CustomRouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Http\Controllers';
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if(!\App::environment('local')){
            \URL::forceScheme('https');
        }

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/customWeb.php'));


    }
}

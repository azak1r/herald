<?php

namespace nullx27\Herald\Providers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ActiveNavigationProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Request $request)
    {

        \Blade::directive('navlink', function($args) use ($router, $request) {

            list($name, $label) = explode(',', $args);

            $route = $router->get($name)->uri();

            dd($route);

            if($route == $request->path()) {
                return '<li class="active"><a href="'.$route.'">'. $label .'</a></li>';
            }
            else {
                return '<li><a href="'.$route.'">'. $label .'</a></li>';
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

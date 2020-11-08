<?php

namespace biscuit\package;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use biscuit\package\facades\Press;

class PackageBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if($this->app->runningInConsole())
        {
            $this->registerPublishing();
        }
        $this->registerResources();
    }

    public function register()
    {
        $this->commands([
            Console\ProcessCommand::class,
        ]);
    }
    protected function registerResources()
    {
        $this->loadMigrationsFrom(__dir__.'/../src/database/migrations');
        $this->loadViewsFrom(__dir__.'/../resources/views/','press');
        $this->registerFacades();
        $this->registerRoutes();
        $this->registerFields();
    }
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ .'/../config/Press.php' =>  config_path('Press.php'),
        ],'press-config');
    }
    protected function registerRoutes()
    {
        Route::group($this->routeConfig(),function (){
            $this->loadRoutesFrom(__DIR__ . './../routes/web.php');
        });
    }
    protected function routeConfig()
    {
        return [
            'prefix'    =>  Press::path(),
            'namespace' =>  'biscuit\package\Http\Controllers',
        ];
    }

    protected function registerFacades()
    {
        $this->app->singleton('Press',function($app)
        {
            return new \biscuit\package\Press();
        });
    }

    private function registerFields()
    {
        Press::fields([
            fields\Body::class,
            fields\Title::class,
            fields\Date::class,
            fields\Description::class,
            fields\Extra::class,
        ]);
    }
}
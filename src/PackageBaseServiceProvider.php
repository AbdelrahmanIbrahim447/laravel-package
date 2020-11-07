<?php

namespace biscuit\package;


use Illuminate\Support\ServiceProvider;

class PackageBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
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
    }
}
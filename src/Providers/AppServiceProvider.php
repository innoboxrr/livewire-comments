<?php

namespace Innoboxrr\LivewireComments\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/lwc.php', 'lwc');
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'lwc');
        if ($this->app->runningInConsole()) {
            // $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/lwc'),], 'views');
            $this->publishes([__DIR__.'/../../config/lwc.php' => config_path('lwc.php')], 'config');
        }
        Livewire::component('lwc-comment', \Innoboxrr\LivewireComments\Livewire\Comment::class);
    }
    
}
<?php

namespace Innoboxrr\LivewireComments\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/lwc.php', 'lwc');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'lwc');
        if ($this->app->runningInConsole()) {
            // `lwc-config` es la etiqueta que documenta el README; `config` se
            // conserva por la convencion del ecosistema.
            $this->publishes([__DIR__.'/../../config/lwc.php' => config_path('lwc.php')], ['lwc-config', 'config']);
        }
        Livewire::component('lwc-comment', \Innoboxrr\LivewireComments\Livewire\Comment::class);
    }

}

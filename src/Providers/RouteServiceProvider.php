<?php

namespace Innoboxrr\LivewireComments\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    public function map()
    {

        $this->mapWebRoutes();      

    }

    protected function mapWebRoutes()
    {

        Route::middleware('web')
            ->as('lwc.comments.')
            ->namespace('Innoboxrr\LivewireComments\Http\Controllers')
            ->group(__DIR__ . '/../../routes/web.php');

    }

}

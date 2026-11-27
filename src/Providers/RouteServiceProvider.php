<?php

namespace Innoboxrr\LivewireComments\Providers;

use Illuminate\Contracts\Foundation\CachesRoutes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Hereda de ServiceProvider y no del RouteServiceProvider de Foundation. Aquel
 * guarda en una propiedad estatica de la clase base el cargador de rutas que
 * bootstrap/app.php registra con withRouting(), y cada subclase lo vuelve a
 * ejecutar: la aplicacion cargaba sus routes/web.php y api.php una vez mas por
 * cada paquete.
 */
class RouteServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        // Cuando las rutas estan cacheadas no hay que volver a registrarlas.
        if ($this->app instanceof CachesRoutes && $this->app->routesAreCached()) {
            return;
        }

        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->as('lwc.comments.')
            ->namespace('Innoboxrr\LivewireComments\Http\Controllers')
            ->group(__DIR__ . '/../../routes/web.php');
    }

}

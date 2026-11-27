<?php

namespace Innoboxrr\LivewireComments\Tests;

use Orchestra\Testbench\TestCase as Testbench;

/**
 * Una aplicacion Laravel con los proveedores que el paquete declara en su
 * composer.json.
 *
 * Se leen del propio composer.json y no de una lista escrita aqui: lo que se
 * prueba tiene que ser exactamente lo que recibe quien instala el paquete, y
 * una segunda lista acabaria divergiendo de la primera.
 */
abstract class TestCase extends Testbench
{
    /**
     * @return array<int, class-string>
     */
    /**
     * Delante va Livewire, que la aplicacion descubre sola y Testbench no: el
     * AppServiceProvider del paquete registra su componente en el.
     */
    protected function getPackageProviders($app): array
    {
        return ['Livewire\LivewireServiceProvider', ...self::declaredProviders()];
    }

    /**
     * @return array<int, class-string>
     */
    public static function declaredProviders(): array
    {
        return self::composer()['extra']['laravel']['providers'] ?? [];
    }

    /**
     * @return array<string, mixed>
     */
    public static function composer(): array
    {
        return json_decode((string) file_get_contents(dirname(__DIR__) . '/composer.json'), true);
    }
}

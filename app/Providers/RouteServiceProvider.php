<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * El path al que redirige después de iniciar sesión.
     */
    public const HOME = '/home';

    /**
     * Aquí se registran las rutas de la aplicación.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // ✅ Rutas API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // ✅ Rutas web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}

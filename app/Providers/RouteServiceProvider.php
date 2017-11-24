<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use JWTAuth;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapAdminRoutes();
        $this->mapClientesRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {

        Route::group(['namespace'=>$this->namespace], function(){
            include (base_path("routes/web.php"));
            include (base_path("routes/auth.php"));
        });

    }


    protected function mapAdminRoutes(){
        Route::group(['namespace'=>$this->namespace], function(){
            include (base_path("routes/rv/admin/linhas.php"));
            include (base_path("routes/rv/admin/assinantes.php"));
            include (base_path("routes/rv/admin/planos.php"));
            include (base_path("routes/rv/admin/notificacoes_flash.php"));
            include (base_path("routes/rv/admin/notificacoes.php"));
            include (base_path("routes/rv/admin/configuracoes.php"));
            include (base_path("routes/rv/admin/dashboard.php"));
        });
    }

    protected function mapClientesRoutes(){
        Route::group(['namespace'=>$this->namespace."\Clientes", 'prefix'=>'cli'], function(){
            include (base_path("routes/rv/clientes/clientes.php"));
            include (base_path("routes/rv/clientes/extrato.php"));
            include (base_path("routes/rv/clientes/grupos.php"));
            include (base_path("routes/rv/clientes/linhas.php"));
            include (base_path("routes/rv/clientes/gravacoes.php"));
            include (base_path("routes/rv/clientes/filas.php"));
            include (base_path("routes/rv/clientes/saudacoes.php"));
            include (base_path("routes/rv/clientes/uras.php"));
            include (base_path("routes/rv/clientes/configuracoes.php"));
            include (base_path("routes/rv/clientes/correio_voz.php"));
            include (base_path("routes/rv/clientes/notificacoes.php"));
        });
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}

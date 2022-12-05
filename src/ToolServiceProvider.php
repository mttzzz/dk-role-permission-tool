<?php

namespace Mttzzz\DkRolePermissionTool;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Nova;
use Mttzzz\DkRolePermissionTool\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        $this->publishes([
            __DIR__ . '/../database/migrations/create_dk_role_permission_tables.php' =>
                $this->app->databasePath() . "/migrations/" . date('Y_m_d_His') . "_create_dk_tool_service_tables.php",
        ], 'migrations');

        $this->commands([
            Commands\DKRolePermissionToolSeedCommand::class,
        ]);

        Models\Role::observe(Observers\RoleObserver::class);
        Models\NovaResource::observe(Observers\NovaResourceObserver::class);
        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Nova::router(['nova', Authenticate::class, Authorize::class], 'dk-role-permission-tool')
            ->group(__DIR__ . '/../routes/inertia.php');

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/dk-role-permission-tool')
            ->group(__DIR__ . '/../routes/api.php');
    }

    public function register()
    {
        //
    }
}

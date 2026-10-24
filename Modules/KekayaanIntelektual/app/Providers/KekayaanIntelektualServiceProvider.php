<?php

namespace Modules\KekayaanIntelektual\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class KekayaanIntelektualServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'KekayaanIntelektual';
    protected string $moduleNameLower = 'kekayaanintelektual';

    public function boot(): void
    {
        $this->registerViews();
        $this->registerMigrations();
        $this->registerRoutes();
    }

    public function register(): void
    {
        //
    }

    protected function registerViews(): void
    {
        $viewPath = module_path($this->moduleName, 'resources/views');
        $this->loadViewsFrom($viewPath, $this->moduleNameLower);
    }

    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
    }

    protected function registerRoutes(): void
    {
        Route::middleware('web')
            ->group(module_path($this->moduleName, 'routes/web.php'));

        Route::middleware('api')
            ->prefix('api')
            ->group(module_path($this->moduleName, 'routes/api.php'));
    }
}

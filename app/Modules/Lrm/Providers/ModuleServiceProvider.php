<?php

namespace Raffles\Modules\Lrm\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('irm', 'Resources/Lang', 'app'), 'irm');
        $this->loadViewsFrom(module_path('irm', 'Resources/Views', 'app'), 'irm');
        $this->loadMigrationsFrom(module_path('irm', 'Database/Migrations', 'app'), 'irm');
        $this->loadConfigsFrom(module_path('irm', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('irm', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}

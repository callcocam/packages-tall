<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Report;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;
use Livewire\Livewire;
use Symfony\Component\Finder\Finder;

class ReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->runningInConsole()){
            if(!\Schema::hasTable('tenants')){
                return;
            }
        }
       $this->app->register(RouteServiceProvider::class);
        if (class_exists(Livewire::class)) {
            \Tall\Theme\ComponentParser::loadComponent(__DIR__.'/Http/Livewire', __DIR__, 'Tall\Report');
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()){
            if(!\Schema::hasTable('tenants')){
                return;
            }
        }
        $this->publishConfig();
        $this->publishMigrations();
        $this->loadMigrations();
        
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-report');
    }
    
    /**
     * Publish the config file.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../config/report.php' => config_path('report.php'),
        ], 'report');
    }

    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'report-migrations');
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        if (config('report.migrate', true)) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

}

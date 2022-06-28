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
       $this->app->register(RouteServiceProvider::class);
        if (class_exists(Livewire::class)) {
            $this->load(__DIR__.'/Http/Livewire/Admin');
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
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

    private function load($paths)
    {
        $paths = array_unique(Arr::wrap($paths));

        $paths = array_filter($paths, function ($path) {
            return is_dir($path);
        });
        if (empty($paths)) {
            return;
        }

        $namespace = 'Tall\Report';
        //$tests=[];
        foreach ((new Finder())->in($paths)->files() as $domain) {
            $component = $namespace.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($domain->getRealPath(), __DIR__)
            );
            $componentName = Str::afterLast($component,'Livewire\\');
            $componentName = Str::beforeLast($componentName,'Component');
            $componentName = Str::replace("\\", ".", $componentName);
            $componentName = Str::lower($componentName);
            $componentName = Str::of($componentName)->append('-component');
            $componentName = Str::of($componentName)->prepend('tall-report::');
           // $tests[] = $componentName->value();
            if (is_subclass_of($component, LivewireComponent::class)) {
                Livewire::component($componentName->value(), $component);
            }
        }
        //dd($tests);
    }
}

<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;
use Livewire\Livewire;
use Symfony\Component\Finder\Finder;

class AclServiceProvider extends ServiceProvider
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootViews();
        $this->publishConfig();
        $this->loadConfigs();
        $this->publishMigrations();
        $this->loadMigrations();

        $this->registerGates();
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-acl');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-theme');
    }
    /**
     * Register the permission gates.
     *
     * @return void
     */
    protected function registerGates()
    {
        Gate::before(function (Authorizable $user, $permission) {
            try {
                if (method_exists($user, 'hasPermissionTo')) {
                    return $user->hasPermissionTo($permission) ?: null;
                }
            } catch (\Exception $e) {
                //dd($e);
            }
        });
    }

     /**
     * Publish the config file.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../config/acl.php' => config_path('acl.php'),
        ], 'tall-form');

        
    }

    
     /**
     * Merge the config file.
     *
     * @return void
     */
    protected function loadConfigs()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/acl.php','acl');
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
        ], 'acl-migrations');
        $this->publishes([
            __DIR__.'/../database/factories/' => database_path('factories'),
        ], 'acl-factories');
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

        $namespace = 'Tall\Acl';
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
            $componentName = Str::of($componentName)->prepend('tall-acl::');
           // dd($componentName);
           // $tests[] = $componentName->value();
            if (is_subclass_of($component, LivewireComponent::class)) {
                Livewire::component($componentName->value(), $component);
            }
        }
        //dd($tests);
    }
}

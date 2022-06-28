<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form;

use  Tall\Form\Commands\CreateCommand;
use  Tall\Form\Commands\EditCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;
use Livewire\Livewire;
use Symfony\Component\Finder\Finder;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
        $this->publishConfig();
        $this->loadConfigs();
        $this->publishMigrations();
        $this->loadMigrations();
        

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateCommand::class,
                EditCommand::class,
            ]);
        }

        $this->bootAliases();

        $this->publishes([__DIR__ . '/../config/tall-forms.php' => config_path('tall-forms.php')], 'tall-form-config');
        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/tall-forms')], 'tall-form-views');
        $this->publishes([__DIR__ . '/../resources/views/icons' => resource_path('views/vendor/tall-forms/icons')], 'tall-form-icons');
        $this->publishes([__DIR__ . '/../resources/css/tall-theme.css' => resource_path('css/tall-theme.css')], 'tall-form-theme-css');
        $this->publishes([__DIR__ . '/../resources/lang' => resource_path('lang/vendor/tall-forms'),], 'tall-form-lang');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tf');

        Livewire::component('trix', \Tall\Form\Livewire\Trix::class);
        Livewire::component('ckeditor', \Tall\Form\Livewire\CKEditor::class);
        Livewire::component('tall-gallery', \Tall\Form\Livewire\Gallery::class);

        $this->bootViews();
        $this->prefixComponents();
        
        include_once __DIR__."/../helpers.php";

    }

    public function register()
    {
        if (class_exists(Livewire::class)) {
            $this->load(__DIR__.'/Http/Livewire/Admin');
        }
        
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-forms');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-theme');
    }

     /**
     * Publish the config file.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../config/tall-forms.php' => config_path('tall-forms.php'),
        ], 'tall-forms');
    }

    
     /**
     * Merge the config file.
     *
     * @return void
     */
    protected function loadConfigs()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tall-forms.php','tall-forms');
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
        ], 'tall-forms-migrations');

        
        $this->publishes([
            __DIR__.'/../database/factories/' => database_path('factories'),
        ], 'tall-forms-factories');
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

    protected function bootAliases()
    {
      
    }

    private function prefixComponents(): void
    {
       
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

        $namespace = 'Tall\Form';
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
            $componentName = Str::of($componentName)->prepend('tall-form::');
           // dd($componentName);
           // $tests[] = $componentName->value();
            if (is_subclass_of($component, LivewireComponent::class)) {
                Livewire::component($componentName->value(), $component);
            }
        }
        //dd($tests);
    }

}

<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if(!\Schema::hasTable('tenants')){
            return;
        }
        if ($this->app->runningInConsole()) {
            //$this->commands([\Tall\Theme\Commands\CreateCommand::class]);
        }

        $this->publishViews();
        $this->publishConfigs();
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', "tall-theme");

        include_once __DIR__."/../helpers.php";
       
        $this->loadComponent('dropdown-link');
        $this->loadComponent('nav-link-dropdown');
        $this->loadComponent('nav-link');
        $this->loadComponent('breadcrums');
        $this->loadComponent('date-picker');
        $this->createDirectives();

        Livewire::component( 'tall-theme::admin.includes.sidebar', \Tall\Theme\Http\Livewire\Admin\Includes\Sidebar::class);
        Livewire::component( 'tall-theme::admin.includes.header', \Tall\Theme\Http\Livewire\Admin\Includes\Header::class);
    }

    public function register(): void
    {
        if(!\Schema::hasTable('tenants')){
            return;
        }
        $this->app->register(RouteServiceProvider::class);        
        if (class_exists(Livewire::class)) {
            \Tall\Theme\ComponentParser::loadComponent(__DIR__.'/Http/Livewire', __DIR__);
        }
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tall-theme.php','tall-theme'
        );
        $this->app->alias(ThemeManager::class, 'theme');
    }
    
    private function publishViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-theme');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/tall-theme'),
        ], 'tall-theme-views');
        
        $this->publishes([
            __DIR__ . '/../resources/js/assets' => public_path('js/assets'),
        ], 'tall-theme-js');
    }

    private function publishConfigs(): void
    {
        $this->publishes([
            __DIR__ . '/../config/tall-theme.php' => config_path('tall-theme.php'),
        ], 'tall-theme-config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/tall-theme' ),
        ], 'tall-theme-lang');
    }

    public function loadComponent($component, $alias=null){
        if ($alias == null){
            $alias=$component;
        }
        Blade::component("tall-theme::components.{$component}",'tall-'.$alias);
    }

    private function createDirectives(): void
    {
        Blade::directive('tallStyles', function () {
            return "<?php echo view('tall-theme::assets.styles')->render(); ?>";
        });

        Blade::directive('tallScripts', function () {
            return "<?php echo view('tall-theme::assets.scripts')->render(); ?>";
        });

        
        Blade::directive('tallLoader', function () {
            return "<?php echo view('tall-theme::assets.loader')->render(); ?>";
        });
    }

   
}

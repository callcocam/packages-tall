<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            //$this->commands([\Tall\Theme\Commands\CreateCommand::class]);
        }

        $this->publishViews();
        $this->publishConfigs();
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', "tall-theme");

        include_once __DIR__."/../helpers.php";

        //Livewire::component( 'tall-theme-edit-component', \Tall\Theme\Livewire\EditColumn::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tall-theme.php','tall-theme'
        );
    }
    
    private function publishViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-theme');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/tall-theme'),
        ], 'tall-theme-views');
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
}

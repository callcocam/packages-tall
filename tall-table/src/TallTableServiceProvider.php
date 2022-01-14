<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class TallTableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([\Tall\Table\Commands\CreateCommand::class]);
        }

        $this->publishViews();
        $this->publishConfigs();
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', "tall-table");

       Livewire::component( 'tall-table-edit-component', \Tall\Table\Livewire\EditColumn::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tall-table.php','tall-table'
        );
    }
    
    private function publishViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-table');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/tall-table'),
        ], 'tall-table-views');
    }

    private function publishConfigs(): void
    {
        $this->publishes([
            __DIR__ . '/../config/tall-table.php' => config_path('tall-table.php'),
        ], 'tall-table-config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/tall-table' ),
        ], 'tall-table-lang');
    }
}

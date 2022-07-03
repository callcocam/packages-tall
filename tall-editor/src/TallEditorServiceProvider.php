<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Editor;


use Illuminate\Support\ServiceProvider;
use Tall\Editor\Blocks\BlockParser;
use Tall\Editor\Blocks\BlockTypeRegistry;
use Tall\Editor\Blocks\ContentRenderer;
use Tall\Editor\Services\OEmbedService;
use Livewire\Livewire;


class TallEditorServiceProvider extends ServiceProvider
{
     /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/editor.php', 'editor');
        $this->publishes([__DIR__ . '/../config/editor.php' => config_path('editor.php')], 'tall-editor');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([__DIR__ . '/../database/migrations' => database_path('migrations')], 'tall-editor-migrations');
        $this->publishes([__DIR__ . '/../public' => public_path('vendor/tall-editor')], 'tall-editor-public');

        if (config('editor.use_package_routes')) {
            if (class_exists(Livewire::class)) {
                \Tall\Theme\ComponentParser::loadComponent(__DIR__.'/Http/Livewire', __DIR__, 'Tall\Editor');
                $this->app->register(RouteServiceProvider::class);     
            }
        }

        //require_once __DIR__ . '/Blocks/WPBlockParserBlock.php';
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BlockTypeRegistry::class, function () {
            return BlockTypeRegistry::getInstance();
        });

        $this->app->alias(ContentRenderer::class, 'editor.renderer');
        $this->app->alias(BlockParser::class, 'editor.parser');
        $this->app->alias(OEmbedService::class, 'editor.embed');
        $this->app->alias(BlockTypeRegistry::class, 'editor.registry');
    }
}

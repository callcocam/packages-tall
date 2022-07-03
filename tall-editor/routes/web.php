<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

use Tall\Editor\Http\Controllers\BlockRendererController;
use Tall\Editor\Http\Controllers\OEmbedController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('admin/editor')->group(function () {
    Route::get('oembed', [OEmbedController::class, 'show']);
    Route::get('block-renderer', [BlockRendererController::class, 'show']);

    Route::get('/posts',\Tall\Editor\Http\Livewire\Admin\Posts\ListComponent::class)->name(config('editor.routes.editors.list'));    
    Route::get('/post/cadastrar',\Tall\Editor\Http\Livewire\Admin\Posts\CreateComponent::class)->name(config('editor.routes.editors.create'));    
    Route::get('/post/{model}/editar',\Tall\Editor\Http\Livewire\Admin\Posts\EditComponent::class)->name(config('editor.routes.editors.edit'));    
    Route::get('/post/{model}/show',\Tall\Editor\Http\Livewire\Admin\Posts\ShowComponent::class)->name(config('editor.routes.editors.show'));    
});

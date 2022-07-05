<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('admin')->group(function () {
    Route::get('/',\Tall\Theme\Http\Livewire\Admin\DashBoardComponent::class)->name('admin');    
    Route::get('/routes',\Tall\Theme\Http\Livewire\Admin\RouteComponent::class)->name('admin.routes');    
    Route::get('/livewire',\Tall\Theme\Http\Livewire\Admin\LivewireComponent::class)->name('admin.livewire');    
});

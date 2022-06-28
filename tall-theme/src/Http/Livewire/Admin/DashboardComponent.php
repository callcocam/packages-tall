<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme\Http\Livewire\Admin;

use Livewire\Component;

class DashboardComponent extends Component
{
    
    protected $layout = "app";

    public function mount(){
        // \Menu::create('sidebar',function($menu){
        //     $menu->url('/', 'Home', 1);
        //     $menu->route('/', 'About', ['user' => '1'], 2);
        //     $menu->dropdown('Settings', function ($sub) {
        //         $sub->header('ACCOUNT');
        //         $sub->url('/settings/design', 'Design');
        //         $sub->divider();
        //         $sub->url('logout', 'Logout');
        //     }, 3);
        // });
    }
    
    protected function layout(){
        if(function_exists("theme_layout")){
            return theme_layout($this->layout);
        }
        return config('tall-forms.layout');
    }

    public function render()
    {
        return view('tall-theme::livewire.admin.dashboard-component')
        ->with('tenant', app('currentTenant'))->layout($this->layout());
    }
}

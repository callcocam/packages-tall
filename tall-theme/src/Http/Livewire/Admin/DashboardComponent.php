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

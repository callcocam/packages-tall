<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme\Http\Livewire\Admin;

use Tall\Theme\Http\Livewire\AbstractPaginaComponent;

class DashboardComponent extends AbstractPaginaComponent
{
    
    protected $layout = "app";

    
    
    protected function layout(){
        if(function_exists("theme_layout")){
            return theme_layout($this->layout);
        }
        return config('tall-forms.layout');
    }

    protected function view()
    {
        return 'tall-theme::livewire.admin.dashboard-component';
    }
}

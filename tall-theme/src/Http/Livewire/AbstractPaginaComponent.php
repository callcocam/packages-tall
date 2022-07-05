<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme\Http\Livewire;


use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;
use Tall\Theme\Traits\WithMenus;

abstract class AbstractPaginaComponent extends Component
{
    use WithPagination, Actions,WithMenus;

    protected $layout = "app";


    protected function layout(){
        if(function_exists("theme_layout")){
            return theme_layout($this->layout);
        }
        return config('tall-forms.layout');
    }

    public function icon()
    {
        # code...
    }
   abstract protected function view();
   

    public function render()
    {
        return view($this->view())        
        ->with('tenant', app('currentTenant'))->layout($this->layout());
    }


}

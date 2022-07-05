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

abstract class AbstractParentComponent extends Component
{
    use WithMenus;

    
    public function menu(){
        $this->parent();
     }
}

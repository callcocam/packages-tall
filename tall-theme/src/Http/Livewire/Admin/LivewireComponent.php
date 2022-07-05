<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme\Http\Livewire\Admin;

use Tall\Theme\Http\Livewire\AbstractPaginaComponent;


class LivewireComponent  extends AbstractPaginaComponent
{
    

    protected function view()
    {
        return 'tall-theme::livewire.admin.livewire-component';
    }
}

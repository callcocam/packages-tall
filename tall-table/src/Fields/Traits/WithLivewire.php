<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Fields\Traits;

trait WithLivewire 
{
    protected $livewire;

    
    public function select($livewire="tall-table-edit-component")
    {
        $this->livewire($livewire,"tall-table::livewire.select");

        return $this;
    }
    
    public function native($livewire="tall-table-edit-component")
    {
        $this->livewire($livewire,"tall-table::livewire.select-native");

        return $this;
    }
    
    public function status($livewire="tall-table-edit-component")
    {
        $this->livewire($livewire,"tall-table::livewire.select-status");

        return $this;
    }

    public function radio($livewire="tall-table-edit-component")
    {
        $this->livewire($livewire,"tall-table::livewire.radio");
        
        return $this;
    }

    public function livewire($livewire = "tall-table-edit-component", $view="tall-table::livewire.text")
    {
        $this->view($view);

        $this->livewire = $livewire;
        
        return $this;
    }

    public function isLivewire()
    {
        return $this->livewire;
    }
}

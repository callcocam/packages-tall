<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Livewire;

use Livewire\Component;
use Tall\Form\Traits\Message;
use WireUi\Traits\Actions;
use Tall\Report\Models\Report;
use Illuminate\Database\Eloquent\Collection;
use Tall\Report\Traits\Exportable;
use Tall\Report\Types\{ExportToCsv, ExportToXLS};

class ReportsComponent extends Component 
{
    use Message,Actions,Exportable; 
    public $cardModal;
    public $models;

    public function mount(Collection $models)
    {
        
        $this->models= $models;
    }

    /*
    |--------------------------------------------------------------------------
    |  Features modal
    |--------------------------------------------------------------------------
    | Modal visivel
    |
    */
    public function openModal(){
        $this->cardModal = true;            
     }

    public function render()
    {
        return view("tall-table::livewire.reports-component");
    }

     /*
    |--------------------------------------------------------------------------
    |  Features modal
    |--------------------------------------------------------------------------
    | Modal hide
    |
    */
    public function closeModal(){
        
     }

}

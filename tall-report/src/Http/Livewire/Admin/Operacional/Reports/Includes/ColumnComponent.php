<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Report\Http\Livewire\Admin\Operacional\Reports\Includes;

use Tall\Report\Models\Report;
use Tall\Form\FormComponent;
use Tall\Form\Fields\Input;
use Tall\Form\Fields\Radio;
use Tall\Form\Fields\Divider;
use Tall\Form\Fields\ColorPicker;
use Tall\Form\Fields\NativeSelect;
use Tall\Form\Fields\Toggle;

class ColumnComponent extends FormComponent
{

    public $column;
    public $cardModal;
    public $name;
    public $title;

    public $listeners = ['openModal'];
     /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function mount(?Report $model, $column, $name)
    {
        $coluna = $model->columns()->where('name', $name)->first();
        $this->setFormProperties($model);  
        if($relationship = $coluna->relationships()->where('name', $column)->first()){
            $this->title =\Str::title(sprintf("%s %s" ,  $name, $column));
        }
        else{
           
            $this->title =\Str::title($column);             
        }
        $this->name = $name;
        $this->column = $column;
    }
   
  
    /*
    |--------------------------------------------------------------------------
    |  Features order
    |--------------------------------------------------------------------------
    | Order visivel no me menu
    |
    */
    public function openModal(){
        $this->cardModal = true;            
     }

     public function save(){

     }
     
     public function delete(){

    }
    
    public function view()
    {
        return 'tall-report::includes.column-component';
    }
}

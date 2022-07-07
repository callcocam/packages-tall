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
use Tall\Report\Traits\ColumnsTrait;
use Tall\Report\Traits\Exportable;
use Illuminate\Support\Facades\DB;

class FilterComponent extends FormComponent
{
    use ColumnsTrait,Exportable;
    
    public $name;
    public $column;
    public $options;

    public function getFilterOptionsProperty(){
        return [
            ''           => 'Selecione',
            'is'           => 'É exatamente',
            'is_not'       => 'É diferente de',
            'contains'     => 'Contém',
            'contains_not' => 'Não contém',
            'starts_with'  => 'Começa com',
            'ends_with'    => 'Termina com',
            'is_null'      => 'É nulo',
            'is_not_null'  => 'Não é núlo',
            'is_blank'     => 'Está em branco',
            'is_not_blank' => 'Não está em branco',
            'is_empty'     => 'Não está preenchido',
            'is_not_empty' => 'Está preenchido',
        ];
    }
     /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function mount(?Report $model, $column, $name, $options =[])
    {
       $this->setFormProperties( $model); 
       $this->name = $name;
       $this->column = $column;
       $this->options = $options;
       if($filter = $model->filters->filter(function($item)use($column, $name){
        return $item->column == $column && $item->name == $name;
     } )->first()){
        $this->data['filter'] = $filter;
     }     
    } 
     /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function removeFilter()
    {
        $this->model->filters()->where('id',data_get($this->data, 'filter.id'))->forceDelete();
        $this->data['filter'] = [];
        $this->emit('setUpdated');
    } 
     /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function editFilter()
    {
    
        if(empty(data_get($this->data, 'filter.operador'))){
            $this->addError('operador', 'Campo obrigatório');
        }
        $this->model->filters()->where('id',data_get($this->data, 'filter.id'))->update([
            'operador'=>data_get($this->data, 'filter.operador'),
            'type'=>data_get($this->data, 'filter.type'),
            'value'=>data_get($this->data, 'filter.value'),
            'nulo'=>data_get($this->data, 'filter.nulo', false),
        ]);

        $this->emit('setUpdated');
    } 
     /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function createFilter()
    {
        if(empty(data_get($this->data, 'filter.operador'))){
            $this->addError('operador', 'Campo obrigatório');
        }
        $this->model->filters()->create([
            'name'=>$this->name,
            'column'=>$this->column,
            'operador'=>data_get($this->data, 'filter.operador'),
            'value'=>data_get($this->data, 'filter.value'),
            'nulo'=>data_get($this->data, 'filter.nulo', false),
         ]);
         $this->emit('setUpdated');
    } 

    public function getValuesProperty(){
        $values = [];
        if($options = $this->options){
            if($table = data_get($options, 'table')){
                $values = DB::table($table)->whereNull('deleted_at')->pluck('name', 'id');
            }
        }
        return $values;
    }

  /*
    |--------------------------------------------------------------------------
    |  Features fields
    |--------------------------------------------------------------------------
    | Inicia a configuração do campos disponiveis no formulario
    |
    */
    protected function fields(): array
    {
        return [
           
        ];
    }

    public function view()
    {
        return 'tall-report::includes.filter-component';
    }
}
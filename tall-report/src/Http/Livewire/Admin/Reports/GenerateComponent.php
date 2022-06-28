<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Report\Http\Livewire\Admin\Reports;

use Tall\Form\FormComponent;
use Tall\Report\Models\Report;
use Tall\Report\Traits\Exportable;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Tall\Report\Http\Livewire\Traits\LivewireInfo;

class GenerateComponent extends FormComponent
{
    use LivewireInfo, AuthorizesRequests, Exportable;
    
    public $checkboxValues = [];
     /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro vasio
    |
    */
    public function mount(?Report $model)
    {
        $this->authorize(Route::currentRouteName());
        
        $this->setFormProperties($model); 
        if($columns = $model->columns){
            if($columns->count()){
                foreach($columns as $name => $column){
                   if($column->relationships->count()){                        
                        if($relationships = $column->relationships){                        
                            foreach($relationships as $relationship){
                                data_set($this->checkboxValues,sprintf("%s.%s", $column->name, $relationship->name),$relationship->name);
                            }
                        }
                   }
                   else{
                    data_set($this->checkboxValues, $column->name,$column->name);
                   }
                }
            }
        }
    }
    
      /*
    |--------------------------------------------------------------------------
    |  Features query
    |--------------------------------------------------------------------------
    | Inicia a consulta ao banco de dados
    |
    */
    protected function query(){
       
        if($this->model->exists){     
            $class = \Str::replace('-', '\\', $this->model->model); 
            if(class_exists($class))    
            {
                return app($class)->query();
            }
        }
        return null;
    }
    
    public function getModelsProperty()
    {
        $builder = $this->query();
        if($builder) return $builder->limit(5)->get();
        return null;
    }
    protected function view()
    {

        return 'tall-report::generate-component';
    }
}

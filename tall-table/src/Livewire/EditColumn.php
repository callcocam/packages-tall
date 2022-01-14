<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Livewire;

use Livewire\Component;
use Tall\Table\Fields\Column;
use Tall\Form\Traits\Message;
use WireUi\Traits\Actions;

class EditColumn extends Component 
{
    use Message,Actions;
    private $column;
    public $placeholder;
    public $label;
    public $options;
    public $open = false;
    public $name;
    public $field;
    public $model;
    public $data;

    public function mount($model,Column $column)
    {
        
        $this->model= $model;
        $this->column = $column;
        $this->name = $column->name;
        $this->field = $column->field;
        $this->placeholder = $column->label;
        $this->options = $column->options;
        $this->view = $column->view;
        $this->data = \Arr::get($model, $column->field);
        $this->label = \Arr::get($model, $column->name);
    }


    public function render()
    {
        return view($this->view);
    }

    public function updatedData($value)
    {

        \Arr::set($this->model,$this->field, $value);
        if($option = \Arr::get($this->options,$value)){
            $this->label = $option;
        }
        else{
            $this->label = $value;
        }
        
       if($this->model->update()){
        $this->notification()->success(
            $title = __('Updated'),
            $description = $this->successCreate($this->model)
        );
        $this->open = false;
       }


    }
}

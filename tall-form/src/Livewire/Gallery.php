<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Gallery extends Component
{
    use WithFileUploads;

    protected $fields;
    public $model;

    public $data = [];

    public function mount($models, $fields,$value){
    
       $this->setFormProperties($models, $fields,$value);
    }


    /**
     * @param null $model
     */
    protected function setFormProperties( $models , $fields, $value)
    {
        $this->fields = $fields;
        $this->data['galeria_infos']=[];
        if(is_string($value)){
            $this->model = \Tall\Form\Models\GaleriaItem::find($value);
           // dd( $this->model);
           $infos = $this->model;
           foreach($fields as $field){
                foreach($infos as $info){
                    $result = $infos->galeria_infos->filter(function($data) use($field){
                        return $data['type'] == $field->field;
                    })->first();
                    if(!is_null($result)){          
                     $this->data['galeria_infos'][$field->field] = data_get($result,'name');
                    }
                }
           }
        }
    }
    public function save(){
     
        if($infos = data_get($this->data,'galeria_infos')){
            foreach($infos as $key => $info){
                $type = ['type' => $key];
                $data = ['name' => $info];
                if($this->model->galeria_infos()->updateOrCreate($type, $data)){
                    
                }
            }
        }

       $this->emit(\Tall\Form\Fields\Gallery::EVENT_VALUE_UPDATED, $this->data);
    }

    public function render()
    {
        return view('tall-forms::livewire.gallery')->with('fields', $this->fields);
    }
}
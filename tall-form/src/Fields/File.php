<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;
use Illuminate\Http\UploadedFile;

class File extends Field
{
    protected $attribute = 'url';
    protected $type = 'file';
    protected $multiple = false;
    protected $accepts = ['file','url'];

    public function __construct($label, $name){

        if(is_null($name)){
           $name = \Str::slug($label, "_");
        }
        $this->field = $name;
        $this->name = $name;
        $this->label = __($label);
        $this->key = sprintf("%s.files.%s", $this->data_name, $name);

    }

    public function attribute($attribute){
        $this->attribute = $attribute;
        return $this;
    }

    public function multiple(){
        $this->multiple = true;
        return $this;
    }

    public function updateFile($model, $values, $name){
        if(in_array($name, $this->accepts)){    
            if (method_exists($model, 'updateFile')) {    
              if(is_array($values)){
                   foreach ($values as $key => $value) {
                       $this->upload($model, $value, $name);
                   }
              }
              else{
                $this->upload($model, $values, $name);
              }
            }
        }
    }
    private function upload($model, $value, $name){
        if ($value instanceof UploadedFile) {    
            if($this->multiple)
                $file = $model->file()->create([]);         
            else
                $file = $model->file()->firstOrCreate([]); 

            $file->updateFile($value, $name);
        }
    }
}

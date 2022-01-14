<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;
use Illuminate\Http\UploadedFile;

class Upload extends Field
{
    
    protected $attribute = 'cover';
    protected $type = 'upload';
    protected $multiple = false;
    protected $accepts = ['cover','tablet','mobile','thumb'];

    public function __construct($label, $name){

        if(is_null($name)){
           $name = \Str::slug($label, "_");
        }
        $this->field = $name;
        $this->name = $name;
        $this->label = __($label);
        $this->key = sprintf("%s.imagens.%s", $this->data_name, $name);

    }

    public function multiple(){
        $this->multiple = true;        
        return $this;
    }

    public function attribute($attribute){
        $this->attribute = $attribute;
        return $this;
    }

    public function updateFile($model, $values, $name){
  
        if(in_array($name, $this->accepts)){        
            if (method_exists($model, 'updateCover')) {   
              if(is_array($values)){
                   foreach ($values as $key => $value) {
                       $this->upload($model,$value, $name);
                   }
              }
              else{
                $this->upload($model, $values, $name);
              }
            }
        }
    }

    private function upload($model, $value,  $name){
        if ($value instanceof UploadedFile) {    
            if($this->multiple)
                $image = $model->image()->create([]);         
            else
                $image = $model->image()->firstOrCreate([]); 

            $image->updateCover($value, $name);
        }
    }
}

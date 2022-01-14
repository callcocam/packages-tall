<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Form\Traits;
use Illuminate\Http\UploadedFile;

trait Uploads{

    public function updatedFiles()
    {
        //dd($this->files);
    }

    public function uploadPhoto()
    {
        if (method_exists($this->model, 'updateProfilePhoto')) {
            foreach ($this->data as $name => $value) {
                if ($value instanceof UploadedFile) {
                    $this->model->updateProfilePhoto($value);
                    unset($this->data[$name]);
                }
            }
        }
         $this->loadFiles()->loadFiles('files');

         return true;
    
    }

    private function updateProfilePhoto(){

    }

    private function loadFiles($name = 'imagens' )
    {
        if ($files = \Arr::get($this->data, $name)) { 
           
            foreach ($files as $name => $values) {  
                if ($values instanceof UploadedFile) {  
                    $field = $this->makeField($name);
                    if($field){                          
                        $field->updateFile($this->model, $values, $name);   
                    }     
                }
                else{
                    if(is_string(array_key_first($values))){
                        foreach ($values as $key => $value) {              
                            $field = $this->makeField(sprintf("%s.%s", $name, $key));
                            if($field){
                                $method =  $name;                     
                                $model =  $this->model;                     
                                if(method_exists($model, $method)){
                                    $relationModel = call_user_func_array([ $model, $method],[])->first();
                                }
                                else{
                                    $relationModel = $model;
                                }
                                $field->updateFile($relationModel, $value, $key);   
                            }     
                        }
                    }else{
                        $field = $this->makeField($name);
                        if($field){                          
                            $field->updateFile($this->model, $values, $name);   
                        }     
                    }
                }

            }
        }

        return $this;
    }

    private function method_exists($method)
    {
        return method_exists($this->model, $method);
    }
}
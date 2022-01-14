<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\hasMany;

trait Relationship
{
   
    public function relationship($model, $data)
    {
            foreach ($data as $name => $field) {
                if(is_array( $field)){                  
                    $method =  $name;                     
                    if(method_exists($model, $method)){
                       $this->relationship_type($model,$data, $method);
                    }
                }
            }        
    }

    private function relationship_update($relationModel,$data, $method){
        try {
            $data = \Arr::get($data, $method);
            if(!\Arr::isAssoc($data)){
                foreach($data as $item){
                    if($relationModel->update($item)){
                        $this->relationship($relationModel, $item);
                        return true;
                    }  
                }
            }
            else{
                if($relationModel->update($data)){
                    $this->relationship($relationModel, $data);
                    return true;
                }
            }
            return false;
        } catch (\PDOException $PDOException) {
            $this->notification()->error(
                $title = 'Relation Error !!! '.$method,
                $description = $this->errorUpdate($PDOException->getMessage())
            );
            return false;
        }
    }
    
    private function relationship_create($relationModel,$data, $method){
        try {
            $data = \Arr::get($data, $method);
            if(!\Arr::isAssoc($data)){
                foreach($data as $item){
                    if($id = \Arr::get($item, 'id')){
                        unset($item['id']);
                        if($updateModel = $relationModel->where('id',$id)->first()){
                            if($updateModel->update($item)){
                                $this->relationship($updateModel, $item);
                            }       
                        }
                    }
                   else{
                         $createModel = $relationModel->create($item);
                         if($createModel->exists){
                            $this->relationship($createModel, $item);
                        }         
                   }                    
                }
                return true;
            }
            else{
                $createModel = $relationModel->create($data);
                if($createModel->exists){
                    $this->relationship($createModel, $data);
                    return true;
                }         
            }
                 
            return false;
        } catch (\PDOException $PDOException) {
            $this->notification()->error(
                $title = 'Error !!!',
                $description = $this->errorCreate($PDOException->getMessage())
            );
            return false;
        }
    }

    public function relationship_type($model, $data, $method)
    { 
        $relationModel = call_user_func_array([ $model, $method],[]);
        switch (true) {
            case $relationModel instanceof BelongsToMany:             
                $relationModel->sync(array_filter(\Arr::get($data, $method)));      
                break;         
            case $relationModel instanceof MorphOne:             
                $relationModelExist = $relationModel->first();  
                if( $relationModelExist && $relationModelExist->exists){
                    $this->relationship_update($relationModelExist, $data, $method);
                }else{
                    $this->relationship_create($relationModel, $data, $method);
                }    
                break;     
            case $relationModel instanceof MorphMany:             
                    $relationModelExist = $relationModel->first();  
                    $this->relationship_create($relationModel, $data, $method);
                    break;       
                      
            case $relationModel instanceof hasMany:       
                $relationModelExist = $relationModel->first();   
                $this->relationship_create($relationModel, $data, $method);
                break;                 
            default:      
                 $relationModelExist = $relationModel->first(); 
                if($relationModelExist && $relationModelExist->exists){
                    $this->relationship_update($relationModelExist, $data, $method);
                }else{
                    $this->relationship_create($relationModel, $data, $method);
                }
            break;
        }
    }
}

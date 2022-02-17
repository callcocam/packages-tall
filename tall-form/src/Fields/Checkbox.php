<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class Checkbox extends Field
{
    protected $type = 'checkboxs';
    protected $left_label  = false;
    protected $lg  = false;
    protected $md  = false;

    public function left_label(){
        $this->left_label = true;
        return $this;
    }
    
    public function md(){
        $this->md = true;
        return $this;
    }
    
    public function lg(){
        $this->lg = true;
        return $this;
    }
    

    public function options($options, $label="name", $id="id"){

        if(is_string($options)){
            if(class_exists($options)){
                $options = app($options)->pluck( $label, $id)->toArray();
            }
        }
        if($options instanceof \Illuminate\Database\Eloquent\Builder){
            $options = $options->pluck( $label, $id)->toArray();
        }
        $this->options = $options;
        return $this;
    }
    
    public function options_combine($options){
        if (\Arr::isAssoc($options)) {
            $this->options = $options;
        } else {
            $this->options = array_combine($options, $options);
        }
        return $this;
    }
}

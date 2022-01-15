<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class Select extends Field
{
    
    protected $type = 'select';
    protected $optionComponent = true;
    protected $placeholder = '==Select one==';
    protected $option_label;
    protected $option_value;
    protected $option_key_cover;
    protected $option_key_value  = true;
    protected $searchable  = false;
    protected $option_key_label  = false;
    protected $multiselect  = false;

    public function option_label($option_label){
        $this->option_label = $option_label;
        return $this;
    }

    public function option_value($option_value){
        $this->option_value = $option_value;
        return $this;
    }

    public function option_key_cover($option_key_cover){
        $this->option_key_cover = $option_key_cover;
        return $this;
    }
    
    public function option_key_label(){
        $this->option_key_label = true;
        return $this;
    }
    
    
    public function multiselect(){
        $this->multiselect = true;
        $this->searchable = true;
        return $this;
    }
    
    public function option_key_value(){
        $this->option_key_value = true;
        return $this;
    }
    
    public function searchable(){
        $this->searchable = true;
        return $this;
    }
    
    public function options($options){
        $this->options = $options;
        return $this;
    }
    
    public function optionComponent($optionComponent){
        $this->optionsoptionComponent = $optionComponent;
        return $this;
    }
}

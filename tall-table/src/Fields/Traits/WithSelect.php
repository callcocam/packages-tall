<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Fields\Traits;

trait WithSelect 
{
    protected $inputDateSelectFilter;

    protected $options = [];

    public function makeInputSelect($inputDateSelectFilter, $options=null)
    {

        if($options){
            $this->options = $options;
        }
        $this->inputDateSelectFilter = $inputDateSelectFilter;
        
        return $this;
    }

    public function options($options)
    {
        $this->options = $options;
        return $this;
    }
}

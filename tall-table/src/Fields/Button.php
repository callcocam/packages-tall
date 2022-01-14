<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Fields;

use Tall\Table\Field;
use Tall\Table\Fields\Traits\WithAttributes;

class Button extends Field 
{
    use WithAttributes;
    
    protected $view = "_button";

    
    public function __construct($label, $name = null){

        if(is_null($name)){
            $name = \Str::slug($label, "_");
        }

        $this->label = $label;

        $this->name = $name;
    }

    public static function make($label, $name = null){
        return new static($label, $name);
    }

    
}

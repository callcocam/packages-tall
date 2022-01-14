<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields\Includes;

class Prepend 
{
    protected $icon;

    protected $class = "rounded-l-md h-full";

    public $primary = false;

    public $flat = false;

    public $squared = false;

    public function __construct($icon){
        $this->icon = $icon;
    }

    public static function make($icon){
        return new static($icon);
    }

    public function primary(){
        $this->primary = true;
        return $this;
    }

    
    public function __get($name){
        return $this->{$name};
    }
}

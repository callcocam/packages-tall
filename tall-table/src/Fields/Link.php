<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Fields;

use Tall\Table\Field;

class Link extends Field 
{
    protected $color = "ring-color-600 text-white bg-color-500 hover:bg-color-600
    dark:ring-offset-color-800 dark:bg-color-700 dark:ring-color-700";

    protected $view = "_link";

    protected $route = "_link";

    protected $class =[
        "focus:outline-none px-2.5 py-1.5 flex justify-center gap-x-2 items-center
        transition-all ease-in duration-75 focus:ring-2 focus:ring-offset-2
        hover:shadow-sm disabled:opacity-60 disabled:cursor-not-allowed rounded-md"
    ];

    
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

    
    public function route($route)
    {
        $this->route = $route;
        return $this;
    }


    public function primary($color="primary")
    {
        $this->class[] = str_replace("color",$color,$this->color);
        return $this;
    }

    
    public function danger($color="negative")
    {
        $this->class[] = str_replace("color",$color,$this->color);
        return $this;
    }
   
    public function succsess($color="positive")
    {
        $this->class[] = str_replace("color",$color,$this->color);
        return $this;
    }
    
    public function dark($color="secondary")
    {
        $this->class[] = "ring-secondary-600 text-white bg-secondary-700 hover:bg-secondary-900
        dark:ring-offset-secondary-800 dark:bg-secondary-700 dark:ring-secondary-700";
        return $this;
    }
    
    public function secondary($color="secondary")
    {
        $this->class[] = str_replace("color",$color,$this->color);
        return $this;
    }

    public function lg()
    {
        $this->class[] = "text-lg";
        return $this;
    }

    
    public function md()
    {
        $this->class[] = "text-md";
        return $this;
    }

    
    public function xs()
    {
        $this->class[] = "text-xs";
        return $this;
    }

    
    public function initClass($class)
    {
        $this->class = [$class];
        return $this;
    }
}

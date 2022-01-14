<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Fields;

use Tall\Table\Field;

class Action extends Field 
{
    
    protected $separator;

    protected $groups;

    protected $dialog;

    protected string $method = "confirm";

    protected $params;

    
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


    public function separator($separator=null)
    {
        if(is_null($separator)){
            $separator = $this->label;
        }
        $this->separator = $separator;
        return $this;
    }

    public function groups(array $groups)
    {
        foreach($groups as $group){
            $this->group($group);
        }
        return $this;
    }

    public function group($group)
    {
        $this->groups[] = $group;
        return $this;
    }

    public function method(string $method)
    {
        $this->method = $method;
        return $this;
    }

    public function params($params)
    {
        $this->params = $params;
        return $this;
    }

    public function dialog ($dialog )
    {
        $this->dialog =Dialog::make($dialog);
        return $this;
    }


}

<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table;

class Field  
{
    
    protected $name;
    protected $label;
    protected $view = "_text";
    protected $icon;
    protected $icon_type = "solid";
    protected $icon_class = "h-4 w-4";
    protected $can = true;


    public function view($view)
    {
        $this->view =  $view;

        return $this;
    }
    /**
     * Essa informação deve ser passada primeiro que as funções de icon_class icon_type
     */
    public function icon($icon, $icon_class="h-4 w-4", $icon_type="solid")
    {
        $this->icon =  $icon;
        $this->icon_class =  $icon_class;
        $this->icon_type =  $icon_type;
        return $this;
    }

    public function icon_type($icon_type)
    {
        $this->icon_type =  $icon_type;
         return $this;
    }

    public function can($can)
    {
        $this->can = $can;

        return $this;
    }

    public function __get($name){
        return $this->{$name};
    }
}

<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Fields;

use Tall\Table\Field;
use Tall\Table\Fields\Traits\WithAttributes;

class Delete extends Field 
{
    use WithAttributes;
    
    protected $view = "_delete";
    protected $title = "Sure Delete?";
    protected $description = "Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.";
    protected $method = "kill";
    protected $dialogIcon = "error";

    
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

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    public function method($method)
    {
        $this->method = $method;
        return $this;
    }

    public function dialogIcon($dialogIcon)
    {
        $this->dialogIcon = $dialogIcon;
        return $this;
    }
    
}

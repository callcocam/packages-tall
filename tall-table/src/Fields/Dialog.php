<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Fields;

use Tall\Table\Field;

class Dialog extends Field 
{
    
    protected $title = "Are you Sure?";
    protected $description = "Save the information?";
    protected $method = "confirm";
    protected $acceptLabel = "confirm";
    protected $params;

    
    public function __construct($data=[]){

        $this->title = \Arr::get($data, 'title', 'Are you Sure?');
        $this->description = \Arr::get($data, 'description', 'Save the information?');
        $this->method = \Arr::get($data, 'method', 'confirm');
        $this->acceptLabel = \Arr::get($data, 'acceptLabel', 'Yes, save it');
        $this->params = \Arr::get($data, 'params', null);
        $this->icon = \Arr::get($data, 'icon', 'question');
    }

    public static function make($data=[]){
        return new static($data);
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function method($method)
    {
        $this->method = $method;
        return $this;
    }

    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    public function params($params)
    {
        $this->params = $params;
        return $this;
    }

    public function acceptLabel($acceptLabel)
    {
        $this->acceptLabel = $acceptLabel;
        return $this;
    }
}

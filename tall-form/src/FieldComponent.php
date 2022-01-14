<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form;
use Illuminate\View\Component;

abstract class FieldComponent extends Component
{
    protected $data_name = "data";
    protected $label;
    protected $name;
    protected $key;
    protected $type = "input";
    protected $append;
    protected $prepend;
    protected $hint;
    protected $prefix;
    protected $suffix;
    protected $corner_hint;
    protected $icon;
    protected $right_icon;
    protected $wire = ".defer";
    protected $placeholder;
    protected $rules =[];

    public function __construct($label, $name){

        if(is_null($name)){
           $name = \Str::slug($label, "_");
        }
        $this->name = $name;
        $this->label = __($label);
        $this->key = sprintf("%s.%s", $this->data_name, $name);

    }

    public static function make($label, $name=null){
      return new static($label, $name);
    }

    public function append($append){
        $this->append = $append;
        return $this;
    }

    
    public function prepend($prepend){
        $this->prepend = $prepend;
        return $this;
    }

    public function placeholder($placeholder){
        $this->placeholder = $placeholder;
        return $this;
    }

    public function icon($icon){
        $this->icon = $icon;
        return $this;
    }

    public function corner_hint($corner_hint){
        $this->corner_hint = $corner_hint;
        return $this;
    }

    public function prefix($prefix){
        $this->prefix = $prefix;
        return $this;
    }

    public function suffix($suffix){
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * @param $rules
     * @param array $data
     * @return $this
     */
    public function rules($rules, $data = [])
    {
        if (is_callable($rules)) {
            $this->rules = call_user_func($rules, $data);
        } else {
            $this->rules = $rules;
        }

        return $this;
    }

     /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view(sprintf('tall-forms::fields.%s', $this->type))->with($this->data());
    }

    public function __get($name){
        return $this->{$name};
    }
}

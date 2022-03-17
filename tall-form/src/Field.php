<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form;

use Illuminate\Support\Facades\Cache;
///use Illuminate\View\Component;

//abstract class Field extends Component
abstract class Field
{
    protected $wire_model = "defer";
    protected $data_name = "data";
    protected $span = "12";
    protected $hidden = true;
    protected $default;
    protected $label;
    protected $field;
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
    protected $options = [];
    protected $expiration =60;

    public function __construct($label, $name){

        if(is_null($name)){
           $name = \Str::slug($label, "_");
        }
        $this->field = $name;
        $this->name = $name;
        if(!is_null($label)){
            $this->label = __($label);
         }
        $this->key = sprintf("%s.%s", $this->data_name, $name);

    }

    public static function make($label, $name=null){
      return new static($label, $name);
    }

    public static function blank($name){
        return new static(null, $name);
      }
  
    public function defer(){
        $this->wire_model = 'defer';
        return $this;
    }
  
    public function lazy(){
        $this->wire_model = "lazy";
        return $this;
    }
  
    public function wire_model(){
        $this->wire_model = "model";
        return $this;
    }
  
  
    public function field($field){
        $this->field = $field;
        return $this;
    }
  
    public function key($key){
        $this->key = $key;
        return $this;
    }
  
    public function name($name){
        $this->name = $name;
        return $this;
    }

    public function span($span){
        $this->span = $span;
        return $this;
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

    public function hint($hint){
        $this->hint = $hint;
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

    public function default($default){
        $this->default = $default;
        return $this;
    }

    public function hideIf($callback=null){
        $this->hidden = $callback;
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


    public function collect($collect){
        $this->options = $collect;
        return $this;
    }

    public function status( $type = 'general'){
        $this->options(Cache::remember($this->expiration, "statuses_", function() use($type){
            return \App\Models\Status::query()->where('type', $type)->pluck('name','id')->toArray();
        }));
        return $this;
    }
    //  /**
    //  * Get the view / contents that represents the component.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function render()
    // {
    //     $this->withAttributes([
    //         "label"=>$this->label,
    //         "primary"=>true,
    //     ]);
    //     return view(sprintf('tall-forms::fields.%s', $this->type))->with($this->data());
    // }

    public function __get($name){
        return $this->{$name};
    }
}

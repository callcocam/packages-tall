<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Fields;

use Tall\Table\Field;
use Tall\Table\Fields\Traits\WithDatePicker;
use Tall\Table\Fields\Traits\WithDateText;
use Tall\Table\Fields\Traits\WithSelect;
use Tall\Table\Fields\Traits\WithMultiSelect;
use Tall\Table\Fields\Traits\WithLivewire;
use Illuminate\Support\Facades\Cache;

class Column extends Field
{
    use WithLivewire, WithDatePicker, WithDateText, WithSelect, WithMultiSelect;

    protected $field;

    protected $expiration = 60;

    protected bool $searchable = false;

    protected bool $callback = false;

    protected $formatCallback = null;

    protected bool $sortable = false;

    
    public function __construct($label, $name = null){

        if(is_null($name)){
            $name = \Str::slug($label, "_");
        }

        $this->label = $label;

        $this->name = $name;
        $this->field = $name;
    }

    public static function make($label, $name = null){
        return new static($label, $name);
    }


    public function field($field )
    {
        $this->field = $field;

        return $this;
    }

    public function searchable($callback = null)
    {
        if($callback){
            $this->searchable = $callback;
            return $this;
        }
        $this->searchable = true;
        return $this;
    }

    
    public function format($callback)
    {
        $this->formatCallback = $callback;
        $this->callback = true;
        return $this;
    }

     /**
     * @return bool
     */
    public function isFormatted(): bool
    {
        return is_callable($this->formatCallback);
    }

     /**
     * @param $model
     * @param $column
     *
     * @return mixed
     */
    public function formatted($model, $column)
    {
        return app()->call($this->formatCallback, ['model' => $model, 'column' => $column]);
    }


    public function sortable($callback = null)
    {
        if($callback){
            $this->sortable = $callback;
            return $this;
        }
        $this->sortable = true;
        return $this;
    }

    
    public function makeInputStatusBasic(){

        $this->makeInputStatus(false, ['0'=>'Desabilitado','1'=>'Habilitado']);

        return $this;
        
    }

    public function makeInputStatus($mult=false,$type='general', $options=null)
    {

        if($options){
            $this->options = $options;
        }
        else{
            $this->options(Cache::remember($this->expiration, "statuses_", function() use( $type){
                return \App\Models\Status::query()->where('type', $type)->pluck('name','id')->toArray();
            }));
        }
        if($mult){
            $this->makeInputMultiSelect('status_id');
        }else{
            $this->makeInputSelect('status_id');
        }
        
        
        return $this;
    }

   
}

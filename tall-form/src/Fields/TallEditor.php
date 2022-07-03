<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class TallEditor extends Field
{
    protected $type = "tall-editor";
    protected $route;
    protected $options = [];
    protected $disabledCoreBlocks = [];

    public function __construct($label, $name){

        parent:: __construct($label, $name);

        $this->route( config('editor.routes.editors.api.uploads.images', 'tall-editor.api.uploads.images'));

        $defaults = config('editor.blocks');
        
        $disabledCoreBlocks = [];
        foreach ($defaults as $default){
            foreach ($default as $core => $block){             
                if(!data_get($block, 'active')){
                    $disabledCoreBlocks[] = $core;
                }
            }
        }
        
        $this->disabledCoreBlocks( $disabledCoreBlocks );
    }


    public function type($type){
        $this->type = $type;
        return $this;
    }


    public function disabledCoreBlocks($disabledCoreBlocks = []){
        $this->options['disabledCoreBlocks'] =  $disabledCoreBlocks;
        return $this;
    }

   
    public function options($options){      
        
        $this->options = $options;
        return $this;
    }

    public function route($route, $params=[])
    {
         if(\Route::has($route)){
            $this->route = route($route, $params);
         }
        return $this;
    }
}

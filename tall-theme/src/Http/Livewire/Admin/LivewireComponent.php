<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme\Http\Livewire\Admin;

use Tall\Theme\Http\Livewire\AbstractPaginaComponent;


class LivewireComponent  extends AbstractPaginaComponent
{
    public $serach;

    protected function view()
    {
        return 'tall-theme::livewire.admin.livewire-component';
    }

    public function getComponentsProperty()
    {
        $components = collect();
  
        foreach (config('tall-theme.components') as $base => $paths) {
            if($namespaces = data_get($paths, 'namespace')){
                foreach ($namespaces as $key => $namespace) {
                    if($objects = \Tall\Theme\ComponentParser::listComponents($base ,$key, $namespace, data_get($paths,'after'))){
                        foreach($objects as $object){
                            $components->push($object);
                        }
                    }
                    
                }
            }
           
        }
        return $components->toArray();
    }
}

<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Theme;


use Livewire\Commands\ComponentParser as ComponentParserAlias;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Livewire\Livewire;

use Symfony\Component\Finder\Finder;

class ComponentParser extends ComponentParserAlias
{


    public static function isComponent($component )
    {
        $comp = null;
        switch ($component) {
            case is_subclass_of($component, \Livewire\Livewire::class):
                $comp = app($component);
                break;   
            case is_subclass_of($component, \Tall\Form\FormComponent::class):
                $comp = app($component);
                break;  
            case is_subclass_of($component, \Tall\Table\TableComponent::class):
                 $comp = app($component);
                break;
        }   
        return $comp; 
    }

    public static function loadComponent($paths, $dir, $namespace = 'Tall\Theme')
    {
        $paths = array_unique(Arr::wrap($paths));

        $paths = array_filter($paths, function ($path) {
            return is_dir($path);
        });
        if (empty($paths)) {
            return;
        }

        foreach ((new Finder())->in($paths)->files() as $domain) {
            $component = $namespace.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($domain->getRealPath(), $dir)
            );
            $componentName = Str::afterLast($component,'Livewire\\');
            $componentName = Str::beforeLast($componentName,'Component');
            $componentName = Str::replace("\\", ".", $componentName);
            $componentName = Str::lower($componentName);           
            $componentName = sprintf("%s::%s-component",Str::replace("\\", "-", $namespace), $componentName);
            $componentName = Str::lower($componentName);  
            switch ($component) {
                case is_subclass_of($component, \Livewire\Livewire::class):
                    Livewire::component($componentName, $component);
                    break;   
                case is_subclass_of($component, \Tall\Form\FormComponent::class):
                    Livewire::component($componentName, $component);
                    break;  
                case is_subclass_of($component, \Tall\Table\TableComponent::class):
                    Livewire::component($componentName, $component);
                    break;
            }        
        }
    }

    
    public static function listComponents($paths, $subpaths, $namespace, $after)
    {
        if(is_string($subpaths)){
            $path = base_path(sprintf("%s/%s",$paths, $subpaths));
        }else{
            $path = base_path($paths);
        }
        $components = [];
        if (is_dir($path)) {
           
            foreach ((new Finder())->in($path)->directories() as $domain) {
                if(\Str::contains( $domain->getRealPath(), "Http/Livewire")){                    
                    foreach ((new Finder())->in($domain->getRealPath())->files() as $file) {
                       
                        $component = $namespace.str_replace(
                            ['/', '.php'],
                            ['\\', ''],
                            Str::after($file->getRealPath(), $after)
                        );
                        switch ($component) {
                            case is_subclass_of($component, \Livewire\Component::class):
                                $components[$component::getName()]  = $component::getName();
                                break;   
                            case is_subclass_of($component, \Tall\Form\FormComponent::class):
                                $components[$component::getName()]  = $component::getName();
                                break;  
                            case is_subclass_of($component, \Tall\Table\TableComponent::class):
                                $components[$component::getName()]  = $component::getName();
                                break;
                        }        
                    
                    }
                   
                }
            }
        }
        return  $components;
    }

    public static function generateRoute($path, $search="app", $ns = "\\App")
    {

        if (!is_dir($path)) {
            return;
        }
      
        foreach ((new Finder)->in($path) as $component) {
           
            $componentPath = $component->getRealPath();
            $namespace = Str::after($componentPath, $search);
            $namespace = Str::replace(['/', '.php'], ['\\', ''], $namespace);
            $component = $ns . $namespace;
            
            if (class_exists($component)) {
                if (method_exists($component, 'route')) {
                    $comp =  app($component);
                    $comp ->route();
                    if (method_exists($component, 'gerar')) {
                        $comp->menu();
                    }
                }
            }
        }
    }

    

    public static function generateMenu($path, $search="app", $ns = "\\App")
    {

        if (!is_dir($path)) {
            return [];
        }
        $menus = [];
        foreach ((new Finder)->in($path) as $component) {
            $menu=[];
            $componentPath = $component->getRealPath();
            $namespace = Str::after($componentPath, $search);
            $namespace = Str::replace(['/', '.php'], ['\\', ''], $namespace);
            $component = $ns . $namespace;
            if(!\Str::contains($component, 'AbstractPaginaComponent')){
                if (class_exists($component)) {
                    if (app($component)->generate()) {
                        if (method_exists($component, 'route_name')) {
                            $menu['route'] = app($component)->route_name();
                        }
                        if (method_exists($component, 'label')) {
                            $menu['label'] = app($component)->label();
                        }
                        if (method_exists($component, 'order')) {
                            $menu['order'] = app($component)->order();
                        }                        
                        if (method_exists($component, 'Toggleable')) {
                            $menu['Toggleable'] = app($component)->Toggleable();
                        }                        
                        if (method_exists($component, 'Hoverable')) {
                            $menu['Hoverable'] = app($component)->Hoverable();
                        }
                        if (app($component)->parent()) {
                       
                        }else{
                            $menus[] = $menu;
                        }
                    }
                }
            }
           
        }

        return collect($menus)->sortBy([
            ['order', 'asc']
        ])->toArray();
    }
}

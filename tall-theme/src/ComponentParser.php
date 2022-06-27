<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Theme;


use Livewire\Commands\ComponentParser as ComponentParserAlias;
use Illuminate\Support\Str;

use Symfony\Component\Finder\Finder;

class ComponentParser extends ComponentParserAlias
{


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
                    app($component)->route();
                }
            }
        }
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
                    app($component)->route();
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

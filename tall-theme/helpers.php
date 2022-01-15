<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

if (!function_exists('tallTheme')) {

    function tallTheme(){
        return app(\Tall\Theme\Tailwind::class);
    }
}

if (!function_exists('tableView')) {

    function tableView(){
        return "tall-theme::datatable";
    }
}
if (!function_exists('formView')) {

    function formView(){
        return "tall-theme::form";
    }
}

if (!function_exists('theme_layout')) {

    function theme_layout($layout=null){
        if(\Str::contains(\Route::currentRouteName(),'dev')){
            return "tall-theme::layouts.app";
        }
        if(!is_null($layout)){
            return "tall-theme::layouts.{$layout}";
        }
        return config('livewire.layout');
    }
}

if (!function_exists('theme_form_view')) {
    
    function theme_form_view($path){
        return sprintf("tall-theme::%s", $path);
    }
}

if(!function_exists("theme_include_table")){

    function theme_include_table($view)
    {
        return "tall-theme::includes.{$view}";
    }
}


if (!function_exists('theme_lv_includes')) {
    
    function theme_lv_includes($component){
        return sprintf("tall-theme::includes.%s-component", $component);
    }
}
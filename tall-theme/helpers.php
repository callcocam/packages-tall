<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/


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
<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/


if (!function_exists('form_parh')) {
    
    function form_parh($path = ""){
        return sprintf("%s/%s", $path);
    }
}


if (!function_exists('form_view')) {
   
    function form_view($path){
        if (function_exists('theme_form_view')) {    
            return theme_form_view($path);
        }
        return sprintf("tall-forms::%s", $path);
    }
}


if (!function_exists('form_fields')) {
    function form_fields($path){        
        if (function_exists('theme_form_view')) {    
            return theme_form_view(sprintf("fields.%s", $path));
        }
        return form_view(sprintf("fields.%s", $path));
    }
}
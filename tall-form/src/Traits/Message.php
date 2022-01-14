<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Form\Traits;


trait Message
{
    protected function successCreate($model=null){
        return "Registration successfully";
    }

    protected function successUpdate($model=null){
        return "Update successful";
    }

    protected function successDelete($model=null){
        return "successfully deleted";
    }

    protected function errorCreate($error=null){
        return $error;
    }

    protected function errorUpdate($error=null){
        return $error;
    }

    protected function errorDelete($error=null){
        return $error;
    }
}

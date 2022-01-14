<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Fields\Traits;

trait WithDatePicker 
{
    protected $inputDatePickerFilter;

    public function makeInputDatePicker($inputDatePickerFilter)
    {
        $this->inputDatePickerFilter = $inputDatePickerFilter;
        
        return $this;
    }
}

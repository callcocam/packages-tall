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

    protected $inputMultDatePickerFilter;
    protected $inline = false;
    protected $headerStyle  = '';
    protected $inputClass   = '';
    protected $headerClass    = '';


    public function makeInputDatePicker($inputDatePickerFilter)
    {
        $this->inputDatePickerFilter = $inputDatePickerFilter;
        
        return $this;
    }

    public function makeInputMultDatePicker($inputMultDatePickerFilter)
    {
        $this->inputMultDatePickerFilter = $inputMultDatePickerFilter;
        
        return $this;
    }
}

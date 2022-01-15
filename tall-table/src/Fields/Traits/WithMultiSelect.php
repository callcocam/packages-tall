<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Fields\Traits;

trait WithMultiSelect 
{
    protected $inputDateMultiSelectFilter;

    public function makeInputMultiSelect($inputDateMultiSelectFilter)
    {
        $this->inputDateMultiSelectFilter = $inputDateMultiSelectFilter;
        
        return $this;
    }
}

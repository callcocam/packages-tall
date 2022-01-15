<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme;

use Tall\Theme\Components\FilterDatePicker;

abstract class AbstractTheme
{
    
    public FilterDatePicker $filterDatePicker;

    
    public function filterDatePicker(): FilterDatePicker
    {
        return Theme::filterDatePicker();
    }

}
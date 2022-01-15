<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme;

use Tall\Theme\Components\FilterDatePicker;

class ThemeManager
{

    public function filterDatePicker(): FilterDatePicker
    {
        return new FilterDatePicker();
    }
}
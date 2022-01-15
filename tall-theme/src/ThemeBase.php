<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Theme;

class ThemeBase extends AbstractTheme
{
    public function apply(): ThemeBase
    {
      
        $this->filterDatePicker  = $this->filterDatePicker();

        return $this;
    }

}
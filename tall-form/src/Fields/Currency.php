<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class Currency extends Field
{
    protected $type = 'currency';
    protected $thousands  =",";
    protected $decimal  =".";
    protected $prefix  ="R$";

    
    public function suffix($suffix){
        $this->suffix = $suffix;
        return $this;
    }

    public function decimal($decimal){
        $this->decimal = $decimal;
        return $this;
    }

    public function thousands($thousands){
        $this->thousands = $thousands;
        return $this;
    }
}

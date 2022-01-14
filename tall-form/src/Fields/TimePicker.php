<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Form\Fields;

use Tall\Form\Field;

class TimePicker extends Field 
{
    protected $type         =	"time-picker";
    protected $interval         =	10;//string|number
    protected $format           =	"12";//12|24 string
    
    public function interval($interval){
        $this->interval = $interval;
        return $this;
    }
    
    public function format($format){
        $this->format = $format;
        return $this;
    }
    

}

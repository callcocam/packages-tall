<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class Toggle extends Field
{
    protected $type = 'toggle';
    protected $left_label  = false;
    protected $lg  = false;
    protected $md  = false;

    public function left_label(){
        $this->left_label = true;
        return $this;
    }
    
    public function md(){
        $this->md = true;
        return $this;
    }
    
    public function lg(){
        $this->lg = true;
        return $this;
    }
}

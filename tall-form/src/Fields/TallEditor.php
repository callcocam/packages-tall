<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class TallEditor extends Field
{
    protected $type = "tall-editor";

    public function type($type){
        $this->type = $type;
        return $this;
    }

}

<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class Editor extends Field
{
    protected $type = "ckeditor";

    const EVENT_VALUE_UPDATED = 'editor_value_updated';

    public function type($type){
        $this->type = $type;
        return $this;
    }

}

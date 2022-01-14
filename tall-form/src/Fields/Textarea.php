<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class Textarea extends Field
{
    protected $type = 'textarea';
    protected $rows = '3';
    protected $cols = '30';

    public function rows($rows)
    {
        $this->rows = $rows;
        return $rows;
    }

    public function cols($cols)
    {
        $this->cols = $cols;
        return $rows;
    }
}

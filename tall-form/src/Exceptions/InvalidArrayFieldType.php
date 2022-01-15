<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace TTall\Form\Exceptions;


class InvalidArrayFieldType extends \Exception
{
    public function __construct($fieldname, $fieldtype, $parenttype)
    {
        $lookup = [
            'array' => 'Repeater',
            'keyval' => 'Keyval',
            'tab' => 'Tab',
            'panel' => 'Panel',
            'group' => 'Group',
        ];

        parent::__construct(
            "Error for field: [$fieldname], type: [$fieldtype] is not allowed in [$lookup[$parenttype]]"
        );
    }
}

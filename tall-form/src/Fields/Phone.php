<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;

class Phone extends Field
{
    protected $type = 'phone';
    protected $mask  ="['(##) ####-####', '(##) #####-####']";
}

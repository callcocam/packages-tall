<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Fields\Traits;

trait WithDateText 
{
    protected $inputDateTextFilter;

    protected $inputDateTextFilterOptions = [
        'is'           => 'É exatamente',
        'is_not'       => 'É diferente de',
        'contains'     => 'Contém',
        'contains_not' => 'Não contém',
        'starts_with'  => 'Começa com',
        'ends_with'    => 'Termina com',
        'is_null'      => 'É nulo',
        'is_not_null'  => 'Não é núlo',
        'is_blank'     => 'Está em branco',
        'is_not_blank' => 'Não está em branco',
        'is_empty'     => 'Não está preenchido',
        'is_not_empty' => 'Está preenchido',
    ];

    public function makeInputText($inputDateTextFilter)
    {
        $this->inputDateTextFilter = $inputDateTextFilter;
        
        return $this;
    }

    
    public function inputDateTextFilterOptions($inputDateTextFilterOptions)
    {
        $this->inputDateTextFilterOptions = $inputDateTextFilterOptions;
        
        return $this;
    }
}
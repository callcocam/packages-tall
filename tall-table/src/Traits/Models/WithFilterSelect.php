<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/ 
namespace Tall\Table\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

trait WithFilterSelect
{
    
    /**
     * @param string|array $value
     */
    public function filterSelect(Builder $query, string $field, $value): void
    {
       
        /** @var Builder $query */
        if ($value = data_get($value,'value')) {
            $query->where($field, $value);
        }
    }
}

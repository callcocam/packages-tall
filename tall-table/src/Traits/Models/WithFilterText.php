<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Traits\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

trait WithFilterText
{
    
    /**
     * @param string|array $value
     */
    public function filterInputText(Builder $query, string $field, $value): void
    { 
   
        $textFieldOperator = strtolower(\Arr::get($value, 'key', 'contains'));
        $value = strtolower(\Arr::get($value, 'value', null));
        switch ($textFieldOperator) {
            case 'is':
                $query->where($field, '=', $value);

                break;
            case 'is_not':
                $query->where($field, '!=', $value);

                break;
            case 'starts_with':
                $query->where($field, 'LIKE', $value . '%');

                break;
            case 'ends_with':
                $query->where($field, 'LIKE', '%' . $value);

                break;
            case 'contains':
                $query->where($field, 'LIKE', '%' . $value . '%');

                break;
            case 'contains_not':
                $query->where($field, 'NOT ' . 'LIKE', '%' . $value . '%');

                break;
            case 'is_empty':
                $query->where($field, '=', '')->orWhereNull($field);

                break;
            case 'is_not_empty':
                $query->where($field, '!=', '')->whereNotNull($field);

                break;
            case 'is_null':
                $query->whereNull($field);

                break;
            case 'is_not_null':
                $query->whereNotNull($field);

                break;
            case 'is_blank':
                $query->where($field, '=', '');

                break;
            case 'is_not_blank':
                $query->where($field, '!=', '')->orWhereNull($field);

                break;
        }
       
    }

}

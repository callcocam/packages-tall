<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/ 
namespace Tall\Table\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

trait WithFilterMultiSelect
{
      /**
     * @param string|array $value
     */
    public function filterMultiSelect(Builder $query, string $field, $value): void
    {
        $empty = false;

        /** @var array $values */
        $values = collect($value)->get('values');

        if (is_array($values) && count($values) === 0) {
            return;
        }

        foreach ($values as $value) {
            if ($value === '') {
                $empty = true;
            }
        }
        if (!$empty) {
            $query->whereIn($field, $values);
        }
    }
}

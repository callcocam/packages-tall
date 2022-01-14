<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

if(!function_exists("include_table")){

    function include_table($view)
    {
        return "tall-table::includes.{$view}";
    }
}

if (!function_exists('_validateInputTextOptions')) {
    function _validateInputTextOptions(array $filter, string $field): bool
    {
        return in_array(
            strtolower(\Arr::get($filter, sprintf('input_text.%s.key', $field))),
            ['is', 'is_not', 'contains', 'contains_not', 'starts_with', 'ends_with', 'is_empty', 'is_not_empty', 'is_null', 'is_not_null', 'is_blank', 'is_not_blank']
        );
    }
}
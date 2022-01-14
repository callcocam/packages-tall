<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\{Collection as BaseCollection, Str};

trait WithSearch {

    public $search;

    public function isSearch()
    {
        $field_names = [];
        foreach ($this->columns() as $field){
            if($field->searchable){
                $field_names[] = $field->name;
            }
        }
        return $field_names;
    }

}
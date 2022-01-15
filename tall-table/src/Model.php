<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\{Collection as BaseCollection, Str};
use Tall\Table\Traits\Models\WithFilterText;
use Tall\Table\Traits\Models\WithFilterDatePicker;
use Tall\Table\Traits\Models\WithFilterSelect;
use Tall\Table\Traits\Models\WithFilterMultiSelect;

class Model 
{
    use WithFilterText, WithFilterDatePicker, WithFilterSelect, WithFilterMultiSelect;

    protected $relationSearch = [];
    protected $filters = [];
    protected $search;
    protected $query;

    public static function make(Builder $query){
        return new static($query);
    }

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }
    
    
    public function search($search)
    {
        $this->search = $search;
        return $this;
    }
    
    public function filters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    public function paginate($columns, $perPage=12)
    {
       return $this->applySearchFilter($columns)->filter()->paginate($perPage);
    }

    public function applySearchFilter($columns)
    {

        if ($this->search != '') {
            $this->query = $this->query->where(function (Builder $query) use($columns){
                $table = $query->getModel()->getTable();
                if($columns){
                    /** @var Column $column */
                    foreach ($columns as $column) {
                        if ($column->searchable) {
                            if (filled($column->field)) {
                                $field = $column->field;
                            } else {
                                $field = $column->name;
                            }
                            if (Str::contains($field, '.')) {
                                $explodeField = Str::of($field)->explode('.');
                                $table = $explodeField->get(0);
                                $field = $explodeField->get(1);
                            }
                            $hasColumn = Schema::hasColumn($table, $field);

                            if ($hasColumn) {
                                $query->orWhere($table . '.' . $field, 'LIKE', '%' . $this->search . '%');
                            }
                        }
                    }
                }
                return $query;
            });

            if (count($this->relationSearch)) {
                $this->applySearchRelation();
            }
        }

        return $this;
    }

    public function filter(): Builder
    {
        
        foreach ($this->filters as $key => $type) {
          
            $this->query->where(function ($query) use ($key, $type) {
                foreach ($type as $field => $value) {
                    switch ($key) {
                        case 'date_picker':                           
                            $this->filterDatePicker($query, $field, $value);

                            break;
                        case 'multi_select':
                           // $this->filterMultiSelect($query, $field, $value);

                            break;
                        case 'select':
                            $this->filterSelect($query, $field, $value);

                            break;
                        case 'boolean':
                           // $this->filterBoolean($query, $field, $value);

                            break;
                        case 'input_text':
                            $this->filterInputText($query, $field, $value);

                            break;
                        case 'number':
                           // $this->filterNumber($query, $field, $value);

                            break;
                    }
                }
            });
        }

        return $this->query;
    }

   

    private function applySearchRelation(): void
    {
        foreach ($this->relationSearch as $table => $relation) {
            if (!is_array($relation)) {
                return;
            }

            foreach ($relation as $nestedTable => $column) {
                if (is_array($column)) {
                    /** @var Builder $query */
                    $query = $this->query->getRelation($table);

                    if ($query->getRelation($nestedTable) != '') {
                        foreach ($column as $nestedColumn) {
                            $this->query = $this->query->orWhereHas($table . '.' . $nestedTable, function (Builder $query) use ($nestedColumn) {
                                $query->where($nestedColumn, 'LIKE', '%' . $this->search . '%');
                            });
                        }
                    }
                } else {
                    $this->query = $this->query->orWhereHas($table, function (Builder $query) use ($column) {
                        $query->where($column, 'LIKE', '%' . $this->search . '%');
                    });
                }
            }
        }
    }
}

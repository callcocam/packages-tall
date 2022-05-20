<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithSorting {

    public string $sortField = 'id';

    public string $sortDirection = 'asc';

    public bool $withSortStringNumber = false;

    public function sortBy(string $field, string $direction = 'asc'): void
    {
        $this->sortDirection = $this->sortField === $field ? $this->reverseSort() : $direction;

        $this->sortField = $field;
    }

    public function reverseSort(): string
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function applySorting(Builder $query): Builder
    {
       return $query->orderBy($this->sortField, $this->sortDirection);
    }


    public function updateOrder($data=[]){
        $this->notification()->success(
            $title = __('Ordering'),
            $description = "Você esta usando a função basica de ordenação, vc deve reescrever a função updateOrder($data){}	"
        );
    }
}
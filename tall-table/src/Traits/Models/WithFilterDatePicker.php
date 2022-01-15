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

trait WithFilterDatePicker
{
    
    public function filterDatePicker(Builder $query, string $field, array $value): void
    { 
          if ($value = \Arr::get($value, 'value')) {         
              if(\Str::contains($value, ' ')) {
                  $value = \Str::of($value)->replace('/', '.');
                  $value = preg_replace("/[^0-9.]/", " ", $value);
                  $value = \Str::of($value)->replace('.', '-');                  
                  $start = \Str::beforeLast($value ,' ');
                  $end = \Str::afterLast($value ,' ');
                  $query->whereBetween($field, [Carbon::parse(trim($start)), Carbon::parse(trim($end))]);
              }
              

            // if (isset($value['start']) || isset($value['end'])) {          
            //     if ($value['start'] && $value['end']) {
            //         $query->whereBetween($field, [Carbon::parse($value['start']), Carbon::parse($value['end'])]);
            //     }elseif($value['start'] && is_null($value['end'])){               
            //         $query->whereBetween($field, [Carbon::parse($value['start']), Carbon::now()->addYears(50)]);
            //     }elseif($value['end'] && is_null($value['start'])){
            //         $query->whereBetween($field, [Carbon::now()->subYears(500), Carbon::parse($value['end'])]);
            //     }
            // }
        }
        
    }
}

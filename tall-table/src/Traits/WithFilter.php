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

trait WithFilter {

       public $isFilters = false;
       public $filters = [];
       public $makeDataFilters = [
              "date_picker"=>[],
              "input_text"=>[],
              "select"=>[],
       ];

       public function makeFilters($columns)
       {

              $isFilters = null;
             
              foreach ($columns as $column){
                     // if ($column->inputDatePickerFilter){
                     //        if(!isset($this->filters[$column->inputDatePickerFilter])){
                     //               $this->filters[$column->inputDatePickerFilter] = [
                     //                      'start'=>null,
                     //                      'end'=>null,
                     //               ] ;
                     //        }
                     //        $this->makeDataFilters['date_picker'][$column->inputDatePickerFilter]['value']['start'] = \Arr::get($this->filters,sprintf('%s.start', $column->inputDatePickerFilter), null);
                     //        if(!$isFilters)
                     //        $isFilters = \Arr::get($this->filters,sprintf('%s.start', $column->inputDatePickerFilter), null);
                     //        $this->makeDataFilters['date_picker'][$column->inputDatePickerFilter]['value']['end'] = \Arr::get($this->filters,sprintf('%s.end', $column->inputDatePickerFilter), null);
                     //        if(!$isFilters)
                     //        $isFilters  = \Arr::get($this->filters,sprintf('%s.end', $column->inputDatePickerFilter));
                     // }
                      if ($column->inputDatePickerFilter){
                            
                            if(!isset($this->filters[$column->inputDatePickerFilter])){
                                   $this->filters[$column->inputDatePickerFilter] = null;
                            }
                            $this->makeDataFilters['date_picker'][$column->inputDatePickerFilter]['value']= \Arr::get($this->filters,  $column->inputDatePickerFilter, null);
                            if(!$isFilters){
                                   $isFilters = \Arr::get($this->filters, $column->inputDatePickerFilter, null);
                            }
                           
                     }
                     if ($column->inputDateTextFilter){
                            if(!isset($this->filters[$column->inputDateTextFilter]['key'])){
                                   $this->filters[$column->inputDateTextFilter]['key'] = "contains";
                                   $this->filters[$column->inputDateTextFilter]['value'] = null;
                            }
                            $this->makeDataFilters['input_text'][$column->inputDateTextFilter]['key'] = \Arr::get($this->filters,sprintf('%s.key', $column->inputDateTextFilter), "contains");
                            $this->makeDataFilters['input_text'][$column->inputDateTextFilter]['value'] = \Arr::get($this->filters,sprintf('%s.value', $column->inputDateTextFilter), null);
                            if(!$isFilters)
                            $isFilters  = \Arr::get($this->filters,sprintf('%s.value', $column->inputDateTextFilter), null);
                                  
                     }
                     if ($column->inputDateSelectFilter){
                            if(!isset($this->filters[$column->inputDateSelectFilter]['value'])){
                                   $this->filters[$column->inputDateSelectFilter]['value'] = null;
                            }
                            $this->makeDataFilters['select'][$column->inputDateSelectFilter]['value'] = \Arr::get($this->filters,sprintf('%s.value', $column->inputDateSelectFilter), null);
                            if(!$isFilters)
                            $isFilters  = \Arr::get($this->filters,sprintf('%s.value', $column->inputDateSelectFilter), null);
                     }
                 }
                 $this->isFilters = $isFilters;
              //    if($this->checkboxAll){
              //        $this->clearFilters();
              //    }
              
       }

       public function removeFilter($name)
       {
              foreach($this->makeDataFilters as $key => $filter){
                     if(\Arr::has($filter,$name)){
                            \Arr::forget($this->filters,$name);
                            \Arr::forget($this->makeDataFilters,sprintf("%s.%s",$key, $name));
                     }
              }
       }

       public function removeAllFilter()
       {              
              $this->reset(['makeDataFilters','filters']);
       }

       protected function hasFilter(): bool
       {
              $result  = false;
              if($this->makeDataFilters){
                     foreach($this->makeDataFilters as $key => $filters){
                            foreach ($filters as $name => $filter){
                                   $data = data_get($filter, 'value');
                                   if ($data){
                                          if (is_array($data)){      
                                                 foreach($data as $value){
                                                        if($value){
                                                               $result = true;
                                                        }
                                                 }  
                                          }
                                          elseif ($data){
                                                 $result = true;
                                          }
                                   }
                            }

                     }
              }      
              return $result;
       }

       public function clearFilters()
       {
              $this->gotoPage(1);
              //iniciao como tu selecionado
              $this->checkboxAll = false;  
              //inicia como a pagina selecionada
              $this->checkboxAllCurrentPage[$this->page] = false;
              //descarrega a seleção
              $this->checkboxValues = [];
       }
}
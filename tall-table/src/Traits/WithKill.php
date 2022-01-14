<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Traits;

use Tall\Table\Fields\Action;


trait WithKill {

      
    public function kill($value)
    {
        if($value){
            if($this->query()->where($this->checkboxAttribute, $value)->delete()){
                $this->clearFilters();            
                $this->notification()->success(
                    $title = __('Deleted'),
                    $description = $this->successDelete(null)
                );
            }
       }
    }
      
    public function removeAll()
    {
        $results = 0;
        foreach(\Arr::get($this->checkboxValues, $this->page, []) as $value){
           if($value){
                if($this->query()->where($this->checkboxAttribute, $value)->delete()){
                    $results++;
                }
           }
        }
        if( $results){
            $this->clearFilters();            
            $this->notification()->success(
                $title = __('Deleted'),
                $description = $this->successDelete(null)
            );
        }        
    }

    public function cancel()
    {
        dd('cancel');
    }


    public function getDelateAllHeader()
    {
        return  Action::make('Delete')
            ->dialog([
                'method'=>'removeAll'
            ])->can($this->checkboxValuesCount())
            ->icon('trash');
    }
}
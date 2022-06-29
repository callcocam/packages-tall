<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table;

use Livewire\{Component, WithPagination};
use Tall\Table\Traits\WithSearch;
use Tall\Table\Traits\WithFilter;
use Tall\Table\Traits\WithCheckbox;
use Tall\Table\Traits\WithToggleColumns;
use Tall\Table\Traits\WithModal;
use Tall\Table\Traits\WithSorting;
use Tall\Table\Traits\WithKill;
use Tall\Table\Traits\WithExport;
use Illuminate\Support\{Collection as BaseCollection, Str};
use WireUi\Traits\Actions;
use Tall\Form\Traits\Message;
use Tall\Theme\Traits\WithMenus;

use Illuminate\Support\Facades\Cache;

abstract class TableComponent extends Component
{
    use WithMenus, Message, WithExport, Actions, WithKill, WithSearch, WithFilter, WithCheckbox, WithToggleColumns, WithModal, WithSorting, WithPagination;

    protected $columns;

    protected $query;

    public bool $isCollection = false;
    public  $status = [];
    public $sortable = false;
    public $actionsHeaders = false;

    protected $layout = "app";

    abstract protected function query();
 
    protected function view(){
        if(function_exists("tableView")){
            return tableView();
        }
        return "tall-table::datatable";
    }

    protected function layout(){
        if(function_exists('theme_layout')){
           return theme_layout($this->layout);
        }
      return config('tall-table.layout');
  
     }

    public function updatedPage(): void
    {
       
        if(isset($this->checkboxAllCurrentPage[$this->page])){
            $this->checkboxAll = true;
        }
        else{
            $this->checkboxAll = false;
        }
        
    }
    public function updatingPage(): void
    {
       
        if($this->checkboxAll){
            $this->checkboxAll = false;
            $this->checkboxAllCurrentPage[$this->page] = true;
        }
        
    }
    
    /*
    |--------------------------------------------------------------------------
    |  Features reports
    |--------------------------------------------------------------------------
    | Realacionado as ações de cada registro, como editar deletar e visualizar
    |
    */
    protected function reports(){

        //$class_name =\Str::reaplace("\\","-", get_class($this->query()->getModel()));
        $class_name =get_class($this->query()->getModel());
       // dd($class_name);
        if(class_exists(config("report.models.parent", \Tall\Report\Models\Report::class))){
           return app(config("report.models.parent", \Tall\Report\Models\Report::class))->where('model', $class_name)->get();
        }
        return null;
    }

    public function render(){

        $themeBase = tallTheme()->apply();

        if (method_exists($this, 'order')) {
            $this->sortable = true;
        }

        $this->columns  = $this->makeColumns();

        return view($this->view())
        ->with([
            'models'=>$this->models($this->columns),
            'actions'=>$this->actions(),
            'headers'=>$this->headers(),
            'reports'=>$this->reports(),
            'tableAttr'=>$this->tableAttr(),
            'hasFilter'=>$this->isFilters,
            'columns'=> $this->columns,
            'theme' => $themeBase,
        ])
        ->layout($this->layout());
    }

    protected function fillData(){
        $this->columns  = $this->makeColumns();
       return $this->models();
    }

    public function updatedSearch(){
       
        if (filled($this->search)) {
            $this->clearFilters();
        }

    }
      /**
     * @return AbstractPaginator|BaseCollection
     * @throws Exception
     */
    protected function models(){

        /** @var Builder|BaseCollection|\Illuminate\Database\Eloquent\Collection $datasource */
        $query = (!empty($this->query)) ? $this->query : $this->applySorting($this->query());

        return Model::make($query)
        ->filters($this->makeDataFilters)
        ->search($this->search)
        ->paginate($this->columns);
    }
    
    private function makeColumns(){

        $columns  = $this->columns();
        $this->makeFilters($columns);
        return $columns;

    }
    
    protected function columns(){

        return [];
    }
    
    protected function actions(){

        return [];
    }
    
    protected function headers(){

        return [];
    }
   
    public function confirm($id): void
    {
             
    }
    
    public function sortable(): void
    {
        if (method_exists($this, 'order')) {
            // if ($this->sortable) {
            //     $this->sortable = false;
            // }
            // else{
            //     $this->sortable = true;
            // }
        }
    }
    
    public function getCreateProperty()
    {
        $route = \Route::currentRouteName();

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    |  Features tableAttr
    |--------------------------------------------------------------------------
    | Inicia as configurações basica do table
    |
    */
    protected function tableAttr(): array
    {
        return [
           'tableTitle' => __('Lista'),
       ];
    }
    public function getCountColumnsProperty(){
        
        if($this->actions())
            return (collect($this->columns())->count() + 1);

        return collect($this->columns())->count();
    }
}

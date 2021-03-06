<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Report\Http\Livewire\Admin\Operacional\Reports;

use Tall\Table\TableComponent;

use Tall\Report\Http\Livewire\Traits\LivewireInfo;
use Tall\Table\Fields\Column;
use Tall\Table\Fields\Action;
use Tall\Table\Fields\Link;
use Tall\Table\Fields\Delete;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Report\Models\Report;

class ListComponent extends TableComponent
{
    use LivewireInfo;
    use AuthorizesRequests;
    
    public function mount()
    {
    
       $this->authorize(Route::currentRouteName());
    }

     /*
    |--------------------------------------------------------------------------
    |  Features route
    |--------------------------------------------------------------------------
    | Rota principal do crud, lista todos os dados
    |
    */
    public function route(){
        Route::get('/relatorios', static::class)->name('tall.report.admin.reports');
    }

    /*
    |--------------------------------------------------------------------------
    |  Features format_view
    |--------------------------------------------------------------------------
    | Inicia as configurações basica do de nomes e rotas
    |
    */
    public function format_view(){
        return "tall.report.admin.reports";
     }
     
    /*
    |--------------------------------------------------------------------------
    |  Features query
    |--------------------------------------------------------------------------
    | Rota para criar novo registro
    |
    */
    public function getCreateProperty()
    {
        return 'tall.report.admin.report.create';
    }

    /*
    |--------------------------------------------------------------------------
    |  Features query
    |--------------------------------------------------------------------------
    | Inicia a consulta ao banco de dados
    |
    */
    protected function query()
    {
        return Report::query();
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
           'tableTitle' => __('Relatorios'),
       ];
    }

    public function order(){
        return 0;
    }
    /*
    |--------------------------------------------------------------------------
    |  Features actions
    |--------------------------------------------------------------------------
    | Realacionado as ações de cada registro, como editar deletar e visualizar
    |
    */
    protected function actions(){

        return [
            Link::make('Gerenciar')->route('tall.report.admin.report.generate')->xs()->icon('cog')->succsess(),
            Link::make('Edit')->route('tall.report.admin.report.edit')->xs()->icon('pencil-alt')->primary(),
            Delete::make('Delete')->xs()->icon('trash')->negative(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Features columns
    |--------------------------------------------------------------------------
    | Configuração das colunas da tabel o cards de exibição
    |
    */
    protected function columns(){
        return [
            Column::make('Name')->searchable()->sortable()->makeInputText('name'),
            Column::make('Model','model'),
            Column::make('Created At')->format(function($model, $column){
                return $model->created_at->format('d/m/Y');
            })
            ->field('created_at_formatted')
            ->makeInputDatePicker('created_at'),
        ];
    }
}

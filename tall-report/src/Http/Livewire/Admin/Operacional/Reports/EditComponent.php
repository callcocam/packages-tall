<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Report\Http\Livewire\Admin\Operacional\Reports;

use Tall\Form\FormComponent;
use Tall\Report\Models\Report;
use Tall\Report\Traits\Exportable;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Tall\Report\Http\Livewire\Traits\LivewireInfo;

use Tall\Form\Fields\Input;
use Tall\Form\Fields\Select;
use Tall\Form\Fields\Radio;
use Tall\Form\Fields\NativeSelect;

class EditComponent extends FormComponent
{
    use LivewireInfo, AuthorizesRequests, Exportable;
    
     /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro vasio
    |
    */
    public function mount(?Report $model)
    {
        $this->authorize(Route::currentRouteName());
        
        $this->setFormProperties($model); // $relatorio from hereon, called $this->model
    }
    
     /*
    |--------------------------------------------------------------------------
    |  Features route
    |--------------------------------------------------------------------------
    | Rota principal do crud, lista todos os dados
    |
    */
    public function route(){
        Route::get('/relatorio/{model}/editar', static::class)->name('tall.report.admin.report.edit');
    }
     /*
    |--------------------------------------------------------------------------
    |  Features formAttr
    |--------------------------------------------------------------------------
    | Inicia as configurações basica do formulario
    |
    */
    protected function formAttr(): array
    {
        return [
           'formTitle' => __('Relatorio'),
           'formAction' => __('Edit'),
           'wrapWithView' => false,
           'showDelete' => false,
       ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Features fields
    |--------------------------------------------------------------------------
    | Inicia a configuração do campos disponiveis no formulario
    |
    */
    protected function fields(): array
    {
        return [
            Input::make('Nome do relatório', 'name')->span(3)->rules('required'),
            NativeSelect::make('Modelo','model')
            ->span(2)->options($this->tables())
            ->hint("O modelo se refere a uma tabela do banco de dados")
            ->rules('required'),
             Select::make('Modelos relacionados','foreigns_table')
            ->span(7)->multiselect()->value_options($this->tablesNames())
            ->hint("O modelo se refere a uma tabela do banco de dados")
            ->rules('required'),
            Input::make('Congelar Coluna','freeze_column')
            ->hint("ex: D Colunas A até C será fixada")
            ->placeholder("D")
            ->span(4),
            Input::make('Congelar Linha','freeze_row')->span(4)
            ->hint("ex: 2 A primeira linha será fixada")
            ->placeholder("1"),
            Input::make('Zoom Scala','zoom_scale') ->placeholder("150")->span(4),
            Radio::make('Status', 'status_id')->status()->lg()
        ];
    }
    
    /*
    |--------------------------------------------------------------------------
    |  Features saveAndGoBackResponse
    |--------------------------------------------------------------------------
    | Rota de redirecionamento apos a criação bem sucedida de um novo registro
    |
    */
     /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAndGoBackResponse()
    {
          return redirect()->route("tall.report.admin.reports");
    }
    
    /*
    |--------------------------------------------------------------------------
    |  Features goBack
    |--------------------------------------------------------------------------
    | Rota de retorno para a lista de dados
    |
    */
    public function goBack()
    {       
        return route("tall.report.admin.reports");
    }
    
}

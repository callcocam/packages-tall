<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Report\Http\Livewire\Admin\Operacional\Reports;

use Tall\Form\FormComponent;
//Http\Livewire\Traits\LivewireInfo.php
use Tall\Report\Http\Livewire\Traits\LivewireInfo;
use Tall\Report\Traits\Exportable;
use Tall\Report\Models\Report;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Tall\Form\Fields\Input;
use Tall\Form\Fields\Select;
use Tall\Form\Fields\Radio;
use Tall\Form\Fields\NativeSelect;

class CreateComponent extends FormComponent
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
        Route::get('/relatorioss', static::class)->name('tall.report.admin.report.create');
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
            NativeSelect::make('Modelo referente a uma tabela do banco de dados','model')
            ->span(3)->options($this->tables())
            ->hint("O modelo se refere a uma tabela do banco de dados")
            ->rules('required'),
            Input::make('Congelar Coluna','freeze_column')
            ->hint("ex: D Colunas A até C será fixada")
            ->placeholder("D")
            ->span(2),
            Input::make('Congelar Linha','freeze_row')->span(2)
            ->hint("ex: 2 A primeira linha será fixada")
            ->placeholder("1"),
            Input::make('Zoom Scala','zoom_scale') ->placeholder("150")->span(2),
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
          return redirect()->route("tall.report.admin.report.edit", $this->model);
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

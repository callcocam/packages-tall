<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Tenant\Http\Livewire\Admin\Tenants;

use Tall\Tenant\Models\Tenant;
use Tall\Form\FormComponent;
use Illuminate\Support\Facades\Route;
use Tall\Form\Fields\Input;
use Tall\Form\Fields\Radio;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ShowComponent extends FormComponent
{
    use AuthorizesRequests;

    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function mount(?Tenant $model)
    {
        $this->authorize(Route::currentRouteName());
        
        $this->setFormProperties($model); // $tenant from hereon, called $this->model
    }

     /*
    |--------------------------------------------------------------------------
    |  Features label
    |--------------------------------------------------------------------------
    | Label visivel no me menu
    |
    */
    public function route_name($sufix=null){
        return config('tenant.routes.tenants.show');
     }

     /*
    |--------------------------------------------------------------------------
    |  Features order
    |--------------------------------------------------------------------------
    | Order visivel no me menu
    |
    */
    public function model(){
        return app('currentTenant');
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
           'formTitle' => __('Tenant'),
           'formAction' => __('Show'),
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
            Input::make('Name')->rules('required'),
            Input::make('Domain')->span(3)->rules('required'),
            Input::make('Prefix')->span(2)->rules('required'),
            Input::make('Database')->span(3)->rules('required'),
            Input::make('Middleware')->span(2)->rules('required'),
            Input::make('Provider')->span(2)->rules('required'),
            Input::make('Codigo Postal','address.zip')->span(3)->rules('required'),
            Input::make('UF / Estado','address.state')->span(2)->rules('required'),
            Input::make('Cidade','address.city')->span(4)->rules('required'),
            Input::make('Bairro','address.district')->span(3)->rules('required'),
            Input::make('Endereço ** sem o número **','address.street')->span(6)->rules('required'),
            Input::make('Número','address.number')->span(2)->rules('required'),
            Input::make('Complemento','address.complement')->span(4),
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
          return route("admin");
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
        return route("admin");
    }
}

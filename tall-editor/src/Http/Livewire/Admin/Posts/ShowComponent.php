<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Editor\Http\Livewire\Admin\Posts;

use Tall\Editor\Models\Post;
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
    public function mount(?Post $model)
    {
        $this->authorize(Route::currentRouteName());
        
        $this->setFormProperties($model); // $editor from hereon, called $this->model
    }

     /*
    |--------------------------------------------------------------------------
    |  Features label
    |--------------------------------------------------------------------------
    | Label visivel no me menu
    |
    */
    public function route_name($sufix=null){
        return config('editor.routes.editors.show');
     }

     /*
    |--------------------------------------------------------------------------
    |  Features order
    |--------------------------------------------------------------------------
    | Order visivel no me menu
    |
    */
    public function model(){
        return app('currentEditor');
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
           'formTitle' => __('Editor'),
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
        return [];
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
        return config('editor.routes.editors.list');
    }
}

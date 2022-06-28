<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use App\Models\User;
use Tall\Form\FormComponent;
use Tall\Form\Fields\Input;
use Tall\Form\Fields\Radio;
use Tall\Form\Fields\Textarea;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateComponent extends FormComponent
{

    use AuthorizesRequests;
    use PasswordValidationRules;
    
    public $basic = false;

    /*
    |--------------------------------------------------------------------------
    |  Features route
    |--------------------------------------------------------------------------
    | Rota de criação de um novo cadastro
    |
    */
    public function route(){
        Route::get('/user/create', static::class)->name(config("acl.routes.users.create"));
    }
    
    /*
    |--------------------------------------------------------------------------
    |  Features format_view
    |--------------------------------------------------------------------------
    | Inicia as configurações basica do de nomes e rotas
    |
    */
    protected function view(){
        return "tall-forms::profile";
    }

    public function format_view(){
        return config("acl.routes.users.create");
     }
   /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro vasio
    |
    */
    public function mount(?User $model)
    {
        $this->authorize(Route::currentRouteName());   
        $this->setFormProperties($model); // $user from hereon, called $this->model
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
           'formTitle' => __('User'),
           'formAction' => __('Create'),
           'wrapWithView' => false,
           'showDelete' => false,
       ];
    }

    protected function success(){

        $this->data['password'] =  Hash::make($this->data['password']);  
        return parent::success();
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
            Input::make('Name')->rules('required')->placeholder('Your Name')->icon('user'),
            Input::make('Email')->rules('required')->placeholder('Your best email')->icon('mail-open'),
            Input::make('New Password', 'password')->rules($this->passwordRules())->placeholder('New Password')->icon('key'),
            Input::make('Password Confirmation', 'password_confirmation')->rules('required')->placeholder('Password Confirmation')->icon('key'),
            Textarea::make('Observations', 'description.preview')
            ->hint('Brief description for your profile. URLs are hyperlinked.')
            ->field('description_preview')->placeholder('Observations'),
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
    public function saveAndGoBackResponse()
    {
        return redirect()->route(config("acl.routes.users.edit"),$this->model);
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
        return route(config("acl.routes.users.list"));
    }
}

<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Operacional\Users;

use App\Models\User;
use Tall\Form\FormComponent;
use Tall\Form\Fields\Input;
use Tall\Form\Fields\Textarea;
use Tall\Form\Fields\Photo;
use Tall\Form\Fields\Select;
use Tall\Form\Fields\DatetimePicker;
use Tall\Form\Fields\Radio;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    use PasswordValidationRules;

    public $basic = true;
    
    /*
    |--------------------------------------------------------------------------
    |  Features route
    |--------------------------------------------------------------------------
    | Rota de edição de um cadastro
    |
    */
    public function route(){
        Route::get('/user/{model}/edit', static::class)->name(config("acl.routes.users.edit"));
    }

    protected function view(){
        return "tall-acl::livewire.profile";
    }
    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
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
           'formAction' => __('Edit'),
           'wrapWithView' => false,
           'showDelete' => false,
       ];
    }

    protected function success(){
        
        $input['password'] =  $this->clearIsNull("new_password");
        $input['current_password'] =$this->clearIsNull("current_password");
        $input['password_confirmation'] =$this->clearIsNull("password_confirmation");    
        if(parent::success()){
            if(collect($input)->filter(function($item){
                return !is_null($item);
            })->count()){
                $user = $this->model;
                Validator::make($input, [
                    'current_password' => ['required', 'string'],
                    'password' => $this->passwordRules(),
                ])->after(function ($validator) use ($user, $input) {

                    if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
                        $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
                    }
                })->validate();       

                $user->forceFill([
                    'password' => Hash::make($input['password']),
                ])->save();

                $input['password'] =  "";
                $input['current_password'] = "";
                $input['password_confirmation'] =""; 
                
                $this->data['password'] =""; 
                $this->data['current_password'] =""; 
                $this->data['password_confirmation'] =""; 

            }
        }
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
            Input::make('Phone')->placeholder('Your best phone')->icon('mail-open'),
            DatetimePicker::make('Birth Date')->icon('mail-open'),
            // Select::make('Instituicão','instituicao_id')
            // ->options(\App\Models\Instituicao::query()->pluck('name','id')->toArray())
            // ->placeholder('==Selecione o Instituicão==')->icon('mail-open'),
            // Select::make('Cargo','office_id')
            // ->options(\App\Models\Office::query()->pluck('name','id')->toArray())
            // ->placeholder('==Selecione o cargo==')->icon('mail-open'),
            Input::make('Registro Geral - Rg','rg')->placeholder('RG')->icon('mail-open'),
            Input::make('Cadastro de pessoa fisíca - CPF','cpf')->placeholder('CPF')->icon('mail-open'),
            Input::make('Current Password')->placeholder('Current Password')->icon('key'),
            Input::make('New Password', 'new_password')->placeholder('New Password')->icon('key'),
            Input::make('Password Confirmation', 'password_confirmation')->placeholder('Password Confirmation')->icon('key'),
            Photo::make('Photo','profile_photo_path')->placeholder('Photo'),
            Textarea::make('Observations', 'description.preview')
            ->hint('Brief description for your profile. URLs are hyperlinked.')
            ->field('description_preview')->placeholder('Observations'),
            Radio::make('Status', 'status_id')->status()->lg()
        ];
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

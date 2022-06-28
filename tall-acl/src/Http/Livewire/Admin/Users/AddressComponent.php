<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use App\Models\Address;
use App\Models\User;
use Tall\Form\FormComponent;
use Tall\Form\Fields\Input;
use Tall\Form\Fields\Textarea;
use Illuminate\Support\Facades\Route;

class AddressComponent extends FormComponent
{

    public function mount(?User $model)
    {
        //Gate::authorize()
        $this->setFormProperties($model->address()->firstOrCreate()); // $user from hereon, called $this->model
    }

    protected function view(){
        return "tall-acl::livewire.address";
    }
    protected function formAttr(): array
    {
        return [
           'formTitle' => __('User Address'),
           'wrapWithView' => false,
           'showDelete' => false,
       ];
    }

    protected function fields(): array
    {
        return [           
            Input::make('Postal code','zip')->rules('required')->placeholder('Postal code'),
            Input::make('State')->rules('required')->placeholder('State'),
            Input::make('City')->rules('required')->placeholder('City'),
            Input::make('Street')->rules('required')->placeholder('Street'),
            Input::make('District')->rules('required')->placeholder('District'),
            Input::make('Number')->rules('required')->placeholder('Number'),
            Input::make('Complement')->placeholder('Complement'),
            Input::make('Country')->placeholder('Country'),
            Textarea::make('Observations', 'description.preview')
            ->field('description_preview')->placeholder('Observations')
        ];
    }
}

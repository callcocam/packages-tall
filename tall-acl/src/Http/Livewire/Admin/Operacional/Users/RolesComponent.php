<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Operacional\Users;

use App\Models\User;
use Tall\Form\FormComponent;
use Tall\Form\Fields\Checkboxs;
use Illuminate\Support\Facades\Route;

class RolesComponent extends FormComponent
{

    public function mount(?User $model)
    {
        //Gate::authorize()

        $this->setFormProperties($model); // $user from hereon, called $this->model
       
    }

    protected function view(){
        return "tall-forms::roles";
    }
    protected function formAttr(): array
    {
        return [
           'formTitle' => __('User Roles'),
           'wrapWithView' => false,
           'showDelete' => false,
       ];
    }

    public function success()
    { 
        $this->model->roles()->sync(data_get($this->data,'access'));
    }
    protected function fields(): array
    {
        $query = \Tall\Acl\Models\Role::query();
        if($checkboxSearch = \Arr::get($this->checkboxSearch, 'access')){
            $query->where("name", "LIKE", "%{$checkboxSearch}%");
        }
        
        $options = $query->get();

        return [           
            Checkboxs::make('Roles','access')->collect($options)->rules('required'),
        ];
    }
}

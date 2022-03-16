<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form;
use Livewire\Component;
use Tall\Form\Traits\Galleries;
use Tall\Form\Traits\Uploads;
use Tall\Form\Traits\FollowsRules;
use Tall\Form\Traits\Message;
use Tall\Form\Traits\Relationship;
use WireUi\Traits\Actions;
use Tall\Form\Fields\Editor;
use Tall\Form\Fields\Gallery;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Tall\Form\Fields\Submit;
use Illuminate\Support\Facades\Route;

abstract class FormComponent extends Component
{
    use FollowsRules,Actions, Message, Uploads, Galleries, Relationship, WithFileUploads;

    public $files = [];
    public $data = [];
    public $checkboxSearch = [];
    public $model;
    protected $layout = "app";

   protected function view(){
        if(function_exists("formView")){
            return formView();
        }
       return "tall-forms::form";
   }
   

   protected function layout(){
    if(function_exists("theme_layout")){
        return theme_layout($this->layout);
     }
     return config('tall-forms.layout');
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
           'formTitle' => __('Form'),
       ];
    }

   protected function fields(): array{
      
    return [];
    }
   
   protected function buttoms(){
        return [
            Submit::make('Save Or Change')->icon('check')->primary()
        ];
    }

    public $listeners = [
        Editor::EVENT_VALUE_UPDATED, // trix_value_updated()
        Gallery::EVENT_VALUE_UPDATED, // trix_value_updated()
    ];

    public function editor_value_updated($value, $field){
      \Arr::set($this->data,\Str::afterLast($field, "data."), $value);
    }

    public function gallery_value_updated($value){
     
    }

    /**
     * @param null $model
     */
    protected function setFormProperties($model = null)
    {
        $this->model = $model;
        if ($model) {
            $this->data = $model->toArray();
        } else if (is_array($model)) {
            $this->data = $model;
        }
        foreach ($this->fields() as $field):           
            if(!\Str::contains($field->name,'.')){
                if (!isset($this->data[$field->name])):
                    $array = in_array($field->type, ['checkbox', 'file']);
                    if (in_array($field->type, ['file'])) {
                        if ($this->data[$field->name] = $model->{$field->name}) {
                           if($files = \Arr::get($model, $field->name)){
                                if(!is_string($files)){
                                    foreach($files as $file){
                                        $this->data[$field->name][] = $file;
                                    }
                                }else{
                                    $this->data[$field->name] = $files;
                                }
                            }
                        }
                    }
                     else {
                        $this->data[$field->name] = $field->default ?? ($array ? [] : null);
                    }
                else:
                    // if(is_array($this->data[$field->name])){
                    //     dd($field->name,$this->data[$field->name]);
                    // }
                endif;
            }
        endforeach;
    }
    
    public function render(){
      
        return view($this->view())
        ->with([
            'formAttr'=>$this->formAttr(),
            'fields'=>$this->makeFields(),
            'buttoms'=>$this->buttoms(),
        ])
        ->layout($this->layout());
    }

    protected function makeFields()
    {
        $fields = [];
        foreach ($this->fields() as $field) $fields[$field->field] = $field;   
        return $fields;

    }
    protected function submit(){
        if ($this->rules())
            $this->validate($this->rules());
            // $field_names = [];
            // foreach ($this->fields() as $field) $field_names[] = $field->name;         
            // $this->data = \Arr::only($this->data, $field_names);
            return $this->success();
    }
    protected function success(){
  
        if ($this->model->exists) {
            try {
                if($this->model->update($this->data)){
                    $this->relationship($this->model, $this->data);
                    $this->uploadPhoto();
                    $this->notification()->success(
                        $title = __('saved'),
                        $description = $this->successUpdate($this->model)
                    );
                    return true;
                }
                return false;
            } catch (\PDOException $PDOException) {
                $this->notification()->error(
                    $title = 'Error !!!',
                    $description = $this->errorUpdate($PDOException->getMessage())
                );
                return false;
            }
        } else {
            try {
                $this->model = $this->model->create($this->data);
                if ($this->model->exists) {
                    $this->relationship($this->model, $this->data);
                    $this->uploadPhoto();
                    $this->notification()->success(
                        $title = __('saved'),
                        $description = $this->successCreate($this->model)
                    );              
                    return $this->saveAndGoBackResponse();
                }
                return false;
            } catch (\PDOException $PDOException) {
                $this->notification()->error(
                    $title = 'Error !!!',
                    $description = $this->errorCreate($PDOException->getMessage())
                );
                return false;
            }

        }

    }

    protected function makeField($name)
    {
       return \Arr::get($this->makeFields(), $name);
    }
   
    public function getCreateProperty()
    {
        if(\Str::contains(\Route::currentRouteName(), 'edit'))
            return \Str::replace('edit', 'create', \Route::currentRouteName());
        return null;
    }
    
    /**
     * Salvar e ir para outra view
     */
    public function saveAndStay()
    {
        $this->submit();
        
    }

    /**
     * Salvar e ir para outra view
     */
    public function saveAndEditStay()
    {
        if ($this->submit())
            return $this->saveAndStayResponse();
            // or use a full syntax
      
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAndStayResponse()
    {
        return $this->saveAndGoBackResponse();
    }

    /**
     *
     */
    public function saveAndGoBack()
    {
        if ($this->submit()) {
            return $this->saveAndGoBackResponse();
        }

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAndGoBackResponse()
    {
         return true;

    }

    public function goBack()
    {
       
        return false;
    }

    protected function clearIsNull($field, $default = null)
    {
        if($default = \Arr::get($this->data, $field)){
            return $default;
        }

        if($default){
          $this->data[$field] = $default;
          return $this;
        }
        if(\Arr::has($this->data,$field)){
            $default =$this->data[$field];
            unset($this->data[$field]);
        }       
        return  $default;
    }
}

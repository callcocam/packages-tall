<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form;
use Livewire\Component;
use Tall\Form\Traits\FollowsRules;

abstract class FormModalComponent extends Component
{
    use FollowsRules;

    public $data = [];
    public $model;

   protected function view(){
       return "tall-forms::form-modal";
   }
   
   protected function fields(){
    return [];
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
    }
    
    public function render(){
        return view($this->view())
        ->with([
            'fields'=>$this->fields()
        ])
        ->layout(config('tall-forms.form.layout'));
    }

    protected function submit(){
        if ($this->rules())
            $this->validate($this->rules());

            dd("AQ");
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

    }
}

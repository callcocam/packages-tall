<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Report\Http\Livewire\Admin\Reports;

use Tall\Form\FormComponent;

use Tall\Report\Http\Livewire\Traits\LivewireInfo;

class EditComponent extends FormComponent
{
    use LivewireInfo;
    
    public function render()
    {
        return view('livewire.admin.reports.edit-component');
    }
}

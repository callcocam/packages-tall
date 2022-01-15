<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Trix extends Component
{
    use WithFileUploads;

    public $hint;
    public $name;
    public $value;
    public $field;
    public $placeholder;
    public $trixId;
    public $photos = [];

    public function mount($fields,$value = ''){
        $this->value = $value;
        $this->fields = $field->key;
        $this->placeholder = $field->placeholder;
        $this->hint = $field->hint;
        $this->name = $field->name;
        $this->trixId = 'trix-' . uniqid();
    }

    public function updatedValue($value){
        $this->emit(\Tall\Form\Fields\Editor::EVENT_VALUE_UPDATED, $this->value, $this->field);
    }

    public function completeUpload(string $uploadedUrl, string $trixUploadCompletedEvent){

        foreach($this->photos as $photo){
            if($photo->getFilename() == $uploadedUrl) {
                // store in the public/photos location
                $newFilename = $photo->store('photos/trix');
            
                // get the public URL of the newly uploaded file
                $url = Storage::url($newFilename);

                $this->dispatchBrowserEvent($trixUploadCompletedEvent, [
                    'url' => $url,
                    'href' => $url,
                ]);
            }
        }
    }

    public function render()
    {
        return view('tall-forms::livewire.trix');
    }
}
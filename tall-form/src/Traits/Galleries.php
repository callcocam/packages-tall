<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Form\Traits;
use Illuminate\Http\UploadedFile;

trait Galleries{

    public $galleries = [];

    public function updatedGalleries($uploaded_files, $field_name)
    {      
        if($uploaded_files && is_array($uploaded_files)){                   
            $collection =collect(\Arr::get($this->data, sprintf('%s.galeria_items',$field_name),[]));
            $exts = ["B", "kB", "MB", "GB", "TB"];
            $field = $this->makeField($field_name);
            try {
                foreach ($uploaded_files as $index => $file) {
                    $collection->push($field->updateFile($file,$field_name, $collection->count()));                   
                }                
                \Arr::set($this->data, sprintf('%s.galeria_items',$field_name), $collection->toArray());
            } catch (\Throwable $th) {
                dd($th );
            }
        }
    }

    public function ordemGalleries($fileDropping, $fileDragging, $field_name, $id=null){
        $collection =collect(\Arr::get($this->data, $field_name,[]));
        $removed = $collection->splice($fileDragging, 1);
        $collection->splice($fileDropping,0, $removed);
        $data = $collection->toArray();
        foreach ($data as $key => $value) {
           if($file = \App\Models\GaleriaItem::find(data_get($value, 'id'))){
               $file->ordering = $key;
               $file->save();
           }
        }
        \Arr::set($this->data, $field_name, $collection->toArray());
    }

    public function loadGalleriesItem(){
     
    }


    public function removeGalleriesItem($fileDragging, $field_name){
        $collection =collect(\Arr::get($this->data, $field_name,[]));
        $removed = $collection->splice($fileDragging, 1)->first();
        if($removed){           
            if($file = \App\Models\GaleriaItem::find(data_get($removed, 'id'))){
                $file->delete();
                \Storage::disk($this->imageDisk())->delete(\Arr::get($removed,"source"));
            }
        }
        \Arr::set($this->data, $field_name, $collection->toArray());
    }


    public function fileIcon($mime_type)
    {
        $icons = [
            'image' => 'fa-file-image',
            'audio' => 'fa-file-audio',
            'video' => 'fa-file-video',
            'application/pdf' => 'fa-file-pdf',
            'application/msword' => 'fa-file-word',
            'application/vnd.ms-word' => 'fa-file-word',
            'application/vnd.oasis.opendocument.text' => 'fa-file-word',
            'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fa-file-word',
            'application/vnd.ms-excel' => 'fa-file-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fa-file-excel',
            'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-excel',
            'application/vnd.ms-powerpoint' => 'fa-file-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml' => 'fa-file-powerpoint',
            'application/vnd.oasis.opendocument.presentation' => 'fa-file-powerpoint',
            'text/plain' => 'fa-file-alt',
            'text/html' => 'fa-file-code',
            'application/json' => 'fa-file-code',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fa-file-word',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fa-file-excel',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'fa-file-powerpoint',
            'application/gzip' => 'fa-file-archive',
            'application/zip' => 'fa-file-archive',
            'application/x-zip-compressed' => 'fa-file-archive',
            'application/octet-stream' => 'fa-file-archive',
        ];

        if (isset($icons[$mime_type])) return $icons[$mime_type];
        $mime_group = explode('/', $mime_type, 2)[0];

        return (isset($icons[$mime_group])) ? $icons[$mime_group] : 'fa-file';
    }
     /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function imageDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('siga.image_disk', 'public');
    }
  
}
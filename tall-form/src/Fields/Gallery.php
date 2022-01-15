<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Fields;

use Tall\Form\Field;
use Illuminate\Http\UploadedFile;
use Tall\Form\Fields\Input;
use Tall\Form\Fields\Textarea;

class Gallery extends Field
{
    protected $data_name = 'galleries';
    protected $attribute = 'gallery';
    protected $type = 'gallery';
    protected $multiple = true;
    protected $accepts = ['galleries'];
    protected $array_fields = [];
    protected $title;
    protected $description;
    protected $ordering;


    const EVENT_VALUE_UPDATED = 'gallery_value_updated';

    public function __construct($label, $name){

        if(is_null($name)){
           $name = \Str::slug($label, "_");
        }
        $this->field = $name;
        $this->name = $name;
        $this->label = __($label);
        $this->key = sprintf("%s.%s", $this->data_name, $name);
        $this->attribute = sprintf("%s.galeria_items",  $name);
      
        $this->title( Input::make('Titulo da galleria',sprintf('%s.name', $name ))->placeholder('Title'));
        $this->ordering( Input::make('Ordem galleria',sprintf('%s.ordering', $name ))->placeholder('Ordering'));
        $this->description( Textarea::blank(sprintf('%s.description', $name ))->placeholder('Description'));
    }

    public function attribute($attribute){
        $this->attribute = $attribute;
        return $this;
    }

    public function title($title){
        $this->title = $title;
        return $this;
    }

    public function description($description){
        $this->description = $description;
        return $this;
    }

    public function ordering($ordering){
        $this->ordering = $ordering;
        return $this;
    }

    public function multiple(){
        $this->multiple = true;
        return $this;
    }

    public function updateFile($file,$field_name,$count){
        $nameFile = \Str::beforeLast($file->getClientOriginalName(), '.');
        $nameFile = \Str::slug($nameFile);
        $nameFile = sprintf("%s.%s", $nameFile,$file->getClientOriginalExtension());
        $storage_disk = $this->imageDisk();
        $i = floor(log($file->getSize()) / log(1024));
        $num =  ($file->getSize() / pow(1024, $i)) * 1;
        $size = floor($num);
        $ext = "";
        if(isset($exts[intval($i)])){
            $ext = ["B", "kB", "MB", "GB", "TB"][intval($i)];
        }
        $files = [
            'source' => $file->storePubliclyAs(str_replace(".","/",$field_name), $nameFile, ['disk' => $storage_disk]),
            'disk' => $storage_disk,
            'name' => $file->getClientOriginalName(),
            'size' => $size . ' '. $ext,
            'mime_type' => $file->getMimeType(),
            'ordering' => $count,
        ];
        return $files;
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

    public function array_fields($array_fields){

        if(is_array($array_fields)){
            foreach($array_fields as $array_field):
                $array_field->key(sprintf("%s.galeria_infos.%s", $array_field->data_name, $array_field->name));
                 $this->array_fields[] = $array_field;
            endforeach;
            return $this;
        }
        $array_fields->key(sprintf("%s.galeria_infos.%s", $array_fields->data_name, $array_fields->name));
        $this->array_fields[] = $array_fields;
        return $this;
    }

    public function defaul_array_fields(){
            $this->array_fields([
                Input::blank('title')->field("title")->placeholder('Title'),
                Input::blank('link')->field("link")->placeholder('https://'),
            ]);
        return $this;
    }
}

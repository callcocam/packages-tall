<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Form\Models\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

trait HasGallery
{

    /**
     * Get the URL to the user's profile file.
     *
     * @return string
     */
    public function getGalleriesAttribute()
    {
        $data = null;
        if($gallery = $this->gallery){
              $dataItems=[];
              if($items = $gallery->galeria_items){
              
                foreach($items as $item){                
                    $dataItems[] = $this->items($item);
               }
              }               
              $data = [
                'id' => $gallery->id,
                'name' => $gallery->name,
                'description' => $gallery->description,
                'ordering' => $gallery->ordering,
                'galeria_items' => $dataItems,
              ];
        }
        return $data;
    }

    protected function items($item){
      return [
        'id' => $item->id,
        'source' =>$item->source,
        'disk' => $item->disk,
        'name' => $item->name,
        'size' => $item->size,
        'mime_type' => $item->mime_type,
        'ordering' => $item->ordering,
        'galeria_infos' =>  $this->infos($item),
      ];
    }

    protected function infos($item){
      $item_infos = [];
      if($infos = $item->galeria_infos){
          foreach($infos as $info){
              $item_infos[] = [
                  'id' => $info->id,
                  'name' => $info->name,
                  'type' => $info->type,
                ];
          }
        }

        return $item_infos;
    }
    /**
     * Get the disk that profile files should be stored on.
     *
     * @return string
     */
    protected function galleryDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('siga.image_disk', 'public');
    }

    public function galleries()
    {
      return $this->morphOne(\Tall\Form\Models\Galeria::class, 'galleryable')->orderBy('ordering');
    }

    public function gallery()
    {
      return $this->morphOne(\Tall\Form\Models\Galeria::class, 'galleryable')->orderBy('ordering');
    }

}

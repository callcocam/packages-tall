<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Tall\Form\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use App\Models\Traits\HasCover;
use App\Models\AbstractModel;

class GalleryItem  extends AbstractModel
{
  use HasFactory;
  //use HasCover;

  protected $guarded = ["id"];
  
  protected $with = ['gallery_infos'];

  public function gallery_infos(){
    return $this->hasMany(GalleryInfo::class);
  }
}

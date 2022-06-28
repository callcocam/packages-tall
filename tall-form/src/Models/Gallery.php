<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Tall\Form\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use App\Models\Traits\HasCover;

class Gallery  extends AbstractModel
{
  use HasFactory;
  //use HasCover;

  protected $guarded = ["id"];

  /**
   * Get the parent galleryable model (user or tenant).
   */

  public function galleryable()
  {
      return $this->morphTo();
  }

  public function gallery_items()
  {
    return $this->hasMany(GalleryItem::class);
  }
}

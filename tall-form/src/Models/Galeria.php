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

class Galeria  extends AbstractModel
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

  public function galeria_items()
  {
    return $this->hasMany(GaleriaItem::class);
  }
}

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

class GaleriaInfo  extends AbstractModel
{
  use HasFactory;
  //use HasCover;

  protected $guarded = ["id"];

  public function galeria_item(){
    return $this->hasOno(GaleriaItem::class);
  }
}

<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Tall\Form\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tall\Tenant\Scopes\UuidGenerate;
use Tall\Form\Sluggable\SlugOptions;
use Tall\Form\Sluggable\HasSlug;
use Tall\Tenant\Concerns\UsesLandlordConnection;

class AbstractModel extends Model
{
    use HasFactory, HasSlug, UsesLandlordConnection, UuidGenerate, SoftDeletes;
    
    protected $guarded = ['id'];
    
    public $incrementing = false;

    protected $keyType = "string";

    
    protected function slugTo()
    {
        return "slug";
    }

    protected function slugFrom()
    {
        return 'name';
    }

    public function isUser()
    {
        return true;
    }

    public function getSlugOptions()
    {
        if (is_string($this->slugTo())) {
            return SlugOptions::create()
                ->generateSlugsFrom($this->slugFrom())
                ->saveSlugsTo($this->slugTo());
        }
    }

}

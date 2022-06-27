<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Tall\Form\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model as AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tall\Form\Scopes\UuidGenerate;
use Tall\Form\Sluggable\SlugOptions;
use Tall\Form\Sluggable\HasSlug;

class Status extends AbstractModel
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

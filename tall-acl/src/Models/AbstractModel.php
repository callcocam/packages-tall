<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tall\Tenant\Scopes\UuidGenerate;
use Tall\Form\Models\Status;
use Tall\Form\Sluggable\SlugOptions;
use Tall\Form\Sluggable\HasSlug;

abstract class AbstractModel extends Model
{
    use  SoftDeletes, HasSlug, UuidGenerate;
    
    public $incrementing = false;

    protected $keyType = "string";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function statuses(){
        return $this->belongsTo(Status::class);
    }

   
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
        return false;
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
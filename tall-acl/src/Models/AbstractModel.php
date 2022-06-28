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

abstract class AbstractModel extends Model
{
    use  SoftDeletes, UuidGenerate;
    
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

    public function isUser()
    {
        return false;
    }
}
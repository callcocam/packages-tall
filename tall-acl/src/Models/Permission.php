<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tall\Acl\Concerns\RefreshesPermissionCache;
use Tall\Tenant\Concerns\UsesLandlordConnection;

class Permission extends AbstractModel implements \Tall\Acl\Contracts\Permission
{
    use RefreshesPermissionCache, UsesLandlordConnection, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Permissions can belong to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(config('acl.models.role'))->withTimestamps();
    }

}

<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Tall\Acl\Concerns\HasRolesAndPermissions;

class User extends AbstractModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail,  HasRolesAndPermissions;

    protected $appends = ['access'];
 
    public function getAccessAttribute()
    {
        $roles = $this->roles()->pluck("id", "id")->toArray();
        
        return $roles;
    }

    public function scopeRoles($query, $term)
    {
        return $query->whereHas('roles', function ($builder) use ($term) {
            $builder->where('id', $term);
        });
    }

    public function isUser(){
        return false;
    }
}

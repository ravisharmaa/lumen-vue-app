<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class AppUsers extends Model
{
    protected $primaryKey = 'UserId';
    protected $table = 'AppUsers';
    public $timestamps = false;

    public function scopeFilter($query, $filter)
    {
        is_null($filter) ? $this->all() : $query->where('ActiveFlag', $filter);
    }
}

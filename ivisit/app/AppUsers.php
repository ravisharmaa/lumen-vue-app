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

    protected $guarded = [];

    public function scopeFilter($query, $filter)
    {
        return is_null($filter) ? self::all() : $query->where('ActiveFlag', $filter)->get();
    }
}

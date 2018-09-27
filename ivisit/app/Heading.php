<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Heading extends Model
{
    protected $table = 'tbl_iSurveyHeading';
    public $timestamps = false;




    protected $guarded = [];

    public function surveys()
    {
        return $this->hasMany(Survey::class,'headingid');
    }

    public function addSurvey($survey)
    {
        return $this->surveys()->create($survey);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $primaryKey = 'QId';
    protected $table = 'tbl_iSurveyQuestion';
    public $timestamps = false;

    protected $with = ['heading'];

    protected $guarded = [];


    public function heading()
    {
        return $this->belongsTo(Heading::class,'headingid');
    }
}

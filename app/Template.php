<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $primaryKey = 'templateId';
//    public $appends = ['tags'];
//
//    public function getTagsAttribute() {
//        return  $this->attributes['tags'] == 'yes';
//    }
}


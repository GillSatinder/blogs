<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = 'tagId';
    protected $fillable  = ['tagId', 'templateId', 'name'];

    public function templates() {
        return $this->belongsTo(Template::class);
    }

}

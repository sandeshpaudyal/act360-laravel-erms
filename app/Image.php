<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table='images';
    protected $fillable = [
        'image', 'imageable_id','imageable_type','path','meta'
    ];

    protected $appends = ['url'];

    public function imageable() {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return 'storage/'.$this->path;
    }
}

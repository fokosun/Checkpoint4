<?php

namespace Techademia;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'description', 'url', 'user_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo('Techademia\Category');
    }
}

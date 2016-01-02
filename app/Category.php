<?php

namespace Techademia;

use Techademia\Video;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    public function video()
    {
        return $this->belongsTo('Techademia\Video');
    }
}

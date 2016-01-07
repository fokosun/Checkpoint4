<?php

namespace Techademia;

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

    public function videos()
    {
        return $this->hasMany('Techademia\Video');
    }
}

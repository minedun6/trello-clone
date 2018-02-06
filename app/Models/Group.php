<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    protected $with = ['stories'];

    protected $withCount = ['stories'];

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}

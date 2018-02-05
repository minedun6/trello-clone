<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function scopeOrderedStories($query)
    {
        return $query->with(['stories' => function ($q) {
            return $query->orderBy('rank');
        }]);
    }
}

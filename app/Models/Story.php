<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $guarded = [];

    protected $dates = ['due_date'];

    public static function boot()
    {
        static::creating(function ($model) {
            // the model reflects $this
            $model->rank = $model->group->stories()->max('rank') + 1;
        });

        static::addGlobalScope('orderedStories', function (Builder $builder) {
            $builder->orderBy('rank', 'asc');
        });

    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
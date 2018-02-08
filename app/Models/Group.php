<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    protected $with = ['stories'];

    protected $withCount = ['stories'];

    protected $classes = ['red', 'blue', 'purple', 'green', ];

    public static function boot()
    {
        self::creating(function ($model) {
            $model->order = $model->max('order') + 1;
            $model->color_class = '';
        });

        self::created(function ($model) {
            $model->load('stories');
        });

        static::addGlobalScope('orderedGroups', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}

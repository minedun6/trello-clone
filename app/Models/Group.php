<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    protected $with = ['stories'];

    protected $withCount = ['stories'];

    public static function boot()
    {
        self::creating(function ($model) {
            // the model reflects $this
            $model->order = $model->max('order') + 1;
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

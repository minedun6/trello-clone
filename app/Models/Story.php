<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use \Spatie\Tags\HasTags;

class Story extends Model implements HasMedia
{
    use HasMediaTrait,
        HasTags;

    protected $guarded = [];

    protected $dates = ['due_date'];

    protected $with = ['media', 'tags', 'members'];

    protected $withCount = ['media', 'tags', 'members'];

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

    public function members()
    {
        return $this->belongsToMany(User::class, 'story_user', 'story_id', 'member_id');
    }
}

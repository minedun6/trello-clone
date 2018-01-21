<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    protected $guarded = [];

    protected $dates = ['due_date'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'web_jobs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'branch',
        'tags',
        'active',
        'color',
    ];

    public function getTagsAttribute()
    {
        return explode(':', $this->attributes['tags']);
    }
}

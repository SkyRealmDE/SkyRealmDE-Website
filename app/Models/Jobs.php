<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model {

    protected $table = 'web_jobs';

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'branch',
        'tags',
        'active',
        'color'
    ];

    // tag1:tag2:tag3
    public function getTagsAttribute() {
        return explode(':', $this->attributes['tags']);
    }

}

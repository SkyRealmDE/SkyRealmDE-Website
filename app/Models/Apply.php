<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model {

    protected $fillable = [
        'name',
        'discord',
        'mail',
        'job',
        'title',
        'attachments',
        'color',
        'about',
        'time'
    ];

}

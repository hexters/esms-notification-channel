<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description',
        'slug',
        'state',
        'type',
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];
}


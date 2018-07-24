<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;

    class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
    ];

}
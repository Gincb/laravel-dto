<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;


class Author extends Model
{
    protected $fillable = [
      'first_name',
      'last_name',
    ];
}

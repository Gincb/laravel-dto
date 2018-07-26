<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Author
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $first_name
 * @property string $last_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Author extends Model
{
    protected $fillable = [
      'first_name',
      'last_name',
    ];
}

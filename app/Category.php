<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;

    /**
 * App\Category
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $title
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $reference_category_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereReferenceCategoryId($value)
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'reference_category_id'
    ];

}

<?php

declare(strict_types =1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Article
 *
 * @mixin \Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $title
 * @property string $description
 * @property string $slug
 * @property int|null $author_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUpdatedAt($value)
 * @property-read \App\author|null $authors
 */
class Article extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'author_id'];

    public function authors():BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function categories(): BelongsToMany
{
    return $this->belongsToMany(Category::class);
}
}


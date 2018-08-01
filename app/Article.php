<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @property-read \App\Author|null $authors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property int|null $reference_author_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereReferenceAuthorId($value)
 * @property int|null $reference_article_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereReferenceArticleId($value)
 */
class Article extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'author_id', 'reference_article_id'];

    public function authors(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}


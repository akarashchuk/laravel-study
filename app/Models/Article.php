<?php

namespace App\Models;

use App\Observers\ArticleObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property User $user
 * @property Category[] $categories
 */
class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'text',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function boot(): void
    {
        parent::boot();

        self::observe(ArticleObserver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_categories');
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', 'published');
    }

//    public function scopeStatus(Builder $query, string $status)
//    {
//        return $query->where('status', $status);
//    }

    protected function shortDescription(): Attribute
    {
        return Attribute::make(get: function ($value, $attributes) {
            return mb_strcut($attributes['text'], 0, 20) . '...';
        });
    }
}

<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'article_text'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return string
     */
    public function getCategoriesLinksAttribute(): string
    {
        $categories = $this->categories()->get()->map(function ($category) {
            return '<i>' . $category->name . '</i>';
        })->implode(' | ');

        if ($categories == '') return 'none';

        return $categories;
    }

    /**
     * @return string
     */
    public function getTagsLinksAttribute(): string
    {
        $tags = $this->tags()->get()->map(function ($tag) {
            return '<i>' . $tag->name . '</i>';
        })->implode(' | ');

        if ($tags == '') return 'none';

        return $tags;
    }

}


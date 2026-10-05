<?php

namespace Modules\ProdukInovasi\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsCategory extends Model
{
    protected $fillable = ['nama', 'slug'];

    protected static function booted()
    {
        static::creating(function (NewsCategory $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->nama);
            }
        });
    }

    public function news()
    {
        return $this->hasMany(News::class, 'news_category_id');
    }
}

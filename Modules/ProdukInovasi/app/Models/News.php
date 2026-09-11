<?php

namespace Modules\ProdukInovasi\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'gambar_sampul',
        'ringkasan',
        'konten',
        'status',
        'created_by',
    ];

    protected static function booted()
    {
        static::creating(function (News $news) {
            if (empty($news->slug)) {
                $news->slug = static::generateUniqueSlug($news->judul);
            }
        });

        static::updating(function (News $news) {
            if ($news->isDirty('judul') && empty($news->getOriginal('slug'))) {
                $news->slug = static::generateUniqueSlug($news->judul, $news->id);
            }
        });
    }

    public static function generateUniqueSlug(string $judul, $ignoreId = null): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

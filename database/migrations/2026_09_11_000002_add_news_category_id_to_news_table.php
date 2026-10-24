<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->foreignId('news_category_id')->nullable()->after('kategori')
                ->constrained('news_categories')->nullOnDelete();
        });

        // Pindahkan data kategori lama (teks bebas) jadi baris di news_categories,
        // supaya berita yang sudah ada tidak kehilangan kategorinya.
        $existing = DB::table('news')->whereNotNull('kategori')->distinct()->pluck('kategori');

        foreach ($existing as $namaKategori) {
            $namaKategori = trim($namaKategori);
            if ($namaKategori === '') {
                continue;
            }

            $categoryId = DB::table('news_categories')->where('nama', $namaKategori)->value('id');

            if (!$categoryId) {
                $categoryId = DB::table('news_categories')->insertGetId([
                    'nama' => $namaKategori,
                    'slug' => Str::slug($namaKategori),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('news')->where('kategori', $namaKategori)->update(['news_category_id' => $categoryId]);
        }

        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('slug');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropConstrainedForeignId('news_category_id');
        });
    }
};

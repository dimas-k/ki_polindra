<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Observers\UmumObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
   
class AppServiceProvider extends ServiceProvider
{
    /**
     * Daftar view yang memakai dropdown Jurusan/Prodi.
     * Semua view di sini otomatis mendapat variabel
     * $jurusanOptions dan $prodiOptions dari database
     * lewat View Composer di bawah, sehingga tidak perlu
     * mengubah setiap controller yang me-return view ini.
     */
    protected array $jurusanProdiViews = [
        'admin.adminpaten.editpaten.index',
        'admin.admindi.editdi.dosen',
        'admin.layout.prodi',
        'admin.layout.jurusan',
        'admin.adminhk.edithk.dosen',
        'umum-page.Desainindustri.jurusan.cari',
        'umum-page.Desainindustri.jurusan.index',
        'umum-page.Desainindustri.prodi.cari',
        'umum-page.Desainindustri.prodi.index',
        'umum-page.paten.jurusan.cari',
        'umum-page.paten.jurusan.index',
        'umum-page.paten.prodi.cari',
        'umum-page.paten.prodi.index',
        'umum-page.Hakcipta.jurusan.cari',
        'umum-page.Hakcipta.jurusan.index',
        'umum-page.Hakcipta.prodi.cari',
        'umum-page.Hakcipta.prodi.index',
        'dosen.desainindustri.edit.content',
        'dosen.layout.prodi-edit',
        'dosen.layout.prodi',
        'dosen.layout.jurusan-edit',
        'dosen.layout.jurusan',
        'dosen.paten.edit.content',
        'dosen.hakcipta.edit.content',
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        config(['app.locale'=>'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        View::composer($this->jurusanProdiViews, function ($view) {
            $view->with([
                'jurusanOptions' => Jurusan::orderBy('nama_jurusan')->get(),
                'prodiOptions' => Prodi::orderBy('nama_prodi')->get(),
            ]);
        });
    }
}

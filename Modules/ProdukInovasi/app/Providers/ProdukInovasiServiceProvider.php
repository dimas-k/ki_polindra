<?php

namespace Modules\ProdukInovasi\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Modules\ProdukInovasi\app\Models\AnggotaKelompokKeahlian;
use App\Models\User;

class ProdukInovasiServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'ProdukInovasi';
    protected string $moduleNameLower = 'produkinovasi';

    public function boot(): void
    {
        $this->registerViews();
        $this->registerMigrations();
        $this->registerRoutes();
        $this->registerViewComposers();
        $this->registerMorphMap();
    }

    /**
     * Kolom 'anggota_type' di produks_anggotas / penelitians_anggotas
     * disimpan sebagai nama tabel polos ('users',
     * 'anggota_kelompok_keahlians') oleh kode yang sudah ada
     * (KetuaKbkController, KirimKeDashboardService, dst), bukan nama
     * class lengkap. Tanpa morph map ini, relasi morphTo() (ProdukAnggota
     * @detail / @anggota, PenelitianAnggota @detail / @anggota) akan
     * gagal resolve ke Model yang benar.
     */
    protected function registerMorphMap(): void
    {
        Relation::morphMap([
            'users' => User::class,
            'anggota_kelompok_keahlians' => AnggotaKelompokKeahlian::class,
        ]);
    }

    public function register(): void
    {
        //
    }

    /**
     * Data navigasi Kelompok Bidang Keahlian dipakai di sidebar admin
     * dan sidebar dashboard publik, jadi cukup di-supply sekali di sini
     * -- controller manapun yang me-render halaman dengan sidebar itu
     * tidak perlu ambil datanya manual lagi.
     */
    protected function registerViewComposers(): void
    {
        View::composer('produkinovasi::admin.layouts.sidebar', function ($view) {
            $view->with('kbk_navigasi', KelompokKeahlian::select('id', 'nama_kbk')->get());
        });

        View::composer('produkinovasi::dashboard.layout.sidebar', function ($view) {
            $view->with('kbk', KelompokKeahlian::all());
        });
    }

    protected function registerViews(): void
    {
        $viewPath = module_path($this->moduleName, 'resources/views');
        $this->loadViewsFrom($viewPath, $this->moduleNameLower);
    }

    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
    }

    protected function registerRoutes(): void
    {
        Route::middleware('web')
            ->group(module_path($this->moduleName, 'routes/web.php'));
    }
}

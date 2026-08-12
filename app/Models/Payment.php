<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $guarded = ['id'];

    protected $casts = [
        'tenggat_pembayaran' => 'datetime',
        'paid_at' => 'datetime',
        'raw_response' => 'array',
        'reminder_terkirim' => 'boolean',
    ];

    const STATUS_MENUNGGU = 'Menunggu Pembayaran';
    const STATUS_DIBAYAR = 'Dibayar';
    const STATUS_KADALUARSA = 'Kadaluarsa';
    const STATUS_DIBATALKAN = 'Dibatalkan';

    /**
     * Relasi ke pengajuan (Paten, HakCipta, atau DesainIndustri).
     */
    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isLunas(): bool
    {
        return $this->status === self::STATUS_DIBAYAR;
    }

    public function sudahJatuhTempo(): bool
    {
        return !$this->isLunas() && now()->greaterThan($this->tenggat_pembayaran);
    }

    /**
     * Label jenis pengajuan untuk ditampilkan di email/UI.
     */
    public function getJenisPengajuanAttribute(): string
    {
        return match ($this->payable_type) {
            Paten::class => 'Paten',
            HakCipta::class => 'Hak Cipta',
            DesainIndustri::class => 'Desain Industri',
            default => 'Kekayaan Intelektual',
        };
    }
}

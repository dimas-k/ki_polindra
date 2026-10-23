<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentBankAccount extends Model
{
    use HasFactory;

    protected $table = 'payment_bank_accounts';

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'urutan' => 'integer',
    ];

    const TIPE_TRANSFER = 'transfer_manual';
    const TIPE_VA = 'virtual_account';
    const TIPE_QRIS = 'qris';

    public static function tipeOptions(): array
    {
        return [
            self::TIPE_TRANSFER => 'Transfer Bank Manual',
            self::TIPE_VA => 'Virtual Account',
            self::TIPE_QRIS => 'QRIS',
        ];
    }

    public function getTipeLabelAttribute(): string
    {
        return self::tipeOptions()[$this->tipe] ?? $this->tipe;
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'bank_account_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUrut($query)
    {
        return $query->orderByDesc('is_default')->orderBy('urutan')->orderBy('nama_bank');
    }
}

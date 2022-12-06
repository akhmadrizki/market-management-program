<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 'keuangans';
    protected $fillable = [
        'tanggal',
        'keterangan',
        'user_id',
        'pemasukan',
        'pengeluaran',
        'pengeluaran_id',
        'pembayaran_id',
    ];

    /**
     * Relations from the database
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relations from the database
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengeluaran(): BelongsTo
    {
        return $this->belongsTo(Pengeluaran::class, 'pengeluaran_id');
    }

    /**
     * Relations from the database
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }
}

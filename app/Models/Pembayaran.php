<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    protected $fillable = [
        'kontrak_id',
        'tanggal',
        'biaya_sewa',
        'dibayarkan',
        'tunggakan',
        'user_id',
    ];

    // Relations

    /**
     * Relations from the database
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kontrak(): BelongsTo
    {
        return $this->belongsTo(Kontrak::class, 'kontrak_id');
    }

    /**
     * Relations from the database
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

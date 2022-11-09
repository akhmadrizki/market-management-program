<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kontrak extends Model
{
    use HasFactory;

    protected $table = 'kontraks';
    protected $fillable = [
        'id_penyewa',
        'id_jenis_toko',
        'jenis_kontrak',
        'tanggal',
        'biaya_sewa',
        'tunggakan',
        'no_toko',
    ];

    /**
     * Relation kontrak table to penyewa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(Penyewa::class, 'id_penyewa');
    }

    /**
     * Relation kontrak table to jenis toko
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenisToko(): BelongsTo
    {
        return $this->belongsTo(JenisToko::class, 'id_jenis_toko');
    }
}

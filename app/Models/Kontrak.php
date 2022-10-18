<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'no_toko',
        'status',
    ];

    // Relations
    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'id_penyewa');
    }

    public function jenisToko()
    {
        return $this->belongsTo(JenisToko::class, 'id_jenis_toko');
    }
}

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
        'harga',
        'durasi',
        'status',
    ];
}

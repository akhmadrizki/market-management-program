<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    protected $fillable = [
        'kontrak_id',
        'tanggal',
        'biaya_sewa',
        'user_id',
    ];

    // Relations
    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class, 'kontrak_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

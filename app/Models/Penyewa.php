<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;

    protected $table = 'penyewas';
    protected $fillable = [
        'name',
        'contact',
        'address',
    ];

    // Relations
    public function kontrak()
    {
        return $this->hasMany(Kontrak::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_klasifikasi',
        'item_pendapatan',
        'tgl_pendapatan',
        'tagihan',
        'retur',
        'penerimaan',
        'kekurangan',
        'kelebihan',
        'keterangan',
        'user',
    ];

    protected $table = 'pendapatan';

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'id_klasifikasi', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}

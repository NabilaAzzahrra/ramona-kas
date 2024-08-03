<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'item',
        'tgl_transaksi',
        'pengeluaran',
        'pendapatan'
    ];

    protected $table = 'view_transaksi';

    public function luar()
    {
        return $this->belongsTo(Pengeluaran::class, 'id_transaksi', 'id_pengeluaran');
    }

    public function dapat()
    {
        return $this->belongsTo(Pendapatan::class, 'id_transaksi', 'id_pendapatan');
    }
}

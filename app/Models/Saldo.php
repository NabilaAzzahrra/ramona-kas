<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_saldo',
        'id_pendapatan',
        'id_pengeluaran',
        'debit',
        'kredit'
    ];

    protected $table = 'saldo';

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class, 'id_pendapatan', 'id_pendapatan');
    }

    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'id_pengeluaran', 'id_pengeluaran');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_pengeluaran',
        'tgl_pengeluaran',
        'id_jenis_pengeluaran',
        'pengeluaran',
        'keterangan',
        'user',
    ];

    protected $table = 'pengeluaran';

    public function jenis_pengeluaran()
    {
        return $this->belongsTo(Jenispengeluaran::class, 'id_jenis_pengeluaran', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

}

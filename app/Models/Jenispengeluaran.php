<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenispengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_pengeluaran',
        'user'
    ];

    protected $table = 'jenis_pengeluaran';
}

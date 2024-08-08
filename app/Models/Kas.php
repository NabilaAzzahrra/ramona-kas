<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kas',
        'kas',
        'tgl_kas'
    ];

    protected $table = 'kas';
}

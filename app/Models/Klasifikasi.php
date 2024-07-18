<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'klasifikasi',
        'user'
    ];

    protected $table = 'klasifikasi';
}

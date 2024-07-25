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

    public function pendapatan()
    {
        return $this->hasMany(Pendapatan::class, 'id_klasifikasi');
    }
}

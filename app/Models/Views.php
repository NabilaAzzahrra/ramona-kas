<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    use HasFactory;

    protected $table = 'dynamic_pengeluaran';

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}

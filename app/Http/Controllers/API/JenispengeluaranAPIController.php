<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jenispengeluaran;
use Illuminate\Http\Request;

class JenispengeluaranAPIController extends Controller
{
    public function get_all()
    {
        $jenis_pengeluaran = Jenispengeluaran::all();
        return response()->json([
            'jenis_pengeluaran'=>$jenis_pengeluaran,
        ]);
    }
}

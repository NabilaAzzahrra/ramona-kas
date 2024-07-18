<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiAPIController extends Controller
{
    public function get_all()
    {
        $klasifikasi = Klasifikasi::all();
        return response()->json([
            'klasifikasi'=>$klasifikasi,
        ]);
    }
}

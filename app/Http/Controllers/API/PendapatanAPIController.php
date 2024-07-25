<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pendapatan;
use Illuminate\Http\Request;

class PendapatanAPIController extends Controller
{
    public function get_all()
    {
        // $pendapatan = Pendapatan::with(['klasifikasi', 'user'])->get();
        // return response()->json([
        //     'pendapatan'=>$pendapatan,
        // ]);

        $pendapatan = Pendapatan::query();

        $dateStart = request('fromDate', 'all');
        $dateEnd = request('toDate', 'all');

        if ($dateStart !== 'all' && $dateEnd !== 'all') {
            $pendapatan->whereBetween('tgl_pendapatan', [$dateStart, $dateEnd]);
        }

        $pendapatan = $pendapatan->with(['klasifikasi', 'user'])->get();

        return response()->json(['pendapatan' => $pendapatan]);
    }
}

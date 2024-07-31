<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranAPIController extends Controller
{
    public function get_all()
    {
        // $pendapatan = Pendapatan::with(['klasifikasi', 'user'])->get();
        // return response()->json([
        //     'pendapatan'=>$pendapatan,
        // ]);

        $pengeluaran = Pengeluaran::query();

        $dateStart = request('fromDate', 'all');
        $dateEnd = request('toDate', 'all');

        if ($dateStart !== 'all' && $dateEnd !== 'all') {
            $pengeluaran->whereBetween('tgl_pengeluaran', [$dateStart, $dateEnd]);
        }

        $pengeluaran = $pengeluaran->with(['jenis_pengeluaran', 'user'])->get();

        return response()->json(['pengeluaran' => $pengeluaran]);
    }
}

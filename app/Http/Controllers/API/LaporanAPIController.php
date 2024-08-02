<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Saldo;
use Illuminate\Http\Request;

class LaporanAPIController extends Controller
{
   public function get_all()
   {
    $laporan = Laporan::query();

    $dateStart = request('fromDate', 'all');
    $dateEnd = request('toDate', 'all');

    if ($dateStart !== 'all' && $dateEnd !== 'all') {
        $laporan->whereBetween('tgl_transaksi', [$dateStart, $dateEnd]);
    }

    $laporan = $laporan->with([])->get();

    return response()->json(['laporan' => $laporan]);
   }
}

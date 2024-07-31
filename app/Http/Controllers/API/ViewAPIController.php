<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Views;
use Illuminate\Http\Request;

class ViewAPIController extends Controller
{
    public function get_all()
    {
        $view = Views::query();

        $dateStart = request('fromDate', 'all');
        $dateEnd = request('toDate', 'all');

        if ($dateStart !== 'all' && $dateEnd !== 'all') {
            $view->whereBetween('tgl_pengeluaran', [$dateStart, $dateEnd]);
        }

        $view = $view->with(['user'])->get();

        return response()->json(['view' => $view]);
    }
}

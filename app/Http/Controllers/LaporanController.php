<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use mPDF as GlobalMPDF;
use Mpdf\Mpdf;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.laporan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $transactions = Laporan::whereBetween('tgl_transaksi', [$start_date, $end_date])->get();
        $transactions_kurang = Laporan::where('tgl_transaksi', '<', $start_date)->get();

        return view('page.laporan.print1', compact('transactions','transactions_kurang', 'start_date', 'end_date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Validasi tanggal
        if (!$start_date || !$end_date) {
            return redirect()->back()->withErrors(['Tanggal mulai dan akhir diperlukan.']);
        }

        $transactions = Laporan::whereBetween('transaction_date', [$start_date, $end_date])->get();

        // Generate HTML untuk mPDF
        $html = view('page.laporan.print1', compact('transactions', 'start_date', 'end_date'))->render();

        $mpdf = new GlobalMPDF([
            'format' => 'F4',
            'margin_top' => 10,
            'margin_right' => 0,
            'margin_left' => 0,
            'margin_bottom' => 0,
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->debug = true; // Hapus atau set ke false jika tidak perlu debugging
        $mpdf->Output();

        return view('page.laporan.print1', compact('transactions', 'start_date', 'end_date'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

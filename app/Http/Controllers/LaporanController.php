<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // $transactions = Laporan::whereBetween('tgl_transaksi', [$start_date, $end_date])->get();
        $transactions_kurang = Laporan::where('tgl_transaksi', '<', $start_date)->get();

        $transactions = DB::table('view_transaksi')
            ->leftJoin('pendapatan', 'view_transaksi.id_transaksi', '=', 'pendapatan.id_pendapatan')
            ->leftJoin('klasifikasi', 'pendapatan.id_klasifikasi', '=', 'klasifikasi.id')
            ->leftJoin('users as pendapatan_user', 'pendapatan.user', '=', 'pendapatan_user.id')
            ->leftJoin('pengeluaran', 'view_transaksi.id_transaksi', '=', 'pengeluaran.id_pengeluaran')
            ->leftJoin('jenis_pengeluaran', 'pengeluaran.id_jenis_pengeluaran', '=', 'jenis_pengeluaran.id')
            ->leftJoin('users as pengeluaran_user', 'pengeluaran.user', '=', 'pengeluaran_user.id')
            ->whereBetween('view_transaksi.tgl_transaksi', [$start_date, $end_date])
            ->select(
                'view_transaksi.*',
                'pendapatan.*',
                'klasifikasi.*',
                'pendapatan_user.*',
                'pengeluaran.keterangan as keterangan_luar',
                'jenis_pengeluaran.*',
                'pengeluaran_user.name as name_luar'
            )
            ->get();
        $transactions_keluar = DB::table('view_transaksi')
            ->leftJoin('pendapatan', 'view_transaksi.id_transaksi', '=', 'pendapatan.id_pendapatan')
            ->leftJoin('klasifikasi', 'pendapatan.id_klasifikasi', '=', 'klasifikasi.id')
            ->leftJoin('users as pendapatan_user', 'pendapatan.user', '=', 'pendapatan_user.id')
            ->leftJoin('pengeluaran', 'view_transaksi.id_transaksi', '=', 'pengeluaran.id_pengeluaran')
            ->leftJoin('jenis_pengeluaran', 'pengeluaran.id_jenis_pengeluaran', '=', 'jenis_pengeluaran.id')
            ->leftJoin('users as pengeluaran_user', 'pengeluaran.user', '=', 'pengeluaran_user.id')
            ->whereBetween('view_transaksi.tgl_transaksi', [$start_date, $end_date])
            ->where('view_transaksi.pengeluaran', '!=', 0)
            ->select(
                'view_transaksi.*',
                'pendapatan.*',
                'klasifikasi.*',
                'pendapatan_user.*',
                'pengeluaran.keterangan as keterangan_luar',
                'jenis_pengeluaran.*',
                'pengeluaran_user.name as name_luar'
            )
            ->get();
        $transactions_kredit = DB::table('view_transaksi')
            ->leftJoin('pendapatan', 'view_transaksi.id_transaksi', '=', 'pendapatan.id_pendapatan')
            ->leftJoin('klasifikasi', 'pendapatan.id_klasifikasi', '=', 'klasifikasi.id')
            ->leftJoin('users as pendapatan_user', 'pendapatan.user', '=', 'pendapatan_user.id')
            ->leftJoin('pengeluaran', 'view_transaksi.id_transaksi', '=', 'pengeluaran.id_pengeluaran')
            ->leftJoin('jenis_pengeluaran', 'pengeluaran.id_jenis_pengeluaran', '=', 'jenis_pengeluaran.id')
            ->leftJoin('users as pengeluaran_user', 'pengeluaran.user', '=', 'pengeluaran_user.id')
            ->whereBetween('view_transaksi.tgl_transaksi', [$start_date, $end_date])
            ->where('klasifikasi', 'KREDIT')
            ->select(
                'view_transaksi.*',
                'pendapatan.*',
                'klasifikasi.*',
                'pendapatan_user.*',
                'pengeluaran.keterangan as keterangan_luar',
                'jenis_pengeluaran.*',
                'pengeluaran_user.name as name_luar'
            )
            ->get();
        $transactions_tunai = DB::table('view_transaksi')
            ->leftJoin('pendapatan', 'view_transaksi.id_transaksi', '=', 'pendapatan.id_pendapatan')
            ->leftJoin('klasifikasi', 'pendapatan.id_klasifikasi', '=', 'klasifikasi.id')
            ->leftJoin('users as pendapatan_user', 'pendapatan.user', '=', 'pendapatan_user.id')
            ->leftJoin('pengeluaran', 'view_transaksi.id_transaksi', '=', 'pengeluaran.id_pengeluaran')
            ->leftJoin('jenis_pengeluaran', 'pengeluaran.id_jenis_pengeluaran', '=', 'jenis_pengeluaran.id')
            ->leftJoin('users as pengeluaran_user', 'pengeluaran.user', '=', 'pengeluaran_user.id')
            ->whereBetween('view_transaksi.tgl_transaksi', [$start_date, $end_date])
            ->where('klasifikasi', 'TUNAI')
            ->select(
                'view_transaksi.*',
                'pendapatan.*',
                'klasifikasi.*',
                'pendapatan_user.*',
                'pengeluaran.keterangan as keterangan_luar',
                'jenis_pengeluaran.*',
                'pengeluaran_user.name as name_luar'
            )
            ->get();
        $transactions_umum = DB::table('view_transaksi')
            ->leftJoin('pendapatan', 'view_transaksi.id_transaksi', '=', 'pendapatan.id_pendapatan')
            ->leftJoin('klasifikasi', 'pendapatan.id_klasifikasi', '=', 'klasifikasi.id')
            ->leftJoin('users as pendapatan_user', 'pendapatan.user', '=', 'pendapatan_user.id')
            ->leftJoin('pengeluaran', 'view_transaksi.id_transaksi', '=', 'pengeluaran.id_pengeluaran')
            ->leftJoin('jenis_pengeluaran', 'pengeluaran.id_jenis_pengeluaran', '=', 'jenis_pengeluaran.id')
            ->leftJoin('users as pengeluaran_user', 'pengeluaran.user', '=', 'pengeluaran_user.id')
            ->whereBetween('view_transaksi.tgl_transaksi', [$start_date, $end_date])
            ->where('klasifikasi', 'UMUM')
            ->where(function ($query) {
                $query->where('item', '<>', 'PENERIMAAN');
            })
            ->select(
                'view_transaksi.*',
                'pendapatan.*',
                'klasifikasi.*',
                'pendapatan_user.*',
                'pengeluaran.keterangan as keterangan_luar',
                'jenis_pengeluaran.*',
                'pengeluaran_user.name as name_luar'
            )
            ->get();
        $transactions_penerimaan = DB::table('view_transaksi')
            ->leftJoin('pendapatan', 'view_transaksi.id_transaksi', '=', 'pendapatan.id_pendapatan')
            ->leftJoin('klasifikasi', 'pendapatan.id_klasifikasi', '=', 'klasifikasi.id')
            ->leftJoin('users as pendapatan_user', 'pendapatan.user', '=', 'pendapatan_user.id')
            ->leftJoin('pengeluaran', 'view_transaksi.id_transaksi', '=', 'pengeluaran.id_pengeluaran')
            ->leftJoin('jenis_pengeluaran', 'pengeluaran.id_jenis_pengeluaran', '=', 'jenis_pengeluaran.id')
            ->leftJoin('users as pengeluaran_user', 'pengeluaran.user', '=', 'pengeluaran_user.id')
            ->whereBetween('view_transaksi.tgl_transaksi', [$start_date, $end_date])
            ->where('item', 'PENERIMAAN')
            ->select(
                'view_transaksi.*',
                'pendapatan.*',
                'klasifikasi.*',
                'pendapatan_user.*',
                'pengeluaran.keterangan as keterangan_luar',
                'jenis_pengeluaran.*',
                'pengeluaran_user.name as name_luar'
            )
            ->get();
        $transactions_kurang = DB::table('view_transaksi')
            ->leftJoin('pendapatan', 'view_transaksi.id_transaksi', '=', 'pendapatan.id_pendapatan')
            ->leftJoin('klasifikasi', 'pendapatan.id_klasifikasi', '=', 'klasifikasi.id')
            ->leftJoin('users as pendapatan_user', 'pendapatan.user', '=', 'pendapatan_user.id')
            ->leftJoin('pengeluaran', 'view_transaksi.id_transaksi', '=', 'pengeluaran.id_pengeluaran')
            ->leftJoin('jenis_pengeluaran', 'pengeluaran.id_jenis_pengeluaran', '=', 'jenis_pengeluaran.id')
            ->leftJoin('users as pengeluaran_user', 'pengeluaran.user', '=', 'pengeluaran_user.id')
            ->where('tgl_transaksi', '<', $start_date)
            ->select(
                'view_transaksi.*',
                'pendapatan.*',
                'klasifikasi.*',
                'pendapatan_user.*',
                'pengeluaran.keterangan as keterangan_luar',
                'jenis_pengeluaran.*',
                'pengeluaran_user.name as name_luar'
            )
            ->get();



        return view('page.laporan.print1', compact('transactions', 'transactions_kurang', 'transactions_kredit', 'transactions_tunai', 'transactions_keluar', 'transactions_umum', 'transactions_penerimaan', 'start_date', 'end_date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

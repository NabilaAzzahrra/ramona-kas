<?php

namespace App\Http\Controllers;

use App\Models\Jenispengeluaran;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use App\Models\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = DB::select('SHOW COLUMNS FROM dynamic_pengeluaran');
        $jenis_pengeluaran = array_map(function ($column) {
            return $column->Field;
        }, $columns);

        // Debugging: print the column names
        // dd($columnNames);

        return view('page.pengeluaran.index')->with([
            'jenis_pengeluaran' => $jenis_pengeluaran,
        ]);
        // $jenis_pengeluaran = Schema::getColumnListing('dynamic_pengeluaran');
        return view('page.pengeluaran.index')->with([
            'jenis_pengeluaran' => $jenis_pengeluaran,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_pengeluaran = Jenispengeluaran::all();
        return view('page.pengeluaran.create')->with([
            'jenis_pengeluaran' => $jenis_pengeluaran,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_pengeluaran = date('YmdHis');
        $data = [
            'id_pengeluaran' => $id_pengeluaran,
            'id_jenis_pengeluaran' => $request->input('klasifikasi'),
            'item_pengeluaran' => $request->input('uraian'),
            'tgl_pengeluaran' => date('Y-m-d'),
            'pengeluaran' => $request->input('pengeluaran'),
            'keterangan' => $request->input('keterangan'),
            'user' => Auth::user()->id,
        ];

        Pengeluaran::create($data);

        $datasaldo = [
            'tgl_saldo' =>  date('Y-m-d'),
            'id_pendapatan' => 0,
            'id_pengeluaran' => $id_pengeluaran,
            'debit' => $request->input('pengeluaran'),
            'kredit' => 0,
        ];
        Saldo::create($datasaldo);

        return redirect()
            ->route('pengeluaran.index')
            ->with('message', 'Data Pengeluaran Sudah ditambahkan');
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

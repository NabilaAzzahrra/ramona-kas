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
            'tgl_bon' => $request->input('tgl_bon'),
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
        $jenis_pengeluaran = Jenispengeluaran::all();
        $pengeluaran = Pengeluaran::where('id', $id)->first();
        return view('page.pengeluaran.edit')->with([
            'jenis_pengeluaran' => $jenis_pengeluaran,
            'pengeluaran' => $pengeluaran,
        ]);
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
        $data = [
            'id_jenis_pengeluaran' => $request->input('klasifikasi'),
            'item_pengeluaran' => $request->input('uraian'),
            'tgl_pengeluaran' => date('Y-m-d'),
            'tgl_bon' => $request->input('tgl_bon'),
            'pengeluaran' => $request->input('pengeluaran'),
            'keterangan' => $request->input('keterangan'),
            'user' => Auth::user()->id,
        ];

        $pengeluaran_awal = $request->input('pengeluaran_awal');
        $pengeluaran = $request->input('pengeluaran');
        $id_pengeluaran = $request->input('id_pengeluaran');

        // Calculate the difference in penerimaan
        $difference = $pengeluaran - $pengeluaran_awal;

        // Fetch the related saldo
        $saldo = Saldo::where('id_pengeluaran', $id_pengeluaran)->first();
        if ($saldo) {
            // Update the saldo based on the difference
            $saldo->debit += $difference;
            $saldo->save();
        } else {
            // If no saldo record exists, create a new one
            Saldo::create([
                'id_pengeluaran' => $id_pengeluaran,
                'debit' => $pengeluaran,
                'kredit' => 0,
            ]);
        }

        $datas = Pengeluaran::findOrFail($id);
        $datas->update($data);
        return redirect()
            ->route('pengeluaran.index')
            ->with('message', 'Data Pengeluaran Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Find the pengeluaran record
        $pengeluaran = Pengeluaran::findOrFail($id);

        // Get id_pengeluaran from the request
        $id_pengeluaran = $request->input('id_pengeluaran');

        // Delete the related saldo records
        Saldo::where('id_pengeluaran', $id_pengeluaran)->delete();

        // Delete the pengeluaran record
        $pengeluaran->delete();

        return back()->with('message_delete', 'Data Pengeluaran dan Saldo terkait sudah dihapus');
    }
}

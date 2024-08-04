<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\Pendapatan;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page/Pendapatan/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $klasifikasi = Klasifikasi::all();
        return view('page/Pendapatan/create')->with([
            'klasifikasi' => $klasifikasi,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_pendapatan = date('YmdHis');
        $data = [
            'id_klasifikasi' => $request->input('klasifikasi'),
            'id_pendapatan' => $id_pendapatan,
            'item_pendapatan' => $request->input('uraian'),
            'tgl_pendapatan' => date('Y-m-d'),
            'tagihan' => $request->input('tagihan'),
            'retur' => $request->input('retur'),
            'penerimaan' => $request->input('penerimaan'),
            'kekurangan' => $request->input('kekurangan'),
            'kelebihan' => $request->input('kelebihan'),
            'keterangan' => $request->input('keterangan'),
            'user' => Auth::user()->id,
        ];

        Pendapatan::create($data);

        $datasaldo = [
            'tgl_saldo' =>  date('Y-m-d'),
            'id_pendapatan' => $id_pendapatan,
            'id_pengeluaran' => 0,
            'debit' => 0,
            'kredit' => $request->input('penerimaan'),
        ];
        Saldo::create($datasaldo);

        // $datas = Saldo::all();

        // foreach ($datas as $d) {
        //     $d->saldo += $request->input('penerimaan');
        //     $d->save();
        // }

        return redirect()
            ->route('pendapatan.index')
            ->with('message', 'Data Pendapatan Sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $klasifikasi = Klasifikasi::all();
        $pendapatan = Pendapatan::where('id', $id)->first();
        return view('page/pendapatan/edit')->with([
            'pendapatan' => $pendapatan,
            'klasifikasi' => $klasifikasi,
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
            'id_klasifikasi' => $request->input('klasifikasi'),
            'item_pendapatan' => $request->input('uraian'),
            'tagihan' => $request->input('tagihan'),
            'retur' => $request->input('retur'),
            'keterangan' => $request->input('keterangan'),
            'penerimaan' => $request->input('penerimaan'),
            'kelebihan' => $request->input('kelebihan'),
            'kekurangan' => $request->input('kekurangan'),
            'user' => Auth::user()->id,
        ];

        $penerimaan_awal = $request->input('penerimaan_awal');
        $penerimaan = $request->input('penerimaan');
        $id_pendapatan = $request->input('id_pendapatan');

        // Calculate the difference in penerimaan
        $difference = $penerimaan - $penerimaan_awal;

        // Fetch the related saldo
        $saldo = Saldo::where('id_pendapatan', $id_pendapatan)->first();
        if ($saldo) {
            // Update the saldo based on the difference
            $saldo->kredit += $difference;
            $saldo->save();
        } else {
            // If no saldo record exists, create a new one
            Saldo::create([
                'id_pendapatan' => $id_pendapatan,
                'debit' => 0,
                'kredit' => $penerimaan,
            ]);
        }

        $datas = Pendapatan::findOrFail($id);
        $datas->update($data);
        return redirect()
            ->route('pendapatan.index')
            ->with('message', 'Data Pendapatan Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Find the pendapatan record
        $pendapatan = Pendapatan::findOrFail($id);

        // Get id_pendapatan from the request
        $id_pendapatan = $request->input('id_pendapatan');

        // Delete the related saldo records
        Saldo::where('id_pendapatan', $id_pendapatan)->delete();

        // Delete the pendapatan record
        $pendapatan->delete();

        return back()->with('message_delete', 'Data Pendapatan dan Saldo terkait sudah dihapus');
    }
}

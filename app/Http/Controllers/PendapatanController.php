<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\Pendapatan;
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
        $data = [
            'id_klasifikasi' => $request->input('klasifikasi'),
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

        $datas = Pendapatan::findOrFail($id);
        $datas->update($data);
        return redirect()
            ->route('pendapatan.index')
            ->with('message', 'Data Pendapatan Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pendapatan::findOrFail($id);
        $data->delete();
        return back()->with('message_delete','Data Pendapatan Sudah dihapus');
    }
}

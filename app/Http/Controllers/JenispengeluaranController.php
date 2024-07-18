<?php

namespace App\Http\Controllers;

use App\Models\Jenispengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenispengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page/jenis_pengeluaran/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'jenis_pengeluaran' => $request->input('jenis_pengeluaran'),
            'user' => Auth::user()->id,
        ];

        Jenispengeluaran::create($data);

        return redirect()
            ->route('jenis_pengeluaran.index')
            ->with('message', 'Data Jenis Pengeluaran Sudah ditambahkan');
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
        $data = [
            'jenis_pengeluaran' => $request->input('jenis_pengeluaran'),
            'user' => Auth::user()->id,
        ];

        $datas = Jenispengeluaran::findOrFail($id);
        $datas->update($data);
        return redirect()
            ->route('jenis_pengeluaran.index')
            ->with('message', 'Data Jenis Pengeluaran Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Jenispengeluaran::findOrFail($id);
        $data->delete();
        return back()->with('message_delete','Data Jenis Pengeluaran Sudah dihapus');
    }
}

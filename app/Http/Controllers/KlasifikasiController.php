<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page/klasifikasi/index');
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
            'klasifikasi' => $request->input('klasifikasi'),
            'user' => Auth::user()->id,
        ];

        Klasifikasi::create($data);

        return redirect()
            ->route('klasifikasi.index')
            ->with('message', 'Data Klasifikasi Sudah ditambahkan');
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
            'klasifikasi' => $request->input('klasifikasi'),
            'user' => Auth::user()->id,
        ];

        $datas = Klasifikasi::findOrFail($id);
        $datas->update($data);
        return redirect()
            ->route('klasifikasi.index')
            ->with('message', 'Data Klasifikasi Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Klasifikasi::findOrFail($id);
        $data->delete();
        return back()->with('message_delete','Data Klasifikasi Sudah dihapus');
    }
}

<?php

use App\Http\Controllers\JenispengeluaranController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoController;
use App\Models\Jenispengeluaran;
use App\Models\Klasifikasi;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $klasifikasi = Klasifikasi::all();
    $jenis_pengeluaran = Jenispengeluaran::all();
    $pendapatan = Pendapatan::where('tgl_pendapatan', date('Y-m-d'))->get();
    $sumPendapatan = $pendapatan->sum('penerimaan');
    $pengeluaran = Pengeluaran::where('tgl_pengeluaran', date('Y-m-d'))->get();
    $sumPengeluaran = $pengeluaran->sum('pengeluaran');

    // CHART PENDAPATAN
        // Mendapatkan tanggal sekarang
        $today = Carbon::today();

        // Mendapatkan data pendapatan untuk 7 hari mulai dari tanggal sekarang
        $pendapatan = Pendapatan::whereBetween('tgl_pendapatan', [$today->copy()->subDays(6), $today])
            ->orderBy('tgl_pendapatan', 'asc')
            ->get();

        // Mengelompokkan data berdasarkan tanggal dan menjumlahkan pendapatan setiap hari
        $pendapatanPerHari = $pendapatan->groupBy('tgl_pendapatan')->map(function ($day) {
            return $day->sum('penerimaan');
        });

        // Menyusun array untuk label dan data
        $labels = [];
        $data = [];

        // Loop untuk 7 hari terakhir termasuk hari ini
        foreach (range(0, 6) as $day) {
            $date = $today->copy()->subDays($day)->toDateString();
            $labels[] = $date;
            $data[] = $pendapatanPerHari->get($date, 0);
        }

        // Reverse the arrays to start from the oldest date
        $labels = array_reverse($labels);
        $data = array_reverse($data);

        // dd($today);
    // ==== //

    // CHART PENGELUARAN
        // Mendapatkan tanggal sekarang
        $today_pengeluaran = Carbon::today();

        // Mendapatkan data pendapatan untuk 7 hari mulai dari tanggal sekarang
        $pengeluaran = Pengeluaran::whereBetween('tgl_pengeluaran', [$today_pengeluaran->copy()->subDays(6), $today_pengeluaran])
            ->orderBy('tgl_pengeluaran', 'asc')
            ->get();

        // Mengelompokkan data berdasarkan tanggal dan menjumlahkan pendapatan setiap hari
        $pengeluaranPerHari = $pengeluaran->groupBy('tgl_pengeluaran')->map(function ($day) {
            return $day->sum('pengeluaran');
        });

        // Menyusun array untuk label dan data
        $labels_pengeluaran = [];
        $data_pengeluaran = [];

        // Loop untuk 7 hari terakhir termasuk hari ini
        foreach (range(0, 6) as $day) {
            $date_pengeluaran = $today_pengeluaran->copy()->subDays($day)->toDateString();
            $labels_pengeluaran[] = $date_pengeluaran;
            $data_pengeluaran[] = $pengeluaranPerHari->get($date_pengeluaran, 0);
        }

        // Reverse the arrays to start from the oldest date
        $labels_pengeluaran = array_reverse($labels_pengeluaran);
        $data_pengeluaran = array_reverse($data_pengeluaran);

        // dd($today_pengeluaran);
    // ==== //


    return view('dashboard')->with([
        'klasifikasi' => $klasifikasi,
        'jenis_pengeluaran' => $jenis_pengeluaran,
        'pendapatan' => $pendapatan,
        'sumPendapatan' => $sumPendapatan,
        'pengeluaran' => $pengeluaran,
        'sumPengeluaran' => $sumPengeluaran,
        'labels' => json_encode($labels),
        'data' => json_encode($data),
        'labels_pengeluaran' => json_encode($labels_pengeluaran),
        'data_pengeluaran' => json_encode($data_pengeluaran),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('klasifikasi', KlasifikasiController::class)->middleware(['auth']);
Route::resource('jenis_pengeluaran', JenispengeluaranController::class)->middleware(['auth']);
Route::resource('pendapatan', PendapatanController::class)->middleware(['auth']);
Route::resource('saldo', SaldoController::class)->middleware(['auth']);
Route::resource('pengeluaran', PengeluaranController::class)->middleware(['auth']);
Route::resource('laporan', LaporanController::class)->middleware(['auth']);
Route::resource('kas', KasController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

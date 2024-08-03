<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        table,
        tr,
        th,
        td {
            border: 1px solid black;
        }
        @media print {
            @page {
                size: landscape;
            }
            /* Tambahkan gaya cetak lainnya di sini */
        }
    </style>
    <style>
        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <div class="container bg-red-500 w-[1500px]" hidden>
        item, pengeluaran, pendapatan, keterangan, klasifikasi/jenis_pengeluaran, user<br>
        @php
            $jml_pendapatan = 0;
            $jml_pengeluaran = 0;
            $saldo_akhir = 0;
        @endphp

        @foreach ($transactions_kurang as $items)
            {{ $items->item }} ==== {{ $items->pengeluaran }} ===== {{ $items->pendapatan }}====
            {{ $items->keterangan_luar ?? $items->keterangan }} ====
            {{ $items->klasifikasi ?? $items->jenis_pengeluaran }} === {{ $items->name ?? $items->name_luar }}<br>
            @php
                $jml_pendapatan += $items->pendapatan;
                $jml_pengeluaran += $items->pengeluaran;
                $saldo_akhir = $jml_pendapatan - $jml_pengeluaran;
            @endphp
        @endforeach

        <br><br>
        Saldo akhir == {{ $saldo_akhir }}

        <br><br>
        item, pengeluaran, pendapatan, keterangan, klasifikasi/jenis_pengeluaran, user<br>
        @php
            $jml_pendapatan_now = 0;
            $jml_pengeluaran_now = 0;
            $saldo_akhir_now = 0;
        @endphp
        saldo awalll ==== 0 === {{ $saldo_akhir }}<br>
        @foreach ($transactions as $item)
            {{ $item->item }} ==== {{ $item->pengeluaran }} ==== {{ $item->pendapatan }} ====
            {{ $item->keterangan_luar ?? $item->keterangan }} ====
            {{ $item->klasifikasi ?? $item->jenis_pengeluaran }} === {{ $item->name ?? $item->name_luar }} <br>
            @php
                $jml_pendapatan_now += $item->pendapatan;
                $jml_pengeluaran_now += $item->pengeluaran;
                $saldo_akhir_now = $saldo_akhir + $jml_pendapatan_now - $jml_pengeluaran_now;
            @endphp
        @endforeach
        saldo akhir ==== 0 === {{ $saldo_akhir_now }}<br>
    </div>

    {{-- PENDAPATAN --}}

    @php
        $hari = '';
        if ($start_date == $end_date) {
            $date = date('l', strtotime($start_date));
            switch (strtolower($date)) {
                case 'sunday':
                    $hari = 'MINGGU';
                    break;
                case 'monday':
                    $hari = 'SENIN';
                    break;
                case 'tuesday':
                    $hari = 'SELASA';
                    break;
                case 'wednesday':
                    $hari = 'RABU';
                    break;
                case 'thursday':
                    $hari = 'KAMIS';
                    break;
                case 'friday':
                    $hari = 'JUMAT';
                    break;
                case 'saturday':
                    $hari = 'SABTU';
                    break;
            }
        } else {
            $hari = 'PERIODE';
        }
    @endphp

    <div class="bg-red-500">
        <div class="font-bold text-center">REKAPITULASI PENDAPATAN</div>
        <div class="font-bold text-center">
            @if ($start_date == $end_date)
                {{ $hari }}
            @else
                PERIODE
            @endif
        </div>
        <div class="font-bold text-center">{{ date('d/m/Y', strtotime($start_date)) }} -
            {{ date('d/m/Y', strtotime($end_date)) }}</div>
    </div>
    @foreach ($transactions_penerimaan as $tp)
        @php
            $p_penerimaan = $tp->penerimaan;
            $saldoAwalPenerimaan = $saldo_akhir + $tp->penerimaan;
        @endphp
    @endforeach
    <div class="mt-10">
        <table class="w-full">
            <thead class="bg-[#808080] text-white">
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">URAIAN</th>
                    <th colspan="4">PENDAPATAN</th>
                    <th rowspan="2">KEKURANGAN</th>
                    <th rowspan="2">KELEBIHAN</th>
                    <th rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th class="text-wrap w-20">TANGGAL TRANSAKSI</th>
                    <th>TAGIHAN</th>
                    <th>RETUR</th>
                    <th>PENERIMAAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center bg-[#808080] text-white font-bold">I</td>
                    <td class="text-left pl-4 bg-[#808080] text-white font-bold">SALDO AWAL</td>
                    <td class="text-center">{{ date('d/m/y', strtotime($item->tgl_transaksi)) }}</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold">
                        {{ number_format($saldo_akhir, 0, ',', '.') }}</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-left pl-4">-</td>
                </tr>
                <tr>
                    <td class="text-center bg-[#808080] text-white font-bold"></td>
                    <td class="text-left pl-4 bg-[#808080] text-white font-bold">PENERIMAAN</td>
                    <td class="text-center">{{ date('d/m/y', strtotime($tp->tgl_transaksi)) }}</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold">
                        {{ number_format($tp->penerimaan, 0, ',', '.') }}</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-left pl-4">-</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold">
                        {{ number_format($saldoAwalPenerimaan, 0, ',', '.') }}</td>
                    <td colspan="3"></td>
                </tr>
                @php
                    $no = 1;
                    $tot_umum = 0;
                @endphp
                @foreach ($transactions_umum as $tu)
                    @php
                        $jml_tagihan_umum = 0;
                        $jml_retur_umum = 0;
                        $jml_penerimaan_umum = 0;
                        $jml_kekurangan_umum = 0;
                        $jml_kelebihan_umum = 0;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-left pl-4">{{ $tu->item }}</td>
                        <td class="text-center">{{ date('d/m/y', strtotime($item->tgl_transaksi)) }}</td>
                        <td class="text-right pr-4">{{ number_format($tu->tagihan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ $tu->retur }}</td>
                        <td class="text-right pr-4">
                            {{ number_format($tu->penerimaan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tu->kekurangan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tu->kelebihan, 0, ',', '.') }}</td>
                        <td class="text-left pl-4">{{ $tu->keterangan }}</td>
                    </tr>
                    @php
                        $jml_tagihan_umum += $tu->tagihan;
                        $jml_retur_umum += $tu->retur;
                        $jml_penerimaan_umum += $tu->penerimaan;
                        $jml_kekurangan_umum += $tu->kekurangan;
                        $jml_kelebihan_umum += $tu->kelebihan;
                    @endphp
                @endforeach
                <tr class="text-center bg-[#808080] text-white font-bold">
                    <td>II</td>
                    <td class="text-left pl-4">PENJUALAN KREDIT</td>
                </tr>
                @php
                    $jml_tagihan_kredit = 0;
                    $jml_retur_kredit = 0;
                    $jml_penerimaan_kredit = 0;
                    $jml_kekurangan_kredit = 0;
                    $jml_kelebihan_kredit = 0;
                    $no = 1;
                @endphp
                @foreach ($transactions_kredit as $tk)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-left pl-4">{{ $tk->item }}</td>
                        <td class="text-center">{{ date('d/m/y', strtotime($tk->tgl_transaksi)) }}</td>
                        <td class="text-right pr-4">{{ number_format($tk->tagihan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tk->retur, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tk->penerimaan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tk->kekurangan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tk->kelebihan, 0, ',', '.') }}</td>
                        <td class="text-left pl-4">{{ $tk->keterangan }}</td>
                    </tr>
                    @php
                        $jml_tagihan_kredit += $tk->tagihan;
                        $jml_retur_kredit += $tk->retur;
                        $jml_penerimaan_kredit += $tk->penerimaan;
                        $jml_kekurangan_kredit += $tk->kekurangan;
                        $jml_kelebihan_kredit += $tk->kelebihan;
                    @endphp
                @endforeach
                <tr class="text-center bg-[#808080] text-white font-bold">
                    <td>III</td>
                    <td class="text-left pl-4">PENJUALAN TUNAI</td>
                </tr>
                @php
                    $jml_tagihan_tunai = 0;
                    $jml_retur_tunai = 0;
                    $jml_penerimaan_tunai = 0;
                    $jml_kekurangan_tunai = 0;
                    $jml_kelebihan_tunai = 0;
                    $not = 1;
                @endphp
                @foreach ($transactions_tunai as $tt)
                    <tr>
                        <td class="text-center">{{ $not++ }}</td>
                        <td class="text-left pl-4">{{ $tt->item }}</td>
                        <td class="text-center">{{ date('d/m/y', strtotime($tt->tgl_transaksi)) }}</td>
                        <td class="text-right pr-4">{{ number_format($tt->tagihan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tt->retur, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tt->penerimaan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tt->kekurangan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tt->kelebihan, 0, ',', '.') }}</td>
                        <td class="text-left pl-4">{{ $tt->keterangan }}</td>
                    </tr>
                    @php
                        $jml_tagihan_tunai += $tt->tagihan;
                        $jml_retur_tunai += $tt->retur;
                        $jml_penerimaan_tunai += $tt->penerimaan;
                        $jml_kekurangan_tunai += $tt->kekurangan;
                        $jml_kelebihan_tunai += $tt->kelebihan;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                @php
                    $jml_tagihan = ($jml_tagihan_tunai ?? 0) + ($jml_tagihan_kredit ?? 0) + ($jml_tagihan_umum ?? 0);
                    $jml_retur = ($jml_retur_tunai ?? 0) + ($jml_retur_kredit ?? 0) + ($jml_retur_umum ?? 0);
                    $jml_penerimaan =
                        ($jml_penerimaan_tunai ?? 0) + ($jml_penerimaan_kredit ?? 0) + ($jml_penerimaan_umum ?? 0);
                    $jml_kekurangan =
                        ($jml_kekurangan_tunai ?? 0) + ($jml_kekurangan_kredit ?? 0) + ($jml_kekurangan_umum ?? 0);
                    $jml_kelebihan =
                        ($jml_kelebihan_tunai ?? 0) + ($jml_kelebihan_kredit ?? 0) + ($jml_kelebihan_umum ?? 0);
                    $t_pendapatan = ($jml_penerimaan ?? 0) + $saldoAwalPenerimaan;
                @endphp
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th class="bg-[#808080] text-white text-right pr-4">{{ number_format($jml_tagihan, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">{{ number_format($jml_retur, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($jml_penerimaan, 0, ',', '.') }}</th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($jml_kekurangan, 0, ',', '.') }}</th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($jml_kelebihan, 0, ',', '.') }}</th>
                    <td></td>
                </tr>
                <tr class="bg-[#808080] text-white">
                    <td></td>
                    <th colspan="4">TOTAL PENDAPATAN</th>
                    <th class="text-right pr-4">{{ number_format($t_pendapatan, 0, ',', '.') }}</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="page-break"></div>

    {{-- PENGELUARAN --}}

    <div class="bg-sky-500 mt-10">
        <div class="font-bold text-center">REKAPITULASI PENGELUARAN</div>
        <div class="font-bold text-center">
            @if ($start_date == $end_date)
                {{ $hari }}
            @else
                PERIODE
            @endif
        </div>
        <div class="font-bold text-center">{{ date('d/m/Y', strtotime($start_date)) }} -
            {{ date('d/m/Y', strtotime($end_date)) }}</div>
    </div>

    <div class="mt-10">
        <table class="w-full">
            <thead class="bg-[#808080] text-white">
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">URAIAN</th>
                    <th rowspan="2" class="w-20">TANGGAL TRANSAKSI</th>
                    <th colspan="5">PENGELUARAN</th>
                    <th rowspan="2">KETERANGAN</th>
                    <th rowspan="2" class="w-20">PENDAPATAN BERSIH</th>
                </tr>
                <tr>
                    <th>UMUM</th>
                    <th>OPERASIONAL</th>
                    <th>BAHAN</th>
                    <th>PRIVE</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions_keluar as $t)
                    @php
                        $umum = 0;
                        $operasional = 0;
                        $bahan = 0;
                        $prive = 0;
                        $t_umum = 0;
                        $t_operasional = 0;
                        $t_bahan = 0;
                        $t_prive = 0;
                        $t_total = 0;
                        $no = 0;
                        if ($t->jenis_pengeluaran === 'UMUM') {
                            $umum = $t->pengeluaran;
                            $operasional = 0;
                            $bahan = 0;
                            $prive = 0;
                        } elseif ($t->jenis_pengeluaran === 'OPERASIONAL') {
                            $umum = 0;
                            $operasional = $t->pengeluaran;
                            $bahan = 0;
                            $prive = 0;
                        } elseif ($t->jenis_pengeluaran === 'BAHAN') {
                            $umum = 0;
                            $operasional = 0;
                            $bahan = $t->pengeluaran;
                            $prive = 0;
                        } elseif ($t->jenis_pengeluaran === 'PRIVE') {
                            $umum = 0;
                            $operasional = 0;
                            $bahan = 0;
                            $prive = $t->pengeluaran;
                        } else {
                            $umum = 0;
                            $operasional = 0;
                            $bahan = 0;
                            $prive = 0;
                        }

                        $total = $umum + $operasional + $bahan + $prive;
                        $t_umum += $umum;
                        $t_operasional += $operasional;
                        $t_bahan += $bahan;
                        $t_prive += $prive;
                        $t_total += $total;
                        $no = 1;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-left pl-4">{{ $t->item }}</td>
                        <td class="text-center">{{ date('d/m/y', strtotime($t->tgl_transaksi)) }}</td>
                        <td class="text-right pr-4">{{ number_format($umum, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($operasional, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($bahan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($prive, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($total, 0, ',', '.') }}</td>
                        <td>-</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="bg-[#808080] text-white text-right pr-4">{{ number_format($t_umum, 0, ',', '.') }}</th>
                    <th class="bg-[#808080] text-white text-right pr-4">{{ number_format($t_operasional, 0, ',', '.') }}</th>
                    <th class="bg-[#808080] text-white text-right pr-4">{{ number_format($t_bahan, 0, ',', '.') }}</th>
                    <th class="bg-[#808080] text-white text-right pr-4">{{ number_format($t_prive, 0, ',', '.') }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="bg-[#808080] text-white text-right pr-4">{{ number_format($t_total, 0, ',', '.') }}</th>
                    <th></th>
                    <th class="bg-[#808080] text-white text-right pr-4">{{ number_format($t_pendapatan - $t_total, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- PERHITUNGAN --}}

    <div class="mt-10">
        <table class="w-full">
            <thead>
                <tr>
                    <th>SALDO AWAL</th>
                    <th>PENERIMAAN</th>
                    <th>PENDAPATAN</th>
                    <th>PENGELUARAN</th>
                    <th>PENDAPATAN BERSIH</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">{{ number_format($saldo_akhir, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($p_penerimaan, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($jml_penerimaan, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($t_total, 0, ',', '.') }}</td>
                    <th class="text-center">{{ number_format($saldo_akhir + $p_penerimaan + $jml_penerimaan - $t_total, 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
    </div>

</body>
<script>
    // window.print();
</script>

</html>

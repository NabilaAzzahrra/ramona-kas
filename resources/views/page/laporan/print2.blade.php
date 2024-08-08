<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document-{{ Auth::user()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        table,
        tr,
        th,
        td {
            border: 1px solid black;
        }

    </style>
    <style>
        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    {{-- <div class="container bg-red-500 w-[1500px]" hidden>
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
    </div> --}}

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

    <div class="">
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
    @php
        $tot_penerimaan = 0;
        $tgl_penerimaan = null;
        $p_penerimaan = 0;
    @endphp
    @foreach ($transactions_penerimaan as $tp)
        @php
            $tot_penerimaan += $tp->penerimaan;
            $p_penerimaan += $tp->penerimaan;
            $tgl_penerimaan = $tp->tgl_transaksi;
        @endphp
    @endforeach

    @php
        $tot_penerimaan_sebelum = 0;
        $tgl_penerimaan_sebelum = null;
        $p_penerimaan_sebelum = 0;
    @endphp
    @foreach ($transactions_penerimaan_sebelum as $tp_seb)
        @php
            $tot_penerimaan_sebelum += $tp_seb->penerimaan;
            $p_penerimaan_sebelum += $tp_seb->penerimaan;
            $tgl_penerimaan_sebelum = $tp_seb->tgl_transaksi;
        @endphp
    @endforeach

    <div class="mt-10">
        <table class="w-full">
            <thead class="bg-[#808080] text-white">
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">URAIAN</th>
                    <th colspan="5">PENDAPATAN</th>
                    <th rowspan="2">KEKURANGAN</th>
                    <th rowspan="2">KELEBIHAN</th>
                    <th rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th class="text-wrap w-20">TANGGAL BON</th>
                    <th class="text-wrap w-20">TANGGAL TRANSAKSI</th>
                    <th>TAGIHAN</th>
                    <th>RETUR</th>
                    <th>PENERIMAAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $saldo_pertama = 0;
                    $tgl_transaksi = null;
                @endphp
                @foreach ($saldo as $sal)
                    @php
                        $tgl_transaksi = $sal->tgl_transaksi;
                        $saldo_pertama += $sal->pendapatan;
                    @endphp
                @endforeach

                @php
                    $saldo_pertama_sebelum = 0;
                    $tgl_transaksi_sebelum = null;
                @endphp
                @foreach ($saldo_sebelum as $sal_seb)
                    @php
                        $tgl_transaksi_sebelum = $sal_seb->tgl_transaksi;
                        $saldo_pertama_sebelum += $sal_seb->pendapatan;
                    @endphp
                @endforeach
                <tr>
                    <td class="text-center bg-[#808080] text-white font-bold">I</td>
                    <td class="text-left pl-4 bg-[#808080] text-white font-bold">SALDO AWAL</td>
                    <td class="text-center"></td>
                    <td class="text-center">
                        @if ($tgl_transaksi)
                            {{ date('d/m/y', strtotime($tgl_transaksi)) }}
                        @endif
                    </td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold">
                        {{ number_format($saldo_pertama, 0, ',', '.') }}
                    </td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold" hidden>
                        {{ number_format($saldo_pertama_sebelum, 0, ',', '.') }}
                    </td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-left pl-4">-</td>
                </tr>

                <tr>
                    <td class="text-center bg-[#808080] text-white font-bold"></td>
                    <td class="text-left pl-4 bg-[#808080] text-white font-bold">PENERIMAAN</td>
                    <td class="text-center"></td>
                    <td class="text-center">
                        @if ($tgl_penerimaan)
                            {{ date('d/m/y', strtotime($tgl_penerimaan)) }}
                        @endif
                    </td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold">
                        {{ number_format($p_penerimaan ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold" hidden>
                        {{ number_format($p_penerimaan_sebelum ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-right pr-4">0</td>
                    <td class="text-left pl-4">-</td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold">
                        {{ number_format(($saldo_pertama ?? 0) + ($p_penerimaan ?? 0), 0, ',', '.') }}
                    </td>
                    <td class="text-right pr-4 bg-[#808080] text-white font-bold" hidden>
                        {{ number_format(($saldo_pertama_sebelum ?? 0) + ($p_penerimaan_sebelum ?? 0), 0, ',', '.') }}
                    </td>
                    <td colspan="3"></td>
                </tr>

                @php
                    $no = 1;
                    $tot_umum_sebelum = 0;
                @endphp
                @foreach ($transactions_umum_sebelum as $tu_seb)
                    @php
                        $jml_tagihan_umum_sebelum = 0;
                        $jml_retur_umum_sebelum = 0;
                        $jml_penerimaan_umum_sebelum = 0;
                        $jml_kekurangan_umum_sebelum = 0;
                        $jml_kelebihan_umum_sebelum = 0;
                    @endphp
                    <tr hidden>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-left pl-4">{{ $tu_seb->item }}</td>
                        <td class="text-center">
                            {{ $tu_seb->tgl_bon ? date('d/m/y', strtotime($tu_seb->tgl_bon)) : '' }}</td>
                        <td class="text-center">{{ date('d/m/y', strtotime($tu_seb->tgl_transaksi)) }}</td>
                        <td class="text-right pr-4">{{ number_format($tu_seb->tagihan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ $tu_seb->retur }}</td>
                        <td class="text-right pr-4">
                            {{ number_format($tu_seb->penerimaan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tu_seb->kekurangan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tu_seb->kelebihan, 0, ',', '.') }}</td>
                        <td class="text-left pl-4">{{ $tu_seb->keterangan }}</td>
                    </tr>
                    @php
                        $jml_tagihan_umum_sebelum += $tu_seb->tagihan;
                        $jml_retur_umum_sebelum += $tu_seb->retur;
                        $jml_penerimaan_umum_sebelum += $tu_seb->penerimaan;
                        $jml_kekurangan_umum_sebelum += $tu_seb->kekurangan;
                        $jml_kelebihan_umum_sebelum += $tu_seb->kelebihan;
                    @endphp
                @endforeach

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
                        <td class="text-center">{{ $tu->tgl_bon ? date('d/m/y', strtotime($tu->tgl_bon)) : '' }}</td>
                        <td class="text-center">{{ date('d/m/y', strtotime($tu->tgl_transaksi)) }}</td>
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
                    $jml_tagihan_kredit_sebelum = 0;
                    $jml_retur_kredit_sebelum = 0;
                    $jml_penerimaan_kredit_sebelum = 0;
                    $jml_kekurangan_kredit_sebelum = 0;
                    $jml_kelebihan_kredit_sebelum = 0;
                    $no = 1;
                @endphp
                @foreach ($transactions_kredit_sebelum as $tk_seb)
                    <tr hidden>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-left pl-4">{{ $tk_seb->item }}</td>
                        <td class="text-center">
                            {{ $tk_seb->tgl_bon ? date('d/m/y', strtotime($tk_seb->tgl_bon)) : '' }}</td>
                        <td class="text-center">{{ date('d/m/y', strtotime($tk_seb->tgl_transaksi)) }}</td>
                        <td class="text-right pr-4">{{ number_format($tk_seb->tagihan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tk_seb->retur, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tk_seb->penerimaan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tk_seb->kekurangan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tk_seb->kelebihan, 0, ',', '.') }}</td>
                        <td class="text-left pl-4">{{ $tk_seb->keterangan }}</td>
                    </tr>
                    @php
                        $jml_tagihan_kredit_sebelum += $tk_seb->tagihan;
                        $jml_retur_kredit_sebelum += $tk_seb->retur;
                        $jml_penerimaan_kredit_sebelum += $tk_seb->penerimaan;
                        $jml_kekurangan_kredit_sebelum += $tk_seb->kekurangan;
                        $jml_kelebihan_kredit_sebelum += $tk_seb->kelebihan;
                    @endphp
                @endforeach

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
                        <td class="text-center">{{ $tk->tgl_bon ? date('d/m/y', strtotime($tk->tgl_bon)) : '' }}</td>
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
                    $jml_tagihan_tunai_sebelum = 0;
                    $jml_retur_tunai_sebelum = 0;
                    $jml_penerimaan_tunai_sebelum = 0;
                    $jml_kekurangan_tunai_sebelum = 0;
                    $jml_kelebihan_tunai_sebelum = 0;
                    $not = 1;
                @endphp
                @foreach ($transactions_tunai_sebelum as $tt_seb)
                    <tr hidden>
                        <td class="text-center">{{ $not++ }}</td>
                        <td class="text-left pl-4">{{ $tt_seb->item }}</td>
                        <td class="text-center">
                            {{ $tt_seb->tgl_bon ? date('d/m/y', strtotime($tt_seb->tgl_bon)) : '' }}</td>
                        <td class="text-center">{{ date('d/m/y', strtotime($tt_seb->tgl_transaksi)) }}</td>
                        <td class="text-right pr-4">{{ number_format($tt_seb->tagihan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tt_seb->retur, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tt_seb->penerimaan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tt_seb->kekurangan, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($tt_seb->kelebihan, 0, ',', '.') }}</td>
                        <td class="text-left pl-4">{{ $tt_seb->keterangan }}</td>
                    </tr>
                    @php
                        $jml_tagihan_tunai_sebelum += $tt_seb->tagihan;
                        $jml_retur_tunai_sebelum += $tt_seb->retur;
                        $jml_penerimaan_tunai_sebelum += $tt_seb->penerimaan;
                        $jml_kekurangan_tunai_sebelum += $tt_seb->kekurangan;
                        $jml_kelebihan_tunai_sebelum += $tt_seb->kelebihan;
                    @endphp
                @endforeach

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
                        <td class="text-center">{{ $tt->tgl_bon ? date('d/m/y', strtotime($tt->tgl_bon)) : '' }}</td>
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
                    $t_pendapatan = ($jml_penerimaan ?? 0) + ($saldo_pertama ?? 0) + ($p_penerimaan ?? 0);
                @endphp
                @php
                    $jml_tagihan_sebelum =
                        ($jml_tagihan_tunai_sebelum ?? 0) +
                        ($jml_tagihan_kredit_sebelum ?? 0) +
                        ($jml_tagihan_umum_sebelum ?? 0);
                    $jml_retur_sebelum =
                        ($jml_retur_tunai_sebelum ?? 0) +
                        ($jml_retur_kredit_sebelum ?? 0) +
                        ($jml_retur_umum_sebelum ?? 0);
                    $jml_penerimaan_sebelum =
                        ($jml_penerimaan_tunai_sebelum ?? 0) +
                        ($jml_penerimaan_kredit_sebelum ?? 0) +
                        ($jml_penerimaan_umum_sebelum ?? 0);
                    $jml_kekurangan_sebelum =
                        ($jml_kekurangan_tunai_sebelum ?? 0) +
                        ($jml_kekurangan_kredit_sebelum ?? 0) +
                        ($jml_kekurangan_umum_sebelum ?? 0);
                    $jml_kelebihan_sebelum =
                        ($jml_kelebihan_tunai_sebelum ?? 0) +
                        ($jml_kelebihan_kredit_sebelum ?? 0) +
                        ($jml_kelebihan_umum_sebelum ?? 0);
                    $t_pendapatan_sebelum =
                        ($jml_penerimaan_sebelum ?? 0) + ($saldo_pertama_sebelum ?? 0) + ($p_penerimaan_sebelum ?? 0);
                @endphp
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($jml_tagihan, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($jml_tagihan_sebelum, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($jml_retur, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($jml_retur_sebelum, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($jml_penerimaan, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($jml_penerimaan_sebelum, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($jml_kekurangan, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($jml_kekurangan_sebelum, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($jml_kelebihan, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($jml_kelebihan_sebelum, 0, ',', '.') }}
                    </th>
                    <td></td>
                </tr>
                <tr class="bg-[#808080] text-white">
                    <td></td>
                    <th colspan="5">TOTAL PENDAPATAN</th>
                    <th class="text-right pr-4">
                        {{ number_format($t_pendapatan, 0, ',', '.') }}
                    </th>
                    <th class="text-right pr-4" hidden>
                        {{ number_format($t_pendapatan_sebelum, 0, ',', '.') }}
                    </th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="page-break"></div>

    {{-- PENGELUARAN --}}

    <div class="">
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
                    <th rowspan="2" class="w-20">TANGGAL BON</th>
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
                @php
                    $t_umum = 0;
                    $t_operasional = 0;
                    $t_bahan = 0;
                    $t_prive = 0;
                    $t_total = 0;
                    $no = 1;
                @endphp
                @foreach ($transactions_keluar as $t)
                    @php
                        $umum = 0;
                        $operasional = 0;
                        $bahan = 0;
                        $prive = 0;

                        if ($t->jenis_pengeluaran === 'UMUM') {
                            $umum = $t->pengeluaran;
                        } elseif ($t->jenis_pengeluaran === 'OPERASIONAL') {
                            $operasional = $t->pengeluaran;
                        } elseif ($t->jenis_pengeluaran === 'BAHAN') {
                            $bahan = $t->pengeluaran;
                        } elseif ($t->jenis_pengeluaran === 'PRIVE') {
                            $prive = $t->pengeluaran;
                        }

                        $total = $umum + $operasional + $bahan + $prive;
                        $t_umum += $umum;
                        $t_operasional += $operasional;
                        $t_bahan += $bahan;
                        $t_prive += $prive;
                        $t_total += $total;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-left pl-4">{{ $t->item }}</td>
                        <td class="text-center">{{ $t->tgl_bon ? date('d/m/y', strtotime($t->tgl_bon)) : '' }}</td>
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

                @php
                    $t_umum_sebelum = 0;
                    $t_operasional_sebelum = 0;
                    $t_bahan_sebelum = 0;
                    $t_prive_sebelum = 0;
                    $t_total_sebelum = 0;
                    $no = 1;
                @endphp
                @foreach ($transactions_keluar_sebelum as $t_seb)
                    @php
                        $umum_sebelum = 0;
                        $operasional_sebelum = 0;
                        $bahan_sebelum = 0;
                        $prive_sebelum = 0;

                        if ($t_seb->jenis_pengeluaran === 'UMUM') {
                            $umum_sebelum = $t_seb->pengeluaran;
                        } elseif ($t_seb->jenis_pengeluaran === 'OPERASIONAL') {
                            $operasional_sebelum = $t_seb->pengeluaran;
                        } elseif ($t_seb->jenis_pengeluaran === 'BAHAN') {
                            $bahan_sebelum = $t_seb->pengeluaran;
                        } elseif ($t_seb->jenis_pengeluaran === 'PRIVE') {
                            $prive_sebelum = $t_seb->pengeluaran;
                        }

                        $total_sebelum = $umum_sebelum + $operasional_sebelum + $bahan_sebelum + $prive_sebelum;
                        $t_umum_sebelum += $umum_sebelum;
                        $t_operasional_sebelum += $operasional_sebelum;
                        $t_bahan_sebelum += $bahan_sebelum;
                        $t_prive_sebelum += $prive_sebelum;
                        $t_total_sebelum += $total_sebelum;
                    @endphp
                    <tr hidden>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-left pl-4">{{ $t_seb->item }}</td>
                        <td class="text-center">{{ $t_seb->tgl_bon ? date('d/m/y', strtotime($t_seb->tgl_bon)) : '' }}
                        </td>
                        <td class="text-center">{{ date('d/m/y', strtotime($t_seb->tgl_transaksi)) }}</td>
                        <td class="text-right pr-4">{{ number_format($umum_sebelum, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($operasional_sebelum, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($bahan_sebelum, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($prive_sebelum, 0, ',', '.') }}</td>
                        <td class="text-right pr-4">{{ number_format($total_sebelum, 0, ',', '.') }}</td>
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
                    <th></th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($t_umum, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($t_umum_sebelum, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($t_operasional, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($t_operasional_sebelum, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($t_bahan, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($t_bahan_sebelum, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($t_prive, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($t_prive_sebelum, 0, ',', '.') }}
                    </th>
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
                    <th></th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($t_total, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($t_total_sebelum, 0, ',', '.') }}
                    </th>
                    <th></th>
                    <th class="bg-[#808080] text-white text-right pr-4">
                        {{ number_format($t_pendapatan - $t_total, 0, ',', '.') }}
                    </th>
                    <th class="bg-[#808080] text-white text-right pr-4" hidden>
                        {{ number_format($t_pendapatan_sebelum - $t_total_sebelum, 0, ',', '.') }}
                    </th>
                </tr>
            </tfoot>

        </table>
    </div>

    {{-- PERHITUNGAN --}}

    <div class="page-break"></div>

    <div class="mt-10 font-bold flex items-center justify-center">

        {{-- SALDO AWAL DARI SALDO AKHIR SEBELUMNYA --}}
        @php
            $pendapatan = 0;
        @endphp
        @foreach ($saldo_sebelum as $ss)
            @php
                $pendapatan = $ss->pendapatan;
            @endphp
        @endforeach

        @if ($pendapatan <= 0)
            @php
                $sld = $saldo_pertama;
            @endphp
        @else
            @php
                $sld = $pendapatan;
            @endphp
        @endif


        {{-- TAMBAHAN KAS (HARI INI)  --}}
        @forelse ($kas as $k)
            @php
                $ks = $k->kas;
            @endphp
        @empty
            @php
                $ks = 0;
            @endphp
        @endforelse

        {{-- SALDO + KAS --}}
        @php
            $sld_ks = $sld + $ks;
        @endphp

        {{-- SALDO KAS + PENDAPATAN (HARI INI) --}}
        @php
            $saldokas_pendapatan = $t_pendapatan;
            // $saldokas_pendapatan_sebelum = $t_pendapatan_sebelum + $ks - $t_total;
        @endphp

        {{-- SALDO AKHIR --}}
        @php
            $saldo_akhir = $saldokas_pendapatan - $t_total;
        @endphp



        {{-- SEBELUMNYA --}}
        @forelse ($kas_sebelum as $kseb)
            @php
                $ksebl = $kseb->kas;
            @endphp
        @empty
            @php
                $ksebl = 0;
            @endphp
        @endforelse

        @php
            $saldokas_pendapatan_sebelum = $t_pendapatan_sebelum + $ksebl - $t_total_sebelum;
        @endphp

        @php
            $pendapatan = 0;
        @endphp
        @foreach ($saldo_sebelum as $ss)
            @php
                $pendapatan = $ss->pendapatan;
            @endphp
        @endforeach

        @php
            $saldokas_sebelum = $ksebl + $pendapatan;
            $saldokas_sebelumnya = $ks + $saldokas_pendapatan_sebelum;
        @endphp

        @php
            $saldokas = $saldokas_sebelumnya + $t_pendapatan;
        @endphp

        @php
            $saldokas_akhir = $saldokas - $t_total;
        @endphp

        <table>
            <tr>
                <th class="w-52 text-left text-wrap">SALDO AWAL DARI SALDO AKHIR SEBELUMNYA</th>
                <th class="w-52 text-right">
                    {{ number_format($saldokas_pendapatan_sebelum, 0, ',', '.') }}
                </th>
                <th rowspan="2" class="pt-5">+</th>
            </tr>
            <tr>
                <th class="w-52 text-left">TAMBAHAN KAS</th>

                <th class="w-52 text-right">
                    {{ number_format($ks, 0, ',', '.') }}
                </th>
            </tr>
            <tr>
                <th class="w-52 text-left"></th>
                <th class="w-52 text-right bg-[#808080] text-white">
                    {{ number_format($saldokas_sebelumnya, 0, ',', '.') }}</th>
                <th rowspan="2" class="pt-5">+</th>
            </tr>
            <tr>
                <th class="w-52 text-left">PENJUALAN PENDAPATAN</th>
                <th class="w-52 text-right">
                    {{ number_format($t_pendapatan, 0, ',', '.') }}
                    {{-- {{ number_format($t_pendapatan_sebelum, 0, ',', '.') }} --}}
                </th>
            </tr>
            <tr>
                <th class="w-52 text-left"></th>
                <th class="w-52 text-right bg-[#808080] text-white">

                    {{ number_format($saldokas, 0, ',', '.') }}
                </th>
                <th rowspan="2" class="pt-5">-</th>
            </tr>
            <tr>
                <th class="w-52 text-left">PENGELUARAN</th>
                <th class="w-52 text-right">
                    {{ number_format($t_total ?? 0, 0, ',', '.') }}
                    {{-- {{ number_format($t_total_sebelum ?? 0, 0, ',', '.') }} --}}
                </th>
            </tr>
            <tr>
                <th class="w-96 text-left">SALDO AKHIR (PENDAPATAN BERSIH PERHARI)</th>
                <th class="w-52 text-right bg-[#808080] text-white">

                    {{ number_format($saldokas_akhir ?? 0, 0, ',', '.') }}
                    {{-- {{ number_format($saldo_akhir_sebelum ?? 0, 0, ',', '.') }} --}}
                </th>
            </tr>
        </table>

    </div>



</body>
<script>
    window.print();
</script>

</html>

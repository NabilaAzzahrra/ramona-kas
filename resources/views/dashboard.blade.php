<x-app-layout>
    <x-slot name="header">
        <h2 class="px-3 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="mx-3">
        <div class="pt-5">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
                    <div class="px-6 pb-2 pt-5 text-slate-50 font-semibold text-lg ">
                        {{ __("Hai,") }}
                        {{ Auth::user()->name }}
                        {{ __("🖐") }}
                    </div>
                    <div class="px-6 pb-6 text-slate-50 font-normal text-md">
                        <p>Semangat Untuk Hari Ini !!!</p>
                    </div>
                </div>
            </div>
        </div> --}}

    <div class="pt-5">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 justify-center">
                <div>
                    <div class="bg-white p-3 rounded-xl shadow-md">
                        <div class="flex flex-row items-center gap-3">
                            <div class="p-1 rounded-full border">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                            <div class="font-semibold text-slate-700 text-lg px-1 text-wrap">Klasifikasi Pendapatan</div>
                        </div>
                        <div class="font-bold text-slate-900 text-4xl py-3">
                            @php
                                $countKlasifikasi = count($klasifikasi);
                            @endphp
                            {{ $countKlasifikasi }}
                        </div>
                    </div>
                    <div class="flex justify-between px-6 py-2 -mt-2 rounded-b-xl shadow-md bg-[#0C4B54]">
                        <p class="text-sm text-emerald-400 font-semibold"></p>
                        <p class="text-sm text-slate-200">Klasifikasi Pendapatan</p>
                    </div>
                </div>

                <div>
                    <div class="bg-white p-3 rounded-xl shadow-md">
                        <div class="flex flex-row items-center gap-3">
                            <div class="p-1 rounded-full border">
                                <i class="fa-solid fa-tarp"></i>
                            </div>
                            <div class="font-semibold text-slate-700 text-lg px-1 text-wrap">Klasifikasi Pengeluaran</div>
                        </div>
                        <div class="font-bold text-slate-900 text-4xl py-3">
                            @php
                                $countKlasifikasiPengeluaran = count($jenis_pengeluaran);
                            @endphp
                            {{ $countKlasifikasiPengeluaran }}
                        </div>
                    </div>
                    <div class="flex justify-between px-6 py-2 -mt-2 rounded-b-xl shadow-md bg-[#0C4B54]">
                        <p class="text-sm text-emerald-400 font-semibold"></p>
                        <p class="text-sm text-slate-200">Klasifikasi Pengeluaran</p>
                    </div>
                </div>

                <div>
                    <div class="bg-white p-3 rounded-xl shadow-md">
                        <div class="flex flex-row items-center gap-3">
                            <div class="p-1 rounded-full border">
                                <i class="fa-solid fa-money-check-dollar"></i>
                            </div>
                            <div class="font-semibold text-slate-700 text-lg px-1 text-wrap">Pendapatan</div>
                        </div>
                        <div class="font-bold text-slate-900 text-4xl py-3 text-wrap">
                            Rp. {{ number_format($sumPendapatan, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="flex justify-between px-6 py-2 -mt-2 rounded-b-xl shadow-md bg-[#0C4B54]">
                        <p class="text-sm text-emerald-400 font-semibold"></p>
                        <p class="text-sm text-slate-200">Pendapatan Per Hari Ini</p>
                    </div>
                </div>

                <div>
                    <div class="bg-white p-3 rounded-xl shadow-md">
                        <div class="flex flex-row items-center gap-3">
                            <div class="p-1 rounded-full border">
                                <i class="fa-solid fa-coins"></i>
                            </div>
                            <div class="font-semibold text-slate-700 text-lg px-1 text-wrap">Pengeluaran</div>
                        </div>
                        <div class="font-bold text-slate-900 text-4xl py-3 text-wrap">
                            Rp. {{ number_format($sumPengeluaran, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="flex justify-between px-6 py-2 -mt-2 rounded-b-xl shadow-md bg-[#0C4B54]">
                        <p class="text-sm text-red-400 font-semibold"></p>
                        <p class="text-sm text-slate-200">Pengeluaran Per Hari Ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="max-w-8xl px-6 lg:px-8 py-5 lg:py-5 mt-5 mb-2 md:mx-8 rounded-xl bg-white">
        <div class="flex flex-col md:flex-row gap-5">
            <div class="md:w-1/2 border rounded-2xl">
                <h1 class="font-bold text-slate-100 text-md md:text-xl rounded-t-xl bg-[#0C4B54] p-3 text-center">
                    Pendapatan</h1>
                <canvas id="Chartmasuk"></canvas>
            </div>
            <div class="md:w-1/2 border rounded-2xl">
                <h1 class="font-bold text-slate-100 text-md md:text-xl rounded-t-xl bg-[#0C4B54] p-3 text-center">
                    Pengeluaran</h1>
                <canvas id="Chartkeluar"></canvas>
            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('js/chart.umd.js') }}"></script>

    <script>
        const labels = {!! $labels !!};
        const data = {!! $data !!};

        const ctx = document.getElementById('Chartmasuk').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: data,
                    borderWidth: 1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const labels_pengeluaran = {!! $labels_pengeluaran !!};
        const data_pengeluaran = {!! $data_pengeluaran !!};

        const ctx2 = document.getElementById('Chartkeluar');

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: labels_pengeluaran,
                datasets: [{
                    label: 'Pengeluaran',
                    data: data_pengeluaran,
                    borderWidth: 1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>

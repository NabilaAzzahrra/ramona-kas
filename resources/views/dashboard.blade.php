<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mx-3">
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
        </div>
    
        <div class="pt-5">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 justify-center">
                    <div>
                        <div class="bg-white p-3 rounded-xl shadow-md">
                            <div class="flex flex-row items-center gap-3">
                                <div class="p-1 rounded-full border">
                                    <i class="fa-solid fa-file-lines"></i>
                                </div>
                                <div class="font-semibold text-slate-700 text-lg px-1">Klasifikasi</div>
                            </div>
                            <div class="font-bold text-slate-900 text-4xl pt-3">
                                22
                            </div>
                        </div>
                        <div class="flex justify-between px-6 py-2 rounded-b-xl shadow-md bg-slate-200">
                            <p class="text-sm text-emerald-400 font-semibold">12%</p>
                            <p class="text-sm text-slate-700">Klasifikasi Per Hari Ini</p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="bg-white p-3 rounded-xl shadow-md">
                            <div class="flex flex-row items-center gap-3">
                                <div class="p-1 rounded-full border">
                                    <i class="fa-solid fa-tarp"></i>
                                </div>
                                <div class="font-semibold text-slate-700 text-lg px-1">Jenis Pengeluaran</div>
                            </div>
                            <div class="font-bold text-slate-900 text-4xl pt-3">
                                30
                            </div>
                        </div>
                        <div class="flex justify-between px-6 py-2 rounded-b-xl shadow-md bg-slate-200">
                            <p class="text-sm text-emerald-400 font-semibold">15%</p>
                            <p class="text-sm text-slate-700">Jenis Pengeluaran Per Hari Ini</p>
                        </div>
                    </div>
    
                    <div>
                        <div class="bg-white p-3 rounded-xl shadow-md">
                            <div class="flex flex-row items-center gap-3">
                                <div class="p-1 rounded-full border">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                </div>
                                <div class="font-semibold text-slate-700 text-lg px-1">Pendapatan</div>
                            </div>
                            <div class="font-bold text-slate-900 text-4xl pt-3">
                                Rp. 15.000.000
                            </div>
                        </div>
                        <div class="flex justify-between px-6 py-2 rounded-b-xl shadow-md bg-slate-200">
                            <p class="text-sm text-emerald-400 font-semibold">30%</p>
                            <p class="text-sm text-slate-700">Pendapatan Per Hari Ini</p>
                        </div>
                    </div>
    
                    <div>
                        <div class="bg-white p-3 rounded-xl shadow-md">
                            <div class="flex flex-row items-center gap-3">
                                <div class="p-1 rounded-full border">
                                    <i class="fa-solid fa-coins"></i>
                                </div>
                                <div class="font-semibold text-slate-700 text-lg px-1">Pengeluaran</div>
                            </div>
                            <div class="font-bold text-slate-900 text-4xl pt-3">
                                Rp. 1.250.000
                            </div>
                        </div>
                        <div class="flex justify-between px-6 py-2 rounded-b-xl shadow-md bg-slate-200">
                            <p class="text-sm text-red-400 font-semibold">10%</p>
                            <p class="text-sm text-slate-700">Pengeluaran Per Hari Ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        
        <div class="max-w-8xl px-6 lg:px-8 py-5 lg:py-5 mt-5 mb-2 md:mx-8 rounded-xl bg-white">
            <div class="flex flex-col md:flex-row gap-5">
                <div class="md:w-1/2 border rounded-2xl">
                    <h1 class="font-bold text-[#0C4B54] text-md md:text-xl rounded-t-xl bg-slate-300 p-3 text-center">Pendapatan</h1>
                    <canvas id="Chartmasuk"></canvas>
                </div>
                <div class="md:w-1/2 border rounded-2xl">
                    <h1 class="font-bold text-[#0C4B54] text-md md:text-xl rounded-t-xl bg-slate-300 p-3 text-center">Pengeluaran</h1>
                    <canvas id="Chartkeluar"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/chart.umd.js') }}"></script>

        <script>
            const ctx = document.getElementById('Chartmasuk');
          
            new Chart(ctx, {
              type: 'line',
              data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                  label: '# of Votes',
                  data: [12, 19, 3, 5, 2, 3],
                  borderWidth: 1
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

            const ctx2 = document.getElementById('Chartkeluar');
          
            new Chart(ctx2, {
              type: 'line',
              data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                  label: '# of Votes',
                  data: [12, 19, 3, 5, 2, 3],
                  borderWidth: 1
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

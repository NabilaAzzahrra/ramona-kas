<x-app-layout>
    <x-slot name="header">
        <h2 class="px-3 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full md:w-9/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="p-3 rounded-xl font-bold text-slate-800 text-lg">
                                FORM INPUT PENGELUARAN
                            </div>
                            <hr>
                            <form id="pengeluaran-form" action="{{ route('pengeluaran.store') }}" method="post" onsubmit="return confirmSubmission(event)">
                                @csrf
                                <div class="p-4 rounded-xl">
                                    <div class="flex gap-5">
                                        <div class="flex gap-5 w-full">
                                            <div class="mb-5 w-full">
                                                <label for="klasifikasi"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klasifikasi
                                                    Pengeluaran
                                                    <span class="text-red-500">*</span></label>
                                                <select
                                                    class="js-example-placeholder-single js-states form-control w-full m-6" id="klasifikasi"
                                                    name="klasifikasi" data-placeholder="Pilih Klasifikasi Pengeluaran">
                                                    <option value="">Pilih...</option>
                                                    @foreach ($jenis_pengeluaran as $m)
                                                        <option value="{{ $m->id }}">{{ $m->jenis_pengeluaran }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('klasifikasi') }}</span>
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="tgl_bon"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                    Bon
                                                    <span class="text-red-500"></span></label>
                                                <input type="date" id="tgl_bon" name="tgl_bon"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Uraian disini ..." />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('tgl_bon') }}</span>
                                            </div>
                                        </div>
                                        <div class="flex w-full gap-5">
                                            <div class="mb-5 w-full">
                                                <label for="tgl_pengeluaran"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                    Pengeluaran</label>
                                                <input type="date" id="tgl_pengeluaran" name="tgl_pengeluaran"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Uraian disini ..." required />
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="uraian"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Uraian</label>
                                                <input type="text" id="uraian" name="uraian"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Uraian disini ..." required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-5">
                                        <div class="mb-5 w-full">
                                            <label for="keterangan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                            <input type="text" id="keterangan" name="keterangan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Keterangan disini ..." required />
                                        </div>
                                        <div class="mb-5 w-full">
                                            <label for="pengeluaran"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal
                                                Pengeluaran</label>
                                            <input type="number" id="pengeluaran" name="pengeluaran"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Pengeluaran disini ..." required />
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-[#0C4B54] hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmSubmission(event) {
            event.preventDefault();
            const klasifikasiElement = document.getElementById('klasifikasi');
            const klasifikasiText = klasifikasiElement.options[klasifikasiElement.selectedIndex].text;
            const tgl_bon = document.getElementById('tgl_bon').value;
            const uraian = document.getElementById('uraian').value;
            const keterangan = document.getElementById('keterangan').value;
            const pengeluaran = document.getElementById('pengeluaran').value;
            const confirmation = confirm(`Apakah data berikut sudah sesuai?\n\nKlasifikasi: ${klasifikasiText}\n\nTanggal Bon: ${tgl_bon}\n\nUraian: ${uraian}\n\nKeterangan: ${keterangan}\n\nNominal Pengeluaran: ${pengeluaran}\n\nJika sudah sesuai, tekan OK untuk melanjutkan.`);
            if (confirmation) {
                document.getElementById('pengeluaran-form').submit();
            }
        }
    </script>
    <script>
        const uraianInput = document.getElementById('uraian');

        uraianInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>
</x-app-layout>

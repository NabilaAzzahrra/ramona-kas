<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl px-6 text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Pendapatan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full md:w-9/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="p-3 rounded-xl font-bold text-slate-800 text-lg">
                                FORM INPUT PENDAPATAN
                            </div>
                            <hr>
                            <form id="pendapatan-form" action="{{ route('pendapatan.store') }}" method="post"
                                onsubmit="return confirmSubmission(event)">
                                @csrf
                                <div class="p-4 rounded-xl">
                                    <div class="flex gap-5">
                                        <div class="flex gap-5 w-full">
                                            <div class="mb-5 w-full">
                                                <label for="klasifikasi"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klasifikasi
                                                    <span class="text-red-500">*</span></label>
                                                <select
                                                    class="js-example-placeholder-single js-states form-control w-full m-6"
                                                    id="klasifikasi" name="klasifikasi"
                                                    data-placeholder="Pilih Klasifikasi">
                                                    <option value="">Pilih...</option>
                                                    @foreach ($klasifikasi as $m)
                                                        <option value="{{ $m->id }}">{{ $m->klasifikasi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('lantai') }}</span>
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="klasifikasi"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                    Bon
                                                    <span class="text-red-500"></span></label>
                                                <input type="date" id="tgl_bon" name="tgl_bon"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Uraian disini ..." />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('lantai') }}</span>
                                            </div>

                                        </div>
                                        <div class="flex w-full gap-5">
                                            <div class="mb-5 w-full">
                                                <label for="tgl_pendapatan"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                    Pendapatan</label>
                                                <input type="date" id="tgl_pendapatan" name="tgl_pendapatan"
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
                                            <label for="tagihan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal
                                                Pendapatan</label>
                                            <input type="number" id="tagihan" name="tagihan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Nominal Pendapatan disini ..." required />
                                        </div>
                                        <div class="mb-5 w-full">
                                            <label for="retur"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Retur</label>
                                            <input type="number" id="retur" name="retur"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Retur disini ..." required />
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
                                            <label for="penerimaan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerimaan</label>
                                            <input type="number" id="penerimaan" name="penerimaan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Penerimaan disini ..." required />
                                        </div>
                                    </div>
                                    <div class="flex gap-5">
                                        <div class="mb-5 w-full">
                                            <label for="kekurangan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kekurangan</label>
                                            <input type="text" id="kekurangan" name="kekurangan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Kekurangan disini ..." readonly />
                                        </div>
                                        <div class="mb-5 w-full">
                                            <label for="kelebihan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelebihan</label>
                                            <input type="number" id="kelebihan" name="kelebihan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Kelebihan disini ..." readonly />
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
        function calculateDifference() {
            const tagihan = parseFloat(document.getElementById('tagihan').value) || 0;
            const retur = parseFloat(document.getElementById('retur').value) || 0;
            const penerimaan = parseFloat(document.getElementById('penerimaan').value) || 0;

            if (tagihan === 0 && retur === 0) {
                document.getElementById('kekurangan').value = 0;
                document.getElementById('kelebihan').value = 0;
            } else {
                const selisih = (tagihan - retur) - penerimaan;

                if (selisih > 0) {
                    document.getElementById('kekurangan').value = selisih;
                    document.getElementById('kelebihan').value = 0;
                } else {
                    document.getElementById('kelebihan').value = Math.abs(selisih);
                    document.getElementById('kekurangan').value = 0;
                }
            }
        }

        document.getElementById('tagihan').addEventListener('input', calculateDifference);
        document.getElementById('retur').addEventListener('input', calculateDifference);
        document.getElementById('penerimaan').addEventListener('input', calculateDifference);
    </script>
    <script>
        function confirmSubmission(event) {
            event.preventDefault();
            const klasifikasiElement = document.getElementById('klasifikasi');
            const klasifikasiText = klasifikasiElement.options[klasifikasiElement.selectedIndex].text;
            const tgl_bon = document.getElementById('tgl_bon').value;
            const uraian = document.getElementById('uraian').value;
            const tagihan = document.getElementById('tagihan').value;
            const retur = document.getElementById('retur').value;
            const keterangan = document.getElementById('keterangan').value;
            const penerimaan = document.getElementById('penerimaan').value;
            const confirmation = confirm(
                `Apakah data berikut sudah sesuai?\n\nKlasifikasi: ${klasifikasiText}\n\nTanggal Bon: ${tgl_bon}\n\nUraian: ${uraian}\n\Nominal Pendapatan: ${tagihan}\n\Retur: ${retur}\n\nKeterangan: ${keterangan}\n\nPenerimaan: ${penerimaan}\n\nJika sudah sesuai, tekan OK untuk melanjutkan.`
                );
            if (confirmation) {
                document.getElementById('pendapatan-form').submit();
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

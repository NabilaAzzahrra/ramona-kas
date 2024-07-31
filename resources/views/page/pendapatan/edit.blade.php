<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full md:w-9/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="p-6 bg-red-500 rounded-xl">
                                FORM INPUT PENDAPATAN
                            </div>
                            <form action="{{ route('pendapatan.update',  $pendapatan->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="p-4 rounded-xl">
                                    <div class="flex gap-5">
                                        <div class="mb-5 w-full">
                                            <label for="klasifikasi"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klasifikasi
                                                <span class="text-red-500">*</span></label>
                                            <select
                                                class="js-example-placeholder-single js-states form-control w-full m-6"
                                                name="klasifikasi" data-placeholder="Pilih Klasifikasi">
                                                <option value="{{ $pendapatan->id_klasifikasi }}">
                                                    {{ $pendapatan->klasifikasi->klasifikasi }}</option>
                                                @foreach ($klasifikasi as $m)
                                                    @if ($m->id != $pendapatan->id_klasifikasi)
                                                        <option value="{{ $m->id }}">
                                                            {{ $m->klasifikasi }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span
                                                class="text-sm m-l text-red-500">{{ $errors->first('klasifikasi') }}</span>
                                        </div>
                                        <div class="mb-5 w-full">
                                            <label for="uraian"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Uraian</label>
                                            <input type="text" id="uraian" name="uraian"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Uraian disini ..."
                                                value="{{ $pendapatan->item_pendapatan }}" required />
                                        </div>
                                    </div>
                                    <div class="flex gap-5">
                                        <div class="mb-5 w-full">
                                            <label for="tagihan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tagihan</label>
                                            <input type="number" id="tagihan" name="tagihan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Tagihan disini ..."
                                                value={{ $pendapatan->tagihan }} required />
                                        </div>
                                        <div class="mb-5 w-full">
                                            <label for="retur"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Retur</label>
                                            <input type="number" id="retur" name="retur"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Retur disini ..." value={{ $pendapatan->retur }}
                                                required />
                                        </div>
                                    </div>
                                    <div class="flex gap-5">
                                        <div class="mb-5 w-full">
                                            <label for="keterangan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                            <input type="text" id="keterangan" name="keterangan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Keterangan disini ..."
                                                value={{ $pendapatan->keterangan }} required />
                                        </div>
                                        <div class="mb-5 w-full">
                                            <label for="penerimaan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerimaan</label>
                                            <input type="number" id="penerimaan" name="penerimaan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Penerimaan disini ..."
                                                value={{ $pendapatan->penerimaan }} required />
                                        </div>
                                        <div class="mb-5 w-full" hidden>
                                            <label for="penerimaan_awal"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerimaan awal</label>
                                            <input type="number" id="penerimaan_awal" name="penerimaan_awal"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Penerimaan disini ..."
                                                value={{ $pendapatan->penerimaan }} />
                                        </div>
                                    </div>
                                    <div class="flex gap-5">
                                        <div class="mb-5 w-full">
                                            <label for="kekurangan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kekurangan</label>
                                            <input type="text" id="kekurangan" name="kekurangan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Kekurangan disini ..."
                                                value={{ $pendapatan->kekurangan }} readonly />
                                        </div>
                                        <div class="mb-5 w-full">
                                            <label for="kelebihan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelebihan</label>
                                            <input type="number" id="kelebihan" name="kelebihan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Masukan Kelebihan disini ..."
                                                value={{ $pendapatan->kelebihan }} readonly />
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
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
</x-app-layout>

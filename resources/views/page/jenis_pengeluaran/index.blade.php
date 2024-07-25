<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jenis Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="w-full md:w-3/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="p-3 font-bold text-xl text-slate-800">
                                Input Jenis Pengeluaran
                            </div>
                            <form action="{{ route('jenis_pengeluaran.store') }}" method="post">
                                @csrf
                                <div class="p-4 rounded-xl">
                                    <div class="mb-5">
                                        <label for="jenis_pengeluaran"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Pengeluaran</label>
                                        <input type="text" id="jenis_pengeluaran" name="jenis_pengeluaran"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C4B54] focus:border-blue-950 block w-full p-2.5"
                                            placeholder="Masukan Nama Jenis Pengeluaran disini ..." required />
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-[#0C4B54] hover:bg-[#13393f] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl shadow-md text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-9/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="px-10 py-4 font-bold text-xl text-slate-800">
                                Data Jenis Pengeluaran
                            </div>
                            <div class="flex justify-center overflow-hidden">
                                <div class="py-10 md:p-12" style="width:100%">
                                    <table class="table table-bordered overflow-x-scroll" id="jenis_pengeluaran-datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-7">No.</th>
                                                <th>Jenis Pengeluaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                        Tambah Sumber Database
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="flex flex-col  p-4 space-y-6">

                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900">jenis_pengeluaran</label>
                            <input type="text" id="jenis_pengeluarans" name="jenis_pengeluaran"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                id="" placeholder="Masukan jenis_pengeluaran disini...">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" data-modal-target="sourceModal" onclick="changeSourceModal(this)"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            console.log('RUN!');
            $('#jenis_pengeluaran-datatable').DataTable({
                ajax: {
                    url: 'api/jenis_pengeluaran',
                    dataSrc: 'jenis_pengeluaran'
                },
                initComplete: function() {
                    // Menengahkan teks di semua sel pada header (baris pertama)
                    $('#jenis_pengeluaran-datatable thead th').css('text-align', 'center');
                },
                columns: [{
                    data: 'no',
                    render: (data, type, row, meta) => {
                        return `<div style="text-align:center">${meta.row + 1}.</div>`;;
                    }
                }, {
                    data: 'jenis_pengeluaran',
                    render: (data, type, row) => {
                        return data;
                    }
                }, {
                    data: {
                        no: 'no',
                        name: 'name'
                    },
                    render: (data) => {
                        let editUrl =
                            `<button type="button" data-id="${data.id}"
                                                        data-modal-target="sourceModal" data-jenis_pengeluaran="${data.jenis_pengeluaran}"
                                                        onclick="editSourceModal(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return jenis_pengeluaranDelete('${data.id}','${data.jenis_pengeluaran}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                        return `<div style="text-align:center">${editUrl} ${deleteUrl}</div>`;
                    }
                }, ],
            });
        });

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const jenis_pengeluaran = button.dataset.jenis_pengeluaran;
            let url = "{{ route('jenis_pengeluaran.update', ':id') }}".replace(':id', id);
            console.log(url);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update jenis_pengeluaran ${jenis_pengeluaran}`;
            document.getElementById('jenis_pengeluarans').value = jenis_pengeluaran;
            document.getElementById('formSourceButton').innerText = 'Simpan';
            document.getElementById('formSourceModal').setAttribute('action', url);
            let csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');
            formModal.appendChild(csrfToken);

            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            formModal.appendChild(methodInput);

            status.classList.toggle('hidden');
        }

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.toggle('hidden');
        }

        const jenis_pengeluaranDelete = async (id, jenis_pengeluaran) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus jenis_pengeluaran ${jenis_pengeluaran} ?`);
            if (tanya) {
                await axios.post(`/jenis_pengeluaran/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        // Handle success
                        location.reload();
                    })
                    .catch(function(error) {
                        // Handle error
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        }
    </script>
</x-app-layout>

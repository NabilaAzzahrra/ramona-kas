<x-app-layout>
    <x-slot name="header">
        <h2 class="px-6 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Klasifikasi Pendapatan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="success-message hidden inline-flex mx-6 bg-emerald-100 border border-emerald-600 rounded-md px-4 py-2 shadow-md font-semibold text-emerald-700" id="successMessage">Data berhasil ditambahkan!</div>
            </div>
            <div class="flex flex-col md:flex-row justify-center">
                <div class="w-full md:w-3/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="p-3 font-bold text-xl text-slate-800">
                                Form Input Klasifikasi Pendapatan
                            </div>
                            <form id="dataForm" action="{{ route('klasifikasi.store') }}" method="post">
                                @csrf
                                <div class="p-4 rounded-xl">
                                    <div class="mb-5">
                                        <label for="klasifikasi"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klasifikasi</label>
                                        <input type="text" id="klasifikasi" name="klasifikasi"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Nama Klasifikasi disini ..." required />
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-[#0C4B54] hover:bg-[#13393f] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl shadow-md text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-9/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center">
                                <div class="px-10 py-4 font-bold text-xl text-slate-800">
                                    Data Klasifikasi Pendapatan
                                </div>
                            </div>
                            <hr class="mx-8">
                            <div class="flex justify-center">
                                <div class="overflow-x-scroll p-12" style="width:100%">
                                    <table class="min-w-full divide-y divide-gray-200" id="klasifikasi-datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-7">No.</th>
                                                <th>Klasifikasi Pendapatan</th>
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
            <div class="w-full md:w-1/3 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="font-bold text-slate-800 text-xl" id="title_source">
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
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900">klasifikasi</label>
                            <input type="text" id="klasifikasis" name="klasifikasi"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                placeholder="Masukan klasifikasi disini...">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-[#0C4B54] hover:bg-[#0c3454] flex items-center gap-3 text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold">Simpan</button>
                        <button type="button" data-modal-target="sourceModal" onclick="changeSourceModal(this)"
                            class="bg-red-600 hover:bg-red-700 flex items-center gap-3 text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            console.log('RUN!');
            $('#klasifikasi-datatable').DataTable({
                ajax: {
                    url: 'api/klasifikasi',
                    dataSrc: 'klasifikasi'
                },
                initComplete: function() {
                    // Menengahkan teks di semua sel pada header (baris pertama)
                    $('#klasifikasi-datatable thead th').css('text-align', 'center');
                },
                columns: [{
                    data: 'no',
                    render: (data, type, row, meta) => {
                        return `<div style="text-align:center">${meta.row + 1}.</div>`;;
                    }
                }, {
                    data: 'klasifikasi',
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
                                                        data-modal-target="sourceModal" data-klasifikasi="${data.klasifikasi}"
                                                        onclick="editSourceModal(this)"
                                                        class="group bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                       <div class="absolute py-1 px-4 bg-gray-800 -mt-5 -ml-[70px] text-white text-xs rounded-md hidden group-hover:block">
                                                            Edit
                                                        </div>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return klasifikasiDelete('${data.id}','${data.klasifikasi}')" class="group bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i>
                                <div class="absolute py-1 px-4 bg-gray-800 -mt-5 -ml-20 text-white text-xs rounded-md hidden group-hover:block">
                                    Hapus
                                </div>
                                </button>`;
                        return `<div style="text-align:center">${editUrl} ${deleteUrl}</div>`;
                    }
                }, ],
            });
        });


    //     // validasi data sukses tambah start
    //     document.addEventListener('DOMContentLoaded', function() {
    //     const form = document.getElementById('dataForm');
    //     const successMessage = document.getElementById('successMessage');

    //     form.addEventListener('submit', async function(event) {
    //         event.preventDefault();

    //         // Assuming the form submission is successful
    //         try {
    //             let response = await axios.post(form.action, new FormData(form));
    //             if (response.status === 200) {
    //                 successMessage.classList.remove('hidden');
    //                 setTimeout(() => {
    //                     successMessage.classList.add('hidden');
    //                 }, 5000);
    //             }
    //         } catch (error) {
    //             console.error('Error submitting form:', error);
    //         }table.ajax.reload();
    //     });
    // });
    //     // validasi data sukses tambah end


        // modal close edit start
        document.addEventListener("DOMContentLoaded", function () {
            const sourceModal = document.getElementById('sourceModal');
            const backgroundOverlay = sourceModal.querySelector('.bg-black.opacity-50');
            const closeModalButtons = sourceModal.querySelectorAll('[data-modal-hide], [data-modal-target="sourceModal"]');

            console.log("Modal script loaded");

            function closeModal() {
                console.log("Closing modal");
                sourceModal.classList.add('hidden');
            }

            // Close modal on clicking the background
            if (backgroundOverlay) {
                backgroundOverlay.addEventListener('click', function () {
                    console.log("Background overlay clicked");
                    closeModal();
                });
            } else {
                console.error("Background overlay not found");
            }

            // Close modal on clicking close buttons
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function () {
                    console.log("Close button clicked");
                    closeModal();
                });
            });

            // Functions to handle the cancel and X button
            window.changeSourceModal = function () {
                closeModal();
            };

            window.sourceModalClose = function () {
                closeModal();
            };
        });

        // modal close edit end

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const klasifikasi = button.dataset.klasifikasi;
            let url = "{{ route('klasifikasi.update', ':id') }}".replace(':id', id);
            console.log(url);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update klasifikasi ${klasifikasi}`;
            document.getElementById('klasifikasis').value = klasifikasi;
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

        const klasifikasiDelete = async (id, klasifikasi) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus klasifikasi ${klasifikasi} ?`);
            if (tanya) {
                await axios.post(`/klasifikasi/${id}`, {
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

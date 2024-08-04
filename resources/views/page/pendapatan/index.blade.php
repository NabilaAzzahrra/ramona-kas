<x-app-layout>
    <x-slot name="header">
        <h2 class="px-6 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pendapatan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8/12 mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
                        <div class="p-3 text-gray-900 dark:text-gray-100">
                            <div
                                class="m-4 p-3 bg-slate-50 rounded-xl flex flex-col md:flex-row items-center md:justify-between">
                                <div class="px-9 font-bold text-slate-800 text-lg">Pendapatan</div>
                                <div class="grid grid-cols-2 pt-3 md:pt-0 md:flex  items-center gap-3">
                                    <div>
                                        <a onclick="editSourceModalSaldo()" href="#"
                                            class="flex items-center gap-1 bg-[#2498aa] text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold hover:bg-[#2484aa]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19">
                                                </line>
                                                <line x1="5" y1="12" x2="19" y2="12">
                                                </line>
                                            </svg>
                                            Saldo Awal</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('pendapatan.create') }}"
                                            class="flex items-center gap-1 bg-[#0C4B54] hover:bg-[#0c3454] text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19">
                                                </line>
                                                <line x1="5" y1="12" x2="19" y2="12">
                                                </line>
                                            </svg>
                                            Tambah</a>
                                    </div>
                                    <button onclick="filter(this)" data-modal-target="sourceModal"
                                        class="flex items-center gap-3 bg-sky-400 hover:bg-sky-500 text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold">
                                        <i class="fa-solid fa-filter"></i>
                                        Filter
                                    </button>

                                    <button onclick="exportExcel()"
                                        class="bg-emerald-600 hover:bg-emerald-700 flex items-center gap-3 text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold">
                                        <i class="fa-solid fa-file-excel"></i>
                                        Export to Excel
                                    </button>

                                    <button
                                        class="bg-red-600 hover:bg-red-700 flex items-center gap-3 text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold"
                                        onclick="exportPDF()">
                                        <i class="fa-solid fa-file-pdf"></i>
                                        Export to PDF
                                    </button>

                                </div>
                                <input type="hidden" id="userRole"
                                    value="{{ Auth::check() && Auth::user()->role === 'S' ? 'S' : 'U' }}">
                            </div>
                            <div class="flex justify-center">
                                <div class="overflow-x-scroll p-12" style="width:100%">
                                    <table class="table table-bordered" id="pendapatan-datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-7">No.</th>
                                                <th>Uraian</th>
                                                <th>Tanggal Pendapatan</th>
                                                <th>Tagihan</th>
                                                <th>Retur</th>
                                                <th>Penerimaan</th>
                                                <th>Kekurangan Bayar</th>
                                                <th>Kelebihan Bayar</th>
                                                <th>Keterangan</th>
                                                @if (Auth::check() && Auth::user()->role === 'S')
                                                    <th>Action</th>
                                                @endif
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
                        Filter Tanggal Pendapatan
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="flex flex-col p-4 space-y-6">
                    <div>
                        <label for="from_date" class="block mb-2 text-sm font-medium text-gray-900">Dari
                            Tanggal</label>
                        <input type="date" id="from_date" name="from_date"
                            class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                            placeholder="Masukan tanggal awal disini...">
                    </div>
                    <div>
                        <label for="to_date" class="block mb-2 text-sm font-medium text-gray-900">Sampai
                            Tanggal</label>
                        <input type="date" id="to_date" name="to_date"
                            class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                            placeholder="Masukan tanggal akhir disini...">
                    </div>
                </div>
                <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                    <button id="formSourceButton" onclick="changeFilterDataRegisterProgram()"
                        class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                    <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                        class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModalSaldo">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/3 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-3 border-b rounded-t">
                    <h3 class="font-bold text-slate-800 text-xl" id="title_source_saldo">
                        Input Saldo Awal
                    </h3>
                    <button type="button" onclick="sourceModalCloseSaldo(this)" data-modal-target="sourceModalSaldo"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('saldo.store') }}" method="post" class="px-3">
                    <div class="flex flex-col p-3 space-y-2">
                        @csrf
                        <div>
                            <label for="saldo" class="block mb-2 text-sm font-medium text-gray-900">Saldo
                                Awal</label>
                            <input type="number" id="saldo" name="saldo"
                                class="px-3 py-2 shadow rounded w-full bg-slate-50 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                placeholder="Masukan saldo awal disini...">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButtonSaldo" onclick="changeFilterDataRegisterProgram()"
                            class="bg-[#0C4B54] hover:bg-[#0c3454] flex items-center gap-3 text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold">Simpan</button>
                        <button type="button" onclick="sourceModalCloseSaldo(this)"
                            data-modal-target="sourceModalSaldo"
                            class="bg-red-600 hover:bg-red-700 flex items-center gap-3 text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    @push('scripts')
        <script src="{{ asset('js/exceljs.min.js') }}"></script>
        <script>
            var dataNabil;
            let dataTableDataRegisterProgramInstance;
            let dataTableDataRegisterProgramInitialized = false;
            let urlItemDetail =
                `/api/pendapatan`;
        </script>
        <script>
            const changeFilterDataRegisterProgram = () => {
                let queryParams = [];

                let fromDate = document.getElementById('from_date').value;
                let toDate = document.getElementById('to_date').value;

                if (fromDate !== 'all' && toDate !== 'all') {
                    queryParams.push(`fromDate=${fromDate}`);
                    queryParams.push(`toDate=${toDate}`);
                }

                let queryString = queryParams.join('&');

                urlItemDetail = `/api/pendapatan?${queryString}`;

                if (dataTableDataRegisterProgramInstance) {
                    dataTableDataRegisterProgramInstance.clear();
                    dataTableDataRegisterProgramInstance.destroy();
                    getDataTableRegisterProgram()
                        .then((response) => {
                            dataTableDataRegisterProgramInstance = $('#pendapatan-datatable').DataTable(response
                                .config);
                            dataTableDataRegisterProgramInitialized = response.initialized;
                            document.getElementById('sourceModal').classList.add('hidden');
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            }

            // modal close edit start
            document.addEventListener("DOMContentLoaded", function() {
                const sourceModal = document.getElementById('sourceModalSaldo');
                const backgroundOverlay = sourceModal.querySelector('.bg-black.opacity-50');
                const closeModalButtons = sourceModal.querySelectorAll(
                    '[data-modal-hide], [data-modal-target="sourceModal"]');

                console.log("Modal script loaded");

                function closeModal() {
                    console.log("Closing modal");
                    sourceModal.classList.add('hidden');
                }

                // Close modal on clicking the background
                if (backgroundOverlay) {
                    backgroundOverlay.addEventListener('click', function() {
                        console.log("Background overlay clicked");
                        closeModal();
                    });
                } else {
                    console.error("Background overlay not found");
                }

                // Close modal on clicking close buttons
                closeModalButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        console.log("Close button clicked");
                        closeModal();
                    });
                });

                // Functions to handle the cancel and X button
                window.changeSourceModal = function() {
                    closeModal();
                };

                window.sourceModalClose = function() {
                    closeModal();
                };
            });

            // modal close edit end

            const getDataTableRegisterProgram = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(urlItemDetail);
                        let registers = response.data.pendapatan;
                        console.log(registers);
                        dataNabil = registers;
                        let userRole = document.getElementById('userRole').value;
                        let columnConfigs = [{
                                data: 'no',
                                render: (data, type, row, meta) => {
                                    return `<div style="text-align:center">${meta.row + 1}.</div>`;
                                },
                            }, {
                                data: 'item_pendapatan',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'tgl_pendapatan',
                                render: (data, type, row) => {
                                    return moment(data).format('DD-MM-YYYY');
                                }
                            }, {
                                data: 'tagihan',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'retur',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'penerimaan',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'kekurangan',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'kelebihan',
                                render: (data, type, row) => {
                                    return data;
                                }
                            },
                            {
                                data: 'keterangan',
                                render: (data, type, row) => {
                                    return data;
                                }
                            },
                            //                 {
                            //                     data: {
                            //                         no: 'no',
                            //                         name: 'name'
                            //                     },
                            //                     render: (data) => {
                            //                         var editUrl = "{{ route('pendapatan.show', ':id') }}"
                            //                             .replace(':id', data.id);

                            //                         let deleteUrl =
                            //                             `<button onclick="return pendapatanDelete('${data.id}','${data.item_pendapatan}', '${data.id_pendapatan}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                            //                         return `
                    //     <a href="${editUrl}" class="group mr-3 bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                    //         <i class="fas fa-edit"></i>
                    //         <div class="absolute py-1 px-4 bg-gray-800 -mt-6 -ml-14 text-white text-xs rounded-md hidden group-hover:block">
                    //             Edit
                    //         </div>
                    //     </a>
                    //     ${deleteUrl}
                    // `;
                            //                     }
                            //                 },
                        ];

                        if (userRole === 'S') {
                            columnConfigs.push({
                                data: {
                                    no: 'no',
                                    name: 'name'
                                },
                                render: (data) => {
                                    var editUrl = "{{ route('pendapatan.show', ':id') }}"
                                        .replace(':id', data.id);

                                    let deleteUrl = `
                                        <button onclick="return pendapatanDelete('${data.id}','${data.item_pendapatan}', '${data.id_pendapatan}')"
                                            class="bg-red-500 hover:bg-red-300 px-3 py-1 rounded-md text-xs text-white">
                                            <i class="fas fa-trash"></i>
                                        </button>`;

                                                            let actionButtons = `
                                        <a href="${editUrl}" class="group mr-3 bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                            <i class="fas fa-edit"></i>
                                            <div class="absolute py-1 px-4 bg-gray-800 -mt-6 -ml-14 text-white text-xs rounded-md hidden group-hover:block">
                                                Edit
                                            </div>
                                        </a>`;

                                    actionButtons += deleteUrl;

                                    return actionButtons;
                                }
                            });
                        }

                        const dataTableConfig = {
                            data: registers,
                            columnDefs: [{
                                width: 50,
                                target: 0
                            }],
                            createdRow: (row, data, index) => {
                                if (index % 2 === 0) {
                                    $(row).css('background-color', '#f9fafb');
                                }
                            },
                            columns: columnConfigs,
                        }

                        let results = {
                            config: dataTableConfig,
                            initialized: true
                        }

                        resolve(results);
                    } catch (error) {
                        reject(error)
                    }
                });
            }
        </script>
        <script>
            const promiseDataRegisterProgram = () => {

                Promise.all([
                        getDataTableRegisterProgram(),
                    ])
                    .then((response) => {
                        let responseDTRS = response[0];
                        dataTableDataRegisterProgramInstance = $('#pendapatan-datatable').DataTable(
                            responseDTRS
                            .config);
                        dataTableDataRegisterProgramInitialized = responseDTRS.initialized;

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            promiseDataRegisterProgram();
        </script>
    @endpush
    <script>
        const filter = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;

            document.getElementById('title_source').innerText = `Filter Tanggal`;

            let modal = document.getElementById(modalTarget);
            modal.classList.remove('hidden');
        }

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.toggle('hidden');
        }
    </script>

    <script>
        const pendapatanDelete = async (id, item_pendapatan, id_pendapatan) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus pendapatan ${item_pendapatan} ?`);
            if (tanya) {
                await axios.post(`/pendapatan/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id_pendapatan': id_pendapatan
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
    <script>
        const exportExcel = async () => {
            console.log(dataNabil)
            try {
                const workbook = new ExcelJS.Workbook();
                const worksheet = workbook.addWorksheet('Data');
                let header = ['No', 'Klasifikasi', 'Uraian', 'Tanggal Pendapatan', 'Tagihan', 'Retur', 'Penerimaan',
                    'Kekurangan', 'Kelebihan', 'Keterangan',
                    'Akun'
                ];
                let dataExcel = [
                    header,
                ];
                dataNabil.forEach((data, index) => {
                    let studentBucket = [];
                    const date = new Date(data.created_at);
                    const day = date.getDate().toString().padStart(2,
                        '0');
                    const month = (date.getMonth() + 1).toString().padStart(2,
                        '0');
                    const year = date.getFullYear();
                    const formattedDate = `${day}/${month}/${year}`;

                    function formatDate(dateString) {
                        const date = new Date(dateString);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                        const year = date.getFullYear();
                        return `${day}/${month}/${year}`;
                    }

                    studentBucket.push(
                        `${index + 1}`,
                        `${data.klasifikasi.klasifikasi}`,
                        `${data.item_pendapatan}`,
                        `${formatDate(data.tgl_pendapatan)}`,
                        `${data.tagihan}`,
                        `${data.retur}`,
                        `${data.penerimaan}`,
                        `${data.kekurangan}`,
                        `${data.kelebihan}`,
                        `${data.keterangan}`,
                        `${data.user.name}`,
                    );
                    dataExcel.push(studentBucket);
                });

                worksheet.addRows(dataExcel);

                const blob = await workbook.xlsx.writeBuffer();
                const blobData = new Blob([blob], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });

                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blobData);
                link.download = `Pendapatan.xlsx`;

                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

            } catch (error) {
                console.error('Error:', error);
            }
        };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script>
        const exportPDF = async () => {
            console.log(dataNabil);
            try {
                const {
                    jsPDF
                } = window.jspdf;

                const doc = new jsPDF('landscape', 'mm', 'a4');

                let header = ['No', 'Klasifikasi', 'Uraian', 'Tanggal Pendapatan', 'Tagihan', 'Retur', 'Penerimaan',
                    'Kekurangan', 'Kelebihan', 'Keterangan',
                    'Akun'
                ];

                let startX = 10;
                let startY = 10;
                let lineHeight = 10;

                doc.setFontSize(10);

                let columnWidths = [10, 18, 40, 35, 20, 30, 20, 20, 20, 30, 30];

                header.forEach((title, index) => {
                    let headerX = startX + columnWidths.slice(0, index).reduce((a, b) => a + b, 0);
                    doc.text(title, headerX, startY);
                });

                let currentY = startY + lineHeight;
                dataNabil.forEach((data, index) => {
                    function formatDate(dateString) {
                        const date = new Date(dateString);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                        const year = date.getFullYear();
                        return `${day}/${month}/${year}`;
                    }

                    const row = [
                        `${index + 1}`,
                        `${data.klasifikasi.klasifikasi}`,
                        `${data.item_pendapatan}`,
                        `${formatDate(data.tgl_pendapatan)}`,
                        `${data.tagihan}`,
                        `${data.retur}`,
                        `${data.penerimaan}`,
                        `${data.kekurangan}`,
                        `${data.kelebihan}`,
                        `${data.keterangan}`,
                        `${data.user.name}`,
                    ];

                    let maxHeight = 0;

                    row.forEach((cell, cellIndex) => {
                        let text = cell;
                        let cellX = startX + columnWidths.slice(0, cellIndex).reduce((a, b) => a +
                            b, 0);
                        let cellY = currentY;

                        let splitText = doc.splitTextToSize(text, columnWidths[cellIndex]);
                        doc.text(splitText, cellX, cellY);
                        maxHeight = Math.max(maxHeight, splitText.length * lineHeight);
                    });

                    currentY += Math.max(lineHeight, maxHeight);
                });

                doc.save('Pendapatan.pdf');

            } catch (error) {
                console.error('Error:', error);
            }
        };
    </script>
    <script>
        const editSourceModalSaldo = (button) => {
            const formModal = document.getElementById('sourceModalSaldo');
            const formElement = document.getElementById('formSourceModal');
            const url = "{{ route('saldo.store') }}";
            console.log(url);
            const titleSource = document.getElementById('title_source_saldo');
            const formSourceButton = document.getElementById('formSourceButton');

            titleSource.innerText = `Input Saldo Awal`;
            formSourceButton.innerText = 'Simpan';

            const csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('name', '_token');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');

            // formElement.appendChild(csrfToken);

            const methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');

            // formElement.appendChild(methodInput);

            formModal.classList.toggle('hidden');
        }

        const sourceModalCloseSaldo = (button) => {
            const modalTarget = button.dataset.modalTarget;
            console.log(`Modal target: ${modalTarget}`); // Log the modal target
            const modal = document.getElementById(modalTarget);
            if (modal) {
                modal.classList.toggle('hidden');
            } else {
                console.error(`Modal with ID ${modalTarget} not found`);
            }
        }
    </script>
</x-app-layout>

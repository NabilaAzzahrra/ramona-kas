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
                            <div class="p-6 bg-red-500 rounded-xl flex items-center justify-between">
                                <div>DATA klasifikasi</div>
                                <div class="flex gap-5">
                                    <div>
                                        <a onclick="editSourceModalSaldo()" href="#">Saldo Awal</a>
                                    </div>
                                    <div><a href="{{ route('pendapatan.create') }}">Tambah</a></div>
                                    <button onclick="filter(this)" data-modal-target="sourceModal"
                                        class="bg-sky-400 py-2 px-4 rounded-lg text-white hover:bg-sky-500"><i
                                            class="fa-solid fa-filter"></i></button>
                                    <button onclick="exportExcel()"
                                        class="bg-amber-400 py-2 px-4 rounded-lg text-white hover:bg-amber-500"><i
                                            class="fa-solid fa-file-excel"></i></button>
                                    <button
                                        class="bg-white border-2 border-black py-2 px-4 rounded-lg text-black hover:text-white hover:bg-black hover:border-2 hover:border-black"
                                        onclick="exportPDF()"><i class="fa-solid fa-file-pdf"></i></button>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="p-12" style="width:100%">
                                    <table class="table table-bordered" id="pendapatan-datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-7">No.</th>
                                                <th>klasifikasi</th>
                                                <th>Uraian</th>
                                                <th>Tanggal Pendapatan</th>
                                                <th>Tagihan</th>
                                                <th>Retur</th>
                                                <th>Penerimaan</th>
                                                <th>Kekurangan Bayar</th>
                                                <th>Kelebihan Bayar</th>
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
                    <button type="button" data-modal-target="sourceModal"
                        class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModalSaldo">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source_saldo">
                        Input Saldo Awal
                    </h3>
                    <button type="button" onclick="sourceModalClose()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('saldo.store') }}" method="post">
                    <div class="flex flex-col p-4 space-y-6">
                        @csrf
                        <div>
                            <label for="saldo" class="block mb-2 text-sm font-medium text-gray-900">Saldo
                                Awal</label>
                            <input type="number" id="saldo" name="saldo"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                placeholder="Masukan saldo awal disini...">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton" onclick="changeFilterDataRegisterProgram()"
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" onclick="sourceModalClose()"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
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

            const getDataTableRegisterProgram = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(urlItemDetail);
                        let registers = response.data.pendapatan;
                        console.log(registers);
                        dataNabil = registers;

                        let columnConfigs = [{
                                data: 'no',
                                render: (data, type, row, meta) => {
                                    return `<div style="text-align:center">${meta.row + 1}.</div>`;
                                },
                            },
                            {
                                data: 'klasifikasi',
                                render: (data, type, row) => {
                                    return data.klasifikasi;
                                }
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
                            }, {
                                data: {
                                    no: 'no',
                                    name: 'name'
                                },
                                render: (data) => {
                                    var editUrl = "{{ route('pendapatan.show', ':id') }}".replace(
                                        ':id',
                                        data.id
                                    );

                                    let deleteUrl =
                                        `<button onclick="return pendapatanDelete('${data.id}','${data.item_pendapatan}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                                    return `
                            <a href="${editUrl}" class="mr-3 bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                            <i class="fas fa-edit"></i>
                        </a>
                        ${deleteUrl}
                        `;
                                }
                            },
                        ];

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
        const pendapatanDelete = async (id, item_pendapatan) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus pendapatan ${item_pendapatan} ?`);
            if (tanya) {
                await axios.post(`/pendapatan/${id}`, {
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
    </script>
</x-app-layout>

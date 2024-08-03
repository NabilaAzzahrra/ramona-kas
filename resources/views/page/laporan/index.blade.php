<x-app-layout>
    <x-slot name="header">
        <h2 class="px-3 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8/12 mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
                        <div class="p-3 text-gray-900 dark:text-gray-100">
                            <div class="m-4 p-3 bg-slate-50 rounded-xl flex flex-col md:flex-row shadow-md items-center md:justify-between">
                                <div class="px-9 font-bold text-slate-800 text-lg">DATA TRANSAKSI</div>
                                <div class="grid grid-cols-2 pt-3 md:pt-0 md:flex items-center gap-3">
                                    <a href="#" class="flex items-center gap-2 bg-indigo-800 text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold hover:bg-indigo-700">
                                        <i class="fa-solid fa-print"></i>
                                        PRINT</a>

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
                            </div>
                            <div class="flex justify-center">
                                <div class="overflow-x-scroll p-12" style="width:100%">
                                    <table class="table table-bordered" id="laporan-datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-7">No.</th>
                                                <th>URAIAN</th>
                                                <th>TANGGAL TRANSAKSI</th>
                                                <th>PENDAPATAN</th>
                                                <th>PENGELUARAN</th>
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
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">Filter Tanggal Transaksi</h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form id="filterForm" action="{{ route('laporan.create') }}" method="GET" target="_blank">
                    <div class="flex flex-col p-4 space-y-6">
                        <div>
                            <label for="from_date" class="block mb-2 text-sm font-medium text-gray-900">Dari Tanggal</label>
                            <input type="date" id="from_date" name="start_date"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="to_date" class="block mb-2 text-sm font-medium text-gray-900">Sampai Tanggal</label>
                            <input type="date" id="to_date" name="end_date"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/exceljs.min.js') }}"></script>
        <script>
            var dataLaporan;
            let dataTableDataRegisterProgramInstance;
            let dataTableDataRegisterProgramInitialized = false;
            let urlItemDetail =
                `/api/laporan`;
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

                urlItemDetail = `/api/laporan?${queryString}`;

                if (dataTableDataRegisterProgramInstance) {
                    dataTableDataRegisterProgramInstance.clear();
                    dataTableDataRegisterProgramInstance.destroy();
                    getDataTableRegisterProgram()
                        .then((response) => {
                            dataTableDataRegisterProgramInstance = $('#laporan-datatable').DataTable(response
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
                        let registers = response.data.laporan;
                        console.log(registers);
                        dataLaporan = registers;

                        let columnConfigs = [{
                                data: 'no',
                                render: (data, type, row, meta) => {
                                    return `<div style="text-align:center">${meta.row + 1}.</div>`;
                                },
                            },
                            {
                                data: 'item',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'tgl_transaksi',
                                render: (data, type, row) => {
                                    return moment(data).format('DD-MM-YYYY');
                                }
                            }, {
                                data: 'pendapatan',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'pengeluaran',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }
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
                        dataTableDataRegisterProgramInstance = $('#laporan-datatable').DataTable(
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
    {{-- <script>
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
    </script> --}}


    <script>
        const filter = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.remove('hidden');
        }

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.add('hidden');
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
            console.log(dataLaporan)
            try {
                const workbook = new ExcelJS.Workbook();
                const worksheet = workbook.addWorksheet('Data');
                let header = ['No', 'item', 'tgl_transaksi', 'Pendapatan', 'Pengeluaran'];
                let dataExcel = [
                    header,
                ];
                dataLaporan.forEach((data, index) => {
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
                        `${data.item}`,
                        `${formatDate(data.tgl_transaksi)}`,
                        `${data.pendapatan}`,
                        `${data.pengeluaran}`,
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
            console.log(dataLaporan);
            try {
                const {
                    jsPDF
                } = window.jspdf;

                const doc = new jsPDF('landscape', 'mm', 'a4');

                let header = ['No', 'item', 'tgl_transaksi', 'Pendapatan', 'Pengeluaran'];

                let startX = 10;
                let startY = 10;
                let lineHeight = 10;

                doc.setFontSize(10);

                let columnWidths = [10, 18, 40, 35, 20];

                header.forEach((title, index) => {
                    let headerX = startX + columnWidths.slice(0, index).reduce((a, b) => a + b, 0);
                    doc.text(title, headerX, startY);
                });

                let currentY = startY + lineHeight;
                dataLaporan.forEach((data, index) => {
                    function formatDate(dateString) {
                        const date = new Date(dateString);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                        const year = date.getFullYear();
                        return `${day}/${month}/${year}`;
                    }

                    const row = [
                        `${index + 1}`,
                        `${data.item}`,
                        `${formatDate(data.tgl_transaksi)}`,
                        `${data.pendapatan}`,
                        `${data.pengeluaran}`,
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

                doc.save('Transaksi.pdf');

            } catch (error) {
                console.error('Error:', error);
            }
        };
    </script>
</x-app-layout>

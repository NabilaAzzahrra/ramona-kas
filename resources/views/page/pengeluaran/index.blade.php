<x-app-layout>
    <x-slot name="header">
        <h2 class="px-3 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8/12 mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
                        <div class="p-3 text-gray-900 dark:text-gray-100">
                            <div class="m-4 p-3 bg-slate-50 rounded-xl flex flex-col md:flex-row items-center md:justify-between">
                                <div class="px-2 font-bold text-slate-800 text-lg">DATA PENGELUARAN</div>
                                <div class="flex gap-5">
                                    <div><a href="{{ route('pengeluaran.create') }}" class="flex items-center gap-1 bg-[#0C4B54] hover:bg-[#0c3454] text-slate-100 px-4 py-2 rounded-md shadow-md text-sm font-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        Tambah</a></div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="pt-3 px-4" style="width:100%">
                                    <table class="table table-bordered" id="pengeluaran-datatable">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                @foreach ($jenis_pengeluaran as $jenis_pengeluaran)
                                                    <th>{{ strtoupper($jenis_pengeluaran) }}</th>
                                                @endforeach
                                                <th>ACTION</th>
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
                        Filter Tanggal pengeluaran
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


    @push('scripts')
        <script src="{{ asset('js/exceljs.min.js') }}"></script>
        <script>
            var dataNabil;
            let dataTableDataRegisterProgramInstance;
            let dataTableDataRegisterProgramInitialized = false;
            let urlItemDetail =
                `/api/view`;
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

                urlItemDetail = `/api/view?${queryString}`;

                if (dataTableDataRegisterProgramInstance) {
                    dataTableDataRegisterProgramInstance.clear();
                    dataTableDataRegisterProgramInstance.destroy();
                    getDataTableRegisterProgram()
                        .then((response) => {
                            dataTableDataRegisterProgramInstance = $('#pengeluaran-datatable').DataTable(response
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
                        let registers = response.data.view;

                        dataNabil = registers;

                        let columnData = [];

                        let columnConfigs = [{
                                data: 'no',
                                render: (data, type, row, meta) => {
                                    return `<div style="text-align:center">${meta.row + 1}.</div>`;
                                },
                            }, {
                                data: 'id',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'tgl_pengeluaran',
                                render: (data, type, row) => {
                                    return moment(data).format('DD-MM-YYYY');
                                }
                            },
                            {
                                data: 'uraian',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'BAHAN',
                                render: (data, type, row) => {
                                    return data;
                                }
                            },
                            {
                                data: 'user',
                                render: (data, type, row) => {
                                    return data.name;
                                }
                            }, {
                                data: {
                                    no: 'no',
                                    name: 'name'
                                },
                                render: (data) => {
                                    var editUrl = "{{ route('pengeluaran.show', ':id') }}".replace(
                                        ':id',
                                        data.id
                                    );

                                    let deleteUrl =
                                        `<button onclick="return pendapatanDelete('${data.id}','${data.uraian}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                                    return `
                            <a href="${editUrl}" class="group mr-3 bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                            <i class="fas fa-edit"></i>
                            <div class="absolute py-1 px-4 bg-gray-800 -mt-6 -ml-14 text-white text-xs rounded-md hidden group-hover:block">
                                Edit
                            </div>
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
                        dataTableDataRegisterProgramInstance = $('#pengeluaran-datatable').DataTable(
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
</x-app-layout>

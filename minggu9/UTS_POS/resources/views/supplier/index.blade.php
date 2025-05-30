{{-- @extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}"> Tambah </a>
                <button onclick="modalAction('{{ url('/supplier/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        // $(document).ready(function() {
        //     var dataSupplier = $('#table_supplier').DataTable({
        //         // serverSide : true , jika ingin menggunakan server side processing
        //         serverSide: true,
        //         ajax: {
        //             "url": "{{ url('supplier/list') }}",
        //             "dataType": "json",
        //             "type": "POST",
        //         },
        //         columns: [
        //             {
        //                 // nomor urut dari laravel datatable addIndexColumn ()
        //                               data: "DT_RowIndex",
        //                               className: "text-center",
        //                               orderable: false,
        //                               searchable: false
        //                           }, {
        //                               data: "supplier_kode",
        //                               className: "",
        //                               // orderable : true , jika ingin kolom ini bisa diurutkan
        //                               orderable: true,
        //                               // searchable : true , jika ingin kolom ini bisa dicari
        //                               searchable: true
        //                           }, {
        //                               data: "supplier_nama",
        //                               className: "",
        //                               orderable: true,
        //                               searchable: true
        //                           }, {
        //                               // mengambil data level hasil dari ORM berelasi
        //                               data: "supplier_alamat",
        //                               className: "",
        //                               orderable: false,
        //                               searchable: false
        //                           }, {
        //                               data: "aksi",
        //                               className: "",
        //                               orderable: false,
        //                               searchable: false
        //                           }
        //                       ]
        //                   });
        //               });

        // Tugas Jobsheet 6 
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        var dataSupplier;
        $(document).ready(function() {
            dataSupplier = $('#table_supplier').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('supplier/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [{
                        //nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "supplier_kode",
                        className: "",
                        orderable: true, //jika ingin kolom ini bisa diurutkan
                        searchable: true //jika ingin kolom ini bisa dicari
                    },
                    {
                        data: "supplier_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        // mengambil data level hasil dari ORM berelasi
                        data: "supplier_alamat",
                        className: "",
                        orderable: false,
                        searchable: false
                },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ],
            });
        });
    </script>
@endpush --}}

{{-- Jobsheet 8 Tugas 1 --}}
@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Supplier</h3>
            <div class="card-tools">
            {{-- Jobsheet 8 Tugas-3 --}}
             <a href="{{ url('/supplier/export_pdf') }}" class="btn btn-warning btn-sm mt-1"><i class="fa fa-file-excel"></i> Export Supplier</a>
                <button onclick="modalAction('{{ url('/supplier/import') }}')" class="btn btn-info btn-sm mt-1">Import Supplier</button>
                {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}"> Tambah </a> --}}
                {{-- Jobsheet 8 Tugas 2 --}}
            <a href="{{ url('/supplier/export_excel') }}" class="btn btn-primary btn-sm mt-1"><i class="fa fa-file-excel"></i> Export Supplier</a>
                <button onclick="modalAction('{{ url('/supplier/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
                    Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>

        // Tugas Jobsheet 6 
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        var tableSupplier;
        $(document).ready(function() {
            tableSupplier = $('#table_supplier').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('supplier/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [{
                        //nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "supplier_kode",
                        className: "",
                        orderable: true, //jika ingin kolom ini bisa diurutkan
                        searchable: true //jika ingin kolom ini bisa dicari
                    },
                    {
                        data: "supplier_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        // mengambil data level hasil dari ORM berelasi
                        data: "supplier_alamat",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ],
            });
            $('#table-supplier_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) { // enter key
                    tableSupplier.search(this.value).draw();
                }
            });
        });
    </script>
@endpush

{{-- @extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}"> Tambah </a>
                <button onclick="modalAction('{{ url('/user/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1" control-label col-form-label>Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="level_id" name="level_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($level as $item)
                                    <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level Pengguna</th>
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
        //     var dataUser = $('#table_user').DataTable({
        //         serverSide: true, // Jika ingin menggunakan server-side processing
        //         ajax: {
        //             "url": "{{ url('user/list') }}",
        //             "dataType": "json",
        //             "type": "POST",
        //             "data": function(d) {
        //                 d.level_id = $('#level_id').val();
        //             }
        //         },
        //         columns: [
        //             {
        //                 // nomor urut dari laravel datatable addIndexColumn ()
        //                 data: "DT_RowIndex",
        //                               className: "text-center",
        //                               orderable: false,
        //                               searchable: false
        //                           }, {
        //                               data: "username",
        //                               className: "",
        //                               // orderable : true , jika ingin kolom ini bisa diurutkan
        //                               orderable: true,
        //                               // searchable : true , jika ingin kolom ini bisa dicari
        //                               searchable: true
        //                           }, {
        //                               data: "nama",
        //                               className: "",
        //                               orderable: true,
        //                               searchable: true
        //                           }, {
        //                               // mengambil data level hasil dari ORM berelasi
        //                               data: "level.level_nama",
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
        //                   $('#level_id').on('change', function(){
        //                     dataUser.ajax.reload();
        //                   });
        //               });

        // jobsheet 6
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataUser;
        $(document).ready(function() {
            dataUser = $('#table_user').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    // -- JS5 - P4(3) --
                    "data": function(d) {
                        d.level_id = $('#level_id').val();
                    }
                },
                columns: [{
                        //nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "username",
                        className: "",
                        orderable: true, //jika ingin kolom ini bisa diurutkan
                        searchable: true //jika ingin kolom ini bisa dicari
                    },
                    {
                        data: "nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        //mengambil data level hasil dari ORM berelasi
                        data: "level.level_nama",
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

            $('#level_id').on('change', function() {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush --}}

{{-- Jobsheet 8 Tugas 1 --}}
@extends('layouts.template')

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Daftar User</h3>
            <div class="card-tools">
                {{-- Jobsheet 8 Tugas-3 --}}
             <a href="{{ url('/user/export_pdf') }}" class="btn btn-warning btn-sm mt-1"><i class="fa fa-file-excel"></i> Export User</a>
                <button onclick="modalAction('{{ url('/user/import') }}')" class="btn btn-sm btn-info mt-1">Import
                    User</button>
                {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}"> Tambah </a> --}}
                {{-- Jobsheet 8 Tugas 2 --}}
            <a href="{{ url('/user/export_excel') }}" class="btn btn-primary btn-sm mt-1"><i class="fa fa-file-excel"></i> Export User</a>
                <button onclick="modalAction('{{ url('/user/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1" control-label col-form-label>Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="level_id" name="level_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($level as $item)
                                    <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level Pengguna</th>
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
        // jobsheet 6
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var tableUser;
        $(document).ready(function() {
            tableUser = $('#table_user').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    // -- JS5 - P4(3) --
                    "data": function(d) {
                        d.level_id = $('#level_id').val();
                    }
                },
                columns: [{
                        //nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "username",
                        className: "",
                        orderable: true, //jika ingin kolom ini bisa diurutkan
                        searchable: true //jika ingin kolom ini bisa dicari
                    },
                    {
                        data: "nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        //mengambil data level hasil dari ORM berelasi
                        data: "level.level_nama",
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

            // ======= Jobsheet 8 Tugas 1 =======
            $('#table-user_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) { //enter key
                    tableUser.search(this.value).draw();
                }
            });

            $('#level_id').on('change', function() {
                tableUser.ajax.reload();
            });
        });
    </script>
@endpush

@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Manager Kategori</div>
        <div class="card-body">
            {{-- kode untuk menambahkan tombol tambah ke halaman kategori --}}
            <button class="btn btn-primary" onclick="window.location.href = '/kategori/create'">+ Tambah</button>
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts() }}
@endpush
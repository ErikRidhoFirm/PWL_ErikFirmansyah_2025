@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtle', 'Welcome')
@section('content_header_title', 'Welcome')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    <p>Welcome to this beautiful admin panel</p>
@stop

{{-- push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css" --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, Im using the Laravel-AdminLTE package!"); </script>
@endpush
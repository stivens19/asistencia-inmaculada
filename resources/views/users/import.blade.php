@extends('layouts.app')

@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Subir usuarios a importar</h1>
<p class="mb-4">Agregue los usuarios</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <form action="{{ route('subir-usuarios') }}" method="POST" enctype="multipart/form-data">
    @csrf
    label for="file">Archivo a importar</label>
    <input type="file" id="file" name="file">
    <button type="submit">Registrar</button>
  </form>
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
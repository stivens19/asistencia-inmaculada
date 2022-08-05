@extends('layouts.app')
@section('estilos')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    
@endsection

@section('content')
    <div class="row">
        <form action="{{ route('excel-asistencia',$attendance->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="grado">Grado</label>
                <select id="grado" class="form-control" name="grado">
                    <option value="">--Seleccione</option>
                    <option value="1">--Primero</option>
                    <option value="2">--Segundo</option>
                    <option value="3">--Tercero</option>
                    <option value="4">--Cuarto</option>
                    <option value="5">--Quinto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="seccion">seccion</label>
                <select id="seccion" class="form-control" name="seccion">
                    <option value="">--Seleccione</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="H">H</option>
                </select>
            </div>
            <button type="submit" class="btn btn-info">Exportar registro</button>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('js/instascan.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
@endsection

@extends('layouts.app')
@section('estilos')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Días de Asistencia</h1>
    <p class="mb-4">Agregue los días de Asistencia</p>

    <button class="btn btn-primary btn-icon-split" type="button" data-toggle="modal" data-target="#modal">
        <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
        <span class="text">AGREGAR DÍA</span>
    </button>
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Agregar Rol</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('days.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="turno">Turno</label>
                            <select name="turno" id="turno">
                                <option value="">Seleccione una opcion</option>
                                <option value="M">Mañana</option>
                                <option value="T">Tarde</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time_in">Hora Entrada</label>
                            <input type="time" name="time_in" id="time_in" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-icon-split" type="submit">
                            <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
                            <span class="text">Agregar Dia Asistencia</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Roles</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>TURNO</th>
                            <th>HORA DE INGRESO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>FECHA</th>
                            <th>TURNO</th>
                            <th>HORA DE INGRESO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($days as $day)
                            <tr>
                                <td>{{ $day->date }}</td>
                                <td>{{ $day->turno }}</td>
                                <td>{{ $day->time_in }}</td>
                                <td>
                                    <a href="{{ route('days.show',$day->id) }}" class="btn btn-warning">Registrar Asistencias <i class="fas fa-pen"></i></a>
                                    <a href="{{ route('excelview',$day->id) }}" class="btn btn-info">Reporte <i class="fas fa-pen"></i></a>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
                {{ $days->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection

@extends('layouts.app')
@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Usuarios del Sistema</h1>
<p class="mb-4">Agregue los usuarios</p>

<button class="btn btn-primary btn-icon-split" type="button" data-toggle="modal" data-target="#modal">
    <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
    <span class="text">AGREGAR USUARIO</span>
</button>

<a href="{{ route('subirus') }}" class="btn btn-warning">Subir usuarios</a>
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Agregar Usuario</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" action="{{ route('users.store') }}">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role_id">Rol</label>
                        <select name="role_id" id="role_id">
                            <option value="">Seleccione una opcion</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Ingrese el nombre">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" placeholder="Ingrese el correo">
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input id="dni" class="form-control" type="text" name="dni" placeholder="Ingrese el DNI">
                    </div>
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
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" class="form-control" type="text" name="password" placeholder="Ingrese el contraseña">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirme contraseña</label>
                        <input id="password_confirmation" class="form-control" type="text" name="password_confirmation" placeholder="confirme contraseña">
                    </div>
                    <div class="form-group">
                        <label for="turno">Turno</label>
                        <select name="turno" id="turno">
                            <option value="">Seleccione una opcion</option>
                            <option value="M">Mañana</option>
                            <option value="T">Tarde</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-icon-split" type="submit">
                        <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
                        <span class="text">Agregar Usuario</span>
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
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ROL</th>
            <th>NOMBRE</th>
            <th>DNI</th>
            <th>GRADO(*)</th>
            <th>SECCION(*)</th>
            <th>TURNO(*)</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ROL</th>
                <th>NOMBRE</th>
                <th>DNI</th>
                <th>GRADO(*)</th>
                <th>SECCION(*)</th>
                <th>TURNO(*)</th>
                <th>ACCIONES</th>
              </tr>
        </tfoot>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->dni }}</td>
                    <td>{{ $user->grado }}</td>
                    <td>{{ $user->seccion }}</td>
                    <td>{{ $user->turno }}</td>
                    <td>
                        <a href="{{ route('users.show',$user->id) }}" class="btn btn-warning">QR</a>
                    </td>

                </tr>
            @endforeach

          
        </tbody>
      </table>
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
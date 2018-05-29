@extends('layouts.principal')

@section('content')
    
        <table class="table table-bordered table-striped" id="users-table">
            <thead >
                <tr class="table-primary alineado_centro">
                    <th class="all">Id</th>
                    <th class="all">Nombre</th>
                    <th class="all">Username</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Departamento</th>
                    <th>Creado</th>
                    <th>Modificado</th>
                    <th class="all">Acciones</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td class="non_searchable"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="non_searchable"></td>
                    <td></td>
                    <td class="non_searchable"></td>
                    <td class="non_searchable"></td>
                    <td class="non_searchable"></td>
                </tr>
            </tfoot>
        </table>
        <div id="modal1_user" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Update User</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="update-form">
                        @csrf
                        <div class="form-group"> <!-- Nombre del Adjudicatario-->
                             <label for="name_update" class="control-label">Nombre Completo</label>
                             <input id="name_update" value="" type="text" class="form-control" name="name_update" required autofocus>
                             <span class="help-block" id="error"></span>
                         </div>

                        <div class="form-group ">
                            <label for="username_update" class="control-label">Nombre de Usuario</label>
                            <input id="username_update" value="" type="text" class="form-control" name="username_update" required autofocus>
                            <span class="help-block" id="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="email_update" class="control-label">Dirección E-Mail</label>
                            <input id="email_update" type="email"  value="" class="form-control" name="email_update" required>
                            <span class="help-block" id="error"></span>              
                        </div>

                            <div class="form-group ">
                                <label for="password_update" class="control-label">Contraseña</label>
                                <input id="password_update" type="password" value="" class="form-control" name="password_update" >
                            </div>

                            <div class="form-group ">
                                <label for="password-confirm" class="control-label">Confirmar Contraseña</label>
                                <input id="password-confirm" type="password" value="" class="form-control" name="password_confirmation_update" >
                                <span class="help-block" id="error"></span>
                            </div>
                            <div class="form-group ">
                                <label for="roles" class="control-label">{{ __('Roles') }}</label>

                                <div class="col-md-6">
                                    <select name="roles" id="rol_update" class="form-control"  required form="update-form">
                                        @foreach($roles as $rol)
                                        <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="deparatamentos" class="control-label">{{ __('departamentos') }}</label>

                                <div class="col-md-6">
                                    <select name="departamentos" id="departamentos_update" class="form-control selectpicker" multiple="multiple" form="update-form">
                                        @foreach($departamentos as $departamento)
                                            <option value="{{ $departamento->name }}">{{ $departamento->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input id="id_user" name="id_user_update" hidden value=""></input>
                            <div class="alert alert-warning margin-top" id="confirm_box" >
                                <strong>Cuidado!</strong> ¿Seguro que desea actualizar este usuario?
                                <button data-dismiss="modal" class="btn btn-info margin-top margin-left" id="no_update">Cancelar</button><button type="submit" class="btn btn-info margin-top margin-left" id="submit_update">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>      
        {{-- @include('update') --}}
        <div id="alert" class="alert alert-success"></div>
@stop

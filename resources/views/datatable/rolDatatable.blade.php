@extends('layouts.principal')

@section('content')
    
        <table class="table table-bordered table-striped" id="roles-table">
            <thead >
                <tr class="table-primary alineado_centro">
                    <th class="all">Id</th>
                    <th class="all">Nombre</th>
                    <th>descripción</th>
                    <th>Nivel de Seguridad</th>
                    <th>Creado</th>
                    <th>Modificado</th>
                    <th class="all">Acciones</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td class="non_searchable"></td>
                    <td></td>
                    <td class="non_searchable"></td>
                    <td ></td>
                    <td class="non_searchable"></td>
                    <td class="non_searchable"></td>
                    <td class="non_searchable"></td>
                </tr>
            </tfoot>
        </table> 
        {{-- @include('update') --}}
        <div id="alert" class="alert alert-success"></div>
        <div id="modal1_rol" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Update Rol</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="update-form">
                            @csrf
                            <div class="form-group"> <!-- Nombre del Adjudicatario-->
                                 <label for="name_update" class="control-label">Nombre del rol</label>
                                 <input id="name_update" value="" type="text" class="form-control" name="name_update" required autofocus>
                                 <span class="help-block" id="error"></span>
                             </div>

                            <div class="form-group ">
                                <label for="descripcion_update" class="control-label">Descripcion del rol</label>
                                <input id="descripcion_update" value="" type="text" class="form-control" name="descripcion_update" required autofocus>
                                <span class="help-block" id="error"></span>
                            </div>

                            <div class="form-group ">
                                <label for="level_update" class="control-label">Nivel de seguridad</label>
                                <input id="level_update" value="" type="text" class="form-control" name="level_update" required autofocus>
                                <span class="help-block" id="error"></span>
                            </div>

                            <input id="id_rol" name="id_rol_update" hidden value=""></input>
                            <div class="alert alert-warning margin-top" id="confirm_box" >
                                <strong>Cuidado!</strong> ¿Seguro que desea actualizar este rol?
                                <button data-dismiss="modal" class="btn btn-info margin-top margin-left" id="no_update">Cancelar</button><button type="submit" class="btn btn-info margin-top margin-left" id="submit_update">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
@stop

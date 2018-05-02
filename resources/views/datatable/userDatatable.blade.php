@extends('layouts.datatable')

@section('content')
    
        <table class="table table-bordered table-striped" id="users-table">
            <thead >
                <tr class="table-primary alineado_centro">
                    <th class="all">Id</th>
                    <th class="all">Nombre</th>
                    <th>Email</th>
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
                    <td class="non_searchable"></td>
                    <td class="non_searchable"></td>
                    <td class="non_searchable"></td>
                </tr>
            </tfoot>
        </table>
        <div class="modal fade" id="update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        </button>
                        <h4>Modal Test</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-primary" value="haz click">
                    </div>
                </div>
            </div>
        </div>      
        {{-- @include('update') --}}
        <div id="alert" class="alert alert-success"></div>
@stop

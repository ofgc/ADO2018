  $(document).ready(function(){
    $('#modal1_user').hide();
    $('#users-table').DataTable({

        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        ajax: 'datatablesUserData',
        columns: [
            { data: 'id', name: 'id',  responsivePriority: 1, orderable: false, searchable: false },
            { data: 'name', name: 'name', responsivePriority: 2 },
            { data: 'username', name: 'username', responsivePriority: 2 },
            { data: 'email', name: 'email', responsivePriority: 3 },
            { data: 'created_at', name: 'created_at', responsivePriority: 5, orderable: true, searchable: false },
            { data: 'updated_at', name: 'updated_at', responsivePriority: 6, orderable: true, searchable: false },
            { data: 'action', name: 'action',responsivePriority: 4, orderable: false, searchable: false}
        ],
        
        initComplete: function () {

            $('#alert').hide();
            this.api().columns().every(function () {
                var column = this;
                var columnClass = column.footer().className;
                if(columnClass != 'non_searchable'){
                    // var input = document.createElement("input");
                    $('<input size="10%">').appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                }
            });
        }
    });
    $('#users-table').on( 'draw.dt', function () {

        ////////////---------DELETE--------------///////////////
        
        $(".btn-delete").click(function(e){
            e.preventDefault();
                               
            if( ! confirm("¿Estas seguro de eliminar el usuario?"))return false;   
            var idUser = $(this).attr('id-delete');
            var row = $(this).parents('tr');
            $('#alert').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{'idUser':idUser},
                dataType:"JSON",
                url:'eliminarUsuario',

                success:function(data){
                    row.fadeOut(); 
                    $('#alert').html(data.message);
                }
            })
        })

        $('.btn-update').click(function(e){
            e.preventDefault();
            var row = $(this).parents('tr');
            var nombre = row.find("td").eq(1).html();
            var username = row.find("td").eq(2).html();
            var email = row.find("td").eq(3).html();
            $('#name_input').text(nombre);
            $('#username_input').text(username);
            $('#email_input').text(email);
            $('#modal1_user').modal('show');

        })
    });
    $('#roles-table').DataTable({

        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        ajax: 'datatablesRolesData',
        columns: [
            { data: 'id', name: 'id',  responsivePriority: 1, orderable: false, searchable: false },
            { data: 'name', name: 'name', responsivePriority: 2 },
            { data: 'description', name: 'description', responsivePriority: 3 },
            { data: 'created_at', name: 'created_at', responsivePriority: 5, orderable: true, searchable: false },
            { data: 'updated_at', name: 'updated_at', responsivePriority: 6, orderable: true, searchable: false },
            { data: 'action', name: 'action',responsivePriority: 4, orderable: false, searchable: false}
        ],
        
        initComplete: function () {

            $('#alert').hide();
            this.api().columns().every(function () {
                var column = this;
                var columnClass = column.footer().className;
                if(columnClass != 'non_searchable'){
                    $('<input size="10%">').appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                }
            });
        }
    });
    $('#roles-table').on( 'draw.dt', function () {

        ////////////---------DELETE--------------///////////////
        
        $(".btn-delete").click(function(e){
            e.preventDefault();
                               
            if( ! confirm("¿Estas seguro de eliminar el usuario?"))return false;   
            var idRol = $(this).attr('id-delete');
            var row = $(this).parents('tr');
            $('#alert').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{'idRol':idRol},
                dataType:"JSON",
                url:'eliminarRoles',

                success:function(data){
                    row.fadeOut(); 
                    $('#alert').html(data.message);
                }
            })
        })
    });
})

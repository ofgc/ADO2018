  $(document).ready(function(){
    $('#modal1_user').hide();
    $('#modal1_rol').hide();
    var table = $('#users-table').DataTable({

        processing: true,
        serverSide: false,
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
            { data: 'rol', name: 'rol', responsivePriority:3, searchable: false},
            { data: 'departament', name: 'departament', responsivePriority:3, searchable: true},
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

    $('#users-table').on( 'draw.dt', function () {

        ////////////---------DELETE USER--------------///////////////
        
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
                    $("#alert").fadeToggle(5000);
                }
            })
        })

        ////////////---------UPDATE USER--------------///////////////

        $('.btn-update').click(function(e){
            e.preventDefault();
            var row = $(this).parents('tr');
            var id = row.find("td").eq(0).html();
            var nombre = row.find("td").eq(1).html();
            var username = row.find("td").eq(2).html();
            var email = row.find("td").eq(3).html();
            var rol = row.find("td").eq(4).html()

            $('#id_user').val(id);
            $('#name_update').val(nombre);
            $('#username_update').val(username);
            $('#email_update').val(email);
            $('#rol_update').val(rol);
            $('#modal1_user').modal('show');
        })

        $("#update-form").validate({

            rules: {
                name_update : {required : true, lettersonly: true},
                username_update : "required",
                email_update : {required:true, email:true},
                password_confirmation_update : { equalTo :"#password_update"},
                roles:{ required:true}
            },
            messages: {
                name_update: "Este campo no puede estar vacio o tener numeros",
                username_update : "Este campo no puede estar vacio",
                email_update: "Este campo no puede estar vacio y debe tener formato de email",
                password_confirmation_update: "Las contraseñas no coinciden",
                roles:"El usuario debe tener al menos un rol",
            },
            errorPlacement : function(error, element) { 
                $(element).closest('.form-group').find('.help-block').html(error.html());
            },
            highlight : function(element) { 
                $(element).closest('.form-group').removeClass('has-success').addClass('alert alert-danger');
             },     
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass('alert alert-danger').addClass('has-success');
                $(element).closest('.form-group').find('.help-block').html('');
             }, 
            submitHandler: function(form) {
                var datos = $('#update-form').serialize();
                // $.ajax({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     type:'POST',
                //     data : datos,
                //     url: 'updateUsuario',
                // })
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url : 'updateUsuario',
                    dataType:"JSON",
                    data : datos,
                    success : function(data){    
                        $("#alert").html(data.message);  
                        $("#alert").show();
                        $("#alert").fadeToggle(5000);
                        $("#modal1_user").modal('toggle');
                        table.draw();
                    }
                })
            }                                
        }) // cierra validate
    });

    ////////////---------TABLE Rol--------------///////////////

    var table = $('#roles-table').DataTable({

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
            { data: 'level', name: 'level', responsivePriority: 2},
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

        ////////////---------DELETE Rol--------------///////////////
        
        $(".btn-delete").click(function(e){
            e.preventDefault();
                               
            if( ! confirm("¿Estas seguro de eliminar el rol?"))return false;   
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
                    $("#alert").fadeToggle(5000);
                }
            })
        })

        ////////////---------UPDATE Rol--------------///////////////

        $('.btn-update').click(function(e){
            e.preventDefault();
            var row = $(this).parents('tr');
            var id = row.find("td").eq(0).html();
            var nombre = row.find("td").eq(1).html();
            var descripcion = row.find("td").eq(2).html();
            var level = row.find("td").eq(3).html();


            $('#id_rol').val(id);
            $('#name_update').val(nombre);
            $('#descripcion_update').val(descripcion);
            $('#level_update').val(level);
            $('#modal1_rol').modal('show');
        })
        $("#update-form").validate({

            rules: {
                name_update : {required : true,  minlength: 4, lettersonly: true},
                descripcion_update : {required:false, minlength: 4},
            },
            messages: {
                name_update: "Este campo tiene que tener cuatro carácteres o tener numeros",
                descripcion_update : "Este campo debe tener cuatro carácteres como minimo",
            },
            errorPlacement : function(error, element) { 
                $(element).closest('.form-group').find('.help-block').html(error.html());
            },
            highlight : function(element) { 
                $(element).closest('.form-group').removeClass('has-success').addClass('alert alert-danger');
             },     
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass('alert alert-danger').addClass('has-success');
                $(element).closest('.form-group').find('.help-block').html('');
             }, 
            submitHandler: function(form) {
                var datos = $('#update-form').serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url : 'updateRol',
                    dataType:"JSON",
                    data : datos,
                    success : function(data){    
                        $("#alert").html(data.message);  
                        $("#alert").show();
                        $("#alert").fadeToggle(5000);
                        $("#modal1_rol").modal('toggle');
                        table.draw();
                    }
                })
            }                                
        })
    });
})

$( window ).on( "load", function() {

    var $table = $('#table'),
        $remove = $('#remove'),
        selections = [];

    window.operateEvents = {
        'click .like': function (e, value, row, index) {

            $("#modalfile").attr('data-id', row.dni)
            $("#modalfile").modal("show");
    };
    

    var tablaPrincipal = { 
        url: 'datos.php',
        filterControl: true,
        columns: [
                 {
                    field: 'id',
                    title: 'id',
                    sortable: true,
                    editable: false,
                    align: 'center',
                    type: 'select',
                    filterControl: 'input'
                         
                }, {
                    field: 'name',
                    title: 'Nombre',
                    sortable: true,
                    editable: false,
                    align: 'center',
                    filterControl: 'input'

                }, {
                    field: 'username',
                    title: 'Nombre de Usuario',
                    sortable: true,
                    align: 'center',
                    visible: false,
                    filterControl: 'input'

                }, {
                    field: 'email',
                    title: 'Email',
                    sortable: true,
                    align: 'center',
                    visible: false,
                    filterControl: 'input'

                }],
    };

    $('#table').bootstrapTable ( tablaPrincipal );

    function totalNameFormatter(data) {
        return data.length;
    }


    function getIdSelections() {
        return $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.dni
        });
    }

    function operateFormatter(value, row, index) {
        return [
            '<a class="like" href="javascript:void(0)" title="Like">',
            '<i class="glyphicon glyphicon-picture"></i>',
            '</a>  '
        ].join('');
    }
});


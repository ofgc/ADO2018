<head>
    <title>Laravel DataTables</title>
 {{--    //<link rel="stylesheet" href="css/bootstrap.min.css">
    //<link rel="stylesheet" href="css/app.css">
    //<link rel="stylesheet" href="css/style.css"> --}}
    <link rel="stylesheet" href="css/datatables.bootstrap.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/datatables.min.js"></script>
</head>
<body>

<div class="container">
    <table id="task" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        </thead>
    </table>
</div>
 
<script type="text/javascript">
    $(document).ready(function() {
        oTable = $('#task').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('datatable.pepe') }}",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'}
            ]
        });
    });
</script>

</body>
</html>
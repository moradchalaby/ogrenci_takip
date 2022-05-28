 @extends('layouts.app')


 @section('content')
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>ROUTES</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="#">Home</a></li>
                             <li class="breadcrumb-item active">Routes</li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>
         <!-- Main content -->
         <section class="content">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-12">


                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title"> Tam Liste</h3>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <!-- /.card-header -->
                             <div class="card-body">
                                 <table id="tbl_routes" class="table table-bordered table-striped">
                                     <thead>
                                         <tr>
                                             <th>Method</th>
                                             <th>URI</th>
                                             <th>Name</th>
                                             <th>Action</th>
                                             <th>Middleware</th>
                                             <th>Button</th>

                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($routes as $route)
                                             <tr>
                                                 <td class="d-i-f">
                                                     @foreach ($route['methods'] as $method)
                                                         @if ($method == 'GET' || $method == 'HEAD')
                                                             <label class="badge badge-success">{{ $method }}</label>
                                                         @elseif($method == 'PUT' || $method == 'PATCH')
                                                             <label class="badge badge-info">{{ $method }}</label>
                                                         @elseif($method == 'POST')
                                                             <label class="badge badge-warning">{{ $method }}</label>
                                                         @elseif($method == 'DELETE')
                                                             <label class="badge badge-danger">{{ $method }}</label>
                                                         @endif
                                                     @endforeach
                                                 </td>
                                                 <td>
                                                     {{ $route['uri'] }}
                                                 </td>
                                                 <td>
                                                     {{ $route['name'] }}
                                                 </td>
                                                 <td>
                                                     {{ $route['action'] }}
                                                 </td>
                                                 <td>
                                                     {{ $route['middleware'] }}
                                                 </td>
                                                 <td>

                                                 </td>

                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                             </div>
                             <!-- /.card-body -->
                         </div>
                         <!-- /.card -->
                     </div>
                     <!-- /.col -->
                 </div>
                 <!-- /.row -->
             </div>
             <!-- /.container-fluid -->
         </section>
         <!-- /.content -->
     </div>
 @endsection
 @section('css')
 @endsection
 @section('js')
 @endsection
 @section('script')
     <script src="plugins/datatables/jquery.dataTables.min.js"></script>
     <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
     <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
     <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
     <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
     <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
     <script src="plugins/jszip/jszip.min.js"></script>
     <script src="plugins/pdfmake/pdfmake.min.js"></script>
     <script src="plugins/pdfmake/vfs_fonts.js"></script>
     <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
     <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
     <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
     <script src="dist/js/tolower.js"></script>
     <script type="text/javascript">
         $(document).ready(function() {
             $('#tbl_routes').DataTable({
                 pageLength: 10,
                 language: {
                     emptyTable: "No routes available",
                     info: "Showing _START_ to _END_ of _TOTAL_ routes",
                     infoEmpty: "Showing 0 to 0 of 0 routes",
                     infoFiltered: "(filtered from _MAX_ total routes)",
                     lengthMenu: "Show _MENU_ routes",
                     search: "Search routes:",
                     zeroRecords: "No routes match search criteria"
                 },
                 "responsive": true,
                 "lengthMenu": [
                     [-1, 10, 25, 50],
                     ["Tümü", 10, 25, 50]
                 ],
                 "autoWidth": true,
                 order: [
                     [
                         1,
                         'asc'
                     ],
                 ]
             });
         });
     </script>
 @endsection

  @extends('layouts.app')


  @section('content')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1>DataTables</h1>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">DataTables</li>
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
                                  <h3 class="card-title">DataTable with default features</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <table id="example1" class="table table-bordered table-striped">
                                      <thead>
                                          <tr>
                                              <td>S.no</td>

                                              <td>Name</td>
                                              <td>Email</td>
                                          </tr>
                                      </thead>
                                      <tfoot>
                                          <tr>
                                              <td>S.no</td>

                                              <td>Name</td>
                                              <td>Email</td>
                                          </tr>
                                      </tfoot>
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
      <!-- DataTables  & Plugins -->
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
      <script>
          $(function() {
              $("#example1").DataTable({
                  ajax: "{{ route('personel.getEmployees') }}",

                  processing: true,
                  serverSide: true,

                  columns: [{
                          data: 'id'
                      },
                      {
                          data: 'name'
                      },

                      {
                          data: 'email'
                      },
                  ],
                  "responsive": true,
                  "lengthChange": false,
                  "autoWidth": false,
                  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

          });
      </script>
  @endsection

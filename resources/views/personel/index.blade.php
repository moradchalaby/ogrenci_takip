  @extends('layouts.app')


  @section('content')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1>{!! $veri['title'] !!}</h1>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">{!! $veri['page'] !!}</li>
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
                                  <h3 class="card-title">{!! $veri['table_desc'] !!}</h3>
                                  <div class="card-tools">
                                      <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                          data-target="#modalAdd">
                                          Yeni Ekle
                                      </button>

                                  </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                  {!! $html->table() !!}
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




      <div class="modal fade" id="modalAdd">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Yeni Personel Ekle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="useradd" action="#">
                          @csrf
                          <div class="input-group mb-3">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                              @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                  name="email" value="{{ old('email') }}" required autocomplete="email">

                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <input id="password" type="password"
                                  class="form-control @error('password') is-invalid @enderror" name="password" required
                                  autocomplete="new-password">

                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <input id="password-confirm" type="password" class="form-control"
                                  name="password_confirmation" required autocomplete="new-password">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="icheck-primary">
                              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                              <label for="agreeTerms">
                                  I agree to the <a href="#">terms</a>
                              </label>
                          </div>
                          <div class="modal-footer justify-content-between">




                              <!-- /.col -->

                              <button type="button" class="btn btn-default bg-danger" data-dismiss="modal">İptal</button>
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Kaydet') }}</button>

                              <!-- /.col -->



                          </div>

                      </form>
                  </div>

              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
      <script src="dist/js/tolower.js"></script>
      <script>
          (function($, DataTable) {

              // Datatable global configuration
              $.extend(true, DataTable.defaults, {
                  language: {
                      "url": "/dist/js/tr.json"
                  },

                  "buttons": ["copy", "csv", "excel", "pdf", {
                      extend: 'print',

                      exportOptions: {
                          columns: ':visible'
                      }
                  }, "colvis"],
                  "responsive": true,
                  "lengthMenu": [
                      [-1, 10, 25, 50],
                      ["Tümü", 10, 25, 50]
                  ],
                  "autoWidth": true,

              });

          })(jQuery, jQuery.fn.dataTable);
      </script>

      {!! $html->scripts() !!}
      <script>
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#useradd').on("submit", function(e) {
              e.preventDefault();
              var formdata = $('#useradd').serializeArray();
              //console.log(formdata);
              $.ajax({

                  url: '{{ route('register') }}',
                  type: 'POST',
                  data: {
                      name: formdata[1]['value'],
                      email: formdata[2]['value'],
                      password: formdata[3]['value'],
                      password_confirmation: formdata[4]['value'],
                      terms: formdata[5]['value'],


                  },
                  dataType: 'text',
                  success: (data) => {
                      var dat = JSON.parse(data);
                      $("#example1").DataTable().ajax.reload();
                      $('#modalAdd').modal('hide');
                      console.log(data);
                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 3000
                      });
                      Toast.fire({
                          icon: 'success',
                          title: dat["name"] + '<br>  İşlem Başarılı <br>',
                      })

                      document.getElementById("useradd").reset();
                  },
                  error: function(data) {
                      var dat = JSON.parse(data);
                      $('#modalAdd').modal('hide');


                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 3000
                      });
                      Toast.fire({
                          icon: 'error',
                          title: dat["name"]

                              +
                              '<br> İşlem başarısız <br>',
                      })
                      document.getElementById("useradd").reset();
                  },
              });


          })
      </script>
  @endsection

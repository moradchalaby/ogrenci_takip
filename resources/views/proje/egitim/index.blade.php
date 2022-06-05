  @extends('layouts.app')

  @section('head')
      <!-- BS Stepper -->
      <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  @endsection
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
                              <li class="breadcrumb-item"><a href="#">Anasayfaw</a></li>
                              <li class="breadcrumb-item active">{!! $veri['name'] !!}</li>
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
                                  <h3 class="card-title">{!! $veri['name'] !!} Tam Liste</h3>
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
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Yeni {!! $veri['name'] !!} Ekle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="col-md-12">


                          <!-- your steps content here -->
                          <form method="POST" id="useradd" action="#">
                              <div class="form-group row">
                                  <select id="hoca" name="hoca_id" class="form-control col select2">


                                  </select>
                                  <select id="ogrenci" name="ogrenci_id" class="form-control col select2">
                                      <option value="">Ömce Hoca Seçimi yapınız</option>


                                  </select>

                              </div>

                              <button type="submit" class="btn btn-success">Kaydet</button>






                          </form>
                      </div>
                  </div>
                  <!-- /.card-body -->


                  <div class="modal-footer justify-content-between">


                      Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper
                          documentation</a>
                      for
                      more examples and information about the plugin.

                      <!-- /.col -->





                  </div>

              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>

      <!-- /.modal -->

      <!-- /.modal -->
  @endsection
  @section('css')
  @endsection
  @section('js')
  @endsection
  @section('script')
      <!-- DataTables  & Plugins -->
      <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="/plugins/jszip/jszip.min.js"></script>
      <script src="/plugins/pdfmake/pdfmake.min.js"></script>
      <script src="/plugins/pdfmake/vfs_fonts.js"></script>
      <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      <script src="/plugins/inputmask/jquery.inputmask.min.js"></script>
      <!-- BS-Stepper -->
      <script src="/plugins/bs-stepper/js/bs-stepper.min.js"></script>
      <script src="/dist/js/tolower.js"></script>
      <script>
          $(document).on("click", ".editmodal", function() {
              var id = $(this).data('id');

              $.ajax({
                  type: 'post',
                  url: "{{ route('birimogrenci.edit') }}",
                  dataType: 'json',
                  data: {
                      id: id
                  },
                  success: function(ogrenciedit) {
                      var dat = JSON.stringify(ogrenciedit);
                      var datim = JSON.parse(dat);


                      Object.keys(datim).forEach(function(key) {
                          // var value = jsonData[key];
                          if ($('#' + key).length) {
                              $(`#useredit #${key}`).val(datim[key]);
                          }
                      });
                      console.log('success: ' + dat);
                      $('#useredit #okuldurum').val(`${datim.okul_id}`);
                      $('#useredit #birime').val(`${datim.birim_id}`);
                      $('#useredit #resim').attr('src', datim.ogrenci_resim);
                  },
                  error: function(ogrenciedit) {
                      var dat = JSON.stringify(ogrenciedit);
                      var datim = JSON.parse(dat);


                      console.log('error: ' + dat);
                  },
              });
          });
      </script>


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
          $('#useradd #hoca').change(function() {
              ogrencicek('#useradd #ogrenci', $('#useradd #hoca').val())
          });
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#useradd').on("submit", function(e) {
              e.preventDefault();
              var form = $('#useradd')[0];
              var data = new FormData(form);

              // file_button.after('<br><br><hr><br><img src="' + file_data + '" width="350px">');
              $.ajax({

                  url: "{{ route('projeogrenci.store') }}",
                  type: 'POST',
                  contentType: false,
                  cache: false,
                  processData: false,
                  data: data,
                  dataType: 'text',
                  success: (datam) => {
                      var dat = JSON.parse(datam);
                      $("#example1").DataTable().ajax.reload();
                      //  file_button.after('<br><br><hr><br><img src="' + file_data + '" width="350px">');
                      $('#modalAdd').modal('hide');
                      console.log(datam);
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



          hocagetir('#useradd #hoca');

          function hocagetir(id, ogrenci_id) {
              $.ajax({
                  type: 'post',
                  url: "{{ route('projeogrenci.hocagetir') }}",
                  data: {
                      get_option: true,
                      ogrenci_id: ogrenci_id
                  },
                  success: function(response) {
                      $(id).html(response);
                  }
              });
          }

          function ogrencicek(id) {
              $.ajax({
                  type: 'post',
                  url: "{{ route('projeogrenci.ogrencicek') }}",
                  data: {
                      get_option: true
                  },
                  success: function(response) {
                      $(id).html(response);
                  }
              });
          }

          birimgetir('#useredit #birime');
          birimgetir('#useradd #birim');

          function birimgetir(id) {
              $.ajax({
                  type: 'post',
                  url: "{{ route('birimhoca.birimgetir') }}",
                  data: {
                      get_option: true
                  },
                  success: function(response) {
                      $(id).html(response);
                  }
              });
          }
      </script>
  @endsection

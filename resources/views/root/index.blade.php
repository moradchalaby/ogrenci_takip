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
                                          data-target="#modalFilter">
                                          Filtrele
                                      </button>
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
                      <h4 class="modal-title">Yeni Ekle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="roleadd" action="#">
                          @csrf



                          <div class="form-group">
                              <label for="name">Name</label>
                              <input id="name" type="text" class="form-control" name="name" value="">

                          </div>
                          <div class="form-group">
                              <label for="slug">Slug</label>
                              <input id="roles_slug" type="text" class="form-control" name="roles_slug" value="">

                          </div>
                          <div class="form-group">
                              <label for="parent">Parent</label>
                              <input id="parent" type="text" class="form-control" name="parent" value="">

                          </div>
                          <div class="form-group">
                              <label for="vazife">Vazife</label>
                              <input id="vazife" type="text" class="form-control" name="vazife" value="">

                          </div>



                          <button type="submit" class="btn btn-outline-info" onclick="">Kaydet</button>

                      </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                  </div>


                  <!-- /.modal-content -->

                  <!-- /.modal-dialog -->
              </div>
          </div>

      </div>
      <div class="modal fade" id="modalFilter">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Filtreler</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="filter" action="{{ route('root.indexpost') }}">
                          @csrf



                          <div class="form-group">
                              <select id="birim" name="birim_id" class="form-control select2" style="width: 100%;">
                              </select>

                          </div>
                          <div class="form-group">
                              <select id="role" name="role_id" class="form-control select2" style="width: 100%;">
                              </select>

                          </div>



                          <button type="submit" class="btn btn-outline-info" onclick="">Filtrele</button>

                      </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                  </div>


                  <!-- /.modal-content -->

                  <!-- /.modal-dialog -->
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalEdit">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Düzenle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="roleedit" action="#">
                          @csrf

                          <input type="hidden" name="id" id="id" value="">

                          <div class="form-group">
                              <label for="name">Name</label>
                              <input id="name" type="text" class="form-control" name="name" value="">

                          </div>
                          <div class="form-group">
                              <label for="slug">Slug</label>
                              <input id="roles_slug" type="text" class="form-control" name="slug" value="">

                          </div>
                          <div class="form-group">
                              <label for="parent">Parent</label>
                              <input id="parent_id" type="text" class="form-control" name="parent" value="">

                          </div>
                          <div class="form-group">
                              <label for="vazife">Vazife</label>
                              <input id="vazife_id" type="text" class="form-control" name="vazife" value="">

                          </div>



                          <button type="submit" class="btn btn-outline-info" onclick="">Kaydet</button>

                      </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                  </div>


                  <!-- /.modal-content -->

                  <!-- /.modal-dialog -->
              </div>
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
          jQuery.extend(jQuery.fn.dataTableExt.oSort, {
              'locale-compare-asc': function(a, b) {
                  return a.localeCompare(b, 'cs', {
                      sensitivity: 'case'
                  })
              },
              'locale-compare-desc': function(a, b) {
                  return b.localeCompare(a, 'cs', {
                      sensitivity: 'case'
                  })
              }
          })

          jQuery.fn.dataTable.ext.type.search['locale-compare'] = function(data) {

              return NeutralizeAccent(data);
          }

          function NeutralizeAccent(data) {

              return !data ?
                  '' :
                  typeof data === 'string' ?
                  data.toLocaleUpperCase()
                  .replace(/\n/g, ' ')
                  .replace(/[C]/g, 'C')
                  .replace(/[Ç]/g, 'Ç')
                  .replace(/[G]/g, 'G')
                  .replace(/[Ğ]/g, 'Ğ')
                  .replace(/[I]/g, 'I')
                  .replace(/[İ]/g, 'İ')
                  .replace(/[O]/g, 'O')
                  .replace(/[Ö]/g, 'Ö')
                  .replace(/[S]/g, 'S')
                  .replace(/[Ş]/g, 'Ş')
                  .replace(/[U]/g, 'U')
                  .replace(/[Ü]/g, 'Ü')
                  .replace(/[c]/g, 'c')
                  .replace(/[ç]/g, 'ç')
                  .replace(/[g]/g, 'g')
                  .replace(/[ğ]/g, 'ğ')
                  .replace(/[ı]/g, 'ı')
                  .replace(/[i]/g, 'i')
                  .replace(/[o]/g, 'o')
                  .replace(/[ö]/g, 'ö')
                  .replace(/[s]/g, 's')
                  .replace(/[ş]/g, 'ş')
                  .replace(/[u]/g, 'u')
                  .replace(/[ü]/g, 'ü') :
                  data

          }
          $.fn.dataTable.ext.order['dom-text'] = function(settings, col) {
              return this.api().column(col, {
                  order: 'index'
              }).nodes().map(function(td, i) {
                  return $('a', td).text();
              });
          };

          (function($, DataTable) {

              // Datatable ayarları
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
                  scrollY: "900px",
                  scrollX: true,
                  scrollCollapse: true,

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
          //veri çekme

          $(function() {
              $('#example1_filter input').keyup(function(e) {
                  alert('Handler for .keyup() called.');

                  console.log('---');
                  e.value = e.value.toLocaleUpperCase();
                  console.log(e.value);

              });
          });
      </script>
      {{-- datatble config bitiş --}}
      <script>
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $('#roleadd').on("submit", function(e) {

              e.preventDefault();
              var form = $('#roleadd')[0];
              var data = new FormData(form);

              $.ajax({

                  url: '{{ route('root.store') }}',
                  type: 'post',

                  contentType: false,
                  cache: false,
                  processData: false,
                  data: data,
                  dataType: 'text',


                  success: (datam) => {
                      var dat = JSON.parse(datam);
                      $("#example1").DataTable().ajax.reload();

                      $('#modalAdd').modal('hide');
                      console.log(datam);
                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 4000
                      });
                      Toast.fire({
                          icon: 'success',
                          title: dat["name"] +
                              '<br>  İşlem Başarılı <br> <br> Varsayılan Şifre  <br> akmescid1453',
                      })

                      document.getElementById("roleadd").reset();
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
                      document.getElementById("roleadd").reset();
                  },
              });

          })
      </script>
      <script>
          $('#roleedit').on("submit", function(e) {

              e.preventDefault();

              var form = $('#roleedit')[0];
              var data = new FormData(form);

              console.log(data);
              $.ajax({

                  url: '{{ route('root.update') }}',
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
                      $('#modalEdit').modal('hide');
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

                      document.getElementById("roleedit").reset();
                  },
                  error: function(data) {
                      var dat = JSON.parse(data);
                      $('#modalEdit').modal('hide');


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
                      document.getElementById("roleedit").reset();
                  },
              });

          })
      </script>
      <script>
          $(document).on("click", "#rolesil", function() {
              var id = $(this).data('id');
              console.log(id);
              $.ajax({
                  type: 'post',
                  url: "{{ route('root.delete') }}",
                  dataType: 'json',
                  data: {
                      id: id
                  },
                  success: function(datam) {

                      var dat = JSON.parse(datam);
                      $("#example1").DataTable().ajax.reload();

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
          $(document).on("click", ".editmodal", function() {
              var id = $(this).data('id');

              $.ajax({
                  type: 'post',
                  url: "{{ route('root.edit') }}",
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
                              $(`#roleedit #${key}`).val(datim[key]);
                          }
                      });
                      console.log('success: ' + dat);

                      $('#roleedit #role_id').val(id);
                  },
                  error: function(ogrenciedit) {
                      var dat = JSON.stringify(ogrenciedit);
                      var datim = JSON.parse(dat);


                      console.log('error: ' + dat);
                  },
              });
          });
      </script>
      {{-- hoca ve birim verş baş --}}

      {{-- hoca ve birim verş bitiş --}}
  @endsection

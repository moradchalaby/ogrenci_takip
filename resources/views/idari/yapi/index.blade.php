  @extends('layouts.app')
  @section('title','Akmescid Erkek Öğrenci Yurdu - '.$veri['title'])


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
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Yeni Birim Ekle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="birimadd" action="#">
                          @csrf
                          <div class="input-group mb-3">
                              <input id="birim_adi" name="birim_adi" class="form-control">

                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <select name="yearpicker" id="yearpicker" class="form-control select2">
                                  <option value="">SEÇİNİZ</option>p
                              </select>
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                  </div>
                              </div>
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

      <div class="modal fade" id="modalEdit">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Birim İsmi Değiştir</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="birimedit" action="#">
                          @csrf
                          <div class="input-group mb-3">
                              <input id="birim_adi" name="birim_ad" class="form-control">

                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-pen-to-square"></span>
                                  </div>
                              </div>
                          </div>

                          <input type="hidden" id="birim_id" name="birim_id" class="form-control">

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
      <script>
          $('#modalEdit').on('show.bs.modal', function(e) {

              //get data-id attribute of the clicked element
              var id = $(e.relatedTarget).data('id');
              var ad = $(e.relatedTarget).data('ad');
              //populate the textbox
              $(e.currentTarget).find('input[name="birim_id"]').val(id);
              $(e.currentTarget).find('input[name="birim_ad"]').val(ad);
          });
      </script>
      <script>
          $('#birimedit').on("submit", function(e) {

              e.preventDefault();
              var form = $('#birimedit')[0];
              var data = new FormData(form);

              $.ajax({

                  url: "{{ route('birim.update') }}",
                  type: 'post',

                  contentType: false,
                  cache: false,
                  processData: false,
                  data: data,
                  dataType: 'text',


                  success: (d) => {
                      var dat = JSON.stringify(d);
                      var datim = JSON.parse(dat);
                      $("#example1").DataTable().ajax.reload();

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
                          title: dat["birim_ad"] + '<br>  Olarak Değişti <br>',
                      })

                      document.getElementById("birimedit").reset();
                  },
                  error: function(d) {
                      var dat = JSON.stringify(d);
                      var datim = JSON.parse(dat);
                      $('#modalEdit').modal('hide');


                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 3000
                      });
                      Toast.fire({
                          icon: 'error',
                          title: dat["birim_ad"]

                              +
                              '<br>Düzenleme İşlemi başarısız <br>',
                      })
                      document.getElementById("birimedit").reset();
                  },
              });

          })
          $('.select2').select2({
              theme: 'bootstrap4',

          });
      </script>
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
      {{-- Delete Birim baş --}}
      <script>
          $(document).on("click", ".deletebirim", function() {
              var id = $(this).data('id');
              console.log(id)
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });


              $.ajax({
                  type: 'post',

                  url: "{{ route('birim.destroy') }}",
                  dataType: 'json',
                  data: {
                      birim_id: id
                  },
                  success: function(d) {
                      var dat = JSON.stringify(d);

                      $("#example1").DataTable().ajax.reload();
                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 3000
                      });
                      Toast.fire({
                          icon: 'success',
                          title: dat["birim_ad"] + '<br>Silme İşlemi Başarılı <br>',
                      })
                  },

                  error: function(d) {
                      var dat = JSON.stringify(d);
                      $("#example1").DataTable().ajax.reload();
                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 3000
                      });
                      Toast.fire({
                          title: dat["birim_ad"]

                              +
                              '<br>Silme İşlemi başarısız <br>',
                      })

                  },
              });
          });
      </script>
      {{-- Delete Birim bitiş --}}
      <script>
          let startYear = 2008;
          let endYear = new Date().getFullYear() + 1;
          var a;
          for (i = endYear; i > startYear; i--) {
              a = i + ' - ' + (i + 1);
              $('#yearpicker').append($('<option />').val(a).html(a));
          }

          $('.select2').select2({
              theme: 'bootstrap4',

          });
      </script>
      <script>
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#birimadd').on("submit", function(e) {
              e.preventDefault();
              var formdata = $('#birimadd').serializeArray();
              console.log(formdata);
              $.ajax({

                  url: '/birim/birimadd',
                  type: 'POST',
                  data: {
                      birim_ad: formdata[1]['value'],
                      birim_donem: formdata[2]['value'],

                  },
                  dataType: 'text',
                  success: (data) => {
                      console.log('success');
                      console.log(data);
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
                          title: dat["birimad"] + '<br>  İşlem Başarılı <br>',
                      })

                      document.getElementById("birimadd").reset();
                  },
                  error: function(data) {
                      // var dat = JSON.parse(data);
                      $('#modalAdd').modal('hide');
                      console.log('error');
                      console.log(data);

                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 3000
                      });
                      Toast.fire({
                          icon: 'error',
                          title: data

                              +
                              '<br> İşlem başarısız <br>',
                      })
                      document.getElementById("birimadd").reset();
                  },
              });


          })
      </script>
  @endsection

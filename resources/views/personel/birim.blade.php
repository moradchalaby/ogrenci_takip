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
                                  <div class="card-tools">
                                      <button type="button" class="btn btn-success btn-xs" id="yeni" data-toggle="modal"
                                          data-target="#modalAdd">
                                          Yeni Ekle
                                      </button>

                                  </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <table id="example1" class="table table-bordered table-striped">
                                      <thead>
                                          <tr>
                                              <td>Resim</td>

                                              <td>Name</td>

                                              <td>Birim</td>
                                              <td>Islemler</td>
                                          </tr>
                                      </thead>
                                      <tbody></tbody>

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




      <div class="modal fade" id="modalAdd">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Yeni Birim Sorumlusu Ekle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form id="birimhocaekle" action="">
                          @csrf
                          <div class="input-group mb-3">
                              <select id="hoca" name="kullanici_id" class="form-control">
                              </select>
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <select id="birim" name="birim_id" class="form-control">
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
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#birimhocaekle').on("submit", function(e) {
              console.log('çalıştı')
              e.preventDefault();
              var formdata = $('#birimhocaekle').serializeArray();
              console.log(formdata);
              $.ajax({

                  url: "{{ route('birimhoca.create') }}",
                  type: 'POST',
                  data: {
                      kullanici_id: formdata[1]['value'],
                      birim_id: formdata[2]['value'],



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

                      document.getElementById("birimhocaekle").reset();
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
      <script>
          $(function() {
              var table = $("#example1").DataTable({
                  ajax: "{{ route('birimhoca.getBirim') }}",

                  processing: true,
                  serverSide: true,
                  "deferRender": true,
                  order: 'desc',
                  "buttons": ["copy", "csv", "excel", "pdf", {
                      extend: 'print',

                      exportOptions: {
                          columns: ':visible'
                      }
                  }, "colvis"],
                  columns: [{
                          data: 'kullanici_resim'
                      },
                      {
                          data: 'name'
                      },

                      {
                          data: 'birim_ad'
                      },
                      {
                          data: 'islemler'
                      },
                  ],
                  "language": {
                      buttons: {
                          colvis: 'Sütun Seç',
                          copy: "Kopyala",
                          print: "Yazdır"
                      },
                      "decimal": "",

                      "emptyTable": "Tabloda veri yok",
                      "info": "",
                      "infoEmpty": "",
                      "infoFiltered": "(Toplam _MAX_ kayıt.)",
                      "infoPostFix": "",
                      "thousands": ",",
                      "lengthMenu": "Gösterilen _MENU_",
                      "loadingRecords": "Yükleniyor...",
                      "processing": "İşleniyor...",
                      "search": "Arama:",
                      "zeroRecords": "Eşleşen kayıt bulunamadı",
                      "paginate": {
                          "first": "İlk",
                          "last": "Son",
                          "next": "İleri",
                          "previous": "Geri"
                      },
                      "aria": {
                          "sortAscending": ": sütunu artan şekilde sıralamak için etkinleştirin",
                          "sortDescending": ": sütunu azalan sıralamak için etkinleştir"
                      }
                  },
                  "responsive": true,
                  "lengthMenu": [
                      [-1, 10, 25, 50],
                      ["Tümü", 10, 25, 50]
                  ],
                  "autoWidth": true,
                  initComplete: function() {
                      table.buttons().container()
                          .appendTo($('.col-md-6:eq(0)', table.table().container()));
                  }

              });

          });
      </script>
      <script>
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          hocagetir();
          birimgetir();

          function hocagetir() {
              $.ajax({
                  type: 'post',
                  url: '/hocagetir',
                  data: {
                      get_option: true
                  },
                  success: function(response) {
                      document.getElementById("hoca").innerHTML = response;
                  }
              });
          }

          function birimgetir() {
              $.ajax({
                  type: 'post',
                  url: '/birimgetir',
                  data: {
                      get_option: true
                  },
                  success: function(response) {
                      document.getElementById("birim").innerHTML = response;
                  }
              });
          }
      </script>
  @endsection

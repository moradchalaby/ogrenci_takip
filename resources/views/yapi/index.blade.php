  @extends('layouts.app')


  @section('content')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1>BİRİMLER</h1>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Birimler</li>
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
                                  <h3 class="card-title">Birim Listesi</h3>
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
                                              <td>Sıra</td>
                                              <td>Dönem</td>
                                              <td>Birim Adı</td>
                                              <td>Birim Sorumlusu</td>
                                              <td>İşlem</td>


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
                              <select name="yearpicker" id="yearpicker" class="form-control">
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
                      <form method="POST" id="birimadd" action="#">
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
          $(function() {
              var table = $("#example1").DataTable({
                  ajax: "{{ route('birim.getBirim') }}",

                  processing: true,
                  serverSide: true,
                  "deferRender": true,
                  "order": [
                      [0, "desc"]
                  ],
                  "buttons": ["copy", "csv", "excel", "pdf", {
                      extend: 'print',

                      exportOptions: {
                          columns: ':visible'
                      }
                  }, "colvis"],
                  columns: [{
                          data: 'birim_id'
                      },
                      {
                          data: 'birim_donem'
                      },
                      {
                          data: 'birim_ad'
                      },
                      {
                          data: 'birim_sorumlu'
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
          let startYear = 2008;
          let endYear = new Date().getFullYear();
          var a;
          for (i = endYear; i > startYear; i--) {
              a = i + ' - ' + (i + 1);
              $('#yearpicker').append($('<option />').val(a).html(a));
          }
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
              //console.log(formdata);
              $.ajax({

                  url: '/birim/birimadd',
                  type: 'POST',
                  data: {
                      birim_ad: formdata[1]['value'],
                      birim_donem: formdata[2]['value'],

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
                          title: dat["birimad"] + '<br>  İşlem Başarılı <br>',
                      })

                      document.getElementById("birimadd").reset();
                  },
                  error: function(data) {
                      // var dat = JSON.parse(data);
                      $('#modalAdd').modal('hide');
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

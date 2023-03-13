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
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Yeni {!! $veri['name'] !!} Ekle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="useradd" action="#">
                          @csrf
                          <div class="input-group mb-3">
                              <input id="aname" type="text" class="form-control @error('name') is-invalid @enderror"
                                  name="name" placeholder="AD SOYAD" value="{{ old('name') }}" required
                                  autocomplete="name" autofocus>

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
                              <input id="aemail" type="email" class="form-control @error('email') is-invalid @enderror"
                                  name="email" placeholder="E-MAİL" value="{{ old('email') }}" required
                                  autocomplete="email">

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
                              <input id="akullanici_dt" type="date" class="form-control" name="kullanici_dt"
                                  value="{{ old('kullanici_dt') }}">


                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-calendar"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <input id="akullanici_tc" type="text" class="form-control input-group-append"
                                  name="kullanici_tc" placeholder=" TC No" onblur="tckimlikkontorolu(this);" maxlength="11">
                              <div class="  input-group-text">
                                  <span class="text-bold ">TC</span>
                              </div>

                          </div>
                          <div class="input-group mb-3">
                              <input id="akullanici_gsm" type="text" class="form-control" name="kullanici_gsm"
                                  placeholder="Tel No" data-inputmask='"mask": "(999) 999-9999"' data-mask>


                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-phone"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">

                              <textarea class="form-control" name="kullanici_adres" id="akullanici_adres" placeholder="Adres" cols="10"
                                  rows="2"></textarea>

                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fa-solid fa-location-dot"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">

                              <div class="input-groupr  input-file " id="akullanici_resim" name="kullanici_resim">
                                  <span class="input-groupr-btn">
                                      <button class="btn btn-default btn-choose" id="file_button" type="button">Resim
                                          Ekle</button>
                                  </span>
                                  <input type="text" class="form-control" name="adeger_resim"
                                      placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
                                  <span class="input-groupr-btn">
                                      <button class="btn btn-warning btn-reset" type="button">Temizle</button>
                                  </span>

                              </div>

                          </div>

                          <div class="input-group mb-3">
                              <input id="apassword" type="password"
                                  class="form-control @error('password') is-invalid @enderror" name="password"
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
                              <input id="apassword-confirm" type="password" class="form-control"
                                  name="password_confirmation" autocomplete="new-password">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="icheck-primary hidden">
                              <input type="checkbox" id="aagreeTerms" name="terms" checked>
                              <label for="agreeTerms">
                                  I agree to the <a href="#">terms</a>
                              </label>
                          </div>
                          <div class="modal-footer justify-content-between">




                              <!-- /.col -->

                              <button type="button" class="btn btn-default bg-danger"
                                  data-dismiss="modal">İptal</button>
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Kaydet') }}</button>

                              <!-- /.col -->



                          </div>

                      </form>
                  </div>

              </div>
              <!-- /.modal-content -->
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
                      <form method="POST" id="filter" action="{{ route('personel.indexpost') }}">
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
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Yeni {!! $veri['name'] !!} Ekle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="useredit" action="#">
                          @csrf
                          <div class="input-group mb-3">
                              <input id="name" type="text"
                                  class="form-control @error('name') is-invalid @enderror" name="name"
                                  placeholder="AD SOYAD" value="{{ old('name') }}" required autocomplete="name"
                                  autofocus>
                              <input id="kullanici_id" type="text" class="form-control" name="kullanici_id"
                                  value="">
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
                              <input id="email" type="email"
                                  class="form-control @error('email') is-invalid @enderror" name="email"
                                  placeholder="E-MAİL" value="{{ old('email') }}" required autocomplete="email">

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
                              <input id="kullanici_dt" type="date" class="form-control" name="kullanici_dt"
                                  value="{{ old('kullanici_dt') }}">


                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-calendar"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <input id="kullanici_tc" type="text" class="form-control" name="kullanici_tc"
                                  placeholder=" TC No" onblur="tckimlikkontorolu(this);" maxlength="11">

                              <div class=" input-group-append">
                                  <div class="input-group-text">
                                      <span class="text-bold ">TC</span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <input id="kullanici_gsm" type="text" class="form-control" name="kullanici_gsm"
                                  placeholder="Tel No" data-inputmask='"mask": "(999) 999-9999"' data-mask>


                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-phone"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">

                              <textarea class="form-control" name="kullanici_adres" id="kullanici_adres" placeholder="Adres" cols="10"
                                  rows="2"></textarea>

                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fa-solid fa-location-dot"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">

                              <div class="input-groupr  input-filer " id="kullanici_resim" name="kullanici_resim">
                                  <span class="input-groupr-btn">
                                      <button class="btn btn-default btn-choose" id="file_button" type="button">Resim
                                          Ekle</button>
                                  </span>
                                  <input type="text" class="form-control" name="deger_resim"
                                      placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
                                  <span class="input-groupr-btn">
                                      <button class="btn btn-warning btn-reset" type="button">Temizle</button>
                                  </span>

                              </div>

                          </div>

                          <div class="icheck-primary">
                              <input type="hidden" id="agreeTerms" value="true" name="terms" value="agree">

                          </div>
                          <div class="modal-footer justify-content-between">

                              <button type="button" class="btn btn-default bg-danger"
                                  data-dismiss="modal">İptal</button>
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Kaydet') }}</button>

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
          function tckimlikkontorolu(tcno) {
              var tckontrol, toplam;
              tckontrol = tcno;
              tcno = tcno.value;
              toplam = Number(tcno.substring(0, 1)) + Number(tcno.substring(1, 2)) +
                  Number(tcno.substring(2, 3)) + Number(tcno.substring(3, 4)) +
                  Number(tcno.substring(4, 5)) + Number(tcno.substring(5, 6)) +
                  Number(tcno.substring(6, 7)) + Number(tcno.substring(7, 8)) +
                  Number(tcno.substring(8, 9)) + Number(tcno.substring(9, 10));
              strtoplam = String(toplam);
              onunbirlerbas = strtoplam.substring(strtoplam.length, strtoplam.length - 1);

              if (onunbirlerbas == tcno.substring(10, 11)) {
                  $('#kullanici_tc').removeClass('is-invalid');
                  $('#kullanici_tc').addClass('is-valid');


              } else {
                  $('#kullanici_tc').removeClass('is-valid');
                  $('#kullanici_tc').addClass('is-invalid');
              }
          }
          $('[data-mask]').inputmask()

          function bs_input_file() {
              $(".input-file").before(
                  function() {
                      if (!$(this).prev().hasClass('input-ghost')) {
                          var element = $(
                              "<input type='file' id='file' class='input-ghost form-control' style='visibility:hidden; height:0'>"
                          );
                          element.attr("name", $(this).attr("name"));
                          element.change(function() {
                              element.next(element).find('input').val((element.val()).split('\\').pop());
                          });
                          $(this).find("button.btn-choose").click(function() {
                              element.click();
                          });
                          $(this).find("button.btn-reset").click(function() {
                              element.val(null);
                              $(this).parents(".input-file").find('input').val('');
                          });
                          $(this).find('input').css("cursor", "pointer");
                          $(this).find('input').mousedown(function() {
                              $(this).parents('.input-file').prev().click();
                              return false;
                          });
                          return element;
                      }
                  }
              );
              $(".input-filer").before(
                  function() {
                      if (!$(this).prev().hasClass('inputr-ghost')) {
                          var element = $(
                              "<input type='file' id='filer' class='inputr-ghost form-control' style='visibility:hidden; height:0'>"
                          );
                          element.attr("name", $(this).attr("name"));
                          element.change(function() {
                              element.next(element).find('input').val((element.val()).split('\\').pop());
                          });
                          $(this).find("button.btn-choose").click(function() {
                              element.click();
                          });
                          $(this).find("button.btn-reset").click(function() {
                              element.val(null);
                              $(this).parents(".input-filer").find('input').val('');
                          });
                          $(this).find('input').css("cursor", "pointer");
                          $(this).find('input').mousedown(function() {
                              $(this).parents('.input-filer').prev().click();
                              return false;
                          });
                          return element;
                      }
                  }
              );
          }
          $(function() {
              bs_input_file();
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
      <script>
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $('#useradd').on("submit", function(e) {

              e.preventDefault();
              var form = $('#useradd')[0];
              var data = new FormData(form);
              data.append("file", document.getElementById('file').files[0]);
              $.ajax({

                  url: '{{ route('register') }}',
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
      <script>
          $('#useredit').on("submit", function(e) {

              e.preventDefault();

              var form = $('#useredit')[0];
              var data = new FormData(form);
              var file_button = $('#file_button');
              /* var my_files = document.getElementById("filer");
              var reader = new FileReader();

              var file_data;
              reader.onload = function() { //veriyi yükle
                  file_data = reader.result;
              }
              formData = new FormData($(this)[0]);
              var veri = [];
              jQuery.each(formdata, function(i, field) {
                  veri[field.name] = field.value;
              }); */
              console.log(data);
              data.append("file", document.getElementById('filer').files[0]);
              // file_button.after('<br><br><hr><br><img src="' + file_data + '" width="350px">');
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
                          title: dat["kullanici_adsoyad"] + '<br>  İşlem Başarılı <br>',
                      })

                      document.getElementById("useredit").reset();
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
                      document.getElementById("useradd").reset();
                  },
              });

          })
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
                              $(`#useredit #${key}`).val(datim[key]);
                          }
                      });
                      console.log('success: ' + dat);

                      $('#useredit #resim').attr('src', datim.ogrenci_resim);
                      $('#useredit #kullanici_id').val(id);
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

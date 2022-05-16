  @extends('layouts.app')

  @section('head')
      {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
      <!-- BS Stepper -->
      <link rel="stylesheet" href="/plugins/bs-stepper/css/bs-stepper.min.css">
      <!-- daterange picker -->
      <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
      <!-- Select2 -->
      <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  @endsection
  @section('content')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">

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

                                  </div>
                              </div>

                              <!-- /.card-header -->
                              <div class="card-body table-container">

                                  {!! $html->table(['class' => 'stripe table table-bordered table-striped']) !!}


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
                      <form method="POST" id="filter" action="{{ route('hafizlik.indexpost') }}">
                          @csrf
                          <div class="form-group">
                              <label>Tarih Aralığı:</label>
                              <div class="input-group col-12">
                                  <button type="button" class="btn btn-default float-right col-12" id="daterange-btn">
                                      <div class="row">
                                          <div class="input-group-prepend col-2">
                                              <span class="input-group-text">
                                                  <i class="far fa-calendar-alt"></i>
                                              </span>
                                          </div>
                                          <input type="text" class="form-control col-8" name="tarihar" value=""
                                              id="tarihar">
                                          <div class="input-group-prepend col-2">
                                              <span class="input-group-text">
                                                  <i class="fas fa-caret-down"></i>
                                              </span>
                                          </div>
                                      </div>
                                  </button>
                              </div>

                              <!-- /.input group -->
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" name="kota" id="kota" value="{{ $veri['kota'] }}"
                                  placeholder="Kota">
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" name="sayfa" id="sayfa"
                                  value="{{ $veri['sayfa'] }}" placeholder="Sayfa">
                          </div>
                          <div class="form-group">
                              <select id="durum" name="durum" class="select2">
                                  <option value="">Hafızlık Tüm Durumlar</option>
                                  <option value="Ham">Ham</option>
                                  <option value="Has">Has</option>
                                  <option value="Hafız">Hafız</option>
                                  <option value="Yüzüne">Yüzüne</option>
                                  <option value="Komisyon">Komisyon</option>
                              </select>

                          </div>
                          <div class="form-group">
                              <select id="birim" name="birim_id" class="select2">
                              </select>

                          </div>
                          <div class="form-group">
                              <select id="hoca" name="hoca_id" class="select2">
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
      <div class="modal fade" id="modalDurum">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title"> <span>Hafızlık Durum Değişikliği</span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="durumEdit" action="">

                          <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Hafızlık Durumu</label>
                              <select class="select2" name="hafizlik_durum" id="hafizlik_durum">
                              </select>
                              <input type="hidden" id="ogrenci_id" name="ogrenci_id">
                              <!-- /.input group -->
                          </div>
                          <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Dönüş Başlama Tarihi</label>

                              <input type="date" class="form-control" name="bast" id="bast" value="" required="">

                          </div>
                          <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Dönüş Süresi</label>

                              <input type="text" class="form-control" name="donus_suresi" id="donus_suresi" value=""
                                  required="">

                          </div>
                          <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Sayfa</label>

                              <input type="text" class="form-control" name="sayfa" id="sayfa" value="" required="">

                          </div>



                          <button type="submit" class="btn btn-outline-primary" onclick="">Kaydet</button>

                      </form>
                  </div>
                  <div class="modal-footer justify-content-between">

                      <ul>
                          <li>Dönüş süresini elle giriniz.</li>
                          <li>Dönüş başlangız tarihini kontol ediniz.</li>
                      </ul>

                  </div>


                  <!-- /.modal-content -->

                  <!-- /.modal-dialog -->
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalDersekle">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title"> </h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="ekleDers" action="">


                          <input type="hidden" class="form-control" name="hafizlik_durum" id="durum">

                          <input type="hidden" id="ogrenci_id" name="ogrenci_id">

                          <div class="row">
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Tarih</label>

                                  <input type="date" class="form-control" name="hafizlik_tarih" id="tarih" value=""
                                      required="">

                              </div>
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Hoca</label>
                                  <select name="hoca_id" class="form-control select2-purple" id="hoca" style="width: 100%;">

                                  </select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-6" id="dersrow">
                                  <label for="recipient-name" class="col-form-label">Sayfa</label>

                                  <select class="select2" name="hafizlik_sayfa" id="sayfas" style="width: 100%;">
                                  </select>
                              </div>
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Cüz</label>

                                  <select class="form-control select2" name="hafizlik_cuz[]" id="cuzs" style="width: 100%;">
                                  </select>
                              </div>
                              <div class="form-group col-4">

                              </div>
                          </div>


                          <div class="row">
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Ders Durumu</label>
                                  <select name="hafizlik_hata" class="select2" id="yanlis" style="width: 100%;">
                                      <option selected>Yanlışsız</option>
                                      <option>1 Yanlış</option>
                                      <option>2 Yanlış</option>
                                  </select>
                              </div>
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Okuma Usulü</label>
                                  <select name="hafizlik_usul" class="select2" id="usul" style="width: 100%;">
                                      <option selected>Hadr</option>
                                      <option>Tedvir</option>
                                      <option>Tahkik</option>
                                  </select>
                              </div>
                          </div>

                          <button type="submit" class="btn btn-outline-primary" onclick="">Kaydet</button>

                      </form>
                  </div>
                  <div class="modal-footer justify-content-between">

                      <ul>
                          <li>Fatiha-Nas Talebelerinde Fatiha-Nas Seçildikten sonra verdiği ilk ve son cüzü giriniz.</li>
                          <li>Talebe Eğer Hizb değil de tam cüz verdiyse Tam cüz seçeneğini seçiniz.</li>
                      </ul>

                  </div>

                  <!-- /.modal-dialog -->
              </div>
          </div>
      </div>
  @endsection
  @section('css')
  @endsection
  @section('js')
  @endsection
  @section('script')
      <script src="/plugins/select2/js/select2.full.min.js"></script>
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


      <!-- date-range-picker -->
      <script src="/plugins/daterangepicker/daterangepicker.js"></script>
      <!-- BS-Stepper -->
      <script src="/plugins/bs-stepper/js/bs-stepper.min.js"></script>
      <script src="/dist/js/tolower.js"></script>
      <!-- Select2 -->

      <script>
          $(document).ready(function() {


              $('#sayfas,#hoca, #yanlis, #usul').select2({
                  theme: 'bootstrap4'
              });
              moment.locale("tr")
              $(document).on("click", ".editDurum", function() {
                  var id = $(this).data('id');
                  var sayfa = $(this).data('sayfa');
                  $.ajax({
                      type: 'post',
                      url: "{{ route('hafizlik.durum') }}",
                      dataType: 'json',
                      data: {
                          id: id
                      },
                      success: function(ogrenciedit) {
                          var dat = JSON.stringify(ogrenciedit);
                          var datim = JSON.parse(dat);

                          $('#hafizlik_durum')
                              .find('option')
                              .remove()
                              .end()

                          if (datim.hafizlik_durum.includes('Has')) {

                              $('#hafizlik_durum').append(
                                  `<option value="Ham" >Ham</option>`
                              );

                              $('#hafizlik_durum').append(
                                  `<option value="${parseInt(datim.hafizlik_durum.split('.')[0])+1}.Has" >${parseInt(datim.hafizlik_durum.split(".")[0])+1}.Has</option>`
                              );
                              $('#hafizlik_durum').append(
                                  `<option value="${datim.hafizlik_durum}" >${datim.hafizlik_durum}</option>`
                              );
                              $('#hafizlik_durum').append(
                                  '<option value="Hafız(1)" >Hafız(1)</option>'
                              );

                          } else if (datim.hafizlik_durum.includes('Ham')) {

                              $('#hafizlik_durum').append(
                                  '<option value="1.Has" >1.Has</option>'
                              );
                              $('#hafizlik_durum').append(
                                  '<option value="Hafız(1)" >Hafız(1)</option>'
                              );
                              $('#hafizlik_durum').append(
                                  `<option value="Ham" >Ham</option>`
                              );
                          } else if (datim.hafizlik_durum.includes('Hafız')) {

                              $('#hafizlik_durum').append(
                                  '<option value="' + 'Hafız(' + (parseInt(datim
                                          .hafizlik_durum.split(
                                              /[()]/)[1]) +
                                      1) +
                                  ')" >' + 'Hafız(' + (parseInt(datim.hafizlik_durum.split(
                                          /[()]/)[1]) +
                                      1) +
                                  ')</option>'
                              );
                              $('#hafizlik_durum').append(
                                  `<option value="${datim.hafizlik_durum}" >${datim.hafizlik_durum}</option>`
                              );
                          } else if (datim.hafizlik_durum.includes('Yüzüne')) {

                              $('#hafizlik_durum').append(
                                  `<option value="Ham" >Ham</option>`
                              );
                              $('#hafizlik_durum').append(
                                  `<option value="Komisyon" >Komisyon</option>`
                              );
                              $('#hafizlik_durum').append(
                                  `<option value="Yüzüne" >Yüzüne</option>`
                              );
                          }
                          $('#modalDurum .modal-title').text(datim.ogrenci_adsoyad + ' ' +
                              datim.ogrenci_id);
                          Object.keys(datim).forEach(function(key) {
                              // var value = jsonData[key];
                              if ($('#' + key).length) {
                                  $(`#durumEdit #${key}`).val(datim[key]);
                              }
                          });

                          $('#durumEdit #sayfa').val(`${datim.hafizlik_son.split('/')[0]}`);


                      },
                      error: function(ogrenciedit) {
                          var dat = JSON.stringify(ogrenciedit);
                          var datim = JSON.parse(dat);


                          console.log('error: ' + dat);
                      },

                  });

                  $("#hafizlik_durum").val(datim.hafizlik_durum);

              });
              //Date range as a button
              $('#daterange-btn').daterangepicker({
                      ranges: {
                          'Bugün': [moment(), moment()],
                          'Dün': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                          'Son 7 gün': [moment().subtract(6, 'days'), moment()],
                          'Son 30 gün': [moment().subtract(29, 'days'), moment()],
                          'Bu Ay': [moment().startOf('month'), moment().endOf('month')],
                          'Geçen Ay': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                              'month').endOf('month')]
                      },
                      startDate: moment().subtract(29, 'days'),
                      endDate: moment(),
                      "locale": {
                          "format": "DD/MM/YYYY",
                          "separator": " - ",
                          "applyLabel": "Uygula",
                          "cancelLabel": "Vazgeç",
                          "fromLabel": "Dan",
                          "toLabel": "a",
                          "customRangeLabel": "Seç",
                          "daysOfWeek": [
                              "Pt",
                              "Sl",
                              "Çr",
                              "Pr",
                              "Cm",
                              "Ct",
                              "Pz"
                          ],
                          "monthNames": [
                              "Ocak",
                              "Şubat",
                              "Mart",
                              "Nisan",
                              "Mayıs",
                              "Haziran",
                              "Temmuz",
                              "Ağustos",
                              "Eylül",
                              "Ekim",
                              "Kasım",
                              "Aralık"
                          ],
                          "firstDay": 1
                      },
                  },


                  function(start, end) {

                      $('#tarihar').val(start.format('YYYY/MM/DD') + ' - ' + end.format(
                          'YYYY/MM/DD'))
                  }
              )



          });
      </script>
      <script>
          $(document).on("click", ".ekleDers", function() {
              var id = $(this).data('id');



              $.ajax({
                  type: 'post',
                  url: "{{ route('hafizlik.ders') }}",
                  dataType: 'json',
                  data: {
                      id: id
                  },
                  success: function(ogrenciedit) {
                      var dat = JSON.stringify(ogrenciedit);
                      var datim = JSON.parse(dat);

                      if (datim.durum.includes('Hafız')) {
                          /*    $(" select").attr("multiple"); */
                          $('#ekleDers #cuzs').append(new Option('Fatiha-Nas', 'FN'));
                          $('#ekleDers #cuzs').prop('multiple', true);
                          $('#ekleDers #dersrow').html(

                              `  <label for = 'recipient-name' class = 'col-form-label' > Hizb </label>
                                <select class="select2" name = 'hafizlik_hizb[]' id = 'hizb' multiple="multiple" data-placeholder="Ders Seçimi" style="width: 100%;">
                                    <option value="0" selected>Tam cüz</option>
                                    <option value="1.Hizb">1.Hizb</option>
                  <option value="2.Hizb">2.Hizb</option>
                  <option value="3.Hizb">3.Hizb</option>
                  <option value="4.Hizb">4.Hizb</option>


                              </select>

                              `
                          )

                          $('#hizb').select2({
                              theme: 'bootstrap4'
                          });
                          $('#cuzs').select2({
                              theme: 'bootstrap4'
                          });

                      }
                      var s = 20;
                      var c = 30;
                      for (let index = 0; index < s; index++) {

                          $('#ekleDers #sayfas').append(new Option(index + 1, index + 1));
                      }
                      for (let index = 0; index < c; index++) {

                          $('#ekleDers #cuzs').append(new Option(index + 1, index + 1));
                      }

                      hocagetir('#ekleDers #hoca', datim.hoca);

                      $('#modalDersekle .modal-title').text(datim.adsoyad + ' - ' + datim.sayfa + '/' +
                          datim.cuz + ' - ' +
                          'Ders Ekle');
                      Object.keys(datim).forEach(function(key) {
                          // var value = jsonData[key];
                          if ($('#' + key).length) {
                              $(`#ekleDers #${key}`).val(datim[key]);
                          }
                      });
                      var today = moment().format('YYYY-MM-DD');
                      $('#tarih').val(today);
                      if (datim.cuz == 30 && !datim.hafizlik_durum.includes('Hafız')) {
                          $(`#ekleDers #sayfas`).val(parseInt(datim.sayfa) + 1);
                          $(`#ekleDers #cuzs`).val(1);

                      } else {
                          $(`#ekleDers #sayfas`).val(datim.sayfa);
                          $(`#ekleDers #cuzs`).val(parseInt(
                              datim.cuz) + 1);
                      }



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
                  /*
                                $('#example1')
                                    .search(
                                        jQuery.fn.dataTable.ext.type.search.string(NeutralizeAccent(this.value))
                                    )
                                    .draw() */
              });
          });



          hocagetir('#filter #hoca', {{ $veri['hoca'] }});
          birimgetir('#filter #birim', {{ $veri['birim'] }});


          function hocagetir(id, veri) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: 'post',
                  url: "{{ route('hafizlik.hocagetir') }}",
                  data: {
                      get_option: true
                  },
                  success: function(response) {

                      $(id).html(response);

                      $(id).val(veri);
                  }

              });

          }



          function birimgetir(id, veri) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: 'post',
                  url: "{{ route('hafizlik.birimgetir') }}",
                  data: {
                      get_option: true
                  },
                  success: function(response) {
                      $(id).html(response);

                      $(id).val(veri);
                  }

              });

          }
      </script>
      <script>
          //hafizlik durum güncelleme
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#durumEdit').on("submit", function(e) {

              e.preventDefault();
              var form = $('#durumEdit')[0];
              var data = new FormData(form);

              $.ajax({

                  url: "{{ route('hafizlik.durumguncel') }}",
                  type: 'POST',
                  contentType: false,
                  cache: false,
                  processData: false,
                  data: data,
                  dataType: 'text',


                  success: (datam) => {
                      var dat = JSON.parse(datam);
                      $("#example1").DataTable().ajax.reload();

                      $('#modalDurum').modal('hide');
                      console.log(datam);
                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 3000
                      });
                      Toast.fire({
                          icon: 'success',
                          title: dat["ogrenci_adsoyad"] + '<br>  İşlem Başarılı <br>',
                      })

                      document.getElementById("durumEdit").reset();
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
                      document.getElementById("durumEdit").reset();
                  },
              });
              $("#durum option[value={{ $veri['durum'] }}]").attr("selected", "selected");
          })
      </script>
      <script>
          $('#ekleDers').on("submit", function(e) {

              e.preventDefault();
              var form = $('#ekleDers')[0];
              var data = new FormData(form);

              $.ajax({

                  url: "{{ route('hafizlik.dersekle') }}",
                  type: 'POST',
                  contentType: false,
                  cache: false,
                  processData: false,
                  data: data,
                  dataType: 'text',


                  success: (datam) => {
                      var dat = JSON.parse(datam);
                      $("#example1").DataTable().ajax.reload();

                      $('#modalDersekle').modal('hide');
                      console.log(datam);
                      var Toast = Swal.mixin({
                          toast: true,
                          position: 'top',
                          showConfirmButton: false,
                          timer: 3000
                      });
                      Toast.fire({
                          icon: 'success',
                          title: dat["ogrenci_adsoyad"] + '<br>  İşlem Başarılı <br>',
                      })

                      document.getElementById("durumEdit").reset();
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
                      document.getElementById("durumEdit").reset();
                  },
              });
              $("#durum option[value={{ $veri['durum'] }}]").attr("selected", "selected");
          })
      </script>
  @endsection

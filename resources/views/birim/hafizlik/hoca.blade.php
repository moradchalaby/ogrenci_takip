  @extends('layouts.app')

  @section('head')
      {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
      <!-- BS Stepper -->
      <link rel="stylesheet" href="/plugins/bs-stepper/css/bs-stepper.min.css">
      <!-- daterange picker -->
      <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
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
                      <form method="POST" id="filter"
                          action="{{ route('hocabirimhafizlik.indexpost', $veri['birim']) }}">
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
                              <label>Birim:</label>
                              <select id="birim" name="birim_id" class="form-control select2" style="width: 100%;">
                              </select>

                          </div>
                          <div class="form-group">
                              <label>Hoca:</label>
                              <select id="hoca" name="hoca_id" class="form-control select2" style="width: 100%;">
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

                              <input type="date" class="form-control" name="bast" id="bast" value=""
                                  required="">

                          </div>
                          <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Dönüş Süresi</label>

                              <input type="text" class="form-control" name="donus_suresi" id="donus_suresi"
                                  value="" required="">

                          </div>
                          <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Sayfa</label>

                              <input type="text" class="form-control" name="sayfa" id="sayfa" value=""
                                  required="">

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
      <div class="modal fade" id="modalHoca">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title"> <span>Hoca Değişikliği</span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="hocaEdit" action="">

                          <div class="form-group">
                              <input type="hidden" id="ogrenci_id" name="ogrenci_id">
                              <label for="recipient-name" class="col-form-label">Hoca</label>
                              <select name="birimHoca_id" id="birimHoca" class="form-control select2"
                                  style="width: 100%;">

                              </select>

                          </div>



                          <button type="submit" class="btn btn-outline-primary" onclick="">Kaydet</button>

                      </form>
                  </div>
                  <div class="modal-footer justify-content-between">

                      <ul>
                          <li>Öğrencinin zimmetli olduğu hoca seçilir.</li>

                      </ul>

                  </div>


                  <!-- /.modal-content -->

                  <!-- /.modal-dialog -->
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalDersduzenle">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title"> </h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="duzenleDers" action="">
                          @csrf

                          <input type="hidden" class="form-control" name="hafizlik_durum" id="durum">

                          <input type="hidden" id="ogrenci_id" name="ogrenci_id">
                          <input type="hidden" id="ders_id" name="ders_id">

                          <div class="row">
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Tarih</label>

                                  <input type="date" class="form-control" name="hafizlik_tarih" id="tarih"
                                      value="" required="">

                              </div>
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Hoca</label>
                                  <select name="hoca_id" id="hoca" class="form-control select2"
                                      style="width: 100%;">

                                  </select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-6" id="dersrow">

                              </div>
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Cüz</label>

                                  <select class="form-control select2" name="hafizlik_cuz[]" id="cuzs"
                                      multiple="multiple" style="width: 100%;">
                                  </select>
                              </div>
                              <div class="form-group col-4">

                              </div>
                          </div>


                          <div class="row">
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Ders Durumu</label>
                                  <select name="hafizlik_hata" class="form-control select2" id="yanlis"
                                      style="width: 100%;">
                                      <option selected>Yanlışsız</option>
                                      <option>1 Yanlış</option>
                                      <option>2 Yanlış</option>
                                  </select>
                              </div>
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Okuma Usulü</label>
                                  <select name="hafizlik_usul" class="form-control select2" id="usul"
                                      style="width: 100%;">
                                      <option selected>Hadr</option>
                                      <option>Tedvir</option>
                                      <option>Tahkik</option>
                                  </select>
                              </div>
                          </div>


                          <div class="custom-control custom-checkbox">

                              <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                  id="customCheckbox4" name="sil">
                              <label for="customCheckbox4" class="custom-control-label">Dersi Sil</label>
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
                          @csrf

                          <input type="hidden" class="form-control" name="hafizlik_durum" id="durum">

                          <input type="hidden" id="ogrenci_id" name="ogrenci_id">

                          <div class="row">
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Tarih</label>

                                  <input type="date" class="form-control" name="hafizlik_tarih" id="tarih"
                                      value="" required="">

                              </div>
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Hoca</label>
                                  <select name="hoca_id" id="hoca" class="form-control select2"
                                      style="width: 100%;">

                                  </select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-6" id="dersrow">

                              </div>
                              <div class="form-group col-6">
                                  <label for="recipient-name" class="col-form-label">Cüz</label>

                                  <select class="form-control select2" name="hafizlik_cuz[]" id="cuzs"
                                      multiple="multiple" style="width: 100%;">
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
      {{-- hafizlik durum Edit baş --}}
      <script>
          $(document).ready(function() {
              moment.locale("tr")
              //!hafizlik durum Edit
              $(document).on("click", ".editDurum", function() {
                  var id = $(this).data('id');
                  var sayfa = $(this).data('sayfa');
                  $.ajax({
                      type: 'post',
                      beforeSend: function(xhr) {
                          document.getElementById("modalDurum").style.filter = "blur(10px)";
                      },
                      url: "{{ route('hafizlik.durum') }}",
                      dataType: 'json',
                      data: {
                          id: id
                      },
                      success: function(ogrenciedit) {
                          var dat = JSON.stringify(ogrenciedit);
                          var datim = JSON.parse(dat);
                          console.log(dat);
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
                          } else {
                              $('#hafizlik_durum').append(
                                  `<option value="Ham" >Ham</option>`
                              );
                              $('#hafizlik_durum').append(
                                  `<option value="Komisyon" >Komisyon</option>`
                              );
                              $('#hafizlik_durum').append(
                                  `<option value="Yüzüne" >Yüzüne</option>`
                              );
                              $('#hafizlik_durum').append(
                                  '<option value="1.Has" >1.Has</option>'
                              );
                              $('#hafizlik_durum').append(
                                  '<option value="Hafız(1)" >Hafız(1)</option>'
                              );

                          }
                          $('#modalDurum .modal-title').text(datim.ogrenci_adsoyad + ' ' +
                              datim.ogrenci_id);
                          Object.keys(datim).forEach(function(key) {

                              if ($('#' + key).length) {
                                  $(`#durumEdit #${key}`).val(datim[key]);
                              }
                          });

                          $('#durumEdit #sayfa').val(`${datim?.hafizlik_son?.split('/')[0]}`);

                          $("#hafizlik_durum").val(datim.hafizlik_durum);
                      },
                      error: function(ogrenciedit) {
                          var dat = JSON.stringify(ogrenciedit);
                          var datim = JSON.parse(dat);


                          console.log('error: ' + dat);
                      },

                  }).done(function(data) {
                      document.getElementById("modalDurum").style.filter = "blur(0px)";

                  });



              });
          });
      </script>
      {{-- hafizlik durum Edit bitiş --}}
      {{-- Hoca değiş Edit baş --}}
      <script>
          $(document).ready(function() {
              moment.locale("tr")
              //!hafizlik durum Edit
              $(document).on("click", ".editHoca", function() {
                  var birim_id = $(this).data('birim');
                  var ogrenci_id = $(this).data('ogrenci');
                  var id = $(this).data('id');
                  console.log(ogrenci_id);
                  $("#hocaEdit #ogrenci_id").val(ogrenci_id);
                  birimhocagetir('#hocaEdit #birimHoca', id, birim_id);



              });
          });
      </script>
      {{-- Hoca değiş Edit bitiş --}}
      {{-- daterange baş --}}
      <script>
          $(document).ready(function() {
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
                      startDate: moment(),
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
      {{-- daterange bitiş --}}
      {{-- ekleders modal baş --}}
      <script>
          $(document).on("click", ".ekleDers", function() {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              var id = $(this).data('id');

              console.log(id);


              $.ajax({
                  type: 'post',
                  beforeSend: function(xhr) {
                      document.getElementById("modalDersekle").style.filter = "blur(10px)";
                  },

                  url: "{{ route('hafizlik.ders') }}",

                  dataType: 'json',
                  data: {
                      ogrenci_id: id

                  },
                  success: function(ogrenciedit) {
                      var dat = JSON.stringify(ogrenciedit);
                      var datim = JSON.parse(dat);
                      console.log(datim)
                      $("#ekleDers #cuzs").empty().trigger('change');


                      $('#ekleDers #cuzs').select2({
                          theme: 'bootstrap4'
                      });


                      if (datim?.durum?.includes('Hafız')) {

                          $('#ekleDers #cuzs').append(new Option('Fatiha-Nas', 'FN'));

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
                          $('#modalDersekle .modal-footer').html(`
                         <ul>
                          <li>Fatiha-Nas Talebelerinde Fatiha-Nas Seçildikten sonra verdiği ilk ve son cüzü giriniz.</li>
                          <li>Talebe Eğer Hizb değil de tam cüz verdiyse Tam cüz seçeneğini seçiniz.</li>
                      </ul>

                            `)
                          $('#ekleDers #hizb').select2({
                              theme: 'bootstrap4'
                          });


                      } else {
                          $('#ekleDers #dersrow').html(

                              ` <label for="recipient-name" class="col-form-label">Tur</label>

                                  <select class="select2" name="hafizlik_sayfa" id="sayfas" style="width: 100%;">
                                  </select>

                              `
                          )
                          $('#modalDersekle .modal-footer').html(`
                             <ul>
                          <li>Birden fazla ders verildiği takdirde çoklu cüz seçimi yapılabilir.</li>

                      </ul>

                            `)
                          $('#ekleDers #sayfas').select2({
                              theme: 'bootstrap4'
                          });

                      }
                      var s = 20;
                      var c = 30;
                      for (let index = 0; index < s; index++) {

                          $('#ekleDers #sayfas').append(new Option(index + 1, index + 1));
                      }


                      hocagetir('#ekleDers #hoca', datim.hoca);

                      $('#modalDersekle .modal-title').text(datim.adsoyad + ' - ' + datim.sayfa + '/' +
                          datim.cuz + ' - ' +
                          'Ders Ekle');
                      Object.keys(datim).forEach(function(key) {

                          if ($('#' + key).length) {
                              $(`#ekleDers #${key}`).val(datim[key]);
                          }
                      });
                      var today = moment().format('YYYY-MM-DD');
                      $('#ekleDers #tarih').val(today);


                      for (let index = 0; index < c; index++) {

                          $('#ekleDers #cuzs').append(new Option(index + 1, index + 1));
                      }

                      if (datim?.sonders?.includes('-') && !datim?.sonders?.includes('FN')) {

                          if (datim.sonders.substr(-1) == "4") {
                              $(`#ekleDers #sayfas`).val(
                                  '1.Hizb');
                              $('#ekleDers #cuzs').val(parseInt(
                                  datim.cuz) + 1).trigger('change');
                          } else {
                              console.log((parseInt(datim.sonders.substr(-1)) + 1) +
                                  '.Hizb')
                              $(`#ekleDers #sayfas`).val((parseInt(datim.sonders.substr(-1)) + 1) +
                                  '.Hizb').trigger('change');
                              $('#ekleDers #cuzs').val(parseInt(
                                  datim.cuz)).trigger('change');
                          }

                      } else if (datim?.sonders?.includes('-') && datim?.sonders?.includes('FN')) {
                          if (datim.sonders.substr(-1) == "30") {

                              $('#ekleDers #cuzs').val(['1']).trigger('change');
                          } else {

                              $('#ekleDers #cuzs').val(['FN', (parseInt(datim.sonders.substr(-1)) + 1)])
                                  .trigger('change');
                          }
                      } else if (datim.cuz == 30 && !datim.durum.includes('Hafız')) {
                          $(`#ekleDers #sayfas`).val(parseInt(datim.sayfa) + 1);
                          $(`#ekleDers #cuzs`).val(1);

                      } else {
                          $(`#ekleDers #sayfas`).val(datim.sayfa);

                          $('#ekleDers #cuzs').val(parseInt(
                              datim.cuz) + 1).trigger('change');

                      }




                  },
                  error: function(ogrenciedit) {
                      var dat = JSON.stringify(ogrenciedit);
                      var datim = JSON.parse(dat);


                      console.log('error: ' + dat);
                  },
              }).done(function(data) {
                  document.getElementById("modalDersekle").style.filter = "blur(0px)";
              });
          });
      </script>
      {{-- ekleders modal bitiş --}}
      {{-- duzenleders modal baş --}}
      <script>
          $(document).on("click", ".duzenleDers", function() {
              var id = $(this).data('dersid');

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });


              $.ajax({
                  type: 'post',
                  beforeSend: function(xhr) {
                      document.getElementById("modalDersduzenle").style.filter = "blur(10px)";
                  },
                  url: "{{ route('hafizlik.ders') }}",
                  dataType: 'json',
                  data: {
                      ders_id: id
                  },
                  success: function(ogrenciedit) {
                      var dat = JSON.stringify(ogrenciedit);
                      var datim = JSON.parse(dat);
                      console.log(datim)
                      $("#duzenleDers #cuzs").empty().trigger('change');



                      $('#duzenleDers #cuzs').select2({
                          theme: 'bootstrap4'
                      });


                      if (datim.durum.includes('Hafız')) {

                          $('#duzenleDers #cuzs').append(new Option('Fatiha-Nas', 'FN'));

                          $('#duzenleDers #dersrow').html(

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
                          $('#modalDersduzenle .modal-footer').html(`
                         <ul>
                          <li>Fatiha-Nas Talebelerinde Fatiha-Nas Seçildikten sonra verdiği ilk ve son cüzü giriniz.</li>
                          <li>Talebe Eğer Hizb değil de tam cüz verdiyse Tam cüz seçeneğini seçiniz.</li>
                      </ul>

                            `)
                          $('#duzenleDers #hizb').select2({
                              theme: 'bootstrap4'
                          });


                      } else {
                          $('#duzenleDers #dersrow').html(

                              ` <label for="recipient-name" class="col-form-label">Tur</label>

                                  <select class="select2" name="hafizlik_sayfa" id="sayfas" style="width: 100%;">
                                  </select>

                              `
                          )
                          $('#modalDersduzenle .modal-footer').html(`
                             <ul>
                          <li>Birden fazla ders verildiği takdirde çoklu cüz seçimi yapılabilir.</li>

                      </ul>

                            `)
                          $('#duzenleDers #sayfas').select2({
                              theme: 'bootstrap4'
                          });

                      }
                      var s = 20;
                      var c = 30;
                      for (let index = 0; index < s; index++) {

                          $('#duzenleDers #sayfas').append(new Option(index + 1, index + 1));
                      }


                      hocagetir('#duzenleDers #hoca', datim.hoca);

                      $('#modalDersduzenle .modal-title').text(datim.adsoyad + ' - ' + datim.sayfa + '/' +
                          datim.cuz + ' - ' +
                          'Ders duzenle');
                      Object.keys(datim).forEach(function(key) {
                          console.log(datim[key])
                          if ($('#' + key).length) {
                              $(`#duzenleDers #${key}`).val(datim[key]);
                          }
                      });
                      var today = moment().format('YYYY-MM-DD');
                      $('#duzenleDers #tarih').val(datim.tarih);


                      for (let index = 0; index < c; index++) {

                          $('#duzenleDers #cuzs').append(new Option(index + 1, index + 1));
                      }
                      if (datim.cuz == 30 && !datim.durum.includes('Hafız')) {
                          $(`#duzenleDers #sayfas`).val(parseInt(datim.sayfa));
                          $(`#duzenleDers #cuzs`).val(datim.cuz.split(","));

                      } else {
                          $(`#duzenleDers #sayfas`).val(datim.sayfa);

                          $('#duzenleDers #cuzs').val(
                              datim.cuz.split(",")).trigger('change');

                      }



                  },
                  error: function(ogrenciedit) {
                      var dat = JSON.stringify(ogrenciedit);
                      var datim = JSON.parse(dat);


                      console.log('error: ' + dat);
                  },
              }).done(function(data) {
                  document.getElementById("modalDersduzenle").style.filter = "blur(0px)";
              });;
          });
      </script>
      {{-- duzenleders modal bitiş --}}
      {{-- datatble config baş --}}
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
      {{-- hoca ve birim verş baş --}}
      <script>
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
                      console.log(response);
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
                  beforeSend: function(xhr) {
                      document.getElementById("modalDersekle").style.filter = "blur(10px)";
                  },
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

          function birimhocagetir(id, veri, birim_id) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: 'post',
                  beforeSend: function(xhr) {
                      document.getElementById("modalDersekle").style.filter = "blur(10px)";
                  },
                  url: "{{ route('hafizlik.birimhoca') }}",
                  data: {
                      get_option: true,
                      birim_id: birim_id
                  },
                  success: function(response) {
                      $(id).html(response);

                      $(id).val(veri);
                  }

              });

          }
      </script>
      {{-- hoca ve birim verş bitiş --}}
      {{-- hafizlik durum submit baş --}}
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
                  type: 'post',

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
          })
      </script>
      {{-- hafizlik durum submit bitiş --}}
      {{-- Hoca  submit baş --}}
      <script>
          //Hoca  güncelleme
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#hocaEdit').on("submit", function(e) {

              e.preventDefault();
              var form = $('#hocaEdit')[0];
              var data = new FormData(form);

              $.ajax({

                  url: "{{ route('hafizlik.hocaguncel') }}",
                  type: 'post',

                  contentType: false,
                  cache: false,
                  processData: false,
                  data: data,
                  dataType: 'text',


                  success: (datam) => {
                      var dat = JSON.parse(datam);
                      $("#example1").DataTable().ajax.reload();

                      $('#modalHoca').modal('hide');
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

                      document.getElementById("hocaEdit").reset();
                  },
                  error: function(data) {
                      var dat = JSON.parse(data);
                      $('#modalHoca').modal('hide');


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
                      document.getElementById("hocaEdit").reset();
                  },
              });
          })
      </script>
      {{-- Hoca submit bitiş --}}
      {{-- ders ekle submit baş --}}
      <script>
          $('#ekleDers').on("submit", function(e) {

              e.preventDefault();
              var form = $('#ekleDers')[0];
              var data = new FormData(form);
              console.log(form);
              $.ajax({

                  url: "{{ route('hafizlik.dersekle') }}",
                  type: 'post',

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
          })
          $('.select2').select2({
              theme: 'bootstrap4',

          });
      </script>
      {{-- ders ekle submit bitiş --}}
      {{-- ders ekle submit baş --}}
      <script>
          $('#duzenleDers').on("submit", function(e) {

              e.preventDefault();
              var form = $('#duzenleDers')[0];
              var data = new FormData(form);

              $.ajax({

                  url: "{{ route('hafizlik.dersguncelle') }}",
                  type: 'post',

                  contentType: false,
                  cache: false,
                  processData: false,
                  data: data,
                  dataType: 'text',


                  success: (datam) => {
                      var dat = JSON.parse(datam);
                      $("#example1").DataTable().ajax.reload();

                      $('#modalDersduzenle').modal('hide');
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

                      //document.getElementById("durumEdit").reset();
                  },
                  error: function(data) {
                      var dat = JSON.parse(data);
                      $('#modalDersduzenle').modal('hide');


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
                      // document.getElementById("durumEdit").reset();
                  },
              });
          })
      </script>
      {{-- ders ekle submit bitiş --}}
  @endsection

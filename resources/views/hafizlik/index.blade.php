  @extends('layouts.app')

  @section('head')
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

                                  </div>
                              </div>

                              <!-- /.card-header -->
                              <div class="card-body table-container">

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
                      <form method="POST" id="useredit" action="{{ route('hafizlik.indexpost') }}">
                          @csrf
                          <div class="form-group">
                              <label>Tarih Aralığı:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">
                                          <i class="far fa-calendar-alt"></i>
                                      </span>
                                  </div>
                                  <input type="text" class="form-control float-right" name="tarihar" id="reservation">
                              </div>
                              <!-- /.input group -->
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" name="ogrenci_adsoyad" id="ogrenci_adsoyad"
                                  placeholder="Adı Soyadı">
                              <input type="hidden" name="id" id="ogrenci_id">
                          </div>
                          <div class="form-group">
                              <input type="date" class="form-control" name="ogrenci_dt" id="ogrenci_dt"
                                  placeholder="Doğum Tarihi">
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" name="ogrenci_tc" id="ogrenci_tc"
                                  placeholder="TC No" onblur="tckimlikkontorolu(this);" maxlength="11">

                          </div>

                          <div class="form-group">
                              <input type="text" class="form-control" name="ogrenci_tel" id="ogrenci_tel"
                                  placeholder="Tel No" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" name="ogrenci_sehir" id="ogrenci_sehir"
                                  placeholder="Şehir">
                          </div>
                          <div class="form-group">
                              <textarea class="form-control" name="ogrenci_adres" id="ogrenci_adres" placeholder="Adres" cols="10"
                                  rows="2"></textarea>

                          </div>

                          <button type="submit" class="btn btn-outline-info" onclick="">Filtrele</button>

                      </form>
                  </div>
                  <div class="modal-footer justify-content-between">


                      modal footer




                  </div>


                  <!-- /.modal-content -->

                  <!-- /.modal-dialog -->
              </div>
          </div>
      </div>
      <!-- /.modal -->

      {{-- }} <div class="modal fade" id="modalEdit">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Yeni {!! $veri['name'] !!} Düzenle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="col-md-12">
                          <div class="bs-stepper bs-stepper2">
                              <div class="bs-stepper-header inline-block" role="tablist">
                                  <!-- your steps here -->
                                  <div class="step" data-target="#genel-part">
                                      <button type="button" class="step-trigger" role="tab" aria-controls="genel-part"
                                          id="genel-part-trigger">
                                          <span class="bs-stepper-circle bg-info">1</span>
                                          <span class="bs-stepper-label">Öğrenci</span>
                                      </button>
                                  </div>
                                  <div class="line"></div>
                                  <div class="step" data-target="#iletisim-part">
                                      <button type="button" class="step-trigger" role="tab" aria-controls="iletisim-part"
                                          id="iletisim-part-trigger">
                                          <span class="bs-stepper-circle bg-info">2</span>
                                          <span class="bs-stepper-label">Veli</span>
                                      </button>
                                  </div>
                                  <div class="line"></div>
                                  <div class="step" data-target="#veli-part">
                                      <button type="button" class="step-trigger" role="tab" aria-controls="veli-part"
                                          id="veli-part-trigger">
                                          <span class="bs-stepper-circle bg-info">3</span>
                                          <span class="bs-stepper-label">Eğitim</span>
                                      </button>
                                  </div>
                                  <br>
                                  <div class="line"></div>
                                  <div class="step" data-target="#egitim-part">
                                      <button type="button" class="step-trigger" role="tab" aria-controls="egitim-part"
                                          id="egitim-part-trigger">
                                          <span class="bs-stepper-circle bg-info">4</span>
                                          <span class="bs-stepper-label">Belgeler</span>
                                      </button>
                                  </div>


                              </div>
                              <div class="bs-stepper-content">
                                  <!-- your steps content here -->
                                  <form method="POST" id="useredit" action="#">

                                      <div id="genel-part" class="content" role="tabpanel"
                                          aria-labelledby="genel-part-trigger">
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="ogrenci_adsoyad"
                                                  id="ogrenci_adsoyad" placeholder="Adı Soyadı">
                                              <input type="hidden" name="id" id="ogrenci_id">
                                          </div>
                                          <div class="form-group">
                                              <input type="date" class="form-control" name="ogrenci_dt" id="ogrenci_dt"
                                                  placeholder="Doğum Tarihi">
                                          </div>
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="ogrenci_tc" id="ogrenci_tc"
                                                  placeholder="TC No" onblur="tckimlikkontorolu(this);" maxlength="11">

                                          </div>

                                          <div class="form-group">
                                              <input type="text" class="form-control" name="ogrenci_tel" id="ogrenci_tel"
                                                  placeholder="Tel No" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                          </div>
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="ogrenci_sehir"
                                                  id="ogrenci_sehir" placeholder="Şehir">
                                          </div>
                                          <div class="form-group">
                                              <textarea class="form-control" name="ogrenci_adres" id="ogrenci_adres" placeholder="Adres" cols="10"
                                                  rows="2"></textarea>

                                          </div>

                                          <button type="button" class="btn btn-outline-info"
                                              onclick="stepper2.next()">Sonraki</button>
                                      </div>
                                      <div id="iletisim-part" class="content" role="tabpanel"
                                          aria-labelledby="iletisim-part-trigger">
                                          <div class="form-group row">
                                              <input type="text" class="form-control col" name="babaad" id="babaad"
                                                  placeholder="Baba Adı">

                                              <input type="text" class="form-control col" name="babatel" id="babatel"
                                                  placeholder="Baba Tel No" data-inputmask='"mask": "(999) 999-9999"'
                                                  data-mask>
                                          </div>
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="babames" id="babames"
                                                  placeholder="Baba Meslek">
                                          </div>
                                          <div class="form-group row">
                                              <input type="text" class="form-control col" name="annead" id="annead"
                                                  placeholder="Anne Adı">
                                              <input type="text" class="form-control col" name="annetel" id="annetel"
                                                  placeholder="Anne Tel No">
                                          </div>
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="annemes" id="annemes"
                                                  placeholder="Anne Meslek">
                                          </div>
                                          <div class="form-group row">
                                              <select id="ogrenci_yetim" name="yetimdurum" class="form-control col">
                                                  <option value="">Yetim veya Öksüz mü?</option>
                                                  <option value="0">Hayır</option>
                                                  <option value="1">Evet</option>

                                              </select>
                                              <select id="ogrenci_bosanma" name="bosanma" class="form-control col">
                                                  <option value="">Anne Baba Ayrı mı?</option>
                                                  <option value="0">Hayır</option>
                                                  <option value="1">Evet</option>

                                              </select>

                                          </div>
                                          <button type="button" class="btn btn-outline-info"
                                              onclick="stepper2.previous()">Önceki</button>
                                          <button type="button" class="btn btn-outline-info"
                                              onclick="stepper2.next()">Sonraki</button>

                                      </div>
                                      <div id="veli-part" class="content" role="tabpanel"
                                          aria-labelledby="veli-part-trigger">
                                          <div class="form-group">
                                              <select id="birime" name="birim_id" class="form-control">
                                              </select>

                                          </div>
                                          <div class="form-group">
                                              <select id="okuldurum" name="okuldurum" class="form-control">
                                                  <option value="">Okul Durumunu Seçiniz</option>
                                                  <option value="1">Orta Okul</option>
                                                  <option value="2">Örgün Lise</option>
                                                  <option value="3">Açık Lise</option>
                                                  <option value="4">Üniversite</option>
                                              </select>

                                          </div>
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="basaripuan" id="basaripuan"
                                                  placeholder="Başarı Puanı">
                                          </div>
                                          <div class="form-group">
                                              <textarea class="form-control" name="ogrenci_aciklama" id="ogrenci_aciklama" placeholder="Özel Durum" cols="10"
                                                  rows="2"></textarea>

                                          </div>
                                          <button type="button" class="btn btn-outline-info"
                                              onclick="stepper2.previous()">Önceki</button>
                                          <button type="button" class="btn btn-outline-info"
                                              onclick="stepper2.next()">Sonraki</button>

                                      </div>

                                      <div id="egitim-part" class="content" role="tabpanel"
                                          aria-labelledby="egitim-part-trigger">
                                          <div class="form-group">
                                              <img id="resim" src="" alt="">
                                          </div>
                                          <div class="form-group">

                                              <div class="input-groupr  input-filer " id="ogrenci_resim"
                                                  name="ogrenci_resim">
                                                  <span class="input-groupr-btn">
                                                      <button class="btn btn-default btn-choose" id="file_button"
                                                          type="button">Resim
                                                          Ekle</button>
                                                  </span>
                                                  <input type="text" class="form-control" name="deger_resim"
                                                      placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
                                                  <span class="input-groupr-btn">
                                                      <button class="btn btn-warning btn-reset"
                                                          type="button">Temizle</button>
                                                  </span>

                                              </div>
                                              <br>
                                              <button type="button" class="btn btn-outline-info"
                                                  onclick="stepper2.previous()">Önceki</button>
                                              <button type="submit" class="btn btn-success">Kaydet</button>
                                          </div>




                                      </div>
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
          </div>
      </div> --}}
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
      <script src="/plugins/moment/moment.js"></script>

      <!-- date-range-picker -->
      <script src="/plugins/daterangepicker/daterangepicker.js"></script>
      <!-- BS-Stepper -->
      <script src="/plugins/bs-stepper/js/bs-stepper.min.js"></script>
      <script src="/dist/js/tolower.js"></script>
      <script>
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({
              timePicker: true,
              timePickerIncrement: 30,
              locale: {
                  format: 'YYYY-MM-DD hh:mm A'
              },
              function(start, end) {
                  // $('#dateRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                  //$(document).trigger('myCustomEvent');
                  console.log('aasd')
              }
          })
          //Date range as a button
          $('#daterange-btn').daterangepicker({
                  ranges: {
                      'Today': [moment(), moment()],
                      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                      'This Month': [moment().startOf('month'), moment().endOf('month')],
                      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                          .endOf(
                              'month')
                      ]
                  },
                  startDate: moment().subtract(29, 'days'),
                  endDate: moment()
              },
              function(start, end) {
                  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
              }
          )
      </script>
      {{-- <script>
                                  $(document).on("click", ".editmodal", function() {
                                      var id = $(this).data('id');

                                      $.ajax({
                                          type: 'post',
                                          url: "{{ route('ogrenci.edit') }}",
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
                              </script> --}}
      {{-- <script>
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
                                          $('#ogrenci_tc').removeClass('is-invalid');
                                          $('#ogrenci_tc').addClass('is-valid');


                                      } else {
                                          $('#ogrenci_tc').removeClass('is-valid');
                                          $('#ogrenci_tc').addClass('is-invalid');
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
                              </script> --}}
      {{-- <script>
                                  // BS-Stepper Init
                                  document.addEventListener('DOMContentLoaded', function() {
                                      window.stepper1 = new Stepper(document.querySelector('.bs-stepper1'))
                                      window.stepper2 = new Stepper(document.querySelector('.bs-stepper2'))
                                  })
                              </script> --}}
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

          function myCallback(start, end) {
              //$('#reservation span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
              alert(start + ' - ' + end); //etc, your code here
          }
          // attach daterangepicker plugin

          /*
                                            $('#reservation').on('apply.daterangepicker', function(ev, picker) {
                                                var from = $("#startDate").val();
                                                var to = $("#endDate").val();
                                                if (from && to) {
                                                    console.log(from + ' - ' + to);

                                                }
                                            });*/
      </script>

      {!! $html->scripts() !!}


      <script>
          function refreshTable() {
              $('div.table-container').fadeOut();
              $('div.table-container').load("{{ route('hafizlik.index') }}", function() {
                  $('div.table-container').html('{!! $html->table() !!}');
                  $('div.table-container').fadeIn();
              });
          }
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#reservation').daterangepicker(function(start, end, label) {

              /*  $("#example1").DataTable({

                   "ajax": {
                       "url": "{{ route('hafizlik.index') }}",
                       "type": "POST",
                       "data": {
                           'bast': start.format('YYYY-MM-DD'),
                           'sont': end.format('YYYY-MM-DD')
                       },
                       success: (datam) => {
                           refreshTable();
                           console.log(datam);
                       }
                   },
                   "destroy": true,
               }); */
          });
      </script>
      {{-- <script>
                                  $(".reset").click(function() {
                                      $("#useredit").trigger("reset");
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
                                      var file_button = $('#file_button');
                                      var my_files = document.getElementById("file");
                                      var reader = new FileReader();
                                      var formdata = $('#useradd').serializeArray();
                                      var file_data;
                                      reader.onload = function() { //veriyi yükle
                                          file_data = reader.result;
                                      }
                                      var formData = new FormData($(this)[0]);
                                      var veri = [];
                                      jQuery.each(formdata, function(i, field) {
                                          veri[field.name] = field.value;
                                      });
                                      console.log(data);
                                      data.append("file", document.getElementById('file').files[0]);
                                      // file_button.after('<br><br><hr><br><img src="' + file_data + '" width="350px">');
                                      $.ajax({

                                          url: "{{ route('ogrenci.store') }}",
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
                                  $('#useredit').on("submit", function(e) {

                                      e.preventDefault();

                                      var form = $('#useredit')[0];
                                      var data = new FormData(form);
                                      var file_button = $('#file_button');
                                      var my_files = document.getElementById("filer");
                                      var reader = new FileReader();

                                      var file_data;
                                      reader.onload = function() { //veriyi yükle
                                          file_data = reader.result;
                                      }
                                      formData = new FormData($(this)[0]);
                                      var veri = [];
                                      jQuery.each(formdata, function(i, field) {
                                          veri[field.name] = field.value;
                                      });
                                      console.log(data);
                                      data.append("file", document.getElementById('filer').files[0]);
                                      // file_button.after('<br><br><hr><br><img src="' + file_data + '" width="350px">');
                                      $.ajax({

                                          url: "{{ route('ogrenci.update') }}",
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
                                                  title: dat["ogrenci_adsoyad"] + '<br>  İşlem Başarılı <br>',
                                              })

                                              document.getElementById("useradd").reset();
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


                                  /* hocagetir();
                                                    function hocagetir() {
                                                        $.ajax({
                                                            type: 'post',
                                                            url: "{{ route('birimhoca.hocagetir') }}",
                                                            data: {
                                                                get_option: true
                                                            },
                                                            success: function(response) {
                                                                document.getElementById("hoca").innerHTML = response;
                                                            }
                                                        });
                                                    }
                                   */
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
                              </script> --}}
  @endsection

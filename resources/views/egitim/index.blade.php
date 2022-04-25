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
                          <div class="bs-stepper">
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
                                  <form method="POST" id="useradd" action="#">

                                      <div id="genel-part" class="content" role="tabpanel"
                                          aria-labelledby="genel-part-trigger">
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="ogrenci_adsoyad"
                                                  id="ogrenci_adsoyad" placeholder="Adı Soyadı">
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
                                              onclick="stepper.next()">Sonraki</button>
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
                                              <select id="yetimdurum" name="yetimdurum" class="form-control col">
                                                  <option value="">Yetim veya Öksüz mü?</option>
                                                  <option value="0">Hayır</option>
                                                  <option value="1">Evet</option>

                                              </select>
                                              <select id="bosanma" name="bosanma" class="form-control col">
                                                  <option value="">Anne Baba Ayrı mı?</option>
                                                  <option value="0">Hayır</option>
                                                  <option value="1">Evet</option>

                                              </select>

                                          </div>
                                          <button type="button" class="btn btn-outline-info"
                                              onclick="stepper.previous()">Önceki</button>
                                          <button type="button" class="btn btn-outline-info"
                                              onclick="stepper.next()">Sonraki</button>

                                      </div>
                                      <div id="veli-part" class="content" role="tabpanel"
                                          aria-labelledby="veli-part-trigger">
                                          <div class="form-group">
                                              <select id="birim" name="birim_id" class="form-control">
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
                                              onclick="stepper.previous()">Önceki</button>
                                          <button type="button" class="btn btn-outline-info"
                                              onclick="stepper.next()">Sonraki</button>

                                      </div>

                                      <div id="egitim-part" class="content" role="tabpanel"
                                          aria-labelledby="egitim-part-trigger">
                                          <div class="form-group">

                                              <div class="input-group  input-file " id="ogrenci_resim" name="ogrenci_resim">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-default btn-choose" id="file_button"
                                                          type="button">Resim
                                                          Ekle</button>
                                                  </span>
                                                  <input type="text" class="form-control" name="deger_resim"
                                                      placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-warning btn-reset"
                                                          type="button">Temizle</button>
                                                  </span>

                                              </div>
                                              <br>
                                              <button type="button" class="btn btn-outline-info"
                                                  onclick="stepper.previous()">Önceki</button>
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
                  }
                  $(function() {
                      bs_input_file();
                  });
              </script>
              <script>
                  // BS-Stepper Init
                  document.addEventListener('DOMContentLoaded', function() {
                      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
                  })
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
                          data: data
                              /* {
                                                           resim: file_data,

                                                           annead: veri['annead'],
                                                           annemes: veri['annemes'],
                                                           annetel: veri['annetel'],
                                                           babaad: veri['babaad'],
                                                           babames: veri['babames'],
                                                           babatel: veri['babatel'],
                                                           basaripuan: veri['basaripuan'],
                                                           birim_id: veri['birim_id'],
                                                           bosanma: veri['bosanma'],
                                                           deger_resim: veri['deger_resim'],
                                                           ogrenci_aciklama: veri['ogrenci_aciklama'],
                                                           ogrenci_adres: veri['ogrenci_adres'],
                                                           ogrenci_adsoyad: veri['ogrenci_adsoyad'],
                                                           ogrenci_dt: veri['ogrenci_dt'],
                                                           ogrenci_sehir: veri['ogrenci_sehir'],
                                                           ogrenci_tc: veri['ogrenci_tc'],
                                                           ogrenci_tel: veri['ogrenci_tel'],
                                                           okuldurum: veri['okuldurum'],
                                                           yetimdurum: veri['yetimdurum'],
                                                       } */
                              ,
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


                  birimgetir();
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
                  function birimgetir() {
                      $.ajax({
                          type: 'post',
                          url: "{{ route('birimhoca.birimgetir') }}",
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

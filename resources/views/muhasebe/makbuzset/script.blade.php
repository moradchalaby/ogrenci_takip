

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
          $(document).on("click", ".editmodal", function() {

              //get data-id attribute of the clicked element
              var id = $(this).data('id');
              var ad = $(this).data('ad');
              var tur = $(this).data('tur');
              //populate the textbox
              $('input[name="set_data"]').val(ad);
              $('input[name="set_id"]').val(id);
              $('select[name="set_tur"]').val(tur);
              $('#set_tur').trigger('change');
              //$('#modalEdit #set_tur').val(tur);
              //document.getElementById("set_tur").value='Kur';
              //$('#set_tur').val(tur);
          });
      </script>
      <script>
          $('#setedit').on("submit", function(e) {

              e.preventDefault();
              var form = $('#setedit')[0];
              var data = new FormData(form);

              $.ajax({

                  url: "{{ route('makbuzset.update') }}",
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
                          title: dat["set_tur"] + '<br>  Olarak Değişti <br>',
                      })

                      document.getElementById("setedit").reset();
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
                          title: dat["set_tur"]

                              +
                              '<br>Düzenleme İşlemi başarısız <br>',
                      })
                      document.getElementById("setedit").reset();
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
          $(document).on("click", ".deleteset", function() {
              var id = $(this).data('id');
              console.log(id)
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });


              $.ajax({
                  type: 'post',

                  url: "{{ route('makbuzset.destroy') }}",
                  dataType: 'json',
                  data: {
                      set_id: id
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
                          title: dat["set_tur"] + '<br>Silme İşlemi Başarılı <br>',
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
                          title: dat["set_tur"]

                              +
                              '<br>Silme İşlemi başarısız <br>',
                      })

                  },
              });
          });
      </script>
      {{-- Delete Birim bitiş --}}
    {{--  <script>
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
      </script>--}}
      <script>
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#setadd').on("submit", function(e) {
              e.preventDefault();
              var formdata = $('#setadd').serializeArray();
              console.log(formdata);
              $.ajax({

                  url: "{{ route('makbuzset.store') }}",
                  type: 'POST',
                  data: {
                      set_data: formdata[1]['value'],
                      set_tur: formdata[2]['value'],

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
                          title: dat["set_data"] + '<br>  İşlem Başarılı <br>',
                      })

                      document.getElementById("setadd").reset();
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
                          title: set_data

                              +
                              '<br> İşlem başarısız <br>',
                      })
                      document.getElementById("setadd").reset();
                  },
              });


          })
      </script>
  @endsection

 @extends('layouts.app')


 @section('content')
     <style>
         .picker {
             border-radius: 5px;
             width: 36px;
             height: 36px;
             cursor: pointer;
             -webkit-transition: all linear .2s;
             -moz-transition: all linear .2s;
             -ms-transition: all linear .2s;
             -o-transition: all linear .2s;
             transition: all linear .2s;
             border: thin solid #eee;
             z-index: 1;
         }


         .fc-time {
             display: none;
         }

         .picker:hover {
             transform: scale(1.1);
         }

     </style>
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Takvim</h1>
                     </div>

                 </div>
             </div><!-- /.container-fluid -->
         </section>
         @php
             // print_r($data);
         @endphp
         <!-- Main content -->
         <section class="content">
             <div class="container-fluid">
                 <div class="row d-flex justify-content-center">
                     <div class="col-10">
                         <!-- Default box -->
                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title">Akmescid Erkek Öğrenci Yurdu</h3>

                                 <div class="card-tools">
                                     <button type="button" class="btn btn-tool" data-card-widget="refresh"
                                         id="takvimYenile" title="Yenile">
                                         <i class="fas fa-rotate"></i>
                                     </button>
                                     <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                         title="Collapse">
                                         <i class="fas fa-minus"></i>
                                     </button>
                                     <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                         <i class="fas fa-times"></i>
                                     </button>
                                 </div>
                             </div>
                             <div class="card-body center">
                                 <div id='calendar' class=""></div>
                             </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                 Footer
                             </div>
                             <!-- /.card-footer-->
                         </div>
                         <!-- /.card -->
                     </div>
                 </div>
             </div>
         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->

     <div class=" modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <form class="form-horizontal" id="eventadd">

                     <div class="modal-header">
                         <h4 class="modal-title" id="myModalLabel">Etkinlik Ekle</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>

                     </div>
                     <div class="modal-body">

                         <div class="form-group">
                             <label for="title" class="col-sm-2 control-label">Başlık</label>
                             <div class="col-sm-10">
                                 <input type="text" name="title" class="form-control" id="title" placeholder="Başlık">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="title" class="col-sm-2 control-label">Açıklama</label>
                             <div class="col-sm-10">
                                 <input type="text" name="aciklama" class="form-control" id="aciklama"
                                     placeholder="Açıklama">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="color" class="col-sm-2 control-label">Renk</label>
                             <input type="hidden" id='color' name='color'>
                             <div class="col-sm-10">
                                 <div class="picker col-sm-3" id="picker1"></div>
                             </div>
                         </div>
                         <input type="hidden" name="start" class="form-control" id="start" readonly>
                         <input type="hidden" name="kullanici_id" class="form-control" id="kullanici_id" value=""
                             readonly>

                         <input type="hidden" name="end" class="form-control" id="end" readonly>


                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                         <button type="submit" class="btn btn-primary">Kaydet</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>



     <!-- Modal -->
     <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
             <div class="modal-content bg-secondary">
                 <form class="form-horizontal" id="eventedit">
                     <div class="modal-header">
                         <h4 class="modal-title" id="myModalLabel">Etkinliği Düzenle</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>

                     </div>
                     <div class="modal-body">

                         <div class="form-group">
                             <label for="title" class="col-sm-2 control-label">Başlık</label>
                             <div class="col-sm-10">
                                 <input type="text" name="title" class="form-control" id="title" placeholder="Başlık">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="title" class="col-sm-2 control-label">Açıklama</label>
                             <div class="col-sm-10">
                                 <input type="text" name="aciklama" class="form-control" id="aciklama"
                                     placeholder="Açıklama">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="color" class="col-sm-2 control-label">Renk</label>
                             <input type="hidden" id='color1' name='color'>
                             <div class="col-sm-10">
                                 <div class="picker col-sm-3" id="picker2"></div>
                             </div>
                         </div>


                         <div class="form-group">
                             <div class="col-sm-offset-4 col-sm-10">

                                 <input type="text" name="kullanici" id="kullanici" readonly>

                                 <input type="hidden" name="id" class="form-control" id="id">
                             </div>
                         </div>

                         <div class="form-group">
                             <div class="custom-control custom-checkbox">
                                 <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                     name="delete" value="true" id="customCheckbox4">
                                 <label for="customCheckbox4" class="custom-control-label"> Etkinliği sil </label>
                             </div>

                         </div>



                     </div>
                     <div class="modal-footer">


                         <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                         <button type="submit" class="btn btn-primary">Dğişiklikleri kaydet</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <!-- /page content -->
 @endsection
 @section('css')
 @endsection
 @section('js')
 @endsection
 @section('script')
     <script>
         $(document).ready(function() {
             $("#picker1").colorPick({
                 'initialColor': '#E0ACF6',
                 'palette': ["#BF4565", "#93BFA3", "#F2EFC4", "#F2B680", "#F29999", "#FCFFF5", "#D1DBBD",
                     "#FFF4E0",
                     "#00ADB5", "#BAD6FD", "#E0ACF6", "#00A7FF", "#1CE882", "#F5D41E", "#C9DFF1",
                     "#C1BBA8",
                     "#EFBFA8",
                     "#FF8984"
                 ],
                 'onColorSelected': function() {

                     this.element.css({
                         'backgroundColor': this.color,
                         'color': this.color
                     });
                     $('#color').val(this.color);
                 }
             });
             var color;
             $("#picker2").colorPick({
                 'initialColor': "#F2EFC4",
                 'palette': ["#BF4565", "#93BFA3", "#F2EFC4", "#F2B680", "#F29999", "#FCFFF5", "#D1DBBD",
                     "#FFF4E0",
                     "#00ADB5", "#BAD6FD", "#E0ACF6", "#00A7FF", "#1CE882", "#F5D41E", "#C9DFF1",
                     "#C1BBA8",
                     "#EFBFA8",
                     "#FF8984"
                 ],
                 'onColorSelected': function() {

                     this.element.css({
                         'backgroundColor': this.color,
                         'color': this.color
                     });
                     $('#color1').val(this.color);


                 }
             });
         });
     </script>
     <script>
         $(document).ready(function() {

             var calendar = $('#calendar').fullCalendar({
                 locale: 'tr',
                 lang: 'tr',

                 editable: true,
                 header: {
                     left: 'prev,next today',
                     center: 'title',
                     right: 'basicDay,basicWeek,month'
                 },

                 events: '/takvim',
                 selectable: true,
                 selectHelper: true,
                 select: function(start, end) {

                     $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
                     $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
                     $('#ModalAdd').modal('show');
                 },
                 eventRender: function(event, element) {
                     console.log(event);
                     element.bind('dblclick', function() {
                         $('#ModalEdit #id').val(event.id);
                         $('#ModalEdit #title').val(event.title);
                         $('#ModalEdit #aciklama').val(event.aciklama);
                         $('#ModalEdit #color1').val(event.color);
                         $('#ModalEdit #kullanici').val(event.kullanici_name);
                         $("#picker2").colorPick({
                             'initialColor': $('#color1').val(),
                             'palette': ["#BF4565", "#93BFA3", "#F2EFC4",
                                 "#F2B680",
                                 "#F29999", "#FCFFF5", "#D1DBBD", "#FFF4E0",
                                 "#00ADB5", "#BAD6FD", "#E0ACF6", "#00A7FF",
                                 "#1CE882",
                                 "#F5D41E", "#C9DFF1", "#C1BBA8", "#EFBFA8",
                                 "#FF8984"
                             ],
                             'onColorSelected': function() {

                                 this.element.css({
                                     'backgroundColor': this.color,
                                     'color': this.color
                                 });
                                 $('#color1').val(this.color);


                             }
                         });
                         $('#ModalEdit').modal('show');
                     });
                 },
                 eventDrop: function(event, delta, revertFunc) { // si changement de position

                     edit(event);

                 },


             });

         });

         function edit(event) {
             start = event.start.format('YYYY-MM-DD HH:mm:ss');
             if (event.end) {
                 end = event.end.format('YYYY-MM-DD HH:mm:ss');
             } else {
                 end = start;
             }

             id = event.id;

             Event = [];

             Event[0] = id;
             Event[1] = start;
             Event[2] = end;
             Event[3] = 'editDate';


             $.ajax({

                 url: '/takvim/editEvents',
                 type: "POST",
                 data: {
                     id: id,

                     start: start,
                     end: end,
                     drop: true,
                 },
                 success: (data) => {
                     var dat = JSON.parse(JSON.stringify(data));
                     console.log(data);
                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });
                     Toast.fire({
                         icon: 'success',
                         title: dat['title'] + '<br> Başlıklı Not tarihleri Değişti <br>',
                     })


                 },
                 error: function(data) {
                     var dat = JSON.parse(data);
                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });
                     Toast.fire({
                         icon: 'error',
                         title: dat['title'] + '<br> İşlem Başarısız <br>',
                     })
                 },
             });


         }
     </script>

     <script>
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $('#eventedit').on("submit", function(e) {
             e.preventDefault();
             var formdata = $('#eventedit').serializeArray();
             var sil = false;
             if (Boolean(formdata[5])) {
                 sil = true;
             }
             $.ajax({

                 url: '/takvim/editFormEvents',
                 type: 'POST',
                 data: {
                     title: formdata[0]['value'],
                     aciklama: formdata[1]['value'],
                     color: formdata[2]['value'],
                     id: formdata[4]['value'],
                     sil: sil,
                     drop: false,

                 },
                 dataType: 'text',
                 success: (data) => {
                     $('#calendar').fullCalendar('refetchEvents');
                     $('#ModalEdit').modal('hide');

                     var dat = JSON.parse(data);
                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });
                     Toast.fire({
                         icon: 'success',
                         title: dat['title'] +
                             '<br> İşlem Başarılı <br>',
                     })

                     document.getElementById("eventadd").reset();
                 },
                 error: function(data) {
                     var dat = JSON.parse(data);
                     $('#ModalEdit').modal('hide');
                     console.log('error: ' + JSON.stringify(data));
                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });
                     Toast.fire({
                         icon: 'error',
                         title: dat['title'] + '<br> İşlem başarısız <br>',
                     })
                     document.getElementById("eventadd").reset();
                 },
             });


         })
     </script>
     <script>
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $('#eventadd').on("submit", function(e) {
             e.preventDefault();
             var formdata = $('#eventadd').serializeArray();
             $.ajax({

                 url: '/takvim/addEvents',
                 type: 'POST',
                 data: {
                     title: formdata[0]['value'],
                     aciklama: formdata[1]['value'],
                     color: formdata[2]['value'],
                     start: formdata[3]['value'],
                     end: formdata[5]['value'],
                     kullanici_id: '{{ Auth::user()->name }}'

                 },
                 dataType: 'text',
                 success: (data) => {
                     var dat = JSON.parse(data);
                     $('#calendar').fullCalendar('refetchEvents');
                     $('#ModalAdd').modal('hide');
                     console.log('success: ' + JSON.stringify(data));
                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });
                     Toast.fire({
                         icon: 'success',
                         title: dat['title'] + '<br>  İşlem Başarılı <br>',
                     })

                     document.getElementById("eventadd").reset();
                 },
                 error: function(data) {
                     var dat = JSON.parse(data);
                     $('#ModalAdd').modal('hide');
                     console.log('error: ' + JSON.stringify(data));

                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });
                     Toast.fire({
                         icon: 'error',
                         title: dat['title'] + '<br> İşlem başarısız <br>',
                     })
                     document.getElementById("eventadd").reset();
                 },
             });


         })
         /*  */
     </script>
 @endsection

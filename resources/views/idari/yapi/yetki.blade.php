 @extends('layouts.app')


 @section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper kanban">
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-sm-6">
                         <h1> <span class="lead">Personel Yetkilendirme</span> {{ $user->name }}</h1>
                     </div>
                     <div class="col-sm-6 d-none d-sm-block">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="#">Home</a></li>
                             <li class="breadcrumb-item active">yetkiler</li>
                         </ol>
                     </div>
                 </div>
             </div>
         </section>

         <section class="content pb-3">
             <div class="container-fluid h-100">
                 <div class="card card-row card-lightblue">
                     <div class="card-header">
                         <h3 class="card-title">
                             @foreach ($yetki as $yet)
                                 @if ($yet->id == 2)
                                     {{ $yet->name }}
                                 @else
                                 @endif
                             @endforeach

                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="card card-lightblue card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">İdari Yetkiler</h5>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <div class="card-body">
                                 @foreach ($yetki as $yet)
                                     @if ($yet->parent_id == 2)
                                         <div class="custom-control custom-checkbox">
                                             <input
                                                 class="custom-control-input checkbox2 @if ($yet->vazife_id != 1) yetki{{ $yet->parent_id }} @endif"
                                                 value="{{ $yet->id }}" type="checkbox" tur="yetki" name="idari"
                                                 id="customCheckbox{{ $yet->id }}"
                                                 @if (App\Models\User::hasRol($yet->roles_slug, $id)) checked @endif>
                                             <label for="customCheckbox{{ $yet->id }}"
                                                 class="custom-control-label">{{ $yet->name }}</label>
                                         </div>
                                     @else
                                     @endif
                                 @endforeach


                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="card card-row card-teal">
                     <div class="card-header">
                         <h3 class="card-title">
                             Birim Sorumlusu
                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="card card-teal card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">Birim Sorumlu Yetkiler</h5>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <div class="card-body">
                                 @foreach ($yetki as $yet)
                                     @if ($yet->parent_id == 3)
                                         <div class="custom-control custom-checkbox">
                                             <input
                                                 class="custom-control-input @if ($yet->vazife_id != 1) yetki{{ $yet->parent_id }} @endif checkbox3 "
                                                 value="{{ $yet->id }}" type="checkbox" tur="yetki" name="check"
                                                 id="customCheckbox{{ $yet->id }}"
                                                 @if (App\Models\User::hasRol($yet->roles_slug, $id)) checked @endif>
                                             <label for="customCheckbox{{ $yet->id }}"
                                                 class="custom-control-label">{{ $yet->name }}</label>
                                         </div>
                                     @else
                                     @endif
                                 @endforeach


                             </div>
                         </div>
                         <div class="card card-teal card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">Proje Sorumlu Yetkiler</h5>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <div class="card-body">
                                 @foreach ($yetki as $yet)
                                     @if ($yet->parent_id == 7)
                                         <div class="custom-control custom-checkbox">
                                             <input
                                                 class="custom-control-input @if ($yet->vazife_id != 1) yetki{{ $yet->parent_id }} @endif checkbox3 "
                                                 value="{{ $yet->id }}" type="checkbox" tur="yetki" name="check"
                                                 id="customCheckbox{{ $yet->id }}"
                                                 @if (App\Models\User::hasRol($yet->roles_slug, $id)) checked @endif>
                                             <label for="customCheckbox{{ $yet->id }}"
                                                 class="custom-control-label">{{ $yet->name }}</label>
                                         </div>
                                     @else
                                     @endif
                                 @endforeach


                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card card-row card-info">
                     <div class="card-header">
                         <h3 class="card-title">
                             MUHASEBE
                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="card card-info card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">Muhasebe Yetkiler</h5>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <div class="card-body">
                                 @foreach ($yetki as $yet)
                                     @if ($yet->parent_id == 4)
                                         <div class="custom-control custom-checkbox">
                                             <input
                                                 class="custom-control-input @if ($yet->vazife_id != 1) yetki{{ $yet->parent_id }} @endif checkbox4 "
                                                 value="{{ $yet->id }}" type="checkbox" tur="yetki" name="check"
                                                 id="customCheckbox{{ $yet->id }}"
                                                 @if (App\Models\User::hasRol($yet->roles_slug, $id)) checked @endif>
                                             <label for="customCheckbox{{ $yet->id }}"
                                                 class="custom-control-label">{{ $yet->name }}</label>
                                         </div>
                                     @else
                                     @endif
                                 @endforeach


                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card card-row card-olive">
                     <div class="card-header">
                         <h3 class="card-title">
                             TEKNİK İDARİ
                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="card card-olive card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">Teknik İdari Yetkiler</h5>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <div class="card-body">
                                 @foreach ($yetki as $yet)
                                     @if ($yet->parent_id == 5)
                                         <div class="custom-control custom-checkbox">
                                             <input
                                                 class="custom-control-input @if ($yet->vazife_id != 1) yetki{{ $yet->parent_id }} @endif checkbox5 "
                                                 value="{{ $yet->id }}" type="checkbox" tur="yetki" name="check"
                                                 id="customCheckbox{{ $yet->id }}"
                                                 @if (App\Models\User::hasRol($yet->roles_slug, $id)) checked @endif>
                                             <label for="customCheckbox{{ $yet->id }}"
                                                 class="custom-control-label">{{ $yet->name }}</label>
                                         </div>
                                     @else
                                     @endif
                                 @endforeach


                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card card-row card-olive">
                     <div class="card-header">
                         <h3 class="card-title">
                             HOCA VAZİFE
                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="card card-olive card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">VAZİFELER</h5>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <div class="card-body">
                                 @foreach ($yetki as $yet)
                                     @if ($yet->parent_id == 6)
                                         <div class="custom-control custom-checkbox">
                                             <input
                                                 class="custom-control-input @if ($yet->vazife_id != 1) yetki{{ $yet->parent_id }} @endif checkbox6 "
                                                 value="{{ $yet->id }}" type="checkbox" tur="yetki" name="check"
                                                 id="customCheckbox{{ $yet->id }}"
                                                 @if (App\Models\User::hasRol($yet->roles_slug, $id)) checked @endif>
                                             <label for="customCheckbox{{ $yet->id }}"
                                                 class="custom-control-label">{{ $yet->name }}</label>
                                         </div>
                                     @else
                                     @endif
                                 @endforeach


                             </div>
                         </div>

                         <div class="card card-olive card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">BİRİMLER</h5>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <div class="card-body">
                                 @foreach ($birimler as $birim)
                                     <div class="custom-control custom-checkbox">
                                         <input class="custom-control-input checkboxb{{ $birim->birim_id }} "
                                             value="{{ $birim->birim_id }}" tur="birim" type="checkbox" name="check"
                                             id="customCheckboxb{{ $birim->birim_id }}"
                                             @foreach ($birimi as $bir) @if ($bir->birim_id == $birim->birim_id)  checked @endif
                                             @endforeach>


                                         <label for="customCheckboxb{{ $birim->birim_id }}"
                                             class="custom-control-label">{{ $birim->birim_ad }}</label>
                                     </div>
                                 @endforeach


                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </section>
     </div>
 @endsection
 @section('css')
 @endsection
 @section('js')
 @endsection
 @section('script')
     <script>
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         function ver(params) {
             $.ajax({

                 url: "{{ route('yetki.create') }}",
                 type: 'POST',
                 data: {
                     user_id: {{ $id }},
                     role_id: params.attr('value'),
                     tur: params.attr('tur')


                 },
                 dataType: 'text',
                 success: (data) => {

                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000,
                         customClass: {
                             popup: 'bg-light'
                         }
                     });
                     Toast.fire({
                         icon: 'success',
                         title: params.next('label').text() +
                             '<br>  Yetkisi Verildi <br>',
                     })


                 },
                 error: function(data) {



                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });
                     Toast.fire({
                         icon: 'error',
                         title: params.next('label').text()

                             +
                             '<br> İşlem başarısız <br>',
                     })

                 },
             });
         }


         function al(params) {
             $.ajax({

                 url: "{{ route('yetki.destroy') }}",
                 type: 'POST',
                 data: {
                     user_id: {{ $id }},
                     role_id: params.attr('value'),
                     tur: params.attr('tur')


                 },
                 dataType: 'text',
                 success: (data) => {

                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000,
                         customClass: {
                             popup: 'bg-maroon',
                             title: 'text-warning'
                         }
                     });
                     Toast.fire({
                         icon: 'success',
                         title: params.next('label').text() +
                             '<br>  Yetkisi Alındı <br>',
                     })


                 },
                 error: function(data) {



                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });
                     Toast.fire({
                         icon: 'error',
                         title: params.next('label').text()

                             +
                             '<br> İşlem başarısız <br>',
                     })

                 },
             });
         }



         $(":checkbox").change(function() {
             if (this.checked) {
                 ver($(this));
             } else {

                 al($(this));
             }
         });

         @foreach ($yetki as $yet)
             @if ($yet->vazife_id == 1)

                 $("#customCheckbox" + {{ $yet->id }}).change(function() {
                     if (this.checked) {

                         $('.yetki' + {{ $yet->parent_id }}).each(function() {
                             this.checked = true;
                             ver($(this));
                         });
                     } else {
                         $('.yetki' + {{ $yet->parent_id }}).each(function() {
                             this.checked = false;
                             al($(this));

                         });
                     }
                 });
             @endif
         @endforeach

         /*   $("#customCheckbox2").change(function() {
               if (this.checked) {

                   $('.yetki2').each(function() {
                       this.checked = true;
                       ver($(this));
                   });
               } else {
                   $('.yetki2').each(function() {
                       this.checked = false;
                       al($(this));

                   });
               }
           });
           $("#customCheckbox3").change(function() {
               if (this.checked) {

                   $('.yetki3').each(function() {
                       this.checked = true;
                       ver($(this));
                   });
               } else {
                   $('.yetki3').each(function() {
                       this.checked = false;
                       al($(this));

                   });
               }
           });
           $("#customCheckbox4").change(function() {
               if (this.checked) {

                   $('.yetki4').each(function() {
                       this.checked = true;
                       ver($(this));
                   });
               } else {
                   $('.yetki4').each(function() {
                       this.checked = false;
                       al($(this));

                   });
               }
           });
           $("#customCheckbox5").change(function() {
               if (this.checked) {

                   $('.yetki5').each(function() {
                       this.checked = true;
                       ver($(this));
                   });
               } else {
                   $('.yetki5').each(function() {
                       this.checked = false;
                       al($(this));

                   });
               }
           });
           $("#customCheckbox6").change(function() {
               if (this.checked) {

                   $('.yetki6').each(function() {
                       this.checked = true;
                       ver($(this));
                   });
               } else {
                   $('.yetki6').each(function() {
                       this.checked = false;
                       al($(this));

                   });
               }
           }); */
     </script>
 @endsection

 @extends('layouts.app')


 @section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper kanban">
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-sm-6">
                         <h1>Kanban Board</h1>
                     </div>
                     <div class="col-sm-6 d-none d-sm-block">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="#">Home</a></li>
                             <li class="breadcrumb-item active">Kanban Board</li>
                         </ol>
                     </div>
                 </div>
             </div>
         </section>
         {{ $yetki }}
         <section class="content pb-3">
             <div class="container-fluid h-100">
                 <div class="card card-row card-secondary">
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
                         <div class="card card-info card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">İdari Yetkiler</h5>
                                 <div class="card-tools">


                                 </div>
                             </div>
                             <div class="card-body">
                                 @foreach ($yetki as $yet)
                                     @if ($yet->parent_id == 2)
                                         <div class="custom-control custom-checkbox">
                                             <input class="custom-control-input checkbox" value="{{ $yet->id }}"
                                                 type="checkbox" id="customCheckbox{{ $yet->id }}"
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
                 <div class="card card-row card-primary">
                     <div class="card-header">
                         <h3 class="card-title">
                             To Do
                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="card card-primary card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">Create first milestone</h5>
                                 <div class="card-tools">
                                     <a href="#" class="btn btn-tool btn-link">#5</a>
                                     <a href="#" class="btn btn-tool">
                                         <i class="fas fa-pen"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card card-row card-default">
                     <div class="card-header bg-info">
                         <h3 class="card-title">
                             In Progress
                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="card card-light card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">Update Readme</h5>
                                 <div class="card-tools">
                                     <a href="#" class="btn btn-tool btn-link">#2</a>
                                     <a href="#" class="btn btn-tool">
                                         <i class="fas fa-pen"></i>
                                     </a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 <p>
                                     Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                     Aenean commodo ligula eget dolor. Aenean massa.
                                     Cum sociis natoque penatibus et magnis dis parturient montes,
                                     nascetur ridiculus mus.
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card card-row card-success">
                     <div class="card-header">
                         <h3 class="card-title">
                             Done
                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="card card-primary card-outline">
                             <div class="card-header">
                                 <h5 class="card-title">Create repo</h5>
                                 <div class="card-tools">
                                     <a href="#" class="btn btn-tool btn-link">#1</a>
                                     <a href="#" class="btn btn-tool">
                                         <i class="fas fa-pen"></i>
                                     </a>
                                 </div>
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

         $(".checkbox").change(function() {
             if (this.checked) {
                 $.ajax({

                     url: "{{ route('yetki.create') }}",
                     type: 'POST',
                     data: {
                         user_id: {{ $id }},
                         role_id: $(this).attr('value'),



                     },
                     dataType: 'text',
                     success: (data) => {

                         var Toast = Swal.mixin({
                             toast: true,
                             position: 'top',
                             showConfirmButton: false,
                             timer: 3000
                         });
                         Toast.fire({
                             icon: 'success',
                             title: $(this).next('label').text() +
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
                             title: $(this).next('label').text()

                                 +
                                 '<br> İşlem başarısız <br>',
                         })

                     },
                 });
             } else {

                 $.ajax({

                     url: "{{ route('yetki.destroy') }}",
                     type: 'POST',
                     data: {
                         user_id: {{ $id }},
                         role_id: $(this).attr('value'),



                     },
                     dataType: 'text',
                     success: (data) => {

                         var Toast = Swal.mixin({
                             toast: true,
                             position: 'top',
                             showConfirmButton: false,
                             timer: 3000
                         });
                         Toast.fire({
                             icon: 'success',
                             title: $(this).next('label').text() +
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
                             title: $(this).next('label').text()

                                 +
                                 '<br> İşlem başarısız <br>',
                         })

                     },
                 });
             }
         });
     </script>
 @endsection

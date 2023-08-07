@extends('layouts.app')
@section('title','Akmescid Erkek Öğrenci Yurdu - '.$veri['title'])

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
                    <form method="POST" id="filter" action="{{ route('birimhafizlik.indexpost') }}">
                        @csrf
                        <input type="hidden" name="id" value={{ $veri['birim'] }}>
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
                            <input type="text" class="form-control" name="kota" id="kota"
                                   value="{{ $veri['kota'] }}" placeholder="Kota">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="sayfa" id="sayfa"
                                   value="{{ $veri['sayfa'] }}" placeholder="Tur">
                        </div>
                        <div class="form-group">
                            <select id="durum" name="durum" class="form-control select2" style="width: 100%;">
                                <option value="">Hafızlık Tüm Durumlar</option>
                                <option value="Ham">Ham</option>
                                <option value="Has">Has</option>
                                <option value="Hafız">Hafız</option>
                                <option value="Yüzüne">Yüzüne</option>
                                <option value="Komisyon">Komisyon</option>
                            </select>

                        </div>
                        {{-- <div class="form-group">
                            <select id="birim" name="birim_id" class="form-control select2" style="width: 100%;">
                            </select>

                        </div> --}}
                        <div class="form-group">
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
                            <label for="recipient-name" class="col-form-label">Tur</label>

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
    @include('livewire.egitim.hadis.birim-js')
@endsection

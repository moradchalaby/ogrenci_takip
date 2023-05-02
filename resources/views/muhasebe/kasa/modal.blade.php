
<div class="modal fade" id="modalKasaAdd">
    <div class="modal-dialog ">


        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="">
                    <strong>Yeni Makbuz Ekle</strong>

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="kasaadd" action="#">

                @csrf
                <input type="hidden" name="durum" id="durum" value="0">
                <div align="center" class="modal-body">





                    <div class="form-group">



                        <label for="recipient-name" class="col-form-label">Tarih</label>
                        <input type="date" name="tarih" class="form-control" value="<?php echo date('Y-m-d');  ?>">

                    </div>




                    <div class="form-group">


                        <label for="recipient-name" class="col-form-label">Tahsilat Yapan</label>
                        <input name="kullanici_adsoyad" class="form-control" id="kullanici_adsoyad"
                               value="{{Auth::user()->name}}">
                      <label for="recipient-name" class="col-form-label">Ödeme Yapan</label>
                        <input type="text" class="form-control" name="makbuz_adsoyad" id="makbuz_adsoyad" value="">

                        <label for="recipient-name" class="col-form-label">Tutar</label>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" pattern="^\d*(\.\d{2}$)?" name="tutar" id="tutar"
                                       class="form-control col-md-12 ">
                            </div>
                            <div class="col-md-2">
                                <select name="kur" class=" form-control" id="kur">


                                </select>
                            </div>
                        </div>
                        <label for="recipient-name" class="col-form-label">Ödeme Şekli</label>
                        <select name="odemeSekli" class="form-control" id="odemeSekli">


                        </select>
                        <label for="recipient-name" class="col-form-label">Ödenen</label>
                        <select name="odenen" class="form-control" id="odenen">


                        </select>
                        <!--label for="recipient-name" class="col-form-label">Açıklama</label>
                        <textarea name="ac'klama" class="form-control"></textarea-->
                        <label for="recipient-name" class="col-form-label">Açıklama</label>
                        <input type="text" class="form-control" name="makbuz_aciklama" id="makbuz_aciklama"  value="">



                    </div>


                    <div class="form-group">
                        <input type="hidden" name="kullanici_id" id="kullanici_id" value="{{Auth::id()}}">








                    </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="submit" name="makbuzekle" class="btn btn-primary">Ekle</button>

            </div>

            </form>

        </div>

    </div>


</div>
<div class="modal fade" id="modalAdd">
    <div class="modal-dialog ">


        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="">
                    <strong>Yeni Makbuz Ekle</strong>

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="makbuzadd" action="#">

                @csrf

                <div align="center" class="modal-body">





                    <div class="form-group">



                        <label for="recipient-name" class="col-form-label">Tarih</label>
                        <input type="date" name="tarih" class="form-control" value="<?php echo date('Y-m-d');  ?>">

                    </div>




                    <div class="form-group">


                        <label for="recipient-name" class="col-form-label">Tahsilat Yapan</label>
                        <input name="kullanici_adsoyad" class="form-control" id="kullanici_adsoyad"
                               value="{{Auth::user()->name}}">
                        <label for="recipient-name" class="col-form-label">Ödeme Yapan</label>
                        <input type="text" class="form-control" name="makbuz_adsoyad" id="makbuz_adsoyad" value="">

                        <label for="recipient-name" class="col-form-label">Tutar</label>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" pattern="^\d*(\.\d{2}$)?" name="tutar" id="tutar"
                                       class="form-control col-md-12 ">
                            </div>
                            <div class="col-md-2">
                                <select name="kur" class=" form-control" id="kur">


                                </select>
                            </div>
                        </div>
                        <label for="recipient-name" class="col-form-label">Ödeme Şekli</label>
                        <select name="odemeSekli" class="form-control" id="odemeSekli">


                        </select>
                        <label for="recipient-name" class="col-form-label">Ödenen</label>
                        <select name="odenen" class="form-control" id="odenen">


                        </select>
                        <!--label for="recipient-name" class="col-form-label">Açıklama</label>
                        <textarea name="ac'klama" class="form-control"></textarea-->
                        <label for="recipient-name" class="col-form-label">Açıklama</label>
                        <input type="text" class="form-control" name="makbuz_aciklama" id="makbuz_aciklama"  value="">



                    </div>


                    <div class="form-group">
                        <input type="hidden" name="kullanici_id" id="kullanici_id" value="{{Auth::id()}}">








                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="submit" name="makbuzekle" class="btn btn-primary">Ekle</button>

                </div>

            </form>

        </div>

    </div>


</div>
<!-- /.modal -->

<div class="modal fade" id="modalEdit">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Yeni {!! $veri['name'] !!} Düzenle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="makbuzedit" action="#">

                @csrf

                <div align="center" class="modal-body">





                    <div class="form-group">



                        <label for="recipient-name" class="col-form-label">Tarih</label>
                        <input type="date" name="tarih" id="tarih" class="form-control" value="">

                    </div>




                    <div class="form-group">


                        <label for="recipient-name" class="col-form-label">Tahsilat Yapan</label>
                        <input name="kullanici" class="form-control" id="kullanici"
                               value="">
                        <label for="recipient-name" class="col-form-label">Ödeme Yapan</label>
                        <input type="text" class="form-control" name="adsoyad" id="adsoyad" value="">

                        <label for="recipient-name" class="col-form-label">Tutar</label>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" pattern="^\d*(\.\d{2}$)?" name="tutar" id="tutar"
                                       class="form-control col-md-12 ">
                            </div>
                            <div class="col-md-2">
                                <select name="kur" class=" form-control" id="kur">


                                </select>
                            </div>
                        </div>
                        <label for="recipient-name" class="col-form-label">Ödeme Şekli</label>
                        <select name="odeme_sekli" class="form-control" id="odeme_sekli">


                        </select>
                        <label for="recipient-name" class="col-form-label">Ödenen</label>
                        <select name="tur" class="form-control" id="tur">


                        </select>
                        <!--label for="recipient-name" class="col-form-label">Açıklama</label>
                        <textarea name="ac'klama" class="form-control"></textarea-->
                        <label for="recipient-name" class="col-form-label">Açıklama</label>
                        <input type="text" class="form-control" name="aciklama" id="aciklama"  value="">



                    </div>


                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="user_id" id="user_id" value="">








                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="submit" name="makbuzedit" class="btn btn-primary">Ekle</button>

                </div>

            </form>
            <!-- /.modal-dialog -->
        </div>
    </div>
</div>
<!-- /.modal -->

<div class="modal fade " id="modalShow">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header no-print">
                <h4 class="modal-title"><span id="id"></span> Numaralı Makbuz</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                span {
                    font-style: oblique;
                    font-weight: bold;
                }

                @media print {

                    .no-print,
                    .no-print * {
                        display: none !important;
                    }
                    .modal-body,#makbuzTable{
                        width: 100%;
                    }
                }
                #makbuzTable{
                    width: 100%;
                }
            </style>

                @csrf

                <div align="center" class="modal-body" width="100%">
<!--                    <table id="datatable-responsive" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">-->
                    <table id="makbuzTable" class="table table-bordered table-striped" width="100%">

                        <tbody>
                        <tr style="height: 18px;">
                            <td style="width: 27.9867%; height: 36px; text-align: center; border-collapse: collapse; border-style: inset;" colspan="2" rowspan="2">AKMESCİD ORTA ÖĞRETİM <br> ERKEK ÖĞRENCİ YURDU <br><br> Tel no: 0216
                                532 44 44</td>
                            <td style="width: 52.3137%; height: 18px;font-size: 30px; text-align: center; border-collapse: collapse; border-style: inset;" colspan="3" rowspan="2">TAHSİLAT MAKBUZU</td>
                            <td style="width: 18.4205%; height: 18px; text-align: center; border-collapse: collapse; border-style: inset;">
                                MAKBUZ NO<br />
                                <span id="id"><!--makbuz_id--></span>
                            </td>

                        </tr>
                        <tr style="height: 18px; text-align: center;">

                            <td style="width: 18.4205%; height: 18px; text-align: center; border-collapse: collapse; border-style: inset;" TARİH<br />
                            <span id="tarih"><!--makbuz_tarih--></span>
                            </td>
                        </tr>
                        <tr style="height: 18px; text-align: center;">
                            <td style="width: 62.6228%; height: 18px; text-align: left; border-collapse: collapse; border-style: inset;" colspan="6">ÖDEME YAPAN:  <span id="adsoyad"><!--makbuz_Adsoyad--></span>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 62.6228%; text-align: left; border-collapse: collapse; border-style: inset;" colspan="6">TUTAR:  <span id="tutar"><!--makbuz_id--></span>  <span id="kur"><!--makbuz_id--></span> (<span id="yaziyla"><!--makbuz_id--></span>)
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 62.6228%; text-align: left; border-collapse: collapse; border-style: inset;" colspan="6">ÖDENEN:  <span id="tur"><!--makbuz_id--></span>
                            </td>

                        </tr>
                        <tr style="height: 18px; text-align: center;">
                            <td style="height: 18px; text-align: left; border-collapse: collapse; border-style: inset; width: 62.6228%;" colspan="4">ÖDEME ŞEKLİ:  <span id="odeme_sekli"><!--makbuz_id--></span>
                            </td>
                            <td style="border-collapse: collapse;   vertical-align: top; border-style: inset; height: 104.333px; width: 36.0981%;" colspan="2" rowspan="2">TAHSİLAT YAPAN <br>
                                <span id="kullanici"><!--makbuz_id--></span>
                            </td>
                        </tr>
                        <tr style="height: 18px; text-align: center;">
                            <td style="height: 68.3333px; vertical-align: top; text-align: left; border-collapse: collapse; border-style: inset; width: 62.6228%;" colspan="4">AÇIKLAMA:  <span id="aciklama"><!--makbuz_id--></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>










                </div>


                <div class="modal-footer no-print">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <a onclick="printDiv();" class="no-print btn btn-primary">YAZDIR</a>

                </div>


            <!-- /.modal-dialog -->
        </div>
    </div>
</div>
<!-- /.modal -->

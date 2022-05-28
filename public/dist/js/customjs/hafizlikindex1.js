$(document).ready(function () {
    $(document).ready(function () {


        /*  $('#sayfas,#hoca, #yanlis, #usul').select2({
             theme: 'bootstrap4'
         }); */
        moment.locale("tr")
        $(document).on("click", ".editDurum", function () {
            var id = $(this).data('id');
            var sayfa = $(this).data('sayfa');
            $.ajax({
                type: 'post',
                url: "{{ route('hafizlik.durum') }}",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function (ogrenciedit) {
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
                            `<option value="${parseInt(datim.hafizlik_durum.split('.')[0]) + 1}.Has" >${parseInt(datim.hafizlik_durum.split(".")[0]) + 1}.Has</option>`
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
                    Object.keys(datim).forEach(function (key) {
                        // var value = jsonData[key];
                        if ($('#' + key).length) {
                            $(`#durumEdit #${key}`).val(datim[key]);
                        }
                    });

                    $('#durumEdit #sayfa').val(`${datim.hafizlik_son.split('/')[0]}`);


                },
                error: function (ogrenciedit) {
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


            function (start, end) {

                $('#tarihar').val(start.format('YYYY/MM/DD') + ' - ' + end.format(
                    'YYYY/MM/DD'))
            }
        )



    });


    $(document).on("click", ".ekleDers", function () {
        var id = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: 'post',
            url: "{{ route('hafizlik.ders') }}",
            dataType: 'json',
            data: {
                id: id
            },
            success: function (ogrenciedit) {
                var dat = JSON.stringify(ogrenciedit);
                var datim = JSON.parse(dat);
                console.log(datim)
                $("#ekleDers #cuzs").empty().trigger('change');


                $('#ekleDers #cuzs').select2({
                    theme: 'bootstrap4'
                });

                /*    $(".select2-selection__choice").remove() */
                if (datim.durum.includes('Hafız')) {
                    /*    $(" select").attr("multiple"); */
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

                        ` <label for="recipient-name" class="col-form-label">Sayfa</label>

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
                Object.keys(datim).forEach(function (key) {
                    // var value = jsonData[key];
                    if ($('#' + key).length) {
                        $(`#ekleDers #${key}`).val(datim[key]);
                    }
                });
                var today = moment().format('YYYY-MM-DD');
                $('#ekleDers #tarih').val(today);


                for (let index = 0; index < c; index++) {

                    $('#ekleDers #cuzs').append(new Option(index + 1, index + 1));
                }
                if (datim.cuz == 30 && !datim.hafizlik_durum.includes('Hafız')) {
                    $(`#ekleDers #sayfas`).val(parseInt(datim.sayfa) + 1);
                    $(`#ekleDers #cuzs`).val(1);

                } else {
                    $(`#ekleDers #sayfas`).val(datim.sayfa);

                    $('#ekleDers #cuzs').val(parseInt(
                        datim.cuz) + 1).trigger('change');

                    /*  $(`#ekleDers #cuzs`).val(parseInt(
                         datim.cuz) + 1); */
                }



            },
            error: function (ogrenciedit) {
                var dat = JSON.stringify(ogrenciedit);
                var datim = JSON.parse(dat);


                console.log('error: ' + dat);
            },
        });
    });


    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        'locale-compare-asc': function (a, b) {
            return a.localeCompare(b, 'cs', {
                sensitivity: 'case'
            })
        },
        'locale-compare-desc': function (a, b) {
            return b.localeCompare(a, 'cs', {
                sensitivity: 'case'
            })
        }
    })

    jQuery.fn.dataTable.ext.type.search['locale-compare'] = function (data) {

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


    (function ($, DataTable) {

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

});

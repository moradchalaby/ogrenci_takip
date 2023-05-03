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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!--AJAXLAR-->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on("click", ".addmodal", function() {
            var id = $(this).data('id');
            console.log(id);

            $.ajax({

                url: "/ogrenciodeme/show/"+id,
                type: 'POST',

                dataType: 'text',
                success: (data) => {
                    console.log('success');
                    console.log(data);
                    var dat = JSON.parse(data);
                    $("#example1").DataTable().ajax.reload();
                    document.getElementById("makbuzadd").reset();
                    Object.keys(dat).forEach(function(key) {

                        if ($('#' + key).length) {
                            $(`#makbuzadd #${key}`).val(dat[key]);
                            console.log(dat[key]);
                        }
                    });
                    $(`#makbuzadd #ogrenci_id`).val(id);
                    $('#modalAdd').modal('show');
                    console.log(data);



                },
                error: function(data) {
                    // var dat = JSON.parse(data);
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
                        title: data

                            +
                            '<br> İşlem başarısız <br>',
                    })
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
        $('#makbuzadd').on("submit", function(e) {
            e.preventDefault();
            var formdata = $('#makbuzadd').serializeArray();
            console.log(formdata);
            $.ajax({

                url: "{{ route( 'muhasebe.ogrenci.store') }}",
                type: 'POST',
                data: formdata,
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
                        title: dat["ogrtenci_adsoyad"] + '<br>  İşlem Başarılı <br>',
                    })

                    document.getElementById("makbuzadd").reset();
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
                        title: dat["ogrtenci_adsoyad"]

                            +
                            '<br> İşlem başarısız <br>',
                    })
                    document.getElementById("makbuzadd").reset();
                },
            });


        })
    </script>

<!-- EDİT AJAX   -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on("click", ".editmodal", function() {
            var id = $(this).data('id');


            $.ajax({

                url: "/muhasebe/show/"+id,
                type: 'POST',

                dataType: 'text',
                success: (data) => {
                    console.log('success');
                    console.log(data);
                    var dat = JSON.parse(data);
                    $("#example1").DataTable().ajax.reload();
                    document.getElementById("makbuzedit").reset();
                    Object.keys(dat).forEach(function(key) {

                        if ($('#' + key).length) {
                            $(`#makbuzedit #${key}`).val(dat[key]);
                        }
                    });
           /*         {"id":13,"adsoyad":"\u0130BRAH\u0130M \u015eEKER",
                        "kullanici":"Root ROOT","user_id":1,"ogrenci_id":null,"hoca_id":null,
                        "tutar":200,"kur":"\u20ba",
                        "odeme_sekli":"NAK\u0130T",
                        "tarih":"2023-04-18",
                        "tur":"SADAKA",
                        "aciklama":"\u015eUGARKEY"}*/
                    $('#modalEdit').modal('show');
                    console.log(data);



                },
                error: function(data) {
                    // var dat = JSON.parse(data);
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
                        title: data

                            +
                            '<br> İşlem başarısız <br>',
                    })
                },
            });


        })
    </script>
    <script >
        $('#makbuzedit').on("submit", function(e) {
            e.preventDefault();
            var formdata = $('#makbuzedit').serializeArray();
            console.log('ididid');
            console.log(formdata[9]);
            $.ajax({

                url: "update/"+formdata[9].value,
                type: 'POST',
                data: formdata,
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
                        title: dat["adsoyad"] + '<br>  İşlem Başarılı <br>',
                    })

                    document.getElementById("makbuzedit").reset();
                    $('#modalEdit').modal('hide');
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
                        title: data

                            +
                            '<br> İşlem başarısız <br>',
                    })
                    document.getElementById("makbuzadd").reset();
                },
            });


        })
    </script>


<!--    SHOW AJAX-->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on("click", ".showmodal", function() {
            var id = $(this).data('id');
            console.log('dat');

            //row.innerHTML("<tr><td colspan=2><input type='text' name='parts[]' placeholder='part 1' class='form-control' > </td><td><input type='text' name='price[]' placeholder='price e.g 100' class='form-control' ></td></tr>")
            $.ajax({

                url: "/muhasebe/show/"+id,
                type: 'POST',

                dataType: 'text',
                success: (data) => {
                    console.log('success');
                    console.log(data);
                    var dat = JSON.parse(data);
                   // $("#example1").DataTable().ajax.reload();
                   // document.getElementById("makbuzshow").reset();
                    console.log('dat');
                    Object.keys(dat).forEach(function(key) {

                        if ($('#' + key).length) {



                            $(`#makbuzTable #${key}`).html(dat[key]);
                            $(`.modal-title #${key}`).html(dat[key]);

                        }
                    });
                    /*         {"id":13,"adsoyad":"\u0130BRAH\u0130M \u015eEKER",
                                 "kullanici":"Root ROOT","user_id":1,"ogrenci_id":null,"hoca_id":null,
                                 "tutar":200,"kur":"\u20ba",
                                 "odeme_sekli":"NAK\u0130T",
                                 "tarih":"2023-04-18",
                                 "tur":"SADAKA",
                                 "aciklama":"\u015eUGARKEY"}*/
                    $('#modalShow').modal('show');
                    console.log(data);



                },
                error: function(data) {
                    // var dat = JSON.parse(data);
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
                        title: data

                            +
                            '<br> İşlem başarısız <br>',
                    })
                },
            });


        })
    </script>
    <!--SelectBox getir-->


    <script>

        function odemeturgetir(id, veri) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                beforeSend: function(xhr) {
                    document.getElementById("modalAdd").style.filter = "blur(10px)";
                },
                url: "{{ route( 'muhasebe.odemeturgetir',Auth::user()->id) }}",
                data: {
                    get_option: true
                },
                success: function(response) {
                    $(id).html(response);

                    $(id).val(veri);
                }

            });

        }
    </script>
    <script>

        function kurgetir(id, veri) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                beforeSend: function(xhr) {
                    document.getElementById("modalAdd").style.filter = "blur(10px)";
                },
                url: "{{ route( 'muhasebe.kurgetir',Auth::user()->id) }}",
                data: {
                    get_option: true
                },
                success: function(response) {
                    $(id).html(response);

                    $(id).val(veri);
                }

            });

        }
    </script>
    <script>

        function odemesekligetir(id, veri) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                beforeSend: function(xhr) {
                    document.getElementById("modalAdd").style.filter = "blur(10px)";
                },
                url: "{{ route( 'muhasebe.odemesekligetir',Auth::user()->id) }}",
                data: {
                    get_option: true
                },
                success: function(response) {
                    console.log(response);
                    document.getElementById("modalAdd").style.filter = "blur(0px)";
                    $(id).html(response);

                    $(id).val(veri);
                },
                error: function(response) {
                    console.log('error');


                }

            });

        }
    </script>
    <script>
        $( document ).ready(function() {
            odemeturgetir('#modalAdd #odenen','SADAKA');
            odemesekligetir('#modalAdd #odemeSekli','NAKİT');
            kurgetir('#modalAdd #kur','₺');
            odemeturgetir('#modalEdit #tur','SADAKA');
            odemesekligetir('#modalEdit #odeme_sekli','NAKİT');
            kurgetir('#modalEdit #kur','₺');
        });
    </script>
    <script>
        $('#example1' ).ready(function() {

        })
    </script>
    <script>
        function printDiv() {
            const divToPrint = document.getElementById('makbuzTable');
            const newWin = window.open("");

            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
@endsection

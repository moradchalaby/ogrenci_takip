$(document).ready(function () {
    //veri çekme

    $(function () {
        $('#example1_filter input').keyup(function (e) {
            alert('Handler for .keyup() called.');

            console.log('---');
            e.value = e.value.toLocaleUpperCase();
            console.log(e.value);
            /*
                          $('#example1')
                              .search(
                                  jQuery.fn.dataTable.ext.type.search.string(NeutralizeAccent(this.value))
                              )
                              .draw() */
        });
    });






    function hocagetir(id, veri) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: "{{ route('hafizlik.hocagetir') }}",
            data: {
                get_option: true
            },
            success: function (response) {

                $(id).html(response);

                $(id).val(veri);
            }

        });

    }



    function birimgetir(id, veri) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: "{{ route('hafizlik.birimgetir') }}",
            data: {
                get_option: true
            },
            success: function (response) {
                $(id).html(response);

                $(id).val(veri);
            }

        });

    }


    //hafizlik durum güncelleme
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#durumEdit').on("submit", function (e) {

        e.preventDefault();
        var form = $('#durumEdit')[0];
        var data = new FormData(form);

        $.ajax({

            url: "{{ route('hafizlik.durumguncel') }}",
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            dataType: 'text',


            success: (datam) => {
                var dat = JSON.parse(datam);
                $("#example1").DataTable().ajax.reload();

                $('#modalDurum').modal('hide');
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

                document.getElementById("durumEdit").reset();
            },
            error: function (data) {
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
                document.getElementById("durumEdit").reset();
            },
        });
        $("#durum option[value={{ $veri['durum'] }}]").attr("selected", "selected");
    })


    $('#ekleDers').on("submit", function (e) {

        e.preventDefault();
        var form = $('#ekleDers')[0];
        var data = new FormData(form);

        $.ajax({

            url: "{{ route('hafizlik.dersekle') }}",
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            dataType: 'text',


            success: (datam) => {
                var dat = JSON.parse(datam);
                $("#example1").DataTable().ajax.reload();

                $('#modalDersekle').modal('hide');
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

                document.getElementById("durumEdit").reset();
            },
            error: function (data) {
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
                document.getElementById("durumEdit").reset();
            },
        });
        $("#durum option[value={{ $veri['durum'] }}]").attr("selected", "selected");
    })
    $('.select2').select2({
        theme: 'bootstrap4',

    });

});

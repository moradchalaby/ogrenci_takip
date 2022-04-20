<?php

return [
    /*
     * DataTables JavaScript global namespace.
     */

    'namespace' => 'LaravelDataTables',

    /*
     * Default table attributes when generating the table.
     */
    'table' => [
        'class' => 'table table-bordered table-striped',
        'id'    => 'example1',
        'options' =>  '"bProcessing" : false',



        /*    "bProcessing" => true, */
        /*
            "language" => array(
                "buttons" =>
                array(
                    "colvis" => 'Sütun Seç',
                    "copy" => "Kopyala",
                    "print" => "Yazdır"
                ),


                "emptyTable" => "Tabloda veri yok",


                "infoFiltered" => "(Toplam _MAX_ kayıt.)",

                "lengthMenu" => "Gösterilen _MENU_",
                "loadingRecords" => "Yükleniyor...",
                "processing" => "İşleniyor...",
                "search" => "Arama=>",
                "zeroRecords" => "Eşleşen kayıt bulunamadı",
                "paginate" => array(
                    "first" => "İlk",
                    "last" => "Son",
                    "next" => "İleri",
                    "previous" => "Geri"
                ),
                "aria" => array(
                    "sortAscending" => ": sütunu artan şekilde sıralamak için etkinleştirin",
                    "sortDescending" => ": sütunu azalan sıralamak için etkinleştir"

                ),
            ), */
        /*  "responsive" => true, */
        /*  "lengthMenu" => [
                [-1, 10, 25, 50],
                ["Tümü", 10, 25, 50]
            ],
            "autoWidth" => true, ),*/
    ],

    /*
     * Default condition to determine if a parameter is a callback or not.
     * Callbacks needs to start by those terms or they will be casted to string.
     */
    'callback' => ['$', '$.', 'function'],

    /*
     * Html builder script template.
     */
    'script' => 'datatables::script',

    /*
     * Html builder script template for DataTables Editor integration.
     */
    'editor' => 'datatables::editor',
];
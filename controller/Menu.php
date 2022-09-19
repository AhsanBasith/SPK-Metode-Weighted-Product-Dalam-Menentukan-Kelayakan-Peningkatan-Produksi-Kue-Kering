<?php
if (isset($_GET['halaman'])) {
    $halaman = $_GET['halaman'];

    switch ($halaman) {
        case 'home':
            include "home/index.php";
            break;
        case 'dataproduk':
            include "produk/views.php";
            break;
        case 'tambahdataproduk':
            include "produk/add.php";
            break;
        case 'editdataproduk':
            include "produk/edit.php";
            break;
        case 'hapusdataproduk':
            include "produk/delete.php";
            break;
        case 'datakriteria':
            include "kriteria/views.php";
            break;
        case 'tambahdatakriteria':
            include "kriteria/add.php";
            break;
        case 'editdatakriteria':
            include "kriteria/edit.php";
            break;
        case 'hapusdatakriteria':
            include "kriteria/delete.php";
            break;
        case 'databobot':
            include "pembobotan/views.php";
            break;
        case 'tambahdatabobot':
            include "pembobotan/add.php";
            break;
        case 'editdatabobot':
            include "pembobotan/edit.php";
            break;
        case 'hapusdatabobot':
            include "pembobotan/delete.php";
            break;
        case 'datahasil':
            include "hasil/views.php";
            break;
    }
} else {
    include "home/index.php";
}

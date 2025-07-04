<?php
$page = (isset($_GET['page']))? $_GET['page'] : '';


// View without Login
switch($page){
        case "hasil":
                include 'views/laporan_penjualan/index.php';
            break;
        case "getdata":
            include 'views/data_penjualan/get_data.php';
            break;
        case "jenis_toko":
            include 'views/jenis_toko/index.php';
            break;
        case "ms_listing":
            include 'views/master_listing/index.php';
            break;
        case "week":
            include 'views/week_tanggal/index.php';
            break;
        case "tampil":
            include 'views/laporan_penjualan/index2.php';
        break;
    default:
    include 'views/laporan_penjualan/index.php';
    break;
}
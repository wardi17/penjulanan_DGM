<?php
//include library
require_once ("../../models/koneksi.php");
$connection =$database->open_connection();



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  $cek = 0;
  $valid = 0;
  $bulan = test_input($_POST["bulan"]);
  $tahun = test_input($_POST["tahun"]);
  $nama_toko = test_input($_POST["nama"]);
  $ml = test_input($_POST["ml"]);


  $query = " SELECT kode_barang,ket_barang FROM penjualan_listdetail  WHERE bulan ='".$bulan."' AND tahun= '".$tahun."' AND nama_toko ='".$nama_toko."' AND ml ='".$ml."' ";
  $result_set =odbc_exec($connection,$query);

    
  while (odbc_fetch_row($result_set)){
      $data[] = [
       "kode_barang" =>rtrim(odbc_result($result_set,'kode_barang')),
       "ket_barang" =>rtrim(odbc_result($result_set,'ket_barang')),

      ];
  }
 


//die(var_dump($datafull));
if(empty($data)){
  $data = null;

  echo json_encode($data);
}else{
  
  echo json_encode($data);
}



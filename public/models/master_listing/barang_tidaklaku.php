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



$st = 'N';
  $query = " SELECT DISTINCT kode_barang ,nama_barang,bulan_posting FROM master_listing_penjualan  WHERE status ='".$st."'";
  $result_set =odbc_exec($connection,$query);

    
  while (odbc_fetch_row($result_set)){
      $data[] = [
       "kode_barang" =>rtrim(odbc_result($result_set,'kode_barang')),
       "nama_barang" =>rtrim(odbc_result($result_set,'nama_barang')),
       "bulan_posting" =>rtrim(odbc_result($result_set,'bulan_posting')),

      ];
  }




if(empty($data)){
  $data = null;

  echo json_encode($data);
}else{
  
  echo json_encode($data);
}



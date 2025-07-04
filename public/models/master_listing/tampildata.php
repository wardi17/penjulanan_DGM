<?php
//include library
require_once ("../../models/koneksi.php");
$connection =$database->open_connection();





  $cek = 0;
  $valid = 0;





$query = "SELECT * FROM master_listing_penjualan  ORDER BY kode_barang ";
$result_set =odbc_exec($connection,$query);

while(odbc_fetch_row($result_set)){

 
  $data[] = array(
    "kode_barang"=>rtrim(odbc_result($result_set,'kode_barang')),
    "nama_barang"=>rtrim(odbc_result($result_set,'nama_barang')),
    "bulan_posting"=>rtrim(odbc_result($result_set,'bulan_posting')),
    "status"=>rtrim(odbc_result($result_set,'status')),

);


}


if(empty($data)){
  $data = null;

  echo json_encode($data);
}else{
  
  echo json_encode($data);
}


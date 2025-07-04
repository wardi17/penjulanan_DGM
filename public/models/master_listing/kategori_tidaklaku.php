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

;


$st ="N";


 

 
if($st){

  $query = "SELECT DISTINCT kode_barang FROM master_listing_penjualan  WHERE  status= '".$st."' ";
  $result_set =odbc_exec($connection,$query);


  while (odbc_fetch_row($result_set)){
      $data[] = [
      "kode_barang" =>rtrim(odbc_result($result_set,'kode_barang')),
      ];
   }

   $item = count($data);




if(empty($item)){
  $item = null;

  echo json_encode($item);
}else{
  
  echo json_encode($item);
}

}


function total_all($connection,$st){


  
}


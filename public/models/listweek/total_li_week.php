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
  $nama_toko = test_input($_POST["nama_toko"]);
  $li = test_input($_POST["li"]);

  $query = "SELECT COUNT(*) total FROM penjualan_list WHERE bulan ='".$bulan."' AND tahun= '".$tahun."' AND nama_toko ='".$nama_toko."'AND list ='".$li."'  ";
  $result_set =odbc_exec($connection,$query);
  
  $arr = odbc_fetch_array($result_set); 
  $total = $arr['total'];
 



if(empty($total)){
  $total = 0;

  echo json_encode($total);
}else{
  
  echo json_encode($total);
}



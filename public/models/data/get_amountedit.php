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
  $week = test_input($_POST["week"]);

    $query = "SELECT w1,w2,w3,w4 FROM penjualan  WHERE bulan ='".$bulan."' AND tahun= '".$tahun."' AND nama_toko ='".$nama_toko."'";
    $result_set =odbc_exec($connection,$query);
    $data =[];
    while(odbc_fetch_row($result_set)){
        $data[] = array(
            "w1"=>rtrim(odbc_result($result_set,'w1')),
            "w2"=>rtrim(odbc_result($result_set,'w2')),
            "w3"=>rtrim(odbc_result($result_set,'w3')),
            "w4"=>rtrim(odbc_result($result_set,'w4')),
        );
    }

    $dataweek ='';
foreach ($data as $item){
  
    if($week == "w1"){
      $amount_week = intval($item['w1']);
      $dataweek = $amount_week;
    }elseif($week == "w2"){
      $amount_week = intval($item['w2']);
      $dataweek = $amount_week;
    }elseif($week == "w3"){
      $amount_week = intval($item['w3']);
      $dataweek = $amount_week;
    }elseif($week == "w4"){
      $amount_week = intval($item['w4']);
      $dataweek = $amount_week;
    }
}
echo json_encode($dataweek);
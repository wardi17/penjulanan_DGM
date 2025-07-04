<?php

$cek = 0;
require_once ("../../models/koneksi.php");
$connection =$database->open_connection();



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_POST["wilayah"]) {
    $tahun = test_input($_POST["tahun"]);
    $bulan = test_input($_POST["bulan"]);
    $wilayah = test_input($_POST["wilayah"]);
    $tgl_awal = test_input($_POST["tgl_awal"]);
    $tgl_akhir = test_input($_POST["tgl_akhir"]);

   
    $sql="UPDATE [bulan_week] SET tgl_awal = '". $tgl_awal ."', tgl_akhir = '". $tgl_akhir ."' 
    WHERE tahun = '". $tahun ."' AND bulan = '". $bulan ."' AND wilayah = '". $wilayah ."'   "; 
      $result = odbc_exec($connection, $sql);
  
    if(!$result){
      $cek = $cek+1;
    }
    if ($cek==0){
      odbc_commit($connection);
      $status['nilai']=1; //bernilai benar
      $status['error']="Data Berhasil di edit";
    }else{
      odbc_rollback($connection);
      $status['nilai']=0; //bernilai benar
      $status['error']="Data Gagal di edit";
    }
    odbc_close($connection);
    echo json_encode($status);
  }

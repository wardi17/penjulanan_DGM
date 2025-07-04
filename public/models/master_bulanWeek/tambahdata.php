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

$tahun = test_input($_POST["tahun"]);
$bulan = test_input($_POST["bulan"]);
$wilayah = test_input($_POST["wilayah"]);
$tgl_awal = test_input($_POST["tgl_awal"]);
$tgl_akhir = test_input($_POST["tgl_akhir"]);

$cek = 0;
$valid = 0;
$dd = null;

if(isset($tahun)){
  $query = "SELECT DISTINCT * FROM bulan_week where  wilayah='$wilayah' AND  tahun='$tahun' AND bulan='$bulan'";
  $sql=odbc_exec($connection,$query);
  $rows= odbc_fetch_array($sql); 
 
  if($rows > 0){
        $valid=1;
    }
    if($valid == 0){
     $sql="INSERT INTO [bulan_week] (wilayah,tahun,bulan,tgl_awal,tgl_akhir) 
     Values ('". $wilayah ."','".$tahun."','".$bulan."','".$tgl_awal."','".$tgl_akhir."')"; 
    
     $result = odbc_exec($connection, $sql);
     if(!$result){
       $cek =$cek+1;
     }
   
     if ($cek==0){
       odbc_commit($connection);
       $status['nilai']=1; //bernilai benar
       $status['error']="Data Berhasil Ditambahkan";
     }else{
       odbc_rollback($connection);
       $status['nilai']=0; //bernilai benar
       $status['error']="Data Gagal di tambah";
     }
     odbc_close($connection);
   
   
 
    }
    else{
     $status['nilai']= 0; //bernilai salah
     $status['error']="data sudah ada ";
     }
 
     echo json_encode($status);

}else{
  $satuts = 0;

  echo json_encode($nilai);
}
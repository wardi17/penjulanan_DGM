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
if ($_POST["kode"] && $_POST["nama"]) {
    $bulan= test_input($_POST["bulan"]);
    $tahun= test_input($_POST["tahun"]);
    $li= test_input($_POST["li"]);
    $kode_barang= test_input($_POST["kode"]);

    $nama = test_input($_POST["nama"]);

   
    $sql="DELETE [penjualan_list] WHERE nama_toko = '". $nama ."' 
    AND tahun ='".$tahun."'  AND bulan ='".$bulan."' AND list ='".$li."' AND kode_barang ='".$kode_barang."'"; 
      $result = odbc_exec($connection, $sql);
  
    if(!$result){
      $cek = $cek+1;
    }
    if ($cek==0){
      odbc_commit($connection);
      $status['nilai']=1; //bernilai benar
      $status['error']="Data Berhasil di Hapus";
    }else{
      odbc_rollback($connection);
      $status['nilai']=0; //bernilai benar
      $status['error']="Data Gagal di Hapus";
    }
    odbc_close($connection);
    echo json_encode($status);
  }

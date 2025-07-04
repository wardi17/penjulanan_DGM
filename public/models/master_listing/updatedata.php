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
  $kode = test_input($_POST["kode"]);
  $nama = test_input($_POST["nama"]);
  $bulan_list = test_input($_POST["bulan_list"]);
  $status = test_input($_POST["status"]);

   
    $sql="UPDATE [master_listing_penjualan] SET status = '". $status ."', nama_barang = '". $nama ."', bulan_posting = '". $bulan_list ."'  WHERE kode_barang = '". $kode ."'";
      $result = odbc_exec($connection, $sql);
  
    if(!$result){
      $cek = $cek+1;
    }
    if ($cek==0){
      odbc_commit($connection);
      $st['nilai']=1; //bernilai benar
      $st['error']="Data Berhasil di edit";
    }else{
      odbc_rollback($connection);
      $st['nilai']=0; //bernilai benar
      $st['error']="Data Gagal di edit";
    }
    odbc_close($connection);
    echo json_encode($st);
  }

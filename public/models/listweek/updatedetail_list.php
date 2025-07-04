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
if ($_POST["kode_barang"] && $_POST["nama"]) {
    $bulan= test_input($_POST["bulan"]);
    $tahun= test_input($_POST["tahun"]);
    $ml= test_input($_POST["ml"]);
    $kode_barang= test_input($_POST["kode_barang"]);
    $ket= test_input($_POST["ket"]);

    $nama = test_input($_POST["nama"]);

 
    $sql="UPDATE [penjualan_listdetail] SET  kode_barang = '". $kode_barang ."', ket_barang = '". $ket ."'WHERE nama_toko = '". $nama ."' 
    AND tahun ='".$tahun."'  AND bulan ='".$bulan."' AND ml ='".$ml."' AND kode_barang ='".$kode_barang."'"; 
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

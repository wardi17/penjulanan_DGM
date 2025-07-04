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

  $kode = test_input($_POST["kode"]);
  $nama = test_input($_POST["nama"]);
  $bulan_list = test_input($_POST["bulan_list"]);
  $status = "N";



if($kode !==''){
  $sql="SELECT COUNT(*) AS kondisi FROM master_listing_penjualan WHERE kode_barang ='". $kode ."'";
  $validasi_data = odbc_exec($connection,$sql);
  $arr = odbc_fetch_array($validasi_data); 
  $rows = $arr['kondisi'];
 
    if($rows == 0){
        $sql2="INSERT INTO [master_listing_penjualan] (kode_barang,nama_barang,bulan_posting,status) Values(
            '".$kode."', '". $nama ."', '". $bulan_list."','".$status."')"; 
        $result = odbc_exec($connection, $sql2);
        odbc_commit($connection);
        $st['nilai']=1; //bernilai benar
        $st['error']="Data Berhasil Ditambahkan";
      }else{
          odbc_rollback($connection);
          $st['nilai']=0; //bernilai benar
          $st['error']="Kode barang sudah ada";
      }
      odbc_close($connection);
      echo json_encode($st);
}else{
  $st['nilai']=0; //bernilai benar
  $st['error']="Kode_ barang tidak boleh kosong";
  odbc_close($connection);
  
echo json_encode($st);
}




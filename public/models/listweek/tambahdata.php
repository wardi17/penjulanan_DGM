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
  $kode_barang = test_input($_POST["kode"]);
  $ket_barang = test_input($_POST["ket"]);
  $nama_toko = test_input($_POST["nama_toko"]);
  $wilayah = test_input($_POST["wilayah"]);
  $li = test_input($_POST["li"]);


if($kode_barang !==''){
  $sql="SELECT COUNT(*) AS kondisi FROM penjualan_list WHERE nama_toko ='". $nama_toko ."' AND bulan ='". $bulan ."' AND tahun ='". $tahun ."' AND  kode_barang ='". $kode_barang ."'
  AND  wilayah ='". $wilayah ."'
  ";
  $validasi_data = odbc_exec($connection,$sql);
  $arr = odbc_fetch_array($validasi_data); 
  $rows = $arr['kondisi'];
    if($rows == 0){
        $sql2="INSERT INTO [penjualan_list] (nama_toko, bulan,tahun,kode_barang,ket_barang,wilayah,list) Values (
            '". $nama_toko ."', '". $bulan ."', '". $tahun ."', '". $kode_barang."','".$ket_barang."','". $wilayah."','". $li."')"; 
        $result = odbc_exec($connection, $sql2);
        odbc_commit($connection);
        $status['nilai']= 1; //bernilai benar
        $status['error']="Data Berhasil Ditambahkan";
      }else{
      
        odbc_commit($connection);
          $status['nilai']=0; //bernilai benar
          $status['error']="Kode barang sudah ada";
      }
      odbc_close($connection);
      echo json_encode($status);
}else{
  $status['nilai']=0; //bernilai benar
  $status['error']="Kode_ barang tidak boleh kosong";
  odbc_close($connection);
  
echo json_encode($status);
}




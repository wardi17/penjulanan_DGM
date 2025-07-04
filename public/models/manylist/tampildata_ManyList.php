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
  $nama_toko = test_input($_POST["id"]);
  $kode_ml = test_input($_POST["kode_ml"]);

$query = "SELECT bulan,tahun,nama_toko,kode_barang,nama_barang,ket_barang,ml,qty FROM penjualan_listdetail  WHERE bulan ='".$bulan."' AND tahun= '".$tahun."' AND nama_toko ='".$nama_toko."' AND ml= '".$kode_ml."'  ";
$result_set =odbc_exec($connection,$query);
$item =[];
while(odbc_fetch_row($result_set)){

 
  $item[] = array(
    "bulan"=>rtrim(odbc_result($result_set,'bulan')),
    "tahun"=>rtrim(odbc_result($result_set,'tahun')),
    "nama_toko"=>rtrim(odbc_result($result_set,'nama_toko')),
    "kode_barang"=>rtrim(odbc_result($result_set,'kode_barang')),
    "nama_barang"=>rtrim(odbc_result($result_set,'nama_barang')),
    "ket_barang"=>rtrim(odbc_result($result_set,'ket_barang')),
    "ml"=>rtrim(odbc_result($result_set,'ml')),
    "qty"=>number_format(odbc_result($result_set,'qty'),((int) "qty" == "qty" ? 0 : 2), '.', '.'),

);


}
$dfull =[];
  foreach($item as $datas){
      $dfull[] =[
        "bulan" => $datas['bulan'],
        "tahun" =>$datas['tahun'],
        "nama_toko" => $datas['nama_toko'],
        "kode_barang" =>$datas['kode_barang'],
        "nama_barang" =>$datas['nama_barang'],
        "ket_barang" => $datas['ket_barang'],
        "ml" =>$datas['ml'],
        "qty" =>$datas['qty'],
       // "total_ml" =>total_data($connection,$bulan,$tahun,$kode_ml),
      ];
  }


if(empty($dfull)){
  $dfull = null;

  echo json_encode($dfull);
}else{
  
  echo json_encode($dfull);
}

// function total_data($connection,$bulan,$tahun,$kode_ml){

// }
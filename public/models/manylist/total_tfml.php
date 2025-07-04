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

;

$data = test_input($_POST['data']);

  $tahun = date("Y");
 
if($data == 'All'){
  $nama_toko = $data;
    $query = " SELECT DISTINCT kode_barang ,nama_barang FROM penjualan_listdetail  WHERE tahun= '".$tahun."'";
    $result_set =odbc_exec($connection,$query);
}else{
  $nama_toko = $data;
    $query = " SELECT DISTINCT kode_barang ,nama_barang FROM penjualan_listdetail  WHERE tahun= '".$tahun."' AND nama_toko ='".$nama_toko."'";
    $result_set =odbc_exec($connection,$query);
}
    $datas =[];
  while (odbc_fetch_row($result_set)){
      $datas[] = [
       "kode_barang" =>rtrim(odbc_result($result_set,'kode_barang')),
       "nama_barang" =>rtrim(odbc_result($result_set,'nama_barang')),
      ];
  }

  $fuldata = array_filter($datas, function($item){
    static $ids = array();
    $kode = $item["kode_barang"];
    if (in_array($kode, $ids)) {
	
        return false;
    } else {
        $ids[] = $kode;
        return true;
    }
  });
 
  $datafull = [];
  foreach($fuldata as $cekdata){
    $datafull[] =[
      'kode'=>$cekdata["kode_barang"],
      'nama' =>$cekdata['nama_barang'],
      'qty'=>total_qty($connection,$tahun,$nama_toko,$cekdata["kode_barang"]),
    ];
}

if(empty($datafull)){
  $datafull = null;

  echo json_encode($datafull);
}else{
  
  echo json_encode($datafull);
}



function total_qty($connection,$tahun,$nama_toko,$kode_barang){
  
  if($nama_toko !== 'All'){
    $sql ="SELECT SUM(qty) as total FROM penjualan_listdetail  
    WHERE  tahun= '".$tahun."' AND nama_toko ='".$nama_toko."' AND kode_barang ='".$kode_barang."'";
      $result_set =odbc_exec($connection,$sql);
      $item = odbc_fetch_array($result_set);
      $total = $item['total'];
      $number =intval($total);
      return $number;
  }else{
    $sql ="SELECT SUM(qty) as total FROM penjualan_listdetail  
    WHERE  tahun= '".$tahun."' AND kode_barang ='".$kode_barang."'";
      $result_set =odbc_exec($connection,$sql);
      $item = odbc_fetch_array($result_set);
      $total = $item['total'];
      $number =intval($total);
      return $number;
  }

}


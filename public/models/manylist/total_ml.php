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
  $nama_toko = test_input($_POST["nama"]);


  $query = " SELECT DISTINCT kode_barang ,nama_barang FROM penjualan_listdetail  WHERE bulan ='".$bulan."' AND tahun= '".$tahun."' AND nama_toko ='".$nama_toko."'";
  $result_set =odbc_exec($connection,$query);

    
  while (odbc_fetch_row($result_set)){
      $data[] = [
       "kode_barang" =>rtrim(odbc_result($result_set,'kode_barang')),
       "nama_barang" =>rtrim(odbc_result($result_set,'nama_barang')),
      ];
  }

  $fuldata = array_filter($data, function($item){
    static $ids = array();
    $kode = $item["kode_barang"];
    if (in_array($kode, $ids)) {
	
        return false;
    } else {
        $ids[] = $kode;
        return true;
    }
  });


foreach($fuldata as $cekdata){
    $datafull[] =[
      'kode'=>$cekdata["kode_barang"],
      'nama' =>$cekdata['nama_barang'],
      'qty'=>format_qty(total_qty($connection,$bulan,$tahun,$nama_toko,$cekdata["kode_barang"])),
    ];
}

if(empty($datafull)){
  $datafull = null;

  echo json_encode($datafull);
}else{
  
  echo json_encode($datafull);
}


function total_qty($connection,$bulan,$tahun,$nama_toko,$kode_barang){
  $sql ="SELECT SUM(qty) as total FROM penjualan_listdetail  
  WHERE bulan ='".$bulan."' AND tahun= '".$tahun."' AND nama_toko ='".$nama_toko."' AND kode_barang ='".$kode_barang."'";
    $result_set =odbc_exec($connection,$sql);
    $item = odbc_fetch_array($result_set);
    $total = $item['total'];
    return $total;

}

function  format_qty($qty){
$foramt = number_format($qty);
return $foramt;
}
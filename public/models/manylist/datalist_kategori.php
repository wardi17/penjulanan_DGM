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


$tahun = test_input($_POST['tahun']);


 

 
if($tahun){


  $query = "SELECT nama_toko FROM master_jenis_toko  ORDER BY kode_jenis ASC";
//$result_set =odbc_exec($connection,$query);
$result2 = odbc_exec($connection,$query);

while(odbc_fetch_row($result2)){

    $data[] = array(
        rtrim(odbc_result($result2,'nama_toko')),
      

    );
    
    }

    //$array_push = array_push($data,"All");
  
    $json = json_encode($data);
     
    $str_replace = str_replace("["," ",$json);
    $str_replace2 = str_replace("]"," ",$str_replace);
    $str_replace3 = str_replace('"','',$str_replace2);
   
    //$str_replace5 = str_replace(',',',"',$str_replace4);
 
  
    $str_expoload = explode(",",$str_replace3);
    $array_map =array_map('trim', $str_expoload);
    //$array_push = array_push($array_map,"All");
    $array_map[] = "ALL";
    $array_map[] = "RIZEK";
 $data_jenis = $array_map;


 foreach($data_jenis as $item){
      $datafull[]= [
        $item => trim(total_data($connection,$tahun,$item))
      ];
 }

 $sub_tring =json_encode($datafull);
 $str = str_replace("["," ",$sub_tring);
 $str1 = str_replace("]"," ",$str);
 $str2 = str_replace('},{',',',$str1);
  $str3 = str_replace(' {','{',$str2); 
  $str4 = str_replace('} ','}',$str3);
  $str5 = str_replace('"','',$str4);
  $str6 = str_replace('},{','',$str5);
  $str7 = str_replace('{','{"',$str6);
  $str8 = str_replace(':','":"',$str7);
  $str9 = str_replace(',','","',$str8);
  $str10 = str_replace('}','"}',$str9);


 $json_decode = json_decode($str10,true);

if(empty($json_decode)){
  $json_decode = null;
  echo json_encode($json_decode);
}else{
  echo json_encode($json_decode);
}

}


function total_data($connection,$tahun,$item){
  if($item == "ALL"){
    $query = "SELECT DISTINCT kode_barang FROM penjualan_listdetail  WHERE  tahun= '".$tahun."' ";
    $result_set =odbc_exec($connection,$query);
    $data =[]; 
    while (odbc_fetch_row($result_set)){
        $data[] = [
        "kode_barang" =>rtrim(odbc_result($result_set,'kode_barang')),
        ];
     }
     $item = count($data);
     return  $item;
  }
  elseif($item !=="RIZEK"){
    $query = "SELECT DISTINCT kode_barang FROM penjualan_listdetail  WHERE  tahun= '".$tahun."' AND nama_toko ='".$item."'";
    $result_set =odbc_exec($connection,$query);
    $data =[]; 
    while (odbc_fetch_row($result_set)){
        $data[] = [
        "kode_barang" =>rtrim(odbc_result($result_set,'kode_barang')),
        ];
    }
    $item = count($data);
    return  $item;
  }else{
      $st ="N";
    if($st){
      $query = "SELECT DISTINCT kode_barang FROM master_listing_penjualan  WHERE  status= '".$st."' ";
      $result_set =odbc_exec($connection,$query);
	  $data =[];
      while (odbc_fetch_row($result_set)){
          $data[] = [
          "kode_barang" =>rtrim(odbc_result($result_set,'kode_barang')),
          ];
      }
      $item = count($data);
      return $item;
      }

  }

}
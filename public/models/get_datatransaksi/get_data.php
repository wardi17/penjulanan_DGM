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


session_start();
$user_log = $_SESSION['login_user'];
$tgl_user = date('Y-m-d');

$thn = test_input($_POST["thn"]);

$bln = test_input($_POST["bln"]);
$nama_toko = test_input($_POST["nama_toko"]);
$week  = test_input($_POST['week']);

//get tanggal  week
  $query_week = "SELECT * FROM bulan_week WHERE tahun ='".$thn."' AND bulan ='".$bln."' AND wilayah ='".$week."' ";
  $result2 = odbc_exec($connection,$query_week);
  $data =[];
  while(odbc_fetch_row($result2)){
      $data[] = array(
          "wilayah"=>rtrim(odbc_result($result2,'wilayah')),
          "tahun"=>rtrim(odbc_result($result2,'tahun')),
          "bulan"=>rtrim(odbc_result($result2,'bulan')),
          "tgl_awal"=>rtrim(odbc_result($result2,'tgl_awal')),
          "tgl_akhir"=>rtrim(odbc_result($result2,'tgl_akhir')),
      );
      
      }

$tgl_awal = "";
$tgl_akhir = "";
  foreach($data as $item){
          $tgl_awal = Tanggalformat($item['tahun'], $item['bulan'], $item['tgl_awal']);
          $tgl_akhir = Tanggalformat($item['tahun'], $item['bulan'], $item['tgl_akhir']);
  
      }

//end get dat week


$tanggal_awal = strtotime($tgl_awal);
$start_date = date('Y-m-d',$tanggal_awal);
$tanggal_akhir = strtotime($tgl_akhir);
$end_date = date('Y-m-d',$tanggal_akhir);
$tahun = date('Y',$tanggal_awal);
$bulan = date('F',$tanggal_awal);

$emount = odbc_exec($connection,"get_penjualan_emount'$start_date','$end_date','$nama_toko'");

$arr = odbc_fetch_array($emount); 
$rowtotal = $arr['total_presen'];


$dataArray =[
  'tahun' =>$tahun,
  'bulan' =>$bulan,
  'amount' => round($rowtotal)
];



// $sql="SELECT COUNT(*) AS kondisi FROM history_get_penjualan WHERE 
// nama_toko ='". $nama_toko ."' AND bulan ='". $bulan ."' AND tahun ='". $tahun ."' 
// AND tanggal_awal ='". $tgl_awal ."' AND tanggal_akhir ='". $tgl_akhir ."' AND wilayah ='".$week."' ";
// $validasi_data = odbc_exec($connection,$sql);
// $arr = odbc_fetch_array($validasi_data); 
// $rows = $arr['kondisi'];

// if($rows == 0){
//   $query = "INSERT INTO  history_get_penjualan(nama_toko,wilayah,tanggal_awal,tanggal_akhir,user_log,tgl_user,tahun,bulan) VALUES(
//     '".$nama_toko."', '".$week."','".$tgl_awal."','".$tgl_akhir."','".$user_log."','".$tgl_user."','".$tahun."','".$bulan."') ";
  
//   $result = odbc_exec($connection, $query);
//   odbc_commit($connection);
// }else{
//   $query1 ="DELETE FROM  history_get_penjualan  WHERE 
//   nama_toko ='". $nama_toko ."' AND bulan ='". $bulan ."' AND tahun ='". $tahun ."' 
//   AND tanggal_awal ='". $tgl_awal ."' AND tanggal_akhir ='". $tgl_akhir ."' AND wilayah ='".$week."' ";
//   $result = odbc_exec($connection, $query1);

// $query = "INSERT INTO  history_get_penjualan(nama_toko,wilayah,tanggal_awal,tanggal_akhir,user_log,tgl_user,tahun,bulan) VALUES(
//   '".$nama_toko."', '".$week."','".$tgl_awal."','".$tgl_akhir."','".$user_log."','".$tgl_user."','".$tahun."','".$bulan."') ";

// $result = odbc_exec($connection, $query);
// odbc_commit($connection);
// }



if(empty($dataArray)){
    $dataArray = null;
  
    echo json_encode($dataArray);
  }else{
    
    echo json_encode($dataArray);
  }
    
   
 
  function Tanggalformat($tahun,$bulan,$tgl){
    
    $bln = Rubah_Bulan($bulan);
    
    $tanggal = $tgl."-".$bln."-".$tahun;
    $date = strtotime($tanggal);
    $str_data = date("Y/m/d",$date);
  
    return $str_data;
}


function Rubah_Bulan($bulan)
{
  Switch ($bulan){
    case  "January": 
      $bulan=1;
        Break;
    case "February" : 
      $bulan= 2;
        Break;
    case "March" : 
      $bulan= 3;
        Break;
    case "April" : 
      $bulan= 4;
        Break;
    case "May" : 
      $bulan= 5;
        Break;
    case "June" : 
      $bulan= 6 ;
        Break;
    case "July" : 
      $bulan= 7;
        Break;
    case "August" : 
      $bulan= 8;
        Break;
    case "September": 
      $bulan= 9;
        Break;
    case "October" : 
      $bulan=10;
        Break;
    case "November" : 
      $bulan= 11;
        Break;
    case "December" : 
      $bulan= 12;
        Break;
    }
  return $bulan;
}

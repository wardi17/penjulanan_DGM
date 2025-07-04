<?php 


require_once ("../../models/koneksi.php");
$conn =$database->open_connection();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };
  

$tahun = test_input($_POST['tahun']);
$bulanpage = test_input($_POST['bulan']);


$query = "SELECT TOP 4 bulan_angka,bulan FROM bulan_executive where bulan_angka<='".$bulanpage."' ORDER BY bulan_angka DESC";
$result =odbc_exec($conn,$query);
while($arr = odbc_fetch_array($result)){
  $bln_k[] = $arr;
}; 

foreach($bln_k as $bln){

  $bulan = $bln['bulan_angka'];
  $bln_h = $bln['bulan'];
  if($bulan == 1){
    $total= data_jenis($conn,$tahun,$bulan);
    $data_full [] =[
      'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ] ;
  }
  if($bulan == 2){
    $total= data_jenis($conn,$tahun,$bulan);
    $data_full [] =[
      'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ] ;
  }
  if($bulan == 3){
    $total= data_jenis($conn,$tahun,$bulan);
    $data_full [] =[
      'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ] ;
  }
  if($bulan == 4){
    $total= data_jenis($conn,$tahun,$bulan);
    $data_full [] =[
      'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ] ;
  }
  if($bulan == 5){
    $total= data_jenis($conn,$tahun,$bulan);
    $data_full [] =[
      'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ] ;
  }
  if($bulan == 6){
    $total= data_jenis($conn,$tahun,$bulan);
    $data_full [] =[
      'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ];
  }
  if($bulan == 7){
    $total= data_jenis($conn,$tahun,$bulan);
 $data_full [] =[
  'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ];
  }
  if($bulan == 8){
    $total= data_jenis($conn,$tahun,$bulan);
 $data_full [] =[
  'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ];
  }
  if($bulan == 9){
    $total= data_jenis($conn,$tahun,$bulan);
 $data_full [] =[
  'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ];
  }
  if($bulan == 10){
    $total= data_jenis($conn,$tahun,$bulan);
 $data_full [] =[
  'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ];
  }
  if($bulan == 11){
    $total= data_jenis($conn,$tahun,$bulan);
 $data_full [] =[
  'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ];
  }
  if($bulan == 12){
    $total= data_jenis($conn,$tahun,$bulan);
 $data_full [] =[
  'bulan_h' =>$bln_h,
      'bulan' =>$bulan,
      'data'  =>$total
    ];
  }
}

if(empty($data_full)){
  $data_full = null;

  echo json_encode($data_full);
}else{
  
  echo json_encode($data_full);
}










function data_jenis($conn,$tahun,$bulan){
  $query2 = "SELECT nama_jenis_eo FROM master_jenis_eo ORDER BY nama_jenis_eo DESC";
  $result2 =odbc_exec($conn,$query2);
  while($arr = odbc_fetch_array($result2)){
    $kategory[] = $arr['nama_jenis_eo'];
  };
 
        foreach($kategory as $ktg){
          $total = total_execut($conn,$tahun,$bulan,$ktg);
          //$totalful = total_executfull($conn,$tahun,$bulan);
            $datas[] =[
              $ktg =>$total,
              
            ];
              

          }
          return $datas;
  }


 




  function total_execut($conn,$tahun,$bulan,$ktg){
    $sql =" SELECT COUNT(tanggal) as jml FROM transaksi_executive WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal) ='".$bulan."'AND jenis_eo='".$ktg."'  ";
    $result = odbc_exec($conn,$sql);
    $arr = odbc_fetch_array($result); 
    $jml= $arr['jml'];
      return $jml;
  
  }
// function total_executfull($conn,$tahun,$bulan){
//   $sql =" SELECT COUNT(tanggal) as jml FROM transaksi_executive WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal) ='".$bulan."' ";
//   $result = odbc_exec($conn,$sql);
//   $arr = odbc_fetch_array($result); 
//   $full= $arr['jml'];

//     return $full;
// }
 

  
  function bulan($bulan){
            Switch ($bulan){
              case 1 : $bulan="Januari";
                  Break;
              case 2 : $bulan="Februari";
                  Break;
              case 3 : $bulan="Maret";
                  Break;
              case 4 : $bulan="April";
                  Break;
              case 5 : $bulan="Mei";
                  Break;
              case 6 : $bulan="Juni";
                  Break;
              case 7 : $bulan="Juli";
                  Break;
              case 8 : $bulan="Agustus";
                  Break;
              case 9 : $bulan="September";
                  Break;
              case 10 : $bulan="Oktober";
                  Break;
              case 11 : $bulan="November";
                  Break;
              case 12 : $bulan="Desember";
                  Break;
              }
            return $bulan;
        }         

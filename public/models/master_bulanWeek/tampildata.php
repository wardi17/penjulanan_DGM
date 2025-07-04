<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();


  //$query = "SELECT wilayah,tahun,bulan,tgl_awal,tgl_akhir FROM bulan_week  ORDER BY  tahun DESC";
  $query="SP_TampilWeekList";
$result2 = odbc_exec($connection,$query);
while(odbc_fetch_row($result2)){
    $data[] = array(
        "wilayah"=>rtrim(odbc_result($result2,'wilayah')),
        "tahun"=>rtrim(odbc_result($result2,'tahun')),
        "bulan"=>rtrim(odbc_result($result2,'bulan')),
        "tgl_awal"=>rtrim(odbc_result($result2,'tgl_awal')),
        "tgl_akhir"=>rtrim(odbc_result($result2,'tgl_akhir')),
    );
    
    }
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // die();
 

    foreach($data as $item){
      $fulldata []=[
        'wilayah'=> $item['wilayah'],
        'tahun'=> $item['tahun'],
        'bulan'=> $item['bulan'],
        'tgl_awal'=> Tanggalformat($item['tahun'], $item['bulan'], $item['tgl_awal']),
        'tgl_akhir'=> Tanggalformat($item['tahun'], $item['bulan'], $item['tgl_akhir']),

      ];
      
    }
 


 
if(empty($fulldata)){
    $fulldata = null;
  
    echo json_encode($fulldata);
  }else{
    
    echo json_encode($fulldata);
  }


  function Tanggalformat($tahun,$bulan,$tgl){
    
      $bln = Rubah_Bulan($bulan);
      
      $tanggal = $tgl."-".$bln."-".$tahun;
      $date = strtotime($tanggal);
      $str_data = date("d/m/Y",$date);
    
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
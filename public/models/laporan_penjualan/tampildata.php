<?php

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();




//die(var_dump($_POST));

$bulanpage =$_POST['page'];
$tahunpage = $_POST['tahun'];
$bulan_trakhir = $_POST["bulan_trakhir"];
//$query ="SELECT bulan,tahun,nama_toko,w1,w2,w3,w4,l1,l2,l3,l4,target,ml1,ml2,ml3,ml4,l0,ach FROM penjualan  WHERE bulan ='March' AND  tahun= '2024' ORDER BY bulan ASC";
$query = "SELECT bulan,tahun,nama_toko,w1,w2,w3,w4,l1,l2,l3,l4,target,ml1,ml2,ml3,ml4,l0,ach FROM penjualan  WHERE bulan ='".$bulanpage."' AND  tahun= '".$tahunpage."' ORDER BY bulan ASC, nama_toko DESC ";
$result_set =odbc_exec($connection,$query);

$data =[];
while(odbc_fetch_row($result_set)){

 
  $data[] = array(
    // "growth"=>rtrim(odbc_result($result_set,'growth')),
    "bulan"=>rtrim(odbc_result($result_set,'bulan')),
    "tahun"=>rtrim(odbc_result($result_set,'tahun')),
    "nama_toko"=>rtrim(odbc_result($result_set,'nama_toko')),
   // "w1"=>rtrim(odbc_result($result_set,'w1')),
    "w1"=>round(odbc_result($result_set,'w1')),
    "w2"=>round(odbc_result($result_set,'w2')),
    "w3"=>round(odbc_result($result_set,'w3')),
    "w4"=>round(odbc_result($result_set,'w4')),

    "l0"=>number_format(odbc_result($result_set,'l0'),((int) "l0" == "l0" ? 0 : 2), '.', '.'),
    "l1"=>rtrim(odbc_result($result_set,'l1')),
    "l2"=>rtrim(odbc_result($result_set,'l2')),
    "l3"=>rtrim(odbc_result($result_set,'l3')),
    "l4"=>rtrim(odbc_result($result_set,'l4')),

   // "total"=>rtrim(odbc_result($result_set,'total')),
    "target"=>rtrim(odbc_result($result_set,'target')),
	 "ach"=>rtrim(odbc_result($result_set,'ach')),



    "ml1"=>rtrim(odbc_result($result_set,'ml1')),
    "ml2"=>rtrim(odbc_result($result_set,'ml2')),
    "ml3"=>rtrim(odbc_result($result_set,'ml3')),
    "ml4"=>rtrim(odbc_result($result_set,'ml4'))


);


}


$fulldata =[];
foreach ($data as $datas){
  $fulldata [] = [
    'growth'=>getgrowth($connection,$datas['nama_toko'],$bulanpage,$tahunpage),
    'bulan'=>$datas['bulan'],
    'tahun'=>$datas['tahun'],
    'nama_toko'=>$datas['nama_toko'],
    'w1'=>formatweek($datas['w1']),
    'w2'=>formatweek($datas['w2']),
    'w3'=>formatweek($datas['w3']),
    'w4'=>formatweek($datas['w4']),
    'l0'=> $datas['l0'],
   'l1'=> get_nilai_List($connection,$tahunpage,$bulanpage,$datas['l1'],$datas['nama_toko']),
   'l2'=> get_nilai_List($connection,$tahunpage,$bulanpage,$datas['l2'],$datas['nama_toko']),
   'l3'=> get_nilai_List($connection,$tahunpage,$bulanpage,$datas['l3'],$datas['nama_toko']),
   'l4'=> get_nilai_List($connection,$tahunpage,$bulanpage,$datas['l4'],$datas['nama_toko']),
   'total'=>get_total($connection,$datas['nama_toko'],$bulanpage,$tahunpage),
    //'target'=> intval($datas['target']),
	 'target'=>(4 *intval($datas['target'])),
	 //'ach'=>$datas['ach'],
    'ach'=> get_nilai_ach($connection,$datas['nama_toko'],$bulanpage,$tahunpage),
    'lt'=> get_nilai_lt($connection,$datas['nama_toko'],$bulanpage,$tahunpage),

   'ml1'=> get_nilaiMl($connection,$tahunpage,$bulanpage,$datas['ml1'],$datas['nama_toko']),

   'ml2'=> get_nilaiMl($connection,$tahunpage,$bulanpage,$datas['ml2'],$datas['nama_toko']),

  
   'ml3'=> get_nilaiMl($connection,$tahunpage,$bulanpage,$datas['ml3'],$datas['nama_toko']),
    'ml4'=> get_nilaiMl($connection,$tahunpage,$bulanpage,$datas['ml4'],$datas['nama_toko']),

   'fml'=> total_ml($connection,$tahunpage,$bulanpage,$datas['nama_toko']),
   
   'maxweek1'=>getmaxt($connection,$tahunpage,$datas['nama_toko'],"w1"),
	'maxweek2'=>getmaxt($connection,$tahunpage,$datas['nama_toko'],"w2"),
    'maxweek3'=>getmaxt($connection,$tahunpage,$datas['nama_toko'],"w3"),
    'maxweek4'=>getmaxt($connection,$tahunpage,$datas['nama_toko'],"w4"),
	'weekmaxt'=>WeekMax($connection,$datas['nama_toko'],$tahunpage),
	'totalmaxt'=>totalMaxt($connection,$tahunpage,$datas['nama_toko']),
  ];
}

$querysp ="SP_GetTotalGabungan_DGM '".$tahunpage."','".$bulanpage."' ";
$result_sp =odbc_exec($connection,$querysp);
$arraytotal =[];
while(odbc_fetch_row($result_sp)){

 
  $arraytotal=[
    "growth"=>rtrim(odbc_result($result_sp,'growth')),
    "bulan"=>rtrim(odbc_result($result_sp,'bulan')),
    "tahun"=>rtrim(odbc_result($result_sp,'tahun')),
    "nama_toko"=>rtrim(odbc_result($result_sp,'nama_toko')),
    "w1"=>formatweek(odbc_result($result_sp,'w1')).'_tot',
    "w2"=>formatweek(odbc_result($result_sp,'w2')).'_tot',
    "w3"=>formatweek(odbc_result($result_sp,'w3')).'_tot',
    "w4"=>formatweek(odbc_result($result_sp,'w4')).'_tot',

    "l0"=>number_format(odbc_result($result_sp,'l0'),((int) "l0" == "l0" ? 0 : 2), '.', '.'),
    "l1"=>rtrim(odbc_result($result_sp,'l1')).'_tot',
    "l2"=>rtrim(odbc_result($result_sp,'l2')).'_tot',
    "l3"=>rtrim(odbc_result($result_sp,'l3')).'_tot',
    "l4"=>rtrim(odbc_result($result_sp,'l4')).'_tot',
    
   "total"=>formatweek(rtrim(odbc_result($result_sp,'total'))),
    "target"=>rtrim(odbc_result($result_sp,'target')),
	 "ach"=>formatweek(rtrim(odbc_result($result_sp,'ach'))),
   "lt"=>formatweek(rtrim(odbc_result($result_sp,'lt'))),
   "fml"=>formatweek(rtrim(odbc_result($result_sp,'fml'))).'_tot',
    "ml1"=>rtrim(odbc_result($result_sp,'ml1')).'_tot',
    "ml2"=>rtrim(odbc_result($result_sp,'ml2')).'_tot',
    "ml3"=>rtrim(odbc_result($result_sp,'ml3')).'_tot',
    "ml4"=>rtrim(odbc_result($result_sp,'ml4')).'_tot',
    "subtotalmax"=>formatweek(rtrim(odbc_result($result_sp,'subtotalmax')))
  ];


}
// echo "<pre>";
// print_r($arraytotal);
// echo "</pre>";
// die(); 
 
array_push($fulldata,$arraytotal);

if($bulan_trakhir !=="0"){
  $getntotal =Get_GranTotal($connection,$tahunpage,$bulanpage);
  array_push($fulldata,$getntotal);

}
if(empty($fulldata)){
  $fulldata = null;

  echo json_encode($fulldata);
}else{
  
  echo json_encode($fulldata);
}



function Get_GranTotal($conn,$tahun,$bulan){




  $query ="SP_TampilDataGrainTotal_DGM '".$tahun."','".$bulan."'";
  $result_sp =odbc_exec($conn,$query);
  $arraytotal =[];
  while(odbc_fetch_row($result_sp)){
  
   
    $arraytotal=[
      "growth"=>rtrim(odbc_result($result_sp,'growth')),
      "bulan"=>rtrim(odbc_result($result_sp,'bulan')),
      "tahun"=>rtrim(odbc_result($result_sp,'tahun')),
      "nama_toko"=>rtrim(odbc_result($result_sp,'nama_toko')),
      "w1"=>formatweek(odbc_result($result_sp,'w1')).'_tot',
      "w2"=>formatweek(odbc_result($result_sp,'w2')).'_tot',
      "w3"=>formatweek(odbc_result($result_sp,'w3')).'_tot',
      "w4"=>formatweek(odbc_result($result_sp,'w4')).'_tot',
  
      "l0"=>number_format(odbc_result($result_sp,'l0'),((int) "l0" == "l0" ? 0 : 2), '.', '.'),
      "l1"=>rtrim(odbc_result($result_sp,'l1')).'_tot',
      "l2"=>rtrim(odbc_result($result_sp,'l2')).'_tot',
      "l3"=>rtrim(odbc_result($result_sp,'l3')).'_tot',
      "l4"=>rtrim(odbc_result($result_sp,'l4')).'_tot',
      
     "total"=>formatweek(rtrim(odbc_result($result_sp,'total'))),
      "target"=>rtrim(odbc_result($result_sp,'target')),
     "ach"=>formatweek(rtrim(odbc_result($result_sp,'ach'))),
     "lt"=>formatweek(rtrim(odbc_result($result_sp,'lt'))),
     "fml"=>formatweek(rtrim(odbc_result($result_sp,'fml'))).'_tot',
      "ml1"=>rtrim(odbc_result($result_sp,'ml1')).'_tot',
      "ml2"=>rtrim(odbc_result($result_sp,'ml2')).'_tot',
      "ml3"=>rtrim(odbc_result($result_sp,'ml3')).'_tot',
      "ml4"=>rtrim(odbc_result($result_sp,'ml4')).'_tot',
    ];
  
  
  }
// echo "<pre>";
// print_r($arraytotal);
// echo "</pre>";
// die(); 
 
  return $arraytotal;

}
function formatweek($dataWeek){
      $d_bagi = floatval($dataWeek) / 1000; 
    // $round = round($d_bagi);
      $formatted_number = number_format($d_bagi,0, ',', ',');
    return $formatted_number;
}

function get_nilaiMl($connection,$tahunpage,$bulanpage,$d_ml,$n_toko){
  $query = "SELECT COUNT(*) total FROM penjualan_listdetail  WHERE bulan ='".$bulanpage."' AND tahun= '".$tahunpage."' AND nama_toko ='".$n_toko."'AND ml ='".$d_ml."'  ";
  $result_set =odbc_exec($connection,$query);
  $arr = odbc_fetch_array($result_set); 
  $total = $arr['total'];
  return $total;

  
}  

function total_ml($connection,$tahunpage,$bulanpage,$n_toko){
  $result_set =odbc_exec($connection,"total_full_ml '$tahunpage','$bulanpage','$n_toko'");
  
  $full_ml = odbc_fetch_array($result_set); 
  
  $data = $full_ml['full_ml'];
  return $data;
}

function get_nilai_List($connection,$tahunpage,$bulanpage,$list,$n_toko){
  $query = "SELECT COUNT(*) total FROM penjualan_list  WHERE bulan ='".$bulanpage."' AND tahun= '".$tahunpage."' AND nama_toko ='".$n_toko."'AND list ='".$list."'  ";
  $result_set =odbc_exec($connection,$query);
  $arr = odbc_fetch_array($result_set); 
  $total = $arr['total'];
  return $total;
  
}  


function bulanangka($bulan)
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



function get_nilai_lt($connection,$nama,$bulan,$tahun){
  $query1 = "SELECT COUNT(*) as list FROM penjualan_list  WHERE nama_toko ='".$nama."' AND bulan ='".$bulan."' AND tahun= '".$tahun."'";
  $result1 =odbc_exec($connection,$query1);
  $arrs = odbc_fetch_array($result1); 
  $list = $arrs['list'];



  $query = "SELECT SUM(l0+$list) as lt FROM penjualan  WHERE nama_toko ='".$nama."' AND bulan ='".$bulan."' AND tahun= '".$tahun."'";
  $result =odbc_exec($connection,$query);
  $arrs = odbc_fetch_array($result); 
  $lt = $arrs['lt'];
  $total_lt = "";
  if($bulan == "Januari"){
    $total_lt = 37;
  }else{
    $total_lt = $lt;
  }
return $total_lt;

};


function get_nilai_ach($connection,$nama,$bulan,$tahun){


  $query = "SELECT target FROM penjualan  WHERE nama_toko ='".$nama."' AND bulan ='".$bulan."' AND tahun= '".$tahun."'";
  
  
  $result =odbc_exec($connection,$query);
  $arrs = odbc_fetch_array($result); 
    $total = get_totalitung($connection,$nama,$bulan,$tahun);
	 
    $targets = floatval($arrs["target"]);

	$target_jml =  4 * $targets;
	$total_int = $total;

    if($target_jml == 0 OR $total_int == 0){
      $ach = 0;	
      }else{
      $ach = ($total_int / $target_jml) *100;
	  	//die(var_dump($ach));
	
      }
	

 return $ach;

};

function get_totalitung($connection,$nama,$bulan,$tahun){
  
  $get_total = odbc_exec($connection,"jumlah_total '$nama' ,'$bulan','$tahun'");
 
  $arr = odbc_fetch_array($get_total); 
   $rowtotal = round($arr['jumlah']);
   $d_bagi = floatval($rowtotal) / 1000; 

   

  return $d_bagi; 
}

function get_total($connection,$nama,$bulan,$tahun){
  
  //$query ="jumlah_total '$nama' ,'$bulan','$tahun'";
   $query ="jumlah_totalMaxUpdadet '$nama' ,'$bulan','$tahun'";
  $get_total = odbc_exec($connection,$query);
 

  $arr = odbc_fetch_array($get_total); 
   $rowtotal = round($arr['total']);
   $d_bagi = floatval($rowtotal) / 1000; 
   $formatted_number = number_format($d_bagi,0, ',', ',');
   

  return $formatted_number; 
}


function getgrowth($connection,$nama,$bulan,$tahun){
  
  $result_set = odbc_exec($connection,"trankasi_bulan '$nama','$bulan','$tahun'");
  $week = odbc_fetch_array($result_set); 


  // w shoppe
  $ws1 =$week['w1'];
  $ws2 = $week['w2'];
  $ws3 =$week['w3'];
  $ws4 =$week['w4'];
  //end 




  if($ws4 > 0){
    if($bulan =="January"){
      //$totalgros = 0;
	  $totalgros = SetGrowtJan($connection,$nama,$bulan,$tahun);
      return $totalgros;
	  
	    //
    }
 
    if($bulan !=="January"){     
      $bulanangka = Rubah_Bulan($bulan);
    
      $kurang = $bulanangka - 1;
      $cek_bulan = bulan($kurang);
    

      $week_k = get_mingguan($connection,$nama,$cek_bulan,$tahun);
    
      $week_s = get_mingguan($connection,$nama,$bulan,$tahun);
      //menggun sekarang
        $ws1= $week_s['w1'];
        $ws2= $week_s['w2'];
        $ws3= $week_s['w3'];
        $ws4= $week_s['w4'];
      //minggu lalu
        $wk1= $week_k['w1'];
        $wk2= $week_k['w2'];
        $wk3= $week_k['w3'];
        $wk4= $week_k['w4'];
        //end lau
        $total_sekarang =$ws1 + $ws2 + $ws3 + $ws4;


        $bulankemaren = $wk1 + $wk2 + $wk3 + $wk4;
 	
        if($total_sekarang >= 0 && $bulankemaren >= 0 && $bulankemaren != 0){
		    if($bulankemaren !== 0.0){
              $wj_kurang =(($total_sekarang - $bulankemaren)/$bulankemaren)*100  ;
            }else{
              $wj_kurang = 0;
            }
        } else{
          $wj_kurang = 0;
        }
        //$wj_kurang =   - $rowtotal;
        $totalgros = $wj_kurang;
	
        return $totalgros;
    }else{
      $totalgros = 0;
      return $totalgros;
    }

  }elseif($ws3 >0){
    if($bulan =="January"){
          //$totalgros = 0;
	  $totalgros = SetGrowtJan($connection,$nama,$bulan,$tahun);
      return $totalgros;
 
    }
    if($bulan !=="January"){     
      $bulanangka = Rubah_Bulan($bulan);
      $kurang = $bulanangka - 1;
	
      $cek_bulan = bulan($kurang);

      $week_k = get_mingguan($connection,$nama,$cek_bulan,$tahun);
        

      $week_s = get_mingguan($connection,$nama,$bulan,$tahun);
      //menggun sekarang
        $ws1= $week_s['w1'];
        $ws2= $week_s['w2'];
        $ws3= $week_s['w3'];
        $ws4= $week_s['w4'];
      //minggu lalu
        $wk1= $week_k['w1'];
        $wk2= $week_k['w2'];
        $wk3= $week_k['w3'];
        $wk4= $week_k['w4'];
        //end lau
        $total_sekarang =$ws1 + $ws2 + $ws3;
        $bulankemaren = $wk1 + $wk2 + $wk3;
   
    
        if($total_sekarang >= 0 && $bulankemaren >= 0){
           if($bulankemaren !== 0.0){
              $wj_kurang =(($total_sekarang - $bulankemaren)/$bulankemaren)*100  ;
            }else{
              $wj_kurang = 0;
            }
        } else{
          $wj_kurang = 0;
        }
        //$wj_kurang =   - $rowtotal;
        $totalgros = $wj_kurang;
        return $totalgros;
      }else{
        $totalgros = 0;
        return $totalgros;
      }
  }

  elseif($ws2 >0){
    if($bulan =="January"){
          //$totalgros = 0;
	  $totalgros = SetGrowtJan($connection,$nama,$bulan,$tahun);
      return $totalgros;
 
    }
    if($bulan !=="January"){     
      $bulanangka = Rubah_Bulan($bulan);
      $kurang = $bulanangka - 1;
      $cek_bulan = bulan($kurang);
    

      $week_k = get_mingguan($connection,$nama,$cek_bulan,$tahun);
  
      $week_s = get_mingguan($connection,$nama,$bulan,$tahun);
      //menggun sekarang
        $ws1= $week_s['w1'];
        $ws2= $week_s['w2'];
        $ws3= $week_s['w3'];
        $ws4= $week_s['w4'];
      //minggu lalu
        $wk1= $week_k['w1'];
        $wk2= $week_k['w2'];
        $wk3= $week_k['w3'];
        $wk4= $week_k['w4'];
        //end lau
        $total_sekarang =$ws1 + $ws2;
        $bulankemaren = $wk1 + $wk2;

        if($total_sekarang >= 0 && $bulankemaren >= 0 ){
			if($bulankemaren !== 0.0){
              $wj_kurang =(($total_sekarang - $bulankemaren)/$bulankemaren)*100  ;
            }else{
              $wj_kurang = 0;
            }
        } else{
          $wj_kurang = 0;
        }
        //$wj_kurang =   - $rowtotal;
        $totalgros = $wj_kurang;
        return $totalgros;
    }else{
      $totalgros = 0;
      return $totalgros;
    }
  }
  elseif($ws1 >0){
      if($bulan =="January"){
          //$totalgros = 0;
	  $totalgros = SetGrowtJan($connection,$nama,$bulan,$tahun);
      return $totalgros;
 
    }
      if($bulan !=="January"){     
        $bulanangka = Rubah_Bulan($bulan);
     
        $kurang = $bulanangka - 1;
        $cek_bulan = bulan($kurang);
        $week_k = get_mingguan($connection,$nama,$cek_bulan,$tahun);
     

        $week_s = get_mingguan($connection,$nama,$bulan,$tahun);
        //menggun sekarang
          $ws1= $week_s['w1'];
          $ws2= $week_s['w2'];
          $ws3= $week_s['w3'];
          $ws4= $week_s['w4'];
        //minggu lalu
          $wk1= $week_k['w1'];
          $wk2= $week_k['w2'];
          $wk3= $week_k['w3'];
          $wk4= $week_k['w4'];
          //end lau
          $total_sekarang =$ws1;
        
          $bulankemaren = $wk1;
      
        
          if($total_sekarang >= 0 && $bulankemaren >= 0){
          
            if($bulankemaren !=="0.0"){
              $wj_kurang =(($total_sekarang - $bulankemaren)/$bulankemaren)*100  ;
            }else{
              $wj_kurang = 0;
            }
           
          } else{
            $wj_kurang = 0;
          }
          //$wj_kurang =   - $rowtotal;
          $totalgros = $wj_kurang;
          return $totalgros;
      }else{
        $totalgros = 0;
        return $totalgros;
      }
      
  }else{
  
        //$wj_kurang =   - $rowtotal;
        $totalgros = -100;
        return $totalgros;
  }
}


function get_mingguan($conn,$nama,$bulan,$tahun){

  $query = "SELECT w1,w2,w3,w4 FROM penjualan  WHERE nama_toko ='".$nama."' AND bulan ='".$bulan."' AND tahun= '".$tahun."'";
  $cek_mingguan = odbc_exec($conn,$query);
  $mingguan =odbc_fetch_array($cek_mingguan);

  return $mingguan;
};

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

function bulan($bulan)
{
  Switch ($bulan){
    case 1 : $bulan="January";
        Break;
    case 2 : $bulan="February";
        Break;
    case 3 : $bulan="March";
        Break;
    case 4 : $bulan="April";
        Break;
    case 5 : $bulan="May";
        Break;
    case 6 : $bulan="June";
        Break;
    case 7 : $bulan="July";
        Break;
    case 8 : $bulan="August";
        Break;
    case 9 : $bulan="September";
        Break;
    case 10 : $bulan="October";
        Break;
    case 11 : $bulan="November";
        Break;
    case 12 : $bulan="DeCember";
        Break;
    }
  return $bulan;
}


function SetGrowtJan($connection,$nama,$bulan,$tahun){
	
	
                $xtahun_b  = substr($tahun,3,1);
                $xtahun_d  = substr($tahun,0,3);

                $xtahun_t = (int)$xtahun_b - 1;
                $tahun_lm = $xtahun_d.(string)$xtahun_t;
               
              
                $bulan_lalu = "December";
                $week_k = get_mingguan($connection,$nama,$bulan_lalu,$tahun_lm);
          
                $week_s = get_mingguan($connection,$nama,$bulan,$tahun);
               
           
                $wsj1 =$week_s['w1'];
                $wsj2 = $week_s['w2'];
                $wsj3 =$week_s['w3'];
                $wsj4 =$week_s['w4'];


                      //menggun sekarang
                      $ws1= $week_s['w1'];
                      $ws2= $week_s['w2'];
                      $ws3= $week_s['w3'];
                      $ws4= $week_s['w4'];
                    //minggu lalu
                      $wk1= $week_k['w1'];
                      $wk2= $week_k['w2'];
                      $wk3= $week_k['w3'];
                      $wk4= $week_k['w4'];
                      //end lau

                if($wsj4 > 0){
                    $total_sekarang =$ws1 + $ws2 + $ws3 + $ws4;

                    $bulankemaren = $wk1 + $wk2 + $wk3 + $wk4;
                  
                    if($bulankemaren !== 0){
                        if($total_sekarang >= 0 && $bulankemaren >= 0){
                          $wj_kurang =(($total_sekarang - $bulankemaren)/$bulankemaren)*100  ;
                        } else{
                          $wj_kurang = 0;
                        }
                      return  $wj_kurang;
                    }else{
                      return 0;
                  }
                }elseif($wsj3 > 0){
                  $total_sekarang =$ws1 + $ws2 + $ws3;
                  $bulankemaren = $wk1 + $wk2 + $wk3;
                  if($bulankemaren !== 0){
                    if($total_sekarang >= 0 && $bulankemaren >= 0){
                      $wj_kurang =(($total_sekarang - $bulankemaren)/$bulankemaren)*100  ;
                    } else{
                          $wj_kurang = 0;
                        }
                      return  $wj_kurang;
                    }else{
                      return 0;
                  }
                }
                elseif($wsj2 > 0){
                  $total_sekarang =$ws1 + $ws2;
                  $bulankemaren = $wk1 + $wk2;
          
                  if($bulankemaren !== 0){
                    if($total_sekarang >= 0 && $bulankemaren >= 0){
                      $wj_kurang =(($total_sekarang - $bulankemaren)/$bulankemaren)*100  ;
                    } else{
                      $wj_kurang = 0;
                    }
                    return  $wj_kurang;
                    }else{
                      return 0;
                  }
                 
					
                }
                elseif($wsj1 > 0){
                  $total_sekarang =$ws1;
                  $bulankemaren = $wk1;
        
                  if($bulankemaren !== 0){
                    if($total_sekarang >= 0 && $bulankemaren >= 0){
                      $wj_kurang =(($total_sekarang - $bulankemaren)/$bulankemaren)*100  ;
                    } else{
                      $wj_kurang = 0;
                    }
                      return  $wj_kurang;
                    }else{
                      return 0;
                  }
             
                }
                
}



function getmaxt($connection,$tahunpage,$namatoko,$wek){
      $max_week ="";
      if($wek =="w1"){
        $query ="SELECT  max(w1) as max_w1 FROM penjualan WHERE tahun ='".$tahunpage."' AND nama_toko='".$namatoko."'";
        $result =odbc_exec($connection,$query);
        $max_w1=odbc_result($result,"max_w1");
        $max_week =floatval($max_w1);
		
      }elseif($wek =="w2"){
        $query ="SELECT  max(w2) as max_w2 FROM penjualan WHERE tahun ='".$tahunpage."' AND nama_toko='".$namatoko."'";
        $result =odbc_exec($connection,$query);
        $max_w2=odbc_result($result,"max_w2");
        $max_week =floatval($max_w2);
      }
      elseif($wek =="w3"){
        $query ="SELECT  max(w3) as max_w3 FROM penjualan WHERE tahun ='".$tahunpage."' AND nama_toko='".$namatoko."'";
        $result =odbc_exec($connection,$query);
        $max_w3=odbc_result($result,"max_w3");
        $max_week =floatval($max_w3);
      }
      elseif($wek =="w4"){
        $query ="SELECT  max(w4) as max_w4 FROM penjualan WHERE tahun ='".$tahunpage."' AND nama_toko='".$namatoko."'";
        $result =odbc_exec($connection,$query);
        $max_w4=odbc_result($result,"max_w4");
        $max_week =floatval($max_w4);
      }
	  
	  
      return formatweek($max_week);

     
}



function WeekMax($connection,$namatoko,$tahunpage){
  
  $query ="maxpenjualanweek'".$namatoko."','".$tahunpage."' ";
  $result =odbc_exec($connection,$query);
  $max_bln=odbc_result($result,"max_bln");
  $max_bln =floatval($max_bln);
 
  return formatweek($max_bln);

}



function totalMaxt($connection,$tahunpage,$namatoko){
  
    $query ="SELECT  max(total) as total FROM penjualan WHERE  tahun ='".$tahunpage."' AND nama_toko='".$namatoko."'";
    $result =odbc_exec($connection,$query);
    $total_max=odbc_result($result,"total");
    $max_total =floatval($total_max);
  return formatweek($max_total);
 
}
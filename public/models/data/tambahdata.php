<?php

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$cek = 0;

$nama_toko = test_input($_POST["nama_toko"]);
$bulan = test_input($_POST["bulan"]);
$tahun = test_input($_POST["tahun"]);
$targets = test_input($_POST["target"]);
$sub_tring = test_input($_POST["amount"]);
$amount = str_replace(",","",$sub_tring);
$ml = test_input($_POST["ml"]);
$li = test_input($_POST["li"]);

$wilayah = $_POST['wilayah'];


$sql="SELECT COUNT(*) AS kondisi FROM penjualan WHERE nama_toko ='". $nama_toko ."' AND bulan ='". $bulan ."' AND tahun ='". $tahun ."'";
$validasi_data = odbc_exec($connection,$sql);
$arr = odbc_fetch_array($validasi_data); 
$rows = $arr['kondisi'];


if($bulan !=="January"){
  $bulanangka = Rubah_Bulan($bulan);
 
  $kurang = $bulanangka - 1;
  $cek_bulan = bulan($kurang);
  $week_bulan_kemaren = get_totalLi($connection,$nama_toko,$cek_bulan,$tahun);
 // $total_bulan_kamaren = get_total($connection,$nama,$cek_bulan,$tahun);
  $l0 = $week_bulan_kemaren;

}else{
  $l0 = 0;
}

if($rows == 0){
          switch($wilayah){
            case "w1":
              $sql="INSERT INTO [penjualan] (nama_toko,bulan,tahun,w1,l1,target,ml1,l0) Values ('". $nama_toko ."', '". $bulan ."', '". $tahun ."', '". $amount."','". $li."','". $targets."','". $ml."','". $l0."')"; 
              $result = odbc_exec($connection, $sql);
            break;

            case "w2":
                $sql="INSERT INTO [penjualan] (nama_toko,bulan,tahun,w2,l2,target,ml2,l0) Values ('". $nama_toko ."', '". $bulan ."', '". $tahun ."', '". $amount."','". $li."','". $targets."','". $ml."','". $l0."')"; 
                $result = odbc_exec($connection, $sql);
              break;

            case "w3":
                $sql="INSERT INTO [penjualan] (nama_toko,bulan,tahun,w3,l3,target,ml3,l0) Values ('". $nama_toko ."', '". $bulan ."', '". $tahun ."', '". $amount."','". $li."','". $targets."','". $ml."','". $l0."')"; 
                $result = odbc_exec($connection, $sql);
            break;

            case "w4":
                $sql="INSERT INTO [penjualan] (nama_toko,bulan,tahun,w4,l4,target,ml4,l0) Values ('". $nama_toko ."', '". $bulan ."', '". $tahun ."', '". $amount."','". $li."','". $targets."','". $ml."','". $l0."')"; 
                $result = odbc_exec($connection, $sql);
            break;
            
          }

          if(!$result){
            $cek =$cek+1;
          }
        
          if ($cek==0){
            odbc_commit($connection);
            $status['nilai']=1; //bernilai benar
            $status['error']="Data Berhasil Ditambahkan";
          }else{
            odbc_rollback($connection);
            $status['nilai']=0; //bernilai benar
            $status['error']="Data Gagal Ditambahkan";
          }
          odbc_close($connection);
        
    echo json_encode($status); 

}else{

        switch($wilayah){
          case "w1":
              $sql="UPDATE [penjualan] SET l0 ='".$l0."',  w1 = '". $amount ."', l1 = '". $li ."',target='".$targets."' ,ml1='".$ml."' WHERE nama_toko = '". $nama_toko ."' AND bulan ='".$bulan."' AND tahun ='".$tahun."'
                  "; 
              $result = odbc_exec($connection, $sql);
          break;
          case "w2":
            $sql="UPDATE [penjualan] SET l0 ='".$l0."',  w2 = '". $amount ."', l2 = '". $li ."',target='".$targets."' ,ml2='".$ml."' WHERE nama_toko = '". $nama_toko ."' AND bulan ='".$bulan."' AND tahun ='".$tahun."'
                "; 
            $result = odbc_exec($connection, $sql);
          break;
            case "w3":
                $sql="UPDATE [penjualan] SET l0 ='".$l0."', w3 = '". $amount ."', l3 = '". $li ."',target='".$targets."' ,ml3='".$ml."' WHERE nama_toko = '". $nama_toko ."' AND bulan ='".$bulan."' AND tahun ='".$tahun."'
                    "; 
                $result = odbc_exec($connection, $sql);
            break;
          case "w4":
              $sql="UPDATE [penjualan] SET l0 ='".$l0."', w4 = '". $amount ."', l4 = '". $li ."',target='".$targets."' ,ml4='".$ml."' WHERE nama_toko = '". $nama_toko ."' AND bulan ='".$bulan."' AND tahun ='".$tahun."'
                  "; 
              $result = odbc_exec($connection, $sql);
          break;
        }
      
        $status['nilai']= 0; //bernilai salah
        $status['tahun'] = $tahun;
        $status['error']="data di upadete";
        echo json_encode($status);  
      

}


function get_totalLi($conn,$nama,$bulan,$tahun){

  $query = "SELECT l0 FROM penjualan  WHERE nama_toko ='".$nama."' AND bulan ='".$bulan."' AND tahun= '".$tahun."'";
  $cek_mingguan = odbc_exec($conn,$query);
  $arr =odbc_fetch_array($cek_mingguan);
 $l0 = $arr['l0'];
 $query2 = "SELECT COUNT(*) total FROM penjualan_list  WHERE bulan ='".$bulan."' AND tahun= '".$tahun."' AND nama_toko ='".$nama."' ";
 $result_set =odbc_exec($conn,$query2);
 $arr = odbc_fetch_array($result_set); 
 $total = $arr['total'];

 $total_lo = $total + $l0;
return $total_lo;
};


function get_total($connection,$nama,$bulan,$tahun){
  $get_total = odbc_exec($connection,"jumlah_total '$nama' ,'$bulan','$tahun'");
  

  $arr = odbc_fetch_array($get_total); 
   $rowtotal = $arr['jumlah'];

  return $rowtotal;
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
    case 6 : $bulan="Juny";
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
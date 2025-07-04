<?php


require_once ("../../models/koneksi.php");
$connection =$database->open_connection();


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };
  $thn = test_input($_POST["thn"]);
  $bln = test_input($_POST["bln"]);
  $wilayah = test_input($_POST["wilayah"]);
  $ml = test_input($_POST["ml"]);
  $nama_toko = test_input($_POST["nama_toko"]);


  //get tanggal  week
  $query_week = "SELECT * FROM bulan_week WHERE tahun ='".$thn."' AND bulan ='".$bln."' AND wilayah ='".$wilayah."' ";
  $result2 = odbc_exec($connection,$query_week);
  $data_week =[];
  while(odbc_fetch_row($result2)){
      $data_week[] = array(
          "wilayah"=>rtrim(odbc_result($result2,'wilayah')),
          "tahun"=>rtrim(odbc_result($result2,'tahun')),
          "bulan"=>rtrim(odbc_result($result2,'bulan')),
          "tgl_awal"=>rtrim(odbc_result($result2,'tgl_awal')),
          "tgl_akhir"=>rtrim(odbc_result($result2,'tgl_akhir')),
      );
      
      }
  $tgl_awal ="";
  $tgl_akhir = "";
  foreach($data_week as $item){
    $tgl_awal = Tanggalformat($item['tahun'], $item['bulan'], $item['tgl_awal']);
    $tgl_akhir = Tanggalformat($item['tahun'], $item['bulan'], $item['tgl_akhir']);

  
  
}



$tanggal_awal = strtotime($tgl_awal);
$start_date = date('m/d/Y',$tanggal_awal);

$tanggal_akhir = strtotime($tgl_akhir);
$end_date = date('m/d/Y',$tanggal_akhir);


$query = "SELECT D.partid as partid, D.partname as partname
FROM SOTRANSACTION  AS S   
INNER JOIN  SOTRANSACTIONDETAIL AS D ON S.SOTransacID = D.SOTransacID
WHERE  S.shipdate  BETWEEN '".$start_date."'  AND '".$end_date."'AND  S.CustomerID ='".$nama_toko."'
AND S.FlagPosted ='Y' AND S.flagcancelSO is NULL ";

$result2 = odbc_exec($connection,$query);
$datas = [];
while(odbc_fetch_row($result2)){


    $datas[] = array(
        "partid"=>rtrim(odbc_result($result2,'partid')),
        "partname"=>rtrim(odbc_result($result2,'partname')),
    );

    }

    $fuldata = array_filter($datas, function($item){
        static $ids = array();
        $kode = $item["partid"];
        if (in_array($kode, $ids)) {
        
            return false;
        } else {
            $ids[] = $kode;
            return true;
        }
      });

    $dataArray =[];
    foreach($fuldata as $item ){
        $dataArray[] = [
            'nama_toko' =>$nama_toko,
            'tahun' =>date('Y',$tanggal_awal),
            'bulan' =>date('F',$tanggal_awal),
            'kode_barang' =>$item['partid'],
            'nama_barang' =>$item['partname'],
            'wilayah'=>$wilayah,
             'ml' =>$ml,
            'qty' => get_qty($connection,$start_date,$end_date,$nama_toko,$item['partid'])
        ];
    }
 
    $sql="DELETE FROM penjualan_listdetail WHERE nama_toko = '".$nama_toko."' AND tahun = '".date('Y',$tanggal_awal)."' 
    AND bulan = '".date('F',$tanggal_awal)."'  AND wilayah = '".$wilayah."'"; 
    $result = odbc_exec($connection, $sql); 
        $cek ='';
    foreach ($dataArray as $item) {
        $nama_toko = $item['nama_toko'];
        $tahun = $item['tahun'];
        $bulan = $item['bulan'];
        $kode_barang = $item['kode_barang'];
        $nama_barang = $item['nama_barang'];
        $wilayah = $item['wilayah'];
        $ml = $item['ml'];
        $qty = $item['qty'];
     
      
        $sql2="INSERT INTO [penjualan_listdetail] (nama_toko, bulan,tahun,kode_barang,nama_barang,wilayah,ml,qty) Values (
            '". $nama_toko ."', '". $bulan ."', '". $tahun ."', '". $kode_barang."','". $nama_barang."','". $wilayah."','". $ml."','". $qty."')"; 
        $result2 = odbc_exec($connection, $sql2);
		
      //untuk tambah master_listing
        $sql3 ="tambah_masterlisting '".$kode_barang."','".$nama_barang."','".$tahun."'";
        $result3 = odbc_exec($connection,$sql3);
        //end tambah master_listing
		
        if(!$result2){
            $cek =$cek+1;
          }else{
            $cek = 0;
          }
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


    function get_qty($connection,$start_date,$end_date,$nama_toko,$partid){
        $query = "SELECT SUM(D.Quantity)  as qty
            FROM SOTRANSACTION  AS S   
            INNER JOIN  SOTRANSACTIONDETAIL AS D ON S.SOTransacID = D.SOTransacID
            WHERE  S.shipdate  BETWEEN '".$start_date."'  AND '".$end_date."'AND  S.CustomerID ='".$nama_toko."'
            AND  D.partid ='".$partid."'
            AND S.FlagPosted ='Y' AND S.flagcancelSO is NULL ";
            $result2 = odbc_exec($connection,$query);
            $arr = odbc_fetch_array($result2); 
            $res = $arr['qty'];
            $st_int = (int)$res;

            return $st_int;

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
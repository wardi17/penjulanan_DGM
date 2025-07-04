<?php
   require_once ("../../models/koneksi.php");
   $connection =$database->open_connection();
   
   function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

		$tahunpage = test_input($_POST["tahun"]);
       
       $sql ="SELECT
        b.bulan_angka from penjualan AS a
       inner join bulan_angkaPenjualan AS b ON a.bulan = b.bulan
        WHERE a.tahun ='".$tahunpage."'
        ORDER BY b.bulan_angka ";
       // $sql =" SELECT DISTINCT bulan,tahun FROM penjualan WHERE tahun ='".$year."' ";
        $result_set = odbc_exec($connection,$sql);
        $fulldata= [];
        while(odbc_fetch_row($result_set)){
            $fulldata [] =[
              "bulan_angka"=>rtrim(odbc_result($result_set,'bulan_angka')),
            ];
          
          };

           if(empty($fulldata)){
            $fulldata = null;
          
            echo json_encode($fulldata);
          }else{
            
            echo json_encode($fulldata);
          }
?>
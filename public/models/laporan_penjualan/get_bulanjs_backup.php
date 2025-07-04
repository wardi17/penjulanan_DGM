<?php
   require_once ("../../models/koneksi.php");
   $connection =$database->open_connection();
   
   function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

      $year = test_input($_POST["tahun"]);
       
       
        $sql =" SELECT DISTINCT bulan,tahun FROM penjualan WHERE tahun ='".$year."' ";
        $result = odbc_exec($connection,$sql);
        while(odbc_fetch_row($result)){
            $data [] =[
                "bulan" => rtrim(odbc_result($result,'bulan')),
                "tahun" => rtrim(odbc_result($result,'tahun')),
            ];
          
           
         
          };

          if(empty($data)){
            $data = null;
            echo json_encode($data);
          }else{
            
            echo json_encode($data);
          }

?>
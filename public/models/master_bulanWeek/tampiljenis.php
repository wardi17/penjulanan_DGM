<?php
require_once ("../../models/koneksi.php");
class getjenis{

    public function datajenis(){
        $db = new My_db();

        $conn =  $db->open_connection();
        $query = "SELECT nama_toko FROM master_jenis_toko  ORDER BY kode_jenis ASC";
        $result2 = odbc_exec($conn,$query);
        while(odbc_fetch_row($result2)){


            $data[] = array(
                //"kode_jenis"=>rtrim(odbc_result($result2,'kode_jenis')),
                rtrim(odbc_result($result2,'nama_toko')),
            
            );
    
    }
       
     
        return $data;
    }
}

$datajenis = new getjenis();
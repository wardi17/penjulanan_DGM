<?php 


class My_comment{

public function get_data(){
    
    $db= new  My_db();
     $conn =$db->open_connection();
    

    
    // $bulanpage = test_input($_POST['bulan']);
    $tahunpage = date("Y");

    $query = "SELECT TOP 10 tanggal,user_name,comment FROM comment_executive  WHERE YEAR(tanggal)= '".$tahunpage."' ORDER BY tanggal DESC";
    $result = odbc_exec($conn,$query);
    $this->confirm_query($result);
		return $result;
    
    }

    private function confirm_query($result) {
      if (!$result) {
        die("Database query failed.");
      }
  }
}
$data = new My_comment();

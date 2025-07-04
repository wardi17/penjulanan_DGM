<?php
	//require_once("config.php");
	//public $username="sa";  //atau sesuai namauser anda 
	//public $password="";   //atau sesuai password anda 
	class MySQLDatabase { 
		
		//private $connection;
		//public $dsn="bambi-tm";  //atau sesuai nama DSN anda  
		//public $username="sa";  //atau sesuai namauser anda 
		//public $password="";   //atau sesuai password anda 
		function __construct() {
			$this->open_connection();
			
		}
		function __construct2() {
			$this->open_connection2();
			
		}
		public function open_connection() {
			$this->connection = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=UM_DB;", "sa","");
			
		}
		public function open_connection2() {
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			
		}
		
		public function close_connection() {
			if(isset($this->connection)) {
				odbc_close($this->connection);
				unset($this->connection);
				
			}
		}
		public function close_connection2() {
			if(isset($connection2)) {
				odbc_close($connection2);
				unset($connection2);
				
			}
		}
		public function close_connection3() {
			if(isset($connection3)) {
				odbc_close($connection3);
				unset($connection3);
				
			}
		}
		
		public function query($sql) {
			$result = odbc_exec($this->connection, $sql); 
			$this->confirm_query($result);
			return $result;
			
		}
		public function bmi($sql) {
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			
			return $connection2;
			
		}
		public function query2($sql) {
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			$result = odbc_exec($connection2, $sql); 
			$this->confirm_query($result);
			return $result;
			
		}
		public function queryum($sql) {
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
			$result = odbc_exec($connection2, $sql); 
			$this->confirm_query($result);
			return $result;
			
		}
		private function confirm_query($result) {
			if (!$result) {
				die("Database query failed.");
			}
			
		}
		
		public function baca_sql($result_set) {
			return odbc_fetch_row($result_set);
		}
		
		public function sql_prep($string) {
			$res = addslashes($string);
			
			return $res;
		}
		public function c11($bong,$shadow,$partid,$smonth,$syear,$cust) {
			$code = 0;
			$lat = "";
			$long = "";
			$alamas = "";
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			
			$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .") AND s.[customerid] = '". $cust ."' "; 
			
			
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$code=rtrim(odbc_result($result_set2,"acpcs"));
				
				
			}
			
			return $code;
		}
		public function namacustomerz($id_cust, $shadow) {
	$baru = "";
	
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			$sql2="SELECT custname FROM ". $shadow ."customer where customerid = '". $id_cust ."'"; 
    		$result_set2 = odbc_exec($connection2, $sql2); 
    		while(odbc_fetch_row($result_set2)) {
        		$baru=odbc_result($result_set2,"custname");
        
			}
	
	

return $baru;
}
public function inspackingdetail($code, $docode, $partid, $color, $qty_total, $qty_box, $qty_box2, $weight, $satuan, $sizeL, $sizeW, $sizeH, $cbm, $remark, $fcost) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="INSERT INTO [PackingList_Detail2] ( PLtransacid, dotransacid, partid, color, qty_total, qty_box, qty_box2, weight, satuan, sizeL, sizeW, sizeH, cbm, remark, fcost ) Values ('". $code ."', '". $docode ."', '". $partid ."', '". $color ."', '". $qty_total ."', '". $qty_box ."', '". $qty_box2 ."', '". $weight ."', '". $satuan ."', '". $sizeL ."', '". $sizeW ."', '". $sizeH ."', '". $cbm ."', '". $remark ."', '". $fcost ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		return $baru;
}
public function edipackingdetail($code, $docode, $partid, $color, $qty_total, $qty_box, $qty_box2, $weight, $satuan, $sizeL, $sizeW, $sizeH, $cbm, $remark, $fcost) {
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="UPDATE PackingList_Detail2 SET color='".$color."', qty_total='".$qty_total."', qty_box='".$qty_box."', qty_box2='".$qty_box2."', weight='".$weight."', satuan='".$satuan."', sizeL='".$sizeL."', sizeW='".$sizeW."', sizeH='".$sizeH."', cbm='".$cbm."', remark='".$remark."', fcost='".$fcost."'  WHERE PLtransacid = '". $code ."' AND dotransacid = '". $docode ."' AND partid = '". $partid ."'"; 
		$result_set2 = odbc_exec($connection2, $sql2); 
		return $code;
}
		
public function celpackingdetail($code, $docode, $partid) {
	$baru = 0;
	
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			$sql2="SELECT count(partid) As bar FROM PackingList_Detail2  WHERE PLtransacid = '". $code ."' AND dotransacid = '". $docode ."' AND partid = '". $partid ."'"; 
    		$result_set2 = odbc_exec($connection2, $sql2); 
    		while(odbc_fetch_row($result_set2)) {
        		$baru=odbc_result($result_set2,"bar");
        
			}
	
	

return $baru;
}
public function cekplcost($code) {
	$baru = 0;
	
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			$sql2="SELECT TOP 1 fcost FROM PackingList_Detail2  WHERE PLtransacid = '". $code ."' order by id desc"; 
    		$result_set2 = odbc_exec($connection2, $sql2); 
    		while(odbc_fetch_row($result_set2)) {
        		$baru=odbc_result($result_set2,"fcost");
        
			}
	
	

return $baru;
}
public function rankcabang($sday, $smonth, $syear, $div) {
	$baru = 0;
	$time1 = strtotime($smonth . "/01/" . $syear);
	$time2 = strtotime($smonth . "/" . $sday . "/" . $syear);
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
			$sql2="cekrank '" . $smonth . "', '" . $syear . "', '" . date('m/d/Y',$time1) . "', '" . date('m/d/Y',$time2) . "', '" . $div . "'"; 
    		$result_set2 = odbc_exec($connection2, $sql2); 
    		while(odbc_fetch_row($result_set2)) {
        		$baru=odbc_result($result_set2,"nomor1");
        
			}
	
	

return $baru;
}
public function alamatcustomerz($id_cust, $shadow) {
	$baru = "";
	
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			$sql2="SELECT CustAddress FROM ". $shadow ."customer where customerid = '". $id_cust ."'"; 
    		$result_set2 = odbc_exec($connection2, $sql2); 
    		while(odbc_fetch_row($result_set2)) {
        		$baru=odbc_result($result_set2,"CustAddress");
        
			}
	
	

return $baru;
}
		public function latlongcustz($bong,$shadow) {
	$baru = 0;
	$lat = "";
	$long = "";
	$alamas = "";
	$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
	
    $sql2="SELECT lat, long, custaddress FROM ". $shadow ."customer WHERE  customerid = '". $bong ."' "; 
    
    
    $result_set2 = odbc_exec($connection2, $sql2); 
    while(odbc_fetch_row($result_set2)) {
        $lat=odbc_result($result_set2,"lat");
        $long=odbc_result($result_set2,"long");
        $alamas=odbc_result($result_set2,"custaddress");
        
	}

return array($lat, $long, $alamas);
}
		public function countplankunj2z($bong, $smonth, $syear, $sales, $shadow) {
	$baru = 0;
	$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
	
    $sql2="SELECT salesid FROM ". $shadow ."kunjungandetail WHERE (YEAR(tanggal) = '". $syear ."') AND (MONTH(tanggal) = '". $smonth ."') AND (DAY(tanggal) = '". $bong ."') AND salesid = '". $sales ."'"; 
    
    
    $result_set2 = odbc_exec($connection2, $sql2); 
    while(odbc_fetch_row($result_set2)) {
        $bar=odbc_result($result_set2,"salesid");
        $baru = $baru + 1;
	}
$baru = $baru + 5;
return $baru;
}
public function countplankunjz($bong, $smonth, $syear, $sales, $shadow) {
	$baru = 0;
	$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
	
    $sql2="SELECT salesid FROM ". $shadow ."kunjungandetail WHERE (YEAR(tanggal) = '". $syear ."') AND (MONTH(tanggal) = '". $smonth ."') AND (DAY(tanggal) = '". $bong ."') AND salesid = '". $sales ."' order by nomor desc"; 
    
    
    $result_set2 = odbc_exec($connection2, $sql2); 
    while(odbc_fetch_row($result_set2)) {
        $bar=odbc_result($result_set2,"salesid");
        $baru = $baru + 1;
	}

return $baru;
}
public function colpkunz($smonth, $syear, $sales, $shadow) {
	$baru = 0;
	$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
	
    $sql2="SELECT     COUNT(*) AS dom FROM ". $shadow ."kunjungandetail WHERE     (MONTH(tanggal) = '". $smonth ."') AND (YEAR(tanggal) = '". $syear ."') AND (salesid = '". $sales ."')  GROUP BY DAY(tanggal)"; 
    
    
    $result_set2 = odbc_exec($connection2, $sql2); 
    while(odbc_fetch_row($result_set2)) {
        $bar=odbc_result($result_set2,"dom");
        if ($baru < $bar) {
        	$baru = $bar;
        }
        
	}

return $baru;
}
		public function c12($bong,$shadow,$partid,$smonth,$syear,$cust) {
			$code = 0;
			$lat = "";
			$long = "";
			$alamas = "";
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			
			$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND sd.[komisiI] = '0' AND s.[customerid] = '". $cust ."'"; 
			
			
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$code=rtrim(odbc_result($result_set2,"acpcs"));
				
				
			}
			
			return $code;
		}
		public function pc20($bong,$shadow,$smonth,$syear,$cust) {
			$code = 0;
			$lat = "";
			$long = "";
			$alamas = "";
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			
			$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND sd.[komisiI] = '". $bong ."' AND s.[customerid] = '". $cust ."'"; 
			
			
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$code=rtrim(odbc_result($result_set2,"acpcs"));
				
				
			}
			
			return $code;
		}
		public function d36a($bong,$shadow,$partid,$sday,$smonth,$syear, $re) {
			$code = 0;
			$lat = "";
			$long = "";
			$alamas = "";
			$sql2 = "";
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			
			$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_b36] WHERE days = '". $sday ."' and name = '". $re ."' and benar = '". $bong ."'";  
			
			
			
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$code=rtrim(odbc_result($result_set2,"acpcs"));
				
				
			}
			
			return $code;
		}
		public function ceksales($id, $divs, $time1, $time2) {
			$code = "";
			$lat = "";
			$long = "";
			$alamas = "";
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			if ($divs=="RM1"){
				$sql2="select TOP 1 salesmanid as cek from [bambi-mg2].[dbo].customersalesman  where customerid = '". $id ."'"; 
				}elseif ($divs=="RM2"){
				$sql2="select TOP 1 salesmanid as cek from [bambi-tm].[dbo].customersalesman  where customerid = '". $id ."'"; 
				}elseif ($divs=="JBR"){
				$sql2="select TOP 1 salesmanid as cek from [bambi04].[dbo].customersalesman  where customerid = '". $id ."'"; 
				}elseif ($divs=="SG"){
				$sql2="select TOP 1 salescode as cek from [bambi-sg].[dbo].customer  where customerid = '". $id ."'"; 
				}elseif ($divs=="KLM"){
				$sql2="select TOP 1 salescode as cek from [bambi-bmi].[dbo].customer  where customerid = 'NS4'"; 
				}elseif ($divs=="SMT"){
				$sql2="select TOP 1 salescode as cek from [bambi-bmi].[dbo].customer  where customerid = 'NS1'"; 
				}elseif ($divs=="JTG"){
				$sql2="select TOP 1 salescode as cek from [bambi-bmi].[dbo].customer  where customerid = 'NS2'"; 
				}elseif ($divs=="SLW"){
				$sql2="select TOP 1 salescode as cek from [bambi-bmi].[dbo].customer  where customerid = 'NS3'"; 
				}elseif ($divs=="JTM"){
				$sql2="select TOP 1 salescode as cek from [bambi-bmi].[dbo].customer  where customerid = 'SB'"; 
				}else{
				$sql2="select TOP 1 salescode as cek from [bambi-bmi].[dbo].customer  where customerid = '". $id ."'"; 
				}
			
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$code=rtrim(odbc_result($result_set2,"cek"));
				
				
			}
			
			return $code;
		}
		public function ceksoamount($id, $divs, $time1, $time2) {
			$code = 0;
			$code1 = 0;
			$lat = "";
			$long = "";
			$alamas = "";
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			if ($divs=="RM1"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-mg2].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-mg2].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' "; 
				}elseif ($divs=="RM2"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-tm].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-tm].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' "; 
				}elseif ($divs=="JBR"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi04].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi04].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' "; 
				}elseif ($divs=="SG"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-sg].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-sg].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' "; 
				}elseif ($divs=="KLM"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y'  and divisi = 'NS4' "; 
				}elseif ($divs=="SMT"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y'  and divisi = 'NS1' "; 
				}elseif ($divs=="JTG"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y'  and divisi = 'NS2' "; 
				}elseif ($divs=="SLW"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y'  and divisi = 'NS3' "; 
				}elseif ($divs=="JTM"){
				$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y'  and divisi = 'SB' "; 
				}else{
					$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS amount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s	ON sd.[SOTransacID] = s.[SOTransacID] where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y'  and divisi = '". $divs ."' "; 
				
			}
			
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$code1=rtrim(odbc_result($result_set2,"amount"));
				$code = $code + $code1;
				
			}
			
			return $code;
		}
		public function ceksowil($id, $divs, $time1, $time2) {
			$code = 0;
			$lat = "";
			$long = "";
			$alamas = "";
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			if ($divs=="RM1"){
				$sql2="select count(sotransacid) as cek from [bambi-mg2].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' "; 
				}elseif ($divs=="RM2"){
				$sql2="select count(sotransacid) as cek from [bambi-tm].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' "; 
				}elseif ($divs=="JBR"){
				$sql2="select count(sotransacid) as cek from [bambi04].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' "; 
				}elseif ($divs=="SG"){
				$sql2="select count(sotransacid) as cek from [bambi-sg].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' "; 
				}elseif ($divs=="KLM"){
				$sql2="select count(sotransacid) as cek from [bambi-bmi].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' and divisi = 'NS4'";
				}elseif ($divs=="SMT"){
				$sql2="select count(sotransacid) as cek from [bambi-bmi].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' and divisi = 'NS1'";
				}elseif ($divs=="JTG"){
				$sql2="select count(sotransacid) as cek from [bambi-bmi].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' and divisi = 'NS2'";
				}elseif ($divs=="SLW"){
				$sql2="select count(sotransacid) as cek from [bambi-bmi].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' and divisi = 'NS3'";
				}elseif ($divs=="JTM"){
				$sql2="select count(sotransacid) as cek from [bambi-bmi].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' and divisi = 'SB'";
				}else{
				$sql2="select count(sotransacid) as cek from [bambi-bmi].[dbo].sotransaction  where customerid = '". $id ."' and shipdate between '". $time1 ."' AND '". $time2 ."' AND flagposted = 'Y' and divisi = '". $divs ."' "; 
				}
			
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$code=rtrim(odbc_result($result_set2,"cek"));
				
				
			}
			
			return $code;
		}
		public function s11($bong,$shadow,$partid,$smonth,$syear,$sales) {
			$code = 0;
			$lat = "";
			$long = "";
			$alamas = "";
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			
			$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .") AND s.[SalesmanCode] = '". $sales ."' "; 
			
			
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$code=rtrim(odbc_result($result_set2,"acpcs"));
				
				
			}
			
			return $code;
		}
		public function s12($bong,$shadow,$partid,$smonth,$syear,$sales) {
			$code = 0;
			$lat = "";
			$long = "";
			$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND sd.[komisiI] = '0' AND s.[SalesmanCode] = '". $sales ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function partsupp2($cust) {
		$code = "";
		$scode = "";
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT custaddress FROM supplier where customerid = '". $cust ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"custaddress"));
		
		}
		
		return $code;
		}
		public function partsupp($cust) {
		$code = "";
		$scode = "";
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT partid, spartname FROM supplierpartmaster where suppid = '". $cust ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"partid"));
		$scode=rtrim(odbc_result($result_set2,"spartname"));
		$alamas = $alamas . " " . $code . " " . $scode;
		
		}
		
		return $alamas;
		}
		public function tc20($codew) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM([amount]) IS NULL THEN 0 ELSE SUM([amount]) END) AS acpcs FROM [um_db].[dbo].TOP20 where code = '". $codew ."' order by acpcs desc"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function b11($bong,$shadow,$partid,$smonth,$syear) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .")"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function wherepart36d($bong,$shadow,$re) {
		$baru = 0;
		$lat = "LEFT(partid,4) = '0000'";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02_2020_top5 WHERE  category = '". $bong ."' and cabang = '". $re ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(partid,". $long .") = '". $code . "'";
		
		}
		
		return $lat;
		}
		public function wherepart36b($bong,$shadow,$re) {
		$baru = 0;
		$lat = "LEFT(partid,4) = '0000'";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02_2020_top5 WHERE  coderegion = '". $bong ."' and cabang = '". $re ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(partid,". $long .") = '". $code . "'";
		
		}
		
		return $lat;
		}
		public function wherepart36an($bong,$shadow,$re) {
		$baru = 0;
		$lat = "LEFT(partid,4) = '0000'";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02_2020 WHERE  coderegion = '". $bong ."'  "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(partid,". $long .") = '". $code . "'";
		
		}
		
		return $lat;
		}
		public function wherepart36ax($bong,$shadow,$re) {
		$baru = 0;
		$lat = "LEFT(partid,4) = '0000'";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM [bambi-bmi].[dbo].product02_2020 WHERE  coderegion = '". $bong ."' and cabang = 'DM'  "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(partid,". $long .") = '". $code . "'";
		
		}
		
		return $lat;
		}
		public function divisiku($sales) {
		$baru = 0;
		$lat = "LEFT(partid,4) = '0000'";
		$code = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		
		$sql2="SELECT divisi FROM a_user WHERE  id_cust = '". $sales ."' and cabang = '99'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"divisi"));
		
		
		}
		
		return $code;
		}
		public function wherepart36a($bong,$shadow,$re) {
		$baru = 0;
		$lat = "LEFT(partid,4) = '0000'";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02_2020 WHERE  coderegion = '". $bong ."' and cabang = '". $re ."'  "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(partid,". $long .") = '". $code . "'";
		
		}
		
		return $lat;
		}
		public function wherepart36($bong,$shadow) {
		$baru = 0;
		$lat = "LEFT(partid,4) = '0000'";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02_2020 WHERE  coderegion = '". $bong ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(partid,". $long .") = '". $code . "'";
		
		}
		
		return $lat;
		}
		public function store($id,$name) {
		$baru = 0;
		$conn = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$query = "tampilakan_agama '" . $id . "', '" . $name . "' ";
		$result = odbc_exec($conn, $query);
		while (($row = odbc_fetch_row($result))) {
		$var1 = odbc_result($result,'cnama');
		
		
		}
		
		return $var1;
		}
		public function updateb8($id,$name) {
		$baru = 0;
		$conn = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$query = "UPDATEb8";
		$result = odbc_exec($conn, $query);
		
		while (($row = odbc_next_result($result))) {
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function updateb8_MD($id,$name) {
		$baru = 0;
		$conn = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$query = "UPDATEb8_MD";
		$result = odbc_exec($conn, $query);
		
		while (($row = odbc_next_result($result))) {
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function updateb8_BD($id,$name) {
		$baru = 0;
		$conn = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$query = "UPDATEb8_BD";
		$result = odbc_exec($conn, $query);
		
		while (($row = odbc_next_result($result))) {
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function updateb8_RM($id,$name) {
		$baru = 0;
		$conn = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$query = "UPDATEb8_RM";
		$result = odbc_exec($conn, $query);
		
		while (($row = odbc_next_result($result))) {
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function updateb8_SG($id,$name) {
		$baru = 0;
		$conn = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$query = "UPDATEb8_SG";
		$result = odbc_exec($conn, $query);
		
		while (($row = odbc_next_result($result))) {
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function updateb35_MD($id,$name) {
		$baru = 0;
		$conn = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$query = "updateb35_MD";
		$result = odbc_exec($conn, $query);
		
		while (($row = odbc_next_result($result))) {
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function wherepart363($bong,$shadow) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02_2020_top5 WHERE  coderegion = '". $bong ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(sd.partid,". $long .") <> '". $code . "'";
		
		}
		
		return $lat;
		}
		public function wherepart362($bong,$shadow) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02_2020 WHERE  coderegion = '". $bong ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(sd.partid,". $long .") <> '". $code . "'";
		
		}
		
		return $lat;
		}
		public function b37b($bong,$shadow,$partid,$sday,$smonth,$syear,$re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE ([s].[divisi] = '". $re ."') AND YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .")"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acamount"));
		
		
		}
		
		return $code;
		}
		public function b37a($bong,$shadow,$partid,$sday,$smonth,$syear,$re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE ([s].[divisi] = '". $re ."') AND YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .")"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acamount"));
		
		
		}
		
		return $code;
		}
		public function b37($bong,$shadow,$partid,$sday,$smonth,$syear) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE  YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .")"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acamount"));
		
		
		}
		
		return $code;
		}
		public function b36b($bong,$shadow,$partid,$sday,$smonth,$syear, $re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE ([s].[divisi] = '". $re ."') AND YEAR(shipdate) = '". $syear ."' AND DAY(shipdate) = '". $sday ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .")"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function a36($bong,$shadow,$partid,$sday,$smonth,$syear, $re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE ([s].[divisi] = '". $re ."') AND YEAR(shipdate) = '". $syear ."' AND DAY(shipdate) = '". $sday ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .")"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function d37a($bong,$shadow,$partid,$sday,$smonth,$syear,$re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(amount) IS NULL THEN 0 ELSE SUM(amount) END) AS acamount FROM [um_db].[dbo].[shadow_b36] WHERE days > 0 AND days <= '". $sday ."' and name = '". $re ."' and benar = '". $bong ."' "; 
		
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acamount"));
		
		
		}
		
		return $code;
		}
		public function a37ax($bong,$shadow,$partid,$sday,$smonth,$syear,$re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($bong == 22){
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acamount FROM [um_db].[dbo].[shadow_qty] WHERE nama = '". $re ."' and (codes = '22' or (codes = '0' AND left(partid,3) <> '99-')) "; 
		}else{
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acamount FROM [um_db].[dbo].[shadow_qty] WHERE nama = '". $re ."' and codes = '". $bong . "' "; 
		}
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acamount"));
		
		
		}
		
		return $code;
		}
		public function a37a($bong,$shadow,$partid,$sday,$smonth,$syear,$re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($bong == 22){
		$sql2="SELECT (CASE WHEN SUM(amount) IS NULL THEN 0 ELSE SUM(amount) END) AS acamount FROM [um_db].[dbo].[shadow_b36] WHERE days > 0 AND  days <= '". $sday ."' and name = '". $re ."' and (itemnoso = '22' or (itemnoso = '0' AND left(partid,3) <> '99-')) "; 
		}else{
		$sql2="SELECT (CASE WHEN SUM(amount) IS NULL THEN 0 ELSE SUM(amount) END) AS acamount FROM [um_db].[dbo].[shadow_b36] WHERE days > 0 AND days <= '". $sday ."' and name = '". $re ."' and itemnoso = '". $bong . "' "; 
		}
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acamount"));
		
		
		}
		
		return $code;
		}
		public function benar36($partid, $pkom) {
		$code = 0;
		$lat = "";
		$xpartid = $partid;
		$alamas = "";
		$sql2 = "";
		$sub3 = substr($partid,0,3);
		$sub4 = substr($partid,0,4);
		$sub5 = substr($partid,0,5);
		$sub6 = substr($partid,0,6);
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($pkom == 1 or $pkom == 2 or $pkom == 3 or $pkom == 4 or $pkom == 7 or $pkom == 10 or $pkom == 11 ) {
		if (substr($partid,4,2) == "BW" or substr($partid,4,2) == "CW") {
		$xpartid = $sub6;
		}else{
		$xpartid = $sub4;
		}
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 12 or $pkom == 13 or $pkom == 14 or $pkom == 15 or $pkom == 16 or $pkom == 17 or $pkom == 19 ) {
		if (substr($partid,4,2) == "BW" or substr($partid,4,2) == "CW") {
		$xpartid = $sub6;
		}else{
		$xpartid = $sub4;
		}
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 20 or $pkom == 25 or $pkom == 26 or $pkom == 27 or $pkom == 32 or $pkom == 33 or $pkom == 34 or $pkom == 35 ) {
		if (substr($partid,4,2) == "BW" or substr($partid,4,2) == "CW") {
		$xpartid = $sub6;
		}else{
		$xpartid = $sub4;
		}
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 5 or $pkom == 8) {
		if (substr($partid,4,1) == "M") {
		$xpartid = $sub5;
		}else{
		$xpartid = $sub4;
		}
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 6) {
		if (substr($partid,4,1) == "C") {
		$xpartid = $sub5;
		}else{
		$xpartid = $sub4;
		}
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 9 or $pkom == 23 or $pkom == 28 or $pkom == 29 or $pkom == 30 ) {
		$xpartid = $sub3;
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 18 or $pkom == 24 or $pkom == 31 ) {
		$xpartid = $sub5;
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 21 ) {
		if (substr($partid,4,2) == "BW" or substr($partid,4,2) == "CW") {
		$xpartid = $sub6;
		}else{
		if (substr($partid,4,1) == "P" or substr($partid,4,1) == "L" or substr($partid,4,1) == "6" or substr($partid,4,1) == "0") {
		$xpartid = $sub5;
		}else{
		$xpartid = $sub4;
		}
		
		}
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 22 ) {
		if (substr($partid,4,2) == "BW" or substr($partid,4,2) == "CW" or substr($partid,3,1) == "P" or substr($partid,0,3) == "DGM") {
		$xpartid = $sub6;
		}else{
		if (substr($partid,4,1) == "C" or substr($partid,4,1) == "A") {
		$xpartid = $sub4;
		}else{
		$xpartid = $sub4;
		}
		
		}
		if (substr($partid,0,3) == "DGM") {
		$xpartid = $partid;
		}else{
		
		}
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}elseif ($pkom == 37 ) {
		
		$xpartid = $sub6;
		
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' order by nourut,coderegion,coderegion02,codesubreg01  "; 
		}
		
		
		
		
		
		
		else{
		$sql2="SELECT TOP 1 category FROM [bambi-bmi].[dbo].[product02_2020_top5] WHERE coderegion = '". $pkom . "' order by nourut,coderegion,coderegion02,codesubreg01"; 
		}
		
		
		
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
        $alamas=rtrim(odbc_result($result_set2,"category"));
        
		
		}
		$bom = "";
		if ($pkom == 0 ) {
		if (substr($partid,0,2) == "MB") {
		$alamas = "MAISONBER";
		}else{
		$alamas = "OTHERS";
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql3="SELECT category, count(category) as bom FROM [bambi-bmi].[dbo].[product02_2020_top5] where codesubreg01 = '". $xpartid . "' group by category"; 
		
		
		$result_set3 = odbc_exec($connection3, $sql3); 
		while(odbc_fetch_row($result_set3)) {
		$bom=odbc_result($result_set3,"bom");
		$alamas=rtrim(odbc_result($result_set3,"category"));
		if ($bom <> "0"){
		
		}else{
		$alamas=$alamas;
		}
        
		
		}
		
		
		
		}
        
		}        
		if ($alamas == ""){
		$alamas = "OTHERS";
		}
		if ($pkom == 36 ) {
		
		$alamas = "NONSTD";
		
        
		}        
		
		
		
		return $alamas;
		}
		
		public function sg36a($bong,$shadow,$partid,$sday,$smonth,$syear, $re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$sql2 = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_b36] WHERE days = '". $sday ."' and name = '". $re ."' AND (". $partid .")"; 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function custa36ax2($bong,$shadow,$partid,$sday,$smonth,$syear, $re, $caba) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = ""; 
		$sql2 = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		if($caba=="All"){
		if ($bong == 22){
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE dayku = '". $sday ."' and nama = '". $re ."' and (codes = '22' or (codes = '0' AND left(partid,3) <> '99-')) "; 
		}else{
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE dayku = '". $sday ."' and nama = '". $re ."' and codes = '". $bong . "' "; 
		}
		}else{
		
		if ($bong == 22){
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE cab = '". $caba ."' and dayku = '". $sday ."' and nama = '". $re ."' and (codes = '22' or (codes = '0' AND left(partid,3) <> '99-')) "; 
		}else{
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE cab = '". $caba ."' and  dayku = '". $sday ."' and nama = '". $re ."' and codes = '". $bong . "' "; 
		}
		}
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function a36ax2($bong,$shadow,$partid,$sday,$smonth,$syear, $re, $caba) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = ""; 
		$sql2 = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		if($caba=="All"){
		if ($bong == 22){
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE dayku = '". $sday ."' and nama = '". $re ."' and (codes = '22' or (codes = '0' AND left(partid,3) <> '99-')) "; 
		}else{
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE dayku = '". $sday ."' and nama = '". $re ."' and codes = '". $bong . "' "; 
		}
		}else{
		
		if ($bong == 22){
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE cab = '". $caba ."' and dayku = '". $sday ."' and nama = '". $re ."' and (codes = '22' or (codes = '0' AND left(partid,3) <> '99-')) "; 
		}else{
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE cab = '". $caba ."' and  dayku = '". $sday ."' and nama = '". $re ."' and codes = '". $bong . "' "; 
		}
		}
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function a36ax($bong,$shadow,$partid,$sday,$smonth,$syear, $re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = ""; 
		$sql2 = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		if ($bong == 22){
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE cab = '". $sday ."' and nama = '". $re ."' and (codes = '22' or (codes = '0' AND left(partid,3) <> '99-')) "; 
		}else{
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_qty] WHERE cab = '". $sday ."' and  nama = '". $re ."' and codes = '". $bong . "' "; 
		}
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function a36a($bong,$shadow,$partid,$sday,$smonth,$syear, $re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$sql2 = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		if ($bong == 22){
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_b36] WHERE days = '". $sday ."' and name = '". $re ."' and (itemnoso = '22' or (itemnoso = '0' AND left(partid,3) <> '99-')) "; 
		}else{
		$sql2="SELECT (CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) AS acpcs FROM [um_db].[dbo].[shadow_b36] WHERE days = '". $sday ."' and name = '". $re ."' and itemnoso = '". $bong . "' "; 
		}
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function b36a($bong,$shadow,$partid,$sday,$smonth,$syear, $re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE ([s].[divisi] = '". $re ."') AND YEAR(shipdate) = '". $syear ."' AND DAY(shipdate) = '". $sday ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .")"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function tb36a($shadow,$sday,$smonth,$syear,$re) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE ([s].[divisi] = '". $re ."') AND YEAR(shipdate) = '". $syear ."' AND DAY(shipdate) = '". $sday ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acamount"));
		
		
		}
		if ($code == 0){
		
		}else{
		$code = $code/1000;
		}
		return $code;
		}
		public function tb36($shadow,$sday,$smonth,$syear) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND DAY(shipdate) = '". $sday ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acamount"));
		
		
		}
		if ($code == 0){
		
		}else{
		$code = $code/1000;
		}
		return $code;
		}
		public function b36($bong,$shadow,$partid,$sday,$smonth,$syear) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND DAY(shipdate) = '". $sday ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND (". $partid .")"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function b12($bong,$shadow,$partid,$smonth,$syear) {
		$code = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT (CASE WHEN SUM(sd.[quantity]) IS NULL THEN 0 ELSE SUM(sd.[quantity]) END) AS acpcs, (CASE WHEN SUM([sd].[amount]) IS NULL THEN 0 ELSE SUM([sd].[amount]) END) AS acamount FROM ". $shadow ."[SOTRANSACTIONDETAIL] AS sd INNER JOIN ". $shadow ."[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] WHERE YEAR(shipdate) = '". $syear ."' AND MONTH(shipdate) = '". $smonth ."' AND flagposted = 'Y' AND sd.[komisiI] = '0'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"acpcs"));
		
		
		}
		
		return $code;
		}
		public function wherepart($bong,$shadow) {
		$baru = 0;
		$lat = "LEFT(sd.partid,4) = '0000'";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02 WHERE  coderegion = '". $bong ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(sd.partid,". $long .") = '". $code . "'";
		
		}
		
		return $lat;
		}
		public function tglweek($smonth,$syear,$stat) {
		$baru = 0;
		$awal = "";
		$akhir = "";
		$lat = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=UM_DB;", "sa","");
		
		$sql2="select DAY(tgl1) as d1, DAY(tgl2) as d2 from [um_db].[dbo].salesweek where bulan = '". $smonth ."' and tahun = '". $syear ."' and status = '". $stat ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$awal=rtrim(odbc_result($result_set2,"d1"));
		$akhir=rtrim(odbc_result($result_set2,"d2"));
		
		}
		$lat = "( " . $awal . " - " . $akhir . " )";
		return $lat;
		}
		public function wherepart2($bong,$shadow) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT codesubreg01 FROM ". $shadow ."product02 WHERE  coderegion = '". $bong ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$code=rtrim(odbc_result($result_set2,"codesubreg01"));
		$long = strlen($code);
		$lat = $lat . " OR LEFT(sd.partid,". $long .") <> '". $code . "'";
		
		}
		
		return $lat;
		}
		public function acust2($sales, $smonth, $syear, $shadow) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT CustomerID FROM  SOTRANSACTION WHERE month(shipdate) = '". $smonth ."' and year(shipdate) = '". $syear ."' and flagposted = 'Y' and(". $sales . ") GROUP BY CustomerID"; 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"customerid");
		
		$baru = $baru + 1;
		
		}
		
		return $baru;
		}
		public function totcustme2($sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(customerid) FROM customer where salescode = '". $sales ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function ghost($stat, $cabang) {
		$bayangan = "";
		$cab = "";
		$ncab = "";
		$re = "";
		$re = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select * from [UM_DB].[dbo].[shadow] where kcab1 = '". $cabang ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bayangan=odbc_result($result_set2,"bayangan");
		$ncab=odbc_result($result_set2,"cabang");
		$cab=odbc_result($result_set2,"kcab2");
		$re=odbc_result($result_set2,"rename");
		
		}
		
		return array($bayangan, $ncab, $cab, $re);
		}
		public function ghost2($stat, $cabang) {
		$baru = 0;
		$bayangan = "";
		$ncab = "";
		$cab = "";
		$alamas = "";
		$re = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select * from [UM_DB].[dbo].[shadow] where kcab1 = '". $cabang ."' and status = '". $stat ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bayangan=odbc_result($result_set2,"bayangan");
		$ncab=odbc_result($result_set2,"cabang");
		$cab=odbc_result($result_set2,"kcab2");
		$re=odbc_result($result_set2,"rename");
		
		}
		
		return array($bayangan, $ncab, $cab, $re);
		}
		public function ghost1a($stat, $cabang) {
		$baru = 0;
		$bayangan = "";
		$ncab = "";
		$cab = "";
		$alamas = "";
		$re = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select * from [UM_DB].[dbo].[shadow] where kcab1 = '". $cabang ."' and status = 'G'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bayangan=odbc_result($result_set2,"bayangan");
		$ncab=odbc_result($result_set2,"cabang");
		$cab=odbc_result($result_set2,"kcab2");
		$re=odbc_result($result_set2,"rename");
		
		}
		
		return array($bayangan, $ncab, $cab, $re);
		}
		public function ghost1($stat, $cabang) {
		$baru = 0;
		$bayangan = "";
		$ncab = "";
		$cab = "";
		$alamas = "";
		$re = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select * from [UM_DB].[dbo].[shadow] where kcab1 = '". $cabang ."' and status = 'N'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bayangan=odbc_result($result_set2,"bayangan");
		$ncab=odbc_result($result_set2,"cabang");
		$cab=odbc_result($result_set2,"kcab2");
		$re=odbc_result($result_set2,"rename");
		
		}
		
		return array($bayangan, $ncab, $cab, $re);
		}
		public function cekso($soid) {
		$amount = 0;
		$qty = 0;
		$price = 0;
		$disc = 0;
		$tamount = 0;
		$t1=0;
		$t2=0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select * from [sotransactiondetail] where sotransacid = '". $soid ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$amount=odbc_result($result_set2,"amount");
		$qty=odbc_result($result_set2,"quantity");
		$price=odbc_result($result_set2,"unitprice");
		$disc=odbc_result($result_set2,"discpercen");
		$tamount= ($qty * $price);
		if($disc==0 or $tamount == 0){
		$tamount = ($tamount);			
		}else{
		$tamount = ($tamount)-(($tamount*$disc)/100);
		}
		$t1 = $t1 + $amount;
		$t2 = $t2 + $tamount;
		
		}
		
		return array($t1, $t2);
		}
		public function nsalesman2($shadow, $id_sales) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select nama from [salesmanspv] where code = '". $id_sales ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=odbc_result($result_set2,"nama");
		
		}
		
		return $nama;
		}
		public function nsalesman3($shadow, $id_sales) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select divisi from [salesmanspv] where code = '". $id_sales ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=odbc_result($result_set2,"divisi");
		
		}
		
		return $nama;
		}
		public function nsalesman($shadow, $id_sales) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select Name from ". $shadow ."[salesman] where code = '". $id_sales ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=odbc_result($result_set2,"Name");
		
		}
		
		return $nama;
		}
		public function salesnya($cust) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select salescode from [customer] where customerid = '". $cust ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=odbc_result($result_set2,"salescode");
		
		}
		
		return $nama;
		}
		public function tarsalesku($smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(target) FROM salestarget where year(periode) = '". $syear ."' and month(periode) = '". $smonth ."' and mkt_code = '". $sales ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function jkun($sday, $smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT     COUNT(id_kunjung) AS bar FROM kunjunganHeader WHERE (id_sales = '". $sales ."') AND (DAY(tanggal_start) = '". $sday ."') AND (MONTH(tanggal_start) = '". $smonth ."') AND (YEAR(tanggal_start) = '". $syear ."') AND (status = 'Y')"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		
		}
		
		return $baru;
		}
		public function toppartku($user, $divisi, $tgl1, $tgl2) {
		$partid = "";
		$qty = 0;
		$so = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		
		$sql2="SELECT     b.partid as part, a.SOTransacID as soid, b.Quantity as quan FROM SOTRANSACTION a LEFT OUTER JOIN SOTRANSACTIONDETAIL b ON a.SOTransacID = b.SOTransacID WHERE (a.DateEntry > '7/9/2020') AND (a.divisi = 'DGM')"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$partid=odbc_result($result_set2,"part");
		$so=odbc_result($result_set2,"soid");
		$qty=odbc_result($result_set2,"quan");
		$sql="INSERT INTO [toppart] ( divisi, id_user, partid, so, qty ) Values ('". $divisi ."', '". $user ."', '". $partid ."', '". $so ."', '". $quan ."' )"; 
		$result_set = odbc_exec($connection3, $sql2); 
		
		
		}
		odbc_close($connection2);
		unset($connection2);
		odbc_close($connection3);
		unset($connection3);
		return $qty;
		}
		public function cabsale($smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and salesmancode = '". $sales ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function namacust($code, $sugest, $id_cust) {
		$baru = "";
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT custname FROM customer where customerid = '". $id_cust ."'"; 
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"custname");
		
		}
		
		
		return $baru;
		}
		public function colkun($smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT     COUNT(*) AS dom FROM kunjunganHeader WHERE     (MONTH(tanggal_start) = '". $smonth ."') AND (YEAR(tanggal_start) = '". $syear ."') AND (id_sales = '". $sales ."') AND (status = 'Y') GROUP BY DAY(tanggal_start)"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"dom");
		if ($baru < $bar) {
		$baru = $bar;
		}
		
		}
		
		return $baru;
		}
		public function latlongcust($bong) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT lat, long, custaddress FROM customer WHERE  customerid = '". $bong ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$lat=odbc_result($result_set2,"lat");
		$long=odbc_result($result_set2,"long");
		$alamas=odbc_result($result_set2,"custaddress");
		
		}
		
		return array($lat, $long, $alamas);
		}
		public function countkunj($bong, $smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT id_sales FROM kunjunganHeader WHERE (YEAR(tanggal_close) = '". $syear ."') AND (MONTH(tanggal_close) = '". $smonth ."') AND (DAY(tanggal_close) = '". $bong ."') AND id_sales = '". $sales ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"id_sales");
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function mycabs($id_sales) {
		$bar = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select Top 1 divisi from salesmanspv where code = '". $id_sales ."' order by id desc"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"divisi");
		
		}
		
		return $bar;
		}public function countcab($cab) {
		$bar = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select count(code) as CSO from scab where status = 'M'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"CSO");
		
		}
		
		return $bar;
		}
		public function countme($cab, $smonth, $syear) {
		$bar = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select count(code) as CSO from salesmanAktif where div = '". $cab . "' and bln = '". $smonth . "' AND tahun = '". $syear . "'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"CSO");
		
		}
		
		return $bar;
		}
		public function countCustday($smonth, $syear, $day, $cab) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($cab == "DGM" or $cab == "DM" or $cab == "NS1" or $cab == "NS2" or $cab == "NS3" or $cab == "NS4"  or $cab == "TRD" or $cab == "PBO" or $cab = "Ex") {
		$sql2="SELECT customerid AS CSO FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and day(shipdate) = '". $day ."' and FlagPosted = 'Y' and divisi = '". $cab ."' group by customerid"; 
		}
		else {
		$sql2="SELECT customerid AS CSO FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and day(shipdate) = '". $day ."' and FlagPosted = 'Y' and customerid = '". $cab ."' group by customerid"; 
		}
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"CSO");
		$baru = $baru + 1;
		
		}
		
		return $baru;
		}
		public function updateLcost( $id, $jk, $tgl, $comment ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;","sa","");
		$sql="UPDATE [lockME] SET status = '". $jk ."', commentValid = '". $comment ."', tglPosting = '". $tgl ."' WHERE id = '". $id ."'"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function delete36b( $user ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="delete from [shadow_qty] where nama = '". $user ."'"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function delete36( $user ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="delete from [shadow_b36] where name = '". $user ."'"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function deletet20s( $user, $smonth, $syear ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="delete from [shadow_t20s] where name = '". $user ."' and months = '". $smonth ."' and years = '". $syear ."'"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function deletetop20( $user ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="delete from [shadow_top20] where userku = '". $user ."'"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function testinserbc( $barcode ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;","sa","");
		$sql="INSERT INTO [barcodeku] ( inputan ) Values ('". $barcode ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function dinsert36( $user, $amount, $qty, $part, $dayku, $code, $bro ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="INSERT INTO [shadow_b36] ( partid, qty, amount, name, days, itemnoso, benar ) Values ('". $part ."', '". $qty ."', '". $amount ."', '". $user ."', '". $dayku ."', '". $code ."', '". $bro ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertsp1( $salesid, $div, $sp, $syear, $smonth ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		if($div == "DKI"){
			$sql="INSERT INTO [bambi-mg2].[dbo].komisi_sales3_sp ( sotransacid, salesmancode, bulan, tahun, keterangan, flagprint, flagposting ) Values ('CRM', '". $salesid ."', '". $smonth ."', '". $syear ."', '". $sp ."', 'N', 'N')"; 
		$baru = 1;
		}elseif($div == "JBR"){
			$sql="INSERT INTO [bambi04].[dbo].komisi_sales3_sp ( sotransacid, salesmancode, bulan, tahun, keterangan, flagprint, flagposting ) Values ('CRM', '". $salesid ."', '". $smonth ."', '". $syear ."', '". $sp ."', 'N', 'N')"; 
		$baru = 2;
		}else{
			$sql="INSERT INTO [bambi-bmi].[dbo].komisi_sales3_sp ( sotransacid, salesmancode, bulan, tahun, keterangan, flagprint, flagposting ) Values ('CRM', '". $salesid ."', '". $smonth ."', '". $syear ."', '". $sp ."', 'N', 'N')"; 
		$baru = 3;
		}
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertwhe( $user, $amount, $qty, $part, $dayku, $code ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="INSERT INTO [shadow_b36] ( partid, qty, amount, name, days, itemnoso ) Values ('". $part ."', '". $qty ."', '". $amount ."', '". $user ."', '". $dayku ."', '". $code ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insert36( $user, $amount, $qty, $part, $dayku, $code ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="INSERT INTO [shadow_b36] ( partid, qty, amount, name, days, itemnoso ) Values ('". $part ."', '". $qty ."', '". $amount ."', '". $user ."', '". $dayku ."', '". $code ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertcust36( $user, $amount, $qty, $part, $dayku, $code, $cust ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="INSERT INTO [shadow_b36] ( partid, qty, amount, name, days, itemnoso, cust ) Values ('". $part ."', '". $qty ."', '". $amount ."', '". $user ."', '". $dayku ."', '". $code ."', '". $cust ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertcust20lastyear( $user, $amount, $qty, $part, $dayku, $code, $cust, $yearku, $monku, $div, $unitku, $unitorgku, $cqtyoc, $kota, $kota2, $sid, $disc ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="INSERT INTO [shadow_t20s] ( partid, qty, amount, name, days, itemnoso, cust, years, months, div, unitprice, unitprice_org, soid, qtyCancel, kotamadya, region, disc ) Values ('". $part ."', '". $qty ."', '". $amount ."', '". $user ."', '". $dayku ."', '". $code ."', '". $cust ."', '". $yearku ."', '". $monku ."', '". $div ."', '". $unitku ."', '". $unitorgku ."', '". $sid ."', '". $cqtyoc ."', '". $kota ."', '". $kota2 ."', '". $disc ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertcust36lastyear( $user, $amount, $qty, $part, $dayku, $code, $cust, $yearku ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="INSERT INTO [shadow_b36] ( partid, qty, amount, name, days, itemnoso, cust, years ) Values ('". $part ."', '". $qty ."', '". $amount ."', '". $user ."', '". $dayku ."', '". $code ."', '". $cust ."', '". $yearku ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertsums($nama, $cust) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(amount) FROM shadow_b36 where name = '". $nama ."' AND partid = '". $cust ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		$sql="INSERT INTO [shadow_top20] ( userku, nama, amount ) Values ('". $nama ."', '". $cust ."', '". $baru ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertsumx($nama, $cust, $syear, $syear2, $syear3) {
		$baru = 0;
		$baru1 = 0;
		$baru0 = 0;
		$barua = 0;
		$barub = 0;
		$baruc = 0;
		
		$bar = 0;
		$bar1 = 0;
		$bar0 = 0;
		$bara = 0;
		$bar1b = 0;
		$bar0c = 0;
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(amount) FROM shadow_b36 where name = '". $nama ."' AND partid = '". $cust ."' and years = '". $syear ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		$sql="SELECT COALESCE( (SELECT sum(amount) FROM shadow_b36 where name = '". $nama ."' AND partid = '". $cust ."' and years = '". $syear2 ."'), 0) AS bar"; 
		
		
		$result_set = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set)) {
		$bar1=odbc_result($result_set,"bar");
		$baru1 = $baru1 + $bar1;
		
		}
		$sql0="SELECT COALESCE( (SELECT sum(amount) FROM shadow_b36 where name = '". $nama ."' AND partid = '". $cust ."' and years = '". $syear3 ."'), 0) AS bar"; 
		
		
		$result_set0 = odbc_exec($connection2, $sql0); 
		while(odbc_fetch_row($result_set0)) {
		$bar0=odbc_result($result_set0,"bar");
		$baru0 = $baru0 + $bar0;
		
		}
		
		$sql21="SELECT COALESCE( (SELECT sum(qty) FROM shadow_b36 where name = '". $nama ."' AND partid = '". $cust ."' and years = '". $syear ."'), 0) AS bar"; 
		
		
		$result_set21 = odbc_exec($connection2, $sql21); 
		while(odbc_fetch_row($result_set21)) {
		$bara=odbc_result($result_set21,"bar");
		$barua = $barua + $bara;
		
		}
		$sqlb="SELECT COALESCE( (SELECT sum(qty) FROM shadow_b36 where name = '". $nama ."' AND partid = '". $cust ."' and years = '". $syear2 ."'), 0) AS bar"; 
		
		
		$result_setb = odbc_exec($connection2, $sqlb); 
		while(odbc_fetch_row($result_setb)) {
		$bar1b=odbc_result($result_setb,"bar");
		$barub = $barub + $bar1b;
		
		}
		$sql0c="SELECT COALESCE( (SELECT sum(qty) FROM shadow_b36 where name = '". $nama ."' AND partid = '". $cust ."' and years = '". $syear3 ."'), 0) AS bar"; 
		
		
		$result_set0c = odbc_exec($connection2, $sql0c); 
		while(odbc_fetch_row($result_set0c)) {
		$bar0c=odbc_result($result_set0c,"bar");
		$baruc = $baruc + $bar0c;
		
		}
		
		$sql="INSERT INTO [shadow_top20] ( userku, nama, amount, amount2, amount3, qty, qty2, qty3 ) Values ('". $nama ."', '". $cust ."', '". $baru ."', '". $baru1 ."', '". $baru0 ."', '". $barua ."', '". $barub ."', '". $baruc ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertsum($nama, $cust, $syear, $syear2, $syear3) {
		$baru = 0;
		$baru1 = 0;
		$baru0 = 0;
		$barua = 0;
		$barub = 0;
		$baruc = 0;
		
		$bar = 0;
		$bar1 = 0;
		$bar0 = 0;
		$bara = 0;
		$bar1b = 0;
		$bar0c = 0;
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(amount) FROM shadow_b36 where name = '". $nama ."' AND cust = '". $cust ."' and years = '". $syear ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		$sql="SELECT COALESCE( (SELECT sum(amount) FROM shadow_b36 where name = '". $nama ."' AND cust = '". $cust ."' and years = '". $syear2 ."'), 0) AS bar"; 
		
		
		$result_set = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set)) {
		$bar1=odbc_result($result_set,"bar");
		$baru1 = $baru1 + $bar1;
		
		}
		$sql0="SELECT COALESCE( (SELECT sum(amount) FROM shadow_b36 where name = '". $nama ."' AND cust = '". $cust ."' and years = '". $syear3 ."'), 0) AS bar"; 
		
		
		$result_set0 = odbc_exec($connection2, $sql0); 
		while(odbc_fetch_row($result_set0)) {
		$bar0=odbc_result($result_set0,"bar");
		$baru0 = $baru0 + $bar0;
		
		}
		
		$sql21="SELECT COALESCE( (SELECT sum(qty) FROM shadow_b36 where name = '". $nama ."' AND cust = '". $cust ."' and years = '". $syear ."'), 0) AS bar"; 
		
		
		$result_set21 = odbc_exec($connection2, $sql21); 
		while(odbc_fetch_row($result_set21)) {
		$bara=odbc_result($result_set21,"bar");
		$barua = $barua + $bara;
		
		}
		$sqlb="SELECT COALESCE( (SELECT sum(qty) FROM shadow_b36 where name = '". $nama ."' AND cust = '". $cust ."' and years = '". $syear2 ."'), 0) AS bar"; 
		
		
		$result_setb = odbc_exec($connection2, $sqlb); 
		while(odbc_fetch_row($result_setb)) {
		$bar1b=odbc_result($result_setb,"bar");
		$barub = $barub + $bar1b;
		
		}
		$sql0c="SELECT COALESCE( (SELECT sum(qty) FROM shadow_b36 where name = '". $nama ."' AND cust = '". $cust ."' and years = '". $syear3 ."'), 0) AS bar"; 
		
		
		$result_set0c = odbc_exec($connection2, $sql0c); 
		while(odbc_fetch_row($result_set0c)) {
		$bar0c=odbc_result($result_set0c,"bar");
		$baruc = $baruc + $bar0c;
		
		}
		
		$sql="INSERT INTO [shadow_top20] ( userku, nama, amount, amount2, amount3, qty, qty2, qty3 ) Values ('". $nama ."', '". $cust ."', '". $baru ."', '". $baru1 ."', '". $baru0 ."', '". $barua ."', '". $barub ."', '". $baruc ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertLcost( $sales, $jk, $tgl, $bos, $comment, $idu ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;","sa","");
		$sql="INSERT INTO [lockME] ( sales, jenisLock, tglInput, userInput, userValid, commentInput, status ) Values ('". $sales ."', '". $jk ."', '". $tgl ."', '". $idu ."', '". $bos ."', '". $comment ."', 'A' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function inserttest( $nama, $tanggal, $gaji ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;","sa","");
		$sql="INSERT INTO [test2] ( nama, tgl, gaji ) Values ('". $nama ."', '". $tanggal ."', '". $gaji ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertcost( $nama, $jk, $jk2, $sat, $type, $qty, $sales, $comment, $div, $tanggal, $costing, $path ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;","sa","");
		$sql="INSERT INTO [costingHeader] ( costing, nama, sales, jenisOrder, typeku, qtyOrder, comment, div, status, tanggal, pathku, statusOrder, ketjenis, satuan ) Values ('". $costing ."', '". $nama ."', '". $sales ."', '". $jk ."', '". $type ."', '". $qty ."', '". $comment ."', '". $div ."', 'B', '". $tanggal ."', '". $path ."', 'open', '". $jk2 ."', '". $sat ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function insertcostdetail( $ids, $tanggal, $user, $comment, $clas, $costing, $soid, $pathku, $price ) {
		$stat = "";
		$color = "";
		if ($clas == "4" or $clas == "3" or $clas == "2"){
		$stat="M";
		$color = "#7FCDCD";
		}
		elseif ($clas=="5"){
		$stat="C";
		$color = "#e2b13c";
		}
		else {
		$stat="S";
		$color = "#e2b13c";
		}
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;","sa","");
		$sql="INSERT INTO [costingDetail] ( ids, tanggal, userInput, comment, pathku, status, color ) Values ('". $ids ."', '". $tanggal ."', '". $user ."', '". $comment ."', '". $pathku ."', 'Y', '". $color ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;","sa","");
		if ($price > 0) {
		$sql2="UPDATE [costingHeader] SET status = '". $stat ."', statusOrder = '". $costing ."', harga = '". $price ."' where id = '". $ids ."'";
		
		} else {
		$sql2="UPDATE [costingHeader] SET status = '". $stat ."', statusOrder = '". $costing ."', soid = '". $soid ."' where id = '". $ids ."'"; 
		}
		//$sql2="UPDATE [costingHeader] SET status = '". $stat ."', statusOrder = '". $costing ."', soid = '". $soid ."' where id = '". $ids ."'"; 
		$result_set2 = odbc_exec($connection3, $sql2); 
		odbc_close($connection3);
		unset($connection3);
		
		return $ids;
		}
		public function approvecosting( $ids, $tanggal, $user, $comment, $clas, $costing, $soid, $pathku ) {
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;","sa","");
		$sql2="UPDATE [costingHeader] SET status = 'Y', tanggal = '". $tanggal ."' where id = '". $ids ."'"; 
		$result_set2 = odbc_exec($connection3, $sql2); 
		odbc_close($connection3);
		unset($connection3);
		
		return $ids;
		}
		public function targetsumx22($div, $codes, $syear, $id) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$sql2=""; 
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-mg2].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')
		+ (SELECT sum(". $codes . ") FROM [bambi-tm].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi04].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-sg].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bmn].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DM' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'EX' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-SB' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0601' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0602' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0603' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'ns4' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-MM' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DGM' AND code = '". $id . "'), 0) AS bar";
		
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=rtrim(odbc_result($result_set2, "bar"));
		}
		
		return $nama;
		}
		public function targetsumx2($div, $codes, $syear, $id) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$sql2=""; 
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-mg2].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi04].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-sg].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DM' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-SB' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0601' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0602' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0603' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'ns4' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-MM' AND code = '". $id . "')
		+(SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DGM' AND code = '". $id . "'), 0) AS bar";
		
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=rtrim(odbc_result($result_set2, "bar"));
		}
		
		return $nama;
		}
		public function targetsumx($div, $codes, $syear, $id) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$sql2=""; 
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($div == "MD"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-mg2].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "')), 0) AS bar"; 
		
		}elseif ($div == "RM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-tm].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "'), 0) AS bar"; 
		
		}elseif ($div == "BD"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi04].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "'), 0) AS bar"; 
		
		}elseif ($div == "SG"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-sg].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "'), 0) AS bar"; 
		
		}elseif ($div == "BMN"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bmn].[dbo].product01_2020 where tahun = '". $syear . "' AND code = '". $id . "'), 0) AS bar"; 
		
		}elseif ($div == "DGM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DGM' AND code = '". $id . "'), 0) AS bar";
		
		}elseif ($div == "DM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DM' AND code = '". $id . "'), 0) AS bar";
		
		}elseif ($div == "EX"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'EX' AND code = '". $id . "'), 0) AS bar"; 
		
		}elseif ($div == "SB"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-SB' AND code = '". $id . "'), 0) AS bar";
		
		}elseif ($div == "NS1"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0601' AND code = '". $id . "'), 0) AS bar"; 
		
		}elseif ($div == "NS2"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0602' AND code = '". $id . "'), 0) AS bar"; 
		
		}elseif ($div == "NS3"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0603' AND code = '". $id . "'), 0) AS bar";
		
		}elseif ($div == "NS4"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0604' AND code = '". $id . "'), 0) AS bar";
		
		}elseif ($div == "MM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-MM' AND code = '". $id . "'), 0) AS bar"; 
		
		}else{
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DGM' AND code = '". $id . "'), 0) AS bar";
		
		}
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=rtrim(odbc_result($result_set2, "bar"));
		}
		
		return $nama;
		}
		public function targetsum2($div, $codes, $syear, $cat) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$sql2=""; 
		if($cat == 'Anna')
		{
		$tambah="code = '12' or code = '13'"; 
		}elseif($cat == 'AA'){
		$tambah="code = '23' or code = '28' or code = '29' or code = '30'"; 
		}elseif($cat == 'Daniel'){ 
		$tambah="code = '1' or code = '9'"; 
		}elseif($cat == 'Lia'){
		$tambah="code = '4' or code = '5' or code = '7' or code = '8' or code = '21'"; 
		}elseif($cat == 'Ricky'){
		$tambah="code = '2' or code = '24' or code = '31'"; 
		}elseif($cat == 'Nata'){
		$tambah="code = '3' or code = '6' or code = '10' or code = '11' or code = '14' or code = '15' or code = '16' or code = '17' or code = '18' or code = '19' or code = '20' or code = '22' or code = '25' or code = '26' or code = '27' or code = '32' or code = '33' or code = '34' or code = '35' or code = '36'"; 
		}else{
		$tambah="code <> '0'"; 
		
		}
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($div == "MD"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-mg2].[dbo].product01_2020 where tahun = '". $syear . "'  and code = '1'), 0) AS bar"; 
		
		}elseif ($div == "RM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-tm].[dbo].product01_2020 where tahun = '". $syear . "'  and code = '1'), 0) AS bar"; 
		
		}elseif ($div == "BD"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi04].[dbo].product01_2020 where tahun = '". $syear . "' and code = '1'), 0) AS bar"; 
		
		}elseif ($div == "SG"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-sg].[dbo].product01_2020 where tahun = '". $syear . "'  and code = '1'), 0) AS bar"; 
		
		}elseif ($div == "BMN"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bmn].[dbo].product01_2020 where tahun = '". $syear . "'  and code = '1'), 0) AS bar"; 
		
		}elseif ($div == "DGM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DGM'  and code = '1'), 0) AS bar";
		
		}elseif ($div == "DM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DM'  and code = '1'), 0) AS bar";
		
		}elseif ($div == "EX"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'EX'  and code = '1'), 0) AS bar"; 
		
		}elseif ($div == "SB"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-SB'  and code = '1'), 0) AS bar";
		
		}elseif ($div == "NS1"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0601'  and code = '1'), 0) AS bar"; 
		
		}elseif ($div == "NS2"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0602' and code = '1'), 0) AS bar"; 
		
		}elseif ($div == "NS3"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0603'  and code = '1'), 0) AS bar";
		
		}elseif ($div == "NS4"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'NS4' and code = '1'), 0) AS bar";
		
		}elseif ($div == "MM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-MM'  and code = '1'), 0) AS bar"; 
		
		}else{
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DGM'  and code = '1'), 0) AS bar";
		
		}
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=rtrim(odbc_result($result_set2, "bar"));
		}
		
		return $nama;
		}
		public function targetsum($div, $codes, $syear, $cat) {
		$baru = 0;
		$lat = "";
		$long = "";
		$alamas = "";
		$nama = "";
		$sql2=""; 
		if($cat == 'AA'){
		$tambah="code = '20' or code = '27' or code = '28' or code = '29'"; 
		}elseif($cat == 'Benny'){ 
		$tambah="code = '1'"; 
		}elseif($cat == 'Daniel'){ 
		$tambah="code = '9'"; 
		}elseif($cat == 'Lia'){
		$tambah="code = '4' or code = '5' or code = '7' or code = '8'"; 
		}elseif($cat == 'Ricky'){
		$tambah="code = '2' or code = '21' or code = '22' or code = '30'"; 
		}elseif($cat == 'Nata'){
		$tambah="code = '31' or code = '24' or code = '12' or code = '13' or code = '3' or code = '6' or code = '10' or code = '11' or code = '14' or code = '15' or code = '16' or code = '17' or code = '18' or code = '19' or code = '20' or code = '22' or code = '25' or code = '26' or code = '27' or code = '32' or code = '33' or code = '34' or code = '35' or code = '36'"; 
		}else{
		$tambah="code <> '0'"; 
		 
		}
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($div == "MD"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-mg2].[dbo].product01_2020 where tahun = '". $syear . "' AND (". $tambah . ")), 0) AS bar"; 
		
		}elseif ($div == "RM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-tm].[dbo].product01_2020 where tahun = '". $syear . "' AND (". $tambah . ")), 0) AS bar"; 
		
		}elseif ($div == "BD"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi04].[dbo].product01_2020 where tahun = '". $syear . "' AND (". $tambah . ")), 0) AS bar"; 
		
		}elseif ($div == "SG"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-sg].[dbo].product01_2020 where tahun = '". $syear . "' AND (". $tambah . ")), 0) AS bar"; 
		
		}elseif ($div == "BMN"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bmn].[dbo].product01_2020 where tahun = '". $syear . "' AND (". $tambah . ")), 0) AS bar"; 
		
		}elseif ($div == "DGM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DGM' AND (". $tambah . ")), 0) AS bar";
		
		}elseif ($div == "DM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DM' AND (". $tambah . ")), 0) AS bar";
		
		}elseif ($div == "EX"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'EX' AND (". $tambah . ")), 0) AS bar"; 
		
		}elseif ($div == "SB"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-SB' AND (". $tambah . ")), 0) AS bar";
		
		}elseif ($div == "NS1"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0601' AND (". $tambah . ")), 0) AS bar"; 
		
		}elseif ($div == "NS2"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0602' AND (". $tambah . ")), 0) AS bar"; 
		
		}elseif ($div == "NS3"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'bambi0603' AND (". $tambah . ")), 0) AS bar";
		
		}elseif ($div == "NS4"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'NS4' AND (". $tambah . ")), 0) AS bar";
		
		}elseif ($div == "MM"){
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'BAMBI-MM' AND (". $tambah . ")), 0) AS bar"; 
		
		}else{
		$sql2="SELECT COALESCE( (SELECT sum(". $codes . ") FROM [bambi-bmi].[dbo].product01_2020 where tahun = '". $syear . "' and cabang = 'DGM' AND (". $tambah . ")), 0) AS bar";
		
		}
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$nama=rtrim(odbc_result($result_set2, "bar"));
		}
		
		return $nama;
		}
		public function countCust($smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT customerid AS CSO FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and salesmancode = '". $sales ."' and FlagPosted = 'Y' group by customerid"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"CSO");
		$baru = $baru + 1;
		
		}
		
		return $baru;
		}
		public function countSOday($smonth, $syear, $day, $cab) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($cab == "DGM" or $cab == "DM" or $cab == "NS1" or $cab == "NS2" or $cab == "NS3" or $cab == "NS4" or $cab == "TRD" or $cab == "PBO" or $cab = "Ex") {
		$sql2="SELECT COALESCE( (SELECT count(SOTransacID) AS CSO FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and day(shipdate) = '". $day ."' and FlagPosted = 'Y' and divisi = '". $cab ."'), 0) AS bar"; 
		} else {
		$sql2="SELECT COALESCE( (SELECT count(SOTransacID) AS CSO FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and day(shipdate) = '". $day ."' and FlagPosted = 'Y' and customerid = '". $cab ."'), 0) AS bar"; 
		}
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function countlockku2($sales) {
		$baru = 0;
		$bar = 0;
		$tanggalnow = date("m/d/Y");
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select id from [costingHeader] where sales = '". $sales . "' AND statusOrder = 'open' AND (DATEDIFF(DAY, tanggal, '". $tanggalnow . "') > 14) order by id desc";
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"id");
		$bar = 1;
		
		}
		
		return $bar;
		}
		public function countlockku($sales, $sday, $smonth, $syear, $jk) {
		$baru = 0;
		$bar = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT count(id) As bon FROM lockME where sales = '". $sales ."'AND jenisLock = '". $jk ."' AND  YEAR(tglInput) = '". $syear ."' AND  month(tglInput) = '". $smonth ."' AND  day(tglInput) = '". $sday ."' and status = 'Y'";
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"bon");
		
		
		}
		
		return $qty;
		}
		public function countlock($sales, $smonth, $syear, $status) {
		$baru = 0;
		$bar = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT count(id) As bon FROM lockME where sales = '". $sales ."'AND jenisLock = '". $status ."' AND  YEAR(tglInput) = '". $syear ."' AND  month(tglInput) = '". $smonth ."'";
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"bon");
		
		
		}
		
		return $qty;
		}
		public function Tsumkal($smonth, $status) {
		$baru = 0;
		$bar = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT harga, qtyOrder FROM costingHeader where month(tanggal) = '". $smonth ."' and statusOrder = '". $status ."'";
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"qtyOrder");
		$harga=odbc_result($result_set2,"harga");
		
		$bar = $qty * $harga;
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkal($sales, $smonth, $status) {
		$baru = 0;
		$bar = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT harga, qtyOrder FROM costingHeader where sales = '". $sales ."' AND  month(tanggal) = '". $smonth ."' and statusOrder = '". $status ."'";
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"qtyOrder");
		$harga=odbc_result($result_set2,"harga");
		
		$bar = $qty * $harga;
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function Tcountkal($smonth, $status) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(id) AS CSO FROM costingHeader where  month(tanggal) = '". $smonth ."' and statusOrder = '". $status ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function countkal($sales, $smonth, $status) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(id) AS CSO FROM costingHeader where sales = '". $sales ."' AND  month(tanggal) = '". $smonth ."' and statusOrder = '". $status ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function countSO($smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(SOTransacID) AS CSO FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and salesmancode = '". $sales ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sales2($smonth, $syear, $div) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select code from salesmanAktif where div = '". $div ."' and bln = '". $smonth ."' and tahun = '". $syear ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"code");
		$baru = $baru . " or sales = '" . $bar . "'";
		
		}
		
		return $baru;
		}
		public function sales1($smonth, $syear, $div) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select code from salesmanAktif where div = '". $div ."' and bln = '". $smonth ."' and tahun = '". $syear ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"code");
		$baru = $baru . " or salescode = '" . $bar . "'";
		
		}
		
		return $baru;
		}
		public function locati($div, $sales, $smonth, $syear) {
		$baru = 0;
		$TS = 0;
		$PTS = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT a.id_cust, b.lat as lats, b.long As longs, a.lat AS lato, a.long AS longo FROM kunjunganHeader a LEFT OUTER JOIN customer b ON a.id_cust = b.customerid WHERE a.id_sales = '". $sales ."' and month(a.tanggal_close) = '". $smonth ."' and year(a.tanggal_close) = '". $syear ."'  and a.id_cust <> 'PROSPEK1' AND a.id_cust <> 'PROSPEK2' AND a.id_cust <> 'PROSPEK3' AND a.id_cust <> 'PROSPEK4' AND a.id_cust <> 'PROSPEK5' and b.stat = 'Y' AND (a.lat IS NOT NULL) "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$latitude1=doubleval(odbc_result($result_set2,"lato"));
		$longitude1=doubleval(odbc_result($result_set2,"longo"));
		$clat1=odbc_result($result_set2,"lats");
		$clong1=odbc_result($result_set2,"longs");
		$clat2 = substr($clat1, -1);
		if ($clat2 == "S"){
		$clat = "-" . substr($clat1, 0, -1);
		} 
		else {
		$clat = $clat1;
		}
		$clong2 = substr($clong1, -1);
		if ($clong2 == "E"){
		$clong = substr($clong1, 0, -1);
		}
		else {
		$clong = $clong1;
		}
		$latitude2 = doubleval($clat);
		$longitude2 = doubleval($clong);
		$theta = $longitude1 - $longitude2;
		$miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
		$miles = acos($miles);
		$miles = rad2deg($miles);
		$miles = $miles * 60 * 1.1515;
		$kilometers = $miles * 1.609344;
		$meters = $kilometers * 1000;
		if ($meters > 100){
		$TS = $TS + 1;
		}
		$baru = $baru + 1;
		
		}
		if ($TS == 0){
		$PTS = 0;
		}else{
		$PTS = ($TS / $baru) * 100;
		}
		return $PTS;
		}
		public function Tikcust($sales, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT count(id_cust) as bin FROM  kunjunganheader WHERE month(tanggal_close) = '". $smonth ."' and year(tanggal_close) = '". $syear ."' and id_sales = '". $sales . "' GROUP BY id_cust"; 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bin");
		
		$baru = $baru + 1;
		
		}
		
		return $baru;
		}
		public function acust($div, $sales, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		if ($div == "DM" or $div == "TRD" or $div == "Ex" or $div == "DGM" or $div == "SB" or $div == "NS1" or $div == "NS2" or $div == "NS3") {
		$sql2="SELECT CustomerID, custname FROM  SOTRANSACTION WHERE (divisi = '". $div ."') and month(shipdate) = '". $smonth ."' and year(shipdate) = '". $syear ."' and flagposted = 'Y' and salesmancode = '". $sales . "' GROUP BY CustomerID, custname"; 
		}
		else {
		$sql2="SELECT CustomerID, custname FROM  SOTRANSACTION WHERE (customerid = '". $div ."') and month(shipdate) = '". $smonth ."' and year(shipdate) = '". $syear ."' and flagposted = 'Y' and salesmancode = '". $sales . "' GROUP BY CustomerID, custname"; 
		}
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"customerid");
		
		$baru = $baru + 1;
		
		}
		
		return $baru;
		}
		public function totcustme($div, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(customerid) FROM customer where salescode = '". $sales ."' and divcode = '". $div ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function totcust($div, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(customerid) FROM customer where (salescode = 'randilla' ". $sales ." )  and divcode = '". $div ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function totkunme2($sday, $smonth, $syear, $div, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT id_cust FROM kunjunganHeader where div = '". $div ."' and id_sales = '". $sales ."' group by id_cust"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"id_cust");
		$baru = $baru + 1;
		
		}
		
		return $baru;
		}
		public function totkunme($sday, $smonth, $syear, $div, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(id_kunjung) FROM kunjunganHeader where month(tanggal_close) = '". $smonth ."' and year(tanggal_close) = '". $syear ."' and div = '". $div ."' and id_sales = '". $sales ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function totkun($smonth, $syear, $div, $sday) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(id_kunjung) FROM kunjunganHeader where month(tanggal_close) = '". $smonth ."' and year(tanggal_close) = '". $syear ."'and day(tanggal_close) = '". $sday ."' and div = '". $div ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function totplanme($sday, $smonth, $syear, $div, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(id) FROM kunjunganPlan where month(planDate) = '". $smonth ."' and day(planDate) = '". $sday ."' and year(planDate) = '". $syear ."' and div = '". $div ."' and sales = '". $sales ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function totplan($smonth, $syear, $div, $sday) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(id) FROM kunjunganPlan where month(planDate) = '". $smonth ."' and day(planDate) = '". $sday ."' and year(planDate) = '". $syear ."' and div = '". $div ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumsalesku($smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and salesmancode = '". $sales ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function multi($id_sales) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=UM_DB;", "sa","");
		$sql="SELECT     TOP 1 partname FROM         shadow_part WHERE     (partid = '". $id_sales ."')"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"partname");
		}
		
		
		odbc_close($connection2);
		unset($connection2);
		
		return $baru;
		}
		public function countplankunj2($bong, $smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT sales FROM kunjunganPlan WHERE (YEAR(planDate) = '". $syear ."') AND (MONTH(planDate) = '". $smonth ."') AND (DAY(planDate) = '". $bong ."') AND sales = '". $sales ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"sales");
		$baru = $baru + 1;
		}
		$baru = $baru + 5;
		return $baru;
		}
		public function countplankunj($bong, $smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT id_sales FROM kunjunganHeader WHERE (YEAR(tanggal_close) = '". $syear ."') AND (MONTH(tanggal_close) = '". $smonth ."') AND (DAY(tanggal_close) = '". $bong ."') AND id_sales = '". $sales ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"id_sales");
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function countplankunjasli($bong, $smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT sales FROM kunjunganPlan WHERE (YEAR(planDate) = '". $syear ."') AND (MONTH(planDate) = '". $smonth ."') AND (DAY(planDate) = '". $bong ."') AND sales = '". $sales ."'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"sales");
		$baru = $baru + 1;
		}
		
		return $baru;
		}
		public function colpkun($smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT     COUNT(*) AS dom FROM kunjunganPlan WHERE     (MONTH(planDate) = '". $smonth ."') AND (YEAR(planDate) = '". $syear ."') AND (sales = '". $sales ."') GROUP BY DAY(planDate)"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"dom");
		if ($baru < $bar) {
		$baru = $bar;
		}
		
		}
		
		return $baru;
		}
		public function t20view1($code, $syear, $smonth) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(amount) FROM shadow_t20s where div = '". $code ."' and years = '". $syear ."' and months = '". $smonth ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function gb20view($code, $syear, $smonth) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(unitprice_org) FROM shadow_t20s where div = '". $code ."' and years = '". $syear ."' and months = '". $smonth ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function g20view($code, $syear) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(unitprice_org) FROM shadow_t20s where div = '". $code ."' and years = '". $syear ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function t20view($code, $syear) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(amount) FROM shadow_t20s where div = '". $code ."' and years = '". $syear ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function d20kurs($code, $syear, $smonth) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="SELECT ". $code ." as bar FROM targetbambi where  tahun = '". $syear ."' and kodebulan = '". $smonth ."'"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function d20viewbbmi($code, $syear, $smonth) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(". $code .") FROM targetbambi where  tahun = '". $syear ."' and kodebulan = '". $smonth ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function d20viewbmi($code, $syear) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(". $code .") FROM targetbambi where  tahun = '". $syear ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function d20viewb($code, $syear, $smonth) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(". $code .") FROM targetbambi where  tahun = '". $syear ."' and kodebulan = '". $smonth ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function d20view($code, $syear) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(". $code .") FROM targetbambi where  tahun = '". $syear ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function visitdet($code, $smonth, $syear, $bong) {
		$baru = 0;
		$namapt = "";
		$notelp = "";
		$alamat = "";
		$pic = "";
		$JKunjungan = "";
		$ket = "";
		$slat = "";
		$slong = "";
		$lat = "";
		$long = "";
		$min = "";
		$mon = "";
		$foto = "";
		$sket = "";
		$accu = "";
		$accu2 = "";
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT *, CONVERT(VARCHAR(5),tanggal_start,108) As min, CONVERT(VARCHAR(5),tanggal_close,108) As mon FROM kunjunganHeader WHERE id_custsugest = '". $code ."' AND (YEAR(tanggal_close) = '". $syear ."') AND (MONTH(tanggal_close) = '". $smonth ."') AND (DAY(tanggal_close) = '". $bong ."')"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$namapt=odbc_result($result_set2,"namapt");
		$notelp=odbc_result($result_set2,"notelp");
		$alamat=odbc_result($result_set2,"alamat");
		$pic=odbc_result($result_set2,"pic");
		$JKunjungan=odbc_result($result_set2,"JKunjungan");
		$ket=odbc_result($result_set2,"ket");
		$slat=odbc_result($result_set2,"slat");
		$slong=odbc_result($result_set2,"slong");
		$lat=odbc_result($result_set2,"lat");
		$long=odbc_result($result_set2,"long");
		$min=odbc_result($result_set2,"min");
		$mon=odbc_result($result_set2,"mon");
		$foto=odbc_result($result_set2,"foto1");
		$sket=odbc_result($result_set2,"sketerangan");
		$accu=odbc_result($result_set2,"accuracy1");
		$accu2=odbc_result($result_set2,"accuracy2");
		
		}
		
		return array($namapt, $notelp, $alamat, $pic, $JKunjungan, $ket, $slat, $slong, $lat, $long, $min, $mon,$foto,$sket,$accu,$accu2);
		}
		public function namacustomers($id_cust, $shadow) {
		$baru = "";
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT custname FROM ". $shadow ."customer where customerid = '". $id_cust ."'"; 
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"custname");
		
		}
		
		return $baru;
		}
		public function namacustomer($id_cust) {
		$baru = "";
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT custname FROM customer where customerid = '". $id_cust ."'"; 
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"custname");
		
		}
		
		
		
		return $baru;
		}
		public function alamatcustomer($id_cust) {
		$baru = "";
		
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT CustAddress FROM customer where customerid = '". $id_cust ."'"; 
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"CustAddress");
		
		}
		
		
		
		return $baru;
		}
		public function updatecus($id_cust, $lat, $long) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="UPDATE [customer] SET lat = '". $lat ."', long = '". $long ."', stat = 'Y' where customerid = '". $id_cust ."'"; 
		$result_set = odbc_exec($connection2, $sql); 
		return $baru;
		}
		public function insertplankunplus($id_cust, $pdate, $ts, $te, $datenow, $sales, $comment, $div) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="INSERT INTO [kunjunganPlan] ( idCust, planDate, timeStart, timeEnd, dateInput, status, sales, comment, div, sadd ) Values ('". $id_cust ."', '". $pdate ."', '". $ts ."', '". $te ."', '". $datenow ."', 'Y', '". $sales ."', '". $comment ."', '". $div ."', 'Y' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		return $baru;
		}
		public function insertplanbmi($id_cust, $pdate, $datenow, $sales, $div) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="INSERT INTO [kunjunganPlan] ( idCust, planDate, dateInput, status, sales, div ) Values ('". $id_cust ."', '". $pdate ."', '". $datenow ."', 'Y', '". $sales ."', '". $div ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		return $baru;
		}
		public function insertplankun($id_cust, $pdate, $ts, $te, $datenow, $sales, $comment, $div) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="INSERT INTO [kunjunganPlan] ( idCust, planDate, timeStart, timeEnd, dateInput, status, sales, comment, div ) Values ('". $id_cust ."', '". $pdate ."', '". $ts ."', '". $te ."', '". $datenow ."', 'Y', '". $sales ."', '". $comment ."', '". $div ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		return $baru;
		}
		public function insertplankundki($id_cust, $pdate, $ts, $te, $datenow, $sales, $comment) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-mg2;", "sa","");
		$sql="INSERT INTO [kunjungandetail] ( salesid, customerid, tanggal, nama, jam01, jam02, keterangan ) Values ('". $sales ."', '". $id_cust ."', '". $pdate ."', '". $id_cust ."', '". $ts ."', '". $te ."', '". $comment ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		return $baru;
		}
		public function insertplankunjbr($id_cust, $pdate, $ts, $te, $datenow, $sales, $comment) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi04;", "sa","");
		$sql="INSERT INTO [kunjungandetail] ( salesid, customerid, tanggal, nama, jam01, jam02, keterangan ) Values ('". $sales ."', '". $id_cust ."', '". $pdate ."', '". $id_cust ."', '". $ts ."', '". $te ."', '". $comment ."')"; 
		$result_set = odbc_exec($connection2, $sql); 
		return $baru;
		}
		public function tglkukab($no) {
		if ($no == "1"){
		$tgl = "31";
		}
		elseif ($no == "2"){
		$tgl = "29";
		}
		elseif ($no == "3"){
		$tgl = "31";
		}
		elseif ($no == "4"){
		$tgl = "30";
		}
		elseif ($no == "5"){
		$tgl = "31";
		}
		elseif ($no == "6"){
		$tgl = "30";
		}
		elseif ($no == "7"){
		$tgl = "31";
		}
		elseif ($no == "8"){
		$tgl = "31";
		}
		elseif ($no == "9"){
		$tgl = "30";
		}
		elseif ($no == "10"){
		$tgl = "31";
		}
		elseif ($no == "11"){
		$tgl = "30";
		}
		elseif ($no == "12"){
		$tgl = "31";
		}
		return $tgl;
		}
		public function tglku($no) {
		if ($no == "1"){
		$tgl = "31";
		}
		elseif ($no == "2"){
		$tgl = "28";
		}
		elseif ($no == "3"){
		$tgl = "31";
		}
		elseif ($no == "4"){
		$tgl = "30";
		}
		elseif ($no == "5"){
		$tgl = "31";
		}
		elseif ($no == "6"){
		$tgl = "30";
		}
		elseif ($no == "7"){
		$tgl = "31";
		}
		elseif ($no == "8"){
		$tgl = "31";
		}
		elseif ($no == "9"){
		$tgl = "30";
		}
		elseif ($no == "10"){
		$tgl = "31";
		}
		elseif ($no == "11"){
		$tgl = "30";
		}
		elseif ($no == "12"){
		$tgl = "31";
		}
		return $tgl;
		}
		public function htarget($sbulan, $stahun, $tarjet) {
		$tgl = 0;
		$no = $sbulan;
		if ($no == "1"){
		$tgl = 31;
		}
		elseif ($no == "2"){
		$tgl = 29;
		}
		elseif ($no == "3"){
		$tgl = 31;
		}
		elseif ($no == "4"){
		$tgl = 30;
		}
		elseif ($no == "5"){
		$tgl = 31;
		}
		elseif ($no == "6"){
		$tgl = 30;
		}
		elseif ($no == "7"){
		$tgl = 31;
		}
		elseif ($no == "8"){
		$tgl = 31;
		}
		elseif ($no == "9"){
		$tgl = 30;
		}
		elseif ($no == "10"){
		$tgl = 31;
		}
		elseif ($no == "11"){
		$tgl = 30;
		}
		elseif ($no == "12"){
		$tgl = 31;
		}
		$nob = 1;
		$hmasuk = 0;
		$harian = 0;
		$iDate = "";
		$oDate = "";
		$tgl30 = $tgl + 1;
		$qty = 0;
		while ($nob <> $tgl30) {
		
		$tanggal = date_create($stahun . "-" . $sbulan . "-" . $nob);
		$date = date_format($tanggal,"d/m/Y");
		$oDate = date_format($tanggal,"Y/m/d");
		$oDateku = date_format($tanggal,"l");
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=cuti_bmi;", "sa","");
		
		$sql2="SELECT count(tanggal) as ten FROM hari_libur where tanggal ='". $oDate ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"ten");
		
		}
		
		if ($qty > 0){
		
		} else {
		
		
		
		if ($oDateku == "Saturday") {
		
		} elseif ($oDateku == "Sunday") {
		
		} else {
		$hmasuk = $hmasuk + 1;
		}
		
		}
		
		$nob = $nob + 1;
		
		
		
		}
		
		$harian = $tarjet / $hmasuk;
		
		return $harian;
		}
		public function htarget2($sbulan, $stahun, $day) {
		$qty = 0;
		$hmasuk = 0;
		$tanggal = date_create($stahun . "-" . $sbulan . "-" . $day);
		$date = date_format($tanggal,"d/m/Y");
		$oDate = date_format($tanggal,"Y/m/d");
		$oDateku = date_format($tanggal,"l");
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=cuti_bmi;", "sa","");
		
		$sql2="SELECT count(tanggal) as ten FROM hari_libur where tanggal ='". $oDate ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"ten");
		
		}
		
		if ($qty > 0){
		
		} else {
		
		
		
		if ($oDateku == "Saturday") {
		
		} elseif ($oDateku == "Sunday") {
		
		} else {
		$hmasuk = $hmasuk + 1;
		}
		
		}
		
		
		
		
		
		
		return $hmasuk;
		}
		public function hittarget($sbulan, $stahun, $tarjet, $tgl30, $capai) {
		$masuk= 0;
		$day = 1;
		$hmasuk = 0;
		while ($day <= $tgl30) {
		$qty = 0;
		$tanggal = date_create($stahun . "-" . $sbulan . "-" . $day);
		$date = date_format($tanggal,"d/m/Y");
		$oDate = date_format($tanggal,"Y/m/d");
		$oDateku = date_format($tanggal,"l");
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=cuti_bmi;", "sa","");
		
		$sql2="SELECT count(tanggal) as ten FROM hari_libur where tanggal ='". $oDate ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"ten");
		
		}
		
		if ($qty > 0){
		
		} else {
		
		
		
		if ($oDateku == "Saturday") {
		
		} elseif ($oDateku == "Sunday") {
		
		} else {
		$masuk = $masuk + $tarjet;
		}
		
		}
		
		
		$day = $day + 1;
		}
		
		
		
		
		
		
		if ($capai > 0){
		$hmasuk = ($masuk/$capai)*100;
		} else {
		$hmasuk = 0;
		}
		
		return $hmasuk;
		}
		
		
		public function cabangku($cabang) {
		
		$kodeku="";
		if ($cabang =="BAMBI-MG2") {
		$kodeku = "MD";
		} 
		elseif ($cabang == "BAMBI-MM" or $cabang == "MM") {
		$kodeku = "MM";
		} 
		elseif ($cabang == "BAMBI-SB" or $cabang == "SB") {
		$kodeku = "SB";
		} 
		elseif ($cabang == "BAMBI-TM") {
		$kodeku = "FM";
		} 
		elseif ($cabang == "bambi0102") {
		$kodeku = "BP";
		} 
		elseif ($cabang == "bambi04") {
		$kodeku = "BD";
		} 
		elseif ($cabang == "bambi0601" or $cabang == "NS1") {
		$kodeku = "NS1";
		} 
		elseif ($cabang == "bambi0602" or $cabang == "NS2") {
		$kodeku = "NS2";
		} 
		elseif ($cabang == "bambi0603" or $cabang == "NS3") {
		$kodeku = "NS3";
		} 
		elseif ($cabang == "NS4") {
		$kodeku = "NS4";
		} 
		elseif ($cabang == "DGM") {
		$kodeku = "DGM";
		} 
		elseif ($cabang == 'BAMBI-SG') {
		$kodeku = "SG";
		} 
		elseif ($cabang == "Ex") {
		$kodeku = "Ex";
		} 
		elseif ($cabang == "DM") {
		$kodeku = "DM";
		} 
		elseif ($cabang == "TRD") {
		$kodeku = "TRD";
		} 
		elseif ($cabang == "PBO") {
		$kodeku = "PBO";
		} 
		elseif ($cabang == "NK") {
		$kodeku = "NK";
		} 
		elseif ($cabang == "BMN") {
		$kodeku = "BMN";
		} 
		
		return $kodeku;
		}
		public function recabangku21($cabang, $syear) {
		$kodeku = "";
		if ($cabang =="MD") {
		$kodeku = "BAMBI-MG2";
		} 
		elseif ($cabang == "MM") {
		$kodeku = "BAMBI-MM";
		} 
		elseif ($cabang == "SB" and $syear == "2021") {
		$kodeku = "SB";
		} 
		elseif ($cabang == "SB" and $syear == "2020") {
		$kodeku = "SB";
		}
		elseif ($cabang == "FM") {
		$kodeku = "BAMBI-TM";
		} 
		elseif ($cabang == "BP") {
		$kodeku = "bambi0102";
		} 
		elseif ($cabang == "BD") {
		$kodeku = "bambi04";
		} 
		elseif ($cabang == "NS1" and $syear == "2020") {
		$kodeku = "bambi0601";
		} 
		elseif ($cabang == "NS1" and $syear == "2021") {
		$kodeku = "NS1";
		}
		elseif ($cabang == "NS2" and $syear == "2021") {
		$kodeku = "NS2";
		}
		elseif ($cabang == "NS3" and $syear == "2021") {
		$kodeku = "NS3";
		}
		
		elseif ($cabang == "NS4" and $syear == "2021") {
		$kodeku = "NS4";
		}
		elseif ($cabang == "NS2" and $syear == "2020") {
		$kodeku = "bambi0602";
		} 
		elseif ($cabang == "NS3" and $syear == "2020") {
		$kodeku = "bambi0603";
		} 
		elseif ($cabang == "DGM") {
		$kodeku = "DGM";
		} 
		elseif ($cabang == 'SG') {
		$kodeku = "BAMBI-SG";
		} 
		elseif ($cabang == "Ex") {
		$kodeku = "Ex";
		} 
		elseif ($cabang == "DM") {
		$kodeku = "DM";
		} 
		elseif ($cabang == "TRD") {
		$kodeku = "TRD";
		} 
		elseif ($cabang == "PBO") {
		$kodeku = "PBO";
		} 
		
		
		
		return $kodeku;
		}
		public function blmkunj($id_sales, $id, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select count(id_cust) as bar from [kunjunganheader] where status <> 'T' and Jkunjungan <> 'Whatsapp' and Jkunjungan <> 'Tele Marketing' and month(tanggal_close) = '". $smonth ."' and year(tanggal_close) = '". $syear ."' and id_sales = '". $id_sales ."' and id_cust = '". $id ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function jabatanme2($sales, $shadow) {
		$baru = 0;
		$hasil = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="select jabatan from salesmanSpv where code = '". $sales ."'"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"jabatan");
		
		}
		
		return $baru;
		}
		public function divmanager($sales) {
		$baru = 0;
		$hasil = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="select country from salesman where code = '". $sales ."'"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"country");
		
		}
		
		return $baru;
		}
		public function jabatanme($sales, $shadow) {
		$baru = 0;
		$hasil = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="select jabatan from salesman where code = '". $sales ."'"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"jabatan");
		
		}
		
		return $baru;
		}
		public function hkerja($sbulan, $stahun, $day) {
		$qty = 0;
		$hmasuk = 0;
		$i = 1;
		While ($i <= $day) {
		$tanggal = date_create($stahun . "-" . $sbulan . "-" . $i);
		$date = date_format($tanggal,"d/m/Y");
		$oDate = date_format($tanggal,"Y/m/d");
		$oDateku = date_format($tanggal,"l");
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=cuti_bambi;", "sa","");
		
		$sql2="SELECT count(tanggal) as ten FROM hari_libur where tanggal ='". $oDate ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$qty=odbc_result($result_set2,"ten");
		
		}
		
		if ($qty > 0){
		
		} else {
		
		
		
		if ($oDateku == "Saturday") {
		
		} elseif ($oDateku == "Sunday") {
		
		} else {
		$hmasuk = $hmasuk + 1;
		}
		
		}
		
		$i = $i + 1;
		}
		
		
		
		
		
		
		return $hmasuk;
		}
		public function hkku($no) {
		if ($no == "1"){
		$tgl = "21";
		}
		elseif ($no == "2"){
		$tgl = "18";
		}
		elseif ($no == "3"){
		$tgl = "22";
		}
		elseif ($no == "4"){
		$tgl = "20";
		}
		elseif ($no == "5"){
		$tgl = "14";
		}
		elseif ($no == "6"){
		$tgl = "21";
		}
		elseif ($no == "7"){
		$tgl = "21";
		}
		elseif ($no == "8"){
		$tgl = "22";
		}
		elseif ($no == "9"){
		$tgl = "22";
		}
		elseif ($no == "10"){
		$tgl = "21";
		}
		elseif ($no == "11"){
		$tgl = "22";
		}
		elseif ($no == "12"){
		$tgl = "22";
		}
		return $tgl;
		}
		public function recabangku($cabang) {
		if ($cabang =="MD") {
		$kodeku = "BAMBI-MG2";
		} 
		elseif ($cabang == "MM") {
		$kodeku = "BAMBI-MM";
		} 
		elseif ($cabang == "SB") {
		$kodeku = "SB";
		} 
		elseif ($cabang == "FM") {
		$kodeku = "BAMBI-TM";
		} 
		elseif ($cabang == "BP") {
		$kodeku = "bambi0102";
		} 
		elseif ($cabang == "BD") {
		$kodeku = "bambi04";
		} 
		elseif ($cabang == "NS1") {
		$kodeku = "NS1";
		} 
		elseif ($cabang == "NS2") {
		$kodeku = "NS2";
		} 
		elseif ($cabang == "NS3") {
		$kodeku = "NS3";
		}
		elseif ($cabang == "NS4") {
		$kodeku = "NS4";
		}  
		elseif ($cabang == "DGM") {
		$kodeku = "DGM";
		} 
		elseif ($cabang == 'SG') {
		$kodeku = "BAMBI-SG";
		} 
		elseif ($cabang == "Ex") {
		$kodeku = "Ex";
		} 
		elseif ($cabang == "DM") {
		$kodeku = "DM";
		} 
		elseif ($cabang == "TRD") {
		$kodeku = "TRD";
		} 
		elseif ($cabang == "PBO") {
		$kodeku = "PBO";
		} 
		else{
			$kodeku = "";
		}
		
		
		
		return $kodeku;
		}
		public function targetku($nama, $tmd, $tmm, $tsb, $ttm, $tbp, $tbd, $tns1, $tns2, $tns3, $tns4, $tsg, $tdgm, $tex, $tdm, $ttrd, $tpbo, $tnk) {
		if ($nama =="BAMBI-MG2") {
		$target = $tmd;
		} 
		elseif ($nama == "BAMBI-MM" or $nama == "MM") {
		$target = $tmm;
		} 
		elseif ($nama == "BAMBI-SB" or $nama == "SB") {
		$target = $tsb;
		} 
		elseif ($nama == "BAMBI-TM") {
		$target = $ttm;
		} 
		elseif ($nama == "bambi0102") {
		$target = $tbp;
		} 
		elseif ($nama == "bambi04") {
		$target = $tbd;
		} 
		elseif ($nama == "bambi0601" or $nama == "NS1") {
		$target = $tns1;
		} 
		elseif ($nama == "bambi0602" or $nama == "NS2") {
		$target = $tns2;
		} 
		elseif ($nama == "bambi0603" or $nama == "NS3") {
		$target = $tns3;
		} 
		elseif ($nama == "bambi0604" or $nama == "NS4") {
		$target = $tns4;
		} 
		elseif ($nama == "BAMBI-SG") {
		$target = $tsg;
		}  
		elseif ($nama == "DGM") {
		$target = $tdgm;
		} 
		elseif ($nama == "Ex") {
		$target = $tex;
		} 
		elseif ($nama == "DM") {
		$target = $tdm;
		} 
		elseif ($nama == "TRD") {
		$target = $ttrd;
		} 
		elseif ($nama == "PBO") {
		$target = $tpbo;
		}  
		elseif ($nama == "BMN") {
		$target = $tnk;
		} 
		else {
		$target =0;
		}
		// if ($target = "" or $target = " ") {
		// 	$target = 0;
		// }
		
		return $target;
		}	
		public function targetku9($nama, $tdgm, $tdm, $ttrd) {
		if ($nama == "DGM") {
		$target = $tdgm;
		} 
		elseif ($nama == "DM") {
		$target = $tdm;
		} 
		elseif ($nama == "TRD") {
		$target = $ttrd;
		} 
		else {
		$target =0;
		}
		// if ($target = "" or $target = " ") {
		// 	$target = 0;
		// }
		
		return $target;
		}
		public function targetkux($nama, $tmd, $tmm, $tsb, $ttm, $tbp, $tbd, $tns1, $tns2, $tns3, $tsg, $tdgm, $tex, $tdm, $ttrd, $tpbo, $tnk, $tns4) {
		if ($nama =="BAMBI-MG2") {
		$target = $tmd;
		} 
		elseif ($nama == "BAMBI-MM" or $nama == "MM") {
		$target = $tmm;
		} 
		elseif ($nama == "BAMBI-SB" or $nama == "SB") {
		$target = $tsb;
		} 
		elseif ($nama == "BAMBI-TM") {
		$target = $ttm;
		} 
		elseif ($nama == "bambi0102") {
		$target = $tbp;
		} 
		elseif ($nama == "bambi04") {
		$target = $tbd;
		} 
		elseif ($nama == "bambi0601" or $nama == "NS1") {
		$target = $tns1;
		} 
		elseif ($nama == "bambi0602" or $nama == "NS2") {
		$target = $tns2;
		} 
		elseif ($nama == "bambi0603" or $nama == "NS3") {
		$target = $tns3;
		} 
		elseif ($nama == "NS4") {
		$target = $tns4;
		} 
		elseif ($nama == "BAMBI-SG") {
		$target = $tsg;
		}  
		elseif ($nama == "DGM") {
		$target = $tdgm;
		} 
		elseif ($nama == "Ex") {
		$target = $tex;
		} 
		elseif ($nama == "DM") {
		$target = $tdm;
		} 
		elseif ($nama == "TRD") {
		$target = $ttrd;
		} 
		elseif ($nama == "PBO") {
		$target = $tpbo;
		}  
		elseif ($nama == "BMN") {
		$target = $tnk;
		} 
		else {
		
		$target =0;
		}
		// if ($target = "" or $target = " ") {
		// 	$target = 0;
		// }
		
		return $target;
		}	
		public function blmorder2($shadow, $id_sales, $id, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT CustomerID FROM  SOTRANSACTION WHERE  month(shipdate) = '". $smonth ."' and year(shipdate) = '". $syear ."' and flagposted = 'Y' and (". $id_sales . ") and customerid = '". $id . "'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"CustomerID");
		
		}
		
		return $baru;
		}
		public function countsocust($nama, $smonth, $syear, $shadow) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT count(sotransacid) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and customerid = '". $nama ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function blmorder($shadow, $id_sales, $id, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT CustomerID FROM  SOTRANSACTION WHERE  month(shipdate) = '". $smonth ."' and year(shipdate) = '". $syear ."' and flagposted = 'Y' and salesmancode = '". $id_sales . "' and customerid = '". $id . "'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"CustomerID");
		
		}
		
		return $baru;
		}
		public function Knabul2($month) {
		$blnku = "";
		if ($month == "1") {
		$blnku = "JANUARI";
		}
		elseif ($month == "2") {
		$blnku = "FEBRUARI";
		}
		elseif ($month == "3") {
		$blnku = "MARET";
		}
		elseif ($month == "4") {
		$blnku = "APRIL";
		}
		elseif ($month == "5") {
		$blnku = "MEI";
		}
		elseif ($month == "6") {
		$blnku = "JUNI";
		}
		elseif ($month == "7") {
		$blnku = "JULI";
		}
		elseif ($month == "8") {
		$blnku = "AGUSTUS";
		}
		elseif ($month == "9") {
		$blnku = "SEPTEMBER";
		}
		elseif ($month == "10") {
		$blnku = "OKTOBER";
		}
		elseif ($month == "11") {
		$blnku = "NOVEMBER";
		}
		elseif ($month == "12") {
		$blnku = "DESEMBER";
		}
		
		return $blnku;
		}
		public function nabul2($month) {
		$blnku = "";
		if ($month == "1") {
		$blnku = "Januari";
		}
		elseif ($month == "2") {
		$blnku = "Februari";
		}
		elseif ($month == "3") {
		$blnku = "Maret";
		}
		elseif ($month == "4") {
		$blnku = "April";
		}
		elseif ($month == "5") {
		$blnku = "Mei";
		}
		elseif ($month == "6") {
		$blnku = "Juni";
		}
		elseif ($month == "7") {
		$blnku = "Juli";
		}
		elseif ($month == "8") {
		$blnku = "Agustus";
		}
		elseif ($month == "9") {
		$blnku = "September";
		}
		elseif ($month == "10") {
		$blnku = "Oktober";
		}
		elseif ($month == "11") {
		$blnku = "November";
		}
		elseif ($month == "12") {
		$blnku = "Desember";
		}
		
		return $blnku;
		}
		public function nabul($month) {
		$blnku = "";
		if ($month == "1") {
		$blnku = "Jan";
		}
		elseif ($month == "2") {
		$blnku = "Feb";
		}
		elseif ($month == "3") {
		$blnku = "Mar";
		}
		elseif ($month == "4") {
		$blnku = "Apr";
		}
		elseif ($month == "5") {
		$blnku = "Mei";
		}
		elseif ($month == "6") {
		$blnku = "Jun";
		}
		elseif ($month == "7") {
		$blnku = "Jul";
		}
		elseif ($month == "8") {
		$blnku = "Agu";
		}
		elseif ($month == "9") {
		$blnku = "Sep";
		}
		elseif ($month == "10") {
		$blnku = "Okt";
		}
		elseif ($month == "11") {
		$blnku = "Nov";
		}
		elseif ($month == "12") {
		$blnku = "Des";
		}
		
		return $blnku;
		}
		public function renabul($month) {
		
		if ($month == "Jan") {
		$blnku = "1";
		}
		elseif ($month == "Feb") {
		$blnku = "2";
		}
		elseif ($month == "Mar") {
		$blnku = "3";
		}
		elseif ($month == "Apr") {
		$blnku = "4";
		}
		elseif ($month == "Mei") {
		$blnku = "5";
		}
		elseif ($month == "Jun") {
		$blnku = "6";
		}
		elseif ($month == "Jul") {
		$blnku = "7";
		}
		elseif ($month == "Agu") {
		$blnku = "8";
		}
		elseif ($month == "Sep") {
		$blnku = "9";
		}
		elseif ($month == "Okt") {
		$blnku = "10";
		}
		elseif ($month == "Nov") {
		$blnku = "11";
		}
		elseif ($month == "Des") {
		$blnku = "12";
		}
		
		return $blnku;
		}
		
		public function insertdocure($judul, $divisi, $jenis, $pdfku, $tgl_exp, $tgl_re, $tgl_in, $user ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$sql="INSERT INTO [docure] ( nama, divisi, jenis, path, tgl_exp, tgl_reminder, tgl_input, userinput, lastedit, tgl_lastedit  ) Values ('". $judul ."', '". $divisi ."', '". $jenis ."', '". $pdfku ."', '". $tgl_exp ."', '". $tgl_re ."', '". $tgl_in ."', '". $user ."', '". $user ."', '". $tgl_in ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		return $result_set;
		}
		
		public function insertprospek($nama, $cat, $alamat, $prov, $kec, $kota, $kodepos, $phone, $email, $hpc, $sumber, $lat, $long, $pathupload, $divisi) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=um_db;", "sa","");
		$sql="INSERT INTO [customerProspek] ( customername, jenis, custaddress, kota, kecamatan, provinsi, kodepos, custphone, custemail, custhp, path, sumber, lat, long, divisi ) Values ('". $nama ."', '". $cat ."', '". $alamat ."', '". $kota ."', '". $kec ."', '". $prov ."', '". $kodepos ."', '". $phone ."', '". $email ."', '". $hpc ."', '". $pathupload ."', '". $sumber ."', '". $lat ."', '". $long ."', '". $divisi ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		return $result_set;
		}
		
		public function insertkun($id_sales, $id_sku, $id_cust, $tgl ) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="INSERT INTO [kunjunganHeader] ( id_cust, id_sales, div ) Values ('". $id_cust ."', '". $id_sales ."', '". $id_sku ."', '". $tgl ."', 'DM' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT TOP 1 id_kunjung FROM [kunjunganHeader] order by id_kunjung desc"; 
		$result_set2 = odbc_exec($connection3, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"id_kunjung");
		//$baru="hanya";
		}
		odbc_close($connection3);
		unset($connection3);
		return $baru;
		}
		public function notupdatekun($idkun, $pic, $telp, $tgl, $alamat, $lat, $long, $comment) {
		$baru = "";
		$syear = date("Y");
		$smonth = date("m");
		$sday = date("d");
		if ($comment == "") {
		
		} else {
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="UPDATE [kunjunganPlan] SET status = 'T', comment = '". $comment ."' where id = '". $idkun ."'"; 
		$result_set2 = odbc_exec($connection3, $sql2); 
		}
		return $baru;
		}
		public function endupdatekun($idkun, $pic, $telp, $tgl, $alamat, $lat, $long, $comment, $accu, $foto) {
		$baru = "";
		$syear = date("Y");
		$smonth = date("m");
		$sday = date("d");
		if ($lat == "") {
		
		} else {
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="UPDATE [kunjunganHeader] SET accuracy2 = '". $accu . "', foto1 = '". $foto . "', lat = '". $lat . "', long = '". $long . "', status = 'Y', alamat = '". $alamat . "', ket = '". $comment . "', notelp = '". $telp . "', pic = '". $pic ."', tanggal_close = '". $tgl ."' where id_custsugest = '". $idkun ."' and month(tanggal_start)= '". $smonth ."' and year(tanggal_start)= '". $syear ."' and day(tanggal_start)= '". $sday ."'"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="UPDATE [kunjunganPlan] SET status = 'S' where id = '". $idkun ."'"; 
		$result_set2 = odbc_exec($connection3, $sql2); 
		}
		return $baru;
		}
		public function startupdatekun($id_cust, $id_sales, $idkun, $namapt, $jk, $tgl, $id_sku, $lat, $long, $div, $accu) {
		$baru = "";
		if ($lat == "") {
		
		} else {
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="INSERT INTO [kunjunganHeader] ( id_cust, id_sales, div, namapt, tanggal_start, JKunjungan, slat, slong, id_custsugest, accuracy1 ) Values ('". $id_cust ."', '". $id_sales ."', '". $div ."', '". $namapt ."', '". $tgl ."', '". $jk ."', '". $lat ."', '". $long ."', '". $id_sku ."', '". $accu ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="UPDATE [kunjunganPlan] SET status = 'M' where id = '". $id_sku ."'"; 
		$result_set2 = odbc_exec($connection3, $sql2); 
		}
		return $id_sku;
		}
		public function updatekunT($idkun, $ket, $jk, $tgl, $id_sku) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="UPDATE [kunjunganHeader] SET div = 'DM', status = 'T', ket = '". $ket . "', JKunjungan = '". $jk ."', tanggal_close = '". $tgl ."' where id_kunjung = '". $idkun ."'"; 
		$result_set = odbc_exec($connection2, $sql); 
		odbc_close($connection2);
		unset($connection2);
		$connection3 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="UPDATE [skunjungan] SET status = 'T' where id = '". $id_sku ."'"; 
		$result_set2 = odbc_exec($connection3, $sql2); 
		return $id_sku;
		}
		
		public function insertcust($nama, $alamat, $telp, $email) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="INSERT INTO [skunjungan] ( nama, alamat, notelp, email, status ) Values ('". $nama ."', '". $alamat ."', '". $telp ."', '". $email ."', 'Y' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		
		$sql2="SELECT TOP 1 id FROM [skunjungan] order by id desc"; 
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"id");
		//$baru="hanya";
		}
		
		return $baru;
		}
		public function insertrandomcust($id_skunjung, $tgl, $id_sales) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="INSERT INTO [skunjungTemp] ( id_skunjung, tgl, id_sales ) Values ('". $id_skunjung ."', '". $tgl ."', '". $id_sales ."' )"; 
		$result_set = odbc_exec($connection2, $sql); 
		return $baru;
		}
		public function checkrandom($id_sales, $tgl) {
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="SELECT COALESCE( (SELECT sum(id) FROM skunjungTemp where id_sales = '". $id_sales ."' and tgl = '". $tgl ."'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"bar");
		
		}
		
		return $baru;
		}
		public function sgdku($amount, $smonth, $syear) {
		$baru = 0;
		$hasil = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="select sgd from targetbambi where tahun = '". $syear ."' and kodebulan = '". $smonth ."'"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"sgd");
		
		}
		$hasil = $amount * $baru;
		return $hasil;
		}
		public function usdku($amount, $smonth, $syear) {
		$baru = 0;
		$hasil = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql="select usd from targetbambi where tahun = '". $syear ."' and kodebulan = '". $smonth ."'"; 
		$result_set2 = odbc_exec($connection2, $sql); 
		while(odbc_fetch_row($result_set2)) {
		$baru=odbc_result($result_set2,"usd");
		
		}
		$hasil = $amount * $baru;
		return $hasil;
		}
		public function summedm($nama, $smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi0102;", "sa","");
		$nama = "DGM";
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '2019' and month(shipdate) = '". $smonth ."' and FlagPosted = 'Y' and salesmancode = '". $sales ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function tglinput($id) {
		$bar = "";
		$bar2 = "";
		$bar3 = "";
		$bar4 = "";
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select year(tanggal) As y, month(tanggal) As m, day(tanggal) As d, CONVERT(VARCHAR(5),tanggal,108) As min from costingHeader where id = '". $id ."' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"y");
		$bar2=odbc_result($result_set2,"d");
		$bar3=odbc_result($result_set2,"m");
		$bar4=odbc_result($result_set2,"min");
		$baru="" . $bar . "/" . $bar3 . "/" . $bar2 . " (" . $bar4 . ")";
		
		
		}
		
		return $baru;
		}
		public function tglinput2($id) {
		$bar = "";
		$bar2 = "";
		$bar3 = "";
		$bar4 = "";
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select TOP 1 year(tanggal) As y, month(tanggal) As m, day(tanggal) As d, CONVERT(VARCHAR(5),tanggal,108) As min from costingDetail where ids = '". $id ."' and userInput = 'pralita' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"y");
		$bar2=odbc_result($result_set2,"d");
		$bar3=odbc_result($result_set2,"m");
		$bar4=odbc_result($result_set2,"min");
		$baru="" . $bar . "/" . $bar3 . "/" . $bar2 . " (" . $bar4 . ")";
		
		
		}
		
		return $baru;
		}
		public function tglinput3($id) {
		$bar = "";
		$bar2 = "";
		$bar3 = "";
		$bar4 = "";
		$baru = "";
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="select TOP 1 year(tanggal) As y, month(tanggal) As m, day(tanggal) As d, CONVERT(VARCHAR(5),tanggal,108) As min from costingDetail where ids = '". $id ."' and userInput <> 'pralita' "; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"y");
		$bar2=odbc_result($result_set2,"d");
		$bar3=odbc_result($result_set2,"m");
		$bar4=odbc_result($result_set2,"min");
		$baru="" . $bar2 . "/" . $bar3 . "/" . $bar . " (" . $bar4 . ")";
		
		
		}
		
		return $baru;
		}
		public function sumcabangkudm($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi0102;", "sa","");
		$nama = "DGM";
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '2019' and month(shipdate) = '". $smonth ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangkudgm($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-dgm;", "sa","");
		$nama = "DGM";
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '2019' and month(shipdate) = '". $smonth ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumpro2($nama, $smonth, $syear, $partid, $custid) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		 if ($nama == "DKI"){
		$sql2="SELECT COALESCE((SELECT SUM(b.Quantity) FROM [bambi-mg2].[dbo].SOTRANSACTIONDETAIL b LEFT OUTER JOIN [bambi-mg2].[dbo].SOTRANSACTION a ON a.SOTransacID = b.SOTransacID WHERE a.customerid = '". $custid ."' AND (a.totalamount <> '0') AND (a.FlagPosted = 'Y') AND (MONTH(a.DateEntry) = '". $smonth ."') AND (YEAR(a.DateEntry) = '". $syear ."') AND b.partid = '". $partid ."'), 0) AS bar"; 
		 }elseif ($nama == "JBR"){
		$sql2="SELECT COALESCE((SELECT SUM(b.Quantity) FROM [bambi04].[dbo].SOTRANSACTIONDETAIL b LEFT OUTER JOIN [bambi04].[dbo].SOTRANSACTION a ON a.SOTransacID = b.SOTransacID WHERE a.customerid = '". $custid ."' AND  (a.totalamount <> '0') AND (a.FlagPosted = 'Y') AND (MONTH(a.DateEntry) = '". $smonth ."') AND (YEAR(a.DateEntry) = '". $syear ."') AND b.partid = '". $partid ."'), 0) AS bar"; 
		 }elseif ($nama == "BS"){
		$sql2="SELECT COALESCE((SELECT SUM(b.Quantity) FROM [bambi-sg].[dbo].SOTRANSACTIONDETAIL b LEFT OUTER JOIN [bambi-sg].[dbo].SOTRANSACTION a ON a.SOTransacID = b.SOTransacID WHERE a.customerid = '". $custid ."' AND  (a.totalamount <> '0') AND  (a.FlagPosted = 'Y') AND (MONTH(a.DateEntry) = '". $smonth ."') AND (YEAR(a.DateEntry) = '". $syear ."') AND b.partid = '". $partid ."'), 0) AS bar"; 
		 }else{
		$sql2="SELECT COALESCE((SELECT SUM(b.Quantity) FROM SOTRANSACTIONDETAIL b LEFT OUTER JOIN SOTRANSACTION a ON a.SOTransacID = b.SOTransacID WHERE a.customerid = '". $custid ."' AND  (a.totalamount <> '0') AND (a.divisi = '". $nama ."') AND (a.FlagPosted = 'Y') AND (MONTH(a.DateEntry) = '". $smonth ."') AND (YEAR(a.DateEntry) = '". $syear ."') AND b.partid = '". $partid ."'), 0) AS bar"; 
         }
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumpro($nama, $smonth, $syear, $partid) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE((SELECT SUM(b.Quantity) FROM SOTRANSACTIONDETAIL b LEFT OUTER JOIN SOTRANSACTION a ON a.SOTransacID = b.SOTransacID WHERE (a.totalamount <> '0') AND (a.divisi = '". $nama ."') AND (a.FlagPosted = 'Y') AND (MONTH(a.DateEntry) = '". $smonth ."') AND (YEAR(a.DateEntry) = '". $syear ."') AND b.partid = '". $partid ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcust($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS bar FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] where ([s].customerid = '". $nama ."') and YEAR(s.shipdate) = '". $syear ."' and  MONTH(s.shipdate) = '". $smonth ."' AND flagposted = 'Y'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function daykunj($day, $smonth, $syear, $nama) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT TOP 1 T.* FROM (SELECT TOP 2 * FROM kunjunganHeader ORDER BY id_kunjung ASC) T WHERE (YEAR(tanggal_close) = '". $syear ."') AND (MONTH(tanggal_close) = '". $smonth ."') AND (DAY(tanggal_close) = '". $day ."') AND id_sales = '". $nama ."' ORDER BY id_kunjung DESC"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangku30exa($day, $smonth, $syear, $nama) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and day(shipdate) = '". $day ."' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and currencyid = 'USD'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangku30exb($day, $smonth, $syear, $nama) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and day(shipdate) = '". $day ."' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and currencyid = 'Rp'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function summeku30($day, $smonth, $syear, $nama, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and day(shipdate) = '". $day ."' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and salesmancode = '". $sales ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumsalescabangku30($day, $smonth, $syear, $nama, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and day(shipdate) = '". $day ."' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and salesmancode = '". $sales ."'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangku30($day, $smonth, $syear, $nama) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and day(shipdate) = '". $day ."' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangku302($day, $smonth, $syear, $nama) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and day(shipdate) = '". $day ."' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and customerid = '". $nama ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangkuexa($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and currencyid = 'USD'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangkuexb($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and currencyid = 'Rp'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function summeku($nama, $smonth, $syear, $sales) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and salesmancode = '". $sales . "'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangku($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS bar FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] where ([s].[divisi] = '". $nama ."') and YEAR(s.shipdate) = '". $syear ."' and  MONTH(s.shipdate) = '". $smonth ."' AND flagposted = 'Y'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcabangku2($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT CASE WHEN (sd.QtyCancel > 0) THEN  ((sd.quantity*sd.unitprice) - (sd.QtyCancel*sd.unitPrice)) ELSE ((sd.quantity*sd.unitprice)-(((sd.quantity*sd.unitprice)*sd.discpercen)/100) - (sd.QtyCancel*sd.unitPrice)) END AS bar FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s ON sd.[SOTransacID] = s.[SOTransacID] where ([s].customerid = '". $nama ."') and YEAR(s.shipdate) = '". $syear ."' and  MONTH(s.shipdate) = '". $smonth ."' AND flagposted = 'Y'"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function tosumkuBMB($smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and divisi <> 'DM' and divisi <> 'TRD' and divisi <> 'Ex' and divisi <> 'DGM' and customerid <> 'BAMBI-SG' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and FlagPosted = 'Y'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumcustku($nama) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and customerid = '". $nama ."' and FlagPosted = 'Y'), 0) AS bar"; 
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuexa($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and currencyid = 'USD'), 0) AS bar"; 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuexb($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y' and currencyid = 'Rp'), 0) AS bar"; 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumku($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($nama =="DGM" or $nama =="Ex" or $nama =="DM" or $nama =="TRD" or $nama =="PBO" or $nama =="NK" or $nama =="MM" or $nama =="NS1" or $nama =="NS2" or $nama =="NS3" or $nama =="SB") {
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and divisi = '". $nama ."' and FlagPosted = 'Y'), 0) AS bar"; 
		} 
		else {
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and customerid = '". $nama ."' and FlagPosted = 'Y'), 0) AS bar"; 
		} 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuSIexb($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($nama =="DGM" or $nama =="Ex" or $nama =="DM" or $nama =="TRD" or $nama =="PBO" or $nama =="NK" or $nama =="MM" or $nama =="NS1" or $nama =="NS2" or $nama =="NS3" or $nama =="SB") {
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."'  AND a.divisi = '". $nama ."' AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y' and currencyid = 'Rp'), 0) AS bar"; 
		} 
		else {
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."' AND a.customerid = '". $nama ."' AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y'), 0) AS bar"; 
		} 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuSIexa($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($nama =="DGM" or $nama =="Ex" or $nama =="DM" or $nama =="TRD" or $nama =="PBO" or $nama =="NK" or $nama =="MM" or $nama =="NS1" or $nama =="NS2" or $nama =="NS3" or $nama =="SB") {
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."'  AND a.divisi = '". $nama ."' AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y' and currencyid = 'USD'), 0) AS bar"; 
		} 
		else {
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."' AND a.customerid = '". $nama ."' AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y'), 0) AS bar"; 
		} 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuSI($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($nama =="DGM" or $nama =="Ex" or $nama =="DM" or $nama =="TRD" or $nama =="PBO" or $nama =="NK" or $nama =="MM" or $nama =="NS1" or $nama =="NS2" or $nama =="NS3" or $nama =="SB") {
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."'  AND a.divisi = '". $nama ."' AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y'), 0) AS bar"; 
		} 
		else {
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."' AND a.customerid = '". $nama ."' AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y'), 0) AS bar"; 
		} 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkumonexa($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and FlagPosted = 'Y' and divisi = 'Ex' and currencyid = 'USD'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkumonexb($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and FlagPosted = 'Y' and divisi = 'Ex' and currencyid = 'Rp'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkumonsg($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and FlagPosted = 'Y' and customerid = 'BAMBI-SG'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkumon($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and FlagPosted = 'Y' and divisi <> 'Ex' and customerid <> 'BAMBI-SG'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuSImonexa($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."'  AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y'  and a.divisi = 'Ex' and currencyid = 'USD'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuSImonexb($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."'  AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y'  and a.divisi = 'Ex' and currencyid = 'Rp'), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuSImonsg($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."'  AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y' and a.customerid = 'BAMBI-SG' ), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumkuSImon($nama, $smonth, $syear) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		
		$sql2="SELECT COALESCE ((SELECT SUM(b.totalamount) FROM dotransaction AS b left join sotransaction AS a ON a.sotransacid = b.sotransacid WHERE (b.flagcancelDO IS NULL) AND b.flagposting = 'Y' AND b.totalamount <> '0' AND year(b.dodate) = '". $syear ."' AND month(b.dodate) = '". $smonth ."'  AND a.FlagPosted = 'Y' and b.flagpostinginv = 'Y' and (a.customerid = 'BAMBI-MG2' or a.customerid = 'BAMBI-MM' or a.customerid = 'BAMBI-SB' or a.customerid = 'BAMBI-TM' or a.customerid = 'bambi04' or a.customerid = 'bambi0601' or a.customerid = 'bambi0602' or a.customerid = 'bambi0603' or divisi = 'DM' or divisi = 'DGM' or divisi = 'TRD' or divisi = 'PBO') ), 0) AS bar"; 
		
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		public function sumku2($nama, $smonth, $syear, $sday) {
		$baru = 0;
		$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
		if ($nama =="DGM" or $nama =="Ex" or $nama =="DM" or $nama =="TRD" or $nama =="PBO" or $nama =="NK" or $nama =="MM" or $nama =="NS1" or $nama =="NS2" or $nama =="NS3" or $nama =="SB") {
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and day(shipdate) = '". $sday ."' and divisi = '". $nama ."' and FlagPosted = 'Y'), 0) AS bar"; 
		} 
		else {
		$sql2="SELECT COALESCE( (SELECT sum(totalamount) FROM sotransaction where (flagcancelSOPosted IS NULL) AND (flagcancelSO IS NULL) AND flagposted = 'Y' and totalamount<>'0' and year(shipdate) = '". $syear ."' and month(shipdate) = '". $smonth ."' and day(shipdate) = '". $sday ."' and customerid = '". $nama ."' and FlagPosted = 'Y'), 0) AS bar"; 
		} 
		
		$result_set2 = odbc_exec($connection2, $sql2); 
		while(odbc_fetch_row($result_set2)) {
		$bar=odbc_result($result_set2,"bar");
		$baru = $baru + $bar;
		
		}
		
		return $baru;
		}
		
		public function hitungjumlahtransaksi_ecom() {
		
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=UM_DB;", "sa","");
	
			$sql2="
			select a.no_pesanan,
			(select count(b.no_pesanan) from [UM_DB].[dbo].temp_transaksi as b where b.no_pesanan=a.no_pesanan and b.status_transaksi='N') as kode_1,
			(select count(d.no_pesanan) from [UM_DB].[dbo].temp_transaksi_berhasil as d where d.no_pesanan=a.no_pesanan) as kode_2,
			(select count(e.no_pesanan) from [UM_DB].[dbo].temp_transaksi as e where e.no_pesanan=a.no_pesanan and e.baru_masuk='Y') as kode_masuk
			from [UM_DB].[dbo].temp_transaksi as a
			group by a.no_pesanan, a.date_invoice, a.username_pembeli, a.nama_penerima, a.customer_id
			order by a.date_invoice, kode_1 DESC"; 
     
			$berhasil=0;
			$gagal=0;
			$pernahmasuk=0;
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$kode1=odbc_result($result_set2,"kode_1");
				$kode2=odbc_result($result_set2,"kode_2");
				$kode3=odbc_result($result_set2,"kode_masuk");
				if($kode1>=0 && $kode3==0){
					$gagal=$gagal+1;
				}

				if($kode2>0 && $kode3==0){
					$berhasil=$berhasil+1;
				}
				
				if($kode3>0){
					$pernahmasuk=$pernahmasuk+1;
				}
			}

			return array($gagal, $berhasil, $pernahmasuk);
		}

		public function update_ecom($no_pesanan) {

			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=UM_DB;", "sa","");
			
			$sql2="UPDATE temp_transaksi SET status= 'Y' where no_pesanan = '".$no_pesanan."'"; 
			 
			$result_set2 = odbc_exec($connection2, $sql2); 

			return $no_pesanan;
		}
		
		public function ambildata_billaddress($customer_id) {
	
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=UM_DB;", "sa","");
			
			$sql2="select a.CustBillAddress, a.CustAddress from [bambi-bmi].[dbo].customer as a where a.CustomerID='".$customer_id."'"; 
			 
			$result_set2 = odbc_exec($connection2, $sql2);
			$cust_bill_address="";
			$cust_ship_address="";
			while(odbc_fetch_row($result_set2)) {
				$cust_bill_address=odbc_result($result_set2,"CustBillAddress");
				$cust_ship_address=odbc_result($result_set2,"CustAddress");
			}

		return array($cust_bill_address, $cust_ship_address);
		}
		
		public function update_gramedia($no_pesanan) {
	
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=UM_DB;", "sa","");
	
			$sql2="UPDATE master_gramed_temp SET status= 'Y' where no_pesanan = '".$no_pesanan."'"; 
     
			$result_set2 = odbc_exec($connection2, $sql2); 

			return $no_pesanan;
		}

		public function hitungjumlahtransaksi_gramedia() {
	
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=UM_DB;", "sa","");
	
			$sql2="
			select a.no_pesanan,
			(select count(b.no_pesanan) from [UM_DB].[dbo].master_gramed_temp as b where b.no_pesanan=a.no_pesanan and b.status_transaksi='N') as kode_1,
			(select count(d.no_pesanan) from [UM_DB].[dbo].master_gramed_temp_berhasil as d where d.no_pesanan=a.no_pesanan) as kode_2,
			(select count(e.no_pesanan) from [UM_DB].[dbo].master_gramed_temp as e where e.no_pesanan=a.no_pesanan and e.baru_masuk='Y') as kode_masuk
			from [UM_DB].[dbo].master_gramed_temp as a
			group by a.no_pesanan, a.send_date
			order by a.send_date, kode_1 DESC"; 
     
			$berhasil=0;
			$gagal=0;
			$pernahmasuk=0;
			$result_set2 = odbc_exec($connection2, $sql2); 
			while(odbc_fetch_row($result_set2)) {
				$kode1=odbc_result($result_set2,"kode_1");
				$kode2=odbc_result($result_set2,"kode_2");
				$kode3=odbc_result($result_set2,"kode_masuk");
				if($kode1>=0 && $kode3==0){
					$gagal=$gagal+1;
				}

				if($kode2>0 && $kode3==0){
					$berhasil=$berhasil+1;
				}
				
				if($kode3>0){
					$pernahmasuk=$pernahmasuk+1;
				}
			}

			return array($gagal, $berhasil, $pernahmasuk);
		}
		
		public function ambildata_billaddress_gramedia($customer_id) {
			$connection2 = odbc_connect("Driver={SQL Server};Server=(LOCAL);;Database=bambi-bmi;", "sa","");
			$sql2="select a.CustBillAddress, a.CustAddress from [bambi-bmi].[dbo].customer as a where a.CustomerID='".$customer_id."'"; 
			 
			$result_set2 = odbc_exec($connection2, $sql2);
			$cust_bill_address="";
			$cust_ship_address=""; 
			while(odbc_fetch_row($result_set2)) {
				$cust_bill_address=odbc_result($result_set2,"CustBillAddress");
				$cust_ship_address=odbc_result($result_set2,"CustAddress");
			}

			return array($cust_bill_address, $cust_ship_address);
		}
		
		}
		
		$database = new MySQLDatabase(); 
		
		
		?>																	
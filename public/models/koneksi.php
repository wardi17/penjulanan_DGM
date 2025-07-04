<?php
class My_db {
    function __construct()
    {
        $this->open_connection();
    }
    public function open_connection() {
		$connection = odbc_connect("Driver={SQL Server};Server=(LOCAL);Database=bambi-bmi;","sa","");
        //$connection = odbc_connect("Driver={SQL Server};Server=DESKTOP-PUJ0GAQ\MSSQLSERVER2;Database=bambi-bmi;","sa","");
		return $connection;
	}
}
$database = new My_db(); 
<?php
class My_db {
    function __construct()
    {
        $this->open_connection();
    }
    public function open_connection() {
		$connection = odbc_connect("Driver={SQL Server};Server=(LOCAL);Database=um_db;","sa","");
        //$connection = odbc_connect("Driver={SQL Server};Server=DESKTOP-PUJ0GAQ\MSSQLSERVER2;Database=UM_DB;","sa","");
		return $connection;
	}
}
$database = new My_db(); 
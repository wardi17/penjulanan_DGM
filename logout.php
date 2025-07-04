<?php 
session_start();
session_destroy();

unset($_SESSION['kode_log_exe']); 
header("Location: index.php");
 
?>
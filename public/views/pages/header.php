<?php
        session_start();
        
        $user_log = $_SESSION['login_user'];
     
        $class = $_SESSION['classku'];
   
        if($user_log==""){
            header('Location: /Penjualan_DGM');
        }
?>

<head>
    <meta charset="UTF-8">
    <title>Penjualan_DGM</title>
    
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
   
<link rel="stylesheet" href="assets/css/shared/iconly.css">
<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="assets/css/grafik.css">

<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->

<link href="assets/css/datatables.min.css" rel="stylesheet"/>
<script src="assets/js/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link href="assets/fontawesome/css/all.min.css"  rel="stylesheet"/>
<link rel="stylesheet" href="assets/css/jquery-ui.css">
  <script src="assets/js/jquery-ui.js"></script>

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>   
<script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>

<style type="text/css">

.thead {
  font-size: 14px;
  font-style: normal;
}
span{
  font-size: 14px;
}
.thead{
  background-color:#E7CEA6;
  /* font-size: 8px;
  font-weight: 100 !important; */
  color :#000000;
}
</style>





</head>
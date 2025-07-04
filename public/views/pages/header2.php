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
 
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="assets2/js/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    
    <link href="assets/css/datatables.min.css" rel="stylesheet"/>
 <script src="assets/js/datatables.min.js"></script>
 <link href="assets/fontawesome/css/all.min.css"  rel="stylesheet"/>
 <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.3/build/jquery.datetimepicker.full.min.js"></script>
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0-rc.2/themes/smoothness/jquery-ui.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.3/jquery.datetimepicker.min.css">
 <!-- Javascript Bootstrap Datepicker -->


 <title>Penjualan_DGM</title>
<style>
   .coku {
         background: #AFEEEE; /* Old browsers */
          border-radius:20px;
    -moz-border-radius:10px;
    -webkit-border-radius:10px;
    text-align: center;
    margin-top:10px;
      }

    table.dataTable td,th {
      font-size: 15px;
    }


/* .dataTables_paginate {
    display: none;
} */

.thead{
  background-color:#E7CEA6;
  font-size: 8px;
  font-weight: 100 !important;
  color :#000000;
}

.my_style .webix_hcell{
        background:#009966;
        color:white;
        font-weight:bold;
 
    }


@media print {
  @page {
    margin-top: 0;
    margin-bottom: 0;
  }
  thead{  
    background-color:Chartreuse;
  }
  #dvContainer {
           background-color: blue !important;
        }
  body  {
    padding-top: 5rem;
    padding-bottom: 2rem;
  }
}
/* @media print {
 
} */
</style>
</head>
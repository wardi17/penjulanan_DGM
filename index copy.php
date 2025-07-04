<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title>Executive</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="CRM-Fixed Asset">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
<link rel="manifest" href="assets/img/favicon/site.webmanifest">
<link rel="mask-icon" href="assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<!-- Sweet Alert -->
<link type="text/css" href="vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="vendor/notyf/notyf.min.css" rel="stylesheet">

<!-- Volt CSS -->
<link type="text/css" href="assets/css_login/volt.css" rel="stylesheet">

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

<style> 

.btn-gray-800 {
    color: #ffffff !important;
    background-color: #1F2937 !important;
    border-color: #1F2937 !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075) !important;
}
</style>
</head>

<body>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    

    <main>

        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image" data-background-lg="assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Sign in to Executive</h1>
                            </div>
                            <form method=POST action='models/user/cek_login.php'>
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                        </span>
                                        <input type="text" name="username" class="form-control" placeholder="Masukan Username" id="username" autofocus required>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                            </span>
                                            <input type="password" name="password" placeholder="Password" class="form-control" id="password" required>
                                        </div>  
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="pilihperusahaan">
                                            <br><br><br>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                </div>
                                <div class="d-grid">
                                    <button type="submit" id="saveForm" name="saveForm" class="btn btn-gray-800">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php require 'views/pages/header.php'; ?>


    <!-- <script>
        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                callback.apply(context, args);
                }, ms || 0);
            };
        }

        $('#username').keyup(delay(function (e) {
            
            var htmlpilih="";
            
            var user=$('#username').val();

            $.ajax({
                url         : "master/list/list_perusahaan_user.php?user_id="+user,
                type        : "GET",
                dataType    : 'JSON',
                beforeSend  : function (){
                    $("#pesan").empty().html("<center><button class='btn btn-secondary' type='button' disabled><span class='ms-1'>Loading...</span><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span></button></center>");
                },
                success : function (result){
                    htmlpilih+=`
                    <label for="password">Perusahaan</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon2">
                        <img src="https://img.icons8.com/ios-glyphs/24/000000/building--v1.png"/>
                        </span>
                        <select name="id_perusahaan" class="form-control" required>`;
                        $.each(result, function(a, b){
                            htmlpilih+=`<option value="${b.id}">${b.text}</option>`;
                        })    
                        htmlpilih+=`</select>
                    </div>
                    `;

                    $('.pilihperusahaan').html(htmlpilih);
                },
                error : function(){
                    $("#pesan").empty().html("<center><button class='btn btn-warning' type='button' disabled><span class='ms-1'>Loading Error...</span><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span></button></center>");
                }
            });
        }, 900));
    </script> -->
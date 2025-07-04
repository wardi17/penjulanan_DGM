<!DOCTYPE html>
<html lang="en">
<script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title>DGM</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="CRM-Fixed Asset">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="../assets/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">
<link rel="manifest" href="../assets/img/favicon/site.webmanifest">
<link rel="mask-icon" href="../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<script src="../assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="../assets/css/jquery-ui.css">
  <script src="../assets/js/jquery-ui.js"></script>
  <link href="../assets/fontawesome/css/all.min.css"  rel="stylesheet"/>
<!-- Notyf -->


<!-- Volt CSS -->
<link type="text/css" href="../assets/css_login/volt.css" rel="stylesheet">

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

<style> 

.btn-gray-800 {
    color: #ffffff !important;
    background-color: #7895CB !important;
    border-color: #C5DFF8 !important;
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
                <div class="row justify-content-center form-bg-image" data-background-lg="../assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div  style="width: 200px; height: 500px;" class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                         
                                <h1 class="mb-1 mt-5 h3 text-center">Sign in Penjualan DGM</h1>
                            <form method=POST action='welcome.php' class="mt-2">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" name="username" class="form-control" placeholder="Masukan Username" id="username" autofocus required>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Password</label>
                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password fa-4"></span>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                            <i class="fa-solid fa-lock"></i></span>
                                            <input type="password" name="password" placeholder="Password" class="form-control" id="password" required>
                                            <input type="hidden" name="kode_log" class="form-control" value ="23_@INOUT">
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

    <script>
        
        $(document).on("click",".toggle-password",function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

<?php
    session_start();
    $_userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
    $_titlepage = isset($_REQUEST["page"]) ? ucfirst($_REQUEST["page"]) : "GIS Pariwisata"; 

?>
<html>
    <head>
        <?php require_once('parts/inc_meta.php');?>
        <title><?php echo $_titlepage;?></title>
    </head>
    <body>
        <!-- navigasi -->
        <?php
            if ($_userid != '') {
                // private
                include 'parts/navigasi.php';
            } else {
                // public
                include 'parts/navigasi-public.php';
            }
        ?>
        <!-- content -->
        <div class="container container-custom my-3">
            <?php
                if ($_userid != '') {
                    // private
                    include 'pages.php';
                } else {
                    // public
                    include 'pages-public.php';
                }
            ?>
        </div>
        <footer class="footer bg-dark text-light">
            <div class="container text-center">
                <span>SIG Pariwisata</span>
            </div>
        </footer>
        <?php require_once('parts/inc_js.php');?>
    </body>
</html>
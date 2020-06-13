<?php
    $_userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
    // check session
    if ($_userid != '') {
        header('location:index.php?page=wisata');
    }

    // content
    include('koneksi.php');
    $_pages = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 'default';
    switch ($_pages) {
        // default
        case 'default':
            $_SESSION["titlepage"] = "Dashboard";
            include "pages/dashboard.php";
        break;

        // login
        case 'login':
            $_SESSION["titlepage"] = "Login Sistem";
            include "pages/public-login.php";
        break;

        // help
        case 'help':
            $_SESSION["titlepage"] = "Help Page";
            include "pages/public-help.php";
        break;

        case 'detail':
            include 'pages/detail_wisata.php';
        break;
        
        default:
            $_SESSION["titlepage"] = "Page Not Found";
            include "pages/public-notfound.php";
        break;
    }
?>
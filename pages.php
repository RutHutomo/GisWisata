<?php
    $_userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
    $_userrole = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : '';
    // check session
    if ($_userid == '') {
        header('location:index.php?page=login');
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

        // wisata
        case 'wisata':
            $_SESSION["titlepage"] = "Data Pariwisata";
            include "pages/wisata.php";
        break;
        
        // tambah wisata
        case 'wisata-add':
            $_SESSION["titlepage"] = "Tambah Data Pariwisata";
            include "pages/wisata-add.php";
        break;
        
        // edit wisata
        case 'wisata-edit':
            $_SESSION["titlepage"] = "Edit Data Pariwisata";
            include "pages/wisata-edit.php";
        break;

        case 'detail':
            include 'pages/detail_wisata.php';
        break;
        
        // hapus wisata
        case 'wisata-delete':
            $id_wisata = isset($_GET['id_wisata']) ? $_GET['id_wisata'] : '';
            if ($id_wisata != '') {
                $sqlcheck = "SELECT * FROM tbl_wisata WHERE id_wisata = $id_wisata AND user_wisata = $_userid";
                $qrycheck = mysqli_query($_koneksi, $sqlcheck);
                $databerita = $qrycheck->fetch_array();
                if (count($databerita) > 0) {
                    $sqldel = "DELETE FROM tbl_wisata WHERE id_wisata = $id_wisata AND user_wisata = $_userid";
                    $qrydel = mysqli_query($_koneksi, $sqldel);
                    if ($qrydel) {
                        unlink('files/'.$databerita['pic_wisata']);
                        header('location:index.php?page=wisata');
                    }
                } else {
                    echo "Data tidak ditemukan!";
                }
            } else {
                echo "Data tidak ditemukan!";
            }
        break;
        
        // user
        case 'user':
            $_SESSION["titlepage"] = "Data User";
            if ($_userrole == 'admin') {
                include "pages/user.php";
            } else {
                echo "Unauthorized!";
            }
        break;

        // tambah user
        case 'user-add':
            $_SESSION["titlepage"] = "Tambah Data User";
            if ($_userrole == 'admin') {
                include "pages/user-add.php";
            } else {
                echo "Unauthorized!";
            }
        break;

        // hapus user
        case 'user-delete':
            if ($_userrole == 'admin') {
                $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : '';
                if ($id_user != '') {
                    $sqlcheck = "SELECT * FROM tbl_user WHERE id_user = '$id_user'";
                    $qrycheck = mysqli_query($_koneksi, $sqlcheck);
                    $datauser = $qrycheck->fetch_array();
                    if (count($datauser) > 0) {
                        $sqldel = "DELETE FROM tbl_user WHERE id_user = $id_user";
                        $qrydel = mysqli_query($_koneksi, $sqldel);
                        if ($qrydel) {
                            header('location:index.php?page=user');
                        } else {
                            echo "Data gagal dihapus!";
                        }
                    } else {
                        echo "Data tidak ditemukan!";
                    }
                } else {
                    echo "Data tidak ditemukan!";
                }
            } else {
                echo "Unauthorized!";
            }
        break;

        // user profile
        case 'user-profile':
            $_SESSION["titlepage"] = "User Profile";
            include "pages/user-profile.php";
        break;

        // logout
        case 'logout':
            $_SESSION["titlepage"] = "Logout";
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['nama_user']);
            unset($_SESSION['user_role']);
            // redirect
            header('location:index.php?page=login');
        break;

        // help
        case 'help':
            $_SESSION["titlepage"] = "Help Page";
            include "pages/public-help.php";
        break;
        
        default:
            $_SESSION["titlepage"] = "Page Not Found";
            include "pages/public-notfound.php";
        break;
    }
?>
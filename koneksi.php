<?php 
  $_host       = "localhost";
  $_user       = "root";
  $_password   = "";
  $_database   = "db_wisata";
  $_port       = "3306";
  $_koneksi    = mysqli_connect($_host, $_user, $_password, $_database, $_port) or die(mysqli_error());
?>
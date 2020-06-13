<?php
// get data
$_userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
$ermsg_pas = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
$dataedit = array();
if ($_userid != '') {
    $sqlcheck = "SELECT * FROM tbl_user WHERE id_user = $_userid";
    $qrycheck = mysqli_query($_koneksi, $sqlcheck);
    $dataedit = $qrycheck->fetch_array();

    // action edit
    if(isset($_POST['tombol-edit'])) {
        if (count($dataedit) > 0) {
            // data berita
            $nama = isset($_POST['nama']) ? $_POST['nama'] : $dataedit['nama_user'];
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            
            // action
            $sqlupdate = "UPDATE tbl_user  SET nama_user = '$nama' WHERE id_user = $_userid";
            if ($password != '') {
                $passencrypt = md5($password);
                $sqlupdate = "UPDATE tbl_user  SET nama_user = '$nama', password = '$passencrypt' WHERE id_user = $_userid";
                mysqli_query($_koneksi, $sqlupdate);
                $ermsg = 'Data berhasil di update!';
            }else{
                mysqli_query($_koneksi, $sqlupdate);
                $ermsg = 'Data berhasil di update!';
            }
            $redirect = 'index.php?page=user-profile&msg='.$ermsg;
            header('location:'.$redirect);
        }
    }
}
?>
<div class="card">
    <div class="card-header">
        Profile User
    </div>
    <div class="card-body">
        <?php if ($ermsg_pas != '') { ?>
            <div class="alert alert-info" role="alert">
                <?php echo $ermsg_pas;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <?php if (count($dataedit) > 0) { ?>
            <form method="POST" action="index.php?page=user-profile">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $dataedit['nama_user'];?>" require/>
                </div>
                <div class="form-group">
                    <label>Change Password</label>
                    <input type="password" class="form-control" name="password"/>
                </div>
                <div class="form-group">
                    <a class="btn btn-danger mr-1" href="index.php" role="button">Back</a>
                    <input type="submit" name="tombol-edit" class="btn btn-primary" value="Update"/>
                </div>
            </form>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                Data tidak ditemukan!
            </div>
            <div>
                <a class="btn btn-danger mr-1" href="index.php" role="button">Back</a>
            </div>
        <?php } ?>
    </div>
</div>
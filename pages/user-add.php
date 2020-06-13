<?php 
if(isset($_POST['tombol-simpan']))
{
    $erraction = '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($username != '' && $password != '') {
        $sqlcheck = "SELECT * FROM tbl_user WHERE username = '$username'";
        $qrycheck = mysqli_query($_koneksi, $sqlcheck);
        $datachehck = $qrycheck->fetch_array();
        if (count($datachehck) == 0) {
            $passencrypt = md5($password);
            $sqlinsert = "INSERT INTO tbl_user (username, password, nama_user, role_user, status) VALUE ('$username', '$passencrypt', '$nama', '$role', 'aktif')";
            mysqli_query($_koneksi, $sqlinsert);
            header('location:index.php?page=user');
        } else {
            $erraction = "<b class='text-center'>User sudah ada!</b>";
        }
    }else{
        $erraction = "<b class='text-center'>Data tidak lengkap!</b>";
    }
    echo $erraction;
}
?>
<div class="card">
    <div class="card-header">
        Tambah Data User
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?page=user-add">
            <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="role" require>
                    <option value="admin">Admin</option>
                    <option value="staf">Staf</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" require/>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" require/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" require/>
            </div>
            <div class="form-group">
                <a class="btn btn-danger mr-1" href="index.php?page=user" role="button">Back</a>
                <input type="submit" name="tombol-simpan" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>
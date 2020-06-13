<?php
// action submit
if(isset($_POST['tombol-submit'])) {
    $erraction = '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    if ($username != '' && $password != '') {
        $sqlcheck = "SELECT * FROM tbl_user WHERE username = '$username'";
        $qrycheck = mysqli_query($_koneksi, $sqlcheck);
        $datachehck = $qrycheck->fetch_array();
        if (count($datachehck) > 0) {
            if ($datachehck['status'] == 'aktif') {
                if (md5($password) == $datachehck['password']) {
                    // create session
                    $_SESSION["user_id"] = $datachehck['id_user'];
                    $_SESSION["user_name"] = $datachehck['username'];
                    $_SESSION["nama_user"] = $datachehck['nama_user'];
                    $_SESSION["user_role"] = $datachehck['role_user'];
                    // redirect
                    header('location:index.php');
                } else {
                    $erraction = "<b class='text-center'>Username dan Password tidak cocok!</b>";
                }
            } else {
                $erraction = "<b class='text-center'>User $username tidak aktif!</b>";
            }
        } else {
            $erraction = "<b class='text-center'>User tidak ditemukan!</b>";
        }
    }else{
        $erraction = "<b class='text-center'>Input Usernama dan Password!</b>";
    }
    echo $erraction;
}
?>
<div class="card cont-login">
    <div class="card-header">
        Login - SIG Pariwisata
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?page=login">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required/>
            </div>
            <div class="form-group">
                <input type="submit" name="tombol-submit" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>
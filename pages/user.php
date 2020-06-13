<?php 
    $_userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 1;
    $_roleuser = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : 'admin';
    $sql_get = "select * from tbl_user where id_user = $_userid";
    if ($_roleuser == 'admin') {
        $sql_get = "select * from tbl_user";
    }
    $query = mysqli_query($_koneksi, $sql_get);
?>
<div class="my-3 box-shadow bg-success p-3">
    <a class="btn btn-warning" href="index.php?page=user-add" role="button"><i class="fa fa-plus"></i> Tambah User</a>
</div>
<div class="table-responsive card-body p-0">
    <table class="table table-striped" id="data">
        <thead class="kapital text-center">
            <tr>
                <th width="5">No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Status</th>
                <th width="5">Action</th>
            </tr>
        </thead>
        <?php 
        $no = 1;
        while($row = mysqli_fetch_array($query))
        {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['nama_user']; ?></td>
                <td class="text-center kapital"><?php echo $row['role_user']; ?></td>
                <td class="kapital text-center"><?php echo ucfirst($row['status']); ?></td>
                <td class="text-center">
                    <a href="index.php?page=user-delete&id_user=<?php echo $row['id_user']; ?>">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
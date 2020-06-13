<?php
    $_userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
    $_userrole = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : '';
    $query = mysqli_query($_koneksi,"select * from tbl_wisata as w where user_wisata = ".$_userid);
    if ($_userrole == 'admin') {
        $query = mysqli_query($_koneksi,"select * from tbl_wisata");
    }
?>
<div class="my-3 card-body p-3 box-shadow bg-success">
    <a class="btn btn-warning btn-flat" href="index.php?page=wisata-add" role="button"><i class="fa fa-plus"></i> Tambah Wisata</a>
</div>
<div class="table-responsive card-body p-0 card-body">
    <table class="table table-striped" id="data">
        <thead class="kapital">
            <tr class="text-center">
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Wisata</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1;
        while($row = mysqli_fetch_array($query))
        {
            ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><img src="files/<?php echo $row['pic_wisata']; ?>" width="100"/></td>
                <td><?php echo $row['nama_wisata']; ?></td>
                <td class="text-center"><?php echo ucfirst($row['jenis_wisata']); ?></td>
                <td><?php echo $row['desc_wisata']; ?></td>
                <td><?php echo $row['long_wisata']; ?></td>
                <td><?php echo $row['lat_wisata']; ?></td>
                <td>
                    <a class="mr-2" href="index.php?page=wisata-edit&id_wisata=<?php echo $row['id_wisata']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?page=wisata-delete&id_wisata=<?php echo $row['id_wisata']; ?>">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
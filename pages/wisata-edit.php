<?php
// get data
$_userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
$_userrole = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : '';
$id_wisata = isset($_REQUEST['id_wisata']) ? $_REQUEST['id_wisata'] : '';
$ermsg_pas = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
$dataedit = array();
if ($id_wisata != '') {
    $sqlcheck = "SELECT * FROM tbl_wisata WHERE id_wisata = $id_wisata and user_wisata = $_userid";
    if ($_userrole == 'admin') {
        $sqlcheck = "SELECT * FROM tbl_wisata WHERE id_wisata = $id_wisata";
    }
    $qrycheck = mysqli_query($_koneksi, $sqlcheck);
    $dataedit = $qrycheck->fetch_array();

    // action edit
    if(isset($_POST['tombol-edit'])) {
        if (count($dataedit) > 0) {
            // data berita
            $nama = isset($_POST['nama']) ? $_POST['nama'] : $dataedit['nama_wisata'];
            $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : $dataedit['jenis_wisata'];
            $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : $dataedit['desc_wisata'];
            $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : $dataedit['long_wisata'];
            $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : $dataedit['lat_wisata'];

            // data file
            $editfile = 0;
            if (isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != '') {
                $temp = $_FILES['gambar']['tmp_name'];
                $name = rand(0,9999).$_FILES['gambar']['name'];
                $size = $_FILES['gambar']['size'];
                $type = $_FILES['gambar']['type'];
                $editfile = 1;
            }
            $folder = "files/";
            // action
            $sqlupdate = "UPDATE tbl_wisata  SET nama_wisata = '$nama', desc_wisata = '$keterangan', jenis_wisata = '$jenis', user_wisata = '$_userid', long_wisata = '$longitude', lat_wisata = '$latitude' WHERE id_wisata = $id_wisata";
            if ($editfile == 1) {
                if ($size < 2048000 and ($type =='image/jpeg' or $type == 'image/png')) {
                    move_uploaded_file($temp, $folder . $name);
                    $sqlupdate = "UPDATE tbl_wisata  SET nama_wisata = '$nama', desc_wisata = '$keterangan', pic_wisata = '$name', jenis_wisata = '$jenis', user_wisata = '$_userid', long_wisata = '$longitude', lat_wisata = '$latitude' WHERE id_wisata = $id_wisata";
                    mysqli_query($_koneksi, $sqlupdate);
                    unlink($folder.''.$dataedit['pic_wisata']);
                    $ermsg = 'Data berhasil di update!';
                } else {
                    mysqli_query($_koneksi, $sqlupdate);
                    $ermsg = 'Sukses update!, tetapi Gagal Upload File, Max 2MB, Format JPG/JPEG/PNG';
                }
            }else{
                mysqli_query($_koneksi, $sqlupdate);
                $ermsg = 'Data berhasil di update!';
            }
            $redirect = 'index.php?page=wisata-edit&msg='.$ermsg.'&id_wisata='.$dataedit['id_wisata'];
            header('location:'.$redirect);
        }
    }
}
?>
<div class="card">
    <div class="card-header">
        Edit Data Wisata
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
            <form method="POST" action="index.php?page=wisata-edit" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $dataedit['nama_wisata'];?>"/>
                </div>
                <div class="form-group">
                    <label>Jenis</label>
                    <select class="form-control" name="jenis">
                        <option value="<?php echo $dataedit['jenis_wisata'];?>"><?php echo $dataedit['jenis_wisata'];?></option>
                        <option value="wisata">Obyek Wisata</option>
                        <option value="artshop">Artshop</option>
                        <option value="penginapan">Penginapan</option>
                        <option value="kuliner">Kuliner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan"><?php echo $dataedit['desc_wisata'];?></textarea>
                </div>
                <div class="form-group">
                    <label>Longitude</label>
                    <input type="text" class="form-control" name="longitude" value="<?php echo $dataedit['long_wisata'];?>"/>
                </div>
                <div class="form-group">
                    <label>Latitude</label>
                    <input type="text" class="form-control" name="latitude" value="<?php echo $dataedit['lat_wisata'];?>"/>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <div class="mb-3">
                        <img src="files/<?php echo $dataedit['pic_wisata']; ?>" width="300"/>
                    </div>
                    <input type="file" class="form-control" name="gambar"/>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_wisata" value="<?php echo $dataedit['id_wisata'];?>"/>
                    <a class="btn btn-danger mr-1" href="index.php?page=wisata" role="button">Back</a>
                    <input type="submit" name="tombol-edit" class="btn btn-primary" />
                </div>
            </form>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                Data tidak ditemukan!
            </div>
            <div>
                <a class="btn btn-danger mr-1" href="index.php?page=wisata" role="button">Back</a>
            </div>
        <?php } ?>
    </div>
</div>
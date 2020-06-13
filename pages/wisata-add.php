<?php 
if(isset($_POST['tombol-simpan']))
{
    $temp = $_FILES['gambar']['tmp_name'];
    $name = rand(0,9999).$_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $type = $_FILES['gambar']['type'];

    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : 'wisata';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '0';
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '0';
    $_userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
    
    $folder = "files/";
    echo $type;
    if ($size < 2048000 and ($type =='image/jpeg' or $type == 'image/png')) {
        $sqlinsert = "INSERT INTO tbl_wisata (nama_wisata, desc_wisata, pic_wisata, jenis_wisata, long_wisata, lat_wisata, user_wisata) VALUE ('$nama', '$keterangan', '$name', '$jenis', '$longitude', '$latitude', $_userid)";
        move_uploaded_file($temp, $folder . $name);
        mysqli_query($_koneksi, $sqlinsert);
        header('location:index.php?page=wisata');
    }else{
        echo "<b>Gagal Upload File</b>";
    }
}
?>
<div class="card">
    <div class="card-header">
        Tambah Data Wisata
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?page=wisata-add" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama"/>
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <select class="form-control" name="jenis">
                    <option value="wisata">Obyek Wisata</option>
                    <option value="artshop">Artshop</option>
                    <option value="penginapan">Penginapan</option>
                    <option value="kuliner">Kuliner</option>
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan"></textarea>
            </div>
            <div class="form-group">
                <label>Longitude</label>
                <input type="text" class="form-control" name="longitude"/>
            </div>
            <div class="form-group">
                <label>Latitude</label>
                <input type="text" class="form-control" name="latitude"/>
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" class="form-control" name="gambar"/>
            </div>
            <div class="form-group">
                <a class="btn btn-danger mr-1" href="index.php?page=wisata" role="button">Back</a>
                <input type="submit" name="tombol-simpan" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>
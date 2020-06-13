<?php
include 'koneksi.php';
$id = $_GET["id"];
$jenis = $_GET["jenis"];
$data = mysqli_query($_koneksi, "SELECT * FROM tbl_wisata WHERE id_wisata = '$id'");
$recent = mysqli_query($_koneksi, "SELECT * FROM tbl_wisata WHERE jenis_wisata = '$jenis' ORDER BY id_wisata DESC");

while ($row = mysqli_fetch_assoc($data)) 
{
	$judul = $row["nama_wisata"];
	$deskripsi = $row["desc_wisata"];
	$gambar = $row["pic_wisata"];
}

?>
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12">
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-sm-9" style="background-image:url(files/<?php $gambar ?>);">
						<h4><?php echo $judul; ?></h4>
						<hr>
						<img src="files/73258653Taman Ayun.jpg" style="width: 100%; height: 400px; margin-left: auto;margin-top: auto;display: block; margin-right: auto;">
						<p style="color: #000">
							<br>
							<?php echo $deskripsi; ?>
						</p>
					</div>
					<div class="col-12 col-sm-3">
						<div class="row">
							<div class="col-12 col-sm-12">
								<hr>
								<h5>Sering Dikunjungi</h5>
								<hr>
							</div>
							<?php 
								while ($row = mysqli_fetch_array($recent)) 
								{
							?>
							<div class="col-12 col-sm-12" style="margin-bottom: 5px; margin-top: 5px">
								<div class="row">
									<div class="col-md-5">
										<img src="files/<?php echo $row["pic_wisata"]; ?>" style="width: 100%; height: 50px">
									</div>
									<div class="col-md-7">
										<a href="#"><h6><?php echo $row["nama_wisata"] ?></h6></a>
									</div>
								</div>
							</div>
							<hr>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
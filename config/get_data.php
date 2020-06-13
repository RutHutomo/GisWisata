<?php
error_reporting(0);
include "../koneksi.php";
if ($_GET["jenis"] != "") 
{
	$jenis = $_GET["jenis"];
	if ($_GET["nama"] != "") 
	{
		$nama = $_GET["nama"];
		$sql = mysqli_query($_koneksi, "SELECT * FROM tbl_wisata WHERE jenis_wisata = '$jenis' AND nama_wisata LIKE('%$nama%')")or die(mysqli_error());
		if($sql){
		 		$count = mysqli_num_rows($sql);
			      if($count > 0 )
			      {
			             while($post = mysqli_fetch_array($sql)){
			                     $posts[] = $post;
			             }
			             $data = json_encode($posts);
			      		echo $data;
			      }   
			      else
			      {
			      	echo $count;
			      }     
		                          
		}
	}
	else
	{
		$nama = $_GET["nama"];
		$sql = mysqli_query($_koneksi, "SELECT * FROM tbl_wisata WHERE jenis_wisata = '$jenis'")or die(mysqli_error());
		if($sql){
		 		$count = mysqli_num_rows($sql);
			      if($count > 0 )
			      {
			             while($post = mysqli_fetch_array($sql)){
			                     $posts[] = $post;
			             }
			             $data = json_encode($posts);
			      		echo $data;
			      }   
			      else
			      {
			      	echo $count;
			      }                  
		}
	}
	
}
else
{
		//$nama = $_GET["nama"];
		$sql = mysqli_query($_koneksi, "SELECT * FROM tbl_wisata")or die(mysqli_error());
		if($sql){
		 	//$posts = array();
		      if(mysqli_num_rows($sql))
		      {
		             while($post = mysqli_fetch_array($sql)){
		                     $posts[] = $post;
		             }
		             $data = json_encode($posts);
		      		echo $data; 
		      }                   
		}
}


?>
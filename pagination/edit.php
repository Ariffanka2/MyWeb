<?php
require 'function.php';
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}
 

#$conn= mysqli_connect("localhost","root","", "phpdasar");
$id=$_GET['id'];
$data= query("SELECT * FROM siswa2 WHERE id=$id")[0];

if( isset($_POST["submit"]) ) {
	if (edit($_POST) > 0) {
			echo "
					<script>
					alert('Data berhasil diubah');
					document.location.href='index.php';
					</script>
			";
		}else{
			echo "
					<script>
					alert('Data gagal diubah');
					document.location.href='index.php';
					</script>
			";
		}	

	}



 ?>


<!DOCTYPE html>
<html>
<head>
	<title>add siswa data</title>
	<link rel="stylesheet" type="text/css" href="try.css">
</head>
<body>
	<nav>
	<p><a href="logout.php">logout</a></p>
	</nav>

	<div class="lay">
	<div class="con">
		<h1>Edit Data</h1><br>
	<div class="pad">
		<h2>Fill In Here</h2>
		<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $data['id']?>">
		<input type="hidden" name="galam" value="<?= $data['gambar']?>">

	<form action="" method="post" enctype="multipart/form-data">
		<table border="0">

			<tr>
				<td><label for="nama">Nama: </label></td>
			</tr>
			<tr>
				<td><input type="text" name="nama" id="nama" required value="<?= $data['nama']?>"></td>
			</tr>
			<tr>
				<td><label for="nis">NIS: </label></td>
			</tr>
			<tr>
				<td><input type="text" name="nis" id="nis" required value="<?= $data['nis']?>"></td>
			</tr>
			<tr>
				<td><label for="jurusan">Jurusan: </label></td>
			</tr>
			<tr>
				<td><input type="text" name="jurusan" id="jurusan" required value="<?= $data['jurusan']?>"></td>
			</tr>
			<tr>
				<td>gambar:</td>
			</tr>
			<tr>
				<td><img src="img/<?= $data['gambar']?>" width="15"></td>
			</tr>
			<tr>
				<td><input type="file" name="gambar" id="gambar"></td></td>
			</tr>
			<tr>
				<td rowspan="2" align="center"><button type="submit" name="submit">add</button></td>
			</tr>
		
		</table>
	</form>
	</div>
</div>
</body>
</html>
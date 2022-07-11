 autocomplete="off"<?php 
require 'function.php';
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

#$conn= mysqli_connect("localhost","root","", "phpdasar");

if( isset($_POST["submit"]) ) {
	if (add($_POST) > 0) {
			echo "
					<script>
					alert('Data berhasil ditambahkan');
					document.location.href='index.php';
					</script>
			";
		}else{
			echo "
					<script>
					alert('Data gagal ditambahkan');
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
		<h1>Add Data</h1><br>
	<div class="pad">
		<h2>Fill In Here</h2>
	<form action="" method="post" enctype="multipart/form-data">
		<table border="0">

			<tr>
				<td><label for="nama">Nama: </label></td>
			</tr>
			<tr>
				<td><input type="text" name="nama" id="nama" required autocomplete="off"></td>
			</tr>
			<tr>
				<td><label for="nis">NIS: </label></td>
			</tr>
			<tr>
				<td><input type="text" name="nis" id="nis" required autocomplete="off"></td>
			</tr>
			<tr>
				<td><label for="jurusan">Jurusan: </label></td>
			</tr>
			<tr>
				<td><input type="text" name="jurusan" id="jurusan" required autocomplete="off"></td>
			</tr>
			<tr>
				<td>gambar:<input type="file" name="gambar" id="gambar"></td>
			</tr>
			<tr>
				<td rowspan="2" align="center"><button type="submit" name="submit">add</button></td>
			</tr>
		
		</table>
	</form>
	</div>
</div>
</div>
</body>
</html>
<?php 
require 'function.php';
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

//pagination
$siswa=query("SELECT * FROM siswa2 LIMIT $awat,$judapeha");

if (isset($_POST['cari'])) {
	$siswa=search($_POST["keyword"]);

}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Tabel Siswa</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<nav>
	<p><a href="logout.php">logout</a></p>
	</nav>
	<div class="con">
<h1>Tabel Siswa</h1>
<form action="" method="post">
	<input class="input" type="text" name="keyword" size="30" autofocus placeholder="Masukan keyword" autocomplete="off">
		
	<button type="submit" name="cari" class="cari">Cari!</button>
</form>
<br>
<a href="add.php"  class="btn"><button type="submit" class="tmb">add</button></a>
<br>

<p align="center">
	Note: 'x' di aksi untuk hapus dan '/' di aksi untuk edit.
	ukuran photo 30px.
</p>
<table border="0" cellpadding="10" cellspacing="0">
<tr class="a">
	<th>No.</th>
	<th>Aksi</th>
	<th>Nama</th>
	<th>NIS</th>
	<th>Jurusan</th>
	<th>Gambar</th>
</tr>
<?php $i=1; ?>
<?php foreach ($siswa as $row): ?>
<tr>
	<td><?= $i; ?></td>
	<td><a class="e" href="edit.php?id=<?=  $row["id"];  ?>">/</a>
	<a class="x"  href="del.php?id=<?=  $row["id"];  ?>" onclick="return confirm('yakin?');"> x </a></td>
	<td><?= $row["nama"]; ?></td>
	<td><?= $row["nis"]; ?></td>
	<td><?= $row["jurusan"]; ?></td>
	<td><img src="img/<?= $row["gambar"]; ?>"></td>
</tr>


<?php $i++ ?>
<?php 
endforeach;
 ?>
</table>
<br>
<br>
<?php if($haltif > 1): ?>
	<a href="?page=<?= $haltif-1; ?>" class="row">&laquo;</a>
<?php endif; ?>
<!-- navigasi -->
<?php for($i=1; $i<= $jumhal; $i++): ?>
	<?php if($i == $haltif): ?>
		<b><a href="?page=<?= $i; ?>" class="if"><?= $i; ?></a></b>
	<?php else: ?>
		<a href="?page=<?= $i; ?>" class="pag"><?= $i; ?></a>
	<?php endif; ?>
<?php endfor; ?>
<?php if($haltif < $jumhal): ?>
	<a href="?page=<?= $haltif+1; ?>" class="row">&raquo;</a>
<?php endif; ?>

</div>

</body>
</html>
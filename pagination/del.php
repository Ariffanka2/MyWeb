<?php 
require 'function.php';
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}



$id=$_GET['id'];


if (del($id)>0) {
				echo "
					<script>
					alert('Data berhasil dihapus');
					document.location.href='index.php';
					</script>
			";

}else{
				echo "
					<script>
					alert('Data gagal dihapus');
					document.location.href='index.php';
					</script>
			";

}

 ?>
<?php 
$db=mysqli_connect("localhost","root","","phpdasar");


function query($query){
	global $db;
	$result= mysqli_query($db,$query);
 	$rows= [];
 	while($row= mysqli_fetch_assoc($result)){
 		$rows[] = $row;
 	}
 		return $rows;
   
}

function add($data){
	global $db;
	$nama= htmlspecialchars($data["nama"]);	
	$nis= htmlspecialchars($data["nis"]);
	$jurusan= htmlspecialchars($data["jurusan"]);

	$gambar= upload();
	if(!$gambar){
		return false;
	}

	$query= "INSERT INTO siswa2
				VALUES
				('','$nama','$nis','$jurusan','$gambar')
				";

	mysqli_query($db,$query);
	return mysqli_affected_rows($db);

}

function upload(){
	$nafil=$_FILES["gambar"]["name"];
	$ukfil=$_FILES["gambar"]["size"];
	$error=$_FILES["gambar"]["error"];
	$tsbar=$_FILES["gambar"]["tmp_name"];

	if($error===4){
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
			  return false;
	}

	$ekstensi=['jpg','jpeg','png'];
	$eksgam= explode('.', $nafil);
	$eksgam= strtolower(end($eksgam));
	if(!in_array($eksgam, $ekstensi)){
		echo "<script>
				alert('ektensi file tak sesuai!');
			  </script>";
			  return false;
	}

	if($ukfil>2000000){
		echo "<script>
				alert('ukuran gambar tak sesuai');
			  </script>";
			  return false;
	}
	$nafilru= uniqid();
	$nafilru .='.';
	$nafilru .=$eksgam;

	move_uploaded_file($tsbar,'img/'. $nafilru);
	return $nafilru;


}

function del($id){
	global $db;
	mysqli_query($db, "DELETE FROM siswa2 WHERE id=$id");
	return mysqli_affected_rows($db);
}

function edit($data){
	global $db;
	$id= $data["id"];
	$nama= htmlspecialchars($data["nama"]);	
	$nis= htmlspecialchars($data["nis"]);
	$jurusan= htmlspecialchars($data["jurusan"]);
	$galam= htmlspecialchars($data["galam"]);

	if($_FILES["gambar"]["error"]===4){
		$gambar=$galam;
	}else{
		$gambar=upload();
	}

	$query= "UPDATE siswa2 SET
			nama='$nama',
			nis='$nis',
			jurusan='$jurusan',
			gambar='$gambar'
			WHERE id=$id"
			;

	mysqli_query($db,$query);
	return mysqli_affected_rows($db);	
}

function search($keyword){
	$query= "SELECT * FROM siswa2 WHERE
	nama LIKE '%$keyword%' OR
	nis LIKE '%$keyword%' OR
	jurusan LIKE '%$keyword%'

		";
		return query($query);
}


function reg($data){
	global $db;

	$username= strtolower(stripslashes($data['user']));
	$password= mysqli_real_escape_string($db,$data['pass']);
	$password2= mysqli_real_escape_string($db,$data['pass2']);

	#cek apakah nama yang sama sudah ada atau belum
	$result= mysqli_query($db, "SELECT username FROM users 
		WHERE username= '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username telah ada!');
			  </script>";
			  return false;
	}
	#cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password salah');
			  </script>";
			  return false;
	}
	#enkripsi data gan
	$password= password_hash($password, PASSWORD_DEFAULT);
	#tambah ke database
	mysqli_query($db, "INSERT INTO users VALUES ('','$username','$password')");

		return mysqli_affected_rows($db);
}

	//pagination tools
	$judapeha= 2;
	$jumdat=count(query("SELECT * FROM siswa2"));
	$jumhal= ceil($jumdat/$judapeha  );
	$haltif= ( isset($_GET['page']) ) ? $_GET['page'] : 1;
	$awat= 	($judapeha * $haltif)-$judapeha;



 ?>

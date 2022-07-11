<?php 
require'function.php';
if (isset($_POST['reg'])) {
	if (reg($_POST)>0) {
		echo "<script>
					alert('Data berhasil ditambahkan');
					</script>";
					header("Location:login.php");
	}else{
		echo mysqli_error($db);
	}
}


 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="reg.css" />
  </head>
    <div class="container">
      <div class="card">
        <div class="tittle">
          <h1>Register</h1>
        </div>
        <form method="post" action="">
        <div class="username">
          <input type="text" placeholder="Username" name="user" autocomplete="off" />
        </div>
        <div class="password">
          <input type="password" placeholder="Password" name="pass" autocomplete="off" />
        </div>
        <div class="password2">
          <input type="password" placeholder="Confirm Password" name="pass2" autocomplete="off" />
        </div>
        <div class="login">
          <button type="submit" name="reg">SignUp</button>
        </div>
        </form>
      </div>
    </div>
</form>
</body>
</html>
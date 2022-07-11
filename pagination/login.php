<?php 
require'function.php';
session_start();

#cek cookie
if (isset($_COOKIE['log']) && isset($_COOKIE['key'])) {
  $id= $_COOKIE['log'];
  $key= $_COOKIE['key'];

  #berdasar id
  $result=mysqli_query($db, "SELECT username FROM users WHERE id= $id ");
  $row= mysqli_fetch_assoc($result);

  #cek cookie dan username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login']= true;
  }
}


if (isset($_SESSION['login'])) {
	header("Location: index.php");
	exit;
}


if (isset($_POST['log'])) {
	$username= $_POST['user'];
	$password= $_POST['pass'];

	$result=mysqli_query($db, "SELECT * FROM users WHERE username='$username'");

	#cek username apakah ada atau tidak
	if (mysqli_num_rows($result) === 1) {
		#cek password
		$row= mysqli_fetch_assoc($result);
		if (password_verify($password, $row['password'])) {
			#cek session
			$_SESSION['login']=true;
      #cek remember me
      if (isset($_POST['rm'])) {
        #set cookie
        setcookie('log',$row['id'], time()+80);
        setcookie('key', hash('sha256', $row['username']), time()+80);
      }
			header("Location: index.php");
			exit;
		}
	}
	$error= true;
}


 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="login.css" />
  </head>
  <body><?php if(isset($error)): ?>
      <?php 
echo "
          <script>
          alert('Username atau Password salah');
          document.location.href='index.php';
          </script>"

       /* echo "<div onClick={popup}></div>
              <div class='popupbg'>
               <p class='popuptext'>The product is successfully added to the cart</p>
              </div>
              <div class='closepopup'></div>";
            */
      
      ?>
    <?php endif; ?>
    <div class="container">
      <div class="card">
        <div class="tittle">
          <h1>Login</h1>
        </div>
        <form method="post" action="">
        <div class="username">
          <input type="text" placeholder="Username" name="user" autocomplete="off" autofocus="on" />
        </div>
        <div class="password">
          <input type="password" placeholder="Password" name="pass" autocomplete="off" />
        </div>
        <div class="login">
          <button type="submit" name="log">Login</button>
        </div>
         <div class="rm"><input type="radio" name="rm">Remember me</div>
        </form>
        <div class="card-text">
          <p>Woi udah punya akun belom? Daftar dulu gan <a href="reg.php">Sing Up</a></p>
        </div>
      </div>
    </div>
    <script type="">
      /*function menuToggle(){
          const toggleMenu = document.querySelector('.menu');
          toggleMenu.classList.toggle('active')
      }
      function popup(){
          const clickaddcart = document.querySelector(".klikaddcart");
          const bgpopup = document.querySelector(".popupbg");
          const popupclose = document.querySelector(".closepopup");
          clickaddcart.addEventListener("click", ()=>{
              bgpopup.classList.add("show");
          });
          popupclose.addEventListener("click", ()=>{
              bgpopup.classList.remove("show");
          });
      }*/
    </script>
  </body>
</html>
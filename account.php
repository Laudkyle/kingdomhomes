<?PHP
session_start();

include("connection.php");
include("functions.php");

if (isset($_POST['register-btn'])){
	$user_name = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	if (!empty($user_name) && !empty($password) && !empty($email) && !is_numeric($user_name))
	{
	
		// Save details to database
		
		$user_id = random_num(20);
		$query = "insert into user_list (user_id,user_name,email,password,user_level) values ('$user_id','$user_name','$email','$password','1')";
		
		mysqli_query($con, $query);
		
	}else{
		echo("Please enter valid information");
	}
}
				
					/* Login  php*/


if (isset($_POST['login-btn'])){
	$user_name = $_POST['username'];
	$password = $_POST['password'];
	
	if (!empty($user_name) && !empty($password) && !is_numeric($user_name))
	{
	
		// Read from database
		
		$query = "select * from user_list where user_name = '$user_name' limit 1";
		
		$result = mysqli_query($con, $query);
		if ($result){
		if ($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			if ($user_data['password'] === $password)
			{
				$_SESSION['user_id'] = $user_data['user_id'];		
				$_SESSION['user_level'] = $user_data['user_level'];		
				header("Location: index.php");
				die;
			}
		}
	 }
		echo("Wrong username or password!");
	
	}
	else{
		echo("Wrong username or password!");
	}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale= 1.0">
<title> KINGDOM HOMES</title>
	
	<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="header">
<div class="container">
  <div class="navbar">
	<div class="logo">
    <a href="index.php"><img src="images/logo.png" width="125"/> </a>
	  </div>
	<nav>
	<ul id="MenuItems">
		<li><a href="index.php">Home</a></li>
		<li><a href="Products.php">Products</a></li>
		<?php
		if (!isset($_SESSION['user_id'])){
	 echo "<li><a href='account.php'>Account</a></li>";
		}
			?>
			<?php
		if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 0){
	 echo "<li><a href='upload.php'>Dashboard</a></li>";
		}
			?>
		<li onClick="servicesToggle()" onMouseUp="menuToggle()"><a href="#">Services</a></li>
		<li><a href="contact.php">Contact</a></li>
		<li><a href="">About</a></li>
<?php
		if (isset($_SESSION['user_id'])){
	 echo "<li><a href='logout.php'>Logout</a></li>";
		}
			?>			</ul>
	</nav>
    <img src="images/menu.png" class="menu-icon" onClick="menuToggle()"/> </div>
		 <div class="service-list">
			 <ul id="serviceItems">
				<?php
				$sql = "SELECT * FROM service_list";
						$results = mysqli_query($con, $sql);           

						while ($row = mysqli_fetch_array($results)){
							echo "<li>".$row['services']."</li>";
						}
				?>
			</ul>
		</div>
<!--------------------------------Account-page--------------------------->
	
<div class="account-page">
  <div class="container">
    <div class="row-account">
	  <div class="col-2">
		<div class="form-container">
	      <div class="form-btn">
			<span onClick="register()">Register</span>
			  <span onClick="login()">Login</span>
			  <hr id="indicator">
			  
			</div>

			<form id="Logform" method="post">
				<div class="input-group">
			<input type="text" id="username" name="username" required>
			<label for="username">Username</label>
				</div>
				<div class="input-group">
			<input type="password" id="password" name="password" required>
			<label for="password">Password</label>
				</div>
				<button type="submit" class="btn" name="login-btn">Login</button>
				<a href="" class="color-f">Forgot Password</a>
			</form>
				<form  id ="Regform" method="post">
					<div class="input-group">
			<input type="text" name="username" required>
			<label for="password">Username</label>
				</div>
				<div class="input-group">
			<input type="email"id="email" placeholder="@gmail.com" name="email" required>
			<label for="email">Email</label>
				</div>
				<div class="input-group">
			<input type="password" id="password" name="password" required>
			<label for="password">Password</label>
				</div>
				<button type="submit" class="btn" name="register-btn" onClick="login()">Register</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-----------------------------------Footer------------------------------>
<div class="footer">
	<div class="container">
	  <div class="row">
		<div class="footer-col-1">
		  <h3>Download Our App</h3>
		  <p>Download App for android and IOS devices</p>
		  <div class="app-logo">
			<img src="images/play-store.png"/>
			<img src="images/app-store.png"/>
			
		  </div>
        </div>
		  <div class="footer-col-2">
		    <img src="images/logo-white.png"/>
			<p> Our purpose is to make homes affordable and reliable at the tab of a key</p>
	    </div>
		  		<div class="footer-col-3">
				<h3>Useful Links</h3>
				<ul>
					<li>Blog Post</li>
					<li>Coupons</li>
					<li>Return Policy</li>
					<li>Join affiliate</li>
				</ul>
	    </div>
		  <div class="footer-col-4">
				<h3>Follow Us</h3>
				<ul>
					<li>Facebook</li>
					<li>Twitter</li>
					<li>Instagram</li>
					<li>Youtube</li>
				</ul>
	    </div>
      </div>
		<hr>
		<p class="copyright">Copyright &copy; 2021 - Kyland Robotics</p>
    </div>
</div>
	<!----------------------------------Script for Menu----------------------------->
	<script>
	var MenuItems = document.getElementById("MenuItems");
	
	MenuItems.style.maxHeight = "0px";
		
		function menuToggle(){
		if (MenuItems.style.maxHeight == "0px")
		{
			MenuItems.style.maxHeight = "200px";
		}	
			else{
				MenuItems.style.maxHeight = "0px";
			}
		}
			/*----------------------------------Script for toggle form------------------------------*/

	var Logform = document.getElementById("Logform");
	var Regform = document.getElementById("Regform");
	var indicator = document.getElementById("indicator");
	
	
	 	function login(){
			Regform.style.transform = "translateX(0px)";
			Logform.style.transform = "translateX(0px)";
			indicator.style.transform = "translateX(100px)";
		}
		function register(){
			Regform.style.transform = "translateX(300px)";
			Logform.style.transform = "translateX(300px)";
			indicator.style.transform = "translateX(0px)";
		}
		
		
		/*---------------------------------------services-------------------------------------*/
		
		var serviceItems = document.getElementById("serviceItems");
	
	serviceItems.style.maxHeight = "0px";
		
		function servicesToggle(){
		if (serviceItems.style.maxHeight == "0px")
		{
			serviceItems.style.maxHeight = "200px";
		}	
			else{
				serviceItems.style.maxHeight = "0px";
			}
		}
		
		
	</script>
</body>
</html>

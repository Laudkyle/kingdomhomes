<?php
session_start();

include("connection.php");
include("functions.php");
require_once ('ads.php');


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale= 1.0">
<title> KINGDOM HOMES</title>

	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/e899500b1e.js" crossorigin="anonymous"></script>

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
	 echo "<li><a href='admin_page.php'>Dashboard</a></li>";
		}
			?>
		<li onClick="servicesToggle()" onMouseUp="menuToggle()"><a href="#">Services</a></li>
		<li><a href="contact.php">Contact</a></li>
		<li><a href="">About</a></li>
	<?php
		if (isset($_SESSION['user_id'])){
	 echo "<li><a href='logout.php'>Logout</a></li>";
		}
			?>		</ul>
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
  <div class="section-header">
	  <div class="welcome">
		  <h1>Get Yourself A New <br> Home!</h1>
		<p>There is nothing more important than a good, safe and secure home.</p>
	  <a href="Products.php" class="btn">Explore now &#8594;</a>
		  </div>
	
  </div>
</div>
	<!------------------Featured Categories--------------------------->
<section class="slider_body">	
<div class="carousel-container">
		<i class="fa fa-arrow-left" id="prevBtn"></i>
		<i class="fa fa-arrow-right" id="nextBtn"></i>
		<div class="carousel-slide">
		<img src="images/home15.jpg" id="la" alt="1" >
		<img src="images/home10.jpg" alt="1" >
		<img src="images/home11.jpg" alt="1" >
		<img src="images/home12.jpg" alt="1" >
		<img src="images/home13.jpg" alt="1" > 
		<img src="images/home14.jpg" alt="1" >
		<img src="images/home15.jpg" alt="1" >
		<img src="images/home10.jpg" id="fi" alt="1">
		</div>
	</div>
	<script src="carousel.js"></script>

		</section>

		<!------------------Featured Products--------------------------->
<div class="small-container">
  <h2 class="title">Featured Products</h2>
	<div class="row">
		<?php
		 $sql = "SELECT * FROM featured_products";
		 $results = mysqli_query($con, $sql);
				 while ($row = mysqli_fetch_array($results)) {
					 $images=explode(",",$row['image']);
					 ads($row['id'], $row['label'], $row['price'], $images[0]);
				 }
		?>
		<!-------------------Latest Products---------------------------->
	<h2 class="title">Latest Products</h2>
		<div class="row">
			<?php
			$sql = "SELECT * FROM product_details ORDER BY id DESC LIMIT 16";
			$results = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($results)) {
						$images=explode(",",$row['image']);
						ads($row['id'], $row['label'], $row['price'], $images[0]);
					}
			?>
	</div>
</div>
</div>
	<!------------------------------Offer---------------------------------->
<div class="offer">
	
	<div class="small-container">
	  <div class="row">
		<div class="col-2">
		  <img src="images/home7.jpg" class="offer-img"/>
		  </div>
		<div class="col-2">
		  <p>Exclusively Available on Kingdom Homes</p>
			<h1>Flash sale</h1>
			<small>
			This modern day villa features a fully-furnished interior which can be easily adapted for official use, a car park, swimming pool etc.
			</small>
			<br>
			<a href="" class="btn">Buy Now &#8594;</a>
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
	<script type="text/javascript">
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

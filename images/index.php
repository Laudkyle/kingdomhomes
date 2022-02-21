<?php
session_start();

include("connection.php");
include("functions.php");


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
	 echo "<li><a href='admin.php'>Dashboard</a></li>";
		}
			?>
		<li onClick="servicesToggle()" onMouseUp="menuToggle()">Services</li>
		<li><a href="">Contact</a></li>
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
	 
10:15 AM 12/7/2021
	
  </div>
</div>
	<!------------------Featured Categories--------------------------->
<div class="categories">
<div class="small-container">
<div class="row">
    <div class="col-3">
		  <img src="images/home5.jpg"/>
	  </div>
	  <div class="col-3">
		  <img src="images/home6.jpg"/>
	  </div>
	  <div class="col-3">
		  <img src="images/home7.jpg"/>
	  </div>
	</div>
  </div>
</div>
		<!------------------Featured Products--------------------------->
<div class="small-container">
  <h2 class="title">Featured Products</h2>
	<div class="row">
	  <div class="col-4"><img src="images/home3.jpg"/>
		<h4>4 bedroom modern villa</h4>
		  <p>$50K</p>
	  </div>
		  <div class="col-4"><img src="images/home1.jpg"/>
		<h4>3 bedroom self-contained</h4>
		  <p>$129K</p>
	  </div>
		  <div class="col-4"><img src="images/home2.jpg"/>
		<h4>Shai Hills villa</h4>
		  <p>$150K</p>
	  </div>
		  <div class="col-4"><img src="images/home4.jpg"/>
		<h4>Achimota urban homes</h4>
		  <p>$170K.00</p>
	  </div>
		<!-------------------Latest Products---------------------------->
	<h2 class="title">Latest Products</h2>
		<div class="row">
		 <div class="col-4"><img src="images/home9.jpg"/>
		<h4>3 bedroom semi-detached house</h4>
		  <p>$270K</p>
	  </div>
		  <div class="col-4"><img src="images/home10.jpg"/>
		<h4>Executive class</h4>
		  <p>$87K</p>
	  </div>
		  <div class="col-4"><img src="images/home11.jpg"/>
		<h4>Eden view</h4>
		  <p>$49K</p>
	  </div>
		  <div class="col-4"><img src="images/home12.jpg"/>
		<h4>Family homes</h4>
		  <p>$50K</p>
	  </div>
			<div class="col-4"><img src="images/home13.jpg"/>
		<h4>Office suite</h4>
		  <p>$210K</p>
	  </div>
		  <div class="col-4"><img src="images/home14.jpg"/>
		<h4>Suburban</h4>
		  <p>$13K</p>
	  </div>
		  <div class="col-4"><img src="images/home15.jpg"/>
		<h4>Uncompleted</h4>
		  <p>$70K</p>
	  </div>
		  <div class="col-4"><img src="images/home16.jpg"/>
		<h4>Masterclass</h4>
		  <p>$150K</p>
	  </div>
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
			This modern day villa features a fully-furnished interior which can be eaily adadpted for official use, a car park, swimming pool etc.
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
</div>s
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

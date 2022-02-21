<?php
session_start();

include("connection.php");
include("functions.php");
require_once ('ads.php');

 $user_data = check_login($con);

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
		if ($_SESSION['user_level'] == 0){
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
	
	<!---------------------------Single Product detail-------------------------------------->

	<div class="small-container single-products">
	<div class="cover">
	 <div class="row">
	  <div class="col-2">
		
		  <?php
		  	 $product_data = fetch_details($con);
		  $images=explode(",",$product_data['image']);
		  $pic_1= $images[0];
			echo "<img src ='images/".$pic_1."' width='500' height='500' id='ProductImg'>";
			?>
		<div class="small-img-row">
			<?php fetch_pictures($con);?>
		  </div>
        </div>
      
		 
	  <div class="col-2">
		  <?php
		  echo "<h1>".$product_data['label']."</h1><br><br>";
  		  echo "<h2>GH&#8373 ".$product_data['price'].".00</h2><br>";
		  echo "<h3> Location : ".$product_data['location']."</h3><br><br>";

	  ?>
		  <h3>Product details</h3>
		  <p><?php
			  echo "<det-size>".$product_data['details']."</det-size>";
			  ?></p><button name="cont" class="btn">Contact Agent</button>
		  
	  </div>
	</div>
	</div>
	</div>
</div>
<div class="small-container">
	<div class="row row-2">
	<h2>Related Products</h2>
		<a href="Products.php"><p>View more</p></a>
  </div>
<div class="row">
	<?php
	$id = $product_data['id'];
    $sql_1 = "SELECT * FROM product_details LIMIT $id,4";
    $results_1 = mysqli_query($con, $sql_1);
			while ($row = mysqli_fetch_array($results_1)) {
					$small_images=explode(",",$row['image']);
                ads_related($row['id'], $row['label'], $row['price'], $small_images[0]);
            }
	?>
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
		
		/*-------------------js for product gallery-----------------------*/
		var ProductImg = document.getElementById("ProductImg");
		var SmallImg = document.getElementsByClassName("small-img");
		SmallImg[0].onclick = function()
		{
			ProductImg.src = SmallImg[0].src;
		}
		SmallImg[1].onclick = function()
		{
			ProductImg.src = SmallImg[1].src;
		}
		SmallImg[2].onclick = function()
		{
			ProductImg.src = SmallImg[2].src;
		}
		SmallImg[3].onclick = function()
		{
			ProductImg.src = SmallImg[3].src;
		}
	</script>
</body>
</html>

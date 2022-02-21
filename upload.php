
<?php
session_start();

include("connection.php");
include("functions.php");
$user_data = check_login($con);


if (isset($_POST['upload'])){
    $label = $_POST['label'];
	$target = 'images/';
	$file_name = $_FILES['image']['name'];
	$image_name = implode(",",$file_name);
	$price = $_POST['price'];
	$location = $_POST['location'];
	$details = $_POST['details'];
	$contact= $_POST['contact'];
	
	
		// Checking if negotiable is checked
	if (isset($_POST['checkbox'])){
			$negotiable = "Negotiable";

	}else{
			$negotiable = "Not Negotiable";

	}
	if (!empty($file_name)){
	foreach($file_name as $key => $val){
		
		$targetpath = $target .$val;
		
		move_uploaded_file($_FILES['image']['tmp_name'][$key],$targetpath);
	}
	}

	if (!empty($label) && !empty($image_name) && !empty($price) && !empty($location) && !empty($contact) && !empty($details) && is_numeric($contact))
	{
	
		// Save details to database
		
		$query = "insert into featured_products(label,image,price,location,details,negotiable,contact) values ('$label','$image_name','$price','$location','$details','$negotiable','$contact')";
		
		mysqli_query($con, $query);
		
	}elseif(empty($contact) && empty($label) && empty($image_name) && empty($price) && empty($location) && empty($contact) && empty($details)){
		
		echo "Please fill all the empty fields";

	}elseif(!empty($label) && !empty($image_name) && !empty($price) && !empty($location) && !empty($contact) && !empty($details) && !is_numeric($contact)){
	
		echo "Please enter a valid contact";
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
<!--------------------------------Upload-page--------------------------->
<div class="account-page">
	<div class="container">
		<div class="row-upload">
			<div class="form-upload">
				<span> Upload Product</span>
				<form method="post" enctype="multipart/form-data">
					<style>
						.form-upload{
						scrollbar-width:none;
						}
						.form-upload::-webkit-scrollbar{
							display:none;
						}

					</style>
					<input type="hidden" name="size" value="1000000">
					<div class="input-group">
					<input type="text" name="label"  id="label" required>
					<label for="label">Product label</label>
					</div>
					<div class="input-group">
					<input type="text" name="location" id="location" required>
					<label for="location">Location</label>
					</div>
					<div class="note">
					<h3>Please check the box if the price is negotiable</h3>
					</div>
					<div class="up-col-2">
					<div class="up-col left input-group">
					<input type="text" name="price" id="price" required>
						<label for="price">Price</label>
					</div>
					<div class="up-col right input-group">
					<input type="checkbox" name="checkbox" value="Negotiable" id="checkbox">
					</div>
					</div>
					<div class="input-group">
					<input type="text" name="contact" id="contact" required>
					<label for="contact">Contact</label>
					</div>
					<div>
					<div class="pic-display note">
					<h3>Product Image</h3>
					<input type="file" id="image[]" name="image[]" multiple>		
					</div>
					<div  class="input-group">
					<textarea name="details" id="details" rows="6" required></textarea>
					<label for="details">Product Details</label>
					</div>
					<button name="upload" type = "submit" class="btn">Upload Product</button>
					</div>
					</form>
			
			</div>
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


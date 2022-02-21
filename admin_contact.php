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
	<link rel="stylesheet" href="style1.css">
	<script src="https://kit.fontawesome.com/e899500b1e.js" crossorigin="anonymous"></script>
	

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="jquery.min.js"></script>
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
	<!---------------------------Admin-contact------------------------------->
	<div class="account-page">
	 <div class="container">
	  <div class="row-upload">
		  <div class="card-body">
		  <div class="table-responsive">
			 <table class="table table-bordered">
			 <thead>
				<tr>
				<th scope="col"><h6>Id</h6></th>
				<th scope="col"><h6>Name</h6></th>
				<th scope="col"><h6>Phone No</h6></th>
				<th scope="col"><h6>Email</h6></th>
				<th scope="col"><h6>Message</h6></th>
				<th scope="col"><h6>Delete</h6></th>
				</tr>
			</thead>
				<tbody>
					<?php
					

					$sl =0;
						$sql_c = "SELECT * from contact_form ORDER BY Id DESC";
						$results_c = mysqli_query($con, $sql_c);
						while ($row = mysqli_fetch_array($results_c)){
									$sl++
						?>
					<tr>
						<form method="post" enctype="multipart/form-data">
							<input type="hidden" name="cont_id" value="<?php echo $row['id']?>">
					<td ><h6><?php echo $sl;?></h6></td>
					<td><h6><?php echo $row['name'];?></h6></td>
					<td><h6><?php echo $row['phone'];?></h6></td>
					<td><h6><?php echo $row['email'];?></h6></td>
					<td><h6><?php echo $row['message'];?></h6></td>
					<td><button class="invisible-btn" name="cont_delete" type = "submit" onClick="del_data()"><h6><i class="fa fa-trash">Del</i></h6></button></td>
						</form>
					</tr>
				<?php
						}
					if (isset($_POST['cont_delete'])){
					$id =$_POST['cont_id'];

					$sql_d = "DELETE FROM `contact_form` WHERE `contact_form`.`id` = $id";
					mysqli_query($con, $sql_d);
				}
					
					?>
				</tbody>
				</table>
				 
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

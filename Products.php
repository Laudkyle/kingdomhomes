
<?php
session_start();

include("connection.php");
include("functions.php");
require_once ('ads.php');
$link = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$_SESSION['log'] = $link;
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
	 
<div class="small-container">
	<div class="row row-2">
	<h2>All Products</h2>
	<select>
		<option>Default Sorting</option>
		<option>Default By Price</option>
		<option>Default By Popularity</option>
		<option>Default By Sale</option>
		</select>
	</div>
<div class="row">
	<?php
    if (isset($_POST['view'])){
        if (isset($_SESSION['productid'])){
            $_SESSION['productid'] = $_POST['productid'];
            print_r($_SESSION['productid']);
        }
        else{
            $_SESSION['productid'] = $_POST['productid'];
            print_r($_SESSION['productid']);

        }
    }
    $sql = "SELECT * FROM product_details";
    $page_results = mysqli_query($con, $sql);


    $results_per_page = 120;
    $number_of_results = mysqli_num_rows($page_results);

    $number_of_pages = ceil($number_of_results/$results_per_page);
    if (!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }
    $this_page_first_results = ($page-1)* $results_per_page;


    $sql = "SELECT * FROM product_details LIMIT ". $this_page_first_results .',' .$results_per_page;
    $results = mysqli_query($con, $sql);
			while ($row = mysqli_fetch_array($results)) {
				$images=explode(",",$row['image']);
                ads($row['id'], $row['label'], $row['price'], $images[0]);
            }



				?>
</div>
    <div class="page-btn">
	<?php
    for ($page=1;$page<=$number_of_pages;$page++)
        echo '<span><a href = "Products.php?page=' .$page.'" > '.$page. ' </a></span>';
    ?>
    </div>
</div></div>
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


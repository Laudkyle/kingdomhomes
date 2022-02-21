<?php
function check_login($con){
	
	if(isset($_SESSION['user_id'])){
		
		$id = $_SESSION['user_id'];
		$query = "select * from user_list where user_id = '$id' limit 1";
		
		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
            return $user_data;

		}

    }
	// Redirect to login page
	header("Location: account.php");
	die;
}


function fetch_details($con)
{

    if (isset($_SESSION['productid'])) {
        $product = $_POST['productid'];
        $query = "select * from product_details where id = '$product'";

        $result = mysqli_query($con, $query);
        unset($_SESSION['productid']);
        if ($result && mysqli_num_rows($result) > 0) {
            $product_data = mysqli_fetch_assoc($result);
            return $product_data;


        }
    } else {
        $product = $_POST['productid'];
        $query = "select * from product_details where id = '$product'";

        $result = mysqli_query($con, $query);
        unset($_SESSION['productid']);
        if ($result && mysqli_num_rows($result) > 0) {
            $product_data = mysqli_fetch_assoc($result);
            return $product_data;
        }

    }
}

function fetch_pictures($con)
{

    if (isset($_SESSION['productid'])) {
        $product = $_POST['productid'];
        $query = "select * from product_details where id = '$product'";

        $result = mysqli_query($con, $query);
        unset($_SESSION['productid']);
        if ($result && mysqli_num_rows($result) > 0) {
            $product_data = mysqli_fetch_assoc($result);
             $images=explode(",",$product_data['image']);
			for($i=1;$i<count($images);$i++)
			   echo '<div class="small-img-col">
			   <img src="images/'.$images[$i].'" width="100px" height="100px" class="small-img"></div>
			   ';
        }
    } else {
        $product = $_POST['productid'];
        $query = "select * from product_details where id = '$product'";

        $result = mysqli_query($con, $query);
        unset($_SESSION['productid']);
        if ($result && mysqli_num_rows($result) > 0) {
            $product_data = mysqli_fetch_assoc($result);
            $images=explode(",",$product_data['image']);
			for($i=1;$i<count($images);$i++)
			   echo '<div class="small-img-col">
			   <img src="images/'.$images[$i].'" width="100px" height="100px" class="small-img"></div>
			   ';
			
		}

    }
}



function random_num($length){
	
	$text ="";
	if ($length < 5)
	{
		$length = 5;
	}
	$len = rand(4,$length);
	
	for ($i=0; $i < $len; $i++){
		
		$text .= rand(0,9);
	}
	return $text;
}

















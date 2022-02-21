<?php
session_start();

include("connection.php");
include("functions.php");
require_once ('ads.php');

 $user_data = check_login($con);


?>
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
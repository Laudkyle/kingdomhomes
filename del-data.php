<?php
session_start();

include("connection.php");
include("functions.php");
require_once ('ads.php');

 $user_data = check_login($con);

  if (isset($_POST['cont_delete'])){
	$id =$_POST['cont_id'];

	$sql_d = "DELETE FROM `contact_form` WHERE `contact_form`.`id` = $id";
	mysqli_query($con, $sql_d);
	  echo "hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhsahsadjhakdjhkdhsakdjhsakjhdkashkjahdkjashdksjhdsaudhidsudikasdbskahkahksahkdshakdjsakdsahdkhoiijlkdnfkdndnlfndslndlsnldsnlfdsknlksdnlfkdnslfndslfkndlnlsnfldsnflanlnljjbds;a lkdsf;dsf; dsajf;da f;djhaf;kjdhs akljfdsh fkjdh alfhd alhfldjkahfldkjhaf ldhalfkjhalfkjhdalfkjhdlakjhf dslakjhf ldkajhlfkjdhafuhdaifhuiyourwhatou hafhsd vluhaf leawkjfa dsfiubewKGFB DS;AU FJDSAN ;FO LAIB FEAB DOUSAHF ; bagfa; dkfn ;in adlsknf;ladf;dsan;fd";
  }
?>
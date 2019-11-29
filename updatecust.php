<?php
include 'include/db_credentials.php';
session_start();

if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['phonenum']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['postalCode']) && isset($_POST['country']) && isset($_POST['userid']) && isset($_POST['pass'])){
	$firstName = 	$_POST['firstName'];
	$lastName =		$_POST['lastName'];
	$email = 		$_POST['email'];
	$phonenum = 	$_POST['phonenum'];
	$address = 		$_POST['address'];
	$city = 		$_POST['city'];
	$state = 		$_POST['state'];
	$postalCode = 	$_POST['postalCode'];
	$country = 		$_POST['country'];
    $userid = 		$_POST['userid'];
	$pass = 		$_POST['pass'];
    $cid = 			$_POST['custId'];
	
    //Create Connection to database
    $con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    //SQL for Updating Customer info:
    $sql = "UPDATE customer SET firstName = ?, lastName = ?, email = ?, phonenum = ?, address = ?, city = ?, state = ?, postalCode = ?, country = ?, userid = ?, password = ? WHERE customerId = ?";
	// insert params into prepared statemnet
	$params = array(&$firstName, &$lastName, &$email, &$phonenum, &$address, &$city, &$state, &$postalCode, &$country, &$userid, &$pass, &$cid);
	// exectute statement
    $results = sqlsrv_query($con, $sql, $params);
	
	
	echo("<script>console.log(\"userId: " . $userid  . "\"); </script>");
	$_SESSION['authenticatedUser'] = $userid;
	
    
    //close connection
    sqlsrv_close($con);
    
    // put user back at their profile page
	header('Location: customer.php?edited=true');
  
} else {
	header('Location: editcustomer.php');
}

?>

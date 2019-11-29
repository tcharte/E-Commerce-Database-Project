<?php
include 'include/db_credentials.php';

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
	
	//echo("<script>console.log(\"sql: " . strval($cid ) . " " . strval($firstName). "\"); </script>");
	
    //Create Connection to database
    $con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    //SQL for entering Customer info:
	
    $sql = "UPDATE customer SET firstName = ?, lastName = ?, email = ?, phonenum = ?, address = ?, city = ?, state = ?, postalCode = ?, country = ?, userid = ?, password = ? WHERE customerId = ?";
	
	$stmt = sqlsrv_prepare($con, $sql, array(&$firstName, &$lastName, &$email, &$phonenum, &$address, &$city, &$state, &$postalCode, &$country, &$userid, &$pass, &$cid));
			
	echo("<script>console.log(\"sql: " . strval($sql) . "\"); </script>");
	
    $results = sqlsrv_query($con, $sql, array());
	//echo("<script>console.log(\"" . strval($results) . "\"); </script>");
    
    //close connection
    sqlsrv_close($con);
    
    //if($results != false){
        //header('Location: validateLogin.php?username=' . urlencode($username) . '&pass=' . urlencode($pass));
        //echo("<form name=\"myform\" method=\"post\" action=\"validateLogin.php\"><input type=\"hidden\" name=\"username\" value=\"" . $username . "\" /><input type=\"hidden\" name=\"pass\" value=\"" . $pass . "\" /></form><script type=\"text/javascript\">document.myform.submit();</script>");
   // header('Location: customer.php');
   // }
    
} else {
	header('Location: editcustomer.php');
}

?>

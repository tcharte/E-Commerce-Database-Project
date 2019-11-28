<?php
include 'include/db_credentials.php';
// Get info
session_start();
if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['phonenum']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['postalCode']) && isset($_POST['country']) && isset($_POST['userid']) && isset($_POST['pass'])){
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$phonenum = $_POST['phonenum'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$postalCode = $_POST['postalCode'];
	$country = $_POST['country'];
    $userid = $_POST['userid'];
	$pass = $_POST['pass'];
    
    //Create Connection to database
    $con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    //SQL for entering Customer info:
    $sql = "INSERT INTO customer (firstName, lastName, email, phonenum, address, city, state, postalCode, country, userid, password) VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $phonenum . "', '" . $address ."', '" . $city . "', '" . $state . "', '" . $postalCode . "', '" . $country . "', '" . $userid . "' , '" . $pass . "')";

    $results = sqlsrv_query($con, $sql, array());
    
    //close connection
    sqlsrv_close($con);
    
    if($results != false){
        //header('Location: validateLogin.php?username=' . urlencode($username) . '&pass=' . urlencode($pass));
        //echo("<form name=\"myform\" method=\"post\" action=\"validateLogin.php\"><input type=\"hidden\" name=\"username\" value=\"" . $username . "\" /><input type=\"hidden\" name=\"pass\" value=\"" . $pass . "\" /></form><script type=\"text/javascript\">document.myform.submit();</script>");
        header('Location: login.php');
    }
    
} else {
	header('Location: signup.php');
}
?>

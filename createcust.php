<?php
include 'include/db_credentials.php';
// Get info
session_start();
if(isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['email']) && isset($_GET['phonenum']) && isset($_GET['address']) && isset($_GET['city']) && isset($_GET['state']) && isset($_GET['postalCode']) && isset($_GET['country']) && isset($_GET['userid']) && isset($_GET['password'])){
	$firstName = $_GET['firstName'];
	$lastName = $_GET['lastName'];
	$email = $_GET['email'];
	$phonenum = $_GET['phonenum'];
	$address = $_GET['address'];
	$city = $_GET['city'];
	$state = $_GET['state'];
	$postalCode = $_GET['postalCode'];
	$country = $_GET['country'];
    $userid = $_GET['userid'];
	$country = $_GET['password'];
    
    //Create Connection to database
    $con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    //SQL for entering Customer info:
    $sql = "INSERT INTO customer (firstName, lastName, email, phonenum, address, city, state, postalCode, country, userid, password) VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $phonenum . "', '" . $address ."', '" . $city . "', '" . $state . "', '" . $postalCode . "', '" . $country . "', '" . $userid . "' , '" . $password . "')";

    $results = sqlsrv_query($con, $sql, array());
    
    //close connection
    sqlsrv_close($con);
    
    if($results != false){
        header('Location: validateLogin.php?username=' . urlencode($username) . '&password=' . urlencode($password));
    }
    
} else {
	header('Location: signup.php');
}
?>
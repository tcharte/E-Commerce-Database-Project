<!DOCTYPE html>
<html>
<head>
<title>Customer Page</title>
</head>
<body>
    <style>
        table, td, th {
            border: 1px solid grey;
        }
        th, td {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 20px;
        padding-right: 20px;
        text-align: left;
        }
        th {
        text-align: left;
        background-color: steelblue;
        color: white;
        }
    </style>

<?php 
    include 'header.php';
    include 'include/db_credentials.php';
?>

<?php
	$authenticated = $_SESSION['authenticatedUser']  == null ? false : true;

	if (!$authenticated)
	{
		$loginMessage = "You must log in to view this page.";
        $_SESSION['loginMessage']  = $loginMessage;
        $_SESSION['redirect']  = "customer.php";
		header('Location: login.php');
	}
    
$user = $_SESSION['authenticatedUser'];

$con = sqlsrv_connect($server, $connectionInfo);
if( $con === false ) {
    die( print_r( sqlsrv_errors(), true));
}
    
// TODO: Print Customer information
    $sql = "SELECT customerId, firstName, lastName, email, phonenum, address, city, state, postalCode, country FROM customer WHERE userid = '" . $user . "'";
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $first = $row['firstName'];
        $last = $row['lastName'];
        $cid = $row['customerId'];
        $email = $row['email'];
        $phonenum = $row['phonenum'];
        $address = $row['address'];
        $city = $row['city'];
        $state = $row['state'];
        $pcode = $row['postalCode'];
        $country = $row['country'];
    }

// Make sure to close connection
    sqlsrv_close($con);
    
    
    echo("</br><center><h1>Customer Profile</h1></center></br><table align=\"center\"><tr><th>Name</th><td>" . $first . " " . $last . "</td></tr><tr><th>Customer ID</th><td>" . $cid . "</td></tr><tr><th>Username</th><td>" . $user . "</td></tr></tr><tr><th>Email</th><td>" . $email . "</td></tr><tr><th>Phone Number</th><td>" . $phonenum . "</td></tr><tr><th>Address</th><td>" . $address . "</td></tr><tr><th>City</th><td>" . $city . "</td></tr><tr><th>State</th><td>" . $state . "</td></tr><tr><th>Postal Code</th><td>" . $pcode . "</td></tr><tr><th>Country</th><td>" . $country . "</td></tr></table>");
?>
</body>
</html>
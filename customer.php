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
$custId = $_SESSION['customerId'];

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
	$customerArr = array($first, $last, $cid, $email, $phonenum, $address, $city, $state, $pcode, $country);
// Make sure to close connection
    sqlsrv_close($con);
    
    
    echo("</br>
		<center>
			<h1>Customer Profile</h1>
		</center>
		</br>
		<table align=\"center\">
			<tr><th>Name</th><td contenteditable>" . $first . " " . $last . "</td></tr>
			<tr><th>Customer ID</th><td>" . $cid . "</td></tr>
			<tr><th>Username</th><td contenteditable>" . $user . "</td></tr></tr>
			<tr><th>Email</th><td contenteditable>" . $email . "</td></tr>
			<tr><th>Phone Number</th><td contenteditable>" . $phonenum . "</td></tr>
			<tr><th>Address</th><td contenteditable>" . $address . "</td></tr>
			<tr><th>City</th><td contenteditable>" . $city . "</td></tr>
			<tr><th>State</th><td contenteditable>" . $state . "</td></tr>
			<tr><th>Postal Code</th><td contenteditable>" . $pcode . "</td></tr>
			<tr><th>Country</th><td contenteditable>" . $country . "</td></tr>
		</table>");
	
	
	/*
	echo("
	<form action=\"updatecust.php\" method=\"post\">
		<table align=\"center\">
			<tr><th>First Name:</th><td><input type=\"text\" name=\"firstName\" maxlength=\"40\" required value=\"" .$firstName . "\"></td></tr>
			<tr><th>Last Name:</th><td><input type=\"text\" name=\"lastName\" maxlength=\"40\" required value=\"" . $lastName."></td></tr>
			<tr><th>Email:</th><td><input type=\"email\" name=\"email\" maxlength=\"50\" required value=\"". $email ."></td></tr>
			<tr><th>Phone Number:</th><td><input type=\"text\" name=\"phonenum\" maxlength=\"20\" required ></td></tr>
			<tr><th>Address:</th><td><input type=\"text\" name=\"address\" maxlength=\"50\" required></td></tr>
			<tr><th>City:</th><td><input type=\"text\" name=\"city\" maxlength=\"40\" required></td></tr>
			<tr><th>State:</th><td><select name=\"state\" required>
		<option value=\"AL\">Alabama</option>
		<option value=\"AK\">Alaska</option>
		<option value=\"AZ\">Arizona</option>
		<option value=\"AR\">Arkansas</option>
		<option value=\"CA\">California</option>
		<option value=\"CO\">Colorado</option>
		<option value=\"CT\">Connecticut</option>
		<option value=\"DE\">Delaware</option>
		<option value=\"DC\">District Of Columbia</option>
		<option value=\"FL\">Florida</option>
		<option value=\"GA\">Georgia</option>
		<option value=\"HI\">Hawaii</option>
		<option value=\"ID\">Idaho</option>
		<option value=\"IL\">Illinois</option>
		<option value=\"IN\">Indiana</option>
		<option value=\"IA\">Iowa</option>
		<option value=\"KS\">Kansas</option>
		<option value=\"KY\">Kentucky</option>
		<option value=\"LA\">Louisiana</option>
		<option value=\"ME\">Maine</option>
		<option value=\"MD\">Maryland</option>
		<option value=\"MA\">Massachusetts</option>
		<option value=\"MI\">Michigan</option>
		<option value=\"MN\">Minnesota</option>
		<option value=\"MS\">Mississippi</option>
		<option value=\"MO\">Missouri</option>
		<option value=\"MT\">Montana</option>
		<option value=\"NE\">Nebraska</option>
		<option value=\"NV\">Nevada</option>
		<option value=\"NH\">New Hampshire</option>
		<option value=\"NJ\">New Jersey</option>
		<option value=\"NM\">New Mexico</option>
		<option value=\"NY\">New York</option>
		<option value=\"NC\">North Carolina</option>
		<option value=\"ND\">North Dakota</option>
		<option value=\"OH\">Ohio</option>
		<option value=\"OK\">Oklahoma</option>
		<option value=\"OR\">Oregon</option>
		<option value=\"PA\">Pennsylvania</option>
		<option value=\"RI\">Rhode Island</option>
		<option value=\"SC\">South Carolina</option>
		<option value=\"SD\">South Dakota</option>
		<option value=\"TN\">Tennessee</option>
		<option value=\"TX\">Texas</option>
		<option value=\"UT\">Utah</option>
		<option value=\"VT\">Vermont</option>
		<option value=\"VA\">Virginia</option>
		<option value=\"WA\">Washington</option>
		<option value=\"WV\">West Virginia</option>
		<option value=\"WI\">Wisconsin</option>
		<option value=\"WY\">Wyoming</option>
				</select></td></tr>
			<tr><th>Postal Code:</th><td><input type=\"text\" name=\"postalCode\" maxlength=\"8\" required></td></tr>
			<tr><th>Country:</th><td><input type=\"text\" name=\"country\" maxlength=\"40\" required></td></tr>
			<tr><th>Username:</th><td><input type=\"text\" name=\"userid\" maxlength=\"20\" required></td></tr>
			<tr><th>Password:</th><td><input type=\"password\" name=\"pass\" maxlength=\"30\" required></td></tr>
		</table>
		<center><input type=\"submit\"></center>
	</form>");
	*/
	
	echo("<center>
				<a href=\"editcustomer.php\"> Edit Details </a> 	
		 </center>");
		 
/*		
	 echo("<a href=\"login.php\" style=\"float: right;\">Log In</a>");
	
	echo("<center>
			<input type=\"button\" value=\"Edit Profile\" onclick=\"editcustomer.php\">
		</center>"); */
	
	/*
	<center>
		<input type="button" value="Edit Profile" onclick="editcustomer.php">
	</center>
	
	
	*/
?>
	
</body>
</html>









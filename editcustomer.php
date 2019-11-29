<!DOCTYPE html>
<html>
    <head>
        <title>Customer Info Update</title>
    </head>
<body>
    <?php
    include 'header.php';
    ?>
<br>
<h1 style=\"text-align:center\">Edit Info</h1>
<?php
include 'include/db_credentials.php';

/*
if(isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['email']) && isset($_GET['phonenum']) && isset($_GET['address']) && isset($_GET['city']) && isset($_GET['state']) && isset($_GET['postalCode']) && isset($_GET['country']) && isset($_GET['userid']) && isset($_GET['pass'])){
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
	$pass = $_GET['pass'];	
}
*/
$user = $_SESSION['authenticatedUser'];

$con = sqlsrv_connect($server, $connectionInfo);
if( $con === false ) {
    die( print_r( sqlsrv_errors(), true));
}
    

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




echo("
	<form action=\"updatecust.php\" method=\"post\">
		<table align=\"center\">
			<tr><th>First Name:</th><td><input type=\"text\" name=\"firstName\" maxlength=\"40\" required value=\"" . $first . "\"></td></tr>
			<tr><th>Last Name:</th><td><input type=\"text\" name=\"lastName\" maxlength=\"40\" required value = \"" . $last . "\"></td></tr>
			<tr><th>Email:</th><td><input type=\"email\" name=\"email\" maxlength=\"50\" required value=\"" .$email. "\"></td></tr>
			<tr><th>Phone Number:</th><td><input type=\"text\" name=\"phonenum\" maxlength=\"20\" required value=\"" .$phonenum. "\"></td></tr>
			<tr><th>Address:</th><td><input type=\"text\" name=\"address\" maxlength=\"50\" required value=\"" .$address. "\"></td></tr>
			<tr><th>City:</th><td><input type=\"text\" name=\"city\" maxlength=\"40\" required value=\"" .$city. "\"></td></tr>
			<tr><th>State:</th><td><select name=\"state\" required value=\"" .$state. "\">
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
			<tr><th>Postal Code:</th><td><input type=\"text\" name=\"postalCode\" maxlength=\"8\" required value=\"" .$pcode. "\"></td></tr>
			<tr><th>Country:</th><td><input type=\"text\" name=\"country\" maxlength=\"40\" required value=\"" .$country. "\"></td></tr>
			<tr><th>Username:</th><td><input type=\"text\" name=\"userid\" maxlength=\"20\" required></td></tr>
			<tr><th>Password:</th><td><input type=\"password\" name=\"pass\" maxlength=\"30\" required></td></tr>
		</table>
		<center><input type=\"submit\"></center>
	</form>");
?>

    
</body>
</html>
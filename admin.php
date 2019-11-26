<!DOCTYPE html>
<html>
<head>
<title>Administrator Page</title>
</head>
    
    <style>
        table, td, th {
            border: 1px solid grey;
        }
        th, td {
        padding: 15px;
        text-align: left;
        }
        th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: steelblue;
        color: white;
        }
    </style>
    
<body>

<?php 
// TODO: Include files auth.php and include/db_credentials.php
    include 'header.php';
    include 'auth.php';
    include 'include/db_credentials.php';
?>
<?php
        
    $date = date('Y-m-d');
// TODO: Write SQL query that prints out total order amount by day


	$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}

    $sql = "SELECT firstName, lastName FROM customer WHERE userid = '" . $user . "'";
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $first = $row['firstName'];
        $last = $row['lastName'];
    }
    echo("<h2><center>Welcome " . $first . " " . $last . ".</center></h2>");
    echo("</br><center><u><h1>Administrator Sales Report by Day</u></center></h1>");
    
	$sql = "SELECT CAST(orderDate AS DATE) AS date, SUM(totalAmount) AS amount FROM ordersummary GROUP BY CAST(orderDate AS DATE)";
	$results = sqlsrv_query($con, $sql, array());
	echo("<table align=\"center\"><tr><th>Order Date</th><th>Total Order Amount</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
		echo("<tr><td>" . $row['date']->format('d/m/Y') . "</td><td>$" . number_format($row['amount'],2) . "</td></tr>");
    }
    echo("</table>");
    
    
    
    // List All Customers
    echo("<br><br><center><u><h1>All Customer Info</u></center></h1>");
    echo("<center><table><tr><th>First Name</th><th>Last Name</th><th>Customer ID</th><th>Email</th><th>Phone Number</th><th>Address</th><th>City</th><th>State</th><th>Postal Code</th><th>Country</th></tr>");
    $sql = "SELECT customerId, firstName, lastName, email, phonenum, address, city, state, postalCode, country FROM customer";
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
        echo("<tr><td>" . $first . "</td><td>" . $last . "</td><td>" . $cid . "</td><td>" . $email . "</td><td>" . $phonenum . "</td><td>" . $address . "</td><td>" . $city . "</td><td>" . $state . "</td><td>" . $pcode . "</td><td>" . $country . "</td></tr>");
    }
    echo("</table></center>");
    sqlsrv_close($con);

?>
    
</body>
</html>
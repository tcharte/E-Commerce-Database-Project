<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Harvest Grocery All Orders</title>
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
</head>
<body>
<?php
include 'include/db_credentials.php';
include 'header.php';
    echo("<h1 align = \"center\">Order List</h1>");

/** Create connection, and validate that it connected successfully **/
//<?php

	$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}

	$sql = "SELECT ordersummary.orderId, ordersummary.orderDate, customer.customerId, customer.firstName, customer.lastName, ordersummary.totalAmount FROM ordersummary, customer WHERE ordersummary.customerId = customer.customerID";
	$results = sqlsrv_query($con, $sql, array());
	echo("<table align=\"center\"><tr><th>Order ID</th><th>Order Date</th><th>Customer ID</th><th>Customer Name</th><th>Total Amount</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
		echo("<tr><td>" . $row['orderId'] . "</td><td>" . $row['orderDate']->format('d/m/Y') . "</td><td>" . $row['customerId'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . "$" . number_format($row['totalAmount'], 2) . "</td></tr>");
        $sql2 = "SELECT productId, quantity, price FROM orderproduct WHERE orderId = " . $row['orderId'];
        $results2 = sqlsrv_query($con, $sql2, array());
        echo("<tr><td colspan=\"5\" align =\"right\"><table align=\"right\"><tr><th>Product ID</th><th>Quantity</th><th>Price</th></tr>");
        while ($row2 = sqlsrv_fetch_array( $results2, SQLSRV_FETCH_ASSOC)) {
            echo("<tr><td>" . $row2['productId'] . "</td><td>" . $row2['quantity'] . "</td><td>" . "$" . number_format($row2['price'], 2) . "</td></tr>");
        }
        echo("</table></td></tr>");
	}
	echo("</table>");
    
    sqlsrv_close($con);
/**?>
/**
Useful code for formatting currency:
	number_format(yourCurrencyVariableHere,2)
**/
 
/** Write query to retrieve all order headers **/

/** For each order in the results
		Print out the order header information
		Write a query to retrieve the products in the order
			- Use sqlsrv_prepare($connection, $sql, array( &$variable ) 
				and sqlsrv_execute($preparedStatement) 
				so you can reuse the query multiple times (just change the value of $variable)
		For each product in the order
			Write out product information 
**/


/** Close connection **/
?>

</body>
</html>


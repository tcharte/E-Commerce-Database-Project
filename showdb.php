<!DOCTYPE html>
<html>
<head>
    <title>Harvest Grocery Main Page</title>
</head>
    
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
    
<body>
    <?php
    include 'header.php';
    include 'include/db_credentials.php';
    echo("<h1 style='text-align:center'>Full Database:</h1>");
    //Create connection
    $con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
    
    $sql = "SELECT * FROM customer";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Customer</h2><table><tr><th>customerId</th><th>firstName</th><th>lastName</th><th>email</th><th>phonenum</th><th>address</th><th>city</th><th>state</th><th>postalCode</th><th>country</th><th>userid</th><th>password</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['customerId'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phonenum'] . "</td><td>" . $row['address'] . "</td><td>" . $row['city'] . "</td><td>" . $row['state'] . "</td><td>" . $row['postalCode'] . "</td><td>" . $row['country'] . "</td><td>" . $row['userid'] . "</td><td>" . $row['password'] . "</td></tr>");
	}
	echo("</table>");
     
        
    $sql = "SELECT * FROM paymentmethod";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Payment Method</h2><table><tr><th>paymentMethodId</th><th>paymentType</th><th>paymentNumber</th><th>paymentExpiryDate</th><th>customerId</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['paymentMethodId'] . "</td><td>" . $row['paymentType'] . "</td><td>" . $row['paymentNumber'] . "</td><td>" . $row['paymentExpiryDate']->format('d/m/Y') . "</td><td>" . $row['customerId'] . "</td></tr>");
	}
	echo("</table>");
    
    
    $sql = "SELECT * FROM ordersummary";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Order Summary</h2><table><tr><th>orderId</th><th>orderDate</th><th>totalAmount</th><th>shiptoAddress</th><th>shiptoCity</th><th>shiptoState</th><th>shiptoPostalCode</th><th>shiptoCountry</th><th>customerId</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['orderId'] . "</td><td>" . $row['orderDate']->format('d/m/Y') . "</td><td>" . $row['totalAmount'] . "</td><td>" . $row['shiptoAddress'] . "</td><td>" . $row['shiptoCity'] . "</td><td>" . $row['shiptoState'] . "</td><td>" . $row['shiptoPostalCode'] . "</td><td>" . $row['shiptoCountry'] . "</td><td>" . $row['customerId'] . "</td></tr>");
	}
	echo("</table>");
    
    
    $sql = "SELECT * FROM category";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Category</h2><table><tr><th>categoryId</th><th>categoryName</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['categoryId'] . "</td><td>" . $row['categoryName'] . "</td></tr>");
	}
	echo("</table>");
    
    
    $sql = "SELECT * FROM product";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Product</h2><table><tr><th>productId</th><th>productName</th><th>productPrice</th><th>productImageURL</th><th>productImage</th><th>productDesc</th><th>categoryId</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['productId'] . "</td><td>" . $row['productName'] . "</td><td>" . $row['productPrice'] . "</td><td>" . $row['productImageURL'] . "</td><td>" . isset($row['productImage']) . "</td><td>" . $row['productDesc'] . "</td><td>" . $row['categoryId'] . "</td></tr>");
	}
	echo("</table>");
    
    
    $sql = "SELECT * FROM orderproduct";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Order Product</h2><table><tr><th>orderId</th><th>productId</th><th>quantity</th><th>price</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['orderId'] . "</td><td>" . $row['productId'] . "</td><td>" . $row['quantity'] . "</td><td>" . $row['price'] . "</td></tr>");
	}
	echo("</table>");
    
    
    $sql = "SELECT * FROM incart";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>In Cart</h2><table><tr><th>orderId</th><th>productId</th><th>quantity</th><th>price</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['orderId'] . "</td><td>" . $row['productId'] . "</td><td>" . $row['quantity'] . "</td><td>" . $row['price'] . "</td></tr>");
	}
	echo("</table>");
    

    $sql = "SELECT * FROM warehouse";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Warehouse</h2><table><tr><th>warehouseId</th><th>warehouseName</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['warehouseId'] . "</td><td>" . $row['warehouseName'] . "</td></tr>");
	}
	echo("</table>");
    

    $sql = "SELECT * FROM shipment";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Shipment</h2><table><tr><th>shipmentId</th><th>shipmentDate</th><th>shipmentDesc</th><th>warehouseId</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['shipmentId'] . "</td><td>" . $row['shipmentDate']->format('d/m/Y') . "</td><td>" . $row['shipmentDesc'] . "</td><td>" . $row['warehouseId'] . "</td></tr>");
	}
	echo("</table>");


    $sql = "SELECT * FROM productinventory";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Product Inventory</h2><table><tr><th>productId</th><th>warehouseId</th><th>quantity</th><th>price</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['productId'] . "</td><td>" . $row['warehouseId'] . "</td><td>" . $row['quantity'] . "</td><td>" . $row['price'] . "</td></tr>");
	}
	echo("</table>");


    $sql = "SELECT * FROM review";
	$results = sqlsrv_query($con, $sql, array());
	echo("<h2>Review</h2><table><tr><th>reviewId</th><th>reviewRating</th><th>reviewDate</th><th>customerId</th><th>productId</th><th>reviewComment</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        echo("<tr><td>" . $row['reviewId'] . "</td><td>" . $row['reviewRating'] . "</td><td>" . $row['reviewDate']->format('d/m/Y') . "</td><td>" . $row['customerId'] . "</td><td>" . $row['productId'] . "</td><td>" . $row['reviewComment'] . "</td></tr>");
	}
	echo("</table>");
    
    
    sqlsrv_close($con);
    
    ?>
</body>
</html>



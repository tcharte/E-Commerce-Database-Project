<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Harvest Grocery Order Processing</title>
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

<?php
include 'include/db_credentials.php';
include 'header.php';
    
/** Get customer id **/
    
    $custId = null;
    if(isset($_SESSION['authenticatedUser'])){
        $user = $_SESSION['authenticatedUser'];
        
        $con = sqlsrv_connect($server, $connectionInfo);
        if( $con === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        $sql = "SELECT customerId FROM customer WHERE userid = '" . $user . "'";
        $results = sqlsrv_query($con, $sql, array());
        while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
            $custId = $row['customerId'];
        }
    }
    
    
    
    $productList = null;
    if (isset($_SESSION['productList'])){
        $productList = $_SESSION['productList'];
    }
    //Establish Connection
    $con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
    
    //Get list of valid Customer ID's
    $sql = "SELECT customerId FROM customer";
    $results = sqlsrv_query($con, $sql, array());
    //Check if entered ID is in list
    $valId = false;
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
		if((string)$custId === (string)$row['customerId']){
            $valId = true;
        }
	}
    if($valId){
        //check if shopping cart has items
        if($productList === null){
            echo("<h2 align=\"center\">Your shopping cart is empty!</h2>");
        }else{
            // Get order total:
            $total = 0;
            foreach($productList as $product){
            $total = $total + $product["price"] * $product["quantity"];
        }
        // Get time stamp
        $date = date('Y-m-d H:i:s');
    
        // Insert Order
        $sql = "INSERT INTO ordersummary (customerId, orderDate, totalAmount) OUTPUT INSERTED.orderId VALUES(" . (string)$custId . ", '" . (string)$date . "', " . (string)$total . ")";
	   $pstmt = sqlsrv_query($con, $sql, array());
	   if(!sqlsrv_fetch($pstmt)){
           //Use sqlsrv_errors();
	   }
	   $orderId = sqlsrv_get_field($pstmt,0);
    
        echo("<h1 align =\"center\">Your Order Summary:</h1>");
        echo("<table align =\"center\"><tr><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>");
        // Use $orderId to update orderproduct
        foreach($productList as $product){
            //$total = $total + $product["price"] * $product["quantity"];
            $sql = "INSERT INTO orderproduct (orderId, productId, quantity, price) VALUES (" . $orderId . ", " . $product["id"] . ", " . $product["quantity"] . ", " . number_format($product["price"], 2) . ")";
            sqlsrv_query($con, $sql, array());
            //echo($orderId . ", " . $product["id"] . ", " . $product["quantity"] . ", " . $product["price"]);
            echo("<tr><td>" . $product['id'] . "</td><td>" . $product['name'] . "</td><td>" . $product['quantity'] . "</td><td>" . "$" . number_format($product['price'], 2) . "</td><td>" . "$" . number_format($product['price'] * $product['quantity'], 2) . "</td></tr>");
        }
        $sql = "SELECT firstName, lastName FROM customer WHERE customerId = '" . $custId . "'";
        $results = sqlsrv_query($con, $sql, array());
        while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
            echo("<tr><td colspan=\"4\" align =\"right\"><b>Order Total:</b></td><td>$" . number_format($total, 2) . "</td></table><br/><h1 align =\"center\">Your Order has been completed and will be shipped soon.<br/>Your reference number is: " . $orderId . ".<br/>Shipping to customer: " . $custId . "<br/>Name: " . $row['firstName'] . " " . $row['lastName'] . "</h1>");
        }
        //Clear Cart
        $_SESSION['productList'] = null;
        }
    }else{
        echo("<h2>Invalid Customer ID. Please try again.</h2>");
    }
    
    //Close Connection
    sqlsrv_close($con);
    

/**
Determine if valid customer id was entered
Determine if there are products in the shopping cart
If either are not true, display an error message
**/

/** Make connection and validate **/

/** Save order information to database**/


	/**
	// Use retrieval of auto-generated keys.
	$sql = "INSERT INTO <TABLE> OUTPUT INSERTED.orderId VALUES( ... )";
	$pstmt = sqlsrv_query( ... );
	if(!sqlsrv_fetch($pstmt)){
		//Use sqlsrv_errors();
	}
	$orderId = sqlsrv_get_field($pstmt,0);
	**/

/** Insert each item into OrderedProduct table using OrderId from previous INSERT **/

/** Update total amount for order record **/

/** For each entry in the productList is an array with key values: id, name, quantity, price **/

/**
	foreach ($productList as $id => $prod) {
		\\$prod['id'], $prod['name'], $prod['quantity'], $prod['price']
		...
	}
**/

/** Print out order summary **/

/** Clear session/cart **/
?>
</body>
</html>


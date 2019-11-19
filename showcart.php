<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Your Shopping Cart</title>
</head>
<body>
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
include 'header.php';
// Get the current list of products
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
	echo("<h1 align=\"center\">Your Shopping Cart</h1>");
	echo("<table align=\"center\"><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th>");
	echo("<th>Price</th><th>Subtotal</th></tr>");

	$total =0;
	foreach ($productList as $id => $prod) {
		echo("<tr><td>". $prod['id'] . "</td>");
		echo("<td>" . $prod['name'] . "</td>");

		echo("<td align=\"center\">". $prod['quantity'] . "</td>");
		$price = $prod['price'];

		echo("<td align=\"right\">$" . number_format($price ,2) ."</td>");
		echo("<td align=\"right\">$" . number_format($prod['quantity']*$price, 2) . "</td></tr>");
		echo("</tr>");
		$total = $total +$prod['quantity']*$price;
	}
	echo("<tr><td colspan=\"4\" align=\"right\"><b>Order Total</b></td><td align=\"right\">$" . number_format($total,2) ."</td></tr>");
	echo("</table>");

	echo("<h2 align=\"center\"><a href=\"checkout.php\">Check Out</a></h2>");
} else{
	echo("<H1 align=\"center\">Your shopping cart is empty!</H1>");
}
?>
<h2 align="center"><a href="listprod.php">Continue Shopping</a></h2>
</body>
</html> 


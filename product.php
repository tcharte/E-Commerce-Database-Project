<!DOCTYPE html>
<html>
<head>
<title>Harvest Grocery - Product Information</title>
</head>
<body>
    <style>
        img{
        max-height:200px;
        height:auto;
        width:auto;
        }
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
    include 'include/db_credentials.php';
?>

<?php
// Get product name to search for
// TODO: Retrieve and display info for the product
// Get product information
if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price'])){
	$id = $_GET['id'];
	$name = $_GET['name'];
	$price = $_GET['price'];
} else {
	header('Location: listprod.php');
}

$con = sqlsrv_connect($server, $connectionInfo);
if( $con === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT productId, productName, productPrice, productImageURL, productImage, productDesc FROM product WHERE productId = '" . $id . "'";
    
$results = sqlsrv_query($con, $sql, array());
while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
    $pid = $row['productId'];
    $pname = $row['productName'];
    $pprice = $row['productPrice'];
    $imgurl = $row['productImageURL'];
    $image = $row['productImage'];
    $desc = $row['productDesc'];
}
echo("</br><center>");
if($imgurl != NULL){
    echo("<img src=\"" . $imgurl . "\">");
}
// Removed as no products use images stored in db..
//    if($image != NULL){
//    echo("<img src=\"displayImage.php?id=" . $id . "\"/>");
//}
echo("</center>");
echo("</br><table align=\"center\"><tr><th>Product Name</th><td>" . $name . "</td></tr><tr><th>Product Id</th><td>" . $id . "</td></tr><tr><th>Price</th><td>" . $pprice . "</td></tr><tr><th>Product Description</th><td>" . $desc . "</td></tr></table>");
echo("</br><h2 align=\"center\"><a href = \"addcart.php?id=" . urlencode($id) . "&name=" . urlencode($name) . "&price=" . urlencode($price) . "\">Add to Cart</a></h2><h2 align=\"center\"><a href=\"listprod.php\">Continue Shopping</a></h2>");

    sqlsrv_close($con);
// TODO: If there is a productImageURL, display using IMG tag

// TODO: Retrieve any image stored directly in database. Note: Call displayImage.php with product id as parameter.

// TODO: Add links to Add to Cart and Continue Shopping
?>
</body>
</html>
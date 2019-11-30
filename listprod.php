<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Harvest Grocery Products</title>
    
    <?php
    include 'header.php';
    ?>
    
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, td, th {
            border-bottom: 1px solid grey;
        }
        th, td {
        padding: 15px;
        text-align: left;
        }
        th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: steelblue;
        color: white;
        }
    </style>
</head>
<body>
<?php 
    //show recommended products:
    include 'recommended.php';
    echo('<br/><table><tr><th colspan="999">Recommended Products:</th></tr><tr>');
    foreach ($recprod as $key => $value) {
        echo("<td><a href = \"product.php?id=" . urlencode($key) . "&name=" . urlencode($value[0]) . "&price=" . urlencode($value[1]) . "\">" . $value[0] . "</a><td>");
    }
    echo('</tr></table>');

?>
    
<center>
<h1>Search for the products you want to buy:</h1>

<form method="get" action="listprod.php">
    Category:
    <select size="1" name="Category">
        <option>All</option>
        <option>Beverages</option>
        <option>Condiments</option>
        <option>Confections</option>
        <option>Dairy Products</option>
        <option>Grains/Cereals</option>
        <option>Meat/Poultry</option>
        <option>Produce</option>
        <option>Seafood</option>
    </select>
    <input type="text" name="productName" size="50">
    <input type="submit" value="Submit"><input type="reset" value="Reset"> (Leave blank for all products)
</form>
</center>
    
<?php
	include 'include/db_credentials.php';
    $name = ""; #Set Search Term to empty string ---> List everything

	/** Get product name to search for **/
	if (isset($_GET['productName'])){
		$name = $_GET['productName'];
	}
    if (isset($_GET['Category'])){
		$category = $_GET['Category'];
	}else{
        $category = "All";
    }

	/** $name now contains the search string the user entered
	 Use it to build a query and print out the results. **/
    
    
	/** Create and validate connection **/
	$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
    
    
    if($name === "") {
        echo("<h2 align =\"center\">All Products:</h2>");
    }else{
        echo("<h2 align=\"center\">Products Containing: '" . $name . "'</h2>");
    }
    
	/** Print out the ResultSet **/
    
    $sql = "SELECT productId, categoryName, productName, productPrice FROM product JOIN category ON category.categoryId = product.categoryId WHERE productName like '%" . $name . "%'";
    if($category != "All"){
        $sql = $sql . "AND categoryName = '" . $category . "'";
    }
	$results = sqlsrv_query($con, $sql, array());
	echo("<table><tr><th></th><th>Category</th><th>Product Name</th><th>Price</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $pid = $row['productId'];
        $pname = $row['productName'];
        $pprice = $row['productPrice'];
        $cat = $row['categoryName'];
		echo("<tr><td><a href = \"addcart.php?id=" . urlencode($pid) . "&name=" . urlencode($pname) . "&price=" . urlencode($pprice) . "\">Add to Cart</a></td><td>" . $cat . "</td><td><a href = \"product.php?id=" . urlencode($pid) . "&name=" . urlencode($pname) . "&price=" . urlencode($pprice) . "\">" . $pname . "</a></td><td>$" . number_format($pprice,2) . "</td></tr>");
	}
	echo("</table>");
    
    sqlsrv_close($con);
    
	/** 
	For each product create a link of the form
	addcart.php?id=<productId>&name=<productName>&price=<productPrice>
	Note: As some product names contain special characters, you may need to encode URL parameter for product name like this: urlencode($productName)
	**/
	
	/** Close connection **/

	/**
        Useful code for formatting currency:
	       number_format(yourCurrencyVariableHere,2)
     **/
?>

</body>
</html>
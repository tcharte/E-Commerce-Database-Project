<!DOCTYPE html>
<html>
<head>
    <title>Harvest Grocery Main Page</title>
</head>
<body>
    <style>
        table {
            text-align: center;
            border-collapse: collapse;
            width: 100%;
        }
        table, td, th {
            border-bottom: 1px solid grey;
        }
        th, td {
        padding: 15px;
        }
        th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: steelblue;
        color: white;
        }
    </style>
<?php
    include 'header.php';
    include 'include/db_credentials.php';
    echo("<h1 align=\"center\">Welcome to Harvest Grocery</h1>");
    if (isset($_SESSION['LIMessage'])){
        echo ("<p><center>" . $_SESSION['LIMessage'] . "</center></p>");
        unset($_SESSION['LIMessage']);
    }
    $con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    
    if (isset($_SESSION['authenticatedUser'])){
        $user = $_SESSION['authenticatedUser'];
        
        $sql = "SELECT firstName, lastName FROM customer WHERE userid = '" . $user . "'";
        $results = sqlsrv_query($con, $sql, array());
        while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
            $first = $row['firstName'];
            $last = $row['lastName'];
        }
        echo("<h2><center>" . $first . " " . $last . "</center></h2>");
    }
?>
    
<h2 align="center"><a href="login.php">Login</a></h2>

<h2 align="center"><a href="listprod.php">Begin Shopping</a></h2>

<h2 align="center"><a href="listorder.php">List All Orders</a></h2>

<h2 align="center"><a href="customer.php">Customer Info</a></h2>

<h2 align="center"><a href="admin.php">Administrators</a></h2>

<h2 align="center"><a href="logout.php">Log out</a></h2>

<?php
    
    // Show dynamic products based on sales
    // Select top 3 products to display
    
    $sql = "SELECT TOP 3 product.productId, product.productName, product.productPrice, SUM(orderproduct.quantity) AS numSold FROM orderproduct JOIN product on orderproduct.productId = product.productId GROUP BY product.productId, product.productName, product.productPrice Order BY numSold DESC";
    
    echo("</br><table align = \"center\"><tr><th colspan=\"3\">Top Products</th></tr><tr>");
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $id = $row['productId'];
        $numSold = $row['numSold'];
        $pname = $row['productName'];
        $price = $row['productPrice'];
        echo("<td><a href = \"product.php?id=" . urlencode($id) . "&name=" . urlencode($pname) . "&price=" . urlencode($price) . "\">" . $pname . "</a>  $" . number_format($price, 2) . "</td>");
    }
    echo("</tr></table>");
    sqlsrv_close($con);
    
    
?>
</body>
</html>



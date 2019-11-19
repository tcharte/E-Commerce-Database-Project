<!DOCTYPE html>
<html>
<head>
    <title>Harvest Grocery Main Page</title>
</head>
<body>
    
<?php
    include 'header.php';
    include 'include/db_credentials.php';
    echo("<h1 align=\"center\">Welcome to Harvest Grocery</h1>");
    if (isset($_SESSION['LIMessage'])){
        echo ("<p><center>" . $_SESSION['LIMessage'] . "</center></p>");
        unset($_SESSION['LIMessage']);
    }
    if (isset($_SESSION['authenticatedUser'])){
        $user = $_SESSION['authenticatedUser'];

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
        echo("<h2><center>" . $first . " " . $last . "</center></h2></br>");
        sqlsrv_close($con);
    }
?>
    
<h2 align="center"><a href="login.php">Login</a></h2>

<h2 align="center"><a href="listprod.php">Begin Shopping</a></h2>

<h2 align="center"><a href="listorder.php">List All Orders</a></h2>

<h2 align="center"><a href="customer.php">Customer Info</a></h2>

<h2 align="center"><a href="admin.php">Administrators</a></h2>

<h2 align="center"><a href="logout.php">Log out</a></h2>

</body>
</html>



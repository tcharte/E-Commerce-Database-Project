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
    echo("<h2>Welcome " . $_SESSION["authenticatedUser"] . "</h2>");
        
    $date = date('Y-m-d');
// TODO: Write SQL query that prints out total order amount by day


	$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}

	$sql = "SELECT CAST(orderDate AS DATE) AS date, SUM(totalAmount) AS amount FROM ordersummary GROUP BY CAST(orderDate AS DATE)";
	$results = sqlsrv_query($con, $sql, array());
	echo("<table align=\"center\"><tr><th>Order Date</th><th>Total Order Amount</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
		echo("<tr><td>" . $row['date']->format('d/m/Y') . "</td><td>" . $row['amount'] . "</td></tr>");
    }
    echo("</table>");
    sqlsrv_close($con);

?>
    
</body>
</html>
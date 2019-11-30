<?php
    include 'include/db_credentials.php';
    //create connection
        $con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    //let's reccomend products based on user:
    $recprod = array();
    //check user logged in
    if (isset($_SESSION["authenticatedUser"])){
        //user logged in
        $user = $_SESSION['authenticatedUser'];
        
        //user-based reccomended (based on top 3 products purchased by user)
        $sql = "SELECT TOP 3 product.productId, product.productName, product.productPrice, SUM(orderproduct.quantity) AS numSold FROM orderproduct JOIN product on orderproduct.productId = product.productId JOIN ordersummary ON ordersummary.orderId = orderproduct.orderId JOIN customer ON customer.customerId = ordersummary.customerId WHERE customer.customerId = '" . $_SESSION['cid'] . "' GROUP BY product.productId, product.productName, product.productPrice Order BY numSold DESC";
        
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $rid = $row['productId'];
        $rname = $row['productName'];
        $rprice = $row['productPrice'];
        $recprod[$rid] = array($rname, $rprice);
    }
    //extract user's favourite category:
                $sql = "SELECT TOP 1 product.categoryId, SUM(orderproduct.quantity) AS numSold FROM orderproduct JOIN product on orderproduct.productId = product.productId JOIN ordersummary ON ordersummary.orderId = orderproduct.orderId JOIN customer ON customer.customerId = ordersummary.customerId WHERE customer.customerId = '" . $_SESSION['cid'] . "' GROUP BY product.categoryId Order BY numSold DESC";
        
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $favcat = $row['categoryId'];
    }
        //add favourite category products to reccomended list
                $sql = "SELECT productId, productName, productPrice FROM product WHERE categoryId = '" . $favcat . "'";
        
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $rid = $row['productId'];
        $rname = $row['productName'];
        $rprice = $row['productPrice'];
        $recprod[$rid] = array($rname, $rprice);
    }
        
    }else{
        //user not logged in
        $user = NULL;
        //generic reccomended --> top 5 sold
        $sql = "SELECT TOP 5 product.productId, product.productName, product.productPrice, SUM(orderproduct.quantity) AS numSold FROM orderproduct JOIN product on orderproduct.productId = product.productId GROUP BY product.productId, product.productName, product.productPrice Order BY numSold DESC";
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $rid = $row['productId'];
        $rname = $row['productName'];
        $rprice = $row['productPrice'];
        $recprod[$rid] = array($rname, $rprice);
    }
    }

   //close connection
        sqlsrv_close($con);
    ?>
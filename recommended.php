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
        $sql = "SELECT TOP 5 product.productId, product.productName, product.productPrice, product.productImageURL, SUM(orderproduct.quantity) AS numSold FROM orderproduct JOIN product on orderproduct.productId = product.productId JOIN ordersummary ON ordersummary.orderId = orderproduct.orderId JOIN customer ON customer.customerId = ordersummary.customerId WHERE customer.customerId = '" . $_SESSION['cid'] . "' GROUP BY product.productId, product.productName, product.productPrice, product.productImageURL Order BY numSold DESC";
        
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $rid = $row['productId'];
        $rname = $row['productName'];
        $rprice = $row['productPrice'];
        $imgurl = $row['productImageURL'];
        $recprod[$rid] = array($rname, $rprice, $imgurl);
    }
    //extract user's favourite category:
                $sql = "SELECT TOP 1 product.categoryId, SUM(orderproduct.quantity) AS numSold FROM orderproduct JOIN product on orderproduct.productId = product.productId JOIN ordersummary ON ordersummary.orderId = orderproduct.orderId JOIN customer ON customer.customerId = ordersummary.customerId WHERE customer.customerId = '" . $_SESSION['cid'] . "' GROUP BY product.categoryId Order BY numSold DESC";
        
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $favcat = $row['categoryId'];
    }
        //add favourite category products to reccomended list
                $sql = "SELECT productId, productName, productPrice, productImageURL FROM product WHERE categoryId = '" . $favcat . "'";
        
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $rid = $row['productId'];
        $rname = $row['productName'];
        $rprice = $row['productPrice'];
        $imgurl = $row['productImageURL'];
        $recprod[$rid] = array($rname, $rprice, $imgurl);
    }
        
    }else{
        //user not logged in
        $user = NULL;
        //generic reccomended --> top 5 sold
        $sql = "SELECT TOP 10 product.productId, product.productName, product.productPrice, product.productImageURL, SUM(orderproduct.quantity) AS numSold FROM orderproduct JOIN product on orderproduct.productId = product.productId GROUP BY product.productId, product.productName, product.productPrice, product.productImageURL Order BY numSold DESC";
    $results = sqlsrv_query($con, $sql, array());
    while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
        $rid = $row['productId'];
        $rname = $row['productName'];
        $rprice = $row['productPrice'];
        $imgurl = $row['productImageURL'];
        $recprod[$rid] = array($rname, $rprice, $imgurl);
    }
    }
    
    //scramble and slice array
    shuffle($recprod);
    $recprod = array_slice($recprod, 0, 5);

   //close connection
        sqlsrv_close($con);
    ?>
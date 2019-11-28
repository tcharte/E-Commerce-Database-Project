<?php
include 'include/db_credentials.php';
// Get info
session_start();
if(isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productDesc']) && isset($_POST['categoryId'])){
	$productName = $_POST['productName'];
	$productPrice = $_POST['productPrice'];
	$productDesc = $_POST['productDesc'];
	$categoryId = $_POST['categoryId'];
    
    //Create Connection to database
    $con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    //SQL for entering product info:
    $sql = "INSERT INTO product (productName, productPrice, productDesc, categoryId) OUTPUT INSERTED.productId VALUES ('" . $productName . "', '" . $productPrice . "', '" . $productDesc . "', '" . $categoryId . "')";
    
    $pstmt = sqlsrv_query($con, $sql, array());
    if(!sqlsrv_fetch($pstmt)){
        //Use sqlsrv_errors();
    }
    $productId = sqlsrv_get_field($pstmt,0);
    
    //close connection
    sqlsrv_close($con);
    
    if($productId != false){
        header('Location: product.php?id=' . urlencode($productId) . '&name=' . urlencode($productName) . '&price=' . urlencode($productPrice));
    }
    
} else {
	header('Location: newproduct.php');
}
?>
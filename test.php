<!DOCTYPE html>
<html>
<head>
    <title>Harvest Grocery Main Page</title>
</head>
<body>
    <?php
session_start();
if(isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productDesc']) && isset($_POST['categoryId'])){
	$productName = $_POST['productName'];
	$productPrice = $_POST['productPrice'];
	$productDesc = $_POST['productDesc'];
	$categoryId = $_POST['categoryId'];
    echo("<h1>" . $productName . $productPrice . $productDesc . $categoryId . "</h1>");
}else {
	header('Location: newproduct.php');
}
    ?>
</body>
</html>



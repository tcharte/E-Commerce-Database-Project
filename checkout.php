<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Checkout</title>
    <?php
    include 'header.php';
    ?>
    <?php
	$authenticated = $_SESSION['authenticatedUser']  == null ? false : true;

	if (!$authenticated)
	{
		$loginMessage = "You must log in to place an order.";
        $_SESSION['loginMessage']  = $loginMessage;
        $_SESSION['redirect']  = "order.php"; 
		header('Location: login.php');
	}else{
        header('Location: order.php');
    }
?>
</head>
<body>
</body>
</html>


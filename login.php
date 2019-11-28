<!DOCTYPE html>
<html>
<head>
<title>Login Screen</title>
</head>
<body>
    <?php include 'header.php';
    
    if (isset($_SESSION['authenticatedUser'])){
        $authenticated = $_SESSION['authenticatedUser'];
    }else{
        $authenticated = false;
    }
    

	if ($authenticated)
	{
		$Message = "You are already logged in.";
        $_SESSION['LIMessage']  = $Message;        
		header('Location: index.php');
	}
    
    ?>

<div style="margin:0 auto;text-align:center;display:inline">

<h3>Please Login to System</h3>

<?php 
    if (isset($_SESSION['loginMessage'])){
        echo ("<p style\"textalign=center\">" . $_SESSION['loginMessage'] . "</p>");
        unset($_SESSION['loginMessage']);
    }
?>

<br>
<form name="MyForm" method="post" action="validateLogin.php">
<table style="display:inline">
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Username:</font></div></td>
	<td><input type="text" name="username"  size=10 maxlength=10></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Password:</font></div></td>
	<td><input type="password" name="pass" size=10 maxlength="10"></td>
</tr>
</table>
<br/>
<input class="submit" type="submit" name="Submit2" value="Log In">
</form>

</div>

</body>
</html>


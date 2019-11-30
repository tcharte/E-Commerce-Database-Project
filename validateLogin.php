<?php 
    session_start();          
    $authenticatedUser = validateLogin();
    if(isset($_SESSION['redirect'])){
        header('Location: ' . $_SESSION['redirect']);
        unset($_SESSION['redirect']);
    }else if ($authenticatedUser != null)
        header('Location: index.php');      		// Successful login
    else
        header('Location: login.php');	             // Failed login - redirect back to login page with a message     
    
	function validateLogin()
	{	  
	    $user = $_POST["username"];	 
	    $pw = $_POST["loginpassword"];
		$retStr = null;

		if ($user == null || $pw == null)
			return null;
		if ((strlen($user) == 0) || (strlen($pw) == 0))
			return null;

		include 'include/db_credentials.php';
		$con = sqlsrv_connect($server, $connectionInfo);
		
		// TODO: Check if userId and password match some customer account. If so, set retStr to be the username.
		$sql = "Select userid, password, customerId FROM customer WHERE userId = '" . $user . "'";
        $results = sqlsrv_query($con, $sql, array());
        while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
            $uid = $row['userid'];
            $pas = $row['password'];
            $custid = $row['customerId'];
        }
        
        if($user == $uid && $pw == $pas){
            $retStr = $uid;
        }else{
            $retStr = null;
        }
		sqlsrv_free_stmt($pstmt);
		sqlsrv_close($con);
		$_SESSION["cid"] = $custid;
        
		if ($retStr != null)
		{	$_SESSION["loginMessage"] = null;
	       	$_SESSION["authenticatedUser"] = $user;
		}
		else
		    $_SESSION["loginMessage"] = "Could not connect to the system using that username/password.";

		return $retStr;
	}	
?>
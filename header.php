<style>
    /* Add a black background color to the top navigation */
    .topnav {
        background-color: #333;
        overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
        background-color: SlateBlue;
        color: white;
    }
    </style>
<body style="background-color:powderblue;">
    <?php
    session_start();
    if (isset($_SESSION["authenticatedUser"])){
        $user = $_SESSION['authenticatedUser'];
    }else{
        $user = NULL;
    }
    ?>
    
    <div class="topnav">
        <a class="<?php echo ($_SERVER['PHP_SELF'] == "/54151162/lab8/index.php" ? "active" : "");?>" href="index.php">Home</a>
        <a class="<?php echo ($_SERVER['PHP_SELF'] == "/54151162/lab8/listprod.php" ? "active" : "");?>" href="listprod.php">Shop</a>
        <a class="<?php echo ($_SERVER['PHP_SELF'] == "/54151162/lab8/showcart.php" ? "active" : "");?>" href="showcart.php">Shopping Cart</a>
        <a class="<?php echo ($_SERVER['PHP_SELF'] == "/54151162/lab8/listorder.php" ? "active" : "");?>" href="listorder.php">All Orders</a>
        <?php
        if($user == NULL){ // If no user logged in
            echo("<a href=\"login.php\" style=\"float: right;\">Log In</a>");
            echo("<a href=\"signup.php\" style=\"float: right;\">Sign Up</a>");
        }else{	// if user is logged in
            echo("<a href=\"logout.php\" style=\"float: right;\">Log Out</a>");
            echo("<a href=\"customer.php\" style=\"float: right;\">User: " . $user . "</a>");
        }
        ?>
    </div>
</body>
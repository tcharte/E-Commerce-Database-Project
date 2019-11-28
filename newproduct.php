<!DOCTYPE html>
<html>
    <head>
        <title>Harvest Grocery Add Product</title>
    </head>
<body>
    <?php
    include 'header.php';
    ?>
<br>
<h1 style="text-align:center">Administrator: Add New Product</h1>
<form method="post" action="addproduct.php">
    <table align="center">
        <tr><th>Product Name:</th><td><input type="text" name="productName" maxlength="40" required></td></tr>
        <tr><th>Price:</th><td><input type="number" name="productPrice" step="0.01" min="0" max="9999999"  required></td></tr>
        <tr><th>Description:</th><td><input type="text" name="productDesc" maxlength="1000" required></td></tr>
        <tr><th>Category:</th><td><select name="categoryId" required>
        <option value="1">Beverages</option>
        <option value="2">Condiments</option>
        <option value="3">Confections</option>
        <option value="4">Dairy Products</option>
        <option value="5">Grains/Cereals</option>
        <option value="6">Meat/Poultry</option>
        <option value="7">Produce</option>
        <option value="8">Seafood</option>
    </select></td></tr>
    </table>
    <center><input type="submit"></center>
</form>
    
</body>
</html>
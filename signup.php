<!DOCTYPE html>
<html>
    <head>
        <title>Harvest Grocery Sign Up</title>
    </head>
<body>
    <?php
    include 'header.php';
    ?>
<br>
<h1 style="text-align:center">Customer Sign-up</h1>
<form action="createcust.php">
    <table align="center">
        <tr><th>First Name:</th><td><input type="text" name="firstName" maxlength="40" required></td></tr>
        <tr><th>Last Name:</th><td><input type="text" name="lastName" maxlength="40" required></td></tr>
        <tr><th>Email:</th><td><input type="email" name="email" maxlength="50" required></td></tr>
        <tr><th>Phone Number:</th><td><input type="text" name="phonenum" maxlength="20" required></td></tr>
        <tr><th>Address:</th><td><input type="text" name="address" maxlength="50" required></td></tr>
        <tr><th>City:</th><td><input type="text" name="city" maxlength="40" required></td></tr>
        <tr><th>State:</th><td><select name="state" required>
    <option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
            </select></td></tr>
        <tr><th>Postal Code:</th><td><input type="text" name="postalCode" maxlength="8" required></td></tr>
        <tr><th>Country:</th><td><input type="text" name="country" maxlength="40" required></td></tr>
        <tr><th>Username:</th><td><input type="text" name="userid" maxlength="20" required></td></tr>
        <tr><th>Password:</th><td><input type="password" name="password" maxlength="30" required></td></tr>
    </table>
    <center><input type="submit"></center>
</form>
    
</body>
</html>
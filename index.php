<?php

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert and Retrieve data from MySQL database with ajax</title>
	<link rel="stylesheet" href="./styles.css">
</head>
<body>
<div class="wrapper">
	<form method="post" class="data_form" id="myForm" action="">
		<div class="input-group">
			<label for="first_name">First Name:</label>
			<input type="text" name="first_name" id="first_name" value="">
		</div>
		<div class="input-group">
			<label for="last_name">Last Name:</label>
			<input type="text" name="last_name" id="last_name" value="">
		</div>
		<div class="input-group">
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" value="">
		</div>
		<div class="input-group">
			<label for="gender">Gender:</label>
			<input type="text" name="gender" id="gender" value="">
		</div>
		<div class="input-group">
			<label for="ip_address">IP Address:</label>
			<input type="text" name="ip_address" id="ip_address" value="">
		</div>
		<div class="input-group">
			<input type="submit" id="save" name="save" class="btn" value="Submit">
		</div>
	</form>
	<div class="col2">
		<div class="input-group">
			<label for="input-id">Enter an id or 0 to get all users</label>
			<input type="text" name="input-id" id="input-id">
			<button id="get" class="btn">Get User Details</button>
		</div>
	</div>

</div>

<div class="container" id="display-data">
	<table id="data-table">

	</table>

</div>

<div class="form-popup" id="update_form">
	<div class="form-container">
		<form class="data_form" id="myForm2">
			<div class="input-group">
				<input type="hidden" name="u_id" id="u_id" >
			</div>
			<div class="input-group">
				<label for="u_first_name">First Name:</label>
				<input type="text" name="u_first_name" id="u_first_name" >
			</div>
			<div class="input-group">
				<label for="u_last_name">Last Name:</label>
				<input type="text" name="u_last_name" id="u_last_name" >
			</div>
			<div class="input-group">
				<label for="u_email">Email:</label>
				<input type="email" name="u_email" id="u_email" >
			</div>
			<div class="input-group">
				<label for="u_gender">Gender:</label>
				<input type="text" name="u_gender" id="u_gender" >
			</div>
			<div class="input-group">
				<label for="u_ip_address">IP Address:</label>
				<input type="text" name="u_ip_address" id="u_ip_address" >
			</div>
			<div class="input-group">
				<input type="submit" id="update" name="update" class="btn" value="Update Data">
			</div>
		</form>
	</div>

</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script	src="./script.js"></script>
</body>
</html>

<?php
//session_start();
	$dbServerName = "localhost";
	$dbUsername = "mock-user";
	$dbPassword = "mock-pass";
	$dbName = "mock_database";
	$dbPort = 3306;

	$con = mysqli_connect($dbServerName,$dbUsername,$dbPassword,$dbName,$dbPort);
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}else{
		//echo "connected"."</br>";
	}

	if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['q'])){
		$q = intval($_GET['q']);
		echo getData($q);
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['u_id'])) {
		$first_name = htmlspecialchars(trim($_POST["first_name"]));
		$last_name = htmlspecialchars(trim($_POST["last_name"]));
		$email = htmlspecialchars(trim($_POST["email"]));
		$gender = htmlspecialchars(trim($_POST["gender"]));
		$ip_address = htmlspecialchars(trim($_POST["ip_address"]));

		echo setData($first_name,$last_name,$email,$gender,$ip_address);
	}

	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['edit'])) {
		$edit = intval($_GET['edit']);
		echo editData($edit);

	}

	if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['del'])) {
		$del = intval($_GET['del']);
		echo delData($del);
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['u_id'])) {
		$u_id = htmlspecialchars(trim($_POST["u_id"]));
		$u_first_name = htmlspecialchars(trim($_POST["u_first_name"]));
		$u_last_name = htmlspecialchars(trim($_POST["u_last_name"]));
		$u_email = htmlspecialchars(trim($_POST["u_email"]));
		$u_gender = htmlspecialchars(trim($_POST["u_gender"]));
		$u_ip_address = $_POST["u_ip_address"];
		echo updateData($u_id,$u_first_name,$u_last_name,$u_email,$u_gender,$u_ip_address);
	}

	function getData($key){
		global $con;
			if($key > 0){
				$sql="SELECT * FROM mock_data WHERE id = $key";
			}elseif($key == 0 || $key == ''){
				$sql="SELECT * FROM mock_data";
			}

			$result = mysqli_query($con,$sql);
			$final = array();
			while ($row = $result->fetch_assoc()){
				$final[] = $row;
			}
			return json_encode($final);
	}

	function setData($fname,$lname,$e,$g,$ip){
		global $con;
		if(!empty($fname) && !empty($lname) && !empty($e) && !empty($g) && !empty($ip)){
			$sql = "INSERT INTO `mock_data` (`first_name`,`last_name`,`email`,`gender`,`ip_address`) VALUES ('$fname','$lname','$e','$g','$ip')";
			}else{
				die("No empty data allowed");
			}
			$result = mysqli_query($con,$sql);
			if($result == 1){
				echo "Data Inserted"."</br>";
			}else{
				echo "Error occurred: ".mysqli_error($con)."</br>";
			}
	}

	function editData($key){
		global $con;
			$record = mysqli_query($con, "SELECT * FROM mock_data WHERE id=$key");
			if (count($record) == 1 ) {
				$final = array();
				while ($row = $record->fetch_assoc()){
					$final[] = $row;
				}
				return json_encode($final);
			}
	}

	function updateData($uid,$fname,$lname,$e,$g,$ip){
		global $con;

		if(!empty($uid) && !empty($fname) && !empty($lname) && !empty($e) && !empty($g) && !empty($ip)){
			$sql = "UPDATE `mock_data` SET `first_name` = '$fname', `last_name` = '$lname', `email` = '$e', `gender` = '$g', `ip_address` = '$ip' WHERE `mock_data`.`id` = $uid ";
		}else{
			die("No empty data allowed");
		}
		$result = mysqli_query($con,$sql);
		if($result == 1){
			echo "Data Updated"."</br>";
		}else{
			echo "Error occurred: ".mysqli_error($con)."</br>";
		}
	}

	function delData($key){
		global $con;
			$record = mysqli_query($con,"DELETE FROM mock_data WHERE id=$key");
			if($record == 1){
				echo "Data Deleted"."</br>";
			}else{
				echo "Error occurred: ".mysqli_error($con)."</br>";
			}
	}

	mysqli_close($con);
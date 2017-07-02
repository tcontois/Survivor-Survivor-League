<?php
define('BACK_PATH', '../'); // path back to the ROOT SSL directory

include_once "../php/ServerConnect.php";
include_once "../php/Utilities.php";

$username = NULL;
$password = NULL;

if(isset($_POST['username']) && isset($_POST['password'])){
	$username = mysql_sanitize($_POST['username']);
	$password = $_POST['password'];
}

if ($username && $password) {
	if ($row = mysqli_fetch_assoc(query("SELECT * FROM users WHERE username = '$username'"))) { 
		$hashed_password = hash("sha256", $password);
		if ($hashed_password == $row['password']) {
			setcookie("username", $username, 0, "/");
			setcookie("uid", $row['id'], 0, "/");
			header("Location: " . BACK_PATH . "home/");
			die;
		}
	}
}
header("Location: " . BACK_PATH);
die;
?>
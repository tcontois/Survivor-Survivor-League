<?php
define('BACK_PATH', '../'); // path back to the ROOT SSL directory

include_once "../php/ServerConnect.php";
include_once "../php/Utilities.php";

$username = NULL;
$password = NULL;

if(isset($_POST['username']) && isset($_POST['password'])){
	$username = mysql_sanitize($_POST['username']);
	$password = $_POST['password'];
	$hashed_password = hash("sha256", $password);
	$row = mysqli_fetch_assoc(query("SELECT * FROM users WHERE username = '$username'"));
	if($row){
		$msg = "This username is inappropriate";
	}
	else{
		query("INSERT INTO users (username, password) values ('$username','$hashed_password')");
		setcookie("username", $username, 0, "/");
		$row = mysqli_fetch_assoc(query("select id from users where username = '$username' and password = '$hashed_password'"));
		setcookie("uid", $row['id'], 0, "/");
		header("Location: " . BACK_PATH . "home/");
		die;
	}
}

header("Location: " . BACK_PATH);
die;
?>
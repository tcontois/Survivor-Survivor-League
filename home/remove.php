<?php

include_once "../php/ServerConnect.php";
include_once "../php/Utilities.php";

//get info
$sql = "select * from info";
$result = mysqli_fetch_row(query($sql));
$season = $result[0];
$current_week = $result[1];
$num_picks = $result[2];

$sql = "delete from picks where cid = {$_GET['cid']} and uid = {$_COOKIE['uid']} and season = $season and week = $current_week";
query($sql);

header('Location: ../home');
die;

?>
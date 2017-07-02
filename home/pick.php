<?php

include_once "../php/ServerConnect.php";
include_once "../php/Utilities.php";

//get info
$sql = "select * from info";
$result = mysqli_fetch_row(query($sql));
$season = $result[0];
$current_week = $result[1];
$num_picks = $result[2];

// get current pick
$sql = "select p.id from picks p, cast c where p.cid = c.id and p.uid = {$_COOKIE['uid']} and p.season = $season and week = $current_week";
$result = query($sql);
$row = mysqli_fetch_assoc($result);
if($row){
	if($num_picks == 1){
		$sql = "update picks set cid = {$_GET['cid']} where id = {$row['id']}";
		query($sql);
	}
	if($num_picks == 2){
		$row = mysqli_fetch_assoc($result);
		if($row){
			$sql = "update picks set cid = {$_GET['cid']} where id = {$row['id']}";
			query($sql);
		}
		else{
			$sql = "insert into picks (uid, cid, season, week) values ({$_COOKIE['uid']}, {$_GET['cid']}, $season, $current_week)";
			query($sql);
		}
	}
}
else{
	$sql = "insert into picks (uid, cid, season, week) values ({$_COOKIE['uid']}, {$_GET['cid']}, $season, $current_week)";
	query($sql);
}

header('Location: ../home');
die;

?>
<?php

function query($sql, $err="") {
	global $conn; // Get the mysql connection from ServerConnect.php
    if ($err) {
        $result =  mysqli_query($conn, $sql) or die($err);
    }
    else {
        $result =  mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
    return $result;
}

function mysql_sanitize($str) {
	global $conn;
    return mysqli_real_escape_string($conn, $str);
}

?>
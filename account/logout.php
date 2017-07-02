<?php
define('BACK_PATH', '../'); // path back to the ROOT SSL directory

setcookie("username", false, -1, "/");
setcookie("uid", false, -1, "/");

header("Location: " . BACK_PATH);
die;
?>
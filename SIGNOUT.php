<?php
//
if (session_status() >= 0) {

session_start();

session_unset();

session_destroy();
echo "You are now redirected";
}

header("refresh: 2; url = index.php");
?>
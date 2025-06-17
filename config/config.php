<?php
ob_start(); //Turns on output buffering 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("sql210.infinityfree.com", "if0_39233714", "GTweWvMWAEOizq", "if0_39233714_social");

 //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>
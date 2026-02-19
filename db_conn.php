<?php
session_start();

/* 
    DATABASE CONNECTION SETTINGS 
    Change these to match your environment.
*/
$host = 'localhost';   // Usually 'localhost'
$user = 'root';        // Your database username
$pass = '';            // Your database password
$db   = 'login';       // Your database name

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
session_start();
session_destroy();
/* 
    WHERE TO GO AFTER LOGOUT
    Change this to where you want the user to go after they log out.
*/
header("Location: login.php");
exit;
?>

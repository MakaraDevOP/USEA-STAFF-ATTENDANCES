<?php 
session_start();
if( isset($_SESSION['users']) && isset($_SESSION['role']) )
{
    echo("<script>console.log('Authentication check is ok! 👋User:".$_SESSION['users']." 👾Role:".$_SESSION['role']."'".")</script>");
 } else {
     // username and password not given so go back to login
     header( "Location: /staffAttendence/frontend/auth/login.php" );
 }
?>
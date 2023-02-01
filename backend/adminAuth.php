<?php 
// session_start();
if( isset($_SESSION['users']) && $_SESSION['role']=="Admin")
{
    echo("<script>console.log('Authentication Admin check is ok! Admin:".$_SESSION['users']." 👾Role:".$_SESSION['role']."'".")</script>");
 } else {
     // username and password not given so go back to login
     header( "Location: /staffAttendence/frontend/dashboard/index.php" );
 }
?>
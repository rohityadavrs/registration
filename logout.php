<?php
session_start();

// $login_date=date("y-m-d");
// $login_time=time("H:i:s");
// $time = date("H:i:s");
// $date = date("Y-m-d");
// mysqli_query($conn, "UPDATE log_details SET logout_date = '$date' AND logout_time = '$time' WHERE username = '$_SESSION[uname]'");
$_SESSION = NULL;
$_SESSION = [];

session_unset();
session_destroy();

header("Location: index.php");
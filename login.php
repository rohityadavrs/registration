<?php
session_start();
include "db_con.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	// $login_date=date("y-m-d");
	// $login_time=time("H:i:s");

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
		// $sql2= "INSERT INTO log_details (`id`,`user_name`,`login_time`,`login_date`,`logout_date`,`logout_time`) value (null,`$_SESSION[uname]`,'$login_date','$login_time')"

		$result = mysqli_query($conn, $sql);
		// $result2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result) ===1 ) {
            //echo "hello";
			$row = mysqli_fetch_assoc($result);
            //print_r($row);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
                //echo "logged in!";
                $_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];

				// $sql2= "INSERT INTO log_details (`id`,`user_name`,`login_time`,`login_date`,`logout_date`,`logout_time`) value (null,`$_SESSION[uname]`,'$login_date','$login_time')"
				// $result2 = mysqli_query($conn, $sql2);
				// $row = mysqli_fetch_assoc($result2);
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect User name or password");
	        exit();
		}
	}

}else{
	header("Location: index.php");
	exit();
}
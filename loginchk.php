<?php
session_start();

include "templates/db-con.php";

$sql = "SELECT pwd, role FROM person where user_id = '$uname'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) != 0) {
 
    $data = mysqli_fetch_assoc($result);
    if ($data['pwd'] == $passwd) {
		$_SESSION['uname'] = $uname;
		$_SESSION['role'] = $data['role'];	
        header('Location: index.php');
        exit;
    }
	else{
		echo 'incorrect password';
		header('refresh:3; index.php');
		exit;
	}
		
    
} else {
    echo 'incorrect username';
	header('refresh:3; index.php');
	exit;
}
?>

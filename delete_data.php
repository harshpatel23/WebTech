<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='admin')
{
	echo '<h1>Unauthorized access!!</h1><p>Redirecting...</p>';
	header('refresh: 3; index.php');
	exit;
}


if((!isset($_GET['table'])) && (!isset($_GET['id'])) && (!isset($_GET['value'])))
{
	header('Location: index.php');
	exit;
}

include 'templates/db-con.php';

$table = $_GET['table'];
if($table != 'favourites')
{
	$id = $_GET['id'];
	$value = $_GET['value'];

	$sql = "delete from $table where $id = '$value'";
}
else
	$sql = "delete from favourites where user_id='".$_GET['user_id']."' and rest_id = '".$_GET['rest_id']."';";
if(!$result = mysqli_query($conn, $sql))
{
	echo $sql;
	echo '<h3>Cannot delete! Check for foreign key constraints!</h3> <p>Redirecting...</p>';
	header('refresh: 3; admin_view.php');
}
else
{
	header("Location: admin_view.php?edit_category=$table");
	exit;
}
	
?>
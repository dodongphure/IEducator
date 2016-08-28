<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["emailContent"])){
	$sql = "INSERT INTO emailRegister (emailContent) value (\"".checkText($_POST["emailContent"])."\")";
	if (mysql_query($sql, $conn)) {
		echo "Submit successfully!";
	}

mysql_close($conn);
}
?>
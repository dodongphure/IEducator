<?php
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
if($_GET['type'] == 'usernameAutoComplete'){
	$result = mysql_query("SELECT username FROM students WHERE username LIKE '".strtoupper($_GET['name_startsWith'])."%' LIMIT 5", $conn);	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		array_push($data, $row['username']);	
	}	
	echo json_encode($data);
}
if($_GET['type'] == 'exAutoComplete'){
	$exID = $_GET['ex']."ID";
	$result = mysql_query("SELECT ".$exID." FROM ".$_GET['ex']." WHERE ".$exID." LIKE '".strtoupper($_GET['name_startsWith'])."%' LIMIT 5", $conn);	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		array_push($data, $row[$exID]);	
	}	
	echo json_encode($data);
}

?>
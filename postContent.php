<?php  
require_once 'config.php';

?>
<link rel="stylesheet" type="text/css" href="/script/ckeditor/contents.css">
<?php
if(($_SERVER['REQUEST_METHOD'] == 'GET')&&!empty($_GET["tbl"])&&!empty($_GET["id"])){
	$tbl = checkText($_GET["tbl"]);
	$tbl_name = getTableFromIdx($tbl);
	$id = checkText($_GET["id"]);
	
	$sql = "SELECT * FROM $tbl_name WHERE id=".$id;
	$result = mysql_query($sql, $conn);
	if (mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_assoc($result)){
			echo $row["content"];
		}
	}
}
mysql_close($conn);
?>
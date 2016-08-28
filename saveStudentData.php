<?php  
require_once 'config.php';

if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["stuID"])&&!empty($_POST["exID"])&&!empty($_POST["content"])&&!empty($_POST["answer"])) {
	$day = explode("-", $_POST["exID"])[0];
	$exID = explode("-", $_POST["exID"])[1];
	$content = implode("*/*", $_POST['content']);
	$answer = implode("*/*", $_POST['answer']);
	$content = checkText($content);
	$answer = checkText($answer);
	//echo answer
	$exType = explode(".", $exID)[0];$id = substr($exType, 2);
	$ex = explode(".", $exID)[1];
	$query = mysql_query("select * from ".$exType." LIMIT ".($ex-1).", 1", $conn);
	$rows = mysql_num_rows($query);
	if($rows == 1){
		$row = mysql_fetch_assoc($query);
		if($id < 6)
			$ex=$row[$exType."ID"];
		else
			$ex=$row["id"];
	}
	if($id < 6)
		$sql = "SELECT answer FROM $exType WHERE ex".$id."ID=$ex";
	else
		$sql = "SELECT answer FROM $exType WHERE id=$ex";
	$result = mysql_query($sql, $conn);
	$answerKey='';
	if (mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_assoc($result)) {
			$answerKey = $row["answer"];
		}
	}
	echo $answerKey."\n";
	//save data
	$isScored = false;
    $sql = "SELECT * FROM students WHERE stuID=".$_POST["stuID"];
	$result = mysql_query($sql, $conn);
	if (mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_assoc($result)) {
			$oldScore = json_decode($row["scores"], true);
			$count=0;
			foreach ($oldScore as $key => &$value) {
				if($key=="day".$day){
					foreach ($value as $key_1 => &$value_1) {
						if($key_1==$exID){
							if($value_1['count'] <= 0)
								$isScored = true;
							else{
								$last_id=null;
								if($value_1['score']==null){
									$sql = "INSERT INTO studentData (att1, att2) VALUES (\"".$content."\", \"".$answer."\")";
									if (mysql_query($sql, $conn)) {
										$last_id = mysql_insert_id($conn);
									}else echo "Error: " . $sql . "<br>" . mysql_error($conn);
								}else{
									$sql = "SELECT * FROM studentData WHERE id=".$value_1['score'];
									$result_1 = mysql_query($sql, $conn);
									if(mysql_num_rows($result_1) > 0){
										$sql = "UPDATE studentData SET att1=\"".$content."\", att2=\"".$answer."\" WHERE id=".$value_1['score'];
										if (mysql_query($sql, $conn))
											$last_id = $value_1['score'];
										else echo "Error: " . $sql . "<br>" . mysql_error($conn);
									}else{
										$sql = "INSERT INTO studentData (att1, att2) VALUES (\"".$content."\", \"".$answer."\")";
										if (mysql_query($sql, $conn)) {
											$last_id = mysql_insert_id($conn);
										}else echo "Error: " . $sql . "<br>" . mysql_error($conn);
									}
								}
								
								$value_1['score']=$last_id;
								$value_1['count']--;
								$count=$value_1['count'];
							}
						}
					}
				}
			}
			if(!$isScored){
				$newScore = json_encode($oldScore);
				$sql = "UPDATE students SET scores = '$newScore' WHERE stuID=".$_POST["stuID"];
		    	if (mysql_query($sql, $conn)) {
		    		echo "\nUpdate scores successfully. You have $count last times to re-do this exercise!";
		    	} else{
		    		echo "\nError: <br>" . mysql_error($conn);
		    	}
			}
			else
				echo "\nYou have done this exercise!";
			echo "/*DoDongPhure*/$count";
		}
	}
}
?>
<?php  
require_once 'config.php';
function compare($ans, $string){
	$ans = explode("/", $ans);
	$string = explode("/", $string);
	for($i=0; $i<count($ans); $i++){
		for($j=0; $j<count($string); $j++){
			if (strtolower($ans[$i]) == strtolower($string[$j]))
				return true;
		}
	}
	return false;
}
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["stuID"])&&!empty($_POST["exID"])&&!empty($_POST["answer"])) {
	$day = explode("-", $_POST["exID"])[0];
	$exID = explode("-", $_POST["exID"])[1];
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
	if (mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_assoc($result)) {
			$answer = $row["answer"];
		}
		$dung=0; $sai=0;
		$answers = explode("*/*", $answer);
		for($i=0; $i<count($answers); $i++){
			if (compare($answers[$i], $_POST["answer"][$i])) $dung++;
			else $sai++;
		}
		echo $answer."\n";
		echo "TRUE: ".$dung. " | FALSE: ".$sai;
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
							if($key_1==explode("-", $_POST["exID"])[1]){
								if($value_1['count'] <= 0)
									$isScored = true;
								else{
									$value_1['score']=$dung."/".($dung+$sai);
									$value_1['count']--;
									$count=$value_1['count'];
									if($exType == 'ex2')
										$value_1['score']="1/1";
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
		else echo "\n0 students";
	}
	else echo "Can not check result!";
}
?>
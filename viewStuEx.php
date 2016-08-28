<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
    header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST["stuName"])){
	$sql = "SELECT * FROM students WHERE username=\"".$_POST["stuName"]."\"";
	$result = mysql_query($sql, $conn);
	if (mysql_num_rows($result) > 0) {
	    while($row = mysql_fetch_assoc($result)) {
	        if ($row["role"]=="admin") continue;
	        $scores = "";
	        if($row["grID"]==null){
	            $scores = $row["scores"];
	            if($scores!=null){
	                $scores = json_decode($scores, true);
	                foreach ($scores as $key => $value) {
	                	foreach ($value as $key_1 => $value_1) {
	                		if(substr($key_1, 0, 3)=='ex5'){
		                        $delete_query = "DELETE FROM ex5wr WHERE id =".$value_1['score'];
		                        if (mysql_query($delete_query, $conn)) {
		                            //echo "Record deleted successfully<br>";
		                        }
		                        else {
		                            echo "Error deleting record: " . mysql_error($conn);
		                        }
		                    }else if(isExViewer(substr($key_1, 0, 3))){
		                        $delete_query = "DELETE FROM studentData WHERE id =".$value_1['score'];
		                        if (mysql_query($delete_query, $conn)) {
		                            //echo "Record deleted successfully<br>";
		                        }
		                        else {
		                            echo "Error deleting record: " . mysql_error($conn);
		                        }
		                    }
	                	}
	                }
	            }
	            $sql = "UPDATE students SET scores = NULL WHERE stuID=".$row["stuID"];
	            if (mysql_query($sql, $conn)) {
	                //echo "Assign exercises successfully<br>";
	            } else{
	                echo "Error: " . $sql . "<br>" . mysql_error($conn);
	            }
	            echo "This student has not been assigned in any group. Let's give him/her some works!";
	        }
	        else {
	        	if ($row["scores"]!=null){
		            $scores = $row["scores"];
		            $scores = json_decode($scores, true);
		            //calculate avgScore
		            $avgScore="N/A";
		            $a=$b=0;
		            foreach ($scores as $key => $value) {
		                foreach ($value as $key_1 => $value_1) {
		                    if(($value_1['score']!=null)&&(substr($key_1, 0, 3)!='ex2')&&(substr($key_1, 0, 3)!='ex5')&&(substr($key_1, 0, 3)!='ex6')&&(substr($key_1, 0, 3)!='ex8')){
		                        $a += intval(explode("/", $value_1['score'])[0]);
		                        $b += intval(explode("/", $value_1['score'])[1]);
		                    }
		                }
		            }
		            if($b!=0)
		                $avgScore=(($a/$b)*10)."/10";

		            //Done action
		            if(isset($_POST["doneRecord"])||(isset($_POST["doneExDay"]))){
		            	foreach ($scores as $key => &$value) {
		            		if(isset($_POST["doneRecord"])&&($key == "day".$_POST["doneRecord"])){
		            			foreach ($value as $key_1 => &$value_1) {
		            				if(isExViewer(substr($key_1, 0, 3))&&($value_1['score']!=null)) continue;
		            				$value_1['score']="1/1";
		            				$value_1['count']=0;
		            			}
		            		}
		            		else if(isset($_POST["doneExDay"])&&($key == "day".$_POST["doneExDay"])){
		            			foreach ($value as $key_1 => &$value_1) {
		            				if(isExViewer(substr($key_1, 0, 3))&&($value_1['score']!=null)) continue;
		            				if(isset($_POST["doneExID"])&&($_POST["doneExID"]==$key_1)){
		            					$value_1['score']="1/1";
		            					$value_1['count']=0;
		            				}
		            			}
		            		}
		            	}
		            	$scores_update=json_encode($scores);
                        $sql = "UPDATE students SET scores = '$scores_update' WHERE stuID= \"".$row["stuID"]."\"";
                        if (mysql_query($sql, $conn)) {
                            //echo "Update scores successfully";
                        } else{
                            echo "Error: <br>" . mysql_error($conn);
                        }
					}
		            $sql_1 = "SELECT * FROM groups WHERE grID=".$row["grID"];
					$result_1 = mysql_query($sql_1, $conn);
					if (mysql_num_rows($result_1) > 0) {
					    while($row_1 = mysql_fetch_assoc($result_1)){
					    	$dailyGr=$row_1["dailyGr"];
					    	$timeCreated=$row_1["timeCreated"];
					    }
					    ?>
					    Name: <strong><?php echo $_POST["stuName"];?></strong><br>
					    Average score: <strong><?php echo $avgScore;?></strong><br>
					    Statistics:<br>
					    <ul>
					    	<li>Current Exercise day: day <strong><?php echo intval(calDayEx(date("Y-m-d H:i:s",time()), $timeCreated))+1 ?></strong></li>
					    	<li>Exercises group ID: <strong><?php echo $dailyGr ?></strong></li>
					    	<li>Num of exercise days which have been viewed: <strong><?php echo count($scores) ?></strong></li>
					    </ul>
					    <?php
					}
		            ?>
		            <div class="table-student-submission">
				    <table class="mc-table">
				        <thead>
				            <tr>
				                <th width="20%" class="author">Day<span class="caret"></span></th>
				                <th width="60%" class="submit-date">Exercises<span class="caret"></span></th>
				                <th class="submit-date">Action<span class="caret"></span></th>
				            </tr>
				        </thead>
				        <tbody>
		            <?php
		            foreach ($scores as $key_2 => $value_2) {
		            	$exDay=substr($key_2, 3);
		            	?><tr><td class="author">Day <?php echo $exDay ?></td><?php
		            	$scoresList="";
		            	$hiddenForm='';
		            	foreach ($value_2 as $key_3 => $value_3) {
		            		if($value_3['score']==null) $val="Not done!";
			                else $val = $value_3['score'];
			                if(isExViewer(explode(".", $key_3)[0])&&($val!="Not done!"))
			                    $scoresList .= convertExName($key_3).": <a class=\"viewWr\" href=\"#action\" target=\"popup\" onclick=\"window.open('viewStudentData.php?type=".getExType($key_3)."&ID=".base64_encode($val)."','phure','scrollbars=yes,directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,width=700,height=400')\">⇒ View Data</a><br>";
			                else{
			                    $scoresList .= convertExName($key_3).": <strong>".$val."</strong>";
			                    if($val=="Not done!"){
			                    	$id=str_replace(".", "", $key_3);
			                    	$hiddenForm .= "<form id=\"formExDone".$exDay.$id."\" method=\"post\"><input type=\"hidden\" name=\"doneExDay\" value=\"".$exDay."\"><input type=\"hidden\" name=\"doneExID\" value=\"".$key_3."\"><input type=\"hidden\" name=\"stuName\" value=\"".$row["username"]."\"></form>";
			                    	$scoresList .= "<button class=\"btn-link checkDone\" type=\"button\" onclick=\"confirmLoadAction('viewStuEx.php','formExDone".$exDay.$id."')\"> ➤ Done!</button><br>";
			                    }
			                    else
			                    	$scoresList .= "<br>";
			                }
		            	}
		                ?><td class="submit-date"><?php echo $hiddenForm.$scoresList ?></td>
		                <td class="submit-date"><?php echo "<form id=\"formDone".$exDay."\" method=\"post\">
			                <input type=\"hidden\" name=\"doneRecord\" value=\"".$exDay."\">
			                <input type=\"hidden\" name=\"stuName\" value=\"".$row["username"]."\">
			                <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewStuEx.php','formDone".$exDay."')\" type=\"button\">Check Done All</button>
			                </form>" ?></td>
			            </tr><?php
		            }
		            ?>
		            </tbody>
				    </table>
					
				    </div>
				    <?php
	        	}
	        	else
	        		echo "Oops! This student has not logged-in to view/do any exercises yet!";
	        }
	    }
	}
	else {
	    echo "No data";
	}
}
mysql_close($conn);
?>
<div class="create-course-content"><div class="form-action">
<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewGroup.php', null)" type="button">Back View Learning Group</button>
</div></div>
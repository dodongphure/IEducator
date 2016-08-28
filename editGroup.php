<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["grID"])&&($_GET["type"]=="edit")){
	$sql = "SELECT * FROM groups WHERE grID=".$_POST["grID"];
	$result = mysql_query($sql, $conn);
	if (mysql_num_rows($result) > 0) {
	    while($row = mysql_fetch_assoc($result)) {
	        $stu=$row["stu"];
	        $dailyGr=$row["dailyGr"];
	        $timeCreated=$row["timeCreated"];
	    }

	}
	else {
	    echo "0 groups";
	}
	$stu=explode(",", $stu);
	$countDay = intval(calDayEx(date("Y-m-d H:i:s",time()), $timeCreated)) + 1;
	?>
	<section id="create-course-section" class="create-course-section"> 
	    <div class="row">          
	        <div class="col-md-12">
	            <div class="create-course-content">
					<form id="formEditGroup" method="post">
					<input type="hidden" name="grID" value="<?php echo $_POST['grID'] ?>">
					<div class="description create-item">
				        <div class="row">
				            <div class="col-md-3">
				                <h4>Username of students</h4>
				            </div>
				            <div class="col-md-9">
				            	<?php if($_POST["grID"]!=1){?>
				                <div class="description-editor text-form-editor">
				                    <div id="inputStu">
										<?php
										for($i=0; $i<count($stu); $i++){
											echo "<div id=\"stuName".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$stu[$i]."\" name=\"stu[]\">";
											echo "<a href=\"#action\" onclick=\"removeEleById('stuName".$i."')\"><i class=\"icon md-close-2\"></i> Remove this user</a></div>";
										}
										?>
										</div>
				                </div>
				                <a href="#action" class="add-instructor" onclick="addMoreStu()"><i class="icon md-plus"></i> Add more student</a>
				            	<?php }else echo "Guest members";?>
				            </div>
				        </div>
				    </div>
					<div class="promo-video create-item">
				        <div class="row">
				            <div class="col-md-3">
				                <h4>Current exercise day (>=1)</h4>
				            </div>
				            <div class="col-md-9">
			                    <div class="description-editor text-form-editor">
								<input type="number" class="" value=<?php echo $countDay?> name="countDay" autocomplete="off" min="1" max="99" required>
								</div>
				                
                                <input type="checkbox" class="showCheckBox" name="onlyChangeDay" onchange="document.getElementsByName('dailyGr')[0].disabled = this.checked ? true : false" checked>
                                Change only exercise day! (Not reset students' exercises)
				             </div>
				        </div>
				    </div>
				    <?php if($_POST["grID"]!=1){?>
				    <div class="promo-video create-item">
				        <div class="row">
				            <div class="col-md-3">
				                <h4>Exercises group ID</h4>
				            </div>
				            <div class="col-md-9">
				                    <div class="description-editor text-form-editor">
									<input type="text" class="" value=<?php echo $dailyGr?> name="dailyGr" autocomplete="off" disabled required>
									</div>
				                
				             </div>
				        </div>
				    </div>
				    <?php } else{?>
				    <input type="hidden" name="dailyGr" value="<?php echo $dailyGr ?>">
				    <?php }?>
					</form>
					<div class="form-action">
						<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewGroup.php', null)" type="button">Back</button>
	                    <button class="submit mc-btn-3 btn-style-1" onclick="loadAction('editGroup.php?type=submit','formEditGroup')" type="button">Submit</button>
	                </div>
				</div>
			</div>
		</div>
	</section>
	<?php 
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["grID"])&&!empty($_POST["countDay"])&&($_GET["type"]=="submit")){
	$sql = "SELECT timeCreated FROM groups WHERE grID =".$_POST["grID"]." LIMIT 1";
	$result = mysql_query($sql, $conn);
	if (mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_assoc($result)) {
			$timeCreated=$row["timeCreated"];
		}
	}
	$countDay = intval(calDayEx(date("Y-m-d H:i:s",time()), $timeCreated)) + 1;
	$timeAdjust = intval($_POST["countDay"]) - $countDay;
	if($timeAdjust >= 0)
		$timeCreated = date("Y-m-d H:i:s", strtotime($timeCreated .' -'.$timeAdjust.' day'));
	else{
		$timeAdjust = abs($timeAdjust);
		$timeCreated = date("Y-m-d H:i:s", strtotime($timeCreated .' +'.$timeAdjust.' day'));
	}

	if(isset($_POST["onlyChangeDay"])){
		$sql = "UPDATE groups SET timeCreated = \"".$timeCreated."\" WHERE grID =".$_POST["grID"];
		if (mysql_query($sql, $conn))
		    echo "<br>Update group successfully!";
		else
		    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
	}
	else {
		if($_POST["grID"]==1){
			$sql = "UPDATE groups SET timeCreated = \"".$timeCreated."\" WHERE grID =".$_POST["grID"];
			if (mysql_query($sql, $conn)) {
			    echo "Update successfully<br>";
			    //list all guests
			    $sql = "SELECT * FROM students WHERE role='Guest'";
			    $result = mysql_query($sql, $conn);
			    if (mysql_num_rows($result) > 0) {
			       	while($row = mysql_fetch_assoc($result)) {
			       		$scores = $row["scores"];
			            if($scores!=null){
			            	$scores = json_decode($scores, true);
		                    foreach ($scores as $key_1 => $value_1) {
		                        foreach ($value_1 as $key_2 => $value_2) {
		                            if(substr($key_2, 0, 3)=='ex5'){
		                                $delete_query = "DELETE FROM ex5wr WHERE id =".$value_2['score'];
		                                if (mysql_query($delete_query, $conn)) {
		                                    //echo "Record deleted successfully<br>";
		                                }
		                                else {
		                                    //echo "Error deleting record: " . mysql_error($conn);
		                                }
		                            }else if(isExViewer(substr($key_2, 0, 3))){
		                                $delete_query = "DELETE FROM studentData WHERE id =".$value_2['score'];
		                                if (mysql_query($delete_query, $conn)) {
		                                    //echo "Record deleted successfully<br>";
		                                }
		                                else {
		                                    //echo "Error deleting record: " . mysql_error($conn);
		                                }
		                            }
		                        }
		                    }
		                }
			            $sql = "UPDATE students SET scores = NULL, grID = 1 WHERE stuID=".$row["stuID"];
				    	if (mysql_query($sql, $conn)) {
				    		//echo "Assign exercises successfully<br>";
				    	} else{
				    		echo "Error: " . $sql . "<br>" . mysql_error($conn);
				    	}
			        }
			    }
			} else {
			    echo "Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
		else if (!empty($_POST["dailyGr"])&&!empty($_POST["stu"])){
			$data = array('deleteRecord' => $_POST["grID"]);
			$postString = http_build_query($data, '', '&');
			$opts = array('http' =>
			    array(
			        'method'  => 'POST',
			        'header'  => 'Content-type: application/x-www-form-urlencoded',
			        'content' => $postString
			    )
			);
			$context = stream_context_create($opts);
			$result = file_get_contents($_SITE_URL_PATH.'viewGroup.php', false, $context);

			$data = array('stu' => $_POST["stu"], 'dailyGr' => $_POST["dailyGr"], 'timeCreated' => $timeCreated);
			$postString = http_build_query($data, '', '&');
			$opts = array('http' =>
			    array(
			        'method'  => 'POST',
			        'header'  => 'Content-type: application/x-www-form-urlencoded',
			        'content' => $postString
			    )
			);
			$context = stream_context_create($opts);
			$result = file_get_contents($_SITE_URL_PATH.'addGroup.php', false, $context);
			echo "Update group successfully!";
		}
	}
}
mysql_close($conn); ?>
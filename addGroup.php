<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
?>
<!-- <form id="formAddGroup" method="post">
<div id="">Fill username of students</div>
<div id="inputStu">
<input type="text" class="form-control" placeholder="Username of student" name="stu[]" autocomplete="off" required>
</div>
<a href="#action" onclick="addMoreStu()">Add more student</a>
<br>
<div id="">Fill ID of exercises</div>
<div id="inputEx">
<select id="selectEx" name="exType[]">
  <option value="ex1">Exercise 1</option>
  <option value="ex2">Exercise 2</option>
  <option value="ex3">Exercise 3</option>
  <option value="ex4">Exercise 4</option>
  <option value="ex5">Exercise 5</option>
</select>
<input type="text" class="" placeholder="ID of exercise" name="ex[]" autocomplete="off" required>
</div>
<a href="#action" onclick="addMoreEx(document.getElementsByTagName('select').length)">Add more exercise</a>
</form>
<div id="uploadButton"><button onclick="loadAction('addGroup.php','formAddGroup')" type="button">Submit</button></div> -->
<section id="create-course-section" class="create-course-section"> 
    <div class="row">          
        <div class="col-md-12">
            <div class="create-course-content">
            	<form id="formAddGroup" method="post">            	
                <div class="description create-item">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Username of students</h4>
                        </div>
                        <div class="col-md-9">
                            <div class="description-editor text-form-editor">
                                <div id="inputStu">
								<input type="text" class="form-control" placeholder="Username of student" name="stu[]" autocomplete="off" required>
								</div>
								
                            </div>
                            <a href="#action" class="add-instructor" onclick="addMoreStu()"><i class="icon md-plus"></i> Add more student</a>
                        </div>
                    </div>
                </div>
              
                <div class="promo-video create-item">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Exercises group ID</h4>
                        </div>
                        <div class="col-md-9">
                                <div class="description-editor text-form-editor">
								<input type="text" class="" placeholder="ID" name="dailyGr" autocomplete="off" required>
								</div>
                            
                         </div>
                    </div>
                </div>
                </form>
                <div class="form-action">
                    <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('addGroup.php','formAddGroup')" type="button">Submit</button>
                </div>
                
            </div>
        </div>
    </div>     
</section>
<?php 
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["stu"])&&!empty($_POST['dailyGr'])) {
	if(array_filter($_POST["stu"])){
		$stuArr = implode(",", $_POST["stu"]);
		if(!empty($_POST['timeCreated']))
			$timeCreated = $_POST['timeCreated'];
		else
			$timeCreated=date("Y-m-d H:i:s",time());
		$sql = "INSERT INTO groups (stu, dailyGr, timeCreated) VALUES (\"".$stuArr."\",\"".$_POST['dailyGr']."\", \"".$timeCreated."\")";
		if (mysql_query($sql, $conn)) {
		    echo "Submit successfully<br>";
		    $last_id = mysql_insert_id($conn);

		    foreach ($_POST["stu"] as $stuName) {
		    	//delete writing
		    	$query = mysql_query("select grID, scores from students where username='".$stuName."'", $conn);
			    if($query === FALSE) { 
			        die(mysql_error());
			    }
			    $rows = mysql_num_rows($query);
			    if($rows == 1){
			    	$row = mysql_fetch_assoc($query);
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
	                            } else if(isExViewer(substr($key_2, 0, 3))){
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
		            $group = $row["grID"];
		            if($group!=null)
		            	echo "Notice: <strong>$stuName</strong> has already had a group, but still be assigned in this new group. Please delete his/her old groups<br>";
			    }

		    	$sql = "UPDATE students SET scores = NULL, grID = '$last_id' WHERE username='$stuName'";
		    	if (mysql_query($sql, $conn)) {
		    		//echo "Assign exercises successfully<br>";
		    	} else{
		    		echo "Error: " . $sql . "<br>" . mysql_error($conn);
		    	}
		    	
			    //initial scores
		  //   	$arrNull = array();
				// for ($i = 0; $i < count($ex); $i++) {
				//     $arrNull[$i] = "";
				// }
				// $score = array_combine($ex, $arrNull);
				// $score = json_encode($score);
				// $sql = "UPDATE students SET scores = '$score' WHERE username='$stuName'";
		  //   	if (mysql_query($sql, $conn)) {
		  //   		echo "Update scores successfully";
		  //   	} else{
		  //   		echo "Error: " . $sql . "<br>" . mysql_error($conn);
		  //   	}
		    }
		} else {
		    echo "Error: " . $sql . "<br>" . mysql_error($conn);
		}
		
	}
	


	mysql_close($conn);
}
?>
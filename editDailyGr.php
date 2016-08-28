<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["grID"])&&($_GET["type"]=="edit")){
	$sql = "SELECT * FROM dailyGr WHERE id=".$_POST["grID"];
	$result = mysql_query($sql, $conn);
	if (mysql_num_rows($result) > 0) {
	    while($row = mysql_fetch_assoc($result)) {
	        $dailyEx=$row["dailyEx"];
	    }

	}
	else {
	    echo "0 groups";
	}
	$dailyEx=explode(",", $dailyEx);
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
				                <h4>Exercises Day ID</h4>
				            </div>
				            <div class="col-md-9">
				                <div class="description-editor text-form-editor">
				                    <div id="inputEx">
										<?php
										for($i=0; $i<count($dailyEx); $i++){
											echo "<div id=\"dailyEx".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$dailyEx[$i]."\" name=\"dailyEx[]\">";
											echo "<a href=\"#action\" onclick=\"removeEleById('dailyEx".$i."')\"><i class=\"icon md-close-2\"></i> Remove this ID</a></div>";
										}
										?>
										</div>
				                </div>
				                <a href="#action" class="add-instructor" onclick="addMoreDailyEx()"><i class="icon md-plus"></i> Add more Exercises Day</a>
				            </div>
				        </div>
				    </div>
					</form>
					<div class="form-action">
						<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewDailyGr.php', null)" type="button">Back</button>
	                    <button class="submit mc-btn-3 btn-style-1" onclick="loadAction('editDailyGr.php?type=submit','formEditGroup')" type="button">Submit</button>
	                </div>
				</div>
			</div>
		</div>
	</section>
	<?php
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["grID"])&&!empty($_POST["dailyEx"])&&($_GET["type"]=="submit")){
	if($_POST["grID"] == 1){
		if(array_filter($_POST["dailyEx"])){
			$dailyEx = implode(",", $_POST["dailyEx"]);
			$sql = "UPDATE  dailyGr SET dailyEx = \"".$dailyEx."\" WHERE id=1";
			if (mysql_query($sql, $conn)) {
			    echo "Edit successfully<br>";
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
		                                $delete_query = "DELETE FROM ex5wr WHERE id =".$value_2;
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
	}
	else{
		$dailyEx = implode(",", $_POST["dailyEx"]);
		$sql = "UPDATE dailyGr SET dailyEx=\"".$dailyEx."\" WHERE id =".$_POST["grID"];
		if (mysql_query($sql, $conn)) {
		    echo "Update Exercise group successfully!";
		}
		else {
		    echo "Error: " . $sql . "<br>" . mysql_error($conn);
		}
		// $data = array('deleteRecord' => $_POST["grID"]);
		// $postString = http_build_query($data, '', '&');
		// $opts = array('http' =>
		//     array(
		//         'method'  => 'POST',
		//         'header'  => 'Content-type: application/x-www-form-urlencoded',
		//         'content' => $postString
		//     )
		// );
		// $context = stream_context_create($opts);
		// $result = file_get_contents($_SITE_URL_PATH.'viewDailyGr.php', false, $context);

		// $data = array('dailyEx' => $_POST["dailyEx"]);
		// $postString = http_build_query($data, '', '&');
		// $opts = array('http' =>
		//     array(
		//         'method'  => 'POST',
		//         'header'  => 'Content-type: application/x-www-form-urlencoded',
		//         'content' => $postString
		//     )
		// );
		// $context = stream_context_create($opts);
		// $result = file_get_contents($_SITE_URL_PATH.'addDailyGr.php', false, $context);
		// if($result === FALSE){
		// 	echo "An error has happened";
		// }else{
		// 	echo "Update group successfully!<br><br>You should also update Learning Groups containing this Exercise group if needed.";
		// }
	}
}
mysql_close($conn);
?>
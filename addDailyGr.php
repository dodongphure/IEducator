<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
?>
<section id="create-course-section" class="create-course-section"> 
    <div class="row">          
        <div class="col-md-12">
            <div class="create-course-content">
            	<form id="formAddGroup" method="post">            	
                <div class="description create-item">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>ID of Exercises Day</h4>
                        </div>
                        <div class="col-md-9">
                            <div class="description-editor text-form-editor">
                                <div id="inputEx">
								<input type="text" class="form-control" placeholder="ID" name="dailyEx[]" autocomplete="off" required>
								</div>
								
                            </div>
                            <a href="#action" class="add-instructor" onclick="addMoreDailyEx()"><i class="icon md-plus"></i> Add more Exercises Day</a>
                        </div>
                    </div>
                </div>
                </form>
                <div class="form-action">
                    <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('addDailyGr.php','formAddGroup')" type="button">Submit</button>
                </div>
                
            </div>
        </div>
    </div>     
</section>
<?php 
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["dailyEx"])) {
	if(array_filter($_POST["dailyEx"])){
		$dailyEx = implode(",", $_POST["dailyEx"]);
		$sql = "INSERT INTO dailyGr (dailyEx) VALUES (\"".$dailyEx."\")";
		if (mysql_query($sql, $conn)) {
		    echo "Submit successfully<br>";
		} else {
		    echo "Error: " . $sql . "<br>" . mysql_error($conn);
		}
	}

	mysql_close($conn);
}
?>
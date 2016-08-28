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
              
                <div class="promo-video create-item">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>ID of exercises</h4>
                        </div>
                        <div class="col-md-9">
                            <div id="inputEx">
                                <div class="form-question mc-select">
								<select class="select" id="selectEx" name="exType[]">
								  <option value="ex1">Exercise 1 (VOA)</option>
								  <option value="ex2">Exercise 2 (BBC)</option>
								  <option value="ex3">Exercise 3 (Listening)</option>
								  <option value="ex4">Exercise 4 (Reading)</option>
								  <option value="ex6">Exercise 5 (Reading Keywords)</option>
								  <option value="ex5">Exercise 6 (Writing)</option>
								  <option value="ex7">Exercise 7 (Grammar)</option>
								  <option value="ex8">Exercise 8 (Movies)</option>
								  <option value="ex9">Exercise 9 (Toeic Listening)</option>
								  <option value="ex10">Exercise 10 (Toeic Reading)</option>
								</select>
								</div>
                                <div class="description-editor text-form-editor">
                                   

								<input type="text" class="" placeholder="ID of exercise" name="ex[]" autocomplete="off" required>
								</div>
                                
                            </div>
                            <a href="#action" class="add-instructor" onclick="addMoreEx(document.getElementsByTagName('select').length)"><i class="icon md-plus"></i> Add more exercise</a>
                        </div>
                    </div>
                </div>
                
                </form>
                <div class="form-action">
                    <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('addDailyEx.php','formAddGroup')" type="button">Submit</button>
                </div>
                
            </div>
        </div>
    </div>     
</section>
<?php  
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST['ex'])&&!empty($_POST['exType'])) {
	if(array_filter($_POST['ex'])&&array_filter($_POST['exType'])){
		$ex = $_POST['ex'];
		$exType = $_POST['exType'];
		foreach ($ex as $key => &$value) {
			$value = $exType[$key].".".$value;
		}
		$exArr = implode(",", $ex);
		$sql = "INSERT INTO dailyEx (ex) VALUES (\"".$exArr."\")";
		if (mysql_query($sql, $conn)) {
			echo "Submit successfully<br>";
		}
		 else {
		    echo "Error: " . $sql . "<br>" . mysql_error($conn);
		}
	}
}
mysql_close($conn);
?>
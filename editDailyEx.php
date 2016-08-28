<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["grID"])&&($_GET["type"]=="edit")){
	$sql = "SELECT * FROM dailyEx WHERE id=".$_POST["grID"];
	$result = mysql_query($sql, $conn);
	if (mysql_num_rows($result) > 0) {
	    while($row = mysql_fetch_assoc($result)) {
	        $ex=$row["ex"];
	    }

	}
	else {
	    echo "0 groups";
	}
	$ex=explode(",", $ex);
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
				                <h4>ID of exercises</h4>
				            </div>
				            <div class="col-md-9">
				                <div class="description-editor text-form-editor">
				                    <div id="inputEx">
										<?php
										for($i=0; $i<count($ex); $i++){
											echo "<div id=\"exName".$i."\">";
											?>
											<div class="form-question mc-select">
											<select class="select" id="selectEx" name="exType[]">
											  <option value="ex1" <?php if(explode(".",$ex[$i])[0]=="ex1")echo "selected" ?>>Exercise 1 (VOA)</option>
											  <option value="ex2" <?php if(explode(".",$ex[$i])[0]=="ex2")echo "selected" ?>>Exercise 2 (BBC)</option>
											  <option value="ex3" <?php if(explode(".",$ex[$i])[0]=="ex3")echo "selected" ?>>Exercise 3 (Listening)</option>
											  <option value="ex4" <?php if(explode(".",$ex[$i])[0]=="ex4")echo "selected" ?>>Exercise 4 (Reading)</option>
											  <option value="ex6" <?php if(explode(".",$ex[$i])[0]=="ex6")echo "selected" ?>>Exercise 5 (Reading Keywords)</option>
											  <option value="ex5" <?php if(explode(".",$ex[$i])[0]=="ex5")echo "selected" ?>>Exercise 6 (Writing)</option>
											  <option value="ex7" <?php if(explode(".",$ex[$i])[0]=="ex7")echo "selected" ?>>Exercise 7 (Grammar)</option>
											  <option value="ex8" <?php if(explode(".",$ex[$i])[0]=="ex8")echo "selected" ?>>Exercise 8 (Movies)</option>
											  <option value="ex9" <?php if(explode(".",$ex[$i])[0]=="ex9")echo "selected" ?>>Exercise 9 (Toeic Listening)</option>
											  <option value="ex10" <?php if(explode(".",$ex[$i])[0]=="ex10")echo "selected" ?>>Exercise 10 (Toeic Reading)</option>
											</select>
											</div>
											<input type="text" class="" value=<?php echo explode(".",$ex[$i])[1] ?> name="ex[]" autocomplete="off" required>
											<?php
											
											echo "<a href=\"#action\" onclick=\"removeEleById('exName".$i."')\"><i class=\"icon md-close-2\"></i> Remove this exercise</a>";
											echo "</div>";

										}
										?>
									</div>
				                </div>
				                <a href="#action" class="add-instructor" onclick="addMoreEx(document.getElementsByTagName('select').length)"><i class="icon md-plus"></i> Add more exercise</a>
				            </div>
				        </div>
				    </div>
					</form>
					<div class="form-action">
	                    <button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewDailyEx.php', null)" type="button">Back</button>
	                    <button class="submit mc-btn-3 btn-style-1" onclick="loadAction('editDailyEx.php?type=submit','formEditGroup')" type="button">Submit</button>
	                </div>
				</div>
			</div>
		</div>
	</section>
<?php
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["grID"])&&!empty($_POST["exType"])&&!empty($_POST["ex"])&&($_GET["type"]=="submit")){
	$ex = $_POST['ex'];
	$exType = $_POST['exType'];
	foreach ($ex as $key => &$value) {
		$value = $exType[$key].".".$value;
	}
	$exArr = implode(",", $ex);
	$sql = "UPDATE dailyEx SET ex=\"".$exArr."\" WHERE id =".$_POST["grID"];
	if (mysql_query($sql, $conn)) {
	    echo "Update Exercise group successfully!<br><br>You should also update Exercises Groups containing this Exercise group if needed.";
	    }
	else {
	    echo "Error: " . $sql . "<br>" . mysql_error($conn);
	}
}
mysql_close($conn); ?>
	
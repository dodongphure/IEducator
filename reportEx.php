<?php
require_once 'config.php';
if($user["role"]==$_ADMIN_CODE){
	header("location: admin.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["exID"])){
	$exID = $_POST["exID"];
	if(($_GET["type"]=="submit")&&!empty($_POST["stuName"])&&!empty($_POST["content"])){
		$content = checkText($_POST["content"]);
        $stuName = checkText($_POST["stuName"]);
		$sql = "INSERT INTO exReport (exID, stuName, content) VALUES (\"".explode('-', $exID)[1]."\", \"".$stuName."\", \"".$content."\")";
		if (mysql_query($sql, $conn)) {
		    echo "Submit successfully!";
		    ?>
		    <div class="form-action" style="text-align:center">
		    	<button class="submit mc-btn-3 btn-style-1" onclick="loadEx('<?php echo $exID?>')" type="button">Back</button>
		    </div>
		    <?php
		} else {
		    //echo "Error: " . $sql . "<br>" . mysql_error($conn);
		}
	}else if($_GET["type"]=="edit"){
		echo "<strong>Report Problems For: ".convertExName(explode('-', $exID)[1])."</strong>";
		?>
		<section id="create-course-section" class="create-course-section">		        
        <div class="row">		                 
            <div class="col-md-12">
                <div class="create-course-content">
                	<form id="formReportEx" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="stuName" value="<?php echo $_SESSION['login']?>">
                	<input type="hidden" name="exID" value="<?php echo $exID; ?>">
                    <div class="description create-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="description-editor text-form-editor">
                                    <textarea class="inputChecking" name="content" style="overflow:auto" placeholder="Describes any errors about this exercise. This message will be sent to your teacher." maxlength="200" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="form-action">
                    	<button class="submit mc-btn-3 btn-style-1" onclick="loadEx('<?php echo $exID?>')" type="button">Back</button>
                        <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="confirmLoadAction('reportEx.php?type=submit', 'formReportEx')" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    	</section>
		<?php
	}
}
mysql_close($conn);
?>
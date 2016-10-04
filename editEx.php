<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["grID"])){
	$Ex = explode(".", $_POST["grID"])[0];
	$exID = intval(explode(".", $_POST["grID"])[1]);
	echo "<strong>Edit Exercise ".convertEx($Ex)."</strong>";
	switch ($Ex) {
		case '1':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex1 WHERE ex1ID=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $textScript=$row["textScript"];
			        $audioScript=$row["audioScript"];
			    } ?>
			    <section id="create-course-section" class="create-course-section">		        
		            <div class="row">		                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<input type="hidden" name="deleteFile" value="<?php echo $audioScript?>">
		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Text Script</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                        <textarea name="textScript" style="overflow:auto" required><?php echo $textScript?></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                      
		                        <div class="promo-video create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Upload Audio Script</h4>
		                                    (If new audio is uploaded, the old audio will be deleted)
		                                </div>
		                                <div class="col-md-9">
		                                    <audio controls><source src="<?php echo $audioScript ?>" type="audio/mpeg"></audio>
		                                    <div class="upload-video up-file">
		                                    </div><input type="file" name="fileToUpload" accept="audio/*" id="fileToUpload">
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                        <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=1', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>
			    </section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST["textScript"])){
			$sql="";
			if(($_FILES["fileToUpload"]["size"]>0)&&!empty($_POST["deleteFile"])){
				if (file_exists($_POST["deleteFile"])) {
					if (!unlink($_POST["deleteFile"]))
	                    echo ("Error deleting old file!<br>");
            	}
            	else{
            		//echo "Old file does not exist!";
            	}
                //upload new file
                $target_dir = "media/".date('Y')."/".date('m')."/";
				if (!file_exists($target_dir)) {
				    mkdir($target_dir, 0777, true);
				}
				$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
				
				$uploadOk = 1;
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.<br>";
				    $uploadOk = 0;
				}
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.<br>";
				}
				else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				    	$target_file = checkText($target_file);
				        $sql="UPDATE ex1 SET textScript='".$_POST["textScript"]."',audioScript='".$target_file."',timeCreated='".date("Y-m-d H:i:s",time())."' WHERE ex1ID=".$exID;
				    }
				    else {
				        echo "Sorry, there was an error uploading your file.<br>";
				    }
				}
			}else{
				$sql="UPDATE ex1 SET textScript=\"".$_POST["textScript"]."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE ex1ID=".$exID;
			}

			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
			break;
		
		case '2':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex2 WHERE ex2ID=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $title=$row["title"];
			        $audioScript=$row["audioScript"];
			        $questions = explode("*/*", $row["questions"]);
			        $answer = explode("*/*", $row["answer"]);
			    } ?>
			    <section id="create-course-section" class="create-course-section">        
		            <div class="row">                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<input type="hidden" name="deleteFile" value="<?php echo $audioScript?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Title</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $title?>" name="title">
										</div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Questions</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="inputQuestion">
		                                    <?php
		                                    for($i=0; $i<count($questions); $i++){
		                                    	echo "<div id=\"questions".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$questions[$i]."\" name=\"question[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('questions".$i."')\"><i class=\"icon md-close-2\"></i> Remove this question</a></div>";
		                                    }
		                                    ?>
											</div>
											<a href="#action" onclick="addMoreQuestion()"><i class="icon md-plus"></i> Add more questions</a>
		                                </div>
		                            </div>
		                        </div>
		                      
		                        <div class="promo-video create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Upload Audio Script</h4>
		                                    (If new audio is uploaded, the old audio will be deleted)
		                                </div>
		                                <div class="col-md-9">
		                                    <audio controls><source src="<?php echo $audioScript ?>" type="audio/mpeg"></audio>
		                                    <div class="upload-video up-file">
		                                        <!-- <a href="#"><i class="icon md-upload"></i>Upload audio</a> -->
		                                        
		                                    </div><input type="file" name="fileToUpload" id="fileToUpload" accept="audio/*">
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Answers</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="answer">
											<?php
		                                    for($i=0; $i<count($answer); $i++){
		                                    	echo "<div id=\"answer".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$answer[$i]."\" name=\"ans[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('answer".$i."')\"><i class=\"icon md-close-2\"></i> Remove this answer</a></div>";
		                                    }?>
											</div>
											<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=2', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['question'])&&!empty($_POST['ans'])&&!empty($_POST['title'])){
			$sql="";
			$questionArr = implode("*/*", $_POST["question"]);
			$ansArr = implode("*/*", $_POST["ans"]);
			if(($_FILES["fileToUpload"]["size"]>0)&&!empty($_POST["deleteFile"])){
				if (file_exists($_POST["deleteFile"])) {
					if (!unlink($_POST["deleteFile"]))
	                    echo ("Error deleting old file!<br>");
            	}
            	else
            		echo "Old file does not exist!";
                //upload new file
                $target_dir = "media/".date('Y')."/".date('m')."/";
				if (!file_exists($target_dir)) {
				    mkdir($target_dir, 0777, true);
				}
				$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
				
				$uploadOk = 1;
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.<br>";
				    $uploadOk = 0;
				}
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.<br>";
				}
				else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				    	$target_file = checkText($target_file);
				        $sql="UPDATE ex2 SET title='".$_POST["title"]."',audioScript='".$target_file."',questions='".$questionArr."',answer='".$ansArr."',timeCreated='".date("Y-m-d H:i:s",time())."' WHERE ex2ID=".$exID;
				    }
				    else {
				        echo "Sorry, there was an error uploading your file.<br>";
				    }
				}
			}else{
				$sql="UPDATE ex2 SET title=\"".$_POST["title"]."\",questions=\"".$questionArr."\",answer=\"".$ansArr."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE ex2ID=".$exID;
			}

			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}	
			break;
		
		case '3':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex3 WHERE ex3ID=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $title=$row["title"];
			        $audioScript=$row["audioScript"];
			        $questions = explode("*/*", $row["questions"]);
			        $answer = explode("*/*", $row["answer"]);
			    } ?>
			    <section id="create-course-section" class="create-course-section">        
		            <div class="row">                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<input type="hidden" name="deleteFile" value="<?php echo $audioScript?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Title</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $title?>" name="title">
										</div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Questions</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="inputQuestion">
		                                    <?php
		                                    for($i=0; $i<count($questions); $i++){
		                                    	echo "<div id=\"questions".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$questions[$i]."\" name=\"question[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('questions".$i."')\"><i class=\"icon md-close-2\"></i> Remove this question</a></div>";
		                                    }
		                                    ?>
											</div>
											<a href="#action" onclick="addMoreQuestion()"><i class="icon md-plus"></i> Add more questions</a>
		                                </div>
		                            </div>
		                        </div>
		                      
		                        <div class="promo-video create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Upload Audio Script</h4>
		                                    (If new audio is uploaded, the old audio will be deleted)
		                                </div>
		                                <div class="col-md-9">
		                                    <audio controls><source src="<?php echo $audioScript ?>" type="audio/mpeg"></audio>
		                                    <div class="upload-video up-file">
		                                        <!-- <a href="#"><i class="icon md-upload"></i>Upload audio</a> -->
		                                        
		                                    </div><input type="file" name="fileToUpload" id="fileToUpload" accept="audio/*">
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Answers</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="answer">
											<?php
		                                    for($i=0; $i<count($answer); $i++){
		                                    	echo "<div id=\"answer".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$answer[$i]."\" name=\"ans[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('answer".$i."')\"><i class=\"icon md-close-2\"></i> Remove this answer</a></div>";
		                                    }?>
											</div>
											<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=3', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['question'])&&!empty($_POST['ans'])&&!empty($_POST['title'])){
			$sql="";
			$questionArr = implode("*/*", $_POST["question"]);
			$ansArr = implode("*/*", $_POST["ans"]);
			if(($_FILES["fileToUpload"]["size"]>0)&&!empty($_POST["deleteFile"])){
				if (file_exists($_POST["deleteFile"])) {
					if (!unlink($_POST["deleteFile"]))
	                    echo ("Error deleting old file!<br>");
            	}
            	else
            		echo "Old file does not exist!";
                //upload new file
                $target_dir = "media/".date('Y')."/".date('m')."/";
				if (!file_exists($target_dir)) {
				    mkdir($target_dir, 0777, true);
				}
				$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
				
				$uploadOk = 1;
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.<br>";
				    $uploadOk = 0;
				}
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.<br>";
				}
				else {

				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				    	$target_file = checkText($target_file);
				        $sql="UPDATE ex3 SET title='".$_POST["title"]."',audioScript='".$target_file."',questions='".$questionArr."',answer='".$ansArr."',timeCreated='".date("Y-m-d H:i:s",time())."' WHERE ex3ID=".$exID;
				    }
				    else {
				        echo "Sorry, there was an error uploading your file.<br>";
				    }
				}
			}else{
				$sql="UPDATE ex3 SET title=\"".$_POST["title"]."\",questions=\"".$questionArr."\",answer=\"".$ansArr."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE ex3ID=".$exID;
			}

			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
			break;

		case '4':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex4 WHERE ex4ID=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $title=$row["title"];
			        $answer = explode("*/*", $row["answer"]);
			    } ?>
			    <section id="create-course-section" class="create-course-section">        
		            <div class="row">                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Title</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $title?>" name="title">
										</div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Answers</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="answer">
											<?php
		                                    for($i=0; $i<count($answer); $i++){
		                                    	echo "<div id=\"answer".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$answer[$i]."\" name=\"ans[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('answer".$i."')\"><i class=\"icon md-close-2\"></i> Remove this answer</a></div>";
		                                    }?>
											</div>
											<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=4', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['ans'])&&!empty($_POST['title'])){
			$ansArr = implode("*/*", $_POST["ans"]);

			$sql="UPDATE ex4 SET title=\"".$_POST["title"]."\",answer=\"".$ansArr."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE ex4ID=".$exID;
			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
			break;

		case '5':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex5 WHERE ex5ID=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $topic=$row["topic"];
			    } ?>
			    <section id="create-course-section" class="create-course-section">        
		            <div class="row">                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Topic</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                        <textarea name="topicName" required><?php echo $topic?></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=5', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['topicName'])){
			$sql="UPDATE ex5 SET topic=\"".$_POST["topicName"]."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE ex5ID=".$exID;
			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
		break;

		case '6':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex6 WHERE id=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $title=$row["title"];
			        $keywords = explode("*/*", $row["keywords"]);
			        $answer = explode("*/*", $row["answer"]);
			    } ?>
			    <section id="create-course-section" class="create-course-section">        
		            <div class="row">                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Title</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $title?>" name="title">
										</div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Keywords</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="inputKeyword">
											<?php
		                                    for($i=0; $i<count($keywords); $i++){
		                                    	echo "<div id=\"keywords".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$keywords[$i]."\" name=\"keyword[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('keywords".$i."')\"><i class=\"icon md-close-2\"></i> Remove this keyword</a></div>";
		                                    }?>
											</div>
											<a href="#action" onclick="addMoreKeyword()"><i class="icon md-plus"></i> Add more keyword</a>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4>Answers</h4>
                                        </div>
                                        <div class="col-md-9">
                                            <div id="answer">
                                            <?php
                                            for($i=0; $i<count($answer); $i++){
                                                echo "<div id=\"answer".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$answer[$i]."\" name=\"ans[]\">";
                                                echo "<a href=\"#action\" onclick=\"removeEleById('answer".$i."')\"><i class=\"icon md-close-2\"></i> Remove this answer</a></div>";
                                            }?>
                                            </div>
                                            <a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
                                        </div>
                                    </div>
                                </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=6', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['keyword'])&&!empty($_POST['ans'])&&!empty($_POST['title'])){
			$keywordArr = implode("*/*", $_POST["keyword"]);
			$ansArr = implode("*/*", $_POST["ans"]);
			$sql="UPDATE ex6 SET title=\"".$_POST["title"]."\",keywords=\"".$keywordArr."\",answer=\"".$ansArr."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE id=".$exID;
			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
			break;

		case '7':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex7 WHERE id=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $title=$row["title"];
			        $answer = explode("*/*", $row["answer"]);
			    } ?>
			    <section id="create-course-section" class="create-course-section">        
		            <div class="row">                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Title</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $title?>" name="title">
										</div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Keywords</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="answer">
											<?php
		                                    for($i=0; $i<count($answer); $i++){
		                                    	echo "<div id=\"answer".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$answer[$i]."\" name=\"ans[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('answer".$i."')\"><i class=\"icon md-close-2\"></i> Remove this answer</a></div>";
		                                    }?>
											</div>
											<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answer</a>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=7', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['ans'])&&!empty($_POST['title'])){
			$answerArr = implode("*/*", $_POST["ans"]);

			$sql="UPDATE ex7 SET title=\"".$_POST["title"]."\",answer=\"".$answerArr."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE id=".$exID;
			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
			break;

		case '8':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex8 WHERE id=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $title=$row["title"];
			        $link=$row["link"];
			    } ?>
			    <section id="create-course-section" class="create-course-section">        
		            <div class="row">                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Title</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $title?>" name="title">
										</div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Link</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $link?>" name="link">
										</div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=8', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['link'])&&!empty($_POST['title'])){
			$sql="UPDATE ex8 SET title=\"".$_POST["title"]."\",link=\"".$_POST['link']."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE id=".$exID;
			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
			break;

		case '9':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex9 WHERE id=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $title=$row["title"];
			        $pictureLink = $row["pictureLink"];
			        $audioScript=$row["audioScript"];
			        $questions = explode("*/*", $row["questions"]);
			        $answer = explode("*/*", $row["answer"]);
			    } ?>
			    <section id="create-course-section" class="create-course-section">        
		            <div class="row">                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<input type="hidden" name="deleteFile" value="<?php echo $audioScript?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Title</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $title?>" name="title">
										</div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Questions</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="inputQuestion">
		                                    <?php
		                                    for($i=0; $i<count($questions); $i++){
		                                    	echo "<div id=\"questions".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$questions[$i]."\" name=\"question[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('questions".$i."')\"><i class=\"icon md-close-2\"></i> Remove this question</a></div>";
		                                    }
		                                    ?>
											</div>
											<a href="#action" onclick="addMoreQuestion()"><i class="icon md-plus"></i> Add more questions</a>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Picture link</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $pictureLink?>" name="pictureLink">
										</div>
		                            </div>
		                        </div>
		                      
		                        <div class="promo-video create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Upload Audio Script</h4>
		                                    (If new audio is uploaded, the old audio will be deleted)
		                                </div>
		                                <div class="col-md-9">
		                                    <audio controls><source src="<?php echo $audioScript ?>" type="audio/mpeg"></audio>
		                                    <div class="upload-video up-file">
		                                        <!-- <a href="#"><i class="icon md-upload"></i>Upload audio</a> -->
		                                        
		                                    </div><input type="file" name="fileToUpload" id="fileToUpload" accept="audio/*">
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Answers</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="answer">
											<?php
		                                    for($i=0; $i<count($answer); $i++){
		                                    	echo "<div id=\"answer".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$answer[$i]."\" name=\"ans[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('answer".$i."')\"><i class=\"icon md-close-2\"></i> Remove this answer</a></div>";
		                                    }?>
											</div>
											<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=9', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['question'])&&!empty($_POST['ans'])&&!empty($_POST['title'])&&!empty($_POST['pictureLink'])){
			$sql="";
			$questionArr = implode("*/*", $_POST["question"]);
			$ansArr = implode("*/*", $_POST["ans"]);
			if(($_FILES["fileToUpload"]["size"]>0)&&!empty($_POST["deleteFile"])){
				if (file_exists($_POST["deleteFile"])) {
					if (!unlink($_POST["deleteFile"]))
	                    echo ("Error deleting old file!<br>");
            	}
            	else
            		echo "Old file does not exist!";
                //upload new file
                $target_dir = "media/".date('Y')."/".date('m')."/";
				if (!file_exists($target_dir)) {
				    mkdir($target_dir, 0777, true);
				}
				$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
				
				$uploadOk = 1;
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.<br>";
				    $uploadOk = 0;
				}
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.<br>";
				}
				else {

				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				    	$target_file = checkText($target_file);
				        $sql="UPDATE ex9 SET title='".$_POST["title"]."',pictureLink='".$_POST["pictureLink"]."',audioScript='".$target_file."',questions='".$questionArr."',answer='".$ansArr."',timeCreated='".date("Y-m-d H:i:s",time())."' WHERE id=".$exID;
				    }
				    else {
				        echo "Sorry, there was an error uploading your file.<br>";
				    }
				}
			}else{
				$sql="UPDATE ex9 SET title=\"".$_POST["title"]."\",pictureLink=\"".$_POST["pictureLink"]."\",questions=\"".$questionArr."\",answer=\"".$ansArr."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE id=".$exID;
			}

			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}
			break;

		case '10':
		if($_GET["type"]=="edit"){
			$sql = "SELECT * FROM ex10 WHERE id=".$exID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
			    while($row = mysql_fetch_assoc($result)) {
			        $title=$row["title"];
			        $questions = explode("*/*", $row["questions"]);
			        $answer = explode("*/*", $row["answer"]);
			    } ?>
			    <section id="create-course-section" class="create-course-section">
		            <div class="row">
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="grID" value="<?php echo $_POST["grID"]?>">
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Title</h4>
		                                </div>
		                                <div class="col-md-9">
											<input type="text" class="form-control" value="<?php echo $title?>" name="title">
										</div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Questions</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="inputQuestion">
		                                    <?php
		                                    for($i=0; $i<count($questions); $i++){
		                                    	echo "<div id=\"questions".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$questions[$i]."\" name=\"question[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('questions".$i."')\"><i class=\"icon md-close-2\"></i> Remove this question</a></div>";
		                                    }
		                                    ?>
											</div>
											<a href="#action" onclick="addMoreQuestion()"><i class="icon md-plus"></i> Add more questions</a>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Answers</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div id="answer">
											<?php
		                                    for($i=0; $i<count($answer); $i++){
		                                    	echo "<div id=\"answer".$i."\"><input type=\"text\" class=\"form-control\" value=\"".$answer[$i]."\" name=\"ans[]\">";
		                                    	echo "<a href=\"#action\" onclick=\"removeEleById('answer".$i."')\"><i class=\"icon md-close-2\"></i> Remove this answer</a></div>";
		                                    }?>
											</div>
											<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                       <div class="form-action">
		                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewEx.php?Ex=10', null)" type="button">Back</button>
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('editEx.php?type=submit', 'formEditGroup')" type="button">Submit</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>       
		    	</section>
			    <?php

			}
			else {
			    echo "0 exercises";
			}
		}else if(($_GET["type"]=="submit")&&!empty($_POST['question'])&&!empty($_POST['ans'])&&!empty($_POST['title'])){
			$sql="";
			$questionArr = implode("*/*", $_POST["question"]);
			$ansArr = implode("*/*", $_POST["ans"]);
			$sql="UPDATE ex10 SET title=\"".$_POST["title"]."\",questions=\"".$questionArr."\",answer=\"".$ansArr."\",timeCreated=\"".date("Y-m-d H:i:s",time())."\" WHERE id=".$exID;
			if($sql!=null){
				if (mysql_query($sql, $conn))
				    echo "<br>Update exercise successfully";
				else
				    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
			}
		}	
			break;
		
		default:
			# code...
			break;
	}
}
mysql_close($conn);
?>
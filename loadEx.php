<?php 
require_once 'config.php';
$stuID = $user['stuID'];
function change4to6($ex4){
	$first = explode("ex", $ex4);
	$second = $first[1];
	$ID = explode("\\.", $second)[1];
	return $first[0]."ex6.".$ID;
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["exID"])) {
	$exID = $_POST["exID"];
	$exID_1 = explode("-", $exID)[1];
	$exType = explode(".", $exID_1)[0];
	$ex = explode(".", $exID_1)[1];
	$query = mysql_query("select * from ".$exType." LIMIT ".($ex-1).", 1", $conn);
	$rows = mysql_num_rows($query);
	if($rows == 1){
		$row = mysql_fetch_assoc($query);
		if(intval(substr($exType, 2)) < 6)
			$ex=$row[$exType."ID"];
		else
			$ex=$row["id"];
	}
	switch ($exType) {
		case 'ex1':

			$sql = "SELECT * FROM ex1 WHERE ex1ID=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_assoc($result)) {
					$text = base64_encode($row["textScript"]);
					$audio = $row["audioScript"];
				}
				//echo "</table>";
				?>
				<button class="mc-btn btn-style-1" onclick="showScript('<?php echo checkText($text) ?>', <?php echo $stuID ?>, '<?php echo $exID ?>','<?php echo checkText($audio) ?>');" type="button" id="startBtn">Start</button><br>
				<div id="myVideo">
				
				</div>
				<div id="script">
					<h1>Script</h1>
					<p id="scriptResult" style="font-size:18px"></p>
				</div>
				<div id="answer">
				</div>
				<div id="result">
					<h1>Answers</h1>
				</div>
				

				
				<?php
			}
			else echo "No data!";
			break;

		case 'ex2':
			$sql = "SELECT * FROM ex2 WHERE ex2ID=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				echo "<h3 align=\"center\">".$row["title"]."</h3>";
				while($row = mysql_fetch_assoc($result)) {
					$question = $row["questions"];
					$audio = $row["audioScript"];
				}
				?>
				<button id="startBtn" class="mc-btn btn-style-1" onclick="playVid('<?php echo base64_encode($question) ?>', <?php echo $stuID ?>, '<?php echo $exID ?>')" type="button">Start</button><br> 
				<div id="question">
					<h1>Questions</h1>
					<p id="scriptResult"></p>
				</div>
				<div id="result">
					<h1>Answers</h1>
				</div>


				<audio id="myVideo" controls>
				<source src="<?php echo $audio ?>" type="audio/mpeg">
				Your browser does not support the audio element.
				</audio>
				<?php
			}
			else echo "No data!";
			break;

		case 'ex3':
			$sql = "SELECT * FROM ex3 WHERE ex3ID=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				echo "<h3 align=\"center\">".$row["title"]."</h3>";
				while($row = mysql_fetch_assoc($result)) {
					$question = $row["questions"];
					$question = explode("*/*", $question);
					$answer = base64_encode($row["answer"]);
					$audio = $row["audioScript"];
				}
				?>
				<audio id="myVideo" controls>
				<source src="<?php echo $audio ?>" type="audio/mpeg">
				Your browser does not support the audio element.
				</audio>
				<div id="question">
					<h1>Questions</h1>
					<?php  
					for($i=0; $i<count($question); $i++){
						echo ($i+1).". ".$question[$i]."<br><input class=\"text-form-editor ans\" required><br>";
						echo "<div id=\"showAns".$i."\" style=\"display:none\"><a id=\"showAnsLink".$i."\" href=\"#action\" onclick=\"showAns($i,'$answer');\">Show answer >> </a></div>";
						echo "<span id=\"textAns".$i."\"></span>";
					}
					?>
					<p id="scriptResult"></p>
				</div>
				<button id="submitButton" class="mc-btn btn-style-1" onclick="confirmCheckResult(<?php echo $stuID ?>, '<?php echo $exID ?>')" type="button">Submit</button><br> 
				<div id="result">
					<h1>Results</h1>
				</div>
				
				<?php
			}
			else echo "No data!";
			break;

		case 'ex4':
			$sql = "SELECT * FROM ex4 WHERE ex4ID=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				echo "<h3 align=\"center\">".$row["title"]."</h3>";
				while($row = mysql_fetch_assoc($result)) {
					$answer = $row["answer"];
				}
				?>
				<div class="table-student-submission">
	                <table class="mc-table">
	                    <thead>
	                        <tr>
	                            
	                            <th width="10%" class="author">Questions<span class="caret"></span></th>
	                            
	                            <th width="50%" class="score">Answers<span class="caret"></span></th>
	                        </tr>
	                    </thead>

	                    <tbody>
	                    <?php
	                    	$count = count(explode("*/*", $answer));
	                    	for($i=0; $i<$count; $i++){
								echo "<tr class=\"new\"><td class=\"author\">".($i+1)."</td><td class=\"author\">".
								"<input style=\"width:100%\" class=\"text-form-editor ans\" required></td></tr>";
							}
						?>
	                      
	                    </tbody>
	                </table>
	                <div class="create-course-content"><div class="form-action">
		                <button id="submitButton" class="mc-btn btn-style-1" onclick="confirmCheckResult(<?php echo $stuID ?>, '<?php echo $exID ?>');" type="button">Submit</button>
		            	</div>
	            	</div>
           	 	</div>


				<div id="result">
					<h1>Answers</h1>
				</div>
				<div id="nextEx"></div>
				<a href="#action" onclick="loadEx('<?php echo change4to6($exID)?>')">Continue With <b>Exercise 5 (Reading Keywords) - Task <?php echo(explode("\\.", $exID)[1])?></b></a>
				<script>
				</script>
				<?php
			}
			else echo "No data!";
			break;

		case 'ex5':
			$sql = "SELECT * FROM ex5 WHERE ex5ID=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_assoc($result)) {
					$topic = $row["topic"];
				}
				?>
				<section id="create-course-section" class="create-course-section">
		            <div class="row">
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formUpload" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="topic" value="<?php echo $topic; ?>">
		                    	<input type="hidden" name="ex" value="<?php  echo $exID ?>">
		                    	<h3>Topic</h3><strong><?php echo $topic; ?></strong>
		                    	<h3><strong>OUTLINE</strong></h3>
		                    	<div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>- Main idea 1</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                    	<input class="ans" name="main1input" type="text" placeholder="No more than 6 words" required>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>+ Supporting idea 1</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                    	<input class="ans" name="sup1input" type="text" placeholder="No more than 6 words" required>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>- Main idea 2</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                    	<input class="ans" name="main2input" type="text" placeholder="No more than 6 words" required>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>+ Supporting idea 2</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                    	<input class="ans" name="sup2input" type="text" placeholder="No more than 6 words" required>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>

		                      	<h3><strong>FULL SENTENCES</strong></h3>
		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>- Main idea 1</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                        <textarea class="ans" name="main1" placeholder="Write your main idea..." required></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>+ Supporting idea 1</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                        <textarea class="ans" name="sup1" placeholder="Write your supporting idea..." required></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>- Main idea 2</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                        <textarea class="ans" name="main2" placeholder="Write your main idea..." required></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>+ Supporting idea 2</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                        <textarea class="ans" name="sup2" placeholder="Write your supporting idea..." required></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>

		                        </form>
		                        <div class="form-action">
		                            <button class="submit mc-btn-3 btn-style-1" onclick="confirmLoadActionEx5('loadEx.php?Ex5=action', 'formUpload')" type="button">Save</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>
			    </section>
				<?php
			}
			else echo "No data!";
			break;

		case 'ex6':
			$sql = "SELECT * FROM ex6 WHERE id=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				echo "<h3 align=\"center\">".$row["title"]."</h3>";
				while($row = mysql_fetch_assoc($result)) {
					$keywords = $row["keywords"];
				}
				?>
				<div class="table-student-submission">
					<form id="formUpload" enctype="multipart/form-data" method="post">
                	<input type="hidden" name="ex" value="<?php  echo $exID ?>">
	                <table class="mc-table">
	                    <thead>
	                        <tr>
	                            <th width="50%" class="author">Keywords<span class="caret"></span></th>
	                            <th width="50%" class="score">Answers<span class="caret"></span></th>
	                        </tr>
	                    </thead>
                    	<tbody>
	                    <?php
	                    	$keywords = explode("*/*", $keywords);
	                    	$count = count($keywords);
	                    	for($i=0; $i<$count; $i++){
								echo "<tr class=\"new\">"."<input class=\"keywords\" type=\"hidden\" value='$keywords[$i]'>".
								"<td class=\"author\">".$keywords[$i]."</td><td class=\"author\">".
								"<input style=\"width:100%\" class=\"text-form-editor ans\" required></td></tr>";
							}
						?>
	                    </tbody>
	                </table>
	                </form>
	                <div class="create-course-content">
	                	<div class="form-action">
		                <button id="submitButton" class="submit mc-btn-3 btn-style-1" onclick="confirmCheckResult(<?php echo $stuID ?>, '<?php echo $exID ?>')" type="button">Save</button>
		            	</div>
	            	</div>
           	 	</div>
           	 	<div id="result">
					<h1>Answers</h1>
				</div>
				<?php
			}
			break;

		case 'ex7':
			$sql = "SELECT * FROM ex7 WHERE id=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				echo "<h3 align=\"center\">".$row["title"]."</h3>";
				while($row = mysql_fetch_assoc($result)) {
					$answer = $row["answer"];
				}
				?>
				<div class="table-student-submission">
	                <table class="mc-table">
	                    <thead>
	                        <tr>
	                            <th width="10%" class="author">Questions<span class="caret"></span></th>
	                            <th width="50%" class="score">Answers<span class="caret"></span></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                    	$count = count(explode("*/*", $answer));
	                    	for($i=0; $i<$count; $i++){
								echo "<tr class=\"new\"><td class=\"author\">".($i+1)."</td><td class=\"author\">".
								"<input style=\"width:100%\" class=\"text-form-editor ans\" required></td></tr>";
							}
						?>
	                      
	                    </tbody>
	                </table>
	                <div class="create-course-content"><div class="form-action">
		                <button id="submitButton" class="mc-btn btn-style-1" onclick="confirmCheckResult(<?php echo $stuID ?>, '<?php echo $exID ?>');" type="button">Submit</button>
		            	</div>
	            	</div>
           	 	</div>


				<div id="result">
					<h1>Answers</h1>
				</div>
				<?php
			}
			else echo "No data!";
			break;

		case 'ex8':
			$sql = "SELECT * FROM ex8 WHERE id=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_assoc($result)) {
					$link = $row["link"];
					$title = $row["title"];
				}
				?>
				<section id="create-course-section" class="create-course-section">
		            <div class="row">
		                  
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formUpload" enctype="multipart/form-data" method="post">
		                    	<input type="hidden" name="title" value="<?php echo $title; ?>">
		                    	<input type="hidden" name="ex" value="<?php  echo $exID ?>">
		                    	<h3>Movie: <?php echo $title; ?></h3>
		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Link</h4>
		                                </div>
		                                <div class="col-md-9" align="left" style="word-wrap:break-word">
		                                    <a href=<?php echo $link ?> target="_blank"><?php echo $link ?></a>
		                                </div>
		                            </div>
		                        </div>
		                      
		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Summerize</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                        <textarea class="ans" name="summ" minlength="80" placeholder="Write your summerize (at least 80 words)..." required></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        </form>
		                        <div class="form-action">
		                            <button id="saveButton" class="submit mc-btn-3 btn-style-1" onclick="confirmLoadActionEx5('loadEx.php?Ex8=action', 'formUpload')" type="button">Save</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>
			    </section>
				<?php
			}
			else echo "No data!";
			break;

		case 'ex9':
			$sql = "SELECT * FROM ex9 WHERE id=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				echo "<h3 align=\"center\">".$row["title"]."</h3>";
				while($row = mysql_fetch_assoc($result)) {
					$pictureLink = $row["pictureLink"];
					$question = $row["questions"];
					$question = explode("*/*", $question);
					$answer = base64_encode($row["answer"]);
					$audio = $row["audioScript"];
				}
				?>
				<img src="<?php echo $pictureLink ?>"><br><br>
				<audio id="myVideo" controls>
				<source src="<?php echo $audio ?>" type="audio/mpeg">
				Your browser does not support the audio element.
				</audio>
				<div id="question">
					<h1>Questions</h1>
					<?php  
					for($i=0; $i<count($question); $i++){
						echo ($i+1).". ".$question[$i]."<br><input class=\"text-form-editor ans\" required><br>";
						echo "<div id=\"showAns".$i."\" style=\"display:none\"><a id=\"showAnsLink".$i."\" href=\"#action\" onclick=\"showAns($i,'$answer');\">Show answer >> </a></div>";
						echo "<span id=\"textAns".$i."\"></span>";
					}
					?>
					<p id="scriptResult"></p>
				</div>
				<button id="submitButton" class="mc-btn btn-style-1" onclick="confirmCheckResult(<?php echo $stuID ?>, '<?php echo $exID ?>')" type="button">Submit</button><br> 
				<div id="result">
					<h1>Results</h1>
				</div>
				
				<?php
			}
			else echo "No data!";
			break;

		case 'ex10':
			$sql = "SELECT * FROM ex10 WHERE id=$ex";
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				echo "<h3 align=\"center\">".$row["title"]."</h3>";
				while($row = mysql_fetch_assoc($result)) {
					$questions = $row["questions"];
				}
				?>
				<div class="table-student-submission">
	                <table class="mc-table">
	                    <thead>
	                        <tr>
	                            <th width="70%" class="author">Questions</th>
	                            <th width="30%" class="score">Answers</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                    	$questionsArr = explode("*/*", $questions);
	                    	$count = count($questionsArr);
	                    	for($i=0; $i<$count; $i++){
								echo "<tr class=\"new\"><td class=\"author\">".$questionsArr[$i]."</td><td class=\"author\">".
								"<input style=\"width:100%\" class=\"text-form-editor ans\" required></td></tr>";
							}
						?>
	                      
	                    </tbody>
	                </table>
	                <div class="create-course-content"><div class="form-action">
		                <button id="submitButton" class="mc-btn btn-style-1" onclick="confirmCheckResult(<?php echo $stuID ?>, '<?php echo $exID ?>');" type="button">Submit</button>
		            	</div>
	            	</div>
           	 	</div>


				<div id="result">
					<h1>Answers</h1>
				</div>
				<?php
			}
			else echo "No data!";
			break;

		default:
			# code...
			break;
	}
}


//Upload Exercises
if(!empty($_GET['Ex5'])&&!empty($_POST['ex'])){
	if (($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST['topic'])
		&&isset($_POST['main1input'])&&isset($_POST['sup1input'])&&isset($_POST['main2input'])&&isset($_POST['sup2input'])
		&&isset($_POST['main1'])&&isset($_POST['sup1'])&&isset($_POST['main2'])&&isset($_POST['sup2'])) {
		$day = explode("-", $_POST["ex"])[0];
		$exID = explode("-", $_POST["ex"])[1];
		$sql = "INSERT INTO ex5wr (topic, main1input, sup1input, main2input, sup2input, main1, sup1, main2, sup2) VALUES (\"".
			checkText($_POST['topic'])."\", \"".checkText($_POST['main1input'])."\", \"".
			checkText($_POST['sup1input'])."\", \"".checkText($_POST['main2input'])."\", \"".
			checkText($_POST['sup2input'])."\", \"".
			checkText($_POST['main1'])."\", \"".checkText($_POST['sup1'])."\", \"".
			checkText($_POST['main2'])."\", \"".checkText($_POST['sup2'])."\")";
		if (mysql_query($sql, $conn)) {
		    echo "Save successfully!";
		    $last_id = mysql_insert_id($conn);
		    $isScored = false;
		    $sql = "SELECT * FROM students WHERE stuID=".$stuID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_assoc($result)) {
					$oldScore = json_decode($row["scores"], true);
					$count=0;
					foreach ($oldScore as $key => &$value) {
						if($key=="day".$day){
							foreach ($value as $key_1 => &$value_1) {
								if($key_1==$exID){
									if($value_1['count'] <= 0)
										$isScored = true;
									else{
										$value_1['score']=$last_id;
										$value_1['count']--;
										$count=$value_1['count'];
									}
								}
							}
						}
					}
					if(!$isScored){
						$newScore = json_encode($oldScore);
						$sql = "UPDATE students SET scores = '$newScore' WHERE stuID=".$stuID;
				    	if (mysql_query($sql, $conn)) {
				    		//echo "\nUpdate scores successfully";
				    	} else{
				    		echo "\nError: <br>" . mysql_error($conn);
				    	}
					}
					else
						echo "\nYou have done this exercise!";
				}
			}
		}
		else {
		    echo "Error: " . $sql . "<br>" . mysql_error($conn);
		}
	}
}
else if (!empty($_GET['Ex6'])&&!empty($_POST['ex'])) {
	if (($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST['keywords'])&&isset($_POST['answer'])) {
		$day = explode("-", $_POST["ex"])[0];
		$exID = explode("-", $_POST["ex"])[1];
		$answer = implode("*/*", $_POST['answer']);
		$answer = checkText($answer);
		$keywords = checkText($_POST['keywords']);
		$sql = "INSERT INTO studentData (att1, att2) VALUES (\"".$keywords."\", \"".$answer."\")";
		if (mysql_query($sql, $conn)) {
		    echo "Save successfully!";
		    $last_id = mysql_insert_id($conn);
		    $isScored = false;
		    $sql = "SELECT * FROM students WHERE stuID=".$stuID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_assoc($result)) {
					$oldScore = json_decode($row["scores"], true);
					$count=0;
					foreach ($oldScore as $key => &$value) {
						if($key=="day".$day){
							foreach ($value as $key_1 => &$value_1) {
								if($key_1==$exID){
									if($value_1['count'] <= 0)
										$isScored = true;
									else{
										$value_1['score']=$last_id;
										$value_1['count']--;
										$count=$value_1['count'];
									}
								}
							}
						}
					}
					if(!$isScored){
						$newScore = json_encode($oldScore);
						$sql = "UPDATE students SET scores = '$newScore' WHERE stuID=".$stuID;
				    	if (mysql_query($sql, $conn)) {
				    		//echo "\nUpdate scores successfully";
				    	} else{
				    		echo "\nError: <br>" . mysql_error($conn);
				    	}
					}
					else
						echo "\nYou have done this exercise!";
				}
			}
		}
		else {
		    echo "Error: " . $sql . "<br>" . mysql_error($conn);
		}
	}
}
else if (!empty($_GET['Ex8'])&&!empty($_POST['title'])&&!empty($_POST['ex'])) {
	if (($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST['summ'])) {
		$day = explode("-", $_POST["ex"])[0];
		$exID = explode("-", $_POST["ex"])[1];
		$title = checkText($_POST['title']);
		$summ = checkText($_POST['summ']);
		$sql = "INSERT INTO studentData (att1, att2) VALUES (\"".$title."\", \"".$summ."\")";
		if (mysql_query($sql, $conn)) {
		    echo "Save successfully!";
		    $last_id = mysql_insert_id($conn);
		    $isScored = false;
		    $sql = "SELECT * FROM students WHERE stuID=".$stuID;
			$result = mysql_query($sql, $conn);
			if (mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_assoc($result)) {
					$oldScore = json_decode($row["scores"], true);
					$count=0;
					foreach ($oldScore as $key => &$value) {
						if($key=="day".$day){
							foreach ($value as $key_1 => &$value_1) {
								if($key_1==$exID){
									if($value_1['count'] <= 0)
										$isScored = true;
									else{
										$value_1['score']=$last_id;
										$value_1['count']--;
										$count=$value_1['count'];
									}
								}
							}
						}
					}
					if(!$isScored){
						$newScore = json_encode($oldScore);
						$sql = "UPDATE students SET scores = '$newScore' WHERE stuID=".$stuID;
				    	if (mysql_query($sql, $conn)) {
				    		//echo "\nUpdate scores successfully";
				    	} else{
				    		echo "\nError: <br>" . mysql_error($conn);
				    	}
					}
					else
						echo "\nYou have done this exercise!";
				}
			}
		}
		else {
		    echo "Error: " . $sql . "<br>" . mysql_error($conn);
		}
	}
}
?>
<?php mysql_close($conn); ?>

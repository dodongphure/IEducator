<?php
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
if(!empty($_GET['Ex'])){
	echo "<strong>Create Exercise ".convertEx($_GET['Ex'])."</strong><br>";
	switch ($_GET['Ex']) {
		case '1':
			?>
		    <section id="create-course-section" class="create-course-section">		        
		            <div class="row">		                 
		                <div class="col-md-12">
		                    <div class="create-course-content">
		                    	<form id="formUpload" enctype="multipart/form-data" method="post">
		                    	
		                        <div class="description create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Text Script</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="description-editor text-form-editor">
		                                        <textarea name="textScript" placeholder="Write your text script here..." required></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                      
		                        <div class="promo-video create-item">
		                            <div class="row">
		                                <div class="col-md-3">
		                                    <h4>Upload Audio Script</h4>
		                                </div>
		                                <div class="col-md-9">
		                                    <div class="upload-video up-file">
		                                    </div><input type="file" name="fileToUpload" id="fileToUpload" accept="audio/*" required>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        </form>
		                        <div class="form-action">
		                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=1', 'formUpload')" type="button">Upload</button>
		                        </div>
		                        
		                    </div>
		                </div>
		            </div>
		    </section>
   
			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_FILES["fileToUpload"])&&!empty($_POST['textScript'])) {
				$target_dir = "media/".date('Y')."/".date('m')."/";
				if (!file_exists($target_dir)) {
				    mkdir($target_dir, 0777, true);
				}
				$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
				
				$uploadOk = 1;
				$isUpload = false;
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				}
				else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				        $isUpload = true;
				    }
				    else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
			    if($isUpload){
			    	$target_file = checkText($target_file);
					$sql = "INSERT INTO ex1 (textScript, audioScript, timeCreated) VALUES (\"".htmlspecialchars($_POST['textScript'])."\", \"".$target_file."\", \"".date("Y-m-d H:i:s",time())."\")";
					if (mysql_query($sql, $conn)) {
					    echo "Submit successfully";
					} else {
					    echo "Error: " . $sql . "<br>" . mysql_error($conn);
					}
			    }
			}
			break;
		case '2':
			?>
		<section id="create-course-section" class="create-course-section">        
            <div class="row">                 
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Title</h4>
                                </div>
                                <div class="col-md-9">
									<input type="text" class="form-control" placeholder="Title of exercise" name="title">
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
									<input type="text" class="form-control" placeholder="Content of question" name="question[]">
									</div>
									<a href="#action" onclick="addMoreQuestion()"><i class="icon md-plus"></i> Add more questions</a>
                                </div>
                            </div>
                        </div>
                      
                        <div class="promo-video create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Upload Audio Script</h4>
                                </div>
                                <div class="col-md-9">
                                    
                                    <div class="upload-video up-file">
                                    </div><input type="file" name="fileToUpload" id="fileToUpload" accept="audio/*" required>
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
									<input type="text" class="form-control" placeholder="Content of answer" name="ans[]">
									</div>
									<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
                                </div>
                            </div>
                        </div>
                        
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=2', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>       
    	</section>

			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_FILES["fileToUpload"])&&!empty($_POST['question'])&&!empty($_POST['ans'])&&!empty($_POST['title'])) {
				$target_dir = "media/".date('Y')."/".date('m')."/";
				if (!file_exists($target_dir)) {
				    mkdir($target_dir, 0777, true);
				}
				$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
				
				$uploadOk = 1;
				$isUpload = false;
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				}
				else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				        $isUpload = true;
				    }
				    else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
				if($isUpload){
					$questionArr = implode("*/*", $_POST["question"]);
					$ansArr = implode("*/*", $_POST["ans"]);
					$target_file = checkText($target_file);
					$sql = "INSERT INTO ex2 (audioScript, title, questions, answer, timeCreated) VALUES (\"".$target_file."\",\"".$_POST['title']."\",\"".$questionArr."\", \"".$ansArr."\", \"".date("Y-m-d H:i:s",time())."\")";
					if (mysql_query($sql, $conn)) {
					    echo "Submit successfully<br>";
					} else {
					    echo "Error: " . $sql . "<br>" . mysql_error($conn);
					}
			    }
			}
			break;

		case '3':
			?>
			<section id="create-course-section" class="create-course-section">
        
            <div class="row">
                  
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Title</h4>
                                </div>
                                <div class="col-md-9">
									<input type="text" class="form-control" placeholder="Title of exercise" name="title">
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
									<input type="text" class="form-control" placeholder="Content of question" name="question[]">
									</div>
									<a href="#action" onclick="addMoreQuestion()"><i class="icon md-plus"></i> Add more questions</a>
                                </div>
                            </div>
                        </div>
                      
                        <div class="promo-video create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Upload Audio Script</h4>
                                </div>
                                <div class="col-md-9">
                                    
                                    <div class="upload-video up-file">
                                       <!--  <a href="#"><i class="icon md-upload"></i>Upload audio</a> -->
                                        
                                    </div><input type="file" name="fileToUpload" id="fileToUpload" accept="audio/*" required>
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
									<input type="text" class="form-control" placeholder="Content of answer" name="ans[]">
									</div>
									<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
                                </div>
                            </div>
                        </div>
                        
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=3', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>
    		</section>
			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_FILES["fileToUpload"])&&!empty($_POST['question'])&&!empty($_POST['ans'])&&!empty($_POST['title'])) {
				$target_dir = "media/".date('Y')."/".date('m')."/";
				if (!file_exists($target_dir)) {
				    mkdir($target_dir, 0777, true);
				}
				$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
				$target_file = checkText($target_file);
				$uploadOk = 1;
				$isUpload = false;
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				}
				else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				        $isUpload = true;
				    }
				    else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
				if($isUpload){
					$questionArr = implode("*/*", $_POST["question"]);
					$ansArr = implode("*/*", $_POST["ans"]);
					$target_file = checkText($target_file);
					$sql = "INSERT INTO ex3 (audioScript, title, questions, answer, timeCreated) VALUES (\"".$target_file."\",\"".$_POST['title']."\",\"".$questionArr."\", \"".$ansArr."\", \"".date("Y-m-d H:i:s",time())."\")";
					if (mysql_query($sql, $conn)) {
					    echo "Submit successfully<br>";
					} else {
					    echo "Error: " . $sql . "<br>" . mysql_error($conn);
					}
			    }
			}
			break;
		case '4':
			?>
			<section id="create-course-section" class="create-course-section">       
            <div class="row">
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Title</h4>
                                </div>
                                <div class="col-md-9">
                                    <div id="inputQuestion">
									<input type="text" class="form-control" placeholder="Title of exercise" name="title">
									</div>
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
									<input type="text" class="form-control" placeholder="Content of answer" name="ans[]">
									</div>
									<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i>Add more answers</a>
                                </div>
                            </div>
                        </div>
                        
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=4', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        
    		</section>
			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST['ans'])&&!empty($_POST['title'])) {
				$ansArr = implode("*/*", $_POST["ans"]);
				$sql = "INSERT INTO ex4 (title, answer, timeCreated) VALUES (\"".$_POST['title']."\", \"".$ansArr."\", \"".date("Y-m-d H:i:s",time())."\")";
				if (mysql_query($sql, $conn)) {
				    echo "Submit successfully<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . mysql_error($conn);
				}
			}
			break;
		case '5':
			?>
			<section id="create-course-section" class="create-course-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	
                        <div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Topic</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="description-editor text-form-editor">
                                        <textarea name="topicName" placeholder="Write your topic name here..." required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=5', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        
    		</section>
			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST['topicName'])) {
				$sql = "INSERT INTO ex5 (topic, timeCreated) VALUES (\"".htmlspecialchars($_POST['topicName'])."\", \"".date("Y-m-d H:i:s",time())."\")";
				if (mysql_query($sql, $conn)) {
				    echo "Submit successfully<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . mysql_error($conn);
				}
			}
			break;
		case '5wr':
			
			break;
		case '6':
			?>
			<section id="create-course-section" class="create-course-section">
        
            <div class="row">
                  
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Title</h4>
                                </div>
                                <div class="col-md-9">
                                    <div id="inputQuestion">
									<input type="text" class="form-control" placeholder="Title of exercise" name="title">
									</div>
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
									<input type="text" class="form-control" placeholder="Content of keyword" name="keyword[]">
									</div>
									<a href="#action" onclick="addMoreKeyword()"><i class="icon md-plus"></i> Add more keyword</a>
                                </div>
                            </div>
                        </div>
                      
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=6', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        
    		</section>
			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST['keyword'])&&!empty($_POST['title'])) {
				$keywordArr = implode("*/*", $_POST["keyword"]);
				$sql = "INSERT INTO ex6 (title, keywords, timeCreated) VALUES (\"".$_POST['title']."\", \"".$keywordArr."\", \"".date("Y-m-d H:i:s",time())."\")";
				if (mysql_query($sql, $conn)) {
				    echo "Submit successfully<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . mysql_error($conn);
				}
			}
			break;

		case '7':
			?>
			<section id="create-course-section" class="create-course-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Title</h4>
                                </div>
                                <div class="col-md-9">
                                    <div id="inputQuestion">
									<input type="text" class="form-control" placeholder="Title of exercise" name="title">
									</div>
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
									<input type="text" class="form-control" placeholder="Content of answer" name="ans[]">
									</div>
									<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answer</a>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=7', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>
    		</section>
			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST['ans'])&&!empty($_POST['title'])) {
				$ansArr = implode("*/*", $_POST["ans"]);
				$sql = "INSERT INTO ex7 (title, answer, timeCreated) VALUES (\"".$_POST['title']."\", \"".$ansArr."\", \"".date("Y-m-d H:i:s",time())."\")";
				if (mysql_query($sql, $conn)) {
				    echo "Submit successfully<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . mysql_error($conn);
				}
			}
			break;

		case '8':
			?>
			<section id="create-course-section" class="create-course-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Title</h4>
                                </div>
                                <div class="col-md-9">
                                    <div id="inputQuestion">
									<input type="text" class="form-control" placeholder="Title of movie" name="title">
									</div>
								</div>
                            </div>
                        </div>
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Link</h4>
                                </div>
                                <div class="col-md-9">
                                    <div id="inputQuestion">
									<input type="text" class="form-control" placeholder="Link of movie" name="link">
									</div>
								</div>
                            </div>
                        </div>
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=8', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>
    		</section>
			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST['title'])&&!empty($_POST['link'])) {
				$sql = "INSERT INTO ex8 (title, link, timeCreated) VALUES (\"".$_POST['title']."\",\"".$_POST['link']."\", \"".date("Y-m-d H:i:s",time())."\")";
				if (mysql_query($sql, $conn)) {
				    echo "Submit successfully<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . mysql_error($conn);
				}
			}
			break;

		case '9':
			?>
			<section id="create-course-section" class="create-course-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Title</h4>
                                </div>
                                <div class="col-md-9">
									<input type="text" class="form-control" placeholder="Title of exercise" name="title">
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
									<input type="text" class="form-control" placeholder="Content of question" name="question[]">
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
									<input type="text" class="form-control" placeholder="Link of picture" name="pictureLink">
                                </div>
                            </div>
                        </div>
                      
                        <div class="promo-video create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Upload Audio Script</h4>
                                </div>
                                <div class="col-md-9">
                                    
                                    <div class="upload-video up-file">
                                       <!--  <a href="#"><i class="icon md-upload"></i>Upload audio</a> -->
                                        
                                    </div><input type="file" name="fileToUpload" id="fileToUpload" accept="audio/*" required>
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
									<input type="text" class="form-control" placeholder="Content of answer" name="ans[]">
									</div>
									<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
                                </div>
                            </div>
                        </div>
                        
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=9', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>
    		</section>
			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_FILES["fileToUpload"])&&!empty($_POST['question'])&&!empty($_POST['ans'])&&!empty($_POST['title'])&&!empty($_POST['pictureLink'])) {
				$target_dir = "media/".date('Y')."/".date('m')."/";
				if (!file_exists($target_dir)) {
				    mkdir($target_dir, 0777, true);
				}
				$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
				$target_file = checkText($target_file);
				$uploadOk = 1;
				$isUpload = false;
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				}
				else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				        $isUpload = true;
				    }
				    else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
				if($isUpload){
					$questionArr = implode("*/*", $_POST["question"]);
					$ansArr = implode("*/*", $_POST["ans"]);
					$target_file = checkText($target_file);
					$sql = "INSERT INTO ex9 (audioScript, pictureLink, title, questions, answer, timeCreated) VALUES (\"".$target_file."\",\"".$_POST['pictureLink']."\",\"".$_POST['title']."\",\"".$questionArr."\", \"".$ansArr."\", \"".date("Y-m-d H:i:s",time())."\")";
					if (mysql_query($sql, $conn)) {
					    echo "Submit successfully<br>";
					} else {
					    echo "Error: " . $sql . "<br>" . mysql_error($conn);
					}
			    }
			}
			break;

		case '10':
			?>
		<section id="create-course-section" class="create-course-section">        
            <div class="row">                 
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formUpload" enctype="multipart/form-data" method="post">
                    	
                    	<div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Title</h4>
                                </div>
                                <div class="col-md-9">
									<input type="text" class="form-control" placeholder="Title of exercise" name="title">
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
									<input type="text" class="form-control" placeholder="Content of question" name="question[]">
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
									<input type="text" class="form-control" placeholder="Content of answer" name="ans[]">
									</div>
									<a href="#action" onclick="addMoreAns()"><i class="icon md-plus"></i> Add more answers</a>
                                </div>
                            </div>
                        </div>
                        
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('uploadEx.php?Ex=10', 'formUpload')" type="button">Upload</button>
                        </div>
                        
                    </div>
                </div>
            </div>       
    	</section>

			<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST['question'])&&!empty($_POST['ans'])&&!empty($_POST['title'])) {
				$questionArr = implode("*/*", $_POST["question"]);
				$ansArr = implode("*/*", $_POST["ans"]);
				$sql = "INSERT INTO ex10 (title, questions, answer, timeCreated) VALUES (\"".$_POST['title']."\",\"".$questionArr."\", \"".$ansArr."\", \"".date("Y-m-d H:i:s",time())."\")";
				if (mysql_query($sql, $conn)) {
				    echo "Submit successfully<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . mysql_error($conn);
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
<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
?>

<!-- <form id="formAddStu" method="post">
<div id="username">Username</div>
<input type="text" name="username" required>
<br>
<div id="exTitile">Password</div>
<input type="password" name="password" required>

</form>
<div id="uploadButton"><button onclick="loadAction('addStu.php','formAddStu')" type="button">Submit</button></div> -->
<section id="create-course-section" class="create-course-section">
        
            <div class="row">
                  
                <div class="col-md-12">
                    <div class="create-course-content">
                    	<form id="formAddStu" method="post">
                    	
                        <div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Username</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="description-editor text-form-editor">
                                        <input type="text" name="username" placeholder="Username of student (must be unique)" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <div class="promo-video create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Password</h4>
                                </div>
                                <div class="col-md-9">
                                    
                                    <div class="description-editor text-form-editor">
                                        <input type="text" name="password" value = "aabb1122" required>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        </form>
                        <div class="form-action">
                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="loadAction('addStu.php','formAddStu')" type="button">Submit</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        
    </section>

<?php 
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["username"])&&!empty($_POST['password'])) {
	$hash = md5($_POST['password']);
	$sql = "INSERT INTO students (username, password) VALUES (\"".htmlspecialchars($_POST['username'])."\",\"".$hash."\")";

	if (mysql_query($sql, $conn)) {
	    echo "Submit successfully";
	} else {
	    echo "Error: " . mysql_error($conn);
	}

	mysql_close($conn);
}
?>
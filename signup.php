<?php  
require_once 'config.php';

echo getRenderedHTML('_header.php', null);
?>
    <!-- LOGIN -->
    <section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">
    
    
                
                <!-- FORM -->
                <div class="col-xs-12 col-lg-4 pull-right">
                    <div class="form-login">
                        <form id="formAddStu" method="post">
                            <h2 class="text-uppercase">sign up</h2>
                            <div class="form-fullname">
                                <input name="fname" class ="first-name"type="text" placeholder="First name">
                                <input name="lname" class="last-name" type="text" placeholder="Last name">
                            </div>
                            <div class="form-email">
                                <input type="text" placeholder="Username" name="username">
                            </div>
                            <div class="form-password">
                                <input type="password" placeholder="Password" name="password">
                            </div>
                            <div class="form-email">
                                <input name="email" type="email" placeholder="Email">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="check" onchange="document.getElementsByName('password')[0].type = this.checked ? 'text' : 'password'">
                                <label for="check">
                                <i class="icon md-check-2"></i>
                                Show password</label>
                            </div>
                            <div class="form-submit-1">
                                <input type="submit" value="Become a member" class="mc-btn btn-style-1">
                            </div>
                            <div class="link">
                                <a href="login.php">
                                    <i class="icon md-arrow-right"></i>Sign in
                                </a>
                            </div>
                          </form>
                    </div>
                </div>
                <!-- END / FORM -->
    
                <div class="image">
                    <img src="images/homeslider/img-thumb.png" alt="">
                </div>
    
            </div>
        </div>
    </section>
    <!-- END / LOGIN -->
    
      
<?php echo getRenderedHTML('_footer.php') ?>

<?php 
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["username"])&&!empty($_POST['password'])&&!empty($_POST["fname"])&&
	!empty($_POST["lname"])&&!empty($_POST["email"])) {
	$hash = md5($_POST['password']);
	$name = checkText($_POST['fname'])." ".checkText($_POST['lname']);
	$sql = "INSERT INTO students (username, password, role, name, email) VALUES (\"".checkText($_POST['username'])."\",\"".$hash."\", 'Guest', '".$name."', '".checkText($_POST["email"])."')";

	if (mysql_query($sql, $conn)) {
        echo "<script>swal(\"Signup successfully!\", \"Please login to your account\", \"success\");</script>";
	} else {
	    echo "<script>swal(\"Signup unsuccessfully!\", \"Please try another Username or Password\", \"error\");</script>";
	}

}
mysql_close($conn);
?>

<?php
require_once 'config.php';

	session_start();
	$error = '';
	if(isset($_SESSION['login'])){
		header("location: student.php");
	}
	if(isset($_POST['submit'])){
		if(empty($_POST['username'])||empty($_POST['password'])){
			$error = "<i class=\"fa fa-close\"></i> Invalid username or password!";
		}
		else{
			$username = checkText($_POST['username']);
			$password = md5(checkText($_POST['password']));

			$query = mysql_query("select * from students where username='$username' and password='$password'", $conn);
			$rows = mysql_num_rows($query);
			if($rows == 1){
				$_SESSION['login'] = $username;
				$row = mysql_fetch_assoc($query);
				if($row["role"]==$_ADMIN_CODE)
					header("location: admin.php");
				else
					header("location: student.php");
			}
			else{
				$error = "<i class=\"fa fa-close\"></i> Invalid username or password!";
			}
			mysql_close($conn);
		}
		

	}

echo getRenderedHTML('_header.php');	
?>
    <!-- login -->
    <section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">

                <!-- FORM -->
                <div class="col-xs-12 col-lg-4 pull-right">
                    <div class="form-login">
                        <form method="post">
                            <h2 class="text-uppercase">sign in</h2>
                            <div class="form-email">
                                <input type="text" placeholder="Username" name="username">
                            </div>
                            <div class="form-password">
                                <input type="password" placeholder="Password" name="password">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="check" onchange="document.getElementsByName('password')[0].type = this.checked ? 'text' : 'password'">
                                <label for="check">
                                <i class="icon md-check-2"></i>
                                Show password</label>
                            </div>
                            <div class="form-submit-1">
                                <input type="submit" name="submit" value="Sign In" class="mc-btn btn-style-1">
                            </div>

                            <span style="color:red"><?php echo $error; ?></span>
                            
                            <div class="link">
                                <a href="signup.php">
                                    <i class="icon md-arrow-right"></i>Don’t have account yet ? Join Us
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
    <!-- END / login -->
    
<?php echo getRenderedHTML('_footer.php') ?>
<?php
mysql_close($conn);
?>
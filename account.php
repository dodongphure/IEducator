<?php  
require_once 'config.php';
?>
<!-- <form id="formEdit" method="post">
<div id="">Username</div>
<input type="text" name="username" value="<?php echo $login_session ?>" <?php if($user['role']!='admin') echo "disabled" ?>>
<br>
<div id="">Current password</div>
<input type="password" name="curpassword" required>
<br>
<div id="">New password</div>
<input type="password" name="newpassword" required>
<br>
<div id="">Retype new password</div>
<input type="password" name="repassword" required>
</form>
<div id="uploadButton"><button onclick="loadAction('account.php','formEdit')" type="button">Submit</button></div> -->
<div class="info-acount">
    <div class="security">
        <div class="tittle-security">
        <form id="formEdit" method="post">
            <h5>Username</h5>
            <input type="text" name="username" value="<?php echo $login_session ?>" <?php if($user['role']!='admin') echo "disabled" ?>>
            <h5>Password</h5>
            <input type="password" name="curpassword" placeholder="Current password" required>
            <input type="password" name="newpassword" placeholder="New password" required>
            <input type="password" name="repassword" placeholder="Confirm password" required>
        </form>
        </div>
    </div>
</div>
<div class="input-save">   
    <button class="mc-btn btn-style-1" onclick="loadAction('account.php','formEdit')" type="button">Submit</button>
</div>
<?php  
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["curpassword"])&&!empty($_POST["newpassword"])&&!empty($_POST["repassword"])){
	$curPass = htmlspecialchars($_POST["curpassword"]);
	$newPass = htmlspecialchars($_POST["newpassword"]);
	$rePass = htmlspecialchars($_POST["repassword"]);
	if(!empty($_POST["username"]))
		$username = htmlspecialchars($_POST["username"]);
	else
		$username = $login_session;
	if($newPass!=$rePass)
		echo "Password retyped does not match!";
	else{
		$query = mysql_query("select * from students where username=\"$login_session\"", $conn);
		if($query === FALSE) { 
            die(mysql_error());
        }
		$rows = mysql_num_rows($query);
		if($rows == 1){
			$row = mysql_fetch_assoc($query);
			if(md5($curPass) != $row["password"])
				echo "New password does not match current password!";
			else{
				$sql = "UPDATE students SET username = '$username', password = '".md5($newPass)."' WHERE username='$login_session'";
		    	if (mysql_query($sql, $conn)) {
		    		$_SESSION['login'] = $username;
		    		echo "Update account successfully<br><script>updateLoginUser('$username')</script>";
		    		
		    	} else{
		    		echo "Error: " . mysql_error($conn);
		    	}
			}
		}
	}
}
mysql_close($conn);
?>
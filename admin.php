<?php require_once 'config.php'; 
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<title>Admin page | IELTS Learning Website</title>
<script src="script/jquery.min.js"></script>
<script src="script/bootstrap.min.js"></script>
<script src="script/jquery-ui.min.js"></script>
<script src="script/sweetalert/sweet-alert.js"></script>
<link rel="stylesheet" href="script/bootstrap.min.css">
<link rel="stylesheet" href="script/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="css/main.php.css">
<link rel="stylesheet" type="text/css" href="script/sweetalert/sweet-alert.css">
<!-- Google font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="css/library/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/library/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/library/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/md-font.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <link href="images/favicon.ico" rel="shortcut icon"/>
</head>
<body id="page-top">
<!-- PAGE WRAP -->
<div id="page-wrap">
	<!-- HEADER -->
    <header id="header" class="header">
        <div class="container">

            <!-- LOGO -->
            <div class="logo"><a href="/trang-chu"><img src="images/logo.svg" alt=""></a></div>
            <!-- END / LOGO -->

            <!-- NAVIGATION -->
            <nav class="navigation">

                <div class="open-menu">
                    <span class="item item-1"></span>
                    <span class="item item-2"></span>
                    <span class="item item-3"></span>
                </div>

                <!-- MENU -->
                <ul class="menu">
                    <li class="menu-item-has-children megamenu col-4">
                        <a href="#action">Manage Posts</a>
                        <ul class="sub-menu">
                            <li><a href="#action" onclick="loadAction('addPost.php', null)">Add Posts</a></li>
                            <li><a href="#action" onclick="loadAction('viewPost.php', null)">View Posts</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children megamenu col-4">
                        <a href="#action">Create Exercises</a>
                        <ul class="sub-menu">
                            <li><a href="#action" onclick="loadAction('uploadEx.php?Ex=1', null)">Exercise 1 (VOA)</a></li>
							<li><a href="#action" onclick="loadAction('uploadEx.php?Ex=2', null)">Exercise 2 (BBC)</a></li>
							<li><a href="#action" onclick="loadAction('uploadEx.php?Ex=3', null)">Exercise 3 (Listening)</a></li>
							<li><a href="#action" onclick="loadAction('uploadEx.php?Ex=4', null)">Exercise 4 (Reading)</a></li>
                            <li><a href="#action" onclick="loadAction('uploadEx.php?Ex=6', null)">Exercise 5 (Reading Keywords)</a></li>
                            <li><a href="#action" onclick="loadAction('uploadEx.php?Ex=5', null)">Exercise 6 (Writing)</a></li>
                            <li><a href="#action" onclick="loadAction('uploadEx.php?Ex=7', null)">Exercise 7 (Grammar)</a></li>
                            <li><a href="#action" onclick="loadAction('uploadEx.php?Ex=8', null)">Exercise 8 (Movies)</a></li>
                            <li><a href="#action" onclick="loadAction('uploadEx.php?Ex=9', null)">Exercise 9 (Toeic Listening)</a></li>
                            <li><a href="#action" onclick="loadAction('uploadEx.php?Ex=10', null)">Exercise 10 (Toeic Reading)</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children megamenu col-4">
                        <a href="#action">Manage Exercises</a>
                        <ul class="sub-menu">
                            <li><a href="#action" onclick="loadAction('viewEx.php?Ex=1', null)">Exercise 1 (VOA)</a></li>
							<li><a href="#action" onclick="loadAction('viewEx.php?Ex=2', null)">Exercise 2 (BBC)</a></li>
							<li><a href="#action" onclick="loadAction('viewEx.php?Ex=3', null)">Exercise 3 (Listening)</a></li>
							<li><a href="#action" onclick="loadAction('viewEx.php?Ex=4', null)">Exercise 4 (Reading)</a></li>
                            <li><a href="#action" onclick="loadAction('viewEx.php?Ex=6', null)">Exercise 5 (Reading Keywords)</a></li>
                            <li><a href="#action" onclick="loadAction('viewEx.php?Ex=5', null)">Exercise 6 (Writing)</a></li>
                            <li><a href="#action" onclick="loadAction('viewEx.php?Ex=7', null)">Exercise 7 (Grammar)</a></li>
                            <li><a href="#action" onclick="loadAction('viewEx.php?Ex=8', null)">Exercise 8 (Movies)</a></li>
                            <li><a href="#action" onclick="loadAction('viewEx.php?Ex=9', null)">Exercise 9 (Toeic Listening)</a></li>
                            <li><a href="#action" onclick="loadAction('viewEx.php?Ex=10', null)">Exercise 10 (Toeic Reading)</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children megamenu col-4">
                        <a href="#action">Manage Students</a>
                        <ul class="sub-menu">
                            <li><a href="#action" onclick="loadAction('addStu.php', null)">Add Students</a></li>
							<li><a href="#action" onclick="loadAction('viewStu.php', null)">View Students</a></li>
                            <li><a href="#action" onclick="loadAction('viewEmailRegister.php', null)">View Emails Register</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children megamenu col-4">
                        <a href="#action">Manage Groups</a>
                        <ul class="sub-menu">
                        	<li><a href="#action" onclick="loadAction('addDailyEx.php', null)">Add Exercies Day</a></li>
                        	<li><a href="#action" onclick="loadAction('viewDailyEx.php', null)">View Exercies Day</a></li>
                            <li><a href="#action" onclick="loadAction('addDailyGr.php', null)">Add Exercies Group</a></li>
                            <li><a href="#action" onclick="loadAction('viewDailyGr.php', null)">View Exercies Group</a></li>
                            <li><a href="#action" onclick="loadAction('addGroup.php', null)">Add Learning Groups</a></li>
							<li><a href="#action" onclick="loadAction('viewGroup.php', null)">View Learning Groups</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- END / MENU -->

                <!-- SEARCH BOX -->
                <div class="search-box">
                    <gcse:search></gcse:search>
                </div>
                <!-- END / SEARCH BOX -->

                <!-- LIST ACCOUNT INFO -->
                <ul class="list-account-info">

                    <!-- NOTIFICATION -->
                    <li class="list-item notification">
                        <div class="notification-info item-click">
                            <i class="icon md-bell"></i>
                            <span class="itemnew"></span>
                        </div>
                        <div class="toggle-notification toggle-list">
                            <div class="list-profile-title">
                                <h4>Notification</h4>
                            </div>

                            <ul class="list-notification">
                                <?php
                                $notification = "";
                                $sql = "SELECT * FROM exReport";
                                $result = mysql_query($sql, $conn);
                                if (mysql_num_rows($result) > 0) {
                                    while($row = mysql_fetch_assoc($result)) {
                                        $content = $row["content"];
                                        if($content!=null){
                                            $notification = "<li class=\"ac-new\"><a class=\"viewWr\" href=\"#action\" target=\"popup\" onclick=\"window.open('viewNoti?type=viewExReport&ID=".base64_encode($row["id"])."','phure','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,width=700,height=400')\">".
                                            "<div class=\"list-body\"><div class=\"author\">".
                                            "<span>".convertExName($row["exID"])."</span>".
                                            "<div class=\"div-x\"></div></div>".
                                            "<p> has a problem report from a user.</p>".
                                            "</div></a></li>".$notification;
                                        }
                                    }
                                }
                                if($notification!=null)
                                    echo $notification;
                                ?>
                                
                            </ul>
                        </div>
                    </li>
                    <!-- END / NOTIFICATION -->

                	<li class="list-item account">
                        <div class="account-info item-click">
                            <img src="images/Student-Icon.png" alt="">
                        </div>
                        <div class="toggle-account toggle-list">
                            <ul class="list-account">
                            	<li><a href="/student"><span style="margin-left: 16px; color: #6a6a6;">Welcome, <?php echo $_SESSION['login']?></span></a></li>
                                <li><a href="#action" onclick="loadAction('account.php', null)"><i class="icon md-config"></i>Setting</a></li>
                                <li><a href="/logout"><i class="icon md-arrow-right"></i>Sign Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!-- END / LIST ACCOUNT INFO -->

            </nav>
            <!-- END / NAVIGATION -->

        </div>
    </header>
    <!-- END / HEADER -->

    <div class="col-md-8"  style:"padding-top: 100px;"></div>

		<section id="quizz-intro-section" class="quizz-intro-section learn-section">
        <div class="container">
            <div class="question-content-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="question-content" id="contentPage">
                        <?php echo $_ADMIN_FIRST_PAGE?>
                        </div>
                    </div>


                    
                </div>
            </div>
        </div>
        </section>
</div>
<!-- END / PAGE WRAP -->

<!-- Load jQuery -->
<script type="text/javascript" src="js/library/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/library/bootstrap.min.js"></script>
<script type="text/javascript" src="js/library/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/library/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script src="/script/jquery.scoped.js"></script>
<script src="/script/main.js"></script>
</body>
</html>
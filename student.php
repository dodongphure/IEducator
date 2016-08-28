<?php
require_once 'config.php';
if($user["role"]==$_ADMIN_CODE){
	header("location: admin");
}

function checkExDone($exID, $user, $conn){
	$sql = "SELECT scores FROM students WHERE stuID = \"".$user["stuID"]."\" LIMIT 1";
    $res = mysql_query($sql, $conn);
    if($res === FALSE) { 
        die(mysql_error());
    }
    while($re = mysql_fetch_array($res)) {
        $scores = $re["scores"];
        $scores = json_decode($scores, true);
        foreach ($scores as $key => $value) {
            if($key==$exID){
            	if($value==null) return false;
            	else return true;
            }
        }
    }
}
function addScores(&$scores, $dailyExArr, $exDay, $conn){
    $dailyExID = $dailyExArr[$exDay-1];
    $sql = "SELECT ex FROM dailyEx  LIMIT ".($dailyExID-1).",1";
    $res = mysql_query($sql, $conn);
    $ex="";
    if($res === FALSE) {
        die(mysql_error());
    }
    while($re = mysql_fetch_array($res)) {
        $ex = $re["ex"];
    }
    $ex=explode(",", $ex);
    $exArr=array();
    foreach ($ex as $key) {
        if((substr($key, 0, 3)=="ex2")||(substr($key, 0, 3)=="ex4")||(substr($key, 0, 3)=="ex5")||(substr($key, 0, 3)=="ex6")||
            (substr($key, 0, 3)=="ex8"))
            $count=1;
        else
            $count=3;
        $exArr[$key] = array('score' => '', 'count' => $count );
    }
    // $arrNull = array();
    // for ($i = 0; $i < count($ex); $i++) {
    //     $arrNull[$i] = "";
    // }
    // $score = array_combine($ex, $arrNull);
    $scores["day$exDay"] = $exArr;
}

$ex6Arr = array();
function myEx($day, $key, $count, &$ex6Arr){
    if(explode("\\.", $key)[0]=="ex6"){
        if($count>0)
            $ex6Cont = "<li id=\"exList$day-$key\"><a href=\"#action\" onclick=\"loadEx('$day-$key')\">".
            convertExName($key)." (".$count.")</a></li>";
        else
            $ex6Cont = "<li id=\"exList$day-$key\"><a>".convertExName($key)." - Done!</a></li>";
        array_push($ex6Arr, "exList".$day."-".$key."*/*".$ex6Cont);
        return "";
    }
    if($count>0)
        $result= "<li id=\"exList$day-$key\"><a href=\"#action\" onclick=\"loadEx('$day-$key')\">".
        convertExName($key)." (".$count.")</a></li>";
    else
        $result= "<li id=\"exList$day-$key\"><a>".convertExName($key)." - Done!</a></li>";
    return $result;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<title>Student page | IELTS Learning Website</title>
<link rel="stylesheet" href="script/bootstrap.min.css">
<script src="script/jquery.min.js"></script>
<script src="script/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.php.css">
<script src="script/main.js"></script>
<script src="script/jquery.min.js"></script>
<script src="script/bootstrap.min.js"></script>
<script src="script/sweetalert/sweet-alert.js"></script>
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
<body id="page-top" style="background-color:#eee">
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
                        <a href="student">Student Page</a>
                        <ul class="sub-menu">
                            <li id="reportExProblems"></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children megamenu col-4">
                            <?php   //RESET SCORES WHEN DELAY DAY
                                $curTime = date("Y-m-d H:i:s",time());
								$sql = "SELECT dailyGr, timeCreated FROM groups WHERE grID = \"".$user["grID"]."\" LIMIT 1";
						        $res = mysql_query($sql, $conn);
                                $countEx="";
                                $dailyExArr="";
                                $timeCreated="";
						        if($res === FALSE) {
						            die(mysql_error());
						        }
						        while($re = mysql_fetch_array($res)) {
                                    $timeCreated = $re["timeCreated"];
                                    //load dailyEx
                                    $sql = "SELECT dailyEx FROM dailyGr LIMIT ".($re["dailyGr"]-1).",1";
                                    $res_1 = mysql_query($sql, $conn);
                                    if($res_1 === FALSE) { 
                                        die(mysql_error());
                                    }
                                    while($re_1 = mysql_fetch_array($res_1)) {
                                        $dailyExArr = explode(",", $re_1["dailyEx"]);
                                        $countEx = count($dailyExArr);
                                    }
						        }
                                $countDay = intval(calDayEx($curTime, $timeCreated));
                                if ($timeCreated==null)
                                    $myExercisesDay = 0;
                                else
                                    $myExercisesDay = ($countDay+1);
                                echo '<a>My Exercises - Day ('.$myExercisesDay.')</a>
                                        <ul class="sub-menu my-exercises-list">';
                                if(($countDay < 0)||($timeCreated==null))
                                    echo "<li><a>No exercises!</a></li>";
                                else{
                                    //$exDay = $dailyExArr[$countDay];
                                    if($countDay < $countEx){
                                        $scores = $user["scores"];
                                        $scores = json_decode($scores, true);
                                        if($countDay >= count($scores)){//add ex until curTime
                                            $addExNum = $countDay-count($scores);//0
                                            for($i=$addExNum; $i>=0; $i--){
                                                addScores($scores, $dailyExArr, $countDay-$i+1, $conn);
                                            }
                                        }
                                        //show ex not done
                                        for($i=0; $i < count($scores)-1; $i++){
                                            $exArr=$scores["day".($i+1)];
                                            $oldEx="";
                                            $day = ($i+1);
                                            foreach ($exArr as $key => $value) {
                                                //if(checkExDone($ex, $user, $conn)){}
                                                if($value['count'] > 0){
                                                    //$oldEx .= "<li id=\"exList$day-$key\"><a href=\"#action\" onclick=\"loadEx('$day-$key')\">".convertExName($key)." (".$value['count'].")</a></li>";
                                                    $oldEx .= myEx($day, $key, $value['count'], $ex6Arr);
                                                } else if(explode("\\.", $key)[0] == "ex4"){//show ex4 style equals hidden
                                                    $oldEx .= "<li id=\"exList$day-$key\" style=\"display:none\"></li>";
                                                }
                                            }
                                            if($oldEx!=null){
                                                
                                                echo "<div class=\"my-ex-has-children\"><a>Day ".$day."</a></div>";
                                                echo "<div class=\"my-ex-list\">".$oldEx."</div>";

                                            }
                                        }
                                        //addScores($scores, $exDay, $conn);
                                        //current exercise day
                                        $exArr=$scores["day".($countDay+1)];
                                        $day=($countDay+1);

                                        echo "<div class=\"my-ex-has-children\"><a>Day ".$day."</a></div>";
                                        echo "<div class=\"my-ex-list\">";

                                        foreach ($exArr as $key => $value) {
                                            //if($value['count'] <= 0) echo "<li id=\"exList$day-$key\"><a>".convertExName($key)." - Done!</a></li>";
                                            //else echo "<li id=\"exList$day-$key\"><a href=\"#action\" onclick=\"loadEx('$day-$key')\">".convertExName($key)." (".$value['count'].")</a></li>";
                                            echo myEx($day, $key, $value['count'], $ex6Arr);
                                        }

                                        echo "</div>";

                                        $scores=json_encode($scores);
                                        $sql = "UPDATE students SET scores = '$scores' WHERE stuID= \"".$user["stuID"]."\"";
                                        if (mysql_query($sql, $conn)) {
                                            //echo "Update scores successfully";
                                        } else{
                                            echo "Error: <br>" . mysql_error($conn);
                                        }
                                    }
                                    else{
                                        $scores = $user["scores"];
                                        $scores = json_decode($scores, true);
                                        $countDay = $countEx;
                                        if($countDay >= count($scores)){//add ex until curTime
                                            $addExNum = $countDay-count($scores);
                                            for($i=$addExNum; $i>0; $i--){
                                                addScores($scores, $dailyExArr, $countEx-$i+1, $conn);
                                            }
                                        }
                                        //show ex not done
                                        $noEx = true;
                                        for($i=0; $i < count($scores); $i++){
                                            $day=($i+1);
                                            $exArr=$scores["day$day"];
                                            $oldEx="";
                                            foreach ($exArr as $key => $value) {
                                                //if(checkExDone($ex, $user, $conn)){}
                                                if($value['count'] > 0){
                                                    $noEx = false;
                                                    //$oldEx .=  "<li id=\"exList$day-$key\"><a href=\"#action\" onclick=\"loadEx('$day-$key')\">".convertExName($key)." (".$value['count'].")</a></li>";
                                                    $oldEx .= myEx($day, $key, $value['count'], $ex6Arr);

                                                }else if(explode("\\.", $key)[0] == "ex4"){//show ex4 style equals hidden
                                                    $oldEx .= "<li id=\"exList$day-$key\" style=\"display:none\"></li>";
                                                }
                                            }
                                            if($oldEx!=null){
                                                $day = ($i+1);

                                                echo "<div class=\"my-ex-has-children\"><a>Day ".$day."</a></div>";
                                                echo "<div class=\"my-ex-list\">".$oldEx."</div>";
                                            }
                                        }
                                        $scores=json_encode($scores);
                                        $sql = "UPDATE students SET scores = '$scores' WHERE stuID= \"".$user["stuID"]."\"";
                                        if (mysql_query($sql, $conn)) {
                                            //echo "Update scores successfully";
                                        } else{
                                            echo "Error: <br>" . mysql_error($conn);
                                        }
                                        if($noEx)
                                            echo "<li><a>No exercises!</a></li>";
                                    }
                                    echo "<script>reOrderMyEx('".base64_encode(implode("phure",$ex6Arr))."')</script>";
                                }
							?>
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
                                $sql = "SELECT * FROM students WHERE username=\"".$login_session."\"";
                                $result = mysql_query($sql, $conn);
                                if (mysql_num_rows($result) > 0) {
                                    while($row = mysql_fetch_assoc($result)) {
                                        $scores = $row["scores"];
                                        if($scores!=null){
                                            $scores = json_decode($scores, true);
                                            foreach ($scores as $key => &$value) {
                                                foreach ($value as $key_1 => &$value_1) {
                                                    //show Writing noti
                                                    if((substr($key_1, 0, 3)=="ex5")&&($value_1['score']!=null)){
                                                        $sql1 = "SELECT * FROM ex5wr WHERE id=".$value_1['score'];
                                                        $result1 = mysql_query($sql1, $conn);
                                                        if($result1 === FALSE) { 
                                                            die(mysql_error());
                                                        }
                                                        if (mysql_num_rows($result1) > 0) {
                                                            while($row1 = mysql_fetch_assoc($result1)) {
                                                                if($row1["checked"]==1){
                                                                    $notification = "<li class=\"ac-new\"><a class=\"viewWr\" href=\"#action\" target=\"popup\" onclick=\"window.open('viewNoti?type=".getExType($key_1)."&ID=".base64_encode($value_1['score'])."','phure','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,width=700,height=400')\">".
                                                                    "<div class=\"list-body\"><div class=\"author\">".
                                                                    "<span>".convertExName($key_1)."</span>".
                                                                    "<div class=\"div-x\"></div></div>".
                                                                    "<p> Teacher has checked your writing</p>".
                                                                    "</div></a></li>".$notification;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    //show reading key words noti
                                                    if((substr($key_1, 0, 3)=="ex6")&&($value_1['score']!=null)){
                                                        $sql1 = "SELECT * FROM studentData WHERE id=".$value_1['score'];
                                                        $result1 = mysql_query($sql1, $conn);
                                                        if($result1 === FALSE) { 
                                                            die(mysql_error());
                                                        }
                                                        if (mysql_num_rows($result1) > 0) {
                                                            while($row1 = mysql_fetch_assoc($result1)) {
                                                                if($row1["checked"]==1){
                                                                    $notification = "<li class=\"ac-new\"><a class=\"viewWr\" href=\"#action\" target=\"popup\" onclick=\"window.open('viewNoti?type=".getExType($key_1)."&ID=".base64_encode($value_1['score'])."','phure','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,width=700,height=400')\">".
                                                                    "<div class=\"list-body\"><div class=\"author\">".
                                                                    "<span>".convertExName($key_1)."</span>".
                                                                    "<div class=\"div-x\"></div></div>".
                                                                    "<p> Teacher has checked your exercise</p>".
                                                                    "</div></a></li>".$notification;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    //
                                                }
                                            }
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
                            	<li><a href="/student"><span style="margin-left: 16px; color: #6a6a6;">Welcome, <?php echo $login_session;?></span></a></li>
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
                    	<?php echo $_STUDENT_FIRST_PAGE?>
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
<?php mysql_close($conn); ?>
<?php  
// $DB_servername = "localhost";
// $DB_username = "root";
// $DB_password = "";
// $DB_name = "ielts_db";
// $_SITE_URL_PATH = "http://localhost/";//$_SITE_URL_PATH.'viewGroup.php'

$DB_servername = "localhost";
$DB_username = "ieltsvn_user";
$DB_password = "i-educator";
$DB_name = "ieltsvn_db";
$_SITE_URL_PATH = "http://i-educator.vn/";//$_SITE_URL_PATH.'viewGroup.php'





date_default_timezone_set("Asia/Bangkok");
$conn = mysql_connect($DB_servername, $DB_username, $DB_password);
if (!$conn) {
    die("Connection failed: " . mysql_connect_error());
}

$db_selected = mysql_select_db($DB_name, $conn);
if (!$db_selected) {
    die ('Can\'t use $DB_name : ' . mysql_error());
}
$login_session='';
if((htmlspecialchars(htmlentities(strip_tags($_SERVER['PHP_SELF'])))!="/trang-chu.php")&&
    (htmlspecialchars(htmlentities(strip_tags($_SERVER['PHP_SELF'])))!="/post.php")&&
    (htmlspecialchars(htmlentities(strip_tags($_SERVER['PHP_SELF'])))!="/gioi-thieu.php")&&
    (htmlspecialchars(htmlentities(strip_tags($_SERVER['PHP_SELF'])))!="/lien-he.php")&&
    (htmlspecialchars(htmlentities(strip_tags($_SERVER['PHP_SELF'])))!="/dang-nhap.php")&&
	(htmlspecialchars(htmlentities(strip_tags($_SERVER['PHP_SELF'])))!="/dang-ky.php")) {
	session_start();
	$username = $_SESSION['login'];
	$query = mysql_query("select * from students where username='$username'", $conn);
	$user = mysql_fetch_assoc($query);
	$login_session = $user['username'];
	if(!isset($login_session)){
		header("location: dang-nhap");
	}
}

$_ADMIN_CODE = "tv3TFmfcGLr0q";

$_ADMIN_FIRST_PAGE = '<h4 class="sm">Welcome, <strong>'.$login_session.'</strong>! Please choose your actions!</h4>'.
'<h4 class="sm">Any help about technical support? Email: <a href="mailto:support@i-educator.vn">support@i-educator.vn</a></h4>';
$_STUDENT_FIRST_PAGE = '<h4 class="sm">Welcome, <strong>'.$login_session.'</strong>! Please choose exercises!</h4>'.
'<h4 class="sm">Any help about technical support? Email: <a href="mailto:support@i-educator.vn">support@i-educator.vn</a></h4>';




/*

GENERAL FUNCTIONS USED BY OTHER FILE

*/

//convert DB exID to UI exID
function convertEx($exID){
    switch ($exID) {
        case '1':
            return '1';
            break;

        case '2':
            return '2';
            break;

        case '3':
            return '3';
            break;

        case '4':
            return '4';
            break;

        case '5':
            return '6';
            break;

        case '6':
            return '5';
            break;

        case '7':
            return '7';
            break;

        case '8':
            return '8';
            break;

        case '9':
            return '9';
            break;

        case '10':
            return '10';
            break;
        
        default:
           return 'null';
            break;
    }
}

function convertExName($exID){
    $exID = explode(".", $exID);
    $exType = $exID[0];
    $IDnum = substr($exType, 2, 2);
    $IDnum = convertEx($IDnum);
    $ex = $exID[1];
    $res="";
    switch ($IDnum) {
        case '1':
            $res="Exercise 1 (VOA)";
            break;
        case '2':
            $res="Exercise 2 (BBC)";
            break;
        case '3':
            $res="Exercise 3 (Listening)";
            break;
        case '4':
            $res="Exercise 4 (Reading)";
            break;
        case '5':
            $res="Exercise 5 (Reading Keywords)";
            break;
        case '6':
            $res="Exercise 6 (Writing)";
            break;
        case '7':
            $res="Exercise 7 (Grammar)";
            break;
        case '8':
            $res="Exercise 8 (Movies)";
            break;
        case '9':
            $res="Exercise 9 (Toeic Listening)";
            break;
        case '10':
            $res="Exercise 10 (Toeic Reading)";
            break;
        default:
            break;
    }
    return $res.=" - Task ".$ex;
}
function calDayEx($curTime, $timeCreated){
    if ($timeCreated==null) return null;
    $curTime_1=date_create($curTime);
    $timeCreated_1=date_create($timeCreated);
    $diff=date_diff($timeCreated_1,$curTime_1);
    //exept Sunday
    $countDay = intval($diff->format("%R%a"));//echo $countDay;
    
    $tmp_date = $timeCreated;
    $count = 0;
    while(date('w', strtotime($tmp_date)) != 0){
        $count++;
        $tmp_date = date("Y-m-d H:i:s", strtotime($tmp_date .' +1 day'));
    } //echo $count;
    if($countDay < $count){
        return $countDay;
    } else {
        $lastDay = $countDay - $count;
        return $countDay - 1 - floor(($lastDay)/7);
    }
}
function getExType($exID){
    $exID = explode(".", $exID);
    $exType = $exID[0];
    return $exType;
}
function checkText($text){
    $result = htmlspecialchars($text);
    $result = htmlentities($result);
    $result = addslashes($result);
    return $result;
}
function isExViewer($exType){
    if (($exType == 'ex2')||($exType == 'ex5')||($exType == 'ex6')||($exType == 'ex8')) return true;
    else return false;
}
function getTableFromIdx($tbl){
    $tbl_name='';
    switch ($tbl) {
        case 1:
            $tbl_name = 'postData';
            break;
        case 2:
            $tbl_name = 'tailieu';
            break;
        case 3:
            $tbl_name = 'giaide';
            break;
        default:
            break;
    }
    return $tbl_name;
}

function getRenderedHTML($path, $pageTitle)
{
    ob_start();
    $_DEFAULT_PAGE_TITLE = 'Trung tâm luyện thi IELTS, TOEIC - I-EDUCATOR';
    if($pageTitle == null)
        $_PAGE_TITLE = $_DEFAULT_PAGE_TITLE;
    else
        $_PAGE_TITLE = $pageTitle." - ".$_DEFAULT_PAGE_TITLE;
    include($path);
    $var=ob_get_contents(); 
    ob_end_clean();
    return $var;
}

?>
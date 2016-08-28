<?php
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
    header("location: student.php");
}
function isEx5($exID){
    $exID = explode(".", $exID);
    $exType = $exID[0];
    if ($exType == 'ex5') return true;
    else return false;
}
function isContain($arr, $ele){
    $count = count($arr);
    for($j=0; $j<$count; $j++){
        if($arr[$j] == $ele)
            return true;
    }
    return false;
}
if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
    $sql = "SELECT * FROM students WHERE stuID=".$_POST["deleteRecord"];
    $result = mysql_query($sql, $conn);
    if (mysql_num_rows($result) > 0) {
        while($row = mysql_fetch_assoc($result)) {
            if ($row["role"]==$_ADMIN_CODE) continue;
            if($row["scores"]!=null){
                $scores=$row["scores"];
                $scores = json_decode($scores, true);
                foreach ($scores as $key => $value) {
                    foreach ($value as $key_1 => $value_1) {
                        if(substr($key_1, 0, 3)=='ex5'){
                            $delete_query = "DELETE FROM ex5wr WHERE id =".$value_1;
                            if (mysql_query($delete_query, $conn)) {
                                //echo "Record deleted successfully<br>";
                            }
                            else {
                                echo "Error deleting record: " . mysql_error($conn);
                            }
                        }else if(isExViewer(substr($key_1, 0, 3))){
                            $delete_query = "DELETE FROM studentData WHERE id =".$value_1;
                            if (mysql_query($delete_query, $conn)) {
                                //echo "Record deleted successfully<br>";
                            }
                            else {
                                echo "Error deleting record: " . mysql_error($conn);
                            }
                        }
                    }
                }
            }
        }
    }
	$delete_query = "DELETE FROM students WHERE stuID =".$_POST["deleteRecord"];
	if (mysql_query($delete_query, $conn)) {
    	echo "Record deleted successfully<br>";
	}
	else {
	    echo "Error deleting record: " . mysql_error($conn);
	}
}

$sql = "SELECT * FROM students";
$result = mysql_query($sql, $conn);
if (mysql_num_rows($result) > 0) {
	$index=0;
    ?>
    <div class="table-student-submission">
    <table class="mc-table">
        <thead>
            <tr>
                <th width="5%" class="submissions">No.</th>
                <th width="25%" class="author">Username<span class="caret"></span></th>
                <th width="15%" class="submit-date">Average score<span class="caret"></span></th>
                <th width="25%" class="submit-date">Note<span class="caret"></span></th>
                <th class="submit-date">Action<span class="caret"></span></th>
            </tr>
        </thead>

        <tbody>
    <?php
    //use to check redundant data
    $ex5Arr = array();
    $exStuDataArr = array();
    while($row = mysql_fetch_assoc($result)){
        if ($row["role"]==$_ADMIN_CODE) continue;
        $index++;
        $avgScore="N/A";
        $scoresList=$row["scores"];
        if($scoresList!=null){
            $scoresList=json_decode($scoresList, true);
            $a=$b=0;
            foreach ($scoresList as $key => $value) {
                foreach ($value as $key_1 => $value_1) {
                    if(($value_1['score']!=null)&&(substr($key_1, 0, 3)!='ex2')&&(substr($key_1, 0, 3)!='ex5')&&(substr($key_1, 0, 3)!='ex6')&&(substr($key_1, 0, 3)!='ex8')){
                        $a += intval(explode("/", $value_1['score'])[0]);
                        $b += intval(explode("/", $value_1['score'])[1]);
                    }else if(substr($key_1, 0, 3) == 'ex5')
                        array_push($ex5Arr, $value_1['score']);
                    else if(isExViewer(substr($key_1, 0, 3)))
                        array_push($exStuDataArr, $value_1['score']);
                }
            }
            if($b!=0)
                $avgScore=(($a/$b)*10)."/10";
        }
        ?>
        <tr>
            <td class="submissions"><?php echo $index ?></td>
            <td class="author"><?php echo $row["username"] ?></td>
            <td class="submit-date"><?php echo $avgScore ?></td>
            <td class="submit-date"><?php if($row["role"]!=null) echo "Member: ".$row["role"]."<br>";if($row["name"]!=null) echo "Name: ".$row["name"]."<br>";if($row["email"]!=null) echo "Email: ".$row["email"]."<br>"; ?></td>
            <td class="submit-date"><?php echo "<form id=\"formDelete".$row["stuID"]."\" method=\"post\">
            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$row["stuID"]."\">
            <input type=\"hidden\" name=\"stuName\" value=\"".$row["username"]."\">
            <button class=\"mc-btn btn-style-1\" onclick=\"loadAction('viewStuEx.php','formDelete".$row["stuID"]."')\" type=\"button\">View Exercises</button>
            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewStu.php','formDelete".$row["stuID"]."')\" type=\"button\">Delete</button>
            </form>" ?></td>
        </tr>
        <?php
    }
    //list all ex5wr ID
    $ex5wrID = array();
    $sql = "SELECT * FROM ex5wr";
    $result = mysql_query($sql, $conn);
    if (mysql_num_rows($result) > 0) {
        while($row = mysql_fetch_assoc($result)){
            array_push($ex5wrID, $row['id']);
        }
    }
    for($i=0; $i<count($ex5wrID); $i++){
        if(!isContain($ex5Arr, $ex5wrID[$i])&&count($ex5Arr)>0){
            $delete_query = "DELETE FROM ex5wr WHERE id =".$ex5wrID[$i];
            if (mysql_query($delete_query, $conn)) {
                //echo "Record deleted successfully<br>";
            }
            else {
                echo "Error deleting record: " . mysql_error($conn);
            }
        }
    }
    //list all studentData ID
    $studentDataID = array();
    $sql = "SELECT * FROM studentData";
    $result = mysql_query($sql, $conn);
    if (mysql_num_rows($result) > 0) {
        while($row = mysql_fetch_assoc($result)){
            array_push($studentDataID, $row['id']);
        }
    }
    for($i=0; $i<count($studentDataID); $i++){
        if(!isContain($exStuDataArr, $studentDataID[$i])&&count($exStuDataArr)>0){
            $delete_query = "DELETE FROM studentData WHERE id =".$studentDataID[$i];
            if (mysql_query($delete_query, $conn)) {
                //echo "Record deleted successfully<br>";
            }
            else {
                echo "Error deleting record: " . mysql_error($conn);
            }
        }
    }
    ?>
    </tbody>
    </table>
    </div>
    <?php
}
else {
    echo "0 students";
}

mysql_close($conn);

?>
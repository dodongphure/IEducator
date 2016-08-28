<?php
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
    header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST["deleteRecord"])){
    //delete writing
    $query = mysql_query("select stu from groups where grID=".$_POST['deleteRecord'], $conn);
    if($query === FALSE) { 
        die(mysql_error());
    }
    $rows = mysql_num_rows($query);
    if($rows == 1){
        $stuArr = explode(",", mysql_fetch_assoc($query)["stu"]);
        foreach ($stuArr as $key => $value) {
            $query_1 = mysql_query("select scores from students where username='".$value."'", $conn);
            if($query_1 === FALSE) { 
                die(mysql_error());
            }
            $rows_1 = mysql_num_rows($query_1);
            if($rows_1 == 1){
                $scores = json_decode(mysql_fetch_assoc($query_1)["scores"], true);
                if($scores!=null){
                    foreach ($scores as $key_1 => $value_1) {
                        foreach ($value_1 as $key_2 => $value_2) {
                            if(substr($key_2, 0, 3)=='ex5'){
                                $delete_query = "DELETE FROM ex5wr WHERE id =".$value_2['score'];
                                if (mysql_query($delete_query, $conn)) {
                                    //echo "Record deleted successfully<br>";
                                }
                                else {
                                    //echo "Error deleting record: " . mysql_error($conn);
                                }
                            }else if(isExViewer(substr($key_2, 0, 3))){
                                $delete_query = "DELETE FROM studentData WHERE id =".$value_2['score'];
                                if (mysql_query($delete_query, $conn)) {
                                    //echo "Record deleted successfully<br>";
                                }
                                else {
                                    //echo "Error deleting record: " . mysql_error($conn);
                                }
                            }
                        }
                    }
                }
            }

            $sql = "UPDATE students SET scores = NULL, grID = NULL WHERE username='".$value."'";
            if (mysql_query($sql, $conn)) {
                //echo "Assign exercises successfully<br>";
            } else{
                echo "Error: " . $sql . "<br>" . mysql_error($conn);
            }
        }
    }

    $delete_query = "DELETE FROM groups WHERE grID =".$_POST["deleteRecord"];
    if (mysql_query($delete_query, $conn)) {
        echo "Record deleted successfully<br>";
    }
    else {
        echo "Error deleting record: " . mysql_error($conn);
    }
}

$sql = "SELECT * FROM groups";
$result = mysql_query($sql, $conn);
if (mysql_num_rows($result) > 0) {
    $index=0;
    ?>
    <div class="table-student-submission">
    <table class="mc-table">
        <thead>
            <tr>
                <th width="5%" class="submissions">No.</th>
                <th width="35%" class="author">Students<span class="caret"></span></th>
                <th width="25%" class="submit-date">Exercises group ID<span class="caret"></span></th>
                <th width="15%" class="submit-date">Current exercise<span class="caret"></span></th>
                <th width="45%" class="submit-date">Action<span class="caret"></span></th>
            </tr>
        </thead>

        <tbody>
    <?php
    $curTime = date("Y-m-d H:i:s",time());
    while($row = mysql_fetch_assoc($result)) {
        $index++;
        ?>
            <tr>
                <td class="submissions"><?php echo $index ?></td>
                <td class="author">
                    <?php if($row["grID"]==1) echo "Guest members";
                    else {
                        $stuArr = explode(",", $row["stu"]);
                        for($i=0; $i<count($stuArr); $i++) {
                            echo "<form id=\"formStu".$stuArr[$i]."\" method=\"post\">
                            <input type=\"hidden\" name=\"stuName\" value=\"".$stuArr[$i]."\">
                            <a class=\"a-cursor-pointer\" onclick=\"loadAction('viewStuEx.php','formStu".$stuArr[$i]."')\">".$stuArr[$i]."</a>
                            </form>";
                        }
                    }?>
                </td>
                <td class="submit-date"><?php echo $row["dailyGr"] ?></td>
                <td class="author">Day <?php echo intval(calDayEx($curTime, $row["timeCreated"]))+1 ?></td>
                <td class="submit-date"><?php echo "<form id=\"formDelete".$row["grID"]."\" method=\"post\">
            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$row["grID"]."\">
            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editGroup', ".$row["grID"].")\" type=\"button\">Edit</button>";
            if($row["grID"]!=1) echo "<button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewGroup.php','formDelete".$row["grID"]."')\" type=\"button\">Delete</button>
            </form>" ?></td>
            </tr>
        <?php
    }
    ?>
    </tbody>
    </table>
    </div>
    <?php
}
else {
    echo "0 groups";
}

mysql_close($conn);

?>
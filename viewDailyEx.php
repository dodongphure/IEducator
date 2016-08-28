<?php
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
    header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
	$delete_query = "DELETE FROM dailyEx WHERE id =".$_POST["deleteRecord"];
	if (mysql_query($delete_query, $conn)) {
    	echo "Record deleted successfully<br>";
	}
	else {
	    echo "Error deleting record: " . mysql_error($conn);
	}
}

$sql = "SELECT * FROM dailyEx";
$result = mysql_query($sql, $conn);
if (mysql_num_rows($result) > 0) {
    $index=0;
    ?>
    <div class="table-student-submission">
    <table class="mc-table">
        <thead>
            <tr>
                <th width="15%" class="submissions">Exercise Day</th>
                <th width="55%" class="submit-date">Exercises List<span class="caret"></span></th>
                <th class="submit-date">Action<span class="caret"></span></th>
            </tr>
        </thead>

        <tbody>
    <?php
    while($row = mysql_fetch_assoc($result)) {
        $index++;
        $exArr = explode(",", $row["ex"]);
        $exList="";
        for($i=0; $i<count($exArr); $i++){
            $exList .= convertExName($exArr[$i])."<br>";
        }
        ?>
            <tr>
                <td width="5%" class="submissions"><?php echo $index ?></td>
                <td width="35%" class="submit-date"><?php echo $exList ?></td>
                <td class="submit-date"><?php echo "<form id=\"formDelete".$row["id"]."\" method=\"post\">
            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$row["id"]."\">
            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editDailyEx', ".$row["id"].")\" type=\"button\">Edit</button>
            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewDailyEx.php','formDelete".$row["id"]."')\" type=\"button\">Delete</button>
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
    echo "0 daily exercises";
}

mysql_close($conn);

?>
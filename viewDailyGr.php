<?php
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
    header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST["deleteRecord"])){
	$delete_query = "DELETE FROM dailyGr WHERE id =".$_POST["deleteRecord"];
	if (mysql_query($delete_query, $conn)) {
    	echo "Record deleted successfully<br>";
	}
	else {
	    echo "Error deleting record: " . mysql_error($conn);
	}
}

$sql = "SELECT * FROM dailyGr";
$result = mysql_query($sql, $conn);
if (mysql_num_rows($result) > 0) {
    $index=1;
    ?>
    <div class="table-student-submission">
    <table class="mc-table">
        <thead>
            <tr>
                <th width="5%" class="submissions">No.</th>
                <th width="50%" class="author">Exercises Day ID<span class="caret"></span></th>
                <th width="45%" class="submit-date">Action<span class="caret"></span></th>
            </tr>
        </thead>

        <tbody>
        <tr>
            <td class="submissions">1</td>
            <td class="author"><?php echo mysql_fetch_assoc($result)['dailyEx']?></td>
            <td class="submit-date"><?php echo "<form id=\"formDelete1\" method=\"post\">
            <input type=\"hidden\" name=\"deleteRecord\" value=\"1\">
            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editDailyGr', 1)\" type=\"button\">Edit</button>
            <button class=\"mc-btn btn-style-1\" type=\"button\" disabled>Used for Guest members</button>
            </form>" ?></td>
        </tr>
    <?php
    while($row = mysql_fetch_assoc($result)) {
        if($row["id"] == 1) continue;
        $index++;
        ?>
            <tr>
                <td class="submissions"><?php echo $index ?></td>
                <td class="author"><?php echo $row["dailyEx"] ?></td>
                <td class="submit-date"><?php echo "<form id=\"formDelete".$row["id"]."\" method=\"post\">
	            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$row["id"]."\">
	            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editDailyGr', ".$row["id"].")\" type=\"button\">Edit</button>
	            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewDailyGr.php','formDelete".$row["id"]."')\" type=\"button\">Delete</button>
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
    echo "0 exercises group";
}

mysql_close($conn);

?>
<?php
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
    header("location: student.php");
}

if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
	$delete_query = "DELETE FROM emailRegister WHERE id =".$_POST["deleteRecord"];
	if (mysql_query($delete_query, $conn)) {
    	echo "Record deleted successfully<br>";
	}
	else {
	    echo "Error deleting record: " . mysql_error($conn);
	}
}

$sql = "SELECT * FROM emailRegister";
$result = mysql_query($sql, $conn);
if (mysql_num_rows($result) > 0) {
	$index=0;
    ?>
    <div class="table-student-submission">
    <table class="mc-table">
        <thead>
            <tr>
                <th width="15%" class="submissions">No.</th>
                <th width="60%" class="author">Email Address<span class="caret"></span></th>
                <th width="25%" class="submit-date">Action<span class="caret"></span></th>
            </tr>
        </thead>

        <tbody>
    <?php
    while($row = mysql_fetch_assoc($result)){
        $index++;
        ?>
        <tr>
            <td class="submissions"><?php echo $index ?></td>
            <td class="author"><?php echo $row["emailContent"] ?></td>
            <td class="submit-date"><?php echo "<form id=\"formDelete".$row["id"]."\" method=\"post\">
            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$row["id"]."\">
            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEmailRegister.php','formDelete".$row["id"]."')\" type=\"button\">Delete</button>
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
    echo "0 emails";
}
mysql_close($conn);
?>
<?php
require_once 'config.php';
if($login_session==""){
	header("location: admin");
}
if (($_SERVER['REQUEST_METHOD'] == 'GET')&&isset($_GET["type"])&&isset($_GET["ID"])){
    ?>
    <meta charset="utf-8" />
    <?php
    switch ($_GET["type"]) {
        case 'ex5':
            if(!is_numeric(base64_decode($_GET["ID"]))){
                echo "No data!";
                break;
            }
            $ex5wrID = checkText(base64_decode($_GET["ID"]));
            $sql = "SELECT * FROM ex5wr WHERE id=".$ex5wrID;
            $result = mysql_query($sql, $conn);
            if($result === FALSE) { 
                die(mysql_error());
            }
            if (mysql_num_rows($result) > 0) {
                ?>
                <table border="1" style="width:100%"><?php
                while($row = mysql_fetch_assoc($result)) {
                    ?>
                    <tr>Topic: <strong><?php echo $row["topic"]; ?></strong></tr>
                    <tr><td><strong>OUTLINE</strong></td></tr>
                    <tr><td>- Main idea 1</td>
                    <td><?php echo $row["main1input"]; ?></td></tr>
                    <tr><td>+ Supporting idea 1</td>
                    <td><?php echo $row["sup1input"]; ?></td></tr>
                    <tr><td>- Main idea 2</td>
                    <td><?php echo $row["main2input"]; ?></td></tr>
                    <tr><td>+ Supporting idea 2</td>
                    <td><?php echo $row["sup2input"]; ?></td></tr>

                    <tr><td><strong>FULL SENTENCES</strong></td></tr>
                    <tr><td>- Main idea 1</td>
                    <td><?php echo $row["main1"]; ?></td></tr>
                    <tr><td>+ Supporting idea 1</td>
                    <td><?php echo $row["sup1"]; ?></td></tr>
                    <tr><td>- Main idea 2</td>
                    <td><?php echo $row["main2"]; ?></td></tr>
                    <tr><td>+ Supporting idea 2</td>
                    <td><?php echo $row["sup2"]; ?></td></tr>
                    </table>
                    <form id="formSubmit" method="post"><input type="hidden" name="ex5wrRemoveCheckID" value="<?php echo $ex5wrID?>">
                    </form>
                    <a href="#action" onclick="document.getElementById('formSubmit').submit()">➤ Remove notification for this exercise!</a>
                    <?php
                }
            }
            else
                echo "No data!";
            break;

        case 'ex6':
            if(!is_numeric(base64_decode($_GET["ID"]))){
                echo "No data!";
                break;
            }
            $id = checkText(base64_decode($_GET["ID"]));
            $sql = "SELECT * FROM studentData WHERE id=".$id;
            $result = mysql_query($sql, $conn);
            if($result === FALSE) { 
                die(mysql_error());
            }
            if (mysql_num_rows($result) > 0) {
                ?>
                <table border="1" style="width:100%"><?php
                while($row = mysql_fetch_assoc($result)) {
                    $keywords = explode("*/*", $row["att1"]);
                    $answer = explode("*/*", $row["att2"]);
                    ?>
                    <tr>
                        <th width="50%">Keywords</th>
                        <th width="50%">Answers</th>
                    </tr>
                    <?php
                    for($i=0; $i<count($keywords); $i++){
                        ?>
                        <tr>
                            <td><?php echo $keywords[$i]; ?></td>
                            <td><?php echo $answer[$i]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    <form id="formSubmit" method="post"><input type="hidden" name="ex6RemoveCheckID" value="<?php echo $id?>">
                    </form>
                    <a href="#action" onclick="document.getElementById('formSubmit').submit()">➤ Remove notification for this exercise!</a>
                    <?php
                }
            }
            else
                echo "No data!";
            break;

        case 'viewExReport':
            if(!is_numeric(base64_decode($_GET["ID"]))){
                echo "No data!";
                break;
            }
            $id = checkText(base64_decode($_GET["ID"]));
            $sql = "SELECT * FROM exReport WHERE id=".$id;
            $result = mysql_query($sql, $conn);
            if($result === FALSE) { 
                die(mysql_error());
            }
            if (mysql_num_rows($result) > 0) {
                ?>
                <table border="1" style="width:100%"><?php
                while($row = mysql_fetch_assoc($result)) {
                    $reportID = $row["id"];
                    ?>
                    From student: <strong><?php echo $row["stuName"]; ?></strong><br>
                    Exercise: <strong><?php echo convertExName($row["exID"]); ?></strong>
                    <tr><td>Errors</td>
                    <td><?php echo $row["content"]; ?></td></tr>
                    </table>
                    <form id="formSubmit" method="post"><input type="hidden" name="reportID" value="<?php echo $reportID?>">
                    </form>
                    <a href="#action" onclick="document.getElementById('formSubmit').submit()">➤ Remove this notification!</a>
                    <?php
                }
            }
            break;

        default:
            # code...
            break;
    }
	
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST["ex5wrRemoveCheckID"])){
    $query = "UPDATE ex5wr SET checked=0 WHERE id =".$_POST["ex5wrRemoveCheckID"];
    if (mysql_query($query, $conn)) {
        echo "Notification deleted successfully!<br>";
    }
    else {
        //echo "Error deleting record: " . mysql_error($conn);
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST["ex6RemoveCheckID"])){
    $query = "UPDATE studentData SET checked=0 WHERE id =".$_POST["ex6RemoveCheckID"];
    if (mysql_query($query, $conn)) {
        echo "Notification deleted successfully!<br>";
    }
    else {
        //echo "Error deleting record: " . mysql_error($conn);
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')&&isset($_POST["reportID"])){
    $delete_query = "DELETE FROM exReport WHERE id =".$_POST["reportID"];
    if (mysql_query($delete_query, $conn)) {
        echo "Notification deleted successfully!<br>";
    }
    else {
        //echo "Error deleting record: " . mysql_error($conn);
    }
}
?>
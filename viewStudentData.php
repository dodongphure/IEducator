<?php 
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
    header("location: student.php");
}
/*
    Admin view done student exercise
*/
if (($_SERVER['REQUEST_METHOD'] == 'GET')&&!empty($_GET["type"])&&!empty($_GET["ID"])){
    $dataID = htmlspecialchars(addslashes(base64_decode($_GET["ID"])));
    ?>
    <meta charset="utf-8" />
    <script src="script/jquery.min.js"></script>
    <script src="script/main.js"></script>
    <script src="/script/sweetalert/sweet-alert.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/library/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/script/sweetalert/sweet-alert.css">
    <?php
    switch ($_GET["type"]) {
        case 'ex2':
            if(!is_numeric(base64_decode($_GET["ID"]))){
                echo "No data!";
                break;
            }
            $sql = "SELECT * FROM studentData WHERE id=".$dataID;
            $result = mysql_query($sql, $conn);
            if($result === FALSE) { 
                die(mysql_error());
            }
            if (mysql_num_rows($result) > 0) {
                ?><table border="1" style="width:100%"><tr>
                    <th width="50%">Questions</th>
                    <th width="50%">Answers</th>
                </tr><?php
                while($row = mysql_fetch_assoc($result)) {
                    $question = explode("*/*", $row["att1"]);
                    $answer = explode("*/*", $row["att2"]);
                    for($i=0; $i<count($question); $i++){
                    ?>
                        <tr>
                            <td><?php echo $question[$i] ?></td>
                            <td><?php echo $answer[$i] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </table>
                    <?php
                }
            }
            else
                echo "No data!";
            break;

        case 'ex5':
            if(!is_numeric(base64_decode($_GET["ID"]))){
                echo "No data!";
                break;
            }
            $sql = "SELECT * FROM ex5wr WHERE id=".$dataID;
            $result = mysql_query($sql, $conn);
            if($result === FALSE) { 
                die(mysql_error());
            }
            if (mysql_num_rows($result) > 0) {
                ?>
                <form id="formUpload" enctype="multipart/form-data" method="post">
                <table border="1" style="width:100%"><?php
                while($row = mysql_fetch_assoc($result)) {
                    ?><input type="hidden" name="editEx5ID" value="<?php echo $row['id'];?>">
                    <tr>Topic: <strong><?php echo $row["topic"]; ?></strong></tr>
                    <tr><td><strong>OUTLINE</strong></td></tr>
                    <tr><td>- Main idea 1</td>
                    <td><input class="ans" name="main1input" style="width:100%" value="<?php echo $row["main1input"];?>"></td></tr>
                    <tr><td>+ Supporting idea 1</td>
                    <td><input class="ans" name="sup1input" style="width:100%" value="<?php echo $row["sup1input"];?>"></td></tr>
                    <tr><td>- Main idea 2</td>
                    <td><input class="ans" name="main2input" style="width:100%" value="<?php echo $row["main2input"];?>"></td></tr>
                    <tr><td>+ Supporting idea 2</td>
                    <td><input class="ans" name="sup2input" style="width:100%" value="<?php echo $row["sup2input"];?>"></td></tr>
                    
                    <tr><td><strong>FULL SENTENCES</strong></td></tr>
                    <tr><td>- Main idea 1</td>
                    <td><textarea class="ans" name="main1" style="width:100%"><?php echo $row["main1"]; ?></textarea></td></tr>
                    <tr><td>+ Supporting idea 1</td>
                    <td><textarea class="ans" name="sup1" style="width:100%"><?php echo $row["sup1"]; ?></textarea></td></tr>
                    <tr><td>- Main idea 2</td>
                    <td><textarea class="ans" name="main2" style="width:100%"><?php echo $row["main2"]; ?></textarea></td></tr>
                    <tr><td>+ Supporting idea 2</td>
                    <td><textarea class="ans" name="sup2" style="width:100%"><?php echo $row["sup2"]; ?></textarea></td></tr>
                    </table></form>
                    <button onclick="confirmLoadActionEx5('viewStudentData.php', 'formUpload')" type="button">Check!</button>
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
            $sql = "SELECT * FROM studentData WHERE id=".$dataID;
            $result = mysql_query($sql, $conn);
            if($result === FALSE) { 
                die(mysql_error());
            }
            if (mysql_num_rows($result) > 0) {
                ?>
                <form id="formUpload" enctype="multipart/form-data" method="post">
                <table border="1" style="width:100%"><tr>
                    <th width="50%">Keywords</th>
                    <th width="50%">Answers</th>
                </tr><?php
                while($row = mysql_fetch_assoc($result)) {
                    $keywords = explode("*/*", $row["att1"]);
                    $answer = explode("*/*", $row["att2"]);
                    ?>
                    <input type="hidden" name="editEx6ID" value="<?php echo $row['id'];?>">
                    <?php
                    for($i=0; $i<count($keywords); $i++){
                    ?>
                        <tr>
                            <td><?php echo $keywords[$i] ?></td>
                            <td><textarea name="answer[]" style="width:100%"><?php echo $answer[$i] ?></textarea></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                </form>
                <button onclick="confirmLoadActionEx5('viewStudentData.php', 'formUpload')" type="button">Check!</button>
                    <?php
                }
            }
            else
                echo "No data!";
            break;

        case 'ex8':
            if(!is_numeric(base64_decode($_GET["ID"]))){
                echo "No data!";
                break;
            }
            $sql = "SELECT * FROM studentData WHERE id=".htmlspecialchars(addslashes(base64_decode($_GET["ID"])));
            $result = mysql_query($sql, $conn);
            if($result === FALSE) { 
                die(mysql_error());
            }
            if (mysql_num_rows($result) > 0) {
                ?><table border="1" style="width:100%"><tr>
                    <th width="20%">Title</th>
                    <th width="50%">Summerize</th>
                </tr><?php
                while($row = mysql_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["att1"] ?></td>
                            <td><?php echo $row["att2"] ?></td>
                        </tr>
                    </table>
                    <?php
                }
            }
            else
                echo "No data!";
            break;

        default:
            # code...
            break;
    }
	
}
//edit Ex5Wr (Writing)
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["editEx5ID"])){
    $sql = "UPDATE ex5wr SET ".
    "main1input=\"".htmlspecialchars($_POST['main1input'])."\",".
    "sup1input=\"".htmlspecialchars($_POST['sup1input'])."\",".
    "main2input=\"".htmlspecialchars($_POST['main2input'])."\",".
    "sup2input=\"".htmlspecialchars($_POST['sup2input'])."\",".
    "main1=\"".htmlspecialchars($_POST['main1'])."\",".
    "sup1=\"".htmlspecialchars($_POST['sup1'])."\",".
    "main2=\"".htmlspecialchars($_POST['main2'])."\",".
    "sup2=\"".htmlspecialchars($_POST['sup2'])."\", checked=1 WHERE id =".$_POST["editEx5ID"];
    if (mysql_query($sql, $conn)) {
        echo "Edit this writing successfully!";
    }
    else {
        echo "Error: " . mysql_error($conn);
    }
}

//edit ex6 (Reading Keywords)
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["editEx6ID"])){
    $answer = implode("*/*", ($_POST['answer']));
    $sql = "UPDATE studentData SET att2=\"".checkText($answer)."\", checked=1 WHERE id =".$_POST["editEx6ID"];
    if (mysql_query($sql, $conn)) {
        echo "Edit this writing successfully!";
    }
    else {
        echo "Error: " . mysql_error($conn);
    }
}
?>
<?php 
require_once 'config.php';
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["stuID"])&&!empty($_POST["exID"])&&!empty($_POST["score"])) {
    $day = explode("-", $_POST["exID"])[0];
    $exID = explode("-", $_POST["exID"])[1];
    $isScored = false;
    $sql = "SELECT * FROM students WHERE stuID=".$_POST["stuID"];
    $result = mysql_query($sql, $conn);
    if (mysql_num_rows($result) == 1) {
        while($row = mysql_fetch_assoc($result)) {
            $oldScore = json_decode($row["scores"], true);
            $count=0;
            foreach ($oldScore as $key => &$value) {
                if($key=="day".$day){
                    foreach ($value as $key_1 => &$value_1) {
                        if($key_1==explode("-", $_POST["exID"])[1]){
                            if($value_1['count'] <= 0)
                                $isScored = true;
                            else{
                                $value_1['score']=$_POST["score"];
                                $value_1['count']--;
                                $count=$value_1['count'];
                            }
                        }
                    }
                }
            }
            if(!$isScored){
                $newScore = json_encode($oldScore);
                $sql = "UPDATE students SET scores = '$newScore' WHERE stuID=".$_POST["stuID"];
                if (mysql_query($sql, $conn)) {
                    echo "Update scores successfully. You have $count last times to re-do this exercise!\n";
                } else{
                    echo "Error: <br>" . mysql_error($conn);
                }
            }
            else
                echo "You have done this exercise!";
            echo "/*DoDongPhure*/$count";
        }
    }
    else echo "0 students";
}
?>
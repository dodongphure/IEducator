<?php
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
    header("location: student.php");
}
if(!empty($_GET['Ex'])){
    echo "<strong>View Exercise ".convertEx($_GET['Ex'])."</strong><br>";
    switch ($_GET['Ex']) {
        case '1':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])&&isset($_POST["deleteFile"])){
                if (file_exists($_POST["deleteFile"])) {
                    if (!unlink($_POST["deleteFile"]))
                        echo ("Error deleting".$_POST['deleteFile']);
                }
                else
                    echo "File does not exist!";
                $delete_query = "DELETE FROM ex1 WHERE ex1ID =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex1";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="5%" class="submissions">No.</th>
                            <th width="40%" class="author">Text Script <span class="caret"></span></th>
                            <th class="score">Audio Script <span class="caret"></span></th>
                            <th width="25%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th width="35%" class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $ex1ID = $row["ex1ID"];
                    $textScript = (strlen($row["textScript"]) > 85) ? substr($row["textScript"],0,80).'...' : $row["textScript"];
                    ?>
                        <tr>
                            <td class="submissions"><?php echo $count ?></td>
                            <td class="author"><?php echo "<p title=\"".$row["textScript"]."\">".$textScript."</p>" ?></td>
                            <td class="score"><audio controls preload="none"><source src="<?php echo $row['audioScript'] ?>" type="audio/mpeg"></audio></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$ex1ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex1ID."\">
                            <input type=\"hidden\" name=\"deleteFile\" value=\"".$row["audioScript"]."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '1.".$ex1ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=1','formDelete".$ex1ID."')\" type=\"button\">Delete</button>
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
                echo "0 exercises";
            }
            break;
        case '2':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])&&isset($_POST["deleteFile"])){
                if (file_exists($_POST["deleteFile"])) {
                    if (!unlink($_POST["deleteFile"]))
                        echo ("Error deleting".$_POST['deleteFile']);
                }
                else
                    echo "File does not exist!";

                $delete_query = "DELETE FROM ex2 WHERE ex2ID =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex2";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="2%" class="submissions">No.</th>
                            <th width="25%" class="submissions">Title</th>
                            <th width="30%" class="author">Questions<span class="caret"></span></th>
                            <th width="30%" class="score">Answers<span class="caret"></span></th>
                            <th class="submit-date">Audio Script<span class="caret"></span></th>
                            <th width="55%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th width="10%" class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $ex2ID = $row["ex2ID"];
                    $title = $row["title"];
                    $questions = explode("*/*", $row["questions"]);
                    $questions = implode("<br>", $questions);
                    $answer = explode("*/*", $row["answer"]);
                    $answer = implode("<br>", $answer);
                    ?>
                        <tr>
                            <td class="submissions"><?php echo $count ?></td>
                            <td class="submissions"><?php echo $title ?></td>
                            <td class="author"><?php echo $questions ?></td>
                            <td class="author"><?php echo $answer ?></td>
                            <td class="score"><audio controls preload="none"><source src="<?php echo $row['audioScript'] ?>" type="audio/mpeg"></audio></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$ex2ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex2ID."\">
                            <input type=\"hidden\" name=\"deleteFile\" value=\"".$row["audioScript"]."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '2.".$ex2ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=2','formDelete".$ex2ID."')\" type=\"button\">Delete</button>
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
                echo "0 exercises";
            }
            break;

        case '3':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])&&isset($_POST["deleteFile"])){
                if (file_exists($_POST["deleteFile"])) {
                    if (!unlink($_POST["deleteFile"]))
                        echo ("Error deleting".$_POST['deleteFile']);
                }
                else
                    echo "File does not exist!";

                $delete_query = "DELETE FROM ex3 WHERE ex3ID =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex3";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                //echo "<table border=\"1\" style=\"width:100%\"><tr><td>No.</td><td>Questions</td><td>Answers</td><td>Audio Script</td><td>Time Created</td><td>Action</td></tr>";
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="5%" class="submissions">No.</th>
                            <th width="25%" class="submissions">Title</th>
                            <th width="30%" class="author">Questions<span class="caret"></span></th>
                            <th width="30%" class="score">Answers<span class="caret"></span></th>
                            <th class="submit-date">Audio Script<span class="caret"></span></th>
                            <th width="55%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th width="10%" class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $title = $row["title"];
                    $questions = explode("*/*", $row["questions"]);
                    $questions = implode("<br>", $questions);
                    $answer = explode("*/*", $row["answer"]);
                    $answer = implode("<br>", $answer);
                    $ex3ID = $row["ex3ID"];
                    // echo "<tr><td>".$count."</td><td>".$questions."
                    // </td><td>".$answer."</td><td><audio controls><source src=\"".$row["audioScript"]."\" type=\"audio/mpeg\"></audio></td>
                    // <td>" . $row["timeCreated"]. "</td>
                    // <td>
                    //     <form id=\"formDelete".$ex3ID."\" method=\"post\">
                    //     <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex3ID."\">
                    //     <input type=\"hidden\" name=\"deleteFile\" value=\"".$row["audioScript"]."\">
                    //     <button onclick=\"confirmLoadAction('viewEx.php?Ex=3','formDelete".$ex3ID."')\" type=\"button\">Delete</button>
                    //     </form>
                    // </td></tr>";
                    ?>
                        <tr>
                            <td class="submissions"><?php echo $count ?></td>
                            <td class="submissions"><?php echo $title ?></td>
                            <td class="author"><?php echo $questions ?></td>
                            <td class="author"><?php echo $answer ?></td>
                            <td class="score"><audio controls preload="none"><source src="<?php echo $row['audioScript'] ?>" type="audio/mpeg"></audio></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$ex3ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex3ID."\">
                            <input type=\"hidden\" name=\"deleteFile\" value=\"".$row["audioScript"]."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '3.".$ex3ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=3','formDelete".$ex3ID."')\" type=\"button\">Delete</button>
                            </form>" ?></td>
                        </tr>
                    <?php
                }
                //echo "<table>";
                ?>
                </tbody>
                </table>
                </div>
                <?php
            }
            else {
                echo "0 exercises";
            }
            break;

        case '4':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
                $delete_query = "DELETE FROM ex4 WHERE ex4ID =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex4";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                //echo "<table border=\"1\" style=\"width:100%\"><tr><td>No.</td><td>Keywords</td><td>Answers</td><td>Time Created</td><td>Action</td></tr>";
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="5%" class="submissions">No.</th>
                            <th width="25%" class="submissions">Title</th>
                            <th width="30%" class="score">Answers<span class="caret"></span></th>
                            <th width="20%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $ex4ID = $row["ex4ID"];
                    $title = $row["title"];
                    $answer = explode("*/*", $row["answer"]);
                    $answer = implode("<br>", $answer);
                    // echo "<tr><td>".$count."</td><td>".$keywords."</td><td>".$answer."</td>
                    // <td>" . $row["timeCreated"]. "</td>
                    // <td>
                    //     <form id=\"formDelete".$ex4ID."\" method=\"post\">
                    //     <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex4ID."\">
                    //     <button onclick=\"confirmLoadAction('viewEx.php?Ex=4','formDelete".$ex4ID."')\" type=\"button\">Delete</button>
                    //     </form>
                    // </td></tr>";
                    ?>
                        <tr>
                            <td width="5%" class="submissions"><?php echo $count ?></td>
                            <td class="submissions"><?php echo $title ?></td>
                            <td width="30%" class="author"><?php echo $answer ?></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$ex4ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex4ID."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '4.".$ex4ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=4','formDelete".$ex4ID."')\" type=\"button\">Delete</button>
                            </form>" ?></td>
                        </tr>
                    <?php
                }
                //echo "<table>";
                ?>
                </tbody>
                </table>
                </div>
                <?php
            }
            else {
                echo "0 exercises";
            }
            break;

        case '5':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
                $delete_query = "DELETE FROM ex5 WHERE ex5ID =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex5";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                //echo "<table border=\"1\" style=\"width:100%\"><tr><td>No.</td><td>Topic name</td><td>Time Created</td><td>Action</td></tr>";
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="5%" class="submissions">No.</th>
                            <th width="50%" class="author">Topic name<span class="caret"></span></th>
                            <th width="20%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $ex5ID = $row["ex5ID"];
                    ?>
                        <tr>
                            <td width="5%" class="submissions"><?php echo $count ?></td>
                            <td class="author"><?php echo $row["topic"] ?></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$ex5ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex5ID."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '5.".$ex5ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=5','formDelete".$ex5ID."')\" type=\"button\">Delete</button>
                            </form>" ?></td>
                        </tr>
                    <?php
                }
                //echo "<table>";
                ?>
                </tbody>
                </table>
                </div>
                <?php
            }
            else {
                echo "0 exercises";
            }
            break;

        case '6':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
                $delete_query = "DELETE FROM ex6 WHERE id =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex6";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                //echo "<table border=\"1\" style=\"width:100%\"><tr><td>No.</td><td>Keywords</td><td>Answers</td><td>Time Created</td><td>Action</td></tr>";
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="5%" class="submissions">No.</th>
                            <th width="25%" class="submissions">Title</th>
                            <th width="30%" class="author">Keywords<span class="caret"></span></th>
                            <th width="20%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $id = $row["id"];
                    $title = $row["title"];
                    $keywords = explode("*/*", $row["keywords"]);
                    $keywords = implode("<br>", $keywords);
                    ?>
                        <tr>
                            <td class="submissions"><?php echo $count ?></td>
                            <td class="submissions"><?php echo $title ?></td>
                            <td class="author"><?php echo $keywords ?></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$id."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$id."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '6.".$id."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=6','formDelete".$id."')\" type=\"button\">Delete</button>
                            </form>" ?></td>
                        </tr>
                    <?php
                }
                //echo "<table>";
                ?>
                </tbody>
                </table>
                </div>
                <?php
            }
            else {
                echo "0 exercises";
            }
            break;

        case '7':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
                $delete_query = "DELETE FROM ex7 WHERE id =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex7";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="5%" class="submissions">No.</th>
                            <th width="25%" class="submissions">Title</th>
                            <th width="30%" class="score">Answers<span class="caret"></span></th>
                            <th width="20%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $ex7ID = $row["id"];
                    $title = $row["title"];
                    $answer = explode("*/*", $row["answer"]);
                    $answer = implode("<br>", $answer);
                    ?>
                        <tr>
                            <td width="5%" class="submissions"><?php echo $count ?></td>
                            <td class="submissions"><?php echo $title ?></td>
                            <td width="30%" class="author"><?php echo $answer ?></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$ex7ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex7ID."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '7.".$ex7ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=7','formDelete".$ex7ID."')\" type=\"button\">Delete</button>
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
                echo "0 exercises";
            }
            break;

        case '8':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
                $delete_query = "DELETE FROM ex8 WHERE id =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex8";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="5%" class="submissions">No.</th>
                            <th width="30%" class="submissions">Title</th>
                            <th width="25%" class="submissions">Link</th>
                            <th width="20%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $ex8ID = $row["id"];
                    $link = (strlen($row["link"]) > 65) ? substr($row["link"],0,60).'...' : $row["link"];
                    $title = $row["title"];
                    ?>
                        <tr>
                            <td width="5%" class="submissions"><?php echo $count ?></td>
                            <td class="submissions"><?php echo $title ?></td>
                            <td class="submissions"><a href=<?php echo $row["link"] ?> target="_blank"><?php echo $link ?></a></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$ex8ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex8ID."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '8.".$ex8ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=8','formDelete".$ex8ID."')\" type=\"button\">Delete</button>
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
                echo "0 exercises";
            }
            break;

        case '9':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])&&isset($_POST["deleteFile"])){
                if (file_exists($_POST["deleteFile"])) {
                    if (!unlink($_POST["deleteFile"]))
                        echo ("Error deleting".$_POST['deleteFile']);
                }
                else
                    echo "File does not exist!";

                $delete_query = "DELETE FROM ex9 WHERE id =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex9";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="5%" class="submissions">No.</th>
                            <th width="10%" class="submissions">Title</th>
                            <th width="20%" class="submissions">Questions</th>
                            <th width="20%" class="submissions">Picture Link</th>
                            <th width="20%" class="submissions">Audio Script</th>
                            <th width="20%" class="submissions">Answers</th>
                            <th width="10%" class="submissions">Time Created</th>
                            <th width="10%" class="submissions">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $title = $row["title"];
                    $questions = explode("*/*", $row["questions"]);
                    $questions = implode("<br>", $questions);
                    $answer = explode("*/*", $row["answer"]);
                    $answer = implode("<br>", $answer);
                    $ex9ID = $row["id"];
                    ?>
                        <tr>
                            <td class="submissions"><?php echo $count ?></td>
                            <td class="submissions"><?php echo $title ?></td>
                            <td class="submissions"><?php echo $questions ?></td>
                            <td class="submissions"><a href="<?php echo $row['pictureLink'] ?>" target="_blank"><?php echo $row['pictureLink'] ?></a></td>
                            <td class="submissions"><audio controls preload="none"><source src="<?php echo $row['audioScript'] ?>" type="audio/mpeg"></audio></td>
                            <td class="submissions"><?php echo $answer ?></td>
                            <td class="submissions"><?php echo $row["timeCreated"] ?></td>
                            <td class="submissions"><?php echo "<form id=\"formDelete".$ex9ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex9ID."\">
                            <input type=\"hidden\" name=\"deleteFile\" value=\"".$row["audioScript"]."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '9.".$ex9ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=9','formDelete".$ex9ID."')\" type=\"button\">Delete</button>
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
                echo "0 exercises";
            }
            break;

        case '10':
            if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["deleteRecord"])){
                $delete_query = "DELETE FROM ex10 WHERE id =".$_POST["deleteRecord"];
                if (mysql_query($delete_query, $conn)) {
                    echo "Record deleted successfully<br>";
                }
                else {
                    echo "Error deleting record: " . mysql_error($conn);
                }
            }
            $sql = "SELECT * FROM ex10";
            $result = mysql_query($sql, $conn);
            if (mysql_num_rows($result) > 0) {
                $count=0;
                ?>
                <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th width="2%" class="submissions">No.</th>
                            <th width="25%" class="submissions">Title</th>
                            <th width="30%" class="author">Questions<span class="caret"></span></th>
                            <th width="30%" class="score">Answers<span class="caret"></span></th>
                            <th width="55%" class="submit-date">Time Created<span class="caret"></span></th>
                            <th width="10%" class="submit-date">Action<span class="caret"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                while($row = mysql_fetch_assoc($result)) {
                    $count++;
                    $ex10ID = $row["id"];
                    $title = $row["title"];
                    $questions = explode("*/*", $row["questions"]);
                    $questions = implode("<br>", $questions);
                    $answer = explode("*/*", $row["answer"]);
                    $answer = implode("<br>", $answer);
                    ?>
                        <tr>
                            <td class="submissions"><?php echo $count ?></td>
                            <td class="submissions"><?php echo $title ?></td>
                            <td class="author"><?php echo $questions ?></td>
                            <td class="author"><?php echo $answer ?></td>
                            <td class="submit-date"><?php echo $row["timeCreated"] ?></td>
                            <td class="submit-date"><?php echo "<form id=\"formDelete".$ex10ID."\" method=\"post\">
                            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$ex10ID."\">
                            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editEx', '10.".$ex10ID."')\" type=\"button\">Edit</button>
                            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewEx.php?Ex=10','formDelete".$ex10ID."')\" type=\"button\">Delete</button>
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
                echo "0 exercises";
            }
            break;
        
        default:
            # code...
            break;
    }
}



mysql_close($conn);

?>
<?php  
require_once 'config.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}

if(($_SERVER['REQUEST_METHOD'] === 'POST')&&isset($_POST["tbl"])&&isset($_POST["deleteRecord"])){
    if (!empty($_POST["deleteFile"]) && file_exists($_POST["deleteFile"])) {
        if (!unlink($_POST["deleteFile"]))
            echo ("Error deleting old file!<br>");
    }
    $tbl_name = getTableFromIdx($_POST["tbl"]);
    $delete_query = "DELETE FROM $tbl_name WHERE id =".$_POST["deleteRecord"];
    if (mysql_query($delete_query, $conn)) {
        echo "Record deleted successfully<br>";
    }
    else {
        echo "Error deleting record: " . mysql_error($conn);
    }
}
?>
<strong>View Posts</strong>
<div class="create-course-content">
    <div class="row">
        <div class="col-md-3">
            <h4>Category</h4>
        </div>
        <div class="col-md-9">
            <div class="form-question mc-select">
            <?php
            if(!empty($_POST['cat']))
                $cat = $_POST['cat'];
            else $cat = 'ielts-listening';
            ?>
            <form id="formCat" enctype="multipart/form-data" method="post">
                <select class="select" name="cat" onchange="loadAction('viewPost.php', 'formCat')">
                  <option value="ielts-listening" <?php if($cat=='ielts-listening') echo "selected"?>>Ielts Listening</option>
                  <option value="ielts-reading" <?php if($cat=='ielts-reading') echo "selected"?>>Ielts Reading</option>
                  <option value="ielts-speaking" <?php if($cat=='ielts-speaking') echo "selected"?>>Ielts Speaking</option>
                  <option value="ielts-writing-task-1" <?php if($cat=='ielts-writing-task-1') echo "selected"?>>Ielts Writing Task 1</option>
                  <option value="ielts-writing-task-2" <?php if($cat=='ielts-writing-task-2') echo "selected"?>>Ielts Writing Task 2</option>
                  <option value="tu-vungngu-phap" <?php if($cat=='tu-vungngu-phap') echo "selected"?>>Từ vựng/Ngữ pháp</option>
                  <option value="kinh-nghiem-thi" <?php if($cat=='kinh-nghiem-thi') echo "selected"?>>Kinh Nghiệm Thi</option>
                  <option value="hoidap" <?php if($cat=='hoidap') echo "selected"?>>Hỏi/Đáp</option>
                  <option value="tai-lieu-ielts" <?php if($cat=='tai-lieu-ielts') echo "selected"?>>Tài Liệu IELTS</option>
                  <option value="tai-lieu-toeic" <?php if($cat=='tai-lieu-toeic') echo "selected"?>>Tài Liệu TOEIC</option>
                  <option value="giai-de" <?php if($cat=='giai-de') echo "selected"?>>Giải Đề</option>
                </select>
            </form>
            </div>
        </div>
    </div>
</div>
<?php
$db_post_name = "postData";
$tbl=1;
if(($cat=="tai-lieu-ielts")||($cat=="tai-lieu-toeic")){
    $db_post_name = "tailieu";
    $tbl=2;
}
if($cat=="giai-de"){
    $db_post_name = "giaide";
    $tbl=3;
}
$sql = "SELECT * FROM $db_post_name WHERE cat='$cat' ORDER BY timeCreated DESC";
//$sql = "SELECT *, 1 AS tbl FROM postData UNION ALL SELECT *, 2 AS tbl FROM tailieu UNION ALL SELECT *, 3 AS tbl FROM giaide ORDER BY timeCreated DESC";
$result = mysql_query($sql, $conn);// or die(mysql_error());
if (mysql_num_rows($result) > 0) {
	$index=0;
    ?>
    <div class="table-student-submission">
    <table class="mc-table">
        <thead>
            <tr>
                <th width="5%" class="submissions">No.</th>
                <th width="85%" class="author">Posts<span class="caret"></span></th>
                <th class="submit-date">Action<span class="caret"></span></th>
            </tr>
        </thead>
        <tbody>
    <?php
    while($row = mysql_fetch_assoc($result)){
        $index++;
        ?>
        <tr>
            <td class="submissions"><?php echo $index ?></td>
            <td class="author"><?php
            $thumbnailSrc=$row["thumbnail"];
            if($thumbnailSrc==null) $thumbnailSrc="/images/posts/".$row['cat'].".jpg";
            echo "<img src=\"".$thumbnailSrc."\" style=\"width: 20%; height: 20%\"><br>";
            echo "<strong>Title:</strong> ".$row["title"]."<br>";
            echo "<iframe src=\"postContent.php?tbl=".$tbl."&id=".$row["id"]."\" frameBorder=\"0\"></iframe>" ?></td>
            <td class="submit-date"><?php echo "<form id=\"formDelete".$row["id"]."\" method=\"post\">
            <input type=\"hidden\" name=\"tbl\" value=\"".$tbl."\">
            <input type=\"hidden\" name=\"deleteRecord\" value=\"".$row["id"]."\">
            <input type=\"hidden\" name=\"deleteFile\" value=\"".$row["thumbnail"]."\">
            <button class=\"mc-btn btn-style-1\" onclick=\"editAction('editPost', '".$tbl."*/*".$row["id"]."')\" type=\"button\">Edit</button>
            <button class=\"mc-btn btn-style-1\" onclick=\"confirmLoadAction('viewPost.php','formDelete".$row["id"]."')\" type=\"button\">Delete</button>
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
    echo "0 posts";
}

mysql_close($conn);
?>

<?php  
require_once 'config.php';
require_once 'php-slugs.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
?>
<strong>Add Post</strong>
<section id="create-course-section" class="create-course-section">
    <div class="row">
        <div class="col-md-12">
            <div class="create-course-content">
            	<form id="formUpload" enctype="multipart/form-data" method="post">
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Category</h4>
                        </div>
                        <div class="col-md-9">
                            <div class="form-question mc-select">
                            <select class="select" name="cat">
                              <option value="ielts-listening">Ielts Listening</option>
                              <option value="ielts-reading">Ielts Reading</option>
                              <option value="ielts-speaking">Ielts Speaking</option>
                              <option value="ielts-writing-task-1">Ielts Writing Task 1</option>
                              <option value="ielts-writing-task-2">Ielts Writing Task 2</option>
                              <option value="tu-vungngu-phap">Từ vựng/Ngữ pháp</option>
                              <option value="kinh-nghiem-thi">Kinh Nghiệm Thi</option>
                              <option value="hoidap">Hỏi/Đáp</option>
                              <option value="tai-lieu-ielts">Tài Liệu IELTS</option>
                              <option value="tai-lieu-toeic">Tài Liệu TOEIC</option>
                              <option value="giai-de">Giải Đề</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Upload Thumbnail</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="upload-video up-file">
                                </div><input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="description-editor text-form-editor">
                                <input name="title" type="text" placeholder="Title of post" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="description-editor text-form-editor">
                                <textarea name="postArea" id="postArea" style="display:none;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="form-action">
                    <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="CKupdate();loadAction('addPost.php', 'formUpload')" type="button">Upload</button>
                </div>
                
            </div>
        </div>
    </div>
</section>

<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST['cat'])&&!empty($_POST['title'])&&!empty($_POST['postArea'])) {
    $target_file = '';
    if(!empty($_FILES["fileToUpload"])&&($_FILES["fileToUpload"]["size"]>0)){
        $target_dir = "media/".date('Y')."/".date('m')."/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
        
        $uploadOk = 1;
        $isUpload = false;
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        }
        else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $isUpload = true;
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        if($isUpload){
            $target_file = checkText($target_file);
        }else
            $target_file = '';
    }
    $postData = addslashes($_POST['postArea']);
    $title = checkText($_POST['title']);
    $db_post_name = "postData";
    if(($_POST['cat']=="tai-lieu-ielts")||($_POST['cat']=="tai-lieu-toeic"))
        $db_post_name = "tailieu";
    if($_POST['cat']=="giai-de")
        $db_post_name = "giaide";
	$sql = "INSERT INTO $db_post_name (cat, postLink, title, content, thumbnail, timeCreated) VALUES ('".$_POST['cat']."','".makeSlugs($title)."','".$title."','".$postData."', '".$target_file."', '".date("Y-m-d H:i:s",time())."')";
	if (mysql_query($sql, $conn)) {
	    echo "Submit successfully<br>";
	} else {
	    echo "Error: " . $sql . "<br>" . mysql_error($conn);
	}

}

mysql_close($conn);
?>
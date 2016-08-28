<?php  
require_once 'config.php';
require_once 'php-slugs.php';
if($user["role"]!=$_ADMIN_CODE){
	header("location: student.php");
}
if(($_SERVER['REQUEST_METHOD'] == 'POST')&&!empty($_POST["grID"])){
	$tbl_name = getTableFromIdx(intval(explode("*/*", $_POST["grID"])[0]));
	$grID = intval(explode("*/*", $_POST["grID"])[1]);
	
	if($_GET["type"]=="edit"){
		$sql = "SELECT * FROM $tbl_name WHERE id=".$grID;
		$result = mysql_query($sql, $conn);
		if (mysql_num_rows($result) > 0) {
		    while($row = mysql_fetch_assoc($result)) {
		    	$title=$row["title"];
		        $content=$row["content"];
		        $cat = $row["cat"];
		        $thumbnail = $row["thumbnail"];
		    } ?>
		    <strong>Edit Post</strong>
		    <section id="create-course-section" class="create-course-section">        
	            <div class="row">                 
	                <div class="col-md-12">
	                    <div class="create-course-content">
	                    	<form id="formEditGroup" enctype="multipart/form-data" method="post">
	                    	<input type="hidden" name="grID" value="<?php echo $_POST['grID']?>">
	                    	<input type="hidden" name="deleteFile" value="<?php echo $thumbnail?>">
	                    	<div>
			                    <div class="row">
			                        <div class="col-md-3">
			                            <h4>Category</h4>
			                        </div>
			                        <div class="col-md-9">
			                            <div class="form-question mc-select">
			                            <select class="select" name="cat">
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
			                            </div>
			                        </div>
			                    </div>
			                </div>
                    		<div>
			                    <div class="promo-video create-item">
			                        <div class="row">
			                            <div class="col-md-3">
			                                <h4>Upload Thumbnail</h4>
			                                (If new image is uploaded, the old image will be deleted)
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
			                                <input name="title" type="text" placeholder="Title of post" value="<?php echo $title?>" required>
			                            </div>
			                        </div>
			                    </div>
			                </div>
	                    	<div>
	                            <div class="row">
	                                <div class="col-md-12">
	                                    <div class="description-editor text-form-editor">
	                                        <textarea name="postArea" id="postArea" required><?php echo $content?></textarea>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        
	                        </form>
	                       <div class="form-action">
	                        	<button class="submit mc-btn-3 btn-style-1" onclick="loadAction('viewPost.php', null)" type="button">Back</button>
	                            <button id="submittingButton" class="submit mc-btn-3 btn-style-1" onclick="CKupdate();loadAction('editPost.php?type=submit', 'formEditGroup')" type="button">Submit</button>
	                        </div>
	                        
	                    </div>
	                </div>
	            </div>       
	    	</section>
		    <?php

		}
		else {
		    echo "0 posts";
		}
	}else if(($_GET["type"]=="submit")&&!empty($_POST['cat'])&&!empty($_POST['title'])&&!empty($_POST['postArea'])){

		if(($_FILES["fileToUpload"]["size"]>0)){
			if (!empty($_POST["deleteFile"]) && file_exists($_POST["deleteFile"])) {
				if (!unlink($_POST["deleteFile"]))
                    echo ("Error deleting old file!<br>");
        	}
        	else{
        		//echo "Old file does not exist!";
        	}
            //upload new file
            $target_dir = "media/".date('Y')."/".date('m')."/";
			if (!file_exists($target_dir)) {
			    mkdir($target_dir, 0777, true);
			}
			$target_file = $target_dir .time()."-".basename($_FILES["fileToUpload"]["name"]);
			
			$uploadOk = 1;
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.<br>";
			    $uploadOk = 0;
			}
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.<br>";
			}
			else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			    	$target_file = checkText($target_file);
			        $sql="UPDATE $tbl_name SET cat='".$_POST['cat']."',postLink='".makeSlugs($_POST['title'])."',title='".$_POST['title']."',content='".$_POST["postArea"]."',thumbnail='".$target_file."',timeCreated='".date("Y-m-d H:i:s",time())."' WHERE id=".$grID;
			    }
			    else {
			        echo "Sorry, there was an error uploading your file.<br>";
			    }
			}
		} else
			$sql="UPDATE $tbl_name SET cat='".$_POST['cat']."',postLink='".makeSlugs($_POST['title'])."',title='".$_POST['title']."',content='".$_POST["postArea"]."',timeCreated='".date("Y-m-d H:i:s",time())."' WHERE id=".$grID;
		
		if($sql!=null){
			if (mysql_query($sql, $conn))
			    echo "<br>Update post successfully";
			else
			    echo "<br>Error: " . $sql . "<br>" . mysql_error($conn);
		}
	}
}
mysql_close($conn);
?>
<?php  
require_once 'config.php';
require_once 'php-slugs.php';
if(!isset($_SESSION))
    session_start();

$pageTitle = '';
if (($_SERVER['REQUEST_METHOD'] == 'GET')&&!empty($_GET['db'])&&!empty($_GET['title'])&&!empty($_GET['cat'])) {
	$cat = checkText($_GET['cat']);
	$title = checkText($_GET['title']);
	$title = substr($title, 0, -4);
	$sql = "SELECT * FROM ".$_GET['db']." WHERE (cat='".$cat."' AND postLink='".$title."') ORDER BY timeCreated DESC";
	$result = mysql_query($sql, $conn);
	if (mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_assoc($result)){
			$pageTitle = $row['title'];
		}
	}
}
echo getRenderedHTML('_header.php', $pageTitle);
?>


    <!-- SUB BANNER -->
    <section class="sub-banner sub-banner-course">
        <div class="awe-static bg-sub-banner-course"></div>
        <div class="container">
            <div class="sub-banner-content">
                <h2 class="text-center">TẤT CẢ BẠN CẦN VỀ NGOẠI NGỮ!</h2>
            </div>
        </div>
    </section>
    <!-- END / SUB BANNER -->


    <!-- BLOG -->
    <section class="blog">

        <div class="container">
            <div class="row">

                <!-- BLOG LIST -->
                <div class="col-md-8">
	                    <?php
	                    if (($_SERVER['REQUEST_METHOD'] == 'GET')&&!empty($_GET['db'])&&!empty($_GET['path'])&&!empty($_GET['cat'])) {
	                    	$path = checkText($_GET['path']);
							$cat = checkText($_GET['cat']);
							if(!empty($_GET['title'])) {
								$title = checkText($_GET['title']);
								//eliminate php ext
								$title = substr($title, 0, -4);
							} else {
								$title = '';
							}
							$sql="";
							if(empty($title)){
								?><div class="blog-list-content"><?php
								if($cat=='tat-ca')
									$sql = "SELECT * FROM ".$_GET['db']." ORDER BY timeCreated DESC";
								else
									$sql = "SELECT * FROM ".$_GET['db']." WHERE cat='".$cat."' ORDER BY timeCreated DESC";
								$result = mysql_query($sql, $conn);
								$rec_limit = 4;
								$rec_count = mysql_num_rows($result);
								$num_page = ceil($rec_count/$rec_limit);
								if(isset($_GET['page']) && intval($_GET['page'])>0) {
						            $page = substr($_GET['page'], 0, -4);
						            $offset = $rec_limit * ($page-1);
						        }else {
						            $page = 1;
						           	$offset = 0;
						        }
						        $left_rec = $rec_count - ($page * $rec_limit);
						        if($cat=='tat-ca')
									$sql = "SELECT * FROM ".$_GET['db']." ORDER BY timeCreated DESC LIMIT $offset, $rec_limit";
								else
									$sql = "SELECT * FROM ".$_GET['db']." WHERE cat='".$cat."' ORDER BY timeCreated DESC LIMIT $offset, $rec_limit";
								$result = mysql_query($sql, $conn);
								if($result === FALSE) { 
								    die(mysql_error());
								}
								if (mysql_num_rows($result) > 0) {
									while($row = mysql_fetch_assoc($result)){
										?>
				                        <!-- POST -->
				                        <div class="post">
				                            <!-- POST MEDIA -->
				                            <div class="post-media">
				                                <div class="image-thumb">
				                                	<?php
				                                	if($row['thumbnail']!=null)
				                                		$imageSrc = "/".$row['thumbnail'];
				                                	else
				                                		$imageSrc = "/images/posts/".$row['cat'].".jpg";
				                                	?>
				                                    <a href="<?php echo '/'.$path.'/'.$row['cat'].'/'.makeSlugs($row['title'])?>"><img src="<?php echo $imageSrc?>" alt=""></a>
				                                </div>
				                            </div>
				                            <!-- END / POST MEDIA -->

				                            <!-- POST BODY -->
				                            <div class="post-body">
				                                <div class="post-title">
				                                    <h3 class="md"><a href="<?php echo '/'.$path.'/'.$row['cat'].'/'.makeSlugs($row['title'])?>"><?php echo $row["title"]?></a></h3>
				                                </div>
				                                <div class="post-meta">
				                                    by <a href="javascript:void(0)">I-educator</a> on <?php echo $row["timeCreated"]?>
				                                </div>
				                                <div class="post-content">
				                                    <p><?php $content=strip_tags($row["content"]);
				                                    	$content = (strlen($content) > 240) ? substr($content,0,235).'...' : $content;
				                                    	echo $content;
				                                    ?></p>
				                                </div>
				                                <div class="post-link">
				                                    <a href="<?php echo '/'.$path.'/'.$row['cat'].'/'.makeSlugs($row['title'])?>">
				                                        <i class="fa fa-play-circle-o"></i>
				                                        Xem thêm
				                                    </a>
				                                </div>
				                            </div>
				                            <!-- END / POST BODY -->
				                        </div>
				                        <!-- END / POST -->

				                        <?php 
									}?>
									<ul class="pager" id="pager">
										<script type="text/javascript">
									    window.onload = function() {
									    	pagerList(<?php echo "'".$path."','".$cat."',".$page.",".$num_page?>);
									    };
									    </script>
									</ul>
									<?php
								}
								else
									echo "<strong>Sorry! Post not found!</strong>";
								?>
		                        </div>
								<?php

							}
							else{
								?><div class="blog-single-content"><?php
								$sql = "SELECT * FROM ".$_GET['db']." WHERE (cat='".$cat."' AND postLink='".$title."') ORDER BY timeCreated DESC";
								$result = mysql_query($sql, $conn);
								if (mysql_num_rows($result) > 0) {
									while($row = mysql_fetch_assoc($result)){
		                    			?>
		                    			<!-- POST -->
				                        <div class="post post-single">
				                            <div class="post-title">
				                                <h1 class="big"><?php echo $row['title']?></h1>
				                            </div>
				                            <div class="post-meta">
				                                by <a href="javascript:void(0)">I-educator</a> on <?php echo $row["timeCreated"]?>
				                            </div>
				                            <div class="post-content">
				                            	<style scoped>
											        @import "/script/ckeditor/contents.css";
											    </style>
				                            	<?php echo $row["content"]?>
				                            </div>
				                        </div>
				                        <!-- END / POST -->
		                    			<?php
	                    			}
	                    		}else
	                    			echo "<strong>Sorry! Post not found!</strong>";
	                    		echo "</div>";
							}
							
                    	}else
                        	echo "<strong>Sorry! Post not found!</strong>";
                        ?>

                        
                </div>
                <!-- END / BLOG LIST -->

                <!-- SIDEBAR -->
                <div class="col-md-3 col-md-offset-1">
                    <aside class="blog-sidebar">

                        <!-- WIDGET CATEGORIES -->
						<div class="widget widget_categories">
                            <h4 class="sm">Danh Mục</h4>
                            <ul>
                                <li><a href="/danh-muc/ielts-listening/">Ielts Listening</a></li>
								<li><a href="/danh-muc/ielts-reading/">Ielts Reading</a></li>
								<li><a href="/danh-muc/ielts-speaking/">Ielts Speaking</a></li>
								<li><a href="/danh-muc/ielts-writing-task-1/">Ielts Writing Task 1</a></li>
								<li><a href="/danh-muc/ielts-writing-task-2/">Ielts Writing Task 2</a></li>
								<li><a href="/danh-muc/tu-vungngu-phap/">Từ vựng/Ngữ pháp</a></li>
								<li><a href="/danh-muc/kinh-nghiem-thi/">Kinh Nghiệm Thi</a></li>
								<li><a href="/danh-muc/hoidap/">Hỏi/Đáp</a></li>							
                            </ul>
                        </div>
                        <div class="widget widget_categories">
                            <h4 class="sm">Tài Liệu</h4>
                            <ul>
                                <li><a href="/tai-lieu/tai-lieu-ielts/">IELTS</a></li>
								<li><a href="/tai-lieu/tai-lieu-toeic/">TOEIC</a></li>							
                            </ul>
                        </div>
						
                        <!-- END / WIDGET CATEGORIES -->

                    </aside>
                </div>
                <!-- END / SIDEBAR -->


            </div>
        </div>

    </section>
    <!-- END / BLOG -->

<?php echo getRenderedHTML('_footer.php', null) ?>

<?php
mysql_close($conn);
?>
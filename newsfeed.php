<?php  
require_once 'config.php';
require_once 'php-slugs.php';
if(!isset($_SESSION))
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <!-- Google font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="/css/library/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/library/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/library/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/css/md-font.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <title><?php echo $_PAGE_TITLE?></title>
	<link href="/images/favicon.ico" rel="shortcut icon"/>
</head>
<body id="page-top">

<!-- PAGE WRAP -->
<div id="page-wrap">

    <!-- PRELOADER -->
    <div id="preloader">

    </div>
    <!-- END / PRELOADER -->

    <!-- HEADER -->
    <header id="header" class="header">
        <div class="container">

            <!-- LOGO -->
            <div class="logo"><a href="/index.php"><img src="/images/logo.svg" alt=""></a></div>
            <!-- END / LOGO -->

            <!-- NAVIGATION -->
            <nav class="navigation">

                <div class="open-menu">
                    <span class="item item-1"></span>
                    <span class="item item-2"></span>
                    <span class="item item-3"></span>
                </div>

                <!-- MENU -->
                <ul class="menu">
                    <li><a href="/index.php">Trang Chủ</a></li>
                    <li class="menu-item-has-children megamenu col-4">
                        <a href="gioi-thieu.html">Giới Thiệu</a>
                    <li class="menu-item-has-children">
                        <a href="/newsfeed/all/">Danh Mục</a>
                        <ul class="sub-menu">
                            <li><a href="/newsfeed/ielts-listening/">Ielts Listening</a></li>
                            <li><a href="/newsfeed/ielts-reading/">Ielts Reading</a></li>
							<li><a href="/newsfeed/ielts-speaking/">Ielts Speaking</a></li>
							<li><a href="/newsfeed/ielts-writing-task-1/">Ielts Writing Task 1</a></li>
							<li><a href="/newsfeed/ielts-writing-task-2/">Ielts Writing Task 2</a></li>
							<li><a href="/newsfeed/tu-vungngu-phap/">Từ vựng/Ngữ pháp</a></li>
							<li><a href="/newsfeed/kinh-nghiem-thi/">Kinh Nghiệm Thi</a></li>
							<li><a href="/newsfeed/hoidap/">Hỏi/Đáp</a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children">
                        <a href="javascript:void(0)">Tài Liệu</a>
                        <ul class="sub-menu">
                            <li><a href="tai-lieu-ielts.html">IELTS</a></li>
                            <li><a href="tai-lieu-toeic.html">TOEIC</a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children megamenu col-4">
                        <a href="giai-de.html">Giải Đề</a>
                    </li>
					<li class="menu-item-has-children megamenu col-4">
                        <a href="dang-nhap.html">Bài Tập</a>
                    </li>

                    <?php if(!isset($_SESSION['login'])){?>
                    <li class="menu-item-has-children">
                        <a href="javascript:void(0)">Đăng Nhập</a>
                        <ul class="sub-menu">
                            <li><a href="/login.php">Đăng Nhập</a></li>
                            <li><a href="/signup.php">Đăng Ký</a></li>
                        </ul>
                    </li>
                     <?php }?>

					<li class="menu-item-has-children megamenu col-4">
                        <a href="lien-he.html">Liên Hệ</a>
                    </li>
                    <li>
                        <gcse:search></gcse:search>
                    </li>
                </ul>
                <!-- END / MENU -->

                <?php if(isset($_SESSION['login'])){?>
                <!-- LIST ACCOUNT INFO -->
                <ul class="list-account-info">
                    <li class="list-item account">
                        <div class="account-info item-click">
                            <img src="/images/Student-Icon.png" alt="">
                        </div>
                        <div class="toggle-account toggle-list">
                            <ul class="list-account">
                                <li><a href="/student.php"><span style="margin-left: 16px; color: #6a6a6;">Welcome, <?php echo $_SESSION['login']?></span></a></li>
                                <li><a href="#action" onclick="loadAction('account.php', null)"><i class="icon md-config"></i>Setting</a></li>
                                <li><a href="/logout.php"><i class="icon md-arrow-right"></i>Sign Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!-- END / LIST ACCOUNT INFO -->
                <?php }?>         

            </nav>
            <!-- END / NAVIGATION -->

        </div>
    </header>
    <!-- END / HEADER -->


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
	                    if (($_SERVER['REQUEST_METHOD'] == 'GET')&&!empty($_GET['cat'])) {
							$cat = checkText($_GET['cat']);
							$sql="";
							if(empty($_GET['title'])){
								?><div class="blog-list-content"><?php
								if($cat=='all')
									$sql = "SELECT * FROM postData ORDER BY timeCreated DESC";
								else
									$sql = "SELECT * FROM postData WHERE cat='".$cat."' ORDER BY timeCreated DESC";
								$result = mysql_query($sql, $conn);
								$rec_limit = 4;
								$rec_count = mysql_num_rows($result);
								$num_page = ceil($rec_count/$rec_limit);
								if(isset($_GET['page']) && intval($_GET['page'])>0) {
						            $page = $_GET['page'];
						            $offset = $rec_limit * ($page-1);
						        }else {
						            $page = 1;
						           	$offset = 0;
						        }
						        $left_rec = $rec_count - ($page * $rec_limit);
						        if($cat=='all')
									$sql = "SELECT * FROM postData ORDER BY timeCreated DESC LIMIT $offset, $rec_limit";
								else
									$sql = "SELECT * FROM postData WHERE cat='".$cat."' ORDER BY timeCreated DESC LIMIT $offset, $rec_limit";
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
				                                    <img src="/images/newsfeed/<?php echo $row['cat']?>.jpg" alt="">
				                                </div>
				                            </div>
				                            <!-- END / POST MEDIA -->

				                            <!-- POST BODY -->
				                            <div class="post-body">
				                                <div class="post-title">
				                                    <h3 class="md"><a href="<?php echo '/newsfeed/'.$row['cat'].'/'.makeSlugs($row['title'])?>"><?php echo $row["title"]?></a></h3>
				                                </div>
				                                <div class="post-meta">
				                                    by <a href="javascript:void(0)">admin</a> on <?php echo $row["timeCreated"]?>
				                                </div>
				                                <div class="post-content">
				                                    <p><?php $content=strip_tags($row["content"]);
				                                    	$content = (strlen($content) > 140) ? substr($content,0,135).'...' : $content;
				                                    	echo $content;
				                                    ?></p>
				                                </div>
				                                <div class="post-link">
				                                    <a href="<?php echo '/newsfeed/'.$row['cat'].'/'.makeSlugs($row['title'])?>">
				                                        <i class="fa fa-play-circle-o"></i>
				                                        Read More
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
			                            window.onload = function() {pagerList(<?php echo "'".$cat."',".$page.",".$num_page?>)};
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
								$title = checkText($_GET['title']);
								$sql = "SELECT * FROM postData WHERE (cat='".$cat."' AND postLink='".$title."') ORDER BY timeCreated DESC";
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
				                                by <a href="javascript:void(0)">admin</a> on <?php echo $row["timeCreated"]?>
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
                                <li><a href="/newsfeed/ielts-listening/">Ielts Listening</a></li>
								<li><a href="/newsfeed/ielts-reading/">Ielts Reading</a></li>
								<li><a href="/newsfeed/ielts-speaking/">Ielts Speaking</a></li>
								<li><a href="/newsfeed/ielts-writing-task-1/">Ielts Writing Task 1</a></li>
								<li><a href="/newsfeed/ielts-writing-task-2/">Ielts Writing Task 2</a></li>
								<li><a href="/newsfeed/tu-vungngu-phap/">Từ vựng/Ngữ pháp</a></li>
								<li><a href="/newsfeed/kinh-nghiem-thi/">Kinh Nghiệm Thi</a></li>
								<li><a href="/newsfeed/hoidap/">Hỏi/Đáp</a></li>							
                            </ul>
                        </div>
                        <div class="widget widget_categories">
                            <h4 class="sm">Tài Liệu</h4>
                            <ul>
                                <li><a href="tai-lieu-ielts.html">IELTS</a></li>
								<li><a href="tai-lieu-toeic.html">TOEIC</a></li>							
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

    
    
    <!-- FOOTER -->
    <footer id="footer" class="footer">
        <div class="first-footer">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="widget megacourse">
                            <h3 class="md">I-EDUCATOR</h3>
                            <p>Với sự trợ giúp của công nghệ và phương pháp dạy khoa học, I-educator chắc chắn sẽ giúp bạn tiến bộ nhanh hơn và hiệu quả hơn trong việc học Ngoại Ngữ.</p>
                            <a href="gioi-thieu.html" class="mc-btn btn-style-1">Khám Phá Nào</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="widget widget_latest_new">
                            <h3 class="sm">Đội Ngũ</h3>
                            <ul>
                                <li>
                                    <a href="gioi-thieu.html">
                                        <div class="image-thumb">
                                            <img src="/images/team-13.jpg" alt="">
                                        </div>
                                        <span>Teacher: Mr. Đồng - IELTS 8.0</span>
                                    </a>
                                </li>
								<li>
                                    <a href="gioi-thieu.html">
                                        <div class="image-thumb">
                                            <img src="/images/team-15.jpg" alt="">
                                        </div>
                                        <span>Teacher Assistant: Mr. Toàn - IELTS 7.0</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="gioi-thieu.html">
                                        <div class="image-thumb">
                                            <img src="/images/team-14.jpg" alt="">
                                        </div>
                                        <span>Speaking Teacher: Ms. Trúc - IELTS S 8.0</span>
                                    </a>
                                </li>								
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="widget quick_link">
                            <h3 class="sm">Liên Kết</h3>
                            <ul class="list-style-block">
                                <li><a href="gioi-thieu.html">Về Chúng Tôi</a></li>
                                <li><a href="javascript:void(0)">Danh Mục</a></li>
                                <li><a href="javascript:void(0)">Giải Đề</a></li>
                                <li><a href="dang-nhap.html">Bài Tập</a></li>
                                <li><a href="lien-he.html">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="widget news_letter">
                            <div class="awe-static bg-news_letter"></div>
                            <div class="overlay-color-3"></div>
                            <div class="inner">
                                <div class="letter-heading">
                                    <h3 class="md">Nhận Tin</h3>
                                    <p>Hãy đăng ký để nhận thông tin về khóa học cũng như những bài tập mới nhất từ I-educator</p>
                                </div>
                                <div class="letter">
                                    <form>
                                        <input class="input-text" type="text">
                                        <input type="submit" value="ĐĂNG KÝ NGAY" class="mc-btn btn-style-2">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="second-footer">
            <div class="container">
                <div class="contact">
                    <div class="email">
                        <i class="icon md-email"></i>
                        <a href="javascript:void(0)">support@i-educator.vn</a>
                    </div>
                    <div class="phone">
                        <i class="fa fa-mobile"></i>
                        <span>+84 1662 022 653</span>
                    </div>
                    <div class="address">
                        <i class="fa fa-map-marker"></i>
                        <span>29/7 Đường D2,  Q. Bình Thạnh</span>
                    </div>
                </div>
                <p class="copyright">Copyright © 2015 I-EDUCATOR. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- END / FOOTER -->


    


</div>
<!-- END / PAGE WRAP -->

<!-- Load jQuery -->
<script type="text/javascript" src="/js/library/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="/js/library/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/library/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="/js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="/js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/js/library/jquery.easing.min.js"></script>
<script type="text/javascript" src="/js/scripts.js"></script>
<script src="/script/jquery.scoped.js"></script>
<script src="/script/main.js"></script>
</body>
</html>
<?php
mysql_close($conn);
?>
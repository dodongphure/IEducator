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
    <meta property="og:image" content="http://i-educator.vn/images/logo_IEducator.png" />
    <!-- Google font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="/css/library/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/library/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/library/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/script/sweetalert/sweet-alert.css">
    <link rel="stylesheet" type="text/css" href="/css/md-font.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- Slider -->
    <link href="/script/jsImgSlider/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="/script/jsImgSlider/js-image-slider.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <title><?php echo $_PAGE_TITLE ?></title>
    <meta name="description" content="Trung tâm luyện thi IELTS, TOEIC I-EDUCATOR sẽ giúp rèn luyện cho học viên kỹ năng làm bài và đạt điểm thi cao nhất, nâng cao trình độ Tiếng Anh siêu tốc."/>
    <link href="/images/favicon.ico" rel="shortcut icon"/>
</head>
<body id="page-top" class="home">

<!-- PAGE WRAP -->
<div id="page-wrap">

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="pre-icon">
            <div class="pre-item pre-item-1"></div>
            <div class="pre-item pre-item-2"></div>
            <div class="pre-item pre-item-3"></div>
            <div class="pre-item pre-item-4"></div>
        </div>
    </div>
    <!-- END / PRELOADER -->

    <!-- HEADER -->
    <header id="header" class="header">
        <div class="container">

            <!-- LOGO -->
            <div class="logo"><a href="/trang-chu"><img src="/images/logo.svg" alt=""></a></div>
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
                    <li>
                        <a href="/trang-chu">Trang Chủ</a>
                    </li>

                    <li>
                        <a href="/gioi-thieu">Giới Thiệu</a>
                    </li>

                    <li class="menu-item-has-children">
                        <a href="/danh-muc/tat-ca/">Danh Mục</a>
                        <ul class="sub-menu">
                            <li><a href="/danh-muc/ielts-listening/">Ielts Listening</a></li>
                            <li><a href="/danh-muc/ielts-reading/">Ielts Reading</a></li>
                            <li><a href="/danh-muc/ielts-speaking/">Ielts Speaking</a></li>
                            <li><a href="/danh-muc/ielts-writing-task-1/">Ielts Writing Task 1</a></li>
                            <li><a href="/danh-muc/ielts-writing-task-2/">Ielts Writing Task 2</a></li>
                            <li><a href="/danh-muc/tu-vungngu-phap/">Từ vựng/Ngữ pháp</a></li>
                            <li><a href="/danh-muc/kinh-nghiem-thi/">Kinh Nghiệm Thi</a></li>
                            <li><a href="/danh-muc/hoidap/">Hỏi/Đáp</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children">
                        <a href="/tai-lieu/tat-ca/">Tài Liệu</a>
                        <ul class="sub-menu">
                            <li><a href="/tai-lieu/tai-lieu-ielts/">IELTS</a></li>
                            <li><a href="/tai-lieu/tai-lieu-toeic/">TOEIC</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="/giai-de/tat-ca/">Giải Đề</a>
                    </li>

                    <li>
                        <a href="/student">Bài Tập</a>
                    </li>

                    <?php if(!isset($_SESSION['login'])){?>
                    <li class="menu-item-has-children">
                        <a href="javascript:void(0)">Đăng Nhập</a>
                        <ul class="sub-menu">
                            <li><a href="/dang-nhap">Đăng Nhập</a></li>
                            <li><a href="/dang-ky">Đăng Ký</a></li>
                        </ul>
                    </li>
                     <?php }?>
                    <li>
                        <a href="/lien-he">Liên Hệ</a>
                    </li>
                </ul>
                <!-- END / MENU -->

                <!-- SEARCH BOX -->
                <div class="search-box">
                    <gcse:search></gcse:search>
                </div>
                <!-- END / SEARCH BOX -->

                <?php if(isset($_SESSION['login'])){?>
                <!-- LIST ACCOUNT INFO -->
                <ul class="list-account-info">
                    
                    <li class="list-item account">
                        <div class="account-info item-click">
                            <img src="/images/Student-Icon.png" alt="">
                        </div>
                        <div class="toggle-account toggle-list">
                            <ul class="list-account">
                                <li><a href="/student"><span style="margin-left: 16px; color: #6a6a6;">Welcome, <?php echo $_SESSION['login']?></span></a></li>
                                <li><a href="/logout"><i class="icon md-arrow-right"></i>Sign Out</a></li>
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
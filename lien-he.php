<?php
require_once 'config.php';
require_once 'php-slugs.php';
if(!isset($_SESSION))
    session_start();

echo getRenderedHTML('_header.php', '');
?>
    <!-- SUB BANNER -->
    <section class="sub-banner sub-banner-course">
        <div class="awe-static bg-sub-banner-course"></div>
        <div class="container">
            <div class="sub-banner-content">
                <h2 class="text-center">ĐẾN VỚI CHÚNG TÔI VÀ BẠN SẼ ĐƯỢC TƯ VẤN TẬN TÌNH</h2>
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
                    <div class="blog-single-content">
                        <!-- POST -->
                        <div class="post post-single">
						<div class="post-title">
								<h5>Mọi thông tin cần biết về khóa học xin liên hệ:</h5>
								<h5>HOTLINE: 01662.022.653 (Mr. Toàn)</h5>
								<a href="https://www.facebook.com/ieducatorvn/" target="_blank"> <h5> Facebook.com/ieducatorvn/</h5></a>
								<a href="mailto:support@i-educator.vn"> <h5>Email: support@i-educator.vn </h5></a>
								<h5>Làm việc cả thứ 7 và chủ nhật.</h5>
                            </div>
                            <div class="post-title">
                                <h5>Địa Chỉ: 29/7 (X6) Đường D2, P25, Quận Bình Thạnh, TPHCM</h5>
                            </div>
							<div class="post-media">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1959.5574983453093!2d106.71398365781364!3d10.80250363275591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528a450c29cbf%3A0xffc8ef5bcf28fe52!2zWDYgxJDGsOG7nW5nIEQyLCBQaMaw4budbmcgMjUsIELDrG5oIFRo4bqhbmgsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1453890205663" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
							

                            <div class="post-content">
                                <h5></h5>
                                
                            </div>
                        </div>
                        <!-- END / POST -->                

                        
                    </div>
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
<?php echo getRenderedHTML('_footer.php') ?>
<?php
mysql_close($conn);
?>

<script type="text/javascript">
    
    if ($('.related-slider').length) {
        $('.related-slider').owlCarousel({
            autoPlay: 20000,
            slideSpeed: 300,
            navigation: true,
            pagination: false,
            singleItem: true,
            navigationText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>']  
        });
    }
</script>
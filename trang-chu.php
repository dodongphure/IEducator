<?php
require_once 'config.php';
require_once 'php-slugs.php';
if(!isset($_SESSION))
    session_start();

echo getRenderedHTML('_header.php','');
?>

    <!-- HOME SLIDER -->
    <section class="slide" style="background-image: url(images/homeslider/bg.jpg)">
        <div class="container">
            <div class="slide-cn" id="slide-home">
                <!-- SLIDE ITEM -->
                <div class="slide-item">
                    <div class="item-inner">
                        <div class="text">
                            <h2>TIẾNG ANH KHÔNG KHÓ</h2>
                            <p>Chúng tôi, những sinh viên xuất phát từ con số 0<br> đã gặt hái những điểm số cao ở các kỳ thi IELTS, TOEIC!<br> Còn bạn thì sao?
                            </p>
                            <div class="group">
                                <a href="gioi-thieu" class="mc-btn btn-style-1">Xem Thêm</a>
                            </div>
                        </div>

                        <div class="img">
                            <img src="images/homeslider/img-thumb.png" alt="">
                        </div>
                    </div>

                </div>  
                <!-- SLIDE ITEM -->     

                <!-- SLIDE ITEM -->
                <div class="slide-item">
                    <div class="item-inner">
                        <div class="text">
                            <h2>TIẾNG ANH KHÔNG KHÓ</h2>
                            <p>Chúng tôi, những sinh viên xuất thân từ con số 0<br> đã đạt được điểm số cao ở các kỳ thi IELTS, TOEIC!<br> Vậy còn bạn?
                            </p>
                            <div class="group">
                                <a href="gioi-thieu" class="mc-btn btn-style-1">Xem Thêm</a>
                            </div>
                        </div>

                        <div class="img">
                            <img src="images/homeslider/img-thumb.png" alt="">
                        </div>

                    </div>  
                </div>  
                <!-- SLIDE ITEM -->  

            </div>
        </div>
    </section>
    <!-- END / HOME SLIDER -->


    <!-- AFTER SLIDER -->
    <!-- END / AFTER SLIDER -->
    
    <!-- SECTION 1 -->
    <section id="mc-section-1" class="mc-section-1 section">
        <div class="container">
            <div class="row">
                
                <div class="col-md-5">
                    <div class="mc-section-1-content-1"> 
                        <h2 class="big">HỌC ONLINE HIỆU QUẢ</h2>
                        <p class="mc-text">Lần đầu tiên học viên được tiếp cận phương pháp học mới với việc làm bài tập online thú vị và hiệu quả</p>
                        <a href="gioi-thieu" class="mc-btn btn-style-1">Xem Thêm</a>
                    </div>
                </div>
    
                <div class="col-md-6 col-lg-offset-1">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-1"></i>
                                <h4 class="title-box text-uppercase">ĐA DẠNG</h4>
                                <p>Cung cấp nhiều loại bài tập giúp rèn luyện cả 4 kỹ năng NGHE, NÓI, ĐỌC, VIẾT thiết thực cho các kỳ thi IELTS, TOEIC </p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-2"></i>
                                <h4 class="title-box text-uppercase">CHÍNH XÁC</h4>
                                <p> Với hệ thống chấm điểm tự động và gởi đáp án cho học viên tham khảo với độ chính xác cao và nhanh chóng</p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-3"></i>
                                <h4 class="title-box text-uppercase">TẬN TÂM</h4>
                                <p>Học viên có thể an tâm học và làm bài tập một cách khoa học thông qua hệ thống nhắc nhở và được kiểm soát bởi admin</p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-4"></i>
                                <h4 class="title-box text-uppercase">CHUYÊN NGHIỆP</h4>
                                <p> Không những được tiếp xúc trực tiếp trên lớp, học viên có thể trao đổi với giáo viên thông qua hệ thống thông minh</p>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>
    <!-- END / SECTION 1 -->
    
    
    
    <!-- SECTION 2 -->
    <section id="mc-section-2" class="mc-section-2 section">
        <div class="awe-parallax bg-section1-demo"></div>
        <div class="overlay-color-1"></div>
        <div class="container">
            <div class="section-2-content">
                <div class="row">
                    
                    <div class="col-md-5">
                        <div class="ct">
                            <h2 class="big">NGUỒN TÀI LIỆU PHONG PHÚ</h2>
                            <p class="mc-text">Cung cấp toàn bộ tài liệu cần thiết cho kỳ thi IELTS, TOEIC cũng như những bài học từ vựng, ngữ pháp và các mẹo giúp việc học Tiếng Anh của bạn trở nên dễ dàng hơn bao giờ hết.</p>
                            <a href="/danh-muc/tat-ca/" class="mc-btn btn-style-3">Xem Thêm</a>
                        </div>
                    </div>
    
                    <div class="col-md-7">
                        <div class="image">
                            <img src="images/image.png" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- END / SECTION 2 -->
    
    
    <!-- SECTION 3 -->
    <section id="mc-section-3" class="mc-section-3 section">
        <div class="container">
            <!-- FEATURE -->
            <div class="feature-course">
                <h4 class="title-box text-uppercase">Bản Tin</h4>
                <a href="/danh-muc/tat-ca/" class="all-course mc-btn btn-style-1">Xem Thêm</a>
                <div class="row">
                    <div class="feature-slider">
                    <?php
                    $sql = "SELECT * FROM postData ORDER BY timeCreated DESC LIMIT 8";
                    $result = mysql_query($sql, $conn);
                    if (mysql_num_rows($result) > 0) {
                        while($row = mysql_fetch_assoc($result)){
                    ?>
                        <div class="mc-item mc-item-1">
                            <div class="image-heading">
                                <?php
                                if($row['thumbnail']!=null)
                                    $imageSrc = "/".$row['thumbnail'];
                                else
                                    $imageSrc = "/images/posts/".$row['cat'].".jpg";
                                ?>
                                <a href="<?php echo '/danh-muc/'.$row['cat'].'/'.makeSlugs($row['title'])?>"><img src="<?php echo $imageSrc?>" alt=""></a>
                            </div>
                            <div class="content-item">                                
                                <h4><a href="<?php echo '/danh-muc/'.$row['cat'].'/'.makeSlugs($row['title'])?>"><?php echo $row["title"]?></a></h4>
                                <div class="name-author">
                                    By <a href="javascript:void(0)">I-Educator</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    </div>
                </div>              
            </div>
            <!-- END / FEATURE -->
        </div>
    </section>
    <!-- END / SECTION 3 -->
    
    
    
    <!-- BEFORE FOOTER -->
    <!-- END / BEFORE FOOTER -->
<?php echo getRenderedHTML('_footer.php', null) ?>
<?php
mysql_close($conn);
?>
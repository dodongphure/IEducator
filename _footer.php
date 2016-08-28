<?php
require_once 'config.php';
require_once 'php-slugs.php';
if(!isset($_SESSION))
    session_start();
?>

<!-- FOOTER -->
    <footer id="footer" class="footer">
        <div class="first-footer">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="widget megacourse">
                            <h3 class="md">I-EDUCATOR</h3>
                            <p>Với sự trợ giúp của công nghệ và phương pháp dạy khoa học, I-educator chắc chắn sẽ giúp bạn tiến bộ nhanh hơn và hiệu quả hơn trong việc học Ngoại Ngữ.</p>
                            <a href="/gioi-thieu" class="mc-btn btn-style-1">Khám Phá Nào</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="widget widget_latest_new">
                            <h3 class="sm">Đội Ngũ</h3>
                            <ul>
                                <li>
                                    <a href="/gioi-thieu">
                                        <div class="image-thumb">
                                            <img src="/images/team-13.jpg" alt="">
                                        </div>
                                        <span>Teacher: Mr. Đồng - IELTS 8.0</span>
                                    </a>
                                </li>
								<li>
                                    <a href="/gioi-thieu">
                                        <div class="image-thumb">
                                            <img src="/images/team-19.jpg" alt="">
                                        </div>
                                        <span>Teacher: Mr. Hiền - IELTS 7.0</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/gioi-thieu">
                                        <div class="image-thumb">
                                            <img src="/images/team-15.jpg" alt="">
                                        </div>
                                        <span>Teacher Assistant: Mr. Toàn - IELTS 7.0</span>
                                    </a>
                                </li>
								
                                <li>
                                    <a href="/gioi-thieu">
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
                                <li><a href="/gioi-thieu">Về Chúng Tôi</a></li>
                                <li><a href="/danh-muc/tat-ca/">Danh Mục</a></li>
                                <li><a href="/giai-de/tat-ca/">Giải Đề</a></li>
                                <li><a href="/student">Bài Tập</a></li>
                                <li><a href="/lien-he">Liên Hệ</a></li>
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
                                    <form id="emailRegisterForm">
                                        <input class="input-text" type="email" id="emailRegister" name="emailRegister" placeholder="Hãy nhập email của bạn" required>
                                        <button type="button" onclick="getEmailRegister()" class="mc-btn btn-style-2">ĐĂNG KÝ NGAY</button>
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
                <p class="copyright">Copyright © 2016 I-EDUCATOR. All rights reserved.</p>
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
<script src="/script/sweetalert/sweet-alert.js"></script>
<script type="text/javascript" src="/js/scripts.js"></script>
<script src="/script/jquery.scoped.js"></script>
<script src="/script/main.js"></script>
</body>
</html>
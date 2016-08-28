<?php
require_once 'config.php';
require_once 'php-slugs.php';
if(!isset($_SESSION))
    session_start();

echo getRenderedHTML('_header.php','');
?>

    <!-- SUB BANNER -->
    <section class="sub-banner sub-banner-course">
        <div class="awe-static bg-sub-banner-course"></div>
        <div class="container">
            <div class="sub-banner-content">
                <h2 class="text-center">TẠI SAO NÊN CHỌN I-EDUCATOR?</h2>
            </div>
        </div>
    </section>
    <!-- END / SUB BANNER -->


    <!-- COURSE -->
    <section class="course-top">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="sidebar-course-intro">
                        <hr class="line">
                        <div class="about-instructor">
							<h4 class="xsm black bold">Về Chúng Tôi</h4>
				<ul>
							<div class="image-instructor text-center">
                                        <img src="/images/team-11.jpg" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a>I-EDUCATOR</a></cite>
										<p>I-educator xuất phát từ một nhóm các bạn học sinh, sinh viên mà trong quá khứ đều đã không dành quá nhiều thời gian và tâm huyết cho bộ môn này. Tuy nhiên, từ thời điểm nhận ra tầm quan trọng của tiếng Anh, không chỉ là một điều kiện cần thiết để có thể bước ra vũ đài học thuật thế giới mà còn là một yếu tố quan trọng trong việc đảm bảo một cơ hội làm việc tốt trong tương lai, nhóm đã cật lực đầu tư cho môn học và giành lấy những thành quả đáng kể. Từ những học sinh khối A với vốn tiếng Anh hạn hẹp, các thành viên I-educator đã vươn lên đạt được những điểm số ấn tượng trong kỳ thi ngoại ngữ IELTS như 7.0, 7.5 hay 8.0.</p>				
				  </div>
				 </ul>
							<h4 class="xsm black bold">Đội Ngũ Giảng Viên</h4>
                            <ul>
                                <li>
                                    <div class="image-instructor text-center">
                                        <img src="images/team-13.jpg" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a>Mr. Đồng</a></cite>                                       
                                        <p>Từng là học sinh Khối A đỗ vào ĐH Ngoại Thương Cs2, không những tốt nghiệp loại Giỏi với điểm số 3.52/4.0, Mr. Đồng còn đạt điểm số IELTS Overall 8.0. Với sự đam mê bộ môn Tiếng Anh và mong muốn truyền đạt những phương pháp học tập và kiến thức mình đúc kết được trong quá trình luyện tập đến mọi người, Đồng tin rằng ngay cả những người mới bắt đầu cũng sẽ tiến bộ nhanh chóng và đạt được kết quả ngoài mong đợi.    </p>
                                    </div>
                                </li>
<li>
                                    <div class="image-instructor">
                                        <img src="images/team-15.jpg" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a>Mr. Toàn</a></cite>                                        
                                        <p>Tốt nghiệp ĐH Ngoại Thương Cs2 với điểm số 3.2/4.0 và đạt điểm số IELTS Overall 7.0. Hiện Toàn là Trợ Giảng chính và cùng với Đồng thành lập Trung Tâm I-educator với mong muốn đem lại một môi trường học tập thân thiện và chuyên nghiệp với sự trợ giúp của khoa học kỹ thuật. Toàn mong rằng I-educator không những là người thầy mà còn là người bạn mang lại những sự hỗ trợ tốt nhất cho những ai muốn cải thiện khả năng Tiếng Anh.</p>
                                    </div>
                                </li>								
                                <li>
                                    <div class="image-instructor">
                                        <img src="images/team-14.jpg" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a>Ms. Trúc</a></cite>                                        
                                        <p>Là Giảng viên đảm nhiệm lớp Speaking (IELTS Speaking 8.0). Trúc hiện là sinh viên Ngành Thương Mại ĐH RMIT. Được mọi người nhận xét là một người vui vẻ, hòa đồng và có kiến thức xã hội rộng lớn, đặc biệt là văn hóa Phương Tây, chắc chắn rằng những buổi học Speaking của bạn sẽ rất thú vị khi có Trúc đồng hành.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="image-instructor">
                                        <img src="images/team-16.jpg" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a>Mr. Danh</a></cite>                                        
                                        <p>Tên thật là Nguyễn Thành Danh - một học sinh, sinh viên tiêu biểu với những thành tích đáng nể như Tốt nghiệp ĐH Ngoại Thương xếp loại Xuất Sắc (3.61/4.0); hoàn thành các chửng chỉ như GMAT 700, Ielts 7.0, TOEIC 955 và CFA Level 1 trước khi ra trường. Ngoài ra, anh cũng rất đam mê với nghề giáo với kinh nghiệm giảng dạy GMAT tại Thư quán doanh nhân và cũng là một trong những người đồng hành đầu tiên trong sự nghiệp phát triển của I-educator. Hiện anh đang du học tại Ý với học bổng toàn phần chuyên ngành Tài Chính của trường Bocconi.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="image-instructor">
                                        <img src="images/team-17.jpg" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a>Ms. Ánh</a></cite>                                        
                                        <p>Tốt nghiệp trường THPT Chuyên Lê Quý Đôn, Quảng Trị - Từng đạt giải 3 Quốc Gia kỳ thi Anh Văn và có số điểm Ielts đáng mơ ước ở cả 4 kỹ năng (Overall: 8.0; trong đó L:8.5|R:8.5|S:8.0|W:7.5). Ánh hiện đang cộng tác tại CLB Kỹ Năng Doanh Nhân (Action Club) trực thuộc Đoàn trường ĐH Ngoại Thương Tp. Hồ Chí Minh. Với vóc người nhỏ nhắn nhưng mang trong mình trí thông minh và nhiệt huyết trong việc tìm tòi sự sáng tạo, Ánh mong muốn góp phần giúp mọi người có được sự hứng thú qua mỗi bài giảng và coi việc học Anh Văn là niềm đam mê của mỗi cá nhân.</p>
                                    </div>
                                </li>
								<li>
                                    <div class="image-instructor">
                                        <img src="images/team-19.jpg" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a>Mr. Hiền</a></cite>                                        
                                        <p>Mr. Hiền là một thành viên Đồng sáng lập trung tâm và gắn kết từ những ngày đầu hoạt động. Mr tốt nghiệp Đại học Ngoại thương với số điểm trung bình là 3.3/4 cùng với chứng chỉ IELTS 7.0. Mr. Hiền cùng các cộng sự có cùng mong ước là giúp các bạn trẻ cải thiện trình độ anh ngữ vì một tương lai tươi sáng hơn. Mr. hiện cũng đang là giáo viên chính thức của trung tâm.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>                        
                        <hr class="line">
                        <div class="widget widget_equipment">
                            <i class="icon md-config"></i>
                            <h4 class="xsm black bold">Giáo trình đa dạng</h4>
                            <div class="equipment-body">
                                <a>Tự biên soạn</a>,
                                <a>Phù hợp nhiều cấp độ học viên</a>
                            </div>
                        </div>
                        <div class="widget widget_tags">
                            <i class="icon md-download-2"></i>
                            <h4 class="xsm black bold">Trang thiết bị hiện đại</h4>
                            <div class="tagCould">                                 
                                <a>Có TV - Máy chiếu</a>, 
                                <a>Ghế dựa học sinh</a>                                
                            </div>
                        </div>
                        <div class="widget widget_share">
                            <i class="icon md-forward"></i>
                            <h4 class="xsm black bold">Theo dõi chúng tôi tại</h4>
                            <div class="share-body">                  
                              
                                <a href="https://www.facebook.com/ieducatorvn/" class="facebook" title="facebook" target="_blank">
                                    <i class="icon md-facebook-1"></i>
                                </a>
                                <a href="https://plus.google.com/107945507341608145022/posts" class="google-plus" title="google plus" target="_blank">
                                    <i class="icon md-google-plus"></i>
                                </a>					
							</div>
                        </div>
                    </div>
                </div>    
                <div class="col-md-7">
                    <div class="tabs-page">
                        <ul class="nav-tabs" role="tablist">
                            <li class="active"><a href="#introduction" role="tab" data-toggle="tab">Sơ Lược</a></li>
                            <li class="itemnew"><a href="#announcement" role="tab" data-toggle="tab">Khóa Học</a></li>
                            <li class="itemnew"><a href="#outline" role="tab" data-toggle="tab">Thư Viện Ảnh</a></li>
                            <li><a href="#review" role="tab" data-toggle="tab">Đánh Giá</a></li>
                            <li><a href="#student" role="tab" data-toggle="tab">Học Viên</a></li>                            
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- INTRODUCTION -->
                            <div class="tab-pane fade in active" id="introduction">
							<h4 class="sm black bold">TẠI SAO TIẾNG ANH CỦA BẠN VẪN KÉM?</h4>
                                <p>Nhiều bạn thắc mắc rằng tại sao đã học Anh Văn từ xưa đến nay, cũng đã trải qua nhiều trường lớp và trung tâm nhưng trình độ tiếng Anh của mình vẫn còn ở mức căn bản và không thể đạt được tấm bằng IELTS, TOEIC với điểm số như kỳ vọng. Vậy trước khi trả lời câu hỏi trên, bạn hãy tự nghĩ lại rằng: <br><br>BẠN ĐÃ THẬT SỰ CÓ MỤC TIÊU CỤ THỂ CHO VIỆC HỌC TIẾNG ANH CỦA MÌNH?<br><br>BẠN ĐÃ THẬT SỰ ĐẶT VIỆC HỌC ANH VĂN LÊN TRÊN NHỮNG MÔN HỌC KHÁC?<br><br>MỘT NGÀY BẠN CÓ DÀNH ĐỦ THỜI GIAN ĐỂ TẬP TRUNG CHO VIỆC HỌC ANH VĂN?<br><br>Nếu chỉ có một câu trả lời là KHÔNG cho ít nhất 1 trong 3 câu hỏi trên thì chắc chắn rằng bạn vẫn chưa có được mục tiêu đúng đắn và thái độ học tập một cách nghiêm túc để đạt được hoài bão của mình. Ngôn ngữ là một thứ không thể tiếp thu một cách nhanh chóng như những bộ môn khác, và bởi vì bạn đã có một thứ tiếng mẹ đẻ để giao tiếp hằng ngày, khoảng thời gian học Anh Văn trên trường hay tại các trung tâm là CHƯA ĐỦ để bạn thực sự có sự tiến bộ về bộ môn học thuật này. <br><br>Tuy nhiên không hẳn ai cũng có động lực và thời gian để dành thời gian học và tiếp xúc với tiếng Anh một cách thường xuyên khi mà phần đông đều cảm thấy LƯỜI BIẾNG và cho rằng đó không phải là NGHĨA VỤ mà mình phải làm, nói một cách khác, chúng ta cần những NGƯỜI THẦY, NGƯỜI BẠN để hỗ trợ không những trên lớp mà còn giám sát bài tập về nhà hằng ngày nhằm tạo cho mình một thói quen học tập đúng đắn.<br><br>Nắm bắt được tình trạng chung của hầu hết các bạn học Tiếng Anh, Chúng tôi đã thành lập I-EDUCATOR với mong muốn mang lại những sự trợ giúp tốt nhất cho người học Anh Văn thông qua những bài giảng bổ ích và quan trọng hơn, cung cấp HỆ THỐNG LÀM BÀI TẬP ONLINE CHƯA TỪNG CÓ Ở BẤT KỲ TRUNG TÂM NÀO.</p>
							
                                <h4 class="sm black bold">HỆ THỐNG LÀM BÀI TẬP ONLINE LÀ GÌ?</h4>
								<p>Như đã đề cập ở trên, I-educator mong muốn mang đến một công cụ hữu ích cho tất cả mọi người đều có thể thực hành trau dồi các kỹ năng tiếng Anh một cách thuận lợi nhất. Thông qua các bài tập được I-educator nghiên cứu và phát triển, chắc chắn rằng các kỹ năng nghe, đọc và viết của các bạn sẽ cải thiện một cách đáng kể. Chỉ cần đăng ký làm thành viên là bạn sẽ có 2 tuần làm bài tập online hoàn toàn miễn phí và bạn sẽ có thể làm bài tập trong 6 tháng nếu đăng ký tham gia những khóa học của chúng tôi.<br><br>Chỉ cần Đăng Ký tài khoản mới và chọn thẻ Bài Tập ở thanh Menu là bạn có thể khám phá những dạng bài tập hoàn toàn mới lạ và cấu trúc làm bài tập một cách chuyên nghiệp của I-educator.
								<h4 class="sm black bold">SỰ KHÁC BIỆT CỦA I-EDUCATOR VỚI CÁC TRUNG TÂM KHÁC</h4>
                                <ul class="list-disc">
									<li>Có hệ thống làm bài tập về nhà Online và chấm bài tập hằng ngày duy nhất chỉ có tại I-educator.vn.</li><br/>
                                    <li>Có đội ngũ giảng viên trẻ, hầu hết là sinh viên mới tốt nghiệp nhưng có kinh nghiệm giảng dạy và có tâm huyết với nghề.</li><br/>
                                    <li>Có giáo trình được trực tiếp biên soạn bởi I-educator, là sự đúc kết từ kinh nghiệm học tập của những bạn sinh viên khối A và đạt được kết quả cao trong kỳ thi IELTS, TOEIC.</li><br/>
									<li>Có những bộ đề thi IELTS được sử dụng trong kỳ thi thật, đã được kiểm chứng qua các lần thi của học viên trước.</li><br/>
									<li>Có kiểm tra đầu vào và tư vấn hoàn toàn miễn phí cho những đối tượng có nhu cầu đăng ký.</li><br/>
								</ul>                                
                                
                            </div>
                            <!-- END / INTRODUCTION -->
                            
                            <!-- ANNOUNCEMENT -->
                            <div class="tab-pane fade" id="announcement">
                                <ul class="list-announcement">
    
                                    <!-- LIST ITEM -->
                                    <li>
                                        <div class="list-body">
                                            <i class="icon md-flag"></i>
                                            <div class="list-content">
                                                <h4 class="sm black bold">
                                                    <a>TOEIC 400+</a>
                                                </h4>
                                                <p>Thời lượng: 3 tháng. 3 buổi 1 tuần <br><br>Học phí: 2.700.000đ/khóa<br><br>Giảng viên: <a>đạt chứng chỉ TOEIC 950+</a><br><br>Có trợ giảng riêng để theo sát từng học viên</p>						
                                                <br><div class="author">Giới hạn <a>15 học viên</a></div>
                                                <em>Còn 6 chỗ</em>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END / LIST ITEM -->
                                    
                                    <!-- LIST ITEM -->
                                    <li>
                                        <div class="list-body">
                                            <i class="icon md-flag"></i>
                                            <div class="list-content">
                                                <h4 class="sm black bold">
                                                    <a>TOEIC 650+</a>
                                                </h4>
                                                <p>Thời lượng: 3 tháng. 3 buổi 1 tuần <br><br>Học phí: 2.700.000đ/khóa<br><br>Giảng viên:<a> đạt chứng chỉ TOEIC 950+</a><br><br>Có trợ giảng riêng để theo sát từng học viên</p>						
                                                <br><div class="author">Giới hạn <a>15 học viên</a></div>
                                                <em>Còn 8 chỗ</em>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END / LIST ITEM -->
                                    
                                    <!-- LIST ITEM -->
                                    <li>
                                        <div class="list-body">
                                            <i class="icon md-flag"></i>
                                            <div class="list-content">
                                                <h4 class="sm black bold">
                                                    <a>IELTS 5.5+ và 7.0+</a>
                                                </h4>
                                                <p>Thời hạn: 6 tháng. 3 buổi 1 tuần <br><br>Học phí: 1.600.000đ/tháng<br><br>Giảng viên:<a> đạt chứng chỉ Ielts 8.0 </a>(Không kỹ năng nào dưới 7.5)<br><br>Cung cấp<a> hệ thống làm bài tập Online </a>và có trợ giảng theo sát từng học viên</p>
                                                <div class="author">Giới hạn <a>10 học viên</a></div>
                                                <em>Còn 3 chỗ</em>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END / LIST ITEM -->
                                </ul>
                            </div>
                            <!-- END / ANNOUNCEMENT -->                                  
                                                                
    
                            <!-- OUTLINE -->
                            <div class="tab-pane fade" id="outline">
                                <div id="sliderFrame">
                                <div id="slider">
                                    <?php
                                    for($i=1; $i<=14; $i++){
                                        echo "<img src=\"/images/imgSlider/".$i.".jpg\" />";
                                    }
                                    ?>
                                </div>
                            </div>

                            </div>
                            <!-- END / OUTLINE -->
    
                            <!-- REVIEW -->
                            <div class="tab-pane fade" id="review">
                                <div class="total-review">
                                    <h3 class="md black">4 Đánh Giá</h3>
                                    <div class="rating">
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#"></a>
                                    </div>
                                </div>  
                                <ul class="list-review">
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="images/students/team-nhatle.jpg" alt="">                                                    
                                                </a>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">Nhật Lệ - IELTS 7.0</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                </div>                           
                                                
                                                <p>6 tháng học IELTS ở I educator là khoảng thời gian học tiếng anh dường như có hiệu quả nhất trong những năm tháng học ngoại ngữ của mình. Mình chỉ định học IELTS để có bằng thôi nhưng sau khóa học, mình không chỉ đạt mục tiêu mà còn có thể DÙNG được anh văn trong đời thường và trong công việc - điều mà trước đây mình hi vọng cải thiện mãi rồi cứ chần chừ, rồi lại thôi. Bây giờ thì đối với anh văn, mình cũng khá tự tin rồi. Không sợ nói chuyện với người nước ngoài hay là sợ các buổi phỏng vấn bằng tiếng anh như trước nữa. Mình nghĩ mọi người ở I educator là những người có công lớn nhất không chỉ trong việc truyền đạt kiến thức về IETLS mà còn truyền động lực và cảm hứng đối với việc học tiếng anh cho người học nói chung và bản thân mình nói riêng. Mình không muốn so sánh trung tâm nào thì tốt hơn trung tâm nào, nhưng ở I educator, cái mà minh cảm nhận được rõ hơn hẳn những nơi khác là tâm huyết của người giảng dạy. Sẽ hiếm có nơi nào mà thầy giáo ngồi chấm bài writing 1, 2g sáng chỉ vì học sinh gửi bài lúc 12g đêm mà sáng hôm sau thì phải có bài sửa để trả trên lớp. Lúc học thì học sinh được trang bị tới tận răng mấy cái tài liệu,  ai yếu ngữ pháp nào là có liền bài tập phần ngữ pháp đó, còn lúc sắp thi thì khỏi nói, nhiều lúc học sinh còn không có trách nhiệm với kì thi của chính mình bằng thầy. Nên bạn nào cảm thấy mình có quyết tâm cải thiện anh văn và muốn thì IELTS thì ghé qua I educator cho biết nhé</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="images/students/team-thuthao.jpg" alt="">                                                    
                                                </a>
                                                <i class="icon"></i>
                                                <i class="icon"></i>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">Thu Thảo</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#"></a>
                                                </div>
                                                <p>Thầy dạy hay, hướng dẫn nhiều tips có ích mà những trung tâm khác em học không đề cập đến, nên kĩ năng làm test của em cũng khá lên nhiều 
Lớp học lúc nào cũng vui nữa, ngoài giờ kiểm tra ra thì lớp lúc nào cũng sôi động</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="images/students/team-ngocanh.jpg" alt="">
                                                </a>
                                                <i class="icon"></i>
                                                <i class="icon"></i>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">Ngọc Ánh</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
						    <a href="#" class="active"></a>
                                                    <a href="#"></a>          
                                                </div>                                                
                                                <p>Tham gia lớp học bên anh em thấy khá tốt. Tài liệu hay, phương phương dạy các kỹ năng tốt. Vì có nhiều bài tập về nhà quá nên được tiếp xúc với tiếng anh thường xuyên mấy kỹ năng anh Đồng đứng lớp thì rất tốt nhưng lớp Speaking thì vẫn cần cải thiện thêm về phương pháp dạy để lôi cuốn học viên hơn. Về người dạy hay trợ giảng đều rất ok, có tâm nữa.</p>
                                            </div>
                                        </div>
                                    </li>                        
                                </ul>                               
                            </div>
                            <!-- END / REVIEW -->
    
                            <!-- STUDENT -->
                            <div class="tab-pane fade" id="student">
                                <h3 class="md black">Với trên 50 Học Viên</h3>
                                <h4 class="xsm black bold">Đã hoàn thành khóa học</h4>
                                <div class="tab-list-student">
                                    <ul class="list-student">
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-thanhhien.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Thanh Hiền - IELTS 7.0</a></cite>
                                                <span class="address">Long An</span>
                                                <div class="icon-wrap">                                                    
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
    
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-nhatle.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Nhật Lệ - IELTS 7.0</a></cite>
                                                <span class="address">Đức Trọng</span>
                                                <div class="icon-wrap">                                                    
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
    
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-huuphuoc.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Hữu Phước - IELTS 7.0</a></cite>
                                                <span class="address">Vũng Tàu</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
    
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-thienphuc.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Thiên Phúc - IELTS 7.0</a></cite>
                                                <span class="address">Gia Lai</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
    
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-anhquoc.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Anh Quốc - IELTS 6.0</a></cite>
                                                <span class="address">Gia Lai</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
    
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-phucan.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Phúc An - IELTS 7.0</a></cite>
                                                <span class="address">Bến Tre</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
										
					<!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-myduyen.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Mỹ Duyên - IELTS 6.5</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
										
					<!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-mainhi.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Mai Nhi - IELTS 6.5</a></cite>
                                                <span class="address">Bình Dương</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
										
					<!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-hannguyen.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Hàn Nguyên - IELTS 7.5</a></cite>
                                                <span class="address">Gia Lai</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
										
					<!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-thuthao.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Thu Thảo - IELTS 7.0</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
					
					<!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-haitrieu.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Hải Triều - IELTS 7.0</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-trannguyen.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Huyền Trân - IELTS 6.5</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <h4 class="xsm black bold">Đang theo học</h4>                                       				
					<!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-thina.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Thị Na</a></cite>
                                                <span class="address">Huế</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
										
					<!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-ngocanh.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Ngọc Ánh</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-thanhthao.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Thanh Thảo</a></cite>
                                                <span class="address">Long Khánh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-vananh.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Vân Anh</a></cite>
                                                <span class="address">Thủ Dầu Một</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-depham.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Phạm Đệ</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-chilinh.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Chi Linh</a></cite>
                                                <span class="address">Đắk Lắk</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-thuhang.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Thu Hằng</a></cite>
                                                <span class="address">Đắk Lắk</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-vithao.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Vi Thảo</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-sonhao.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Sơn Hảo</a></cite>
                                                <span class="address">Bảo Lộc</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                         <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-minhtan.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Minh Tân</a></cite>
                                                <span class="address">Vũng Tàu</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                         <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-minhhuy.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Minh Huy</a></cite>
                                                <span class="address">Huế</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                         <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-bichnhi.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Bích Nhi</a></cite>
                                                <span class="address">Đắk Lắk</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-luuchuong.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Lưu Chương</a></cite>
                                                <span class="address">Bảo Lộc</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-ngocanh1.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Ngọc Anh</a></cite>
                                                <span class="address">Bảo Lộc</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-mytien.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Mỹ Tiên</a></cite>
                                                <span class="address">Bình Định</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-thuyduyen.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Thuỳ Duyên</a></cite>
                                                <span class="address">Gò Đông</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-hoanglien.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Hoàng Liên</a></cite>
                                                <span class="address">Đắk Lắk</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-nguyenhung.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Nguyễn Hưng</a></cite>
                                                <span class="address">Đắk Lắk</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-minhchien.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Minh Chiến</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-viethung.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Việt Hùng</a></cite>
                                                <span class="address">Gia Lai</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-duythuc.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Duy Thức</a></cite>
                                                <span class="address">Bến Tre</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-huynhquy.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Phúc Quý</a></cite>
                                                <span class="address">Tiền Gian</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-ngoctram.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Ngọc Trâm</a></cite>
                                                <span class="address">Trà Vinh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-honghanh.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Hồng Hạnh</a></cite>
                                                <span class="address">Bình Định</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-sanglam.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Minh Sáng</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-minhchien.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Minh Chiến</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-hoangtan.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Hoàng Tân</a></cite>
                                                <span class="address">Quy Nhơn</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-phuongdong.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Phương Đông</a></cite>
                                                <span class="address">Hải Dương</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-camthi.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Cẩm Thi</a></cite>
                                                <span class="address">Tây Ninh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-lethanh.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Lê Thanh</a></cite>
                                                <span class="address">Bình Định</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-phuongtrang.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Phương Trang</a></cite>
                                                <span class="address">Sóc Trăng</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-kimtrang.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Kim Trang</a></cite>
                                                <span class="address">Đắk Lắk</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-xuananh.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Xuân Anh</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-nhatkhanh.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Nhật Khánh</a></cite>
                                                <span class="address">Phan Thiết</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-luanngo.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Luân Ngô</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-sonhai.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Sơn Hải</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-baotrung.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Bảo Trung</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-thuyphuong.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Thùy Phương</a></cite>
                                                <span class="address">Đắk Lắk</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-phucdat.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Phúc Đạt</a></cite>
                                                <span class="address">Quảng Ngãi</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-hongthinh.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Hồng Thịnh</a></cite>
                                                <span class="address">Đà Nẵng</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-catheryhuong.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Cathery Hương</a></cite>
                                                <span class="address">Hồ Chí Minh</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-camtu.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Cẩm Tú</a></cite>
                                                <span class="address">Gia Lai</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                        
                                        <!-- LIST STUDENT -->
                                        <li>
                                            <div class="image">
                                                <img src="images/students/team-myhuyen.jpg" alt="">
                                            </div>
                                            <div class="list-body">
                                                <cite class="xsm"><a href="#">Mỹ Huyền</a></cite>
                                                <span class="address">Gia Lai</span>
                                                <div class="icon-wrap">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END / LIST STUDENT -->
                                           
	
                                    </ul>
                                </div>
                               
                            </div>
                            <!-- END / STUDENT -->
    
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->
    
<?php echo getRenderedHTML('_footer.php', null) ?>
<?php
mysql_close($conn);
?>
<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

add_javascript('<script src="'.G5_THEME_JS_URL.'/unslider.min.js"></script>', 10);
?>


<!--메인배너 {-->
<div id="main_bn_box">
    <div id="main_bn">
        <ul class="bn_ul">
            <li class="bn_bg1">
                <div class="bn_wr"><a href="#none"><img src="<?php echo G5_THEME_IMG_URL ?>/main_banner_s.png" alt="메인베너" /></a></div>
            </li>
            <li class="bn_bg1">
                <div class="bn_wr"><a href="#none"><img src="<?php echo G5_THEME_IMG_URL ?>/main_banner_s.png" alt="메인베너" /></a></div>
            </li>
            <li class="bn_bg1">
                <div class="bn_wr"><a href="#none"><img src="<?php echo G5_THEME_IMG_URL ?>/main_banner_s.png" alt="메인베너" /></a></div>
            </li>
            <li class="bn_bg1">
                <div class="bn_wr"><a href="#none"><img src="<?php echo G5_THEME_IMG_URL ?>/main_banner_s.png" alt="메인베너" /></a></div>
            </li>
        </ul>
    </div>
</div>
<!--} 메인배너-->
<script>
$(function() {
    $("#main_bn").unslider({
        speed: 700,               //  The speed to animate each slide (in milliseconds)
        delay: 3000,              //  The delay between slide animations (in milliseconds)
        keys: true,               //  Enable keyboard (left, right) arrow shortcuts
        dots: true,               //  Display dot navigation
        fluid: false              //  Support responsive design. May break non-responsive designs
    });
    var unslider = $("#main_bn").unslider();
    $('.unslider-arrow').click(function() {
        var fn = this.className.split(' ')[1];

        //  Either do unslider.data('unslider').next() or .prev() depending on the className
        unslider.data('unslider')[fn]();
        });
    });
</script>

<!-- 최신게시글 {-->
<div class="new_latest">
    <?php
    // 소스 시작 
	$arr_option = array('',120); 
	echo latest("theme/top2", "banner_teacher", 5, 50, 1, $arr_option); 
	// latest("스킨폴더명", "게시판테이블", "데이터행", "제목글자수", "캐시타임", "옵션"); 
	// 소스 끝 
    
    ?>
</div>
<!-- 최신게시글 }-->

<!-- 최신게시글 {-->
<div class="new_latest">
    <?php
    // new_latest('스킨', '출력라인', '글자수', 'is_comment', cache_minute)
    echo latest('theme/costom', 'teacher_music', 6, 70);
    ?>
</div>
<!-- 최신게시글 }-->

<!-- 최신게시글 {-->
<div class="new_latest">
    <?php
    // 소스 시작 
	$arr_option = array('',120); 
	echo latest("theme/top2", "banner_sales", 5, 50, 1, $arr_option); 
	// latest("스킨폴더명", "게시판테이블", "데이터행", "제목글자수", "캐시타임", "옵션"); 
	// 소스 끝 
    
    ?>
</div>
<!-- 최신게시글 {-->
<div class="new_latest">
    <?php
    // new_latest('스킨', '출력라인', '글자수', 'is_comment', cache_minute)
    echo latest('theme/costom', 'sales', 6, 70);
    ?>
</div>
<!-- 최신게시글 }-->

<div class="lt_pc lt_ml">
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/basic', 'teacher_music', 6, 25);
    ?>
</div>
<div class="lt_pc">
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/basic', 'teacher_art', 6, 25);
    ?>
</div>
<div class="lt_pc lt_ml">
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/basic', 'teacher_dance', 6, 25);
    ?>
</div>
<div class="lt_pc">
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/basic', 'teacher_physical', 6, 25);
    ?>
</div>

<div>
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    $options = array(
            'thumb_width'    => 170, // 썸네일 width
            'thumb_height'   => 149,  // 썸네일 height
            'content_length' => 40   // 간단내용 길이
    );
    echo latest('theme/gallery', 'gallery', 4, 25, 1, $options);
    ?>
</div>


<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
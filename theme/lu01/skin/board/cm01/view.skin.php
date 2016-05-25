<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<div class="page-header">
    <h1><?php echo $board['bo_subject'] ?><span class="sound_only"> 내용보기</span></h1>
</div>

<article id="bo_v" style="width:<?php echo $width; ?>">
    <header>
        <h1 id="bo_v_title">
            <?php
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            if ($category_name) echo '<span id="bo_v_cate" class="badge">'.$view['ca_name'].'</span>'; // 분류 출력 끝
            ?>
        </h1>

        <div>
            <i class="fa fa-user"></i> <?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>
            <i class="fa fa-calendar lmg10"></i>
            <span class="sound_only">작성일</span>
            <?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?>
            <i class="fa fa-eye lmg10"></i> <?php echo number_format($view['wr_hit']) ?>회
            <i class="fa fa-comment-o lmg10"></i> <?php echo number_format($view['wr_comment']) ?>건
        </div>
        <hr>

    </header>

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
     ?>

    <?php if($cnt || $view['link']) { ?>
    <section id="bo_v_file_link">
        <ul class="list-group">
        <?php if($cnt) { ?>
            <!-- 첨부파일 시작 -->
            <?php
            // 가변 파일
            $fcnt = 0;
            for ($i=0; $i<count($view['file']); $i++) {
                if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
                    $fcnt++;
             ?>
                <li class="list-group-item">
                    파일 #<?php echo $fcnt; ?>
                    <span class="lmg10">
                        <i class="fa fa-file"></i>
                        <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                            <?php echo $view['file'][$i]['source'] ?>
                            <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                        </a>
                        <span class="bo_v_file_cnt lmg10"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                        <span class="lmg10"><i class="fa fa-clock-o"></i> <?php echo $view['file'][$i]['datetime'] ?></span>
                    </span>
                </li>
            <?php
                }
            }
             ?>
        <!-- } 첨부파일 끝 -->
        <?php } ?>

        <?php
        if ($view['link']) {
         ?>
         <!-- 관련링크 시작 { -->
            <?php
            // 링크
            $cnt = 0;
            for ($i=1; $i<=count($view['link']); $i++) {
                if ($view['link'][$i]) {
                    $cnt++;
                    $link = cut_str($view['link'][$i], 70);
             ?>
                <li class="list-group-item">
                    관련링크 #<?php echo $i; ?>
                    <span class="lmg10">
                        <i class="fa fa-link"></i>
                        <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                             <?php echo $link ?>
                        </a>
                        <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
                    </span>
                </li>
            <?php
                }
            }
             ?>
        <!-- } 관련링크 끝 -->
        <?php } ?>
        </ul>
    </section>
    <?php } ?>

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top" class="clearfix">
        <?php
        ob_start();
         ?>
        <?php if ($prev_href || $next_href) { ?>
        <div class="pull-left">
            <?php if ($prev_href) { ?><a href="<?php echo $prev_href ?>" class="btn btn-default btn-sm">이전글</a><?php } ?>
            <?php if ($next_href) { ?><a href="<?php echo $next_href ?>" class="btn btn-default btn-sm">다음글</a><?php } ?>
        </div>
        <?php } ?>

        <div class="pull-right">
            <?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="btn btn-default btn-sm">수정</a><?php } ?>
            <?php if ($delete_href) { ?><a href="<?php echo $delete_href ?>" class="btn btn-default btn-sm" onclick="del(this.href); return false;">삭제</a><?php } ?>
            <?php if ($copy_href) { ?><a href="<?php echo $copy_href ?>" class="btn btn-warning btn-sm" onclick="board_move(this.href); return false;">복사</a><?php } ?>
            <?php if ($move_href) { ?><a href="<?php echo $move_href ?>" class="btn btn-warning btn-sm" onclick="board_move(this.href); return false;">이동</a><?php } ?>
            <?php if ($search_href) { ?><a href="<?php echo $search_href ?>" class="btn btn-default btn-sm">검색</a><?php } ?>
            <a href="<?php echo $list_href ?>" class="btn btn-default btn-sm">목록</a></li>
            <?php if ($reply_href) { ?><a href="<?php echo $reply_href ?>" class="btn btn-default btn-sm">답변</a><?php } ?>
            <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn btn-danger btn-sm">글쓰기</a><?php } ?>
        </div>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>
        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo '<p>'.get_view_thumbnail($view['file'][$i]['view']).'</p>';
                }
            }

            echo "</div>\n";
        }
        ?>
        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>

        <!-- 스크랩 추천 비추천 시작 { -->
        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
        <div id="bo_v_act">
            <?php if ($scrap_href) { ?><a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn btn-default btn-sm" onclick="win_scrap(this.href); return false;"><i class="fa fa-folder-o"></i> 스크랩</a><?php } ?>
            <?php if ($good_href) { ?>
                <span class="bo_v_act_gng">
            <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn btn-default btn-sm"><i class="fa fa-thumbs-o-up"></i> 추천 <span class="text-info"><?php echo number_format($view['wr_good']) ?></span></a>
            <b id="bo_v_act_good"></b>
        </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
                <span class="bo_v_act_gng">
            <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn btn-default btn-sm"><i class="fa fa-thumbs-o-down"></i> 비추천  <span class="text-danger"><?php echo number_format($view['wr_nogood']) ?></span></a>
            <b id="bo_v_act_nogood"></b>
        </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div id="bo_v_act">
            <?php if($board['bo_use_good']) { ?><span>추천 <strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span>비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <!-- } 스크랩 추천 비추천 끝 -->
    </section>

    <?php
    include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>

    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

    <!-- 링크 버튼 시작 { -->
    <div id="bo_v_bot" class="clearfix">
        <?php echo $link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->
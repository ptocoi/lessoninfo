<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<!-- 쪽지 목록 시작 { -->
<div class="container">
    <h4><?php echo $g5['title'] ?></h4>

    <div class="pull-right">
        전체 <?php echo $kind_title ?>쪽지 <?php echo $total_count ?>통<br>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        <li><a href="./memo.php?kind=recv">받은쪽지</a></li>
        <li><a href="./memo.php?kind=send">보낸쪽지</a></li>
        <li><a href="./memo_form.php">쪽지쓰기</a></li>
    </ul>

    <table class="table table-hover table-striped">
    <thead>
    <tr>
        <th scope="col"><?php echo  ($kind == "recv") ? "보낸사람" : "받는사람";  ?></th>
        <th scope="col">보낸시간</th>
        <th scope="col">읽은시간</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
    <tr>
        <td class="nouline"><?php echo $list[$i]['name'] ?></td>
        <td><a class="nouline" href="<?php echo $list[$i]['view_href'] ?>"><?php echo $list[$i]['send_datetime'] ?></a></td>
        <td><a class="nouline" href="<?php echo $list[$i]['view_href'] ?>"><?php echo $list[$i]['read_datetime'] ?></a></td>
        <td><a class="btn btn-danger btn-xs" href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;">삭제</a></td>
    </tr>
    <?php }  ?>
    <?php if ($i==0) { echo '<tr><td colspan="4" class="empty_table">자료가 없습니다.</td></tr>'; }  ?>
    </tbody>
    </table>

    <p class="help-block">
        쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del'] ?></strong>일 입니다.
    </p>

    <div class="text-center">
        <button type="button" onclick="window.close();" class="btn btn-primary btn-sm">창닫기</button>
    </div>
</div>

<!-- } 쪽지 목록 끝 -->

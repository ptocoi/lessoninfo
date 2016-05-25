<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

include_once "inc.skinL.php";

$view = gp_do_filter('sl_view', $view);

$no_photo = $board_skin_url . "/img/no_photo.gif";
$mb_photo = "";
if ($view['mb_id']) {
    $mb_dir = substr($view['mb_id'], 0, 2);
    $mb_photo = G5_DATA_PATH . "/member_image/" . $mb_dir . "/" . $view['mb_id'];
    $mb_photo_url = G5_DATA_URL . "/member_image/" . $mb_dir . "/" . $view['mb_id'];
}

if (!$mb_photo || !file_exists($mb_photo)) $mb_photo_url = $no_photo;

$view_info = array(array('attr' => 'class="name"', 'text' => $view['name'] . ($is_ip_view ? '&nbsp;<span class="ip">(' . $ip . ')</span>' : ''), 'order' => 10),
    array('attr' => 'class="date"', 'text' => '작성일시 : <span>' . date('y-m-d H:i', strtotime($view['wr_datetime'])) . '</span>', 'order' => 20),
    array('attr' => 'class="hit"', 'text' => '조회 : <span>' . number_format($view['wr_hit']) . '</span>', 'order' => 30),
    array('attr' => 'class="comments"', 'text' => '댓글 : <span>' . number_format($view['wr_comment']) . '</span>', 'order' => 40),
    array('attr' => 'class="good"', 'text' => '좋아요 : <span>' . number_format($view['wr_good']) . '</span>', 'condition' => 'is_good', 'order' => 50),
    array('attr' => 'class="nogood"', 'text' => '싫어요 : <span>' . number_format($view['wr_nogood']) . '</span>', 'condition' => 'is_nogood', 'order' => 60)
);
$view_info = gp_do_filter('sl_view_info', $view_info);
$view_info = gp_subval_asort($view_info, 'order');

$view_menu1 = array(array('href_attr' => 'class="sl_btn sl_btn2 sl_btn_copy" onclick="board_move(this.href); return false;"', 'href' => $copy_href, 'text' => '복사', 'condition' => 'copy_href', 'order' => 10),
    array('href_attr' => 'class="sl_btn sl_btn2 sl_btn_move" onclick="board_move(this.href); return false;"', 'href' => $move_href, 'text' => '이동', 'condition' => 'move_href', 'order' => 20)
);
$view_menu1 = gp_do_filter('sl_view_menu1', $view_menu1);
$view_menu1 = gp_subval_asort($view_menu1, 'order');

$view_menu2 = array(array('href_attr' => 'class="sl_btn sl_btn_search_list"', 'href' => $search_href, 'text' => '검색목록', 'condition' => 'search_href', 'order' => 10),
    array('href_attr' => 'class="sl_btn sl_btn_list"', 'href' => $list_href, 'text' => '목록', 'condition' => '', 'order' => 20),
    array('href_attr' => 'class="sl_btn sl_btn_modify"', 'href' => $update_href, 'text' => '수정', 'condition' => 'update_href', 'order' => 30),
    array('href_attr' => 'class="sl_btn sl_btn_delete" onclick="del(this.href); return false;"', 'href' => $delete_href, 'text' => '삭제', 'condition' => 'delete_href', 'order' => 40),
    array('href_attr' => 'class="sl_btn sl_btn_reply"', 'href' => $reply_href, 'text' => '답변', 'condition' => 'reply_href', 'order' => 50),
    array('href_attr' => 'class="sl_btn emp sl_btn_write"', 'href' => $write_href, 'text' => '글쓰기', 'condition' => 'write_href', 'order' => 60)
);
$view_menu2 = gp_do_filter('sl_view_menu2', $view_menu2);
$view_menu2 = gp_subval_asort($view_menu2, 'order');

$view_menu3 = array(array('href_attr' => 'class="sl_btn sl_btn2 sl_btn_scrap"', 'href' => 'javascript:win_scrap(\'' . $scrap_href . '\');', 'text' => '스크랩', 'condition' => 'scrap_href', 'order' => 10),
    array('href_attr' => 'class="sl_btn sl_btn2 sl_btn_trackback"', 'href' => 'javascript:trackback_send_server(\'' . $trackback_url . '\');', 'text' => '트랙백', 'condition' => 'trackback_url', 'order' => 20)
);
$view_menu3 = gp_do_filter('sl_view_menu3', $view_menu3);
$view_menu3 = gp_subval_asort($view_menu3, 'order');

$view_menu4 = array(array('href_attr' => 'class="sl_btn sl_btn_nogood"', 'href' => $nogood_href, 'text' => '싫어요', 'condition' => 'nogood_href', 'order' => 10),
    array('href_attr' => 'class="sl_btn sl_btn_good"', 'href' => $good_href, 'text' => '좋아요', 'condition' => 'good_href', 'order' => 20)
);
$view_menu4 = gp_do_filter('sl_view_menu4', $view_menu4);
$view_menu4 = gp_subval_asort($view_menu4, 'order');
?>

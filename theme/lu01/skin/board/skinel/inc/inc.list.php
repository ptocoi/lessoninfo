<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

include_once "inc.skinL.php";

$list = gp_do_filter('sl_list', $list);
$list_head = array(
				array('attr'=>'class="checkbox"', 'text'=>'<label for="chk_label" class="sound_only">전체선택</label><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type="checkbox" id="chk_label"/>', 'condition'=>'is_checkbox', 'order'=>10),
				array('attr'=>'class="num"', 'text'=>'', 'order'=>20),
				array('attr'=>'class="category"', 'text'=>'분류', 'condition'=>'is_category', 'order'=>30),
				array('attr'=>'class="subject"', 'text'=>'제&nbsp;&nbsp;&nbsp;목', 'order'=>40),
				array('attr'=>'class="info"', 'render'=>'sl_print_head_info', 'order'=>50)
			);	
//if(G5_IS_MOBILE) $list_head = array();

$list_head = gp_do_filter('sl_list_head', $list_head);
$list_head = gp_subval_asort($list_head, 'order');

function sl_print_head_info($row)
{
	global $qstr2;
	$list_info = array(
					array('attr'=>'class="name"', 'text'=>'글쓴이', 'th_attr'=>'scope="col"', 'order'=>40),
					array('attr'=>'class="datetime"', 'text'=>subject_sort_link('wr_datetime', $qstr2, 1).'날짜</a>', 'order'=>50),
					array('attr'=>'class="hit"', 'text'=>subject_sort_link('wr_hit', $qstr2, 1).'조회</a>', 'order'=>60),
					array('attr'=>'class="good"', 'text'=>subject_sort_link('wr_good', $qstr2, 1).'좋아</a>', 'condition'=>'is_good', 'order'=>70),
					array('attr'=>'class="nogood"', 'text'=>subject_sort_link('wr_nogood', $qstr2, 1).'싫어</a>', 'condition'=>'is_nogood', 'order'=>80)
				);
  $list_info = gp_do_filter('sl_list_head_info', $list_info);
  $list_info = gp_subval_asort($list_info, 'order');
	gp_print(array('ul', 'class="sll_info"'), $list_info);
}

$list_items = array(
				array('attr'=>'class="checkbox"', 'render'=>'sl_print_checkbox', 'condition'=>'is_checkbox', 'order'=>10),
				array('attr'=>'class="num"','render'=>'sl_print_num', 'order'=>20),
				array('attr'=>'class="category"','render'=>'sl_print_category', 'condition'=>'is_category', 'order'=>30),
				array('attr'=>'class="subject"', 'render'=>'sl_print_subject', 'order'=>40),
				array('attr'=>'class="info"', 'render'=>'sl_print_item_info', 'order'=>50)
			);	
//if(G5_IS_MOBILE) unset($list_items[1]);

$list_items = gp_do_filter('sl_list_items', $list_items);
$list_items = gp_subval_asort($list_items, 'order');

function sl_print_item_info($row)
{
	$list_info = array(
		array('attr'=>'class="category"', 'render'=>'sl_print_category', 'condition'=>'is_category', 'order'=>30),
		array('attr'=>'class="name"', 'render'=>'sl_print_name', 'order'=>40),
		array('attr'=>'class="datetime"', 'render'=>'sl_print_datetime', 'order'=>50),
		array('attr'=>'class="hit"', 'render'=>'sl_print_hit', 'order'=>60),
		array('attr'=>'class="good"', 'render'=>'sl_print_good', 'condition'=>'is_good', 'order'=>70),
		array('attr'=>'class="nogood"', 'render'=>'sl_print_nogood', 'condition'=>'is_nogood', 'order'=>80)
	);
  $list_info = gp_do_filter('sl_list_info_items', $list_info);
	gp_print(array('ul', 'class="sll_info"'), $list_info, 'li', $row);
}
function sl_print_num($row) {	echo '<span>'.($row['is_notice'] ? '공지' : $row['num']).'</span>';}			
function sl_print_category($row) { echo '<i class="fa fa-tag"></i><span><a href="'.$row['ca_name_href'].'">'.$row['ca_name'].'</a></span>';}			
function sl_print_checkbox($row) { echo '<label for="chk_'.$row['wr_id'].'" class="sound_only">게시물 '.$row['wr_id'].' 체크</label>'.'<input type="checkbox" name="chk_wr_id[]" value="'.$row['wr_id'].'" id="chk_'.$row['wr_id'].'">'; }
function sl_print_name($row) { echo '<i class="fa fa-pencil"></i>'.$row['name']; }
function sl_print_datetime($row) { echo '<i class="fa fa-calendar"></i>'.$row['datetime2']; }
function sl_print_hit($row) { echo '<i class="fa fa-check"></i>'.$row['wr_hit']; }
function sl_print_good($row) { echo '<i class="fa fa-thumbs-o-up"></i>'.$row['wr_good']; }
function sl_print_nogood($row) { echo '<i class="fa fa-thumbs-o-up"></i>'.$row['wr_nogood']; }
function sl_print_subject($row)
{
	global $is_category, $nobr_begin, $nobr_end;
	//echo $nobr_begin;
	echo ($row['icon_reply'] ?  '<span class="board_icon icon_reply" title="답변글"></span>' : '');
	if ($row['is_notice'])
		echo "<a href=\"{$row['href']}\"><span class=\"notice\">{$row['subject']}</span></a>";
	else
		echo "<a href=\"{$row['href']}\">{$row['subject']}</a>";
	if ($row['comment_cnt']) 
		echo " <a href=\"{$row['comment_href']}\"><span class=\"comment\">{$row['comment_cnt']}</span></a>";
	echo " " . ($row['icon_new'] ? '<span class="board_icon icon_new" title="새글"></span>' : '');
	echo " " . ($row['icon_file'] ? '<span class="board_icon icon_file" title="파일"></span>' : '');
	echo " " . ($row['icon_link'] ? '<span class="board_icon icon_link" title="링크"></span>' : '');
	echo " " . ($row['icon_hot'] ? '<span class="board_icon icon_hot" title="인기글"></span>' : '');
	echo " " . ($row['icon_secret'] ? '<span class="board_icon icon_secret" title="비밀글"></span>' : '');
	gp_do_action('sl_list_icons', $row);
	//echo $nobr_end;
}

$colspan = count(array_filter($list_items, create_function('$item', 'return ( empty($item["condition"]) || $GLOBALS[$item["condition"]] );')));

$search_options = array(array('value'=>'wr_subject', 'text'=>'제목', 'order'=>10),
						array('value'=>'wr_content', 'text'=>'내용', 'order'=>20),
						array('value'=>'wr_subject||wr_content', 'text'=>'제목+내용', 'order'=>30),
						array('value'=>'mb_id,1', 'text'=>'회원아이디', 'order'=>40),
						array('value'=>'mb_id,0', 'text'=>'회원아이디(코)', 'order'=>50),
						array('value'=>'wr_name,1', 'text'=>'글쓴이', 'order'=>60),
						array('value'=>'wr_name,0', 'text'=>'글쓴이(코)', 'order'=>70)
					);
$search_options = gp_do_filter('sl_search_options', $search_options);
$search_options = gp_subval_asort($search_options, 'order');

$list_buttons = array(array('href_attr'=>'class="sl_btn sl_btn_list"', 'href'=>$list_href, 'text'=>'목록', 'condition'=>'list_href', 'order'=>10),
					  array('href_attr'=>'class="sl_btn sl_btn_write"', 'href'=>$write_href, 'text'=>'글쓰기', 'condition'=>'write_href', 'order'=>20)
					);
$list_buttons = gp_do_filter('sl_list_buttons', $list_buttons);
$list_buttons = gp_subval_asort($list_buttons, 'order');

$list_admin_menu = array(array('href_attr'=>'class="sl_btn_select_delete"', 'href'=>'javascript:select_delete();', 'text'=>'선택삭제', 'order'=>10),
						 array('href_attr'=>'class="sl_btn_select_copy"', 'href'=>'javascript:select_copy(\'copy\');', 'text'=>'선택복사', 'order'=>20),
						 array('href_attr'=>'class="sl_btn_select_move"', 'href'=>'javascript:select_copy(\'move\');', 'text'=>'선택이동', 'order'=>30),
						 array('href_attr'=>'class="sl_btn_board_admin"', 'href'=>$admin_href, 'text'=>'게시판관리', 'order'=>40)
					);
$list_admin_menu = gp_do_filter('sl_list_admin_menu', $list_admin_menu);
$list_admin_menu = gp_subval_asort($list_admin_menu, 'order');
?>

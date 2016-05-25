<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

include_once "inc.skinL.php";

$write = gp_do_filter('sl_write', $write);

$options = array();
$options_hidden = array();

if ($is_notice) {
    array_push($options, array('content' => '<input type="checkbox" class="chkbox" name="notice" id="notice" value="1" ' . $notice_checked . '><label for="notice">공지</label>&nbsp;', 'order' => 10));
}

if ($is_html) {
    if ($is_dhtml_editor) {
        array_push($options_hidden, array('content' => '<input type="hidden" value="html1" name="html">', 'order' => 20));
    } else {
        array_push($options, array('content' => '<input onclick="html_auto_br(this);" type="checkbox" class="chkbox" value="' . $html_value . '" name="html" id="html" ' . $html_checked . '><label for="html">html</label>&nbsp;', 'order' => 20));
    }
}

if ($is_secret) {
    if ($is_admin || $is_secret == 1) {
        array_push($options, array('content' => '<input type="checkbox" class="chkbox" value="secret" name="secret" id="secret" ' . $secret_checked . '><label for="secret">비밀글</label>&nbsp;', 'order' => 30));
    } else {
        array_push($options_hidden, array('content' => '<input type="hidden" value="secret" name="secret">', 'order' => 30));
    }
}
if ($is_mail) {
    array_push($options, array('content' => '<input type="checkbox" class="chkbox" value="mail" name="mail" id="mail" ' . $recv_email_checked . '><label for="mail">답변메일받기</label>&nbsp;', 'order' => 40));
}

$options = gp_do_filter('sl_write_options', $options);
$options = gp_subval_asort($options, 'order');
$option = '';
foreach ($options as $opt)
    $option .= $opt['content'];

$options_hidden = gp_do_filter('sl_write_options_hidden', $options_hidden);
$options_hidden = gp_subval_asort($options_hidden, 'order');
$option_hidden = '';
foreach ($options_hidden as $opt)
    $option_hidden .= $opt['content'];

ob_start();
echo $editor_html;
$sl_write_content = ob_get_contents();
ob_end_clean();

ob_start();
?>
<table id="g5_file_table" width="100%" cellpadding=0 cellspacing=0 style="table-layout:fixed">
<colgroup><col width="60px"/><col/></colgroup>
<?php for ($i = 0; $is_file && $i < $file_count; $i++) { ?>
<tr>
  <th scope="row">파일 #<?php echo $i + 1 ?></th>
  <td>
    <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i + 1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
    <?php if ($is_file_content) { ?>
    <input type="text" name="bf_content[]" value="<?php echo $file[$i]['bf_content']; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
    <?php } ?>
    <?php if ($w == 'u' && $file[$i]['file']) { ?>
    <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'] . '(' . $file[$i]['size'] . ')'; ?> 파일 삭제</label>
    <?php } ?>
  </td>
</tr>
<?php } ?>
</table>
<?php
$sl_write_files = ob_get_contents();
ob_end_clean();
$write_links = array();
for ($i = 1; $i <= G5_LINK_COUNT; $i++) {
    array_push($write_links, array('head' => '링 크#' . $i,
        'head_for' => 'wr_link' . $i,
        'content' => '<input type="text" class="itxt ilink" name="wr_link' . $i . '" id="wr_link' . $i . '" itemname="링크 #' . $i . '" value="' . $write["wr_link{$i}"] . '">',
        'condition' => 'is_link',
        'order' => (89 + $i))
    );
}

$write_items = array(array('head' => '옵 션',
        'content' => $option . $option_hidden,
        'content_class' => 'slw_opts',
        'condition' => 'option',
        'order' => 10),
    array('head' => '이 름',
        'head_for' => 'wr_name',
        'content' => '<input maxlength=20 class="itxt iname" name="wr_name" id="wr_name" itemname="이름" required value="' . $name . '">',
        'condition' => 'is_name',
        'order' => 20),
    array('head' => '패스워드',
        'head_for' => 'wr_password',
        'content' => '<input type="password" class="itxt ipasswd" maxlength="20" size="15" name="wr_password" id="wr_password" itemname="패스워드" ' . $password_required . '>',
        'condition' => 'is_password',
        'order' => 30),
    array('head' => '이메일',
        'head_for' => 'wr_email',
        'content' => '<input maxlength="100"  class="itxt iemail" name="wr_email" id="wr_email" email itemname="이메일" value="' . $email . '">',
        'condition' => 'is_email',
        'order' => 40),
    array('head' => '홈페이지',
        'head_for' => 'wr_homepage',
        'content' => '<input size=50 name="wr_homepage" id="wr_homepage" class="itxt ihomepage" itemname="홈페이지" value="' . $homepage . '">',
        'condition' => 'is_homepage',
        'order' => 50),
    array('head' => '분 류',
        'head_for' => 'ca_name',
        'content' => '<select name="ca_name" id="ca_name" required class="iselect icategory" itemname="분류"><option value="">선택하세요' . $category_option . '</select>',
        'condition' => 'is_category',
        'order' => 60),
    array('head' => '제 목',
        'head_for' => 'wr_subject',
        'content' => '<input name="wr_subject" class="itxt isubject" id="wr_subject" itemname="제목" required value="' . $subject . '">',
        'order' => 70),
    array('head' => '내 용',
        'head_for' => 'wr_content',
        'content' => $sl_write_content,
        'order' => 80),
    array('head' => '파일첨부',
        'content_class' => 'slw_file',
        'content' => $sl_write_files,
        'condition' => 'is_file',
        'order' => 100),
    array('head' => '트랙백주소',
        'head_for' => 'wr_trackback',
        'content' => '<input size=50 name="wr_trackback" id="wr_trackback" class="itxt itrackback" itemname="트랙백" value="' . $trackback . '">' . ($w == 'u' ? '<input type="checkbox" class="chkbox" name="re_trackback" value="1">핑 보냄' : ''),
        'condition' => 'is_trackback',
        'order' => 110),
    array('head' => '보안 이미지',
        'head_for' => 'wr_key',
        'content' => $captcha_html,
        'condition' => 'is_guest',
        'order' => 120)
);
$write_items = array_merge($write_items, $write_links);
$write_items = gp_do_filter('sl_write_items', $write_items);
$write_items = gp_subval_asort($write_items, 'order');

$write_menu1 = array(array('href_attr' => 'id="btn_list" class="sl_btn sl_btn_list"', 'href' => 'board.php?bo_table=' . $bo_table, 'text' => '목록', 'order' => 10));
$write_menu1 = gp_do_filter('sl_write_menu1', $write_menu1);
$write_menu1 = gp_subval_asort($write_menu1, 'order');

$write_menu2 = array(array('text' => '<input type="submit" id="btn_submit" class="sl_btn emp sl_btn_write" accesskey="s" value="글쓰기">', 'order' => 10));
$write_menu2 = gp_do_filter('sl_write_menu2', $write_menu2);
$write_menu2 = gp_subval_asort($write_menu2, 'order');
?>

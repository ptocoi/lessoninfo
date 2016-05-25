<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

unset($no_comment);
?>

<? gp_do_action('sl_before_comment'); ?>

<? if($no_comment) return; ?>

<script type="text/javascript">
// 글자수 제한
var char_min = parseInt(<?=$comment_min?>); // 최소
var char_max = parseInt(<?=$comment_max?>); // 최대
</script>

<!-- 코멘트 리스트 -->
<div id="commentContents">
<?
$cnt_count = count($list);
if($cnt_count) {
?>
<h2>댓글 보기</h2>
<?
}
$no_photo = $board_skin_url."/img/no_photo.gif";
$cmt_mb_photos = array();
$list = gp_do_filter('sl_comment_list', $list);
for ($i=0; $i<$cnt_count; $i++) {	
	$list[$i] = gp_do_filter('sl_comment_list_item', $list[$i]);
    $comment_id = $list[$i]['wr_id'];	
	$reply_depth = strlen($list[$i]['wr_comment_reply']);
	
	$cmt_mb_id = $list[$i]['mb_id'];
	if($cmt_mb_photos[$cmt_mb_id]) $cmt_mb_photo_url = $cmt_mb_photos[$cmt_mb_id];
	else if($cmt_mb_id) {
		$mb_dir = substr($cmt_mb_id,0,2);
		$cmt_mb_photo = G5_DATA_PATH."/member_image/".$mb_dir."/".$cmt_mb_id;
		$cmt_mb_photo_url = G5_DATA_URL."/member_image/".$mb_dir."/".$cmt_mb_id;
		if(!file_exists($cmt_mb_photo)) $cmt_mb_photo_url = $no_photo;
		$cmt_mb_photos[$cmt_mb_id] = $cmt_mb_photo_url;
	} else $cmt_mb_photo_url = $no_photo;
?>
	<a name="c_<?=$comment_id?>"></a>	
	<div class="slvc slvc_<?=$reply_depth?>" >
		<img class="slvc_reply" src="<?=$board_skin_url?>/img/reply.png" />
		<div class="slvc_profile">
			<? 
				if($cmt_mb_id && $cmt_mb_id == $member['mb_id']) echo '<a href="javascript:member_photo();">';
				else echo '<a href="javascript:;">';
			?>
				<img src="<?=$cmt_mb_photo_url?>" style="width:58px;height:58px" border="0"/></a>
		</div>
		<div class="slvc_head">
			<span class="name"><?=$list[$i]['name']?></span>
			<span class="date"><?=$list[$i]['datetime']?></span>
			<? if ($is_ip_view) { echo "&nbsp;<span class=\"ip\">{$list[$i]['ip']}</span>"; } ?>
		</div>
		<p class="slvc_content">
			<!-- 코멘트 출력 -->
			<?
			if (strstr($list[$i]['wr_option'], "secret")) echo "<span style=\"color:#ff6600;\">*</span> ";
			$str = $list[$i]['content'];
			if (strstr($list[$i]['wr_option'], "secret"))
				$str = "<span class=\"small\" style=\"color:#ff6600;\">$str</span>";

			$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
			// FLASH XSS 공격에 의해 주석 처리 - 110406
			//$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
			$str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src=\"$1://$2.$3\" id=\"target_resize_image[]\" onclick=\"image_window(this);\" border=\"0\">", $str);
			echo $str;
			?>
		</p>

		<? if ($list[$i]['trackback']) { echo "<p>".$list[$i]['trackback']."</p>"; } ?>
		<span id="edit_<?=$comment_id?>" style="display:none;"></span><!-- 수정 -->
		<span id="reply_<?=$comment_id?>" style="display:none;"></span><!-- 답변 -->

		<input type="hidden" id="secret_comment_<?=$comment_id?>" value="<?=strstr($list[$i]['wr_option'],"secret")?>">
		<textarea id="save_comment_<?=$comment_id?>" style="display:none;"><?=get_text($list[$i]['content1'], 0)?></textarea>

		<div class="slvc_menu">
			<?=gp_do_action('sl_comment_before_menu')?>
			<? if ($list[$i]['is_reply']) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\">답변</a> "; } ?>
			<? if ($list[$i]['is_edit']) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\">수정</a> "; } ?>
			<? if ($list[$i]['is_del'])  { echo "<a href=\"javascript:comment_delete('{$list[$i]['del_link']}');\">삭제</a> "; } ?>
			<?=gp_do_action('sl_comment_after_menu')?>
		</div>

	</div>
<? 
}
?>
</div>

<? if ($is_comment_write) { ?>

<!-- 코멘트 입력 -->
<div id="comment_write" style="display:none;">

	<div class="slvc_write">
		<form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
		<input type="hidden" name="w"           id="w" value="c">
		<input type="hidden" name="bo_table"    value="<?=$bo_table?>">
		<input type="hidden" name="wr_id"       value="<?=$wr_id?>">
		<input type="hidden" name="comment_id"  id="comment_id" value="">
		<input type="hidden" name="sca"         value="<?=$sca?>" >
		<input type="hidden" name="sfl"         value="<?=$sfl?>" >
		<input type="hidden" name="stx"         value="<?=$stx?>">
		<input type="hidden" name="spt"         value="<?=$spt?>">
		<input type="hidden" name="page"        value="<?=$page?>">
		<input type="hidden" name="cwin"        value="<?=$cwin?>">
		<input type="hidden" name="is_good"     value="">

		<div class="slvc_campaign">
			<? if(!$is_guest) { ?>
			<span class="slvc_slogan">
			<strong>댓글 이야기!</strong> 댓글은 자신을 나타내는 '얼굴'입니다. *^^* 
			</span>
			<? } else { ?>
			<div class="slvc_guest_info">
					<?=gp_do_action('sl_comment_write_before_name')?>
					<label for="wr_name">이름</label><input type="text" maxLength=20 size=10 name="wr_name" id="wr_name" itemname="이름" required />
					<label for="wr_password">패스워드</label><input type="password" maxLength=20 size=10 name="wr_password" id="wr_password" itemname="패스워드" required />
					<?=gp_do_action('sl_comment_write_after_password')?>
			</div>
			<? } ?>
			<div class="slvc_opt">
				<input type="checkbox" id="wr_secret" name="wr_secret" value="secret">
				<label for="wr_secret">비밀글</label>
				<?=gp_do_action('sl_comment_write_after_secret')?>
        <?php if ($comment_min || $comment_max ) { ?><span id="char_cnt"> | <span id="char_count"></span>글자</span><?php } ?>
			</div>
		</div>

		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<colgroups><col/><col width="110px"/></colgroups>
		<tr><td>
        <textarea id="wr_content" name="wr_content" maxlength="10000" required class="required" style="width:98%; word-break:break-all" rows="8" title="내용"
        <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content;  ?></textarea>
        <?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
        <script>
        $("textarea#wr_content[maxlength]").live("keyup change", function() {  
            var str = $(this).val()  
            var mx = parseInt($(this).attr("maxlength"))  
            if (str.length > mx) {  
                $(this).val(str.substr(0, mx));
                return false;  
            }  
        });
        </script>
		</td><td class="slvc_write_btn">
			<input type="submit" id="btn_submit"  accesskey="s" tabindex="2" value="댓글입력"></input>
		</td></tr>
		</table>
		
		<?=gp_do_action('sl_comment_before_kcapt')?>

		<? if($is_guest) { ?>
		<div class="slvc_kcapt">
        <?php echo $captcha_html; ?>
		</div>
		<? } ?>

		<?=gp_do_action('sl_comment_after_kcapt')?>

		</form>
	</div> <!--// #slvc_write -->
</div>

<script type="text/javascript">
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?=$board_skin_url?>/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("댓글을 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('패스워드가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    <?php if($is_guest) echo chk_captcha_js();  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}


function comment_box(comment_id, work)
{
    var el_id;
    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 코멘트 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        save_before = el_id;
    }
}

function comment_delete(url)
{
    if (confirm("이 코멘트를 삭제하시겠습니까?")) location.href = url;
}

comment_box('', 'c'); // 코멘트 입력폼이 보이도록 처리하기위해서 추가 (root님)
</script>

<?
}
?>

<? gp_do_action('sl_after_comment'); ?>

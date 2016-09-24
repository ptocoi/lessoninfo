<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div class="comTalk positionR">
	<div class="jobContentWrap clearfix positionR">

		<?php if ($is_comment_write) { ?>
		<div id="comment_write" style="display:none;">
		<form name="fviewcomment" method="post" action="./process/regist.php">
		<input type='hidden' name='mode' id='mode' value='comment'>
		<input type='hidden' name='board_code' value='<?=$board_code?>'>
		<input type='hidden' name='code' value='<?=$code?>'>
		<input type='hidden' name='bo_table' value='<?=$bo_table?>'>
		<input type='hidden' name='wr_no' value='<?=$wr_no?>'>
		<input type='hidden' name='comment_id' id='comment_id' value=''>
		<input type='hidden' name='sca' value='<?=$sca?>' >
		<input type='hidden' name='stx' value='<?=$stx?>'>
		<!-- <input type='hidden' name='sfl' value='<?=$sfl?>' >
		<input type='hidden' name='spt' value='<?=$spt?>'> -->
		<input type='hidden' name='page' value='<?=$page?>'>
		<input type='hidden' name='cwin' value='<?=$cwin?>'>
		<input type='hidden' name='is_good' value=''>
		<?php if($is_member){ ?>
		<input type='hidden' name='wr_name' value='<?php echo $member['mb_nick'];?>'>
		<input type='hidden' name='wr_password' value='<?php echo $member['mb_password'];?>'>
		<?php } ?>

		<ul class="comTalkcomment clearfix">
			<li>
			<ul class="comment1 clearfix">
				<li class="textBox"><textarea name="wr_content" id="wr_content" style="height:32px; padding:10px;" hname="내용" required></textarea></li>
				<li class="pl10"><a onclick="fviewcomment_submit();" class="text_blue bg_blue2 border_blue write" style="cursor:pointer;">글쓰기</a></li>
			</ul>
			</li>
			<?php if($is_guest){?>
			<li class="pt5">
				<ul class="comment2 clearfix">
					<li class="pr5"><label class="ml30">이름</label> <input type="text" name="wr_name" id="wr_name" style="width:110px;"></li>
					<li class="pr5"><label>비밀번호</label> <input type="text" name="wr_password" id="wr_password" style="width:110px;"></li>
					<!-- <li class="pr5"><a class="login text_blue bg_blue2 border_blue tc" href="">로그인</a></li> 
					<em>* 로그인 하셔야 작성하실 수 있습니다.</em> -->
				</ul>
			</li>
			<?php } ?>
		</ul>

		</form>
		</div>
		<?php } ?>

		<ul style="border-top:1px solid #000;" class="mt30 comTalkList clearfix">
		<?php
			for($i=0;$i<$list_cnt;$i++){
			$comment_id = $list[$i]['wr_no'];
			// FLASH XSS 공격에 의해 주석 처리
			$wr_content = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $list[$i]['content']);
			$wr_content = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $wr_content);
			if($list[$i]['wr_del']){
				$wr_content = "<span style='color:dfdfdf;'>* 삭제된 댓글 입니다.</span>";
			}
			$comment_reply = strlen($list[$i]['wr_comment_reply']);
			
		?>
			<li class="comment">  
				
				<div <?php if($comment_reply){ ?>style="display:block;" class="reply pt5 pb5 pl50 pr10"<?php } else { ?>class="positionR"<?php } ?>>
					<a name="c_<?php echo $comment_id;?>"></a>

					<dl class="pt10 pl10 pr10 pb5 clearfix">
						<dd><?php echo nl2br(stripslashes($wr_content));?></dd>
						<dt class="mt10 pb5">
							<strong><?php echo $list[$i]['name'];?><!-- (<?php echo $list[$i]['wr_id'];?>) --></strong>
							<em class="time"><img width="12" height="12" alt="time" src="../images/icon/ico_time1.gif" class="vm mr5"><?php echo $list[$i]['datetime'];?></em>
							<?/*php if(!$comment_reply){ ?>
							<em class="replyBtn"><img width="11" height="9" alt="댓글" src="../images/icon/icon_reply1.gif" class="vm bg_color4 mr3">(<?php echo $list[$i]['wr_comment'];?>)</em>
							<?php } */?>
							<?php if($is_member || $is_admin){ ?>
								<?php if(!$comment_reply){?>
								<em class="delete"><a href="javascript:comment_box('<?php echo $comment_id;?>', 'comment');"><img width="12" height="12" class="vm mr3" src="../images/icon/icon_close5.gif" alt="댓글달기">댓글달기</a></em>
								<?php } ?>
								<?php if($list[$i]['is_del']){ ?>
									<em class="delete"><a href="javascript:comment_box('<?php echo $comment_id;?>', 'comment_update');"><img width="12" height="12" class="vm mr3" src="../images/icon/icon_close5.gif" alt="수정">수정</a></em>
								<?php } ?>
								<?php if($list[$i]['is_del']){ ?>
									<em class="delete"><a href="javascript:comment_delete('<?php echo $list[$i]['wr_no'];?>');"><img width="12" height="12" class="vm mr3" src="../images/icon/icon_close5.gif" alt="삭제">삭제</a></em>
								<?php } ?>
							<?php } ?>
						</dt>
						<span class="reply" id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
						<span class="reply" id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
					</dl>

					<textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?php echo $utility->get_text($list[$i]['wr_content'], 0)?></textarea>
				</div>

			</li>
		<?php } // for end. ?>
		</ul>

	</div>
</div>

<?php if ($is_comment_write) { ?>
<script>
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;

var fviewcomment_submit = function(){
	
	var f = document.fviewcomment;

	var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

	f.is_good.value = 0;

	var subject = "";
	var content = "";
	$.ajax({
        url: "./skins/<?php echo $board['bo_skin']?>/ajax.filter.php",
        type: "POST",
        data: {
			"bo_table" : "<?php echo $bo_table;?>",
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
	/*
	if (char_min > 0 || char_max > 0) {
		check_byte('wr_content', 'char_count');
		var cnt = parseInt(document.getElementById('char_count').innerHTML);
		if (char_min > 0 && char_min > cnt) {
			alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
			return false;
		} else if (char_max > 0 && char_max < cnt) {
			alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
			return false;
		}
	} else if (!document.getElementById('wr_content').value) {
		alert("코멘트를 입력하여 주십시오.");
		return false;
	}
	*/
	if (!document.getElementById('wr_content').value) {
		alert("코멘트를 입력하여 주십시오.");
		return false;
	}
	var wr_names = trim(f.wr_name.value);
	if(wr_names=='' || !wr_names){
		alert("<?php echo $board_control->_errors('0038');?>");	// 이름은 필히 입력하셔야 합니다.
		f.wr_name.focus();
		return false;
	}

	var wr_passwords = trim(f.wr_password.value);
	if(wr_passwords=='' || !wr_passwords){
		alert("<?php echo $board_control->_errors('0053');?>");	// 비밀번호(패스워드)를 입력해 주세요.
		f.wr_password.focus();
		return false;
	}

	f.submit();

}
var comment_box = function( comment_id, work ){

    var el_id;

    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id) {
        if (work == 'comment')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    } else
        el_id = 'comment_write';


    if (save_before != el_id) {
		
        if (save_before) {
			$('#'+save_before).hide();
			$('#'+save_before).html("");
        }

		$('#'+el_id).show();
		$('#'+el_id).html(save_html);

		// 코멘트 수정
        if (work == 'comment_update') {
			var save_comment = $('#save_comment_'+comment_id).val();
			$('#wr_content').val(save_comment);
        }
		$('#comment_id').val(comment_id);
		$('#mode').val(work);

        save_before = el_id;

    }

}

comment_box('', 'comment');

var comment_delete = function( wr_no ){
	if(confirm("댓글을 삭제하시겠습니까?")){
		$.post('./process/delete_comment.php', { ajax:'true', bo_table:"<?php echo $bo_table;?>", comment_id:wr_no, token:"<?php echo $token;?>", cwin:"<?php echo $cwin;?>", page:"<?php echo $page;?>" }, function(result){
			
			if(result){
				alert(result);
			} else {
				location.reload();
			}

		});
	}
}
</script>
<?php } ?>
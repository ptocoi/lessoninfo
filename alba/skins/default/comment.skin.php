<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div class="mt30 comTalk positionR">
	<div class="jobContentWrap clearfix positionR mt10">

		<?php if($is_comment_write){?>
		<div id="comment_write" style="display:none;">
		<form name="commentFrm" method="post" action="./process/comment.php" id="commentFrm">
		<input type="hidden" name="mode" value="insert" id="mode"/>
		<input type="hidden" name="no" value="<?php echo $no;?>"/>
		<input type="hidden" name="wr_no" value="<?php echo $wr_no;?>"/>
		<input type="hidden" name="comment_id" id="comment_id" value="">
		<input type="hidden" name="wr_category" value="alba"/>
		<input type="hidden" name="page" value="<?php echo $page;?>"/>
		<input type="hidden" name="cwin" value="<?php echo $cwin;?>"/>
		<input type="hidden" name="wr_name" value="<?php echo $wr_name;?>"/>
		<input type="hidden" name="wr_id" value="<?php echo $wr_id;?>"/>
		<input type="hidden" name="wr_password" value="<?php echo $wr_password;?>"/>
		<input type="hidden" name="wr_email" value="<?php echo $wr_email;?>"/>
		<input type="hidden" name="wr_homepage" value="<?php echo $wr_homepage;?>"/>
		<?php if($is_admin){ ?>
		<!-- <input type="hidden" name="wr_is_admin" value="<?php echo $is_admin;?>"/> -->
		<?php } ?>

			<ul class="comTalkcomment clearfix mt10">
				<li>
					<ul class="comment1 clearfix">
						<li class="textBox">
						<textarea name="wr_content" class="" id="wr_content" style=" height:32px; padding:10px;"></textarea></li>
						<li class="pl10"><a class="text_color1 bg_color2 border_color1 write" href="javascript:commentFrmSubmit();">글쓰기</a></li>
					</ul>
				</li>
			</ul>

		</form>
		</div>
		<?php } ?>

		<ul class="mt30 comTalkList clearfix">
			<?php 
				for($i=0;$i<$total_count;$i++){
					$comment_id = $list[$i]['wr_no'];
					// FLASH XSS 공격에 의해 주석 처리
					$wr_content = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $list[$i]['wr_content']);
					$wr_content = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $wr_content);

					if($list[$i]['wr_del']){
						$wr_content = "<span style='color:dfdfdf;'>* 삭제된 댓글 입니다.</span>";
					}

					$wr_date = strtr(substr($list[$i]['wr_datetime'],2,14),'-','.');

					$wr_comment_reply = $list[$i]['wr_comment_reply'];
			?>
			<li class="comment">  

				<?php if($list[$i]['wr_comment_reply']){ // 댓글에 댓글 ?>
				
				<div style="display:block;" class="reply pt5 pb5 pl50 pr10 ">
					<a name="c_<?php echo $comment_id;?>"></a>
					<dl class="clearfix">
						<dd><?php echo nl2br(stripslashes($wr_content));?></dd>
						<dt class="mt5 pb5">
							<strong><?php echo $list[$i]['wr_name'];?>(<?php echo $list[$i]['wr_id'];?>)</strong>
							<em class="time"><img width="12" height="12" alt="time" src="../images/icon/ico_time1.gif" class="vm mr5"><?php echo $wr_date;?></em>
							<?php if($is_member || $is_admin){ ?>
							<?php if($list[$i]['wr_id'] == $member['mb_id'] && !$list[$i]['wr_del']){ ?>
								<em class="delete"><a href="javascript:comment_box('<?php echo $comment_id;?>', 'update');"><img width="12" height="12" class="vm mr3" src="../images/icon/icon_close5.gif" alt="수정">수정</a></em>
							<?php } ?>
							<?php if($list[$i]['wr_id'] == $member['mb_id'] && !$list[$i]['wr_del']){ ?>
								<em class="delete"><a href="javascript:comment_delete('<?php echo $list[$i]['wr_no'];?>');"><img width="12" height="12" class="vm mr3" src="../images/icon/icon_close5.gif" alt="삭제">삭제</a></em>
							<?php } ?>
							<?php } ?>
						</dt>  
						<span class="reply" id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
					</dl>
					<textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?php echo $utility->get_text($list[$i]['wr_content'], 0)?></textarea>
				</div>

				<?php } else {  ?>

				<div class="positionR">
					<a name="c_<?php echo $comment_id;?>"></a>
					<dl class="pt10 pl10 pr10 pb5 clearfix">
						<dd><?php echo nl2br(stripslashes($wr_content));?></dd>
						<dt class="mt10 pb5">
							<strong><?php echo $list[$i]['wr_name'];?>(<?php echo $list[$i]['wr_id'];?>)</strong>
							<em class="time"><img width="12" height="12" alt="time" src="../images/icon/ico_time1.gif" class="vm mr5"><?php echo $wr_date;?></em>
							<!-- <em class="replyBtn"><a href=""><img width="11" height="9" alt="댓글" src="../images/icon/icon_reply1.gif" class="vm bg_color4 mr3">(2)</a></em> -->
							<?php if($is_member || $is_admin){ ?>
								<em class="delete"><a href="javascript:comment_box('<?php echo $comment_id;?>', 'insert');"><!-- <img width="12" height="12" class="vm mr3" src="../images/icon/icon_close5.gif" alt="댓글달기"> -->댓글달기</a></em>
								<?php if($list[$i]['wr_id'] == $member['mb_id'] && !$list[$i]['wr_del']){ ?>
									<em class="delete"><a href="javascript:comment_box('<?php echo $comment_id;?>', 'update');"><!-- <img width="12" height="12" class="vm mr3" src="../images/icon/icon_close5.gif" alt="수정"> -->수정</a></em>
								<?php } ?>
								<?php if($list[$i]['wr_id'] == $member['mb_id'] && !$list[$i]['wr_del']){ ?>
									<em class="delete"><a href="javascript:comment_delete('<?php echo $list[$i]['wr_no'];?>');"><!-- <img width="12" height="12" class="vm mr3" src="../images/icon/icon_close5.gif" alt="삭제"> -->삭제</a></em>
								<?php } ?>
							<?php } ?>
						</dt>
						<span class="reply"  id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
						<span class="reply"  id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
					</dl>
					<textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?php echo $utility->get_text($list[$i]['wr_content'], 0)?></textarea>
				</div>

				<?php } ?>

			</li>
			<?php 
				}	// for end.
			?>
		</ul>

	</div>
</div>
<?php include_once $alice['include_path']."/paging.php";?>

<?php if($is_comment_write){ ?>
<script>
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;

var commentFrmSubmit = function(){
	var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
	
	var subject = "";
	var content = $('#wr_content').val().replace(pattern,"");

	$('#wr_content').val(content);

	if (!$('#wr_content').val() || $('#wr_content').val() == "") {
		alert("<?php echo $comment_control->_errors('0000');?>");
		$('#wr_content').focus();
		return ;
	}

	// ajax submit 사용시
	//var comment_options = { target : '', beforeSubmit : commentRequest, success : commentResponse }
	//$('#commentFrm').ajaxSubmit(comment_options);
	$('#commentFrm').submit();

}
var comment_box = function( comment_id, work ){

    var el_id;

    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id) {
        if (work == 'insert')
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
        if (work == 'update') {
			var save_comment = $('#save_comment_'+comment_id).val();
			$('#wr_content').val(save_comment);
        }
		$('#comment_id').val(comment_id);
		$('#mode').val(work);

        save_before = el_id;

    }

}
comment_box('', 'insert');

var comment_delete = function( wr_no ){
	if(confirm("댓글을 삭제하시겠습니까?")){
		$.post('./process/comment.php', { mode:'delete', wr_no:wr_no }, function(result){
			if(result){
				location.reload();
			} else {
				alert("<?php echo $comment_control->_errors('0010');?>");
				return false;
			}
		});
	}
}
/*
var commentRequest = function(formData, jqForm, comment_options){
	var queryString = $.param(formData);
	return true;
}
var commentResponse = function(responseText, statusText, xhr, $form){
	location.reload();
}
*/

</script>
<?php } ?>
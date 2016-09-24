<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 

	$poll_content = explode('|&|',$print_polls['poll_content']);
	$poll_content_cnt = count($poll_content);
	$poll_cdate = date('Y-m-d');

	if($print_polls['poll_wdate'] <= $cur_date && $print_polls['poll_edate'] >= $cur_date){	// 설문조사 기간 확인

?>
<script>
var poll_no = "<?php echo $print_polls['no'];?>";
var poll_insert = function(){
	
	var poll_answer = $("input[name='poll_answer']:checked").val();
	
	$.post('../main/process/poll.php', { mode:'poll_insert', no:poll_no, answer:poll_answer }, function(result){

		$('#poll_quest_info').show();

		switch(result){
			case '0085':	// 회원만 투표 가능합니다.
				$('#poll_confirm_msg').html("<?php echo $poll_control->_errors('0008');?><br/><br/>로그인 하시겠습니까?");
				$('#poll_questionAnswerYes').html('<input type="button" onClick="poll_questionAnswer(\'yes\', \'member_login\');" value="예" />');
				// 질의(Confirm) 창 띄우기
				$.blockUI({
					theme: true,
					title: "<p align='left'><?php echo $poll_control->_errors('0008');?></p>",
					showOverlay: false,
					message: $('#question')
				});
				return false;
			break;
			case '0086':	// 이미 투표하셨습니다.
				alert("<?php echo $poll_control->_errors('0009');?>");
				return false;
			break;
			default:
				$('#poll_confirm_msg').html("<?php echo $poll_control->_success('0008');?><br/><br/>결과를 확인하시겠습니까?");
				$('#poll_questionAnswerYes').html('<input type="button" onClick="poll_questionAnswer(\'yes\', \'poll_view\', \''+poll_no+'\');" value="예" />');
				// 질의(Confirm) 창 띄우기
				$.blockUI({
					theme: true,
					title: "<p align='left'>투표결과 확인</p>",
					showOverlay: false,
					message: $('#poll_question')
				});
				return false;
			break;
		}
	});
}
var poll_view = function(no){	// 설문조사 보기

	$('#poll_info').load('../main/views/_load/poll.php', { no:no }, function(result){
		$('#poll_info').show();
		$('#poll_info').draggable({ handle: "#pollFrmHandle" });
		//$('#poll_info').center();
		//$('html, body').animate({scrollTop:0}, 800); // 페이지 상단으로 이동

		// ajax paging
		$('.paging a').click(function(){
			var page_no = $(this).attr('page_no'), p_no = $(this).attr('p_no');
			$('.paging a').removeClass('col');
			$(this).addClass('col');

			$('#pollComment_list').load('../main/views/_load/poll_comment.php', { page_no:page_no, p_no:p_no }, function(result){	// 페이징 내용 추출
			});
		});
	});

}
var poll_questionAnswer = function(answer, mode, no, sels){	 // 질의 응답에 따른 처리

	if(answer=='yes'){

		switch(mode){
			// 비회원일때 로그인 페이지로 이동
			case 'member_login':
				location.href = "<?php echo $alice['member_path'];?>/login.php?url=<?php echo $self_page;?>";
			break;
			// 투표 결과 확인
			case 'poll_view':
				$.unblockUI();
				$('#poll_info').load('../main/views/_load/poll.php', { no:no }, function(result){
					$('#poll_info').show();
					$('#poll_info').draggable({ handle: "#pollListHandle" });
					//$('#poll_info').center();
					//$('html, body').animate({scrollTop:0}, 800); // 페이지 상단으로 이동

					// ajax paging
					$('.paging a').click(function(){
						var page_no = $(this).attr('page_no'), p_no = $(this).attr('p_no');
						$('.paging a').removeClass('col');
						$(this).addClass('col');

						$('#pollComment_list').load('../main/views/_load/poll_comment.php', { page_no:page_no, p_no:p_no }, function(result){	// 페이징 내용 추출
						});
					});
				});
			break;
			// 설문조사 코멘트 삭제 (단수)
			case 'poll_deleteComment':
				$.post('../main/process/poll.php', { mode:mode, no:no, page:sels }, function(result){
					var results = result.split('/');
					var pin_result = results[1];
					var p_no = results[2];
					var page = results[3];

					if(pin_result){
						$('#pollComment_list').load('../main/views/_load/poll_comment.php', { page_no:page, p_no:p_no }, function(result){	// 페이징 내용 추출
							$.unblockUI();
						});
					} else {
						alert("<?php echo $config->_errors('0014');?>");
						return false;
					}
				});
			break;
		}

	} else {
		$.unblockUI();
	}
}
var poll_close = function(){
	$('#poll_info').hide();
}
</script>

<div id="poll_question" style="display:none; cursor: default;">
	<div id='poll_quest_info' style='float:left;'></div>
	<p align='center' id='poll_confirm_msg'></p><br/>
	<p align='center'>
		<span id='poll_questionAnswerYes'><input type="button" onClick="poll_questionAnswer('yes');" value="예" /> </span>
		<input type="button" onClick="poll_questionAnswer('no');" value="아니오" />
	</p>
</div> 

<div  class="positionF content_wrap clearfix" style="display:none;left:50%; top:50%; margin-left:-247px; margin-top:-200px; z-index:10000" id="poll_info">
</div>

<div class="survey">
	<h2 class="positionR">
		<img class="pl10 pt5"  alt="설문조사" src="../images/tit/main_tit_03.gif">
		<em class="positionA" style="top:5px;right:5px;"><span class="pr5"><a href="javascript:poll_insert();"><img alt="투표하기" src="../images/icon/icon_survey01.gif"></a></span><span><a href="javascript:poll_view('<?php echo $print_polls['no'];?>');"><img class=""  alt="결과보기" src="../images/icon/icon_survey02.gif"></a></span></em>
	</h2>
	<dl class="clearfix">
		<dt class=""><strong>Q.</strong><?php echo stripslashes($print_polls['poll_subject']);?></dt>
		<dd style="padding:10px;">
			<?php for($i=0;$i<$poll_content_cnt;$i++){ ?>
			<div><label><input name="poll_answer" type="radio" value="<?php echo $i;?>" class="chk" <?php echo ($i==0)?'checked':'';?>><?php echo stripslashes($poll_content[$i]);?></label></div>
			<?php } ?>
		</dd>
	</dl>
</div>

<?php } // if end. ?>
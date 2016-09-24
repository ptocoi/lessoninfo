<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
$(function(){
	var form_options = { beforeSubmit: showRequest, success : showResponse };
	$('#memoSendFrm').ajaxForm(form_options);
});
</script>
<div class="note" style="width:700px;"><img src="/images/icon/note_tlt_1.png"></div>
<TABLE height="364" cellSpacing="0" cellPadding="0" width="700">
<TBODY>
	<TR>
		<TD vAlign="top" align="left">
			<TABLE cellSpacing=0 cellPadding=0 width="100%">
			<TBODY>
			<TR>
				<TD height="25" width="190"></TD>
				<TD height="25"></TD>
			</TR>
			<TR>
				<TD height="327" vAlign="top" width="190" align="center">
				<?php include_once "./views/_include/menu.php"; ?>
				</TD>
				<TD style="PADDING-TOP: 3px; PADDING-LEFT: 10px" class="sandBOX" height="327" vAlign="top" align="left">
				
				<form method="post" name="memoSendFrm" id="memoSendFrm" action="./process/regist.php" onsubmit="return validate(this);">
				<input type="hidden" name="mode" value="<?php echo $mode;?>" id="mode"/>
				<input type="hidden" name="type" value="<?php echo $type;?>" id="type"/>
				<input type="hidden" name="wr_recv_mb_id" value="<?php echo $recv_mb_id;?>" id="wr_recv_mb_id"/>
				<input type="hidden" name="wr_send_mb_id" value="<?php echo $member['mb_id'];?>" id="wr_send_mb_id"/>
				<input type="hidden" name="wr_employ_no" value="<?php echo $employ_no;?>" id="wr_employ_no"/>
				<input type="hidden" name="wr_resume_no" value="<?php echo $resume_no;?>" id="wr_resume_no"/>

					<TABLE class="mt10 font12 " width="480px" style="border-collapse:collapse;">
					<TBODY>
					<tr>
						<td width="100" align="left"><img src="/images/icon/note_tlt_6.gif" class="pr5"><b>쪽지<?php echo ($mode=='reply')?'답장하기':'보내기';?></b></td>
						<td width="380" style="padding-left:5px;"><img src="/images/icon/sandline.gif"></td>
					</tr>
					<TR>
						<TD width="88" align="left" class="SNDformR SNDform tc pt5"><FONT color="#0b72cc"><b><?php echo $send_title;?></b></FONT> </TD>
						<TD style="PADDING-LEFT: 5px" class="SNDformR" width="382"><?php echo $send_subject;?></TD>
					</TR>
					<?php if($mode=='reply' && $reply_no){ ?>
					<tr>
						<TD colSpan="2" align="left" class="pt5" >
							<div style="padding:10px; width:447;  height:165;overflow-y:scroll; border: 1px solid rgb(221, 221, 221);" class="jobContentBox clearfix positionR">
								<?php echo nl2br(stripslashes($reply['wr_memo']));?>
							</div>
						</td>
					</tr>
					<?php } ?>
					<TR>
						<TD colSpan="2" align="left" class="pt5" ><textarea name="wr_memo" class="txt" id="wr_memo" style="border: 1px solid rgb(221, 221, 221); border-image: none; width:100%; height: 220px; -ms-ime-mode: active;" required hname="내용"></textarea></TD>
					</TR>
					<TR>
						<TD height="40" colSpan="2" class="pt10 pb10" align="center"><INPUT src="/images/icon/send_btn.png" type="image" align="absMiddle" border="0"></TD>
					</TR>
					</TBODY>
					</TABLE>

				</form>

				</TD>
			</TR>
			</TBODY>
			</TABLE>
		</TD>
	</TR>
</TBODY>
</TABLE>

<script>
var showRequest = function(formData, jqForm, form_options){
	var memoSendFrm = document.getElementById('memoSendFrm');
	var queryString = $.param(formData);
	return validate(memoSendFrm);
}
var showResponse = function(responseText, statusText, xhr, $form){
	if(responseText=='0002') {	 // 성공
		alert("<?php echo $memo_control->_success('0002');?>");
		location.reload();
	} else if(responseText=='0003') {	// 실패
		alert("<?php echo $memo_control->_errors('0003');?>");
		return false;
	}
}
</script>

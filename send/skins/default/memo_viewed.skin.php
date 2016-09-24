<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<script>
var memo_delete = function( no ){
	if(confirm('쪽지를 삭제하시겠습니까?')){
		$.post('./process/regist.php', { mode:'delete', no:no }, function(result){
			if(result=='0003'){
				//alert("<?php echo $memo_control->_success('0003');?>");
				location.reload();
			} else {
				alert("<?php echo $memo_control->_errors('0004');?>");
			}
		});
	}
}
</script>
<div class="note" style="width: 700px;"><img src="/images/icon/note_tlt_1.png"></div>
<table width="700" height="364" cellspacing="0" cellpadding="0">
<tbody>
	<tr>
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
			<tbody>
			<tr>
				<td width="190" height="25"></td>
				<td height="25"></td></tr>
			<tr>
				<td width="190" height="327" align="center" valign="top">
					<?php include_once "./views/_include/menu.php"; ?>
				</td>
				<td height="327" align="left" class="sandBOX" valign="top" style="padding-top: 3px; padding-left: 10px;">
					<table width="480" class="mt10 font12" style="border-collapse: collapse;">
					<tbody>
					<tr>
						<td width="88" align="left"><img class="pr5" src="/images/icon/note_tlt_6.gif"><b>미열람목록</b></td>
						<td width="380" style="padding-left: 5px;"><img src="/images/icon/sandline.gif"></td>
					</tr>
					<tr>
					<td align="left" class="pt5" colspan="2">
						<table cellpadding="0" cellspacing="0" class="font12 SND2" width="99.5%">
						<colgroup><col width="77px;"><col width="229px;"><col width="121px;"><col width="50px;"></colgroup>
						<tr class="SNDform" style="text-align:center;">
							<td class="pt5">보낸사람</td>
							<td>내용</td>
							<td>보낸시간</td>
							<td>삭제</td>
						</tr>
						<?php 
						if($viewed_memo['total_count']){
							foreach($viewed_memo['result'] as $val){
							$get_member = $member_control->get_member($val['wr_send_mb_id']);
							$send_datetime = substr($val['wr_send_datetime'],2,14);
							$read_datetime = ( substr($val['wr_read_datetime'],0,1) == 0 ) ? "아직 읽지 않음" : substr($val['wr_read_datetime'],2,14);
						?>
						<tr>
							<td class="tc pt5"><?php echo $get_member['mb_name'];?></td>
							<td class="tl pl5">
								<div>
									<ul class="texli" style="list-style: none; padding-left: 0px;">
										<li><img class="pr5" src="/images/icon/note_tlt_7.gif"></li>
										<li style="width"><a href="./memo_read.php?no=<?php echo $val['no'];?>&kind=recv"><?php echo $utility->str_cut($val['wr_memo'],44);?></a></li>
									</ul>
								</div>
							</td>
							<td class="font11 tc"><?php echo $send_datetime;?></td>
							<td class="tc"><a onclick="memo_delete('<?php echo $val['no'];?>');" style="cursor:pointer;"><img src="/images/icon/note_tlt_8.gif"></a></td>
						</tr>
						<?php
							}	// foreach end.
						}	// if end.
						?>
						</table>
					</td>
					</tr>
					<?php include_once "./views/_include/paging.php"; ?>
					</tbody>
					</table>
				</td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>
</tbody>
</table>
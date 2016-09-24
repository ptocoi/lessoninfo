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
<body>
<div class="note" style="width: 700px;"><img src="/images/icon/note_tlt_1.png"></div>
<table width="700" height="364" cellspacing="0" cellpadding="0">
<tbody>
	<tr>
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
			<tbody>
			<tr>
				<td width="190" height="25"></td>
				<td height="25"></td>
			</tr>
			<tr>
				<td width="190" height="327" align="center" valign="top">
					<?php include_once "./views/_include/menu.php"; ?>
				</td>
				<td height="327" align="left" class="sandBOX" valign="top" style="padding-top: 3px; padding-left: 10px;">
					<table width="480" class="mt10 font12" style="border-collapse: collapse;">
					<tbody>
					<tr>
						<td width="88" align="left"><img class="pr5" src="/images/icon/note_tlt_6.gif"><b>쪽지 읽기</b></td>
						<td width="380" style="padding-left: 5px;"><img src="/images/icon/sandline.gif"></td>
					</tr>
					<tr>
					<td align="left" class="pt5" colspan="2">
						<table cellpadding="0" cellspacing="0" class="font12 SND2" width="99.5%">
						<colgroup><col width="78px;"><col width="167px;"><col width="78px;"></colgroup>
						<tr>
							<td class="SNDform pt5 tc"><font color="#0b72cc"><b>보낸사람</b></font></td>
							<td class="pl5"><?php echo $send_member['mb_name'];?></td>
							<td class="SNDform tc" ><font color="#0b72cc"><b>받은시간</b></font></td>
							<td class="pl5"><?php echo $data['wr_send_datetime'];?></td>
						</tr>
						<tr>
							<td width="467px;" class="pl5"colspan="4" >
								<div style="padding:10px; *width:445px;  height:260px;overflow-y:scroll; "class="jobContentBox clearfix positionR">
									<?php echo nl2br(stripslashes($data['wr_memo']));?>
								</div>
							</td>
						</tr>
						</table>
					</td>
					</tr>
					<?php if($kind!='send'){ ?>
					<tr>
						<td height="40" align="center" class="pt10" colspan="2"><a href="./index.php?mode=reply&no=<?php echo $no;?>&type=<?php echo $type;?>&reply_no=<?php echo $_GET['no'];?>"><img src="/images/icon/sendto_btn.png" border="0"></a></td>
					</tr>
					<?php } ?>
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
</body>
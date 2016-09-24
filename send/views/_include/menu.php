<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<TABLE cellSpacing="0" cellPadding="0" class="font12" width="163">
<TBODY>
<TR>
	<TD height="49" width="163" align="center" colspan="3"><B><FONT color="#0b72cc"><?php echo $member['mb_name'];?></FONT></B> 님 환영합니다<BR>즐거운 하루되세요</TD>
</TR>
<!-- <tr>
	<td width="163" height="49" align="center" class="msgBOX" colspan="3"><a href="<?php echo $alice['send_path'];?>/index.php"><img src="/images/icon/note_tlt_2.png"></a></td>
</tr> -->
<TR><TD height="15"></TD></TR>
<TR class="fontTR pb2">
	<TD width="30px;"><img src="/images/icon/note_tlt_3.png"></TD>
	<TD width="102px;" class="pt1"><a href="<?php echo $alice['send_path'];?>/memo_from.php">받은쪽지함</a></TD>
	<TD width="31px;" height="30" style="margin-bottom:10px;" align="right"><B><FONT color="#0b72cc" class="fontTaho pr5"><?php echo number_format($receive_memo['total_count']);?></FONT></B></TD>
</TR>
<TR><TD height="3"></TD></TR>
<tr class="fontTR pb2">
	<td width="30"><img src="/images/icon/note_tlt_4.png"></td>
	<td width="102" class="pt1"><a href="<?php echo $alice['send_path'];?>/memo_viewed.php">미확인 쪽지함</a></td>
	<td width="31" height="30" align="right" style="margin-bottom: 10px;"><b><font class="fontTaho pr5" color="#0b72cc"><?php echo number_format($viewed_memo['total_count']);?></font></b></td>
</tr>
<TR><TD height="3"></TD></TR>
<tr class="fontTR pb2">
	<td width="30"><img src="/images/icon/note_tlt_5.png"></td>
	<td width="102" class="pt1"><a href="<?php echo $alice['send_path'];?>/memo_received.php">보낸쪽지함</a></td>
	<td width="31" height="30" align="right" style="margin-bottom: 10px;"><b><font class="fontTaho pr5" color="#0b72cc"><?php echo number_format($send_memo['total_count']);?></font></b></td>
</tr>
</TBODY>
</TABLE>
<TABLE cellSpacing="0" cellPadding="0" width="163">
<TBODY>
	<TR><TD height="17" width="163"></TD></TR>
	<TR><TD height="147" width="163" align="center"></TD></TR>
</TBODY>
</TABLE>

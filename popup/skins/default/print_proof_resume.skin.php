<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<body>

<script type="text/javascript" src="<?php echo $alice['popup_path'];?>/skins/default/print_proof_resume.skin.js"></script>

<form name="proofFrm" method="post" action="./process/proof.php" id="proofFrm">
<input type="hidden" name="mode" value="email" id="mode"/>
<input type="hidden" name="wr_id" value="<?php echo $member['mb_id'];?>" id="wr_id"/>
<input type="hidden" name="wr_no" value="<?php echo $_GET['apply_no'];?>" id="wr_no"/><!-- 지원 내용 -->
<input type="hidden" name="wr_proof_no" value="<?php echo $proof_last_no;?>"/>
</form>
<section id="print" class="content_wrap clearfix">
	<div  class="print" id="rightContent"> 
		<div class="listWrap positionR mt20">
			<div class="readBtn clearfix">
				<ul class="clearfix" style="clear:both;">
					<li style="display:block;" class="Btn mb5">
					<em class="email_1"><img width="55" height="18" alt="e-메일" src="../images/icon/icon_email1.gif" onclick="javascript:proof_submit('email');"></em>
					<em class="print_1" onclick="javascript:proof_submit('print');"><img width="43" height="18" alt="인쇄" src="../images/icon/icon_print1.gif"></em>
					</li>
				</ul>
			</div>

			<div id="emailArea" style="border:1px solid #ddd; width:642px; margin:0 auto;">
			<table width="100%" cellspacing="0" cellpadding="0" bordercolor="#000000" border="2" bgcolor="#FFFFFF" bordercolordark="#000000">
			<tbody>
			<tr>
				<td style="padding:10px" class="orange">
					<table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:12px; font-family:gulim; text-align:left;">
					<tbody>
					<tr class="B_text14">
						<td width="61%" valign="bottom" height="50" style="padding-left:10px;" class="B_text15">제 <?php echo date('Y');?> - <span class="b"><?php echo $proof_last_no;?></span>호</td>
						<td width="39%" valign="bottom" align="right" height="50" class="B_text14"><a target="_blank" href="/"><?php echo $design_control->view_logo($logo['top']);?></a></td>
					</tr>
					<tr><td height="5"></td></tr>
					<tr><td height="1" style="border-top:1px solid #ccc; line-height:1; font-size:0;" colspan="2">&nbsp;</td></tr>
					<tr><td colspan="2">&nbsp;</td></tr>
					<tr>
						<td align="center" class="" colspan="2"><img width="211" height="51" src="../images/tit/certificate_tit.gif"></td>
					</tr>
					<tr><td height="30" colspan="2">&nbsp;</td></tr>
					<tr>
						<td align="center" colspan="2">
							<table width="95%" cellspacing="0" cellpadding="0" border="0" style="font-size:12px; font-family:gulim; text-align:left; border:2px solid #ccc">
							<tbody>
							<tr>
								<td style="padding:10px">
									<table width="100%" cellspacing="0" cellpadding="3" border="0" bgcolor="#FFFFFF" style="border-collapse:collapse; font-size:12px; font-family:gulim; text-align:left;">
									<tbody>
									<tr>
										<td width="19%" height="25">- 성&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;명 </td>
										<td width="81%" height="25">: <?php echo $member['mb_name'];?></td>
									</tr>
									<tr>
										<td width="19%" height="25">- 주민등록번호</td>
										<td width="81%" height="25">: <?php echo $mb_ssn;?>-*******</td>
									</tr>
									<tr>
										<td width="19%" height="25">- 주&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;소 </td>
										<td width="81%" height="25">: <?php echo $mb_address;?></td>
									</tr>
										<tr>
										<td width="19%" height="25">- 연&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;락&nbsp;&nbsp;&nbsp;&nbsp;처</td>
										<td width="81%" height="25">: <?php echo $mb_phones;?></td>
									</tr>
									</tbody>
									</table>
								</td>
							</tr>
							</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="30" colspan="2">&nbsp;</td></tr>
					<tr>
						<td height="20" style="padding-left:17px;" colspan="2">
							<span class="b"><?php echo $member['mb_name'];?></span>님의 취업활동 현황입니다.
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2">
							<table width="95%" cellspacing="0" cellpadding="0" border="0" style="font-size:12px; font-family:gulim; text-align:left;">
							<tbody>
							<tr><td height="2" style="border-top:2px solid #666; line-height:1; font-size:0;" colspan="4">&nbsp;</td></tr>
							<tr bgcolor="#F0F0F0" align="center">
								<td width="14%" height="30">지원일</td>
								<td width="28%" height="30">회사명</td>
								<td width="42%" height="30">주소</td>
								<td width="16%" height="30">연락처</td>
							</tr>
							<tr align="center"><td height="2" style="border-top:2px solid #666; line-height:1; font-size:0;" colspan="4">&nbsp;</td></tr>
							<?php
								for($i=0;$i<$apply_no_cnt;$i++){
								$get_receive = $receive_control->get_receive($apply_no[$i]);
								$wdate = strtr(substr($get_receive['wdate'],2,8),'-','/');
								$member_info = $user_control->get_member($get_receive['wr_to_id']);
								$company_info = $user_control->get_member_company($get_receive['wr_to_id']);
								$get_alba = $alba_company_control->get_alba_no($get_receive['wr_to']);
								$wr_phones = ($get_alba['wr_phone']) ? $get_alba['wr_phone'] : $get_alba['wr_hphone'];
							?>
							<tr align="center">
								<td width="14%" height="40"><?php echo $wdate;?> </td>
								<td width="28%" height="40"><?php echo stripslashes($company_info['mb_company_name']);?></td>
								<td width="42%" height="40"><?php echo $member_info['mb_address0']." ".$member_info['mb_address1'];?></td>
								<td width="16%" height="40"><?php echo $wr_phones;?></td>
							</tr>
							<?php } ?>
							<tr><td height="1" style="border-top:1px solid #666; line-height:1; font-size:0;" colspan="4">&nbsp;</td></tr>
							</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" height="70" colspan="2"><span class="b"><?php echo $member['mb_name'];?></span>님은 <?php echo $env['site_name'];?>의 입사지원시스템을 통하여 상기 기업에 입사지원하였음을 증명합니다.</td>
					</tr>
					<tr>
						<td align="center" height="60" colspan="2"><?php echo date('Y');?>년 <?php echo date('m');?>월 <?php echo date('d');?>일</td>
					</tr>
					<tr>
						<td align="center" height="100" colspan="2">
							<p style="font:30px  Batang,sans-serif ; letter-spacing: -1px;"><?php echo $env['site_name'];?></p>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="clearfix" style="width:580px; margin:0 auto; padding:15px; border:1px solid #ddd;">
							<div class="" style="float:left; border-right:1px solid #ddd;padding-right:10px; margin-right:10px;">
								<?php echo $design_control->view_logo($logo['bottom']);?>
							</div>
							<div class="" style="float:left; color:#bbb;"> <?php echo stripslashes($env['site_bottom']);?></div>
							</div>
						</td>
					</tr>
				</tbody>
				</table>
				</td>
			</tr>
			</tbody>
			</table>
			</div>

		</div>  
	</div>
</section>
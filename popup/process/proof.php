<?php
		/*
		* /application/popup/process/proof.php
		* @author Harimao
		* @since 2013/10/16
		* @last update 2015/03/12
		* @Module v3.5 ( Alice )
		* @Brief :: Proof process
		* @Comment :: 취업활동 증명서 처리 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			echo $utility->popup_msg_js($user_control->_errors('0015'));
			exit;
		}

		$mode = $_POST['mode'];
		$wr_id = $_POST['wr_id'];
		$wr_no = $_POST['wr_no'];
		$wr_proof_no = $_POST['wr_proof_no'];

		$get_member = $member_control->get_member($member['mb_id']);	// 회원 정보

		switch($mode){

			## 취업활동 증명서 메일 발송
			case 'email':

				$apply_no = explode(',',$wr_no);
				$apply_no_cnt = count($apply_no);

				$mb_ssn = substr(str_replace('-','',$member['mb_birth']),2,6);
				$mb_address = $member['mb_address0'] . " ".$member['mb_address1'];
				$mb_phones = ($member['mb_phone']) ? $member['mb_phone'] : $member['mb_hphone'];

				$send_email = $env['email'];
				$receive_email = $get_member['mb_email'];
				$email_subject = "[".$env['site_name']."] 취업활동 증명서";

				$_content = "<section id=\"print\" class=\"content_wrap clearfix\">";
				$_content .= "<div class=\"print\" id=\"rightContent\"> ";
				$_content .= "<div class=\"listWrap positionR mt20\">";
				$_content .= "<div id=\"emailArea\" style=\"border:1px solid #ddd; width:642px; margin:0 auto;\">";
				$_content .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#FFFFFF\">";
				$_content .= "<tbody><tr>";
				$_content .= "<td style=\"padding:10px\" class=\"orange\">";
				$_content .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"font-size:12px; font-family:gulim; text-align:left;\">";
				$_content .= "<tbody><tr class=\"B_text14\">";
				$_content .= "<td width=\"61%\" valign=\"bottom\" height=\"50\" style=\"padding-left:10px;\" class=\"B_text15\">제 ".date('Y')." - <span class=\"b\">".$wr_proof_no."</span>호</td>";
				$_content .= "<td width=\"39%\" valign=\"bottom\" align=\"right\" height=\"50\" class=\"B_text14\"><a target=\"_blank\" href=\"http://".$HOST."\">".$design_control->view_logo($logo['top'],true)."</a></td>";
				$_content .= "</tr><tr><td height=\"5\"></td></tr><tr>";
				$_content .= "<td height=\"1\" style=\"border-top:1px solid #ccc; line-height:1; font-size:0;\" colspan=\"2\">&nbsp;</td></tr>";
				$_content .= "<tr><td colspan=\"2\">&nbsp;</td></tr>";
				$_content .= "<tr><td align=\"center\" class=\"\" colspan=\"2\"><img width=\"211\" height=\"51\" src=\"http://".$HOST.'/'. $application."/images/tit/certificate_tit.gif\"></td></tr>";
				$_content .= "<tr><td height=\"30\" colspan=\"2\">&nbsp;</td></tr>";
				$_content .= "<tr><td align=\"center\" colspan=\"2\">";
				$_content .= "<table width=\"95%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"font-size:12px; font-family:gulim; text-align:left; border:2px solid #ccc\">";
				$_content .= "<tbody><tr>";
				$_content .= "<td style=\"padding:10px\">";
				$_content .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"0\" bgcolor=\"#FFFFFF\" style=\"border-collapse:collapse; font-size:12px; font-family:gulim; text-align:left;\">";
				$_content .= "<tbody><tr>";

				$_content .= "<td width=\"19%\" height=\"25\">- 성&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;";
				$_content .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;명 </td>";
				$_content .= "<td width=\"81%\" height=\"25\">: ". $member['mb_name']."</td>";
				$_content .= "</tr>";
				$_content .= "<tr>";
				$_content .= "<td width=\"19%\" height=\"25\">- 주민등록번호</td>";
				$_content .= "<td width=\"81%\" height=\"25\">: ".$mb_ssn."-*******</td>";
				$_content .= "</tr>";
				$_content .= "<tr>";
				$_content .= "<td width=\"19%\" height=\"25\">- 주&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;소 </td>";
				$_content .= "<td width=\"81%\" height=\"25\">: ".$mb_address."</td>";
				$_content .= "</tr>";
				$_content .= "<tr>";
				$_content .= "<td width=\"19%\" height=\"25\">- 연&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;락&nbsp;&nbsp;&nbsp;&nbsp;처</td>";
				$_content .= "<td width=\"81%\" height=\"25\">: ".$mb_phones."</td>";
				$_content .= "</tr>";

				$_content .= "</tbody></table></td></tr></tbody></table></td></tr><tr>";
				$_content .= "<td height=\"30\" colspan=\"2\">&nbsp;</td></tr>";
				$_content .= "<tr>";
				$_content .= "<td height=\"20\" style=\"padding-left:17px;\" colspan=\"2\"><span style=\"font-weight:bold;\">".$member['mb_name']."</span>님의 취업활동 현황입니다.</td>";
				$_content .= "</tr>";
				$_content .= "<tr>";
				$_content .= "<td align=\"center\" colspan=\"2\">";
				$_content .= "<table width=\"95%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"font-size:12px; font-family:gulim; text-align:left;\">";
				$_content .= "<tbody><tr>";
				$_content .= "<td height=\"2\" style=\"border-top:2px solid #666; line-height:1; font-size:0;\" colspan=\"4\">&nbsp;</td>";
				$_content .= "</tr>";
				$_content .= "<tr bgcolor=\"#F0F0F0\" align=\"center\">";
				$_content .= "<td width=\"14%\" height=\"30\">지원일</td>";
				$_content .= "<td width=\"28%\" height=\"30\">회사명</td>";
				$_content .= "<td width=\"42%\" height=\"30\">주소</td>";
				$_content .= "<td width=\"16%\" height=\"30\">연락처</td>";
				$_content .= "</tr>";
				$_content .= "<tr align=\"center\"><td height=\"2\" style=\"border-top:2px solid #666; line-height:1; font-size:0;\" colspan=\"4\">&nbsp;</td></tr>";

				for($i=0;$i<$apply_no_cnt;$i++){
				$get_receive = $receive_control->get_receive($apply_no[$i]);
				$wdate = strtr(substr($get_receive['wdate'],2,8),'-','/');
				$member_info = $user_control->get_member($get_receive['wr_to_id']);
				$company_info = $user_control->get_member_company($get_receive['wr_to_id']);
				$get_alba = $alba_company_control->get_alba_no($get_receive['wr_to']);
				$wr_phones = ($get_alba['wr_phone']) ? $get_alba['wr_phone'] : $get_alba['wr_hphone'];

					$_content .= "<tr align=\"center\">";
					$_content .= "<td width=\"14%\" height=\"40\">".$wdate." </td>";
					$_content .= "<td width=\"28%\" height=\"40\">".stripslashes($company_info['mb_company_name'])."</td>";
					$_content .= "<td width=\"42%\" height=\"40\">".$member_info['mb_address0']." ".$member_info['mb_address1']."</td>";
					$_content .= "<td width=\"16%\" height=\"40\">".$wr_phones."</td>";
					$_content .= "</tr>";
				}
				$_content .= "<tr>";
				$_content .= "<td height=\"1\" style=\"border-top:1px solid #666; line-height:1; font-size:0;\" colspan=\"4\">&nbsp;</td>";
				$_content .= "</tr>";
				$_content .= "</tbody></table>";
				$_content .= "</td>";
				$_content .= "</tr>";
				$_content .= "<tr>";
				$_content .= "<td align=\"center\" height=\"70\" colspan=\"2\"><span style=\"font-weight:bold;\">".$member['mb_name']."</span>님은 ".$env['site_name']."의 입사지원시스템을 통하여 상기 기업에 입사지원하였음을 증명합니다.</td>";
				$_content .= "</tr>";
				$_content .= "<tr>";
				$_content .= "<td align=\"center\" height=\"60\" colspan=\"2\">".date('Y')."년 ".date('m')."월 ".date('d')."일</td>";
				$_content .= "</tr>";
				$_content .= "<tr>";
				$_content .= "<td align=\"center\" height=\"100\" colspan=\"2\"><p style=\"font:30px  Batang,sans-serif ; letter-spacing: -1px;\">".$env['site_name']."</p></td>";
				$_content .= "</tr>";
				$_content .= "<tr>";
				$_content .= "<td colspan=\"2\">";
				$_content .= "<div style=\"overflow:hidden; width:580px; margin:0 auto; padding:15px; border:1px solid #ddd;\">";
				$_content .= "<div class=\"\" style=\"float:left; border-right:1px solid #ddd;padding-right:10px; margin-right:10px;\">".$design_control->view_logo($logo['bottom'],true)."</div>";
				$_content .= "<div style=\"float:left; color:#bbb;\"> ".stripslashes($env['site_bottom'])."</div>";

				$_content .= "</div></td></tr></tbody></table></td></tr></tbody></table></div></div>  </div></section>";
				
				$email_content = $_content;

				$mailer->sendMail($env['site_name'], $send_email, $receive_email, $email_subject, stripslashes($email_content), 1);

			break;

			## 취업활동 증명서 인쇄
			case 'print':

				$result = true;

			break;


		}

		$vals['wr_type'] = $mode;
		$vals['wr_id'] = $wr_id;
		$vals['wr_no'] = $wr_no;
		$vals['wr_proof_no'] = $_POST['wr_proof_no'];
		$vals['wdate'] = $now_date;

		$result = $alba_individual_control->insert_proof($vals);
		
		echo $result . "/" . $mode;
?>
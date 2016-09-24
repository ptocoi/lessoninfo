<?php
		/*
		* /application/individual/views/_load/popup.php
		* @author Harimao
		* @since 2013/10/16
		* @last update 2015/03/11
		* @Module v3.5 ( Alice )
		* @Brief :: Alba resume popup
		* @Comment :: 개인서비스 레이어 팝업창
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];
		$wr_id = $_POST['wr_id'];

		switch($mode){

			## 면접제의 메일 보기
			case 'interview_mail':

				$get_proposal = $alba_company_control->get_proposal($no);
				$company_info = $user_control->get_member_company($get_proposal['mb_id']);
?>
				<dl>
					<dt class="bg_gray1" style="padding:20px 15px;"><strong>면접제의 메일보기</strong>
					<em class="closeBtn" onclick="mail_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em></dt>
					<dd style="padding:10px 15px;">
					<p style="padding-bottom:20px;"><strong><?php echo stripslashes($company_info['mb_company_name']);?></strong>에서 보내온 면접제의 내용입니다.</p>
					<div class="mtuPopDescInterv" style="border:1px solid #ddd;  padding:10px; max-height:150px; overflow:auto;" ><?php echo nl2br(stripslashes($get_proposal['wr_content']));?></div>
					<div class="btn font_gray bg_white" style="margin:20px auto;"><a href="javascript:mail_close();">확인<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div>
					</dd>
				</dl>

<?php
			break;

		}	// switch end.
?>
<?php
		/*
		* /application/resume/views/_load/popup.php
		* @author Harimao
		* @since 2013/10/15
		* @last update 2015/05/07
		* @Module v3.5 ( Alice )
		* @Brief :: Alba resume popup
		* @Comment :: 알바이력서 관련 레이어 팝업창
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$wr_type = $_POST['wr_type'];
		$mb_id = $_POST['mb_id'];

		$no = $_POST['no'];

		switch($mode){

			## 입사/면접제의
			case 'proposal':

				$alba_list = $alba_company_control->alba_list(" where `wr_id` = '".$mb_id."' and `wr_open` = 1 ");
				$get_resume = $alba_individual_control->get_resume_no($no);	// 이력서 정보

				$proposal_title = ($wr_type=='become') ? "입사지원" : "면접제의";

?>
				<form method="post" name="proposalFrm" action="./process/proposal.php" id="proposalFrm">
				<input type="hidden" name="mode" value="proposal_insert"/>
				<input type="hidden" name="wr_type" value="<?php echo $wr_type;?>"/>
				<input type="hidden" name="mb_id" value="<?php echo $mb_id;?>"/>
				<input type="hidden" name="resume_no" value="<?php echo $no;?>"/>
				<input type="hidden" name="wr_id" value="<?php echo $get_resume['wr_id'];?>"/>

				<div class="layerPop  border_color5" style="display:block; width:494px; margin:0 auto; text-align:left; ">
				<dl>
					<dt style="padding:20px 15px;" class="bg_gray1 font18"><strong><?php echo $proposal_title;?> 요청</strong>
						<em class="closeBtn" onclick="popup_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> 
					</dt>
					<!--  이력서선택   -->
					<dd style="padding:20px 15px 10px;">
						<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
							<strong>채용공고 선택</strong><br/>
						</p>
						<div class="bgBox2 clearfix" >
							<!--  회사자사양식   -->                 
							<ul class="resume2" style="display:block;">
							<li>
								<span>채용공고선택</span>
								<select class="ipSelect2" style="width:255px;" id="wr_employ" name="wr_employ" title="채용공고선택" onchange="get_alba(this);" required hname="채용공고" option="select">
								<option value="">채용공고 선택</option>
								<?php foreach($alba_list as $val){ ?>
								<option value="<?php echo $val['no'];?>"><?php echo stripslashes($val['wr_subject']);?></option>
								<?php } ?>
								</select>
							</li>
							<li><span>채용담당자명</span><input type="text" name="wr_person" id="wr_person" class="ipText2" style="width:250px;" required hname="채용담당자명"></li>
							<li><span>담당자연락처</span><input type="text" name="wr_phone" id="wr_phone" class="ipText2" style="width:250px;" required hname="담당자연락처"></li>
							<li><span>담당자휴대폰</span><input type="text" name="wr_hphone" id="wr_hphone" class="ipText2" style="width:250px;" required hname="담당자휴대폰"></li>
							<li><span>회신 e-mail</span><input type="text" name="wr_email" id="wr_email" class="ipText2" style="width:250px;" required hname="이메일주소"></li>
							</ul>
							<!--  회사자사양식 //   -->
						</div>
					</dd>
					<!--  이력서선택 //   -->

					<!--  사전질문   -->                 
					<dd style="padding:10px 15px 10px; display:block;">
						<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
							<strong>전달메세지</strong><br/>
						</p>
						<div class="bgBox clearfix" >
							<textarea name="wr_content" class="ipTextarea" id="wr_content" style="width:420px; height:150px; padding:10px;"  required hname="전달메세지"></textarea>
						</div>
					</dd>
					<!--  사전질문 //   -->
					
				</dl>

				<div style="margin:30px auto;" class="doubleBtn clearfix">
					<ul> 
						<li><div class="btn font_white bg_blueBlack"><a href="javascript:proposalFrmSubmit();">전송<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
						<li><div class="btn font_gray bg_white"><a href="#">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
					</ul>
					</div>
				</div>

				</form>
<?php
			break;
		}
?>
<?php
		/*
		* /application/company/views/_load/company_manager.php
		* @author Harimao
		* @since 2013/09/27
		* @last update 2015/04/13
		* @Module v3.5 ( Alice )
		* @Brief :: Company manager ajax load
		* @Comment :: 담당자 / 지역정보 등 ajax load가 필요한 항목들 load
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];


		switch($mode){

			## 담당자 관리
			case 'manager_insert':
			case 'manager_update':	

				if($no) {
					$get_manager = $company_manager_control->get_manager($no);
					$wr_phone = explode('-',$get_manager['wr_phone']);
					$wr_hphone = explode('-',$get_manager['wr_hphone']);
					$wr_fax = explode('-',$get_manager['wr_fax']);
					$wr_email = explode('@',$get_manager['wr_email']);
				}

				$tel_num_option = $config->get_tel_num($wr_phone[0]);	 // 전화번호 국번
				$hp_num_option = $config->get_hp_num($wr_hphone[0]);	 // 휴대폰번호 국번
				$fax_num_option = $config->get_tel_num($wr_fax[0]);	 // 전화번호 국번
				$email_option = $config->get_email();	 // 이메일 서비스 제공자

?>
				<form method="post" name="managerFrm" action="./process/manager.php" id="managerFrm">
				<input type="hidden" name="mode" value="<?php echo $mode;?>" id="manager_mode"/>
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
				<input type="hidden" name="no" value="<?php echo $no;?>"/>

				<h2 class="ml2 font14 clearfix" id="managerTitle">
					<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vm mr5 bg_blue4">채용담당자 정보 입력</strong>
				</h2>
				<div class="customList2 mb30">
					<div class="companyRegistWrap">
					<table>
					<caption><span class="skip">담당자정보입력</span></caption>
					<colgroup><col width="159px"><col width="*"></colgroup>
					<tbody>
					<tr>
						<th scope="row"> 
							<label><img src="../images/icon/icon_b.gif" alt="필수입력사항">담당자명</label>
						</th>
						<td><input type="text" name="wr_name" id="wr_name" style="width:200px;" class="ipText"  maxlength="16" value="<?php echo $get_manager['wr_name'];?>" hname="담당자명" required></td>
					</tr>
					<tr>
						<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >전화번호</label></th>
						<td>
							<div class="telWrap">
								<select title="지역번호 선택" name="wr_phone[]" id="wr_phone0" style="width:111px;" class="ipSelect" hname="전화번호 지역번호" required option="select">
								<option value="">지역번호 선택</option>
								<?php echo $tel_num_option; ?>
								</select>
								<span class="delimiter">-</span>
								<input type="text" name="wr_phone[]" id="wr_phone1" maxlength="4" title="전화번호 앞자리" class="ipText" value="<?php echo $wr_phone[1];?>" hname="전화번호 앞자리" required>
								<span class="delimiter">-</span>
								<input type="text" name="wr_phone[]" id="wr_phone2" maxlength="4" title="전화번호 뒷자리" class="ipText" value="<?php echo $wr_phone[2];?>" hname="전화번호 뒷자리" required>
							</div>
						</td>
					</tr>
					<tr>
						<th scope="row"> <label class="pl15">휴대폰</label></th>
						<td>
							<div class="telWrap">
								<select title="국번 선택" name="wr_hphone[]" id="wr_hphone0" style="width:111px;" class="ipSelect" hname="휴대폰 국번">
								<option value="">국번</option>
								<?php echo $hp_num_option; ?>
								</select>
								<span class="delimiter">-</span>
								<input type="text" name="wr_hphone[]" id="wr_hphone1" maxlength="4" title="휴대폰 앞자리" class="ipText" value="<?php echo $wr_hphone[1];?>" hname="휴대폰 앞자리">
								<span class="delimiter">-</span>
								<input type="text" name="wr_hphone[]" id="wr_hphone2" maxlength="4" title="휴대폰 뒷자리" class="ipText" value="<?php echo $wr_hphone[2];?>" hname="휴대폰 뒷자리">
							</div>
						</td>
					</tr>
					<tr>
						<th scope="row"> <label class="pl15">팩스번호</label></th>
						<td>
							<div class="telWrap">
							<select title="지역번호 선택" name="wr_fax[]" id="wr_fax0" style="width:111px;" class="ipSelect">
							<option value="">지역번호 선택</option>
							<?php echo $fax_num_option; ?>
							</select>
							<span class="delimiter">-</span>
							<input type="text" name="wr_fax[]" id="wr_fax1" maxlength="4" title="전화번호 앞자리" class="ipText" value="<?php echo $wr_fax[1];?>">
							<span class="delimiter">-</span>
							<input type="text" name="wr_fax[]" id="wr_fax2" maxlength="4" title="전화번호 뒷자리" class="ipText" value="<?php echo $wr_fax[2];?>">
							</div>
						</td>
					</tr>
					<tr>
						<th class="bbend" scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >e-메일</label>
						</th>
						<td class="bbend">
							<div class="emailWrap">
								<input type="text" name="wr_email[]" id="wr_email" maxlength="30"  style="width:150px;ime-mode:disabled;" class="ipText" value="<?php echo $wr_email[0];?>" hname="이메일주소" required>
								<span class="delimiter">@</span>
								<input type="text" name="wr_email[]" id="wr_email_tail" title="이메일 서비스 입력" maxlength="25"  class="ipText" style="width:185px;ime-mode:disabled;" value="<?php echo $wr_email[1];?>" hname="이메일주소" required>
								<select id="email_service" style="width:105px" class="ipSelect" onchange="email_sel(this);">
								<option value="">직접입력</option>
								<?php echo $email_option; ?>
								</select>
							</div>
						</td>
					</tr>
					</tbody>          
					</table>
					</div>
					<div style="margin:30px auto;" class="doubleBtn clearfix">
						<ul> 
							<li><div class="btn font_white bg_blueBlack"><a href="javascript:ManagerFrmSubmit();">저장<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
							<li><div class="btn font_gray bg_white"><a href="javascript:ManagerFrmCancel();">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
						</ul>
					</div>        
				</div>

				</form>
<?php
			break;

		}

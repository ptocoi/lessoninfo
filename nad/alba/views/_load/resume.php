<?php
		/*
		* /application/nad/alba/views/_load/resume.php
		* @author Harimao
		* @since 2013/10/22
		* @last update 2015/04/15
		* @Module v3.5 ( Alice )
		* @Brief :: Alba load layer
		* @Comment :: 알바 정보 추출
		*/

		$alice_path = "../../../../";
		
		$cat_path = "../../../../";

		include_once $alice_path . "_core.php";

		$admin_control->is_admin( true );	// 관리자 체크

		$mode = $_POST['mode'];
		$no = $_POST['no'];
		$mb_id = $_POST['mb_id'];

		if($mb_id)
			$member = $member_control->get_member($mb_id);	 // mb_id 기준
		else 
			$member = $member_control->get_memberNo($no);	// no 기준

		switch($mode){

			## 이력서 보기
			case 'get_resume':
?>
				<div id="pop_resume" class="bocol lnb_col" style="top:10%;left:33%;display:;">
					<dl class="ntlt lnb_col m0 hand" id="resumeHandle">
						<img src="../../images/comn/bul_10.png" class="t">이력서정보
						<a onClick="MM_showHideLayers('pop_resume','','hide')"><img src="../../images/comn/pclose.png" class="lclose ln_col"></a>
					</dl>  
					<table width="730" class="bg_col tf">
					<col width=100><col><col width=100><col>
					<tr>
						<td class="ctlt">아이디</td>
						<td class="pdlnb2 num11"><?php echo $member['mb_id'];?></td>
						<td class="ctlt">이메일</td>
						<td class="pdlnb2 num11"><a onClick="pop_email('<?php echo $member['no'];?>');"><?php echo $member['mb_email'];?></a></td>
					</tr>

					</table>

					<dl class="pbtn">  
						<a onClick="MM_showHideLayers('pop_alba','','hide')"><img src="../../images/btn/23_10.gif"></a>
					</dl>
				</div>
<?php
			break;

			## 이력서 등록/수정
			case 'insert':
			case 'update':
			case 'load':

				$get_resume = $alba_resume_control->get_resume($no);
				
				//$input_type = ($mode=='update' || $mode=='load') ? $get_resume['input_type'] : $_POST['wr_input_type'];
				$input_type = ($mode=='update' || $mode=='load') ? (!$get_resume['input_type']) ? 'load' : $get_resume['input_type'] : $_POST['wr_input_type'];

				$admin_mb_id = $utility->get_unique_code('admin');

				//$mb_id = ($input_type=='self'||!$input_type) ? $admin_mb_id : $get_resume['wr_id'];

				$mb_id = ($mode=='update' || $mode=='load') ? ($get_resume['wr_id']) ? $get_resume['wr_id'] : $admin_mb_id : $admin_mb_id;

				$member = $member_control->get_member($mb_id);	 // mb_id 기준

				$member_list = $member_control->member_list("",""," where `mb_type` = 'individual' and `is_delete` = 0 ");

				$area_list = $category_control->category_codeList('area','','yes');					// 지역
				$job_type_list = $category_control->category_codeList('job_type','','yes');		// 직종

				$alba_date_list = $category_control->category_codeList('alba_date');	// 알바근무기간
				$alba_week_list = $category_control->category_codeList('alba_week');	// 알바근무요일
				$alba_time_list = $category_control->category_codeList('alba_time');	// 알바근무시간
				$alba_pay_list = $category_control->category_codeList('alba_pay');		// 알바급여조건

				$work_type_list = $category_control->category_codeList('work_type');	// 근무형태
				$indi_ability_list = $category_control->category_codeList('job_ability', '', 'yes');	// 학력
				$indi_oa_list = $category_control->category_codeList('indi_oa', '', 'yes');	// 컴퓨터능력
				$indi_special_list = $category_control->category_codeList('indi_special', '', 'yes');	// 특기사항
				$impediment_list = $category_control->category_codeList('impediment', '', 'yes');	// 장애등급
				$indi_treatment_list = $category_control->category_codeList('indi_treatment', '', 'yes');	// 고용지원금대상자

				/* 지역 */
				$wr_area0 = $get_resume['wr_area0'];
				$wr_area1 = $get_resume['wr_area1'];

				$wr_area2 = $get_resume['wr_area2'];
				$wr_area3 = $get_resume['wr_area3'];

				$wr_area4 = $get_resume['wr_area4'];
				$wr_area5 = $get_resume['wr_area5'];
				/* //지역 */


				/* 직종 */
				$wr_job_type0 = $get_resume['wr_job_type0'];
				$wr_job_type1 = $get_resume['wr_job_type1'];
				$wr_job_type2 = $get_resume['wr_job_type2'];

				$wr_job_type3 = $get_resume['wr_job_type3'];
				$wr_job_type4 = $get_resume['wr_job_type4'];
				$wr_job_type5 = $get_resume['wr_job_type5'];

				$wr_job_type6 = $get_resume['wr_job_type6'];
				$wr_job_type7 = $get_resume['wr_job_type7'];
				$wr_job_type8 = $get_resume['wr_job_type8'];
				/* //직종 */

				$wr_work_type = explode(',',$get_resume['wr_work_type']);		// 근무형태

				/* 학력 */
				$wr_school_ability = explode('/',$get_resume['wr_school_ability']);
				$wr_school_type = explode(',',$get_resume['wr_school_type']);

				$schoolSelect_view = false;
				if($get_resume['wr_half_college'] || $get_resume['wr_college'] || $get_resume['wr_graduate'] || $get_resume['wr_success']){
					$schoolSelect_view = true;
				}

				// 고등학교
				$high_school_display = "none";
				if(@in_array('high_school',$wr_school_type)){
					$high_school_display = "";
				}

				// 대학(2,3학년)
				$high_school_disabled = "disabled";	
				$high_school_checked = "";
				$half_college_display = "none";
				
				if(@in_array('half_college',$wr_school_type)){
					$high_school_disabled = "";
					$high_school_checked = "checked";
					$half_college_display = "";
				}
				
				// 대학 (2,3년) 데이터
				$wr_half_college = unserialize($get_resume['wr_half_college']);
				$wr_half_college_cnt = count($wr_half_college['college']);

				// 대학(4학년)
				$half_college_disabled = "disabled";
				$half_college_checked = "";
				$college_display = "none";
				if(@in_array('college',$wr_school_type)){
					$half_college_disabled = "";
					$half_college_checked = "checked";
					$college_display = "";
				}

				// 대학 (4년) 데이터
				$wr_college = unserialize($get_resume['wr_college']);
				$wr_college_cnt = count($wr_college['college']);
				
				// 대학원
				$college_disabled = "disabled";
				$college_checked = (@in_array('college',$wr_school_type)) ? "checked" : "";
				$graduate_checked = "";
				$graduate_display = "none";
				if(@in_array('graduate',$wr_school_type)){
					$college_disabled = "";
					$college_checked = "checked";
					$graduate_checked = "checked";
					$graduate_display = "";
				}
				
				// 대학원 데이터
				$wr_graduate = unserialize($get_resume['wr_graduate']);
				$wr_graduate_cnt = count($wr_graduate['graduate']);

				// 대학원 이상 데이터
				$wr_success = unserialize($get_resume['wr_success']);
				$wr_success_cnt = count($wr_graduate['success']);

				$success_display = "none";
				if(@in_array('success',$wr_school_type)){
					$graduate_display = "";
				}

				if(@in_array('half_college',$wr_school_type)){
					$half_college_checked = "checked";
				}
				if(@in_array('college',$wr_school_type)){
					$college_checked = "checked";
				}
				if(@in_array('graduate',$wr_school_type)){
					$graduate_checked = "checked";
				}
				/* //학력 */

				/* 경력 */
				$wr_career_use = $get_resume['wr_career_use'];
				if($wr_career_use){
					$wr_career = unserialize($get_resume['wr_career']);
				}
				/* //경력 */

				/* 자격증 */
				$wr_license_use = $get_resume['wr_license_use'];
				if($wr_license_use){
					$wr_license = unserialize($get_resume['wr_license']);
				}
				/* //자격증 */

				/* 외국어 */
				$wr_language_use = $get_resume['wr_language_use'];
				if($wr_language_use){
					$wr_language = unserialize($get_resume['wr_language']);
				}
				/* //외국어 */

				$indi_language_list = $category_control->category_codeList('indi_language', '', 'yes');	// 외국어
				$language_date = $alba_resume_control->language_date;	// 연수기간
				$indi_language_license_list = $category_control->category_codeList('indi_language_license', '', 'yes');	// 외국어공인시험
				$indi_oa_list = $category_control->category_codeList('indi_oa', '', 'yes');	// 컴퓨터능력
				$indi_special_list = $category_control->category_codeList('indi_special', '', 'yes');	// 특기사항

				if($get_resume['wr_oa']) $wr_oa = unserialize($get_resume['wr_oa']);
				if($get_resume['wr_computer']) $wr_computer = explode(',',$get_resume['wr_computer']);
				if($get_resume['wr_specialty']) $wr_specialty = explode(',',$get_resume['wr_specialty']);

				$wr_specialty_etc = explode('//',$get_resume['wr_specialty_etc']);

				$wr_treatment_service = explode(',',$get_resume['wr_treatment_service']);
				$wr_calltime = explode('-',$get_resume['wr_calltime']);

				// 프로필 사진
				$mb_photo_file = $alice['data_member_path']."/".$mb_id."/".$member['mb_photo'];
				$mb_photo = (is_file($mb_photo_file)) ? "../../data/member/".$mb_id."/".$member['mb_photo'] : "../../images/comn/no_profileimg.gif";

				$photo_0 = $user_control->get_member_photo($mb_id, 0);
				$photo_0_file = $alice['data_member_path']."/".$mb_id."/photos/".$photo_0;
				$photo_0 = (is_file($photo_0_file)) ? "../../data/member/".$mb_id."/photos/".$photo_0 : "../../images/comn/no_profileimg.gif";

				$photo_1 = $user_control->get_member_photo($mb_id, 1);
				$photo_1_file = $alice['data_member_path']."/".$mb_id."/photos/".$photo_1;
				$photo_1 = (is_file($photo_1_file)) ? "../../data/member/".$mb_id."/photos/".$photo_1 : "../../images/comn/no_profileimg.gif";

				$photo_2 = $user_control->get_member_photo($mb_id, 2);
				$photo_2_file = $alice['data_member_path']."/".$mb_id."/photos/".$photo_2;
				$photo_2 = (is_file($photo_2_file)) ? "../../data/member/".$mb_id."/photos/".$photo_2 : "../../images/comn/no_profileimg.gif";

				$photo_3 = $user_control->get_member_photo($mb_id, 3);
				$photo_3_file = $alice['data_member_path']."/".$mb_id."/photos/".$photo_3;
				$photo_3 = (is_file($photo_3_file)) ? "../../data/member/".$mb_id."/photos/".$photo_3 : "../../images/comn/no_profileimg.gif";

				if($mode=='insert'){
					$new_address_block = "";
					$old_address_block = "none";
				} else {
					if($member['mb_address_road']){
						$new_address_block = "";
						$old_address_block = "none";
					} else {
						$new_address_block = "none";
						$old_address_block = "";
					}
				}

				$mb_birth = explode('-',$member['mb_birth']);
				$mb_phone = explode('-',$member['mb_phone']);
				$mb_hphone = explode('-',$member['mb_hphone']);

				$tel_num_option = $config->get_tel_num($mb_phone[0]);
				$hp_num_option = $config->get_hp_num($mb_hphone[0]);
				$email_option = $config->get_email();

				$mb_zipcode = explode('-',$member['mb_zipcode']);
?>

<style>
.positionA{position:absolute;}
.positionR{position:relative;}
.closeBtn{ position:absolute; top:10px; right:10px;}
.block{display:block !important;}
.bg_gray1{background:#eee;}
.wr_career_block .career1 table tbody tr td  label{display:inline-block; width:80px;}
.wr_career_block .career1 table tbody tr td{line-height:2em;}
.wr_license_block .career1 table tbody tr td  label{display:inline-block; width:80px;}
.wr_license_block .career1 table tbody tr td{line-height:2em;}
.wr_language_block .language ul li span label{display:inline-block; width:80px;}
.wr_language_block .language  ul li {line-height:2em;}
</style>

				<div id="add_form" class="bocol lnb_col" style="top:5%;left:33%;display:none;">
				<form name="ResumeFrm" method="post" id="ResumeFrm" action="./process/resume_regist.php" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="<?php echo $mode;?>" id="mode"/>
				<input type="hidden" name="ajax" value="1"/><!-- ajax mode 유무 -->
				<?php if($mode=='update'){ ?>
				<input type="hidden" name="no" value="<?php echo $no;?>"/>
				<?php } ?>
				<input type="hidden" name="wr_id" id="wr_id" value="<?php echo $mb_id;?>"/>

				<dl class="ntlt lnb_col m0 hand" id="memberFrmHandle">
					<img src="../../images/comn/bul_10.png" class="t">이력서 <?php echo ($mode=='insert')?'등록':'수정';?>
					<span>( <b class="col">*</b> 표시는 필수 입력사항 )</span>
					<a onClick="MM_showHideLayers('add_form','','hide')"><img src="../../images/comn/pclose.png" class="lclose ln_col"></a>
				</dl>

				<table width="800" class="bg_col">
				<col width='100'><col>
				<tr>
					<td class="ctlt">등록방법 <b class="col">*</b></td>
					<td class="pdlnb2">
						<input type="radio" class="chk" name="wr_input_type" id="wr_input_type_self" value="self" <?php echo ($input_type=='self'||!$input_type)?'checked':'';?> onclick="input_types(this);"/><label for="wr_input_type_self">직접등록</label>&nbsp;
						<input type="radio" class="chk" name="wr_input_type" id="wr_input_type_load" value="load" <?php echo ($input_type=='load')?'checked':'';?> onclick="input_types(this);"/><label for="wr_input_type_load">불러오기</label>
					</td>
				</tr>
				<tr class="input_type_self" style="display:<?php echo ($input_type=='self'||!$input_type)?'':'none';?>;">
					<td class="ctlt">이력서사진</td>
					<td class="pdlnb2">
						<!--  사진등록 layer
						<div class="layerPop  lnb_col" style="display:none; border:2px solid #ddd; background:#fff; position:absolute; width:420px; top:5%; left:25%; text-align:left; z-index:9999;" id="mbPhotoPop">
							<dl style="">
								<dt style="background:#eee; padding:20px 15px;cursor:pointer;" class="" id="mbPhotoPop_handle">
									<strong>이력서사진 등록</strong>
									<em class="closeBtn" onclick="close_mb_photos()"><img width="11" height="11" class="pb5" src="../../images/icon/icon_close2.gif" alt="close"></em>
								</dt>
								<dd style="padding:10px 15px;">
									<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
									<strong>100*130픽셀 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
									<div class="box2" style="border:1px solid #ddd; padding:10px;">
										<input type="file" name="mb_photo_files" id="mb_photo_files" size="32" style="height:20px;" class="txtForm">
									</div>
									<div  style="width:100px; margin:20px auto; " class=" btn font_gray bg_white block"><a class="block" style="padding:10px 20px;" href="javascript:mb_photo_submit();">등록하기</a></div>
								</dd>
							</dl>
						</div>
						//사진등록 layer   -->
						<!-- 
						<div class="photoWrap positionR clearfix">
							<ul class="clearfix">
								<li style="padding-right:10px;float:left;width:100px;">
									<div class="photo"> <img src="<?php echo $wr_mb_photo;?>" style="width:100%;height:130px;"  alt="photo" id="mb_photos"> </div>
									<input type="hidden" name="mb_photo" id="mb_photo" value="<?php echo $get_resume['etc_0'];?>"/>
									<div class="mt5 tc buttonWrap"> 
										<a class="btn white" style="padding:2px 15px;" onclick="update_mb_photos('update');" id="mb_photo_update"> <span>등록</span> </a> 
									</div>
								</li>
							</ul>
						</div>
						-->
						<?php if($mode=='update' || $mode=='load'){ ?>
						<div class="photoWrap positionR clearfix">
							<ul class="clearfix">
								<li style="padding-right:10px;float:left;width:100px;margin-bottom:5px;">
									<div class="photo"> <img src="<?php echo $mb_photo;?>" style="width:100%;height:130px;"  alt="photo" id="mb_photos"> </div>
									<input type="hidden" name="mb_photo" id="mb_photo" value="<?php echo $member['mb_photo'];?>"/>
								</li>
							</ul>
						</div>
						<?php } ?>
						<input type="file" name="photo_file" id="photo_file" class="txt"/>
					</td>
				</tr>
				<tr class="input_type_self" style="display:<?php echo ($input_type=='self'||!$input_type)?'':'none';?>;">
					<td class="ctlt">이름 <b class="col">*</b></td>
					<td class="pdlnb2">
						<input style="110px;" type="text" name="mb_name" id="mb_name" class="txt" hname="이름" value="<?php echo $member['mb_name'];?>">
					</td>
				</tr>
				<tr class="input_type_self" style="display:<?php echo ($input_type=='self'||!$input_type)?'':'none';?>;">
					<td class="ctlt">생년월일/성별 <b class="col">*</b></td>
					<td class="pdlnb2">
						<select title="년도선택" class="ipSelect" name="mb_birth_year" id="mb_birth_year" style="width:80px" hname="생년">
						<option value="">년도</option>
						<?php for($i=date('Y')-15;$i>=1900;--$i){ ?>
							<option value='<?=$i?>' <?php echo ($mb_birth[0]==$i)?'selected':'';?>><?=$i?></option>
						<?php } ?>
						</select> 년 
						<select title="월 선택" class="ipSelect" name="mb_birth_month" id="mb_birth_month" style="width:59px" hname="생월">
						<option value="">월</option>
						<?php for($i=1;$i<=12;$i++){?>
						<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($mb_birth[1]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?></option>
						<?php } ?>
						</select> 월 
						<select title="일 선택" class="ipSelect" name="mb_birth_day" id="mb_birth_day" style="width:59px" hname="생일">
						<option value="">일</option>
						<?php for($i=1;$i<=31;$i++){?>
						<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($mb_birth[2]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?></option>
						<?php } ?>
						</select> 일 
						<input type="radio" value="0" name="mb_gender" id="mb_gender_0" class="chk" hname="성별" checked>
						<label for="mb_gender_0">남</label>
						<input type="radio" value="1" name="mb_gender" id="mb_gender_1" class="chk" hname="성별" <?php echo ($member['mb_gender'])?'checked':'';?>>
						<label for="mb_gender_1">여</label>
					</td>
				</tr>
				<tr class="input_type_self" style="display:<?php echo ($input_type=='self'||!$input_type)?'':'none';?>;">
					<td class="ctlt">전화번호 <b class="col">*</b></td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:111px;" id="mb_phone0" name="mb_phone[]" title="지역번호 선택" hname="지역번호">
						<option value="">지역번호 선택</option>
						<?php echo $tel_num_option; ?>
						</select>
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="전화번호 앞자리" maxlength="4" id="mb_phone1" name="mb_phone[]" hname="전화번호 앞자리" value="<?php echo $mb_phone[1];?>">
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="전화번호 뒷자리" maxlength="4" id="mb_phone2" name="mb_phone[]" hname="전화번호 뒷자리" value="<?php echo $mb_phone[2];?>">
					</td>
				</tr>
				<tr class="input_type_self" style="display:<?php echo ($input_type=='self'||!$input_type)?'':'none';?>;">
					<td class="ctlt">휴대폰 <b class="col">*</b></td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:111px;" id="mb_hphone0" name="mb_hphone[]" title="휴대폰 국번">
						<option value="">국번</option>
						<?php echo $hp_num_option; ?>
						</select>
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="휴대폰 앞자리" maxlength="4" id="mb_hphone1" name="mb_hphone[]" required hname="휴대폰 앞자리" value="<?php echo $mb_hphone[1];?>">
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="휴대폰 뒷자리" maxlength="4" id="mb_hphone2" name="mb_hphone[]" required hname="휴대폰 뒷자리" value="<?php echo $mb_hphone[2];?>">
					</td>
				</tr>
				<tr class="input_type_self" style="display:<?php echo ($input_type=='self'||!$input_type)?'':'none';?>;">
					<td class="ctlt">주소 <b class="col">*</b></td>
					<td class="pdlnb2">
						<div class="pb5">
							<input type="radio" name="new_address" id="new_address_1" value="1" onclick="new_addresses(this);" onfocus="blur();" checked/><label for="new_address_1">도로명 주소</label>&nbsp;
							<input type="radio" name="new_address" id="new_address_0" value="0" onclick="new_addresses(this);" onfocus="blur();" <?php echo ($mode=='update'&&!$member['mb_address_road'])?'checked':'';?>/><label for="new_address_0">일반 주소</label>&nbsp;
						</div>

						<div class="addresWrap" id="new_address_block" style="display:<?php echo $new_address_block;?>;">
							<input type="text" style="width:55px;" class="tnum" title="우편번호 앞자리" maxlength="3" id="new_mb_zipcode0" name="new_mb_zipcode[]" readonly hname="우편번호 앞자리" value="<?php echo $mb_zipcode[0];?>">
							<span class="delimiter">-</span>
							<input type="text" style="width:55px;" class="tnum" title="우편번호 뒷자리" maxlength="4" id="new_mb_zipcode1" name="new_mb_zipcode[]" readonly hname="우편번호 뒷자리" value="<?php echo $mb_zipcode[1];?>">
							<a class="btn" style="padding:0 10px;" onclick="new_postSearchPops('individual');"><span>우편번호 검색</span></a>
							<div class="adress2 mt3">
								<input type="text" class="txt w100 mb3" title="주소" id="new_mb_address0" name="new_mb_address0" hname="주소" value="<?php echo $member['mb_address0'];?>">
								<input type="text" class="txt w100" title="상세주소" id="new_mb_address1" name="new_mb_address1" hname="상세주소" value="<?php echo $member['mb_address1'];?>">
							</div>
						</div>

						<div class="addresWrap" id="old_address_block" style="display:<?php echo $old_address_block;?>;">
							<input type="text" style="width:55px;" class="tnum" title="우편번호 앞자리" maxlength="3" id="mb_zipcode0" name="mb_zipcode[]" readonly hname="우편번호 앞자리" value="<?php echo $mb_zipcode[0];?>">
							<span class="delimiter">-</span>
							<input type="text" style="width:55px;" class="tnum" title="우편번호 뒷자리" maxlength="4" id="mb_zipcode1" name="mb_zipcode[]" readonly hname="우편번호 뒷자리" value="<?php echo $mb_zipcode[1];?>">
							<a class="btn" style="padding:0 10px;" onclick="postSearchPops('individual');"><span>우편번호 검색</span></a>
							<div class="adress2 mt3">
								<input type="text" class="txt w100 mb3" title="주소" id="mb_address0" name="mb_address0" hname="주소" value="<?php echo $member['mb_address0'];?>">
								<input type="text" class="txt w100" title="상세주소" id="mb_address1" name="mb_address1" hname="상세주소" value="<?php echo $member['mb_address1'];?>">
							</div>
						</div>
					</td>
				</tr>
				<tr class="input_type_self" style="display:<?php echo ($input_type=='self'||!$input_type)?'':'none';?>;">
					<td class="ctlt">이메일 <b class="col">*</b></td>
					<td class="pdlnb2">
						<input name="mb_email" type="text" class="txt w50" value="<?php echo $member['mb_email'];?>" hname='이메일'>
					</td>
				</tr>
				<tr class="input_type_load" style="display:none;">
					<td class="ctlt">회원선택 <b class="col">*</b></td>
					<td class="pdlnb2">
						<dt>
							<select name="mb_id" id="mb_id" style="width:258px;" onchange="get_member(this.value);">
							<option value="">개인회원 선택</option>
							<?php foreach($member_list['result'] as $val){ ?>
							<option value="<?php echo $val['mb_id'];?>" <?php echo ($val['mb_id']==$mb_id)?'selected':'';?>><?php echo $val['mb_id'];?> / <?php echo $val['mb_name'];?></option>
							<?php } ?>
							</select>
							<!-- <a href="../member/individual.php?mode=insert" class="btn"><h1 class="btn23">회원등록</h1></a> -->
							<input name="mb_search" type="text" class="txt" style="width:150px;" id="mb_search">
							<a onClick="search_member();" class="cbtn lnb_col grf_col"><h1 class="btn19">회원검색</h1></a>
							<span class="subtlt">이름,아이디,이메일로 검색</span>
							<ul id="memlist" style="display:none;max-height:100px;overflow-y:auto" class="blnb wbg pd3 f11 mt5">
							<!-- loop -->
							<li style="line-height:20px" onMouseOver="this.className='bg hand'" onMouseOut="this.className=''" onClick="MM_showHideLayers('memlist','','hide')"><b>ㆍ</b>이름(아이디) / 이메일</li>
							<!-- loop -->
						</dt>
					</td>
				</tr>
				<tr id="resume_block" class="input_type_load" style="display:none;">
					<td class="ctlt">이력서선택 </td>
					<td class="pdlnb2" id="resume_load">
					<?php $resume_list = $alba_resume_control->get_resume_for_id($mb_id); ?>
						<select name='sel_alba' id='sel_alba' onchange="update_resume('load',this.value,'<?php echo $mb_id;?>');">
						<option value=''>이력서선택</option>
						<?php
						foreach($resume_list as $val){
							$selected = ($no == $val['no']) ? 'selected' : '';
							echo "<option value='".$val['no']."' ".$selected.">".stripslashes($val['wr_subject'])."</option>";
						}
						?>
						</select>
					</td>
				</tr>

				<tr>
					<td class="ctlt">이력서제목<b class="col">*</b></td>
					<td class="pdlnb2">
						<input type="text" class="txt w100" id="wr_subject" name="wr_subject" required hname="이력서제목" value="<?php echo $get_resume['wr_subject'];?>">
					</td>
				</tr>
				<tr>
					<td class="ctlt">근무지<b class="col">*</b></td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:168px;" id="wr_area00" name="wr_area0" title="시·도 선택" onchange="insert_area_sel_first(this,'wr_area_01');" required hname="근무지 시·도">
						<option value=""> -- 시·도 --</option>
						<?php 
							foreach($area_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_area0 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<span id="wr_area_01_display">
							<select class="ipSelect" style="width:168px;" id="wr_area_01" name="wr_area1" title="시·군·구 선택">
							<option value=""> -- 시·군·구 --</option>
							<?php
							if($wr_area0){
								$pcodeList = $category_control->category_pcodeList('area', $wr_area0);
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area1 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							} else {
							?>
								<option value="">시·도 를 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>
						<em >
							<input type="checkbox" class="typeCheckbox" id="wr_home_work" name="wr_home_work" value="1" <?php echo ($get_resume['wr_home_work'])?'checked':'';?>>
							<label for="wr_home_work">재택근무가능</label>
						</em>
						<div class='mt3'>
							<select class="ipSelect" style="width:168px;" id="wr_area01" name="wr_area2" title="시·도 선택" onchange="insert_area_sel_first(this,'wr_area_03');" required hname="근무지 시·도">
							<option value=""> -- 시·도 --</option>
							<?php 
								foreach($area_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area2 == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php } ?>
							</select>
							<span id="wr_area_03_display">
								<select class="ipSelect" style="width:168px;" id="wr_area_03" name="wr_area3" title="시·군·구 선택">
								<option value=""> -- 시·군·구 --</option>
								<?php
								if($wr_area2){
									$pcodeList = $category_control->category_pcodeList('area', $wr_area2);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_area3 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">시·도 를 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>
						</div>
						<div class='mt3'>
							<select class="ipSelect" style="width:168px;" id="wr_area04" name="wr_area4" title="시·도 선택" onchange="insert_area_sel_first(this,'wr_area_05');" required hname="근무지 시·도">
							<option value=""> -- 시·도 --</option>
							<?php 
								foreach($area_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area4 == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php } ?>
							</select>
							<span id="wr_area_05_display">
								<select class="ipSelect" style="width:168px;" id="wr_area_05" name="wr_area5" title="시·군·구 선택">
								<option value=""> -- 시·군·구 --</option>
								<?php
								if($wr_area4){
									$pcodeList = $category_control->category_pcodeList('area', $wr_area4);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_area5 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">시·도 를 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<td class="ctlt">업직종<b class="col">*</b></td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:110px;" id="wr_job_type0" name="wr_job_type0" title="1차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type1');" required hname="1차직종">
						<option value="">1차직종선택</option>
						<?php 
							foreach($job_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_job_type0 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<span id="wr_job_type1_display">
							<select class="ipSelect" style="width:110px;" id="wr_job_type1" name="wr_job_type1" title="2차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type2');">
							<option value="">2차직종선택</option>
							<?php
							if($wr_job_type1){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type0);
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_job_type1 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							} else {
							?>
								<option value="">1차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>
						<span id="wr_job_type2_display">
							<select class="ipSelect" style="width:110px;" id="wr_job_type2" name="wr_job_type2" title="3차직종선택">
							<option value="">3차직종선택</option>
							<?php
							if($wr_job_type2){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type1);
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_job_type2 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							} else {
							?>
								<option value="">2차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>
						<div class="mt3">
							<select class="ipSelect" style="width:110px;" id="wr_job_type3" name="wr_job_type3" title="1차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type4');" required hname="1차직종">
							<option value="">1차직종선택</option>
							<?php 
								foreach($job_type_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_job_type3 == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php } ?>
							</select>
							<span id="wr_job_type4_display">
								<select class="ipSelect" style="width:110px;" id="wr_job_type4" name="wr_job_type4" title="2차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type4');">
								<option value="">2차직종선택</option>
								<?php
								if($wr_job_type1){
									$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type0);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type4 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">1차 직종을 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>
							<span id="wr_job_type5_display">
								<select class="ipSelect" style="width:110px;" id="wr_job_type5" name="wr_job_type5" title="3차직종선택">
								<option value="">3차직종선택</option>
								<?php
								if($wr_job_type2){
									$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type1);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type5 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">2차 직종을 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>
						</div>
						<div class="mt3">
							<select class="ipSelect" style="width:110px;" id="wr_job_type6" name="wr_job_type6" title="1차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type7');" required hname="1차직종">
							<option value="">1차직종선택</option>
							<?php 
								foreach($job_type_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_job_type3 == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php } ?>
							</select>
							<span id="wr_job_type7_display">
								<select class="ipSelect" style="width:110px;" id="wr_job_type7" name="wr_job_type7" title="2차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type8');">
								<option value="">2차직종선택</option>
								<?php
								if($wr_job_type1){
									$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type0);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type4 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">1차 직종을 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>
							<span id="wr_job_type8_display">
								<select class="ipSelect" style="width:110px;" id="wr_job_type8" name="wr_job_type8" title="3차직종선택">
								<option value="">3차직종선택</option>
								<?php
								if($wr_job_type2){
									$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type1);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type5 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">2차 직종을 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<td class="ctlt">근무일시<b class="col">*</b></td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:110px;" id="wr_date" name="wr_date" title="근무기간" required hname="근무기간">
						<option value=""> -- 근무기간 --</option>
						<?php 
							foreach($alba_date_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_resume['wr_date'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<select class="ipSelect" style="width:110px;" id="wr_week" name="wr_week" title="근무요일" required hname="근무요일">
						<option value=""> -- 근무요일 --</option>
						<?php 
							foreach($alba_week_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_resume['wr_week'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<select class="ipSelect" style="width:110px;" id="wr_time" name="wr_time" title="근무시간" required hname="근무시간">
						<option value=""> -- 근무시간 --</option>
						<?php 
							foreach($alba_time_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_resume['wr_time'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<em>
							<input type="checkbox" class="typeCheckbox" id="wr_work_direct" name="wr_work_direct" value="1" <?php echo ($get_resume['wr_work_direct'])?'checked':'';?>>
							<label for="wr_work_direct">즉시출근가능</label>
						</em>
					</td>
				</tr>
				<tr>
					<td class="ctlt">급여<b class="col">*</b></td>
					<td class="pdlnb2">
						<select style="width:89px;" name="wr_pay_type" id="wr_pay_type" class="ipSelect" <?php echo ($get_resume['wr_pay_conference'])?'disabled':'required';?> hname="급여조건">
						<option value="">= 급여 =</option>
						<?php 
							foreach($alba_pay_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_resume['wr_pay_type'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<input style="110px;" type="text" name="wr_pay" id="wr_pay" class="txt" maxlength="10" style="ime-mode:inactive;" <?php echo ($get_resume['wr_pay_conference'])?'disabled':'required';?> hname="급여금액" value="<?php echo $get_resume['wr_pay'];?>" placeholder="0" data-v-min="0" data-v-max="10000000000">
						<label>원</label>
						<em class="pl10 pb3"> 
							<input type="checkbox" name="wr_pay_conference" id="wr_pay_conference" class="chk" value="1" onclick="pay_conference(this);" <?php echo ($get_resume['wr_pay_conference'])?'checked':'';?>>
							<label for="wr_pay_conference">추후협의</label>
						</em>
						<?php if($env['pay_view']){?><em class="text_help"> 최저임금 : 시급 <strong class="txtEng"><?php echo number_format($env['time_pay']);?>원</strong></em><?php } ?>
					</td>
				</tr>
				<tr>
					<td class="ctlt">근무형태<b class="col">*</b></td>
					<td class="pdlnb2">
						<ul>
						<?php 
							foreach($work_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_work_type)) ? "checked" : "";
						?>
							<li class="fl pr10">
								<input type="checkbox" name="wr_work_type[]" id="wr_work_type_<?php echo $val['code'];?>" class="chk" value="<?php echo $val['code'];?>" required hname="근무형태" <?php echo $checked;?>>
								<label for="wr_work_type_<?php echo $val['code'];?>"><?php echo $name;?></label>
							</li>
						<?php } ?>
						</ul>
					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">최종학력<b class="col">*</b></td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:223px;" id="wr_school_ability" name="wr_school_ability" title="학력" onchange="school_ability(this);" <?php echo ($form_ability['etc_0'])?'required':'';?> hname="학력">
						<option value=""> -- 학력선택 --</option>
						<?php
							foreach($indi_ability_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_school_ability[0] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code']."/".$val['rank'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<em class="pl10 pb3"> 
							<input type="checkbox" name="wr_school_absence" id="wr_school_absence" class="chk" value="1" <?php echo ($get_resume['wr_school_absence'])?'checked':'';?>>
							<label for="wr_school_absence">휴학중</label>
						</em>
						<div class="schoolSelect pt5" id="schoolSelect" style="display:<?php echo ($schoolSelect_view)?'':'none';?>;">
							<em class="text_help"> 입력할 학력선택:</em>
							<span>
								<input type="checkbox" name="wr_school_type[]" class="chk" id="school_type0" value="high_school" onclick="school_types(this);" <?php echo ($mode=='update'||$mode=='load')?$high_school_disabled:'disabled';?> <?php echo $high_school_checked;?>>
								<label for="school_type0">고등학교</label>
								<input type="checkbox" name="wr_school_type[]" class="chk" id="school_type1" value="half_college" onclick="school_types(this);" <?php echo ($mode=='update'||$mode=='load')?$half_college_disabled:'disabled';?> <?php echo $half_college_checked;?>>
								<label for="school_type1">대학(2,3년)</label>
								<input type="checkbox" name="wr_school_type[]" class="chk" id="school_type2" value="college" onclick="school_types(this);" <?php echo ($mode=='update'||$mode=='load')?$college_disabled:'disabled';?> <?php echo $college_checked;?>>
								<label for="school_type2">대학교(4년)</label>
								<input type="checkbox" name="wr_school_type[]" class="chk" id="school_type3" value="graduate" onclick="school_types(this);" disabled <?php echo $graduate_checked;?>>
								<label for="school_type3">대학원</label>
							</span>
						</div>
					</td>
				</tr>
				<tr id="ability_high_school" style="display:<?php echo ($mode=='update'||$mode=='load')?$high_school_display:'none';?>;">
				<?php if($mode=='insert'){ ?>
					<td scope="row"  class="ctlt"> <label><strong>고등학교</strong></label></td>
					<td class="pdlnb2">
						<div class="school1">
							<ul>
								<li class="pb5 positionR">
									<input class="txt" type="text" name="wr_high_school_name" id="wr_high_school_name" value="출신학교 입력" style="width:100px;">

									<select name="wr_high_school_syear" class="ipSelect">
									<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
									</select> 
									년 ~ 
									<span id="high_school_eyear_block">
										<select name="wr_high_school_eyear" class="ipSelect">
										<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
										</select>
										년
									</span>
									<span id="high_school_eyear_now">현재</span>
									<select name="wr_high_school_graduation" id="wr_high_school_graduation" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0">졸업</option>
									<option value="1">재학</option>
									</select>
								</li>
							</ul>
						</div>
					</td>
				<?php } else if($mode=='update'||$mode=='load'){ // 수정/불러오기 일때 ?>
					<td scope="row" class="ctlt"> <label><strong>고등학교</strong></label></td>
					<td class="pdlnb2">
						<div class="school1">
							<ul>
								<li class="pb5 positionR">
									<input class="txt" type="text" name="wr_high_school_name" id="wr_high_school_name" value="<?php echo ($get_resume['wr_high_school_name'])?$get_resume['wr_high_school_name']:"출신학교 입력";?>" style="width:100px;">

									<select name="wr_high_school_syear" class="ipSelect">
									<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($get_resume['wr_high_school_syear']==$i)?'selected':'';?>><?=$i?></option>
									<?php } ?>
									</select> 
									년 ~ 
									<span id="high_school_eyear_block">
										<select name="wr_high_school_eyear" class="ipSelect">
										<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($get_resume['wr_high_school_eyear']==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
										</select>
										년
									</span>
									<span id="high_school_eyear_now">현재</span>
									<select name="wr_high_school_graduation" id="wr_high_school_graduation" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0" <?php echo ($get_resume['wr_high_school_graduation']=='0')?'selected':'';?>>졸업</option>
									<option value="1" <?php echo ($get_resume['wr_high_school_graduation']=='1')?'selected':'';?>>재학</option>
									</select>
								</li>
							</ul>
						</div>
					</td>
				<?php } ?>
				</tr>
				<tr id="ability_half_college" style="display:<?php echo ($mode=='update'||$mode=='load')?$half_college_display:'none';?>;">
					<td scope="row" class="ctlt"> <label><strong>대학(2,3년)</strong></label></td>
					<td class="pdlnb2">
						<div class="school1 positionR">
							<ul id="half_college_block">
							<?php if($mode=='insert' || ($mode=='update' && !$wr_half_college) ){ ?>
								<li class="pb5 positionR">
									<input class="txt graduate" type="text" name="wr_half_college[]" id="wr_half_college_0" style="width:100px;" value="출신학교 입력">
									<input class="txt specialize" type="text" name="wr_half_college_specialize[]" id="wr_half_college_specialize_0" style="width:80px;" value="전공입력">

									<select name="wr_half_college_syear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
									</select> 
									년 ~ 
									<span id="half_college_eyear_block_0">
										<select name="wr_half_college_eyear[]" class="ipSelect">
										<option value="">년도</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>'><?=$i?></option>
											<?php } ?>
										</select>
										년
									</span>
									<span id="half_college_eyear_now_0">현재</span>
									<select name="wr_half_college_graduation[]" id="wr_half_college_graduation_0" class="ipSelect">
										<option value="">졸업여부</option>
										<option value="0">졸업</option>
										<option value="1">재학</option>
										<option value="2">중퇴</option>
									</select>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="half_college_add();"><span>+추가</span></a></em>
								</li>
							<?php // 수정시
							} else if($mode=='update'||$mode=='load'){ 
								if($wr_half_college){
									for($j=0;$j<$wr_half_college_cnt;$j++){
									$school_name = $wr_half_college['college'][$j];
									$school_specialize = $wr_half_college['college_specialize'][$j];
									$school_syear = $wr_half_college['college_syear'][$j];
									$school_eyear = $wr_half_college['college_eyear'][$j];
									$school_graduation = $wr_half_college['college_graduation'][$j];
							?>
								<li class="pb5 positionR" id="half_college_<?php echo $j;?>">
									<input class="txt graduate" type="text" name="wr_half_college[]" id="wr_half_college_<?php echo $j;?>" style="width:100px;" value="<?php echo ($school_name)?$school_name:'출신학교 입력';?>">
									<input class="txt specialize" type="text" name="wr_half_college_specialize[]" id="wr_half_college_specialize_<?php echo $j;?>" style="width:80px;" value="<?php echo ($school_specialize)?$school_specialize:'전공입력';?>">

									<select name="wr_half_college_syear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($school_syear==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
									</select> 
									년 ~ 
									<span id="half_college_eyear_block_<?php echo $j;?>">
										<select name="wr_half_college_eyear[]" class="ipSelect">
										<option value="">년도</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>' <?php echo ($school_eyear==$i)?'selected':'';?>><?=$i?></option>
											<?php } ?>
										</select>
										년
									</span>
									<span id="half_college_eyear_now_<?php echo $j;?>">현재</span>
									<select name="wr_half_college_graduation[]" id="wr_half_college_graduation_<?php echo $j;?>" class="ipSelect">
										<option value="">졸업여부</option>
										<option value="0" <?php echo ($school_graduation=='0')?'selected':'';?>>졸업</option>
										<option value="1" <?php echo ($school_graduation=='1')?'selected':'';?>>재학</option>
										<option value="2" <?php echo ($school_graduation=='2')?'selected':'';?>>중퇴</option>
									</select>
									<?php if($j==0){ ?>
										<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="half_college_add();"><span>+추가</span></a></em>
									<?php } else {?>
										<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="half_college_remove('<?php echo $j;?>');"><span>-제거</span></a></em>
									<?php } ?>
								</li>
							<?php 
									}	// wr_half_college for end.
								}	// wr_half_college if end.
							}	// if end.
							?>
							</ul>
						</div>
					</td>
				</tr>

				<tr id="ability_college" style="display:<?php echo ($mode=='update'||$mode=='load')?$college_display:'none';?>;">
					<td scope="row" class="ctlt"> <label><strong>대학(4년)</strong></label></td>
					<td class="pdlnb2">
						<div class="school1 positionR">
							<ul id="college_block">
							<?php if($mode=='insert' || ($mode=='update' && !$wr_college)){ ?>
								<li class="pb5 positionR">
									<input class="txt graduate" type="text" name="wr_college[]" id="wr_college_0" style="width:100px;" value="출신학교 입력">
									<input class="txt specialize" type="text" name="wr_college_specialize[]" id="wr_college_specialize_0" style="width:80px;" value="전공입력">

									<select name="wr_college_syear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
									</select> 
									년 ~ 
									<span id="college_eyear_block_0">
										<select name="wr_college_eyear[]" class="ipSelect">
										<option value="">년도</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>'><?=$i?></option>
											<?php } ?>
										</select>
										년
									</span>
									<span id="college_eyear_now_0">현재</span>
									<select name="wr_college_graduation[]" id="wr_college_graduation_0" class="ipSelect">
										<option value="">졸업여부</option>
										<option value="0">졸업</option>
										<option value="1">재학</option>
										<option value="2">중퇴</option>
									</select>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="college_add();"><span>+추가</span></a></em>
								</li>
							<?php // 수정시
							} else if($mode=='update'||$mode=='load'){ 
								if($wr_college){
									for($j=0;$j<$wr_college_cnt;$j++){
									$school_name = $wr_college['college'][$j];
									$school_specialize = $wr_college['college_specialize'][$j];
									$school_syear = $wr_college['college_syear'][$j];
									$school_eyear = $wr_college['college_eyear'][$j];
									$school_graduation = $wr_college['college_graduation'][$j];
							?>
								<li class="pb5 positionR" id="college_<?php echo $j;?>">
									<input class="txt graduate" type="text" name="wr_college[]" id="wr_college_<?php echo $j;?>" style="width:100px;" value="<?php echo ($school_name)?$school_name:'출신학교 입력';?>">
									<input class="txt specialize" type="text" name="wr_college_specialize[]" id="wr_college_specialize_<?php echo $j;?>" style="width:80px;" value="<?php echo ($school_specialize)?$school_specialize:'전공입력';?>">

									<select name="wr_college_syear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($school_syear==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
									</select> 
									년 ~ 
									<span id="college_eyear_block_<?php echo $j;?>">
										<select name="wr_college_eyear[]" class="ipSelect">
										<option value="">년도</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>' <?php echo ($school_eyear==$i)?'selected':'';?>><?=$i?></option>
											<?php } ?>
										</select>
										년
									</span>
									<span id="college_eyear_now_<?php echo $j;?>">현재</span>
									<select name="wr_college_graduation[]" id="wr_college_graduation_<?php echo $j;?>" class="ipSelect">
										<option value="">졸업여부</option>
										<option value="0" <?php echo ($school_graduation=='0')?'selected':'';?>>졸업</option>
										<option value="1" <?php echo ($school_graduation=='1')?'selected':'';?>>재학</option>
										<option value="2" <?php echo ($school_graduation=='2')?'selected':'';?>>중퇴</option>
									</select>
									<?php if($j==0){ ?>
										<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="college_add();"><span>+추가</span></a></em>
									<?php } else { ?>
										<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="college_remove('<?php echo $j;?>');"><span>-제거</span></a></em>
									<?php } ?>
								</li>
							<?php
									}	// for end.
								}	// wr_college if end.
							}	// if end.
							?>
							</ul>
						</div>
					</td>
				</tr>

				<tr id="ability_graduate" style="display:<?php echo ($mode=='update'||$mode=='load')?$graduate_display:'none';?>;">
					<td scope="row" class="ctlt"> <label><strong>대학원</strong></label></td>
					<td class="pdlnb2">
						<div class="school1 positionR">
							<ul id="graduate_block">
							<?php if($mode=='insert' || ($mode=='update' && !$wr_graduate)){ ?>
								<li class="pb5 positionR">
									<input class="txt graduate" type="text" name="wr_graduate[]" id="wr_graduate_0" style="width:100px;" value="출신학교 입력">
									<input class="txt specialize" type="text" name="wr_graduate_specialize[]" id="wr_graduate_specialize_0" style="width:80px;" value="전공입력">

									<select name="wr_graduate_grade[]" class="ipSelect">
									<option value="">학위</option>
									<option value='0'>석사</option>
									<option value='1'>박사</option>
									</select> 

									<select name="wr_graduate_syear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
									</select> 
									년 ~ 
									<span id="graduate_eyear_block_0">
										<select name="wr_graduate_eyear[]" class="ipSelect">
										<option value="">년도</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>'><?=$i?></option>
											<?php } ?>
										</select>
										년
									</span>
									<span id="graduate_eyear_now_0">현재</span>
									<select name="wr_graduate_graduation[]" id="wr_graduate_graduation_0" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0">졸업</option>
									<option value="1">수료</option>
									<option value="2">재학</option>
									<option value="3">중퇴</option>
									</select>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="graduate_add();"><span>+추가</span></a></em>
								</li>
							<?php // 수정시
							} else if($mode=='update'||$mode=='load'){ 
								if($wr_graduate){
									for($j=0;$j<$wr_graduate_cnt;$j++){
									$school_name = $wr_graduate['graduate'][$j];
									$school_specialize = $wr_graduate['graduate_specialize'][$j];
									$school_grade = $wr_graduate['graduate_grade'][$j];
									$school_syear = $wr_graduate['graduate_syear'][$j];
									$school_eyear = $wr_graduate['graduate_eyear'][$j];
									$school_graduation = $wr_graduate['graduate_graduation'][$j];
							?>
								<li class="pb5 positionR" id="graduate_<?php echo $j;?>">
									<input class="txt graduate" type="text" name="wr_graduate[]" id="wr_graduate_<?php echo $j;?>" style="width:100px;" value="<?php echo ($school_name)?$school_name:'출신학교 입력';?>">
									<input class="txt specialize" type="text" name="wr_graduate_specialize[]" id="wr_graduate_specialize_<?php echo $j;?>" style="width:80px;" value="<?php echo ($school_specialize)?$school_specialize:'전공입력';?>">

									<select name="wr_graduate_grade[]" class="ipSelect">
									<option value="">학위</option>
									<option value='0' <?php echo ($school_grade=='0')?'selected':'';?>>석사</option>
									<option value='1' <?php echo ($school_grade=='1')?'selected':'';?>>박사</option>
									</select> 

									<select name="wr_graduate_syear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($school_syear==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
									</select> 
									년 ~ 
									<?php if($school_graduation=='2'){	 // 재학중 이라면 ?>
									<span id="graduate_eyear_now_<?php echo $j;?>">현재</span>
									<?php } else { ?>
									<span id="graduate_eyear_block_<?php echo $j;?>">
										<select name="wr_graduate_eyear[]" class="ipSelect">
										<option value="">년도</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>' <?php echo ($school_eyear==$i)?'selected':'';?>><?=$i?></option>
											<?php } ?>
										</select>
										년
									</span>
									<?php } ?>
									<select name="wr_graduate_graduation[]" id="wr_graduate_graduation_<?php echo $j;?>" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0" <?php echo ($school_graduation=='0')?'selected':'';?>>졸업</option>
									<option value="1" <?php echo ($school_graduation=='1')?'selected':'';?>>수료</option>
									<option value="2" <?php echo ($school_graduation=='2')?'selected':'';?>>재학</option>
									<option value="3" <?php echo ($school_graduation=='3')?'selected':'';?>>중퇴</option>
									</select>
									<?php if($j==0){ ?>
										<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="graduate_add();"><span>+추가</span></a></em>
									<?php } else { ?>
										<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="graduate_remove('<?php echo $j;?>');"><span>-제거</span></a></em>
									<?php } ?>
								</li>
							<?php
									}	// for end.
								}	// wr_college if end.
							}	// if end.
							?>
							</ul>
						</div>
					</td>
				</tr>

				<tr id="ability_success" style="display:none;">
					<td scope="row" class="ctlt"> <label><strong>대학원</strong></label></td>
					<td class="pdlnb2">
						<div class="school1 positionR">
							<ul id="success_block">

								<li class="pb5 positionR">
									<input class="txt graduate" type="text" name="wr_success[]" id="wr_success_0" style="width:100px;" value="출신학교 입력">
									<input class="txt specialize" type="text" name="wr_success_specialize[]" id="wr_success_specialize_0" style="width:80px;" value="전공입력">

									<select name="wr_success_grade[]" class="ipSelect">
									<option value="">학위</option>
									<option value='0'>석사</option>
									<option value='1'>박사</option>
									</select> 

									<select name="wr_success_syear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
									</select> 
									년 ~ 
									<span id="success_eyear_block_0">
										<select name="wr_success_eyear[]" class="ipSelect">
										<option value="">년도</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>'><?=$i?></option>
											<?php } ?>
										</select>
										년
									</span>
									<select name="wr_success_graduation[]" id="wr_success_graduation_0" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0">졸업</option>
									<option value="1">수료</option>
									<option value="2">재학</option>
									<option value="3">중퇴</option>
									</select>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="success_add();"><span>+추가</span></a></em>
								</li>

							</ul>
						</div>
					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">경력사항</td>
					<td class="pdlnb2">
						<input type="checkbox" name="wr_career_use" id="wr_career_use" class="chk" value="1" onclick="use_career(this);" <?php echo ($wr_career_use)?'checked':'';?> hname="경력사항" option="checkbox">
						<label for="wr_career_use"><strong>경력있음</strong></label>
						<em style="right:0; top:0;display:<?php echo ($wr_career_use)?'':'none';?>;" class="insert" id="career_add"> <a class="button white" onclick="career_add();"><span>+추가</span></a></em>
					</td>
				</tr>
				<tbody id="career_block">

				<?php if($mode=='insert' || ($mode=='update' && !$wr_career)){ ?>
				<tr class="wr_career_block" id="wr_career_block_0" style="display:none;">
					<td scope="row"  class="ctlt"> <label><strong>경력사항</strong></label></td>
					<td class="pdlnb2">
						<div class="career1 positionR">
							<ul>
								<li class="pb5 positionR">
								<table border="0" width="100%">
								<colgroup><col width="200px"><col></colgroup>
								<tbody>
								<tr>
									<td>
										<span>
										<label>회사명<b class="col">*</b></label>
										<input class="txt career_required" type="text" name="wr_career_company[]" id="wr_career_company_0" style="width:470px;" hname="회사명">
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<span><label>근무직종<b class="col">*</b></label></span>
										<select class="ipSelect career_required" style="width:110px;" name="wr_career_type_0[]" id="wr_career_type_0_0" title="1차직종선택" onchange="career_type_sel_first(this,'wr_career_type_0_1');" hname="1차직종">
										<option value="">1차직종선택</option>
										<?php 
											foreach($job_type_list as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										?>
										<option value="<?php echo $val['code'];?>"><?php echo $name;?></option>
										<?php } ?>
										</select>
										<span id="wr_career_type_0_1_display">
											<select class="ipSelect" style="width:110px;" name="wr_career_type_0[]" id="wr_career_type_0_1" title="2차직종선택" onchange="career_type_sel_first(this,'wr_career_type_0_2');">
											<option value="">2차직종선택</option>
											<option value="">1차 직종을 먼저 선택해 주세요</option>
											</select>
										</span>
										<span id="wr_career_type_0_2_display">
											<select class="ipSelect" style="width:110px;" name="wr_career_type_0[]" id="wr_career_type_0_2" title="3차직종선택">
											<option value="">3차직종선택</option>
											<option value="">2차 직종을 먼저 선택해 주세요</option>
											</select>
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<label>근무기간<b class="col">*</b></label>
										<select style="width:80px;" name="wr_career_syear[]" class="ipSelect career_required" hname="근무기간">
										<option value="">년</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
										</select> 
										<select style="width:75px;" name="wr_career_smonth[]" class="ipSelect career_required" hname="근무기간">
										<option value="">월</option>
										<?php for($i=1;$i<=12;$i++){?>
										<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
										</select>
										 ~
										<select style="width:80px;" name="wr_career_eyear[]" class="ipSelect career_required" hname="근무기간">
										<option value="">년</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
										</select> 
										<select style="width:75px;" name="wr_career_emonth[]" class="ipSelect career_required" hname="근무기간">
										<option value="">월</option>
										<?php for($i=1;$i<=12;$i++){?>
										<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td >
										<label>담당업무<b class="col">*</b></label>
										<input  class="txt career_required" type="text" name="wr_career_job[]" id="wr_career_job_0" style="width:470px;" hname="담당업무">
									</td>
								</tr>
								<tr>
									<td>
										<label>상세업무</label>
										<textarea class="txtarea" name="wr_career_content[]" id="wr_career_content_0" style="border:1px solid #ddd; width:450px; height:50px; padding:10px;"></textarea>
										<!-- (<span id="career_content_bytes_0">0</span>/100자)  onKeyUp="CountCharText(this, 30, 'career_content_bytes_0');" -->
									</td>
								</tr>
								</tbody>
								</table>
								</li>
							</ul>
						</div>
					</td>
				</tr>
				<?php // 수정시 
				} else if($mode=='update'){ 
				if($wr_career) {
					foreach($wr_career as $ckey => $cval){
					$job_type_0 = $cval['type'][0];
					$job_type_1 = $cval['type'][1];
					$job_type_2 = $cval['type'][2];
					$sdate = explode('-',$cval['sdate']);
					$edate = explode('-',$cval['edate']);
				?>
				<tr class="wr_career_block" id="wr_career_block_<?php echo $ckey;?>">
					<td scope="row"  class="ctlt"> <label><strong>경력사항</strong></label></td>
					<td  class="pdlnb2">
						<div class="career1 positionR">
							<ul>
								<li class="pb5 positionR">
								<?php if($ckey!=0){?>
								<em style="right:0; top:5px;" class="positionA delete"> <a class="button white" onclick="career_remove('<?php echo $ckey;?>');"><span>-삭제</span></a></em>
								<?php } ?>
								<table>
								<colgroup><col width="200px"><col width="*"></colgroup>
								<tbody>
								<tr>
									<td>
										<span>
										<label>회사명<b class="col">*</b></label>
										<input class="txt career_required" type="text" name="wr_career_company[]" id="wr_career_company_<?php echo $ckey;?>" style="width:135px;" hname="회사명" value="<?php echo $cval['company'];?>">
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<span><label>근무직종<b class="col">*</b></label></span>
										<select class="ipSelect career_required" style="width:110px;" name="wr_career_type_<?php echo $ckey;?>[]" id="wr_career_type_<?php echo $ckey;?>_0" title="1차직종선택" onchange="career_type_sel_first(this,'wr_career_type_<?php echo $ckey;?>_1');" hname="1차직종">
										<option value="">1차직종선택</option>
										<?php 
											foreach($job_type_list as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($job_type_0 == $val['code']) ? "selected" : "";
										?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
										<?php } ?>
										</select>
										<span id="wr_career_type_<?php echo $ckey;?>_1_display">
											<select class="ipSelect" style="width:110px;" name="wr_career_type_<?php echo $ckey;?>[]" id="wr_career_type_<?php echo $ckey;?>_1" title="2차직종선택" onchange="career_type_sel_first(this,'wr_career_type_<?php echo $ckey;?>_2');">
											<option value="">2차직종선택</option>
											<?php
											if($job_type_1){
												$pcodeList = $category_control->category_pcodeList('job_type', $job_type_0);
												foreach($pcodeList as $val){ 
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$selected = ($job_type_1 == $val['code']) ? "selected" : "";
											?>
												<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
											<?php 
												}	// foreach end.
											} else {
											?>
												<option value="">1차 직종을 먼저 선택해 주세요</option>
											<?php
											}	// if end.
											?>
											</select>
										</span>
										<span id="wr_career_type_<?php echo $ckey;?>_2_display">
											<select class="ipSelect" style="width:110px;" name="wr_career_type_<?php echo $ckey;?>[]" id="wr_career_type_<?php echo $ckey;?>_2" title="3차직종선택">
											<option value="">3차직종선택</option>
											<?php
											if($job_type_2){
												$pcodeList = $category_control->category_pcodeList('job_type', $job_type_1);
												foreach($pcodeList as $val){ 
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$selected = ($job_type_2 == $val['code']) ? "selected" : "";
											?>
												<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
											<?php 
												}	// foreach end.
											} else {
											?>
												<option value="">2차 직종을 먼저 선택해 주세요</option>
											<?php
											}	// if end.
											?>
											</select>
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<label>근무기간<b class="col">*</b></label>
										<select style="width:80px;" name="wr_career_syear[]" class="ipSelect career_required" hname="근무기간">
										<option value="">년</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($sdate[0]==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
										</select> 
										<select style="width:75px;" name="wr_career_smonth[]" class="ipSelect career_required" hname="근무기간">
										<option value="">월</option>
										<?php for($i=1;$i<=12;$i++){?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($sdate[1]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
										</select>
										 ~
										<select style="width:80px;" name="wr_career_eyear[]" class="ipSelect career_required" hname="근무기간">
										<option value="">년</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($edate[0]==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
										</select> 
										<select style="width:75px;" name="wr_career_emonth[]" class="ipSelect career_required" hname="근무기간">
										<option value="">월</option>
										<?php for($i=1;$i<=12;$i++){?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($edate[1]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>담당업무<b class="col">*</b></label>
										<input class="txt career_required" type="text" name="wr_career_job[]" id="wr_career_job_<?php echo $ckey;?>" style="width:135px;" hname="담당업무" value="<?php echo $cval['job'];?>">
									</td>
								</tr>
								<tr>
									<td>
										<label>상세업무</label>
										<textarea class="txtarea" name="wr_career_content[]" id="wr_career_content_<?php echo $ckey;?>" style="width:450px; height:50px; padding:10px;" onKeyUp="CountCharText(this, 30, 'career_content_bytes_<?php echo $ckey;?>');"><?php echo nl2br(stripslashes($cval['content']));?></textarea>
										(<span id="career_content_bytes_<?php echo $ckey;?>">0</span>/100자)
									</td>
								</tr>
								<script>
								var career_content_<?php echo $ckey;?> = document.getElementById("wr_career_content_<?php echo $ckey;?>");
								CountCharText(career_content_<?php echo $ckey;?>,30,'career_content_bytes_<?php echo $ckey;?>');
								</script>
								</tbody>
								</table>
								</li>
							</ul>
						</div>
					</td>
				</tr>
				<?php
						}	// foreach end.
					}	// foreach if end.
				}	// if end.
				?>
				</tbody>

				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tbody id="license_block">
					<tr>
						<td class="ctlt">보유자격증</td>
						<td class="pdlnb2">
							<input type="checkbox" name="wr_license_use"  id="wr_license_use" class="chk" value="1" onclick="use_license(this);" <?php echo ($wr_license_use)?'checked':'';?> <?php echo ($form_license['etc_0'])?'required':'';?> hname="자격증" option="checkbox">
							<label for="wr_license_use"><strong>자격증있음</strong></label>
							<em style="right:0; top:0; display:<?php echo ($wr_license)?'':'none';?>;" class="insert" id="license_add"> <a class="button white" onclick="license_add();"><span>+추가</span></a></em>
						</td>
					</tr>
					<?php if($mode=='insert' || ($mode=='update' && !$wr_license)){ ?>
					<tr class="wr_license_block" id="wr_license_block_0" style="display:none;">
						<td scope="row"  class="ctlt subline"> <label><strong>자격증</strong></label></td>
						<td  class="pdlnb2">
							<div class="career1 positionR">
							<ul>
								<li class="pb5 positionR">
								<table>
								<colgroup><col width="250px"><col width="*"></colgroup>
								<tbody>
								<tr>
									<td>
										<span>
											<label>자격증명<b class="col">*</b></label>
											<input class="txt license_required" type="text" name="wr_license_name[]"  id="wr_license_name_0" style="width:135px;" hname="자격증명">
											<!-- <em class="pr10"><a class="button" onclick="license_search_pop('0');"><span>선택</span></a></em> -->
										</span>
									</td>
									<td>
										<span>
											<label>발행처<b class="col">*</b></label>
											<input class="txt license_required" type="text" name="wr_license_public[]" id="wr_license_public_0" style="width:135px;" hname="발행처">
										</span>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label>취득년도<b class="col">*</b></label>
										<select style="width:80px;" name="wr_license_year[]" class="ipSelect license_required" hname="취득년도">
										<option value="">년</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
										</select> 년 
									</td>
								</tr>
								</tbody>
								</table>
								</li>
							</ul>
							</div>
						</td>
					</tr>
					<?php // 수정
						} else if($mode=='update'||$mode=='load'){ 
					if($wr_license){
						foreach($wr_license as $key => $val){
					?>
					<tr class="wr_license_block" id="wr_license_block_<?php echo $key;?>">
						<td scope="row"  class="subline"> <label><strong>자격증</strong></label></td>
						<td  class="pdlnb2">
							<div class="career1 positionR">
							<ul>
								<li class="pb5 positionR">
								<em style="right:0; top:5px;" class="positionA delete"> <a class="button white" onclick="license_remove('<?php echo $key;?>');"><span>-삭제</span></a></em>
								<table>
								<!-- <caption><span class="skip">자격증사항 정보입력</span></caption> -->
								<colgroup><col width="250px"><col width="*"></colgroup>
								<tbody>
								<tr>
									<td>
										<span>
											<label>자격증명<b class="col">*</b></label>
											<input class="txt license_required" type="text" name="wr_license_name[]"  id="wr_license_name_<?php echo $key;?>" style="width:135px;" hname="자격증명" value="<?php echo $val['name'];?>">
										</span>
									</td>
									<td>
										<span>
											<label>발행처<b class="col">*</b></label>
											<input class="txt license_required" type="text" name="wr_license_public[]" id="wr_license_public_<?php echo $key;?>" style="width:135px;" hname="발행처" value="<?php echo $val['public'];?>">
										</span>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label>취득년도<b class="col">*</b></label>
										<select style="width:80px;" name="wr_license_year[]" class="ipSelect license_required" hname="취득년도">
										<option value="">년</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($val['year']==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
										</select> 년 
									</td>
								</tr>
								</tbody>
								</table>
								</li>
							</ul>
							</div>
						</td>
					</tr>
					<?php
							}	// foreach end.
						}	// foreach if end.
					}	// if end.
					?>
				</tbody>

				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">외국어능력</td>
					<td class="pdlnb2 ">
						<input type="checkbox" name="wr_language_use" id="wr_language_use" class="chk" value="1" onclick="use_language(this);" <?php echo ($wr_language_use)?'checked':'';?> <?php echo ($form_language['etc_0'])?'required':'';?> hname="자격증" option="checkbox">
						<label for="wr_language_use"><strong>외국어능력 있음</strong></label>
					</td>
				</tr>
				<?php if($mode=='insert' || ($mode=='update' && !$wr_language)){ ?>
				<tr class="wr_language_block" id="wr_language_block_0" style="display:none;">
					<td scope="row"  class="ctlt subline"><label><strong>외국어능력</strong></label></td>
					<td  class="pdlnb2">
						<div class="language positionR">
						<ul>
							<li class="positionR">
								<span>
									<label>외국어<b class="col">*</b></label>
									<select title="외국어 선택" name="wr_language_name[]" id="wr_language_name_0" style="width:130px;" class="ipSelect language_required" hname="외국어">
									<option value=""> 외국어선택 </option>
									<?php
										foreach($indi_language_list as $val){
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									?>
									<option value="<?php echo $val['code'];?>"><?php echo $name;?></option>
									<?php } ?>
									</select>
								</span>
								<span>
									<input type="radio" name="wr_language_level_0" id="wr_language_level_0_0" value="0" checked>
									<label for="wr_language_level_0_0">상(회화능숙)</label>
								</span>
								<span>
									<input type="radio" name="wr_language_level_0" id="wr_language_level_0_1" value="1">
									<label for="wr_language_level_0_1">중(일상대화)</label>
								</span>
								<span>
									<input type="radio" name="wr_language_level_0" id="wr_language_level_0_2" value="2">
									<label for="wr_language_level_0_2">하(간단대화)</label>
								</span>
							</li>
							
							<!-- 공인시험 -->                    
							<div id="language_license_block_0">
								<li class="positionR">
									<ul>
										<li class="pb5 positionR">
										<span>
											<label>공인시험</label>
											<select title="시험 선택" name="language_license_0[]" id="language_license_0_0" style="width:130px;" class="ipSelect">
											<option value=""> 시험선택 </option>
											<?php
												foreach($indi_language_license_list as $val){
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											?>
											<option value="<?php echo $val['code'];?>"><?php echo $name;?></option>
											<?php } ?>
											</select>
										</span>
										<span> 
											<label class="pl10">점수/등급</label>
											<input type="text" style="width:80px;" name="language_license_level_0[]" class="txt" id="language_license_level_0_0">
										</span>
										<span>
											<label class="pl10">취득년도</label>
											<select style="width:80px;" name="language_license_year_0[]" class="ipSelect">
											<option value="">년</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>'><?=$i?></option>
											<?php } ?>
											</select> 년
										</span> 
										</li>
									</ul>
								</li>
							</div>
							<!-- //공인시험 -->

							<li class="positionR">
								<span>
									<input type="checkbox" name="wr_language_study_0" id="wr_language_study_0" class="chk" value="1">
									<label style="width:100px;"  for="wr_language_study_0">어학연수 경험있음</label>
									<select title="연수기간 선택" name="wr_language_study_date_0" id="wr_language_study_date_0" style="width:90px;" class="ipSelect">
									<option value="">연수기간 선택</option>
									<?php foreach($language_date as $key => $val){ ?>
									<option value="<?php echo $key;?>"><?php echo $val;?></option>
									<?php } ?>
									</select>
								</span>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<?php // 수정
					} else if($mode=='update'||$mode=='load'){
				if($wr_language){
					foreach($wr_language as $lkey => $lval){
				?>
				<tr class="wr_language_block" id="wr_language_block_<?php echo $lkey;?>">
					<td scope="row"  class="ctlt subline"> <label><strong>외국어능력</strong></label></td>
					<td  class="pdlnb2">
						<div class="language positionR">
						<ul>
							<li class="positionR">
								<span>
									<label>외국어<b class="col">*</b></label>
									<select title="외국어 선택" name="wr_language_name[]" id="wr_language_name_<?php echo $lkey;?>" style="width:130px;" class="ipSelect language_required" hname="외국어">
									<option value=""> 외국어선택 </option>
									<?php
										foreach($indi_language_list as $val){
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($lval['language'] == $val['code']) ? "selected" : "";
									?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php } ?>
									</select>
								</span>
								<span>
									<input type="radio" name="wr_language_level_<?php echo $lkey;?>" id="wr_language_level_<?php echo $lkey;?>_0" value="0" checked>
									<label for="wr_language_level_<?php echo $lkey;?>_0">상(회화능숙)</label>
								</span>
								<span>
									<input type="radio" name="wr_language_level_<?php echo $lkey;?>" id="wr_language_level_<?php echo $lkey;?>_1" value="1" <?php echo ($lval['level']=='1')?'checked':'';?>>
									<label for="wr_language_level_<?php echo $lkey;?>_1">중(일상대화)</label>
								</span>
								<span>
									<input type="radio" name="wr_language_level_<?php echo $lkey;?>" id="wr_language_level_<?php echo $lkey;?>_2" value="2" <?php echo ($lval['level']=='2')?'checked':'';?>>
									<label for="wr_language_level_<?php echo $lkey;?>_2">하(간단대화)</label>
								</span>
							</li>
							
							<!-- 공인시험 -->
							<?php 
								$license = $lval['license'];
								$license_cnt = count($lval['license']['license']);
								for($j=0;$j<$license_cnt;$j++){ 
									$license_name = $license['license'][$j];
									$license_level = $license['level'][$j];
									$license_year = $license['year'][$j];
							?>
							<div id="language_license_block_<?php echo $lkey;?>">
								<li class="positionR">
									<ul>
										<li class="pb5 positionR">
										<em style="right:0; top:0;" class="positionA delete"><a class="button white" onclick="language_license_remove('<?php echo $lkey;?>','<?php echo $j;?>');"><span>시험삭제</span></a></em>
										<span>
											<label>공인시험</label>
											<select title="시험 선택" name="language_license_<?php echo $lkey;?>[]" id="language_license_<?php echo $lkey;?>_<?php echo $j;?>" style="width:130px;" class="ipSelect">
											<option value=""> 시험선택 </option>
											<?php
												foreach($indi_language_license_list as $val){
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$selected = ($license_name == $val['code']) ? "selected" : "";
											?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
											<?php } ?>
											</select>
										</span>
										<span> 
											<label class="pl10">점수/등급</label>
											<input type="text" style="width:80px;" name="language_license_level_<?php echo $lkey;?>[]" class="txt" id="language_license_level_<?php echo $lkey;?>_<?php echo $j;?>" value="<?php echo $license_level;?>">
										</span>
										<span>
											<label class="pl10">취득년도</label>
											<select style="width:80px;" name="language_license_year_<?php echo $lkey;?>[]" class="ipSelect">
											<option value="">년</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>' <?php echo ($license_year==$i)?'selected':'';?>><?=$i?></option>
											<?php } ?>
											</select> 년
										</span> 
										</li>
									</ul>
								</li>
							</div>
							<?php } ?>
							<!-- //공인시험 -->

							<li class="positionR">
								<span>
									<input type="checkbox" name="wr_language_study_<?php echo $lkey;?>" id="wr_language_study_<?php echo $lkey;?>" class="chk" value="1" <?php echo ($lval['study'])?'checked':'';?>>
									<label style="width:100px;" class="" for="wr_language_study_<?php echo $lkey;?>">어학연수 경험있음</label>
									<select title="연수기간 선택" name="wr_language_study_date_<?php echo $lkey;?>" id="wr_language_study_date_<?php echo $lkey;?>" style="width:90px;" class="ipSelect">
									<option value="">연수기간 선택</option>
									<?php foreach($language_date as $key => $val){ ?>
									<option value="<?php echo $key;?>" <?php echo ($lval['study_date']==$key)?'selected':'';?>><?php echo $val;?></option>
									<?php } ?>
									</select>
								</span>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<?php
						}	// foreach end.
					}	// foreach if end.
				}	// if end.
				?>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">OA능력</td>
					<td class="pdlnb2">
						<ul>
							<li class="sklist">
								<label class="pr5" style="display:inline-block; width:160px;"><img alt="워드" src="../../images/icon/icon_word1.gif" width="16" height="16">워드(한글·MS워드)</label>
								<span>
									<input type="radio" name="wr_oa[word]" id="wr_oa_word_0" value="0" checked>
									<label for="wr_oa_word_0">상(표/도구 활용가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[word]" id="wr_oa_word_1" value="1" <?php echo ($wr_oa['word']=='1')?'checked':'';?>>
									<label for="wr_oa_word_1">중(문서편집 가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[word]" id="wr_oa_word_2" value="2" <?php echo ($wr_oa['word']=='2')?'checked':'';?>>
									<label for="wr_oa_word_2">하(기본 사용)</label>
								</span>
							</li>
							<li class="sklist">
								<label class="pr5" style="display:inline-block; width:160px;"><img alt="프리젠테이션" src="../../images/icon/icon_power1.gif" width="16" height="16">프리젠테이션(파워포인트)</label>
								<span>
									<input type="radio" name="wr_oa[pt]" id="wr_oa_pt_0" value="0" checked>
									<label for="wr_oa_pt_0">상(챠트/효과 활용가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[pt]" id="wr_oa_pt_1" value="1" <?php echo ($wr_oa['pt']=='1')?'checked':'';?>>
									<label for="wr_oa_pt_1">중(서식/도형 가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[pt]" id="wr_oa_pt_2" value="2" <?php echo ($wr_oa['pt']=='2')?'checked':'';?>>
									<label for="wr_oa_pt_2">하(기본사용)</label>
								</span>
							</li>
							<li class="sklist">
								<label class="pr5" style="display:inline-block; width:160px;"><img alt="스프레드시트" src="../../images/icon/icon_excel1.gif" width="16" height="16">스프레드시트(엑셀)</label>
								<span>
									<input type="radio" name="wr_oa[sheet]" id="wr_oa_sheet_0" value="0" checked>
									<label for="wr_oa_sheet_0">상(수식/함수 활용가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[sheet]" id="wr_oa_sheet_1" value="1" <?php echo ($wr_oa['sheet']=='1')?'checked':'';?>>
									<label for="wr_oa_sheet_1">중(데이터 편집가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[sheet]" id="wr_oa_sheet_2" value="2" <?php echo ($wr_oa['sheet']=='2')?'checked':'';?>>
									<label for="wr_oa_sheet_2">하(기본사용)</label>
								</span>
							</li>
							<li class="sklist">
								<label class="pr5" style="display:inline-block; width:160px;"><img alt="인터넷" src="../../images/icon/icon_ie1.gif" width="16" height="16">인터넷(정보검색)</label>
								<span>
									<input type="radio" name="wr_oa[internet]" id="wr_oa_internet_0" value="0" checked>
									<label for="wr_oa_internet_0">상(정보수집 능숙)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[internet]" id="wr_oa_internet_1" value="1" <?php echo ($wr_oa['internet']=='1')?'checked':'';?>>
									<label for="wr_oa_internet_1">중(정보수집 가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[internet]" id="wr_oa_internet_2" value="2" <?php echo ($wr_oa['internet']=='2')?'checked':'';?>>
									<label for="wr_oa_internet_2">하(기본사용)</label>
								</span>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td class="ctlt">컴퓨터능력</td>
					<td class="pdlnb2">
						<ul>
						<?php 
							foreach($indi_oa_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_computer)) ? "checked" : "";
						?>
						<li class="fl pr10">
							<input type="checkbox" class="chk" id="<?php echo $val['code'];?>" name="wr_computer[]" value="<?php echo $val['code'];?>" <?php echo $checked;?> <?php echo ($form_oa['etc_0'])?'required':'';?> hname="컴퓨터능력" option="checkbox">
							<label for="<?php echo $val['code'];?>"><?php echo $name;?></label>
						</li>
						<?php } ?>
						</ul>
					</td>
				</tr>
				<tr>
					<td class="ctlt">특기사항</td>
					<td class="pdlnb2">
						<ul>
							<?php 
								foreach($indi_special_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$checked = (@in_array($val['code'],$wr_specialty)) ? "checked" : "";
							?>
							<li class="fl pr10"><input type="checkbox" class="chk" name="wr_specialty[]" id="<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" <?php echo $checked;?> <?php echo ($form_oa['etc_0'])?'required':'';?> hname="특기사항" option="checkbox"> <label for="<?php echo $val['code'];?>"><?php echo $name;?></label></li>
							<?php } ?>
							<li style="width:250px;">
								<input type="checkbox" class="chk" name="wr_specialty_etc" id="wr_specialty_etc" value="1" onclick="wr_specialty_etc_view(this);" <?php echo ($wr_specialty_etc[0])?'checked':'';?>> <label for="wr_specialty_etc">기타</label>
								<span id="wr_specialty_view" style="display:<?php echo ($wr_specialty_etc[1])?'':'none';?>;">
									<input type="text" style="width:150px; padding:0;" name="wr_specialty_etc_val" class="txt" value="<?php echo $wr_specialty_etc[1];?>">
								</span>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td class="ctlt">수상.수료 내역</td>
					<td class="pdlnb2">
						<textarea style="width:100%; border:1px solid #ddd; height:100px; " id="wr_prime" class="txtarea" name="wr_prime" <?php echo ($form_oa['etc_0'])?'required':'';?> hname="수상·수료 활동내역"><?php echo stripslashes($get_resume['wr_prime']);?></textarea>
					</td>
				</tr>
				<tr>
					<td class="ctlt">자기소개서<b class="col">*</b></td>
					<td class="pdlnb2">
						<?php echo $utility->make_cheditor("wr_introduce", stripslashes($get_resume['wr_introduce']));	// 에디터 생성?>
					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">포토앨범</td>
					<td class="pdlnb2">

				
				
				<!--  사진등록 layer  -->
					<div class="layerPop  lnb_col" style="display:none; border:2px solid #ddd; background:#fff; position:absolute; width:420px; top:70%; left:25%; text-align:left; z-index:9999;" id="individualPhotoPop">
					<input type="hidden" name="mb_photos" id="mb_photos"/>
						<dl style="">
						<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="individualPhotoPop_handle">
								<strong>사진등록</strong>
								<em class="closeBtn" onclick="close_alba_photos()"><img width="11" height="11" class="pb5" src="../../images/icon/icon_close2.gif" alt="close"></em>
							</dt>
							<dd style="padding:10px 15px;">
								<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
								<strong>500KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
								<div class="box2" style="border:1px solid #ddd; padding:10px;">
								<input type="file" name="photo_files" id="photo_files" size="32" style="height:20px;" class="txtForm">
								</div>
								<div  style="width:100px; margin:20px auto; " class=" btn font_gray bg_white block"><a class="block" style="padding:10px 20px;" href="javascript:photos_submit('<?php echo $mb_id;?>');">등록하기</a></div>
							</dd>
						</dl>
					</div>
					<!--  //사진등록 layer   -->




						<ul>
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="picture">
									<img width="100%" height="100%" alt="photo" src="<?php echo $photo_0;?>" id="mb_photo_0">
									<div class="mt10"> 
										<a class="btn white" style="padding:2px 15px;"onclick="update_photos('update', 0, '<?php echo $mb_id;?>');" id="update_0"><span>등록</span></a> 
										<a class="btn white" style="padding:2px 15px;"onclick="update_photos('delete', 0, '<?php echo $mb_id;?>');" id="delete_0"><span>삭제</span></a> 
									</div>
								</div>
							</li>
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="picture">
									<img width="100%" height="100%"  alt="photo" src="<?php echo $photo_1;?>" id="mb_photo_1">
									<div class="mt10"> 
										<a class="btn white" style="padding:2px 15px;"onclick="update_photos('update', 1, '<?php echo $mb_id;?>');" id="update_1"><span>등록</span></a> 
										<a class="btn white" style="padding:2px 15px;"onclick="update_photos('delete', 1, '<?php echo $mb_id;?>');" id="delete_1"><span>삭제</span></a> 
									</div>
								</div>
							</li>
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="picture">
									<img width="100%"height="100%"   alt="photo" src="<?php echo $photo_2;?>" id="mb_photo_2">
									<div class="mt10"> 
										<a class="btn white" style="padding:2px 15px;"onclick="update_photos('update', 2, '<?php echo $mb_id;?>');" id="update_2"><span>등록</span></a> 
										<a class="btn white" style="padding:2px 15px;"onclick="update_photos('delete', 2, '<?php echo $mb_id;?>');" id="delete_2"><span>삭제</span></a> 
									</div>
								</div>
							</li>
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="picture">
									<img width="100%" height="100%"  alt="photo" src="<?php echo $photo_3;?>" id="mb_photo_3">
									<div class="mt10"> 
										<a class="btn white" style="padding:2px 15px;"onclick="update_photos('update', 3, '<?php echo $mb_id;?>');" id="update_3"><span>등록</span></a> 
										<a class="btn white" style="padding:2px 15px;"onclick="update_photos('delete', 3, '<?php echo $mb_id;?>');" id="delete_3"><span>삭제</span></a> 
									</div>
								</div>
							</li>
						</ul>
					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">장애여부</td>
					<td class="pdlnb2">
						<ul class="handicapWrap clearfix">
							<li class="positionR pr10 fl">
								<input type="radio" class="chk" name="wr_impediment_use" id="wr_impediment_use_0" value="0" checked onclick="impediment_use(this);" hname="장애여부" option="radio">
								<label for="wr_impediment_use_0">비대상</label>
							</li>
							<li class="positionR fl">
								<input type="radio" class="chk" name="wr_impediment_use" id="wr_impediment_use_1" value="1" onclick="impediment_use(this);" <?php echo ($get_resume['wr_impediment_use'])?'checked':'';?> hname="장애여부" option="radio">
								<label for="wr_impediment_use_1">대상</label>
							</li>
						</ul>
						<div class="mt10" id="impediment_block" style="display:<?php echo ($get_resume['wr_impediment_use'])?'':'none';?>;">
							<span class="pr10">
								<label>장애등급</label>
								<select title="장애등급선택" name="wr_impediment_level" id="wr_impediment_level" style="width:130px;" class="ipSelect">
								<option value=""> 장애등급 선택</option>
								<?php 
									foreach($impediment_list as $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($get_resume['wr_impediment_level']==$val['code']) ? "selected" : "";
								?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $val['name'];?></option>
								<?php } ?>
								</select>
							</span>
							<span>
								<label>장애분류</label>
								<input class="txt" type="text" maxlength="10" name="wr_impediment_name" id="wr_impediment_name" value="<?php echo $get_resume['wr_impediment_name'];?>">
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<td class="ctlt">결혼여부</td>
					<td class="pdlnb2">
						<ul class="marriageWrap clearfix">
							<li class="positionR fl">
								<input type="radio" class="chk" name="wr_marriage" id="wr_marriage_0" checked value="0" hname="결혼여부" option="radio">
								<label for="wr_marriage_0">미혼</label>&nbsp;&nbsp;
							</li>
							<li class="positionR pr10 fl">
								<input type="radio" class="chk" name="wr_marriage" id="wr_marriage_1" value="1" hname="결혼여부" option="radio">
								<label for="wr_marriage_1" <?php echo ($get_resume['wr_marriage'])?'checked':'';?>>기혼</label>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td class="ctlt">병역여부</td>
					<td class="pdlnb2">
						<ul class="militaryWrap clearfix">
							<li class="positionR pr10 fl">
								<input type="radio" class="chk" name="wr_military" id="wr_military_0" value="0" checked onclick="military_use(this);" hname="병역여부" option="radio">
								<label for="wr_military_0">미필</label>
							</li>
							<li class="positionR pr10 fl">
								<input type="radio" class="chk" name="wr_military" id="wr_military_1" value="1" onclick="military_use(this);" <?php echo ($get_resume['wr_military']=='1')?'checked':'';?> hname="병역여부" option="radio">
								<label for="wr_military_1">군필</label>
							</li>
							<li class="positionR fl">
								<input type="radio" class="chk" name="wr_military" id="wr_military_2" value="2" onclick="military_use(this);" <?php echo ($get_resume['wr_military']=='2')?'checked':'';?> hname="병역여부" option="radio">
								<label for="wr_military_2">면제</label>
							</li>
						</ul>
						<div class="mt10" id="military_block" style="display:<?php echo ($get_resume['wr_military']=='1')?'':'none';?>;">
							<span>
								<label>병역내용(군)</label>
								<input class="txt" type="text" maxlength="10" name="wr_military_type" id="wr_military_type" value="<?php echo $get_resume['wr_military_type'];?>">
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<td class="ctlt">채용우대</td>
					<td class="pdlnb2">
						<ul>
							<li class="fl">
								<input type="checkbox" name="wr_preferential_use" id="wr_preferential_use" class="chk" value="1" <?php echo ($get_resume['wr_preferential_use'])?'checked':'';?> hname="채용우대" option="checkbox">
								<label for="wr_preferential_use">국가보훈 대상자</label>
							</li>
							<li  class="treatment2 fl">
								<input type="checkbox" name="wr_treatment_use" id="wr_treatment_use" class="chk" value="1" <?php echo ($get_resume['wr_treatment_use'])?'checked':'';?> hname="채용우대" option="checkbox">
								<label for="wr_treatment_use">고용지원금 대상자</label>
								(
								<?php 
									foreach($indi_treatment_list as $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$checked = (@in_array($val['code'],$wr_treatment_service)) ? "checked" : "";
								?>
								<span>
									<input type="checkbox" name="wr_treatment_service[]" id="<?php echo $val['code'];?>" class="chk" value="<?php echo $val['code'];?>" <?php echo $checked;?>>
									<label for="<?php echo $val['code'];?>"><?php echo $name;?></label>
								</span>
								<?php } ?>
								)
							</li>
						</ul>
					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">공개여부</td>
					<td class="pdlnb2">
						<ul class="resumeopenWrap clearfix">
						<li class="positionR pr10 fl">
							<input type="radio" class="chk" name="wr_open" id="wr_open_1" value="1" checked>
							<label for="wr_open_1">공개</label>
						</li>
						<li class="positionR fl">
							<input type="radio" class="chk" name="wr_open" id="wr_open_0" value="0" <?php echo ($mode=='update'&&!$get_resume['wr_open'])?'checked':'';?>>
							<label for="wr_open_0">비공개</label>
						</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td class="ctlt">통화가능시간</td>
					<td class="pdlnb2">
						<div class="calltimeWrap positionR">
							<select style="width:82px;" class="ipSelect" name="wr_calltime[]">
							<option value="">선택</option>
							<?php for($i=0;$i<=23;$i++){ ?>
							<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_calltime[0]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
							<?php } ?>
							</select> 
							~
							<select style="width:82px;" class="ipSelect" name="wr_calltime[]">
							<option value="">선택</option>
							<?php for($i=0;$i<=23;$i++){ ?>
							<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_calltime[1]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
							<?php } ?>
							</select>
							<em>
								<input type="checkbox" name="wr_calltime_always" id="wr_calltime_always" value="1" <?php echo ($get_resume['wr_calltime_always'])?'checked':'';?>>
								<label for="wr_calltime_always">언제나가능</label>
							</em>
						</div>
					</td>
				</tr>
				</table>

				<dl class="pbtn">  
					<!-- <input type='image' src="../../images/btn/b23_02.png" class="ln_col"> -->
					<img src="../../images/btn/b23_02.png" class="ln_col hand" onclick="ResumeFrm_submit();">&nbsp;
					<a onClick="MM_showHideLayers('add_form','','hide')"><img src="../../images/btn/23_10.gif"></a></a>
				</dl>

				</form>

				</div>
<?php
			break;

			## 서비스승인
			case 'service':
			
				if(is_array($no)){	// 배열로 넘어온 경우 '선택 서비스승인' 으로 넘어온것임
					$no = implode($no,",");
					$is_array = true;
				} else {
					$is_array = false;
					$get_resume = $alba_resume_control->get_resume($no);
					$get_payment = $payment_control->get_payment_for_oid($get_resume['wr_oid']);
				}

				$resume_option_neon = $service_control->service_check('resume_option_neon');	// 알바 형광펜 옵션
				$resume_option_neon_service = $service_control->__ServiceList($resume_option_neon['service']);	// 알바 형광펜 서비스 리스트
				$resume_option_neon_color = explode("/",$resume_option_neon['neon_color']);	 // 색상
				$resume_option_neon_color_cnt = count($resume_option_neon_color);

				$resume_option_icon = $service_control->service_check('resume_option_icon');	// 알바 아이콘 옵션
				$resume_option_icon_service = $service_control->__ServiceList($resume_option_icon['service']);	// 알바 아이콘 서비스 리스트
				$resume_option_icon_list = $category_control->category_codeList($resume_option_icon['service']);

				$resume_option_color = $service_control->service_check('resume_option_color');	// 알바 글자색 옵션
				$resume_option_color_service = $service_control->__ServiceList($resume_option_color['service']);	// 알바 글자색 서비스 리스트
				$resume_option_colors = explode("/",$resume_option_color['font_color']);	// 색상
				$resume_option_colors_cnt = count($resume_option_colors);

				$main_rbasic_check = $service_control->service_check('main_rbasic');
				$alba_resume_basic_check = $service_control->service_check('alba_resume_basic');

?>
				<div id="pop_service" class="bocol lnb_col" style="top:5%;left:33%;display:none;">
				
				<form name="ResumeServiceFrm" method="post" id="ResumeServiceFrm" action="./process/resume_regist.php" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="service" id="mode"/>
				<input type="hidden" name="no" value="<?php echo $no;?>"/>
				<input type="hidden" name="ajax" value="1"/><!-- ajax mode 유무 -->
				<input type="hidden" name="is_array" value="<?php echo $is_array;?>"/>

					<dl class="ntlt lnb_col m0 hand" id="serviceHandle">
						<img src="../../images/comn/bul_10.png" class="t">서비스승인
						<a onClick="MM_showHideLayers('pop_service','','hide')"><img src="../../images/comn/pclose.png" class="lclose ln_col"></a>
					</dl>

					<table width="700" class="bg_col tf">
					<col width="120"><col width="170"><col >
					<tr>
						<td class="ctlt">메인 포커스</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_main_focuss" name="wr_service_main_focus" value="<?php echo ($get_resume['wr_service_main_focus'])?$get_resume['wr_service_main_focus']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">메인 포커스 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_main_focus_golds" name="wr_service_main_focus_gold" value="<?php echo ($get_resume['wr_service_main_focus_gold'])?$get_resume['wr_service_main_focus_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<?php if($main_rbasic_check['is_pay']){ ?>
					<tr>
						<td class="ctlt">메인 일반리스트</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_basics" name="wr_service_basic" value="<?php echo ($get_resume['wr_service_basic'])?$get_resume['wr_service_basic']:'0000-00-00';?>"/>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td class="ctlt">인재정보 포커스</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_sub_focuss" name="wr_service_sub_focus" value="<?php echo ($get_resume['wr_service_sub_focus'])?$get_resume['wr_service_sub_focus']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">인재정보 포커스 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_sub_focus_golds" name="wr_service_sub_focus_gold" value="<?php echo ($get_resume['wr_service_sub_focus_gold'])?$get_resume['wr_service_sub_focus_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<?php if($alba_resume_basic_check['is_pay']){ ?>
					<tr>
						<td class="ctlt">인재정보 일반리스트</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_basic_sub" name="wr_service_basic_sub" value="<?php echo ($get_resume['wr_service_basic_sub'])?$get_resume['wr_service_basic_sub']:'0000-00-00';?>"/>
						</td>
					</tr>
					<?php } ?>
					<tr><td colspan="3" class="lnb wbg" height="5"></td></tr>
					<tr>
						<td class="ctlt" colspan="3">강조옵션 상품</td>
					</tr>
					<tr>
						<td class="ctlt">형광펜</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_neons" name="wr_service_neon" value="<?php echo ($get_resume['wr_service_neon'])?$get_resume['wr_service_neon']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<div class="boxRadio bg_color2 ml10 mt10  pt5 pb5 resume_option_neon" ><strong>칼라선택:</strong>
							<?php 
							for($i=0;$i<$resume_option_neon_color_cnt;$i++){ 
							$checked = ($get_payment['pay_resume_option_neon_color']==$resume_option_neon_color[$i])?'checked':'';
							?>
								<span class="">
									<input type="radio" value="<?php echo $resume_option_neon_color[$i];?>" name="resume_option_neon_sel" id="resume_option_neon_<?php echo $i;?>" class="chk" <?php echo $checked;?>>
									<label for="resume_option_neon_<?php echo $i;?>" style="background:#<?php echo $resume_option_neon_color[$i];?>;">형광펜</label>
								</span>
							<?php } ?>
							</div>						
						</td>
					</tr>
					<tr>
						<td class="ctlt">굵은글자</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_bolds" name="wr_service_bold" value="<?php echo ($get_resume['wr_service_bold'])?$get_resume['wr_service_bold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">아이콘</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_icons" name="wr_service_icon" value="<?php echo ($get_resume['wr_service_icon'])?$get_resume['wr_service_icon']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<div class="boxIcon ml10 mt10  pt5 pb5 resume_option_icon">
							<?php 
								foreach($resume_option_icon_list as $key => $val){ 
								$checked = ($get_payment['pay_resume_option_icon_sel']==$val['no'])?'checked':'';
							?>
								<span class="pr15"><input type="radio" name="resume_option_icon_sel" value="<?php echo $val['no'];?>" id="resume_option_icon_<?php echo $key;?>" class="chk" <?php echo $checked;?>>
									<label for="resume_option_icon_<?php echo $key;?>" id="resume_option_icon_<?php echo $val['no'];?>"><img src="<?php echo "../../data/icon/".$val['name'];?>"></label>
								</span>
							<?php } ?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="ctlt">글자색</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_colors" name="wr_service_color" value="<?php echo ($get_resume['wr_service_color'])?$get_resume['wr_service_color']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<div class="boxRadio bg_color2 ml10 mt10  pt5 pb5 resume_option_color"><strong>칼라선택:</strong>
							<?php 
								for($i=0;$i<$resume_option_colors_cnt;$i++){ 
								$checked = ($get_payment['pay_resume_option_color_sel']==$val['no'])?'checked':'';
							?>
								<span class=""><input type="radio" name="resume_option_color_sel" id="resume_option_color_sel_<?php echo $i;?>" value="<?php echo $resume_option_colors[$i];?>" class="chk" <?php echo $checked;?>><label for="resume_option_color_sel_<?php echo $i;?>" style="color:#<?php echo $resume_option_colors[$i];?>"> 글자색</label></span>
							<?php } ?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="ctlt">반짝칼라</td>
						<td class="pdlnb2 num11" >
							<input type="text" style="width:165px;" class="txt" id="wr_service_blinks" name="wr_service_blink" value="<?php echo ($get_resume['wr_service_blink'])?$get_resume['wr_service_blink']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">&nbsp;</td>
					</tr>
					<tr><td colspan="3" class="lnb wbg" height="5"></td></tr>
					<tr>
						<td class="ctlt">급구</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_busys" name="wr_service_busy" value="<?php echo ($get_resume['wr_service_busy'])?$get_resume['wr_service_busy']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">점프</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_jumps" name="wr_service_jump" value="<?php echo ($get_resume['wr_service_jump'])?$get_resume['wr_service_jump']:'0000-00-00';?>"/>
						</td>
					</tr>
					</table>

					<dl class="pbtn">
						<input type='image' src="../../images/btn/b23_02.png" class="ln_col">&nbsp;
						<a onClick="MM_showHideLayers('pop_service','','hide')"><img src="../../images/btn/23_10.gif"></a>
					</dl>

				</form>

				</div>
<?php
			break;

		}	// switch end.
?>
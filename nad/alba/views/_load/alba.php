<?php
		/*
		* /application/nad/alba/views/_load/alba.php
		* @author Harimao
		* @since 2013/08/19
		* @last update 2015/05/29
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

		$type = $_POST['type'];
		$p_code = $_POST['p_code'];
		$target = $_POST['target'];

		switch($mode){

			## 채용정보 보기
			case 'get_alba':			
?>
				<div id="pop_alba" class="bocol lnb_col" style="top:10%;left:33%;display:;">
					<dl class="ntlt lnb_col m0 hand" id="albaHandle">
						<img src="../../images/comn/bul_10.png" class="t">채용정보
						<a onClick="MM_showHideLayers('pop_alba','','hide')"><img src="../../images/comn/pclose.png" class="lclose ln_col"></a>
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

<?php
			break;

			## 채용정보 입력/수정
			case 'insert':
			case 'update':
			case 'load':		// 리스트상 불러오기

				$member_list = $member_control->member_list("",""," where `mb_type` = 'company' and `is_delete` = 0 ");

				$get_alba = $alba_control->get_alba($no);

				$company_member = $member_control->get_company_memberNo($get_alba['wr_company']);	// 기업정보 (no 기준)

				//$input_type = ($mode=='update' || $mode=='load') ? $get_alba['input_type'] : $_POST['wr_input_type'];
				//$input_type = ($mode=='update' || $mode=='load') ? (!$get_alba['input_type']) ? 'load' : $get_alba['input_type'] : $_POST['wr_input_type'];
				if($_POST['wr_input_type']){
					$input_type = $_POST['wr_input_type'];
				} else {
					$input_type = ($get_alba['input_type']) ? $get_alba['input_type'] : "";
				}

				$mb_id = ($_POST['mb_id']) ? $_POST['mb_id'] : $get_alba['wr_id'];

				$get_member = $member_control->get_member($mb_id);

				$wr_phone = explode('-',$get_alba['wr_phone']);
				$wr_hphone = explode('-',$get_alba['wr_hphone']);
				$wr_fax = explode('-',$get_alba['wr_fax']);

				$wr_email = explode('@',$get_alba['wr_email']);

				$wr_subject = $utility->remove_quoted($get_alba['wr_subject']);

				$tel_num_option = $config->get_tel_num($wr_phone[0]);	 // 전화번호 국번
				$hp_num_option = $config->get_hp_num($wr_hphone[0]);	 // 휴대폰번호 국번
				$fax_num_option = $config->get_tel_num($wr_fax[0]);	 // 전화번호 국번
				$email_option = $config->get_email();	 // 이메일 서비스 제공자

				$wr_job_type0 = $get_alba['wr_job_type0'];
				$wr_job_type1 = $get_alba['wr_job_type1'];
				$wr_job_type2 = $get_alba['wr_job_type2'];

				$wr_job_type3 = $get_alba['wr_job_type3'];
				$wr_job_type4 = $get_alba['wr_job_type4'];
				$wr_job_type5 = $get_alba['wr_job_type5'];

				$wr_job_type6 = $get_alba['wr_job_type6'];
				$wr_job_type7 = $get_alba['wr_job_type7'];
				$wr_job_type8 = $get_alba['wr_job_type8'];

				$wr_area_0 = explode('/',$get_alba['wr_area_0']);
				$wr_area_1 = explode('/',$get_alba['wr_area_1']);
				$wr_area_2 = explode('/',$get_alba['wr_area_2']);

				$wr_area_03_val = $wr_area_0[3];

				$wr_subway_area_0 = $get_alba['wr_subway_area_0'];
				$wr_subway_line_0 = $get_alba['wr_subway_line_0'];
				$wr_subway_station_0 = $get_alba['wr_subway_station_0'];
				$wr_subway_content_0 = $get_alba['wr_subway_content_0'];

				$wr_subway_content_0_val = stripslashes($get_alba['wr_subway_content_0']);

				$wr_college_area = $get_alba['wr_college_area'];
				$wr_college_vicinity = $get_alba['wr_college_vicinity'];

				// 업체 로고
				if($input_type=='self'){
					$wr_mb_logo_file = "../../../../data/alba/" . $get_alba['etc_0'];
					$wr_mb_logo = (is_file($wr_mb_logo_file)) ? "../../data/alba/" . $get_alba['etc_0'] : "../../images/comn/no_profileimg.gif";
				} else {
					$wr_mb_logo_file = "../../../../data/alba/" . $get_alba['etc_0'];
					if( (is_file($wr_mb_logo_file)) ){
						$wr_mb_logo = "../../data/alba/" . $get_alba['etc_0'];
					} else {
						$wr_mb_logo_file = "../../../../data/member/" . $mb_id . "/logo/" . $get_member['mb_logo'];
						//$wr_mb_logo = (is_file($wr_mb_logo_file)) ? "../../data/member/" . $mb_id . "/logo/" . $get_member['mb_logo'] : "../../images/comn/no_profileimg.gif";
						$company_logo_file = "../../../../data/member/" . $mb_id . "/logo/" . $company_member['mb_logo'];
						if(is_file($wr_mb_logo_file)){
							$wr_mb_logo = "../../data/member/" . $mb_id . "/logo/" . $get_member['mb_logo'];
						} else if(is_file($company_logo_file)){
							$wr_mb_logo = "../../data/member/" . $mb_id . "/logo/" . $company_member['mb_logo'];
						} else {
							$wr_mb_logo = "../../images/comn/no_profileimg.gif";
						}
					}
				}

				// 등록 이미지 정보 추출
				if($get_alba['wr_company']){
					$wr_photo = $user_control->member_photo_list($get_alba['wr_id']," and `company_no` = '".$get_alba['wr_company']."' and `photo_table` = 'company' ", " order by `photo_no` asc ");	 // 등록 이미지 정보 추출
					$photo_0_file = "../../../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[0]['photo_name'];
					$wr_photo_0 = (is_file($photo_0_file)) ? "../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[0]['photo_name'] : "../../images/comn/no_profileimg.gif";
					$photo_1_file = "../../../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[1]['photo_name'];
					$wr_photo_1 = (is_file($photo_1_file)) ? "../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[1]['photo_name'] : "../../images/comn/no_profileimg.gif";
					$photo_2_file = "../../../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[2]['photo_name'];
					$wr_photo_2 = (is_file($photo_2_file)) ? "../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[2]['photo_name'] : "../../images/comn/no_profileimg.gif";
					$photo_3_file = "../../../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[3]['photo_name'];
					$wr_photo_3 = (is_file($photo_3_file)) ? "../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[3]['photo_name'] : "../../images/comn/no_profileimg.gif";
					$photo_4_file = "../../../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[4]['photo_name'];
					$wr_photo_4 = (is_file($photo_4_file)) ? "../../data/member/" . $get_alba['wr_id'] . "/photos/" . $wr_photo[4]['photo_name'] : "../../images/comn/no_profileimg.gif";
				} else {
					$wr_photo = $user_control->member_photo_list($get_alba['wr_id']," and `data_no` = '".$no."' ", " order by `photo_no` asc ");
					$photo_0_file = "../../../../data/alba/" . $wr_photo[0]['photo_name'];
					$wr_photo_0 = (is_file($photo_0_file)) ? "../../data/alba/" . $wr_photo[0]['photo_name'] : "../../images/comn/no_profileimg.gif";
					$photo_1_file = "../../../../data/alba/" . $wr_photo[1]['photo_name'];
					$wr_photo_1 = (is_file($photo_1_file)) ? "../../data/alba/" . $wr_photo[1]['photo_name'] : "../../images/comn/no_profileimg.gif";
					$photo_2_file = "../../../../data/alba/" . $wr_photo[2]['photo_name'];
					$wr_photo_2 = (is_file($photo_2_file)) ? "../../data/alba/" . $wr_photo[2]['photo_name'] : "../../images/comn/no_profileimg.gif";
					$photo_3_file = "../../../../data/alba/" . $wr_photo[3]['photo_name'];
					$wr_photo_3 = (is_file($photo_3_file)) ? "../../data/alba/" . $wr_photo[3]['photo_name'] : "../../images/comn/no_profileimg.gif";
					$photo_4_file = "../../../../data/alba/" . $wr_photo[4]['photo_name'];
					$wr_photo_4 = (is_file($photo_4_file)) ? "../../data/alba/" . $wr_photo[4]['photo_name'] : "../../images/comn/no_profileimg.gif";
				}

				$wr_stime = explode(':',$get_alba['wr_stime']);
				$wr_etime = explode(':',$get_alba['wr_etime']);
				$wr_time_conference = $get_alba['wr_time_conference'];

				$wr_pay_support = explode(',',$get_alba['wr_pay_support']);
				$wr_welfare = unserialize($get_alba['wr_welfare']);
				
				$wr_age_limit = $get_alba['wr_age_limit'];
				$wr_age = explode('-',$get_alba['wr_age']);
				$wr_age_etc = explode(',',$get_alba['wr_age_etc']);

				$wr_career_type = $get_alba['wr_career_type'];
				$wr_preferential = explode(',',$get_alba['wr_preferential']);
				$wr_volumes = explode(',',$get_alba['wr_volumes']);
				$wr_requisition = explode(',',$get_alba['wr_requisition']);
				$wr_form_attach = explode('/',$get_alba['wr_form_attach']);	// 등록된 양식 파일
				$wr_papers = explode(',',$get_alba['wr_papers']);

				$job_type_list = $category_control->category_codeList('job_type','','yes');		// 직종
				$area_list = $category_control->category_codeList('area','','yes');					// 지역
				$subway_list = $category_control->category_codeList('subway','','yes');			// 지하철
				$alba_date_list = $category_control->category_codeList('alba_date');	// 알바근무기간
				$alba_week_list = $category_control->category_codeList('alba_week');	// 알바근무요일
				$alba_pay_list = $category_control->category_codeList('alba_pay');		// 알바급여조건
				$alba_pay_type_list = $category_control->category_codeList('alba_pay_type');		// 알바급여지원조건

				$job_welfare = $category_control->category_codeList('job_welfare');		// 복리후생
				$job_welfare_cnt = count($job_welfare);
				$work_type_list = $category_control->category_codeList('work_type', '', 'yes');	// 근무형태
				$job_age = $category_control->category_codeList('job_age');		// 연령특이사항
				$job_ability_list = $category_control->category_codeList('job_ability', '', 'yes');		// 학력조건
				$job_career_list = $category_control->category_codeList('job_career', '', 'yes');		// 경력조건
				$preferential_list = $category_control->category_codeList('preferential', '', 'yes');	// 우대조건
				$preferential_list_cnt = count($preferential_list);
				$alba_content_list = $category_control->category_codeList('alba_content', '', 'yes');	// 상세모집요강항목

				$job_target = $category_control->category_codeList('job_target','','yes');	 // 모집대상

				$wr_work_type = explode(",",$get_alba['wr_work_type']);	// 근무형태

				$page = ($page) ? $page : 1;
				$con = " where `mb_id` = '".$mb_id."' ";
				$company_list = $member_control->__CompanyList($page,"",$con);

				$use_map = $env['use_map'];
				$daum_local_key = $env['daum_local_key'];
				$naver_map_key = $env['naver_map_key'];


				if($get_alba['wr_area_company']){	// 근무지 주소 0 : 직접입력 / 1 : 기업정보 위치
					$area_point = $company_member['mb_latlng'];
					$wr_area = $company_member['mb_biz_address0']." ".$company_member['mb_biz_address1'];
				} else {
					$area_point = $get_alba['wr_area_point'];
					$wr_area = $get_alba['wr_area'];
				}

				$wr_areas = explode(" ",$wr_area);
				$area_point_length = strlen($area_point);	// 네이년은 표준 WGS84 좌표를 사용하지 않기 때문에 길이 체크해서 변환해야 한다.

				if($mode=='insert'){
					$wr_area_point = "37.537187, 127.005476";
				} else if($mode=='update' || $mode=='reinsert' || $mode=='load'){
					$wr_area_point = $area_point;
				}

				$pt_papers = $category_control->category_codeList('pt_paper','','yes');	 // 제출서류

				$wr_papers = explode(',',$get_alba['wr_papers']);

?>

				<div id="add_form" class="bocol lnb_col" style="top:5%;left:33%;display:;">


				<form name="AlbaFrm" method="post" id="AlbaFrm" action="./process/regist.php" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="<?php echo $mode;?>" id="mode"/>
				<input type="hidden" name="ajax" value="1"/><!-- ajax mode 유무 -->
				<?php if($mode=='update'){ ?>
				<input type="hidden" name="no" value="<?php echo $no;?>"/>
				<?php } ?>
				<input type="hidden" name="wr_id" id="wr_id" value="<?php echo $mb_id;?>"/>
				<input type="hidden" name="type" id="type" value="<?php echo $mode;?>"/>
				<input type="hidden" name="company_info" id="company_info" value="<?php echo ($get_alba['company_no'])?$get_alba['company_no']:$company_member['no'];?>"/>
				<input type="hidden" name="wr_area_point" value="<?php echo ($mode=='insert')?"":$wr_area_point;?>" id="wr_area_point"/>

				<dl class="ntlt lnb_col m0 hand" id="memberFrmHandle">
					<img src="../../images/comn/bul_10.png" class="t">채용(알바)공고 <?php echo ($mode=='insert'||$mode=='load')?'등록':'수정';?>
					<span>( <b class="col">*</b> 표시는 필수 입력사항 )</span>
					<a onClick="MM_showHideLayers('add_form','','hide')"><img src="../../images/comn/pclose.png" class="lclose ln_col"></a>
				</dl>

				<table width="800" class="bg_col">
				<col width="100px"><col>
				<tr>
					<td class="ctlt">등록방법 <b class="col">*</b></td>
					<td class="pdlnb2">
					<?php if($mode=='update'){ ?>
						<input type="radio" class="chk" name="wr_input_type" id="wr_input_type_default" value="" <?php echo (!$input_type)?'checked':'';?> onclick="input_types(this);"/><label for="wr_input_type_default">사용자등록</label>&nbsp;
						<input type="radio" class="chk" name="wr_input_type" id="wr_input_type_self" value="self" <?php echo ($input_type=='self')?'checked':'';?> onclick="input_types(this);"/><label for="wr_input_type_self">직접등록</label>&nbsp;
						<input type="radio" class="chk" name="wr_input_type" id="wr_input_type_load" value="load" <?php echo ($input_type=='load')?'checked':'';?> onclick="input_types(this);"/><label for="wr_input_type_load">불러오기</label>
					<?php } else { ?>
						<input type="radio" class="chk" name="wr_input_type" id="wr_input_type_self" value="self" <?php echo ($input_type=='self'||!$input_type)?'checked':'';?> onclick="input_types(this);"/><label for="wr_input_type_self">직접등록</label>&nbsp;
						<input type="radio" class="chk" name="wr_input_type" id="wr_input_type_load" value="load" <?php echo ($input_type=='load')?'checked':'';?> onclick="input_types(this);"/><label for="wr_input_type_load">불러오기</label>
					<?php } ?>
					</td>
				</tr>
				<tr class="input_type_self" style="display:<?php echo ($input_type=='self'||!$input_type)?'':'none';?>;">
					<td class="ctlt">업체로고</td>
					<td class="pdlnb2">
						<!--  사진등록 layer  -->
						<div class="layerPop  lnb_col" style="display:none; border:2px solid #ddd; background:#fff; position:absolute; width:420px; top:5%; left:25%; text-align:left; z-index:9999;" id="mbPhotoPop">
							<dl style="">
								<dt style="background:#eee; padding:20px 15px;cursor:pointer;" class="" id="mbPhotoPop_handle">
									<strong>회사로고 등록</strong>
									<em class="closeBtn" onclick="close_mb_photos()"><img width="11" height="11" class="pb5" src="../../images/icon/icon_close2.gif" alt="close"></em>
								</dt>
								<dd style="padding:10px 15px;">
									<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
									<strong>200*100픽셀 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
									<div class="box2" style="border:1px solid #ddd; padding:10px;">
										<input type="file" name="mb_logo_files" id="mb_logo_files" size="32" style="height:20px;" class="txtForm">
									</div>
									<div  style="width:100px; margin:20px auto; " class=" btn font_gray bg_white block"><a class="block" style="padding:10px 20px;" href="javascript:mb_logo_submit();">등록하기</a></div>
								</dd>
							</dl>
						</div>
						<!--  //사진등록 layer   -->

						<div class="photoWrap positionR clearfix">
							<ul class="clearfix">
								<li style="padding-right:10px;float:left;width:120px;">
									<div class="photo"> <img src="<?php echo $wr_mb_logo;?>" style="max-width:120px; max-height:80px;"  alt="photo" id="mb_photo"> </div>
									<input type="hidden" name="mb_logo" id="mb_logo" value="<?php echo $get_alba['etc_0'];?>"/>
									<div class="mt5 tc buttonWrap"> 
										<a class="btn white" style="padding:2px 15px;" onclick="update_mb_logos('update');" id="mb_logo_update"> <span>등록</span> </a> 
									</div>
								</li>
							</ul>
						</div>

					</td>
				</tr>
				<tr class="input_type_load" style="display:none;">
					<td class="ctlt">회원선택 <b class="col">*</b></td>
					<td class="pdlnb2">
						<dt>
							<select style="width:260px;" name="mb_id" id="mb_id" onchange="get_member(this.value);">
							<option value="">기업회원 선택</option>
							<?php foreach($member_list['result'] as $val){ ?>
							<option value="<?php echo $val['mb_id'];?>" <?php echo ($val['mb_id']==$mb_id)?'selected':'';?>><?php echo $val['mb_id'];?> / <?php echo $val['mb_name'];?></option>
							<?php } ?>
							</select>
							<!-- <a href="../member/company.php?mode=insert" class="btn"><h1 class="btn23">회원등록</h1></a> -->
							<input name="mb_search" type="text" class="txt" style="width:150px;" id="mb_search">
							<a onClick="search_member();" class="cbtn lnb_col grf_col"><h1 class="btn19">회원검색</h1></a>
							<span class="subtlt">이름,아이디,이메일로 검색</span>
							<ul id="memlist" style="display:none;max-height:100px;overflow-y:auto" class="blnb wbg pd3 f11 mt5">
							<!-- loop -->
							<li style="line-height:20px" onMouseOver="this.className='bg hand'" onMouseOut="this.className=''" onClick="MM_showHideLayers('memlist','','hide')"><b>ㆍ</b>이름(아이디) / 이메일</li>
							<!-- loop -->
							</ul>
						</dt>
					</td>
				</tr>
				<tr id="alba_block" class="input_type_load" style="display:none;">
					<td class="ctlt">채용공고선택 </td>
					<td class="pdlnb2" id="alba_load">
					<?php $alba_list = $alba_control->get_alba_for_id($mb_id); ?>
						<select name='sel_alba' id='sel_alba' onchange="update_alba('load',this.value,'<?php echo $mb_id;?>');">
						<option value=''>채용공고선택</option>
						<?php
						foreach($alba_list as $val){
							$selected = ($no == $val['no']) ? 'selected' : '';
							echo "<option value='".$val['no']."' ".$selected.">".stripslashes($val['wr_subject'])."</option>";
						}
						?>
						</select>
					</td>
				</tr>
				<?php 
				if($mode=='update'){ 
					$manager_info = $company_manager_control->__ManagerList("",""," where `wr_id` = '".$mb_id."' ");
				} 
				?>
				<tr id="manager_info" style="display:<?php echo ($manager_info['result'])?'':'none';?>;">
					<td class="ctlt">담당자 선택</td>
					<td class="pdlnb2" id="manager_print">
					<?php 
					if($manager_info['result']){
						echo "<select name=\"manager_sel\" id=\"manager_sel\" onchange=\"manager_sels(this);\">";
						echo "<option value=\"\">담당자명</option>";
						foreach($manager_info['result'] as $val){
							$selected = ($val['wr_email']==$get_alba['wr_email'])?"selected":"";
							echo "<option value=\"".$val['no']."\" ".$selected.">".stripslashes($val['wr_name'])."</option>";
						}
						echo "</select>";
					}	// if end.
					?>
					</td>
				</tr>
				<tr>
					<td class="ctlt">담당자명</td>
					<td class="pdlnb2">
						<input style="width:255px;" name="wr_person" id="wr_person" type="text" class="txt" value="<?php echo $get_alba['wr_person'];?>" hname='담당자명'/>
					</td>
				</tr>
				<tr>
					<td class="ctlt">전화번호</td>
					<td class="pdlnb2">
						<select style="width:111px;" id="wr_phone0" name="wr_phone[]" title="지역번호 선택" hname="지역번호">
						<option value="">지역번호 선택</option>
						<?php echo $tel_num_option; ?>
						</select>
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="전화번호 앞자리" maxlength="4" id="wr_phone1" name="wr_phone[]" value="<?php echo $wr_phone[1];?>" hname="전화번호 앞자리">
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="전화번호 뒷자리" maxlength="4" id="wr_phone2" name="wr_phone[]" value="<?php echo $wr_phone[2];?>" hname="전화번호 뒷자리">
					</td>
				</tr>
				<tr>
					<td class="ctlt">휴대폰</td>
					<td class="pdlnb2">
						<select style="width:111px;" id="wr_hphone0" name="wr_hphone[]" title="휴대폰 국번" hname="휴대폰 국번">
						<option value="">국번</option>
						<?php echo $hp_num_option; ?>
						</select>
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="휴대폰 앞자리" maxlength="4" id="wr_hphone1" name="wr_hphone[]" value="<?php echo $wr_hphone[1];?>">
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="휴대폰 뒷자리" maxlength="4" id="wr_hphone2" name="wr_hphone[]" value="<?php echo $wr_hphone[2];?>">
					</td>
				</tr>
				<tr>
					<td class="ctlt">팩스번호</td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:111px;" id="wr_fax0" name="wr_fax[]" title="지역번호 선택" hname="지역번호">
						<option value="">지역번호 선택</option>
						<?php echo $fax_num_option; ?>
						</select>
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="팩스번호 앞자리" maxlength="4" id="wr_fax1" name="wr_fax[]" value="<?php echo $wr_fax[1];?>" hname="팩스번호 앞자리">
						<span class="delimiter">-</span>
						<input type="text" class="txt" title="팩스번호 뒷자리" maxlength="4" id="wr_fax2" name="wr_fax[]" value="<?php echo $wr_fax[2];?>" hname="팩스번호 뒷자리">					
					</td>
				</tr>
				<tr>
					<td class="ctlt">e-메일</td>
					<td class="pdlnb2">
						<input type="text" class="txt" style="width:108px;ime-mode:disabled;" maxlength="30" id="wr_email" name="wr_email[]" hname="이메일" value="<?php echo $wr_email[0];?>"><span class="delimiter">@</span>
						<input type="text" style="width:130px;ime-mode:disabled;" class="txt" maxlength="25" title="이메일 서비스 입력" id="wr_email_tail" name="wr_email[]" hname="이메일 서비스 제공자" value="<?php echo $wr_email[1];?>">
						<select class="ipSelect" style="width:140px;" id="email_service" onchange="email_sel(this);">
						<option value="">직접입력</option>
						<?php echo $email_option; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="ctlt">홈페이지(블로그)</td>
					<td class="pdlnb2">
						<input style="width:255px;ime-mode:inactive;" name="wr_page" id="wr_page" type="text" class="txt" value="<?php echo $get_alba['wr_page'];?>" hname='홈페이지' placeholder="http://"/>
					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				
				<tr id="company_info_block" style="display:<?php echo ($company_list['result'])?'':'none';?>;">
					<td class="ctlt">기업정보 선택</td>
					<td class="pdlnb2">
						<span id="company_info_display">
							<select name="company_info" onchange="company_info_load(this);">
							<option value="">기업정보 선택</option>
							<?php foreach($company_list['result'] as $val){ ?>
							<option value="<?php echo $val['no'];?>"><?php echo $val['mb_ceo_name']."/".$val['mb_company_name'];?></option>
							<?php } ?>
							</select>
						</span>
					</td>
				</tr>

				<tr>
					<td class="ctlt">근무회사/점포명<b class="col">*</b></td>
					<td class="pdlnb2">
						<input style="width:255px;ime-mode:active;" type="text" maxlength="16" class="txt" id="wr_company_name" name="wr_company_name" required hname="근무회사/점포명" value="<?php echo stripslashes($get_alba['wr_company_name']);?>">
					</td>
				</tr>
				<tr>
					<td class="ctlt">채용제목<b class="col">*</b></td>
					<td class="pdlnb2">
						<input type="text" class="txt w100" id="wr_subject" name="wr_subject" required hname="채용제목" value="<?php echo $wr_subject;?>">
					</td>
				</tr>
				<tr>
					<td class="ctlt">업직종<b class="col">*</b></td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:110px;" id="wr_job_type0" name="wr_job_type0" title="1차 직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type1');" required hname="1차직종">
						<option value="">= 1차 직종선택 =</option>
						<?php 
						if($job_type_list){
							foreach($job_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_job_type0 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						} // if end.
						?>
						</select>
						<span id="wr_job_type1_display">
							<select class="ipSelect" style="width:140px;" id="wr_job_type1" name="wr_job_type1" title="2차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type2');">
							<option value="">= 2차 직종선택 =</option>
							<?php
							if($wr_job_type1){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type0);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type1 == $val['code']) ? "selected" : "";
							?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">1차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>
						<span id="wr_job_type2_display">
							<select class="ipSelect" style="width:140px;" id="wr_job_type2" name="wr_job_type2" title="3차직종선택">
							<option value="">= 3차 직종선택 =</option>
							<?php
							if($wr_job_type2){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type1);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type2 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">2차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>
						<em>
						<input type="checkbox" class="typeCheckbox" id="wr_beginner" name="wr_beginner" value="1" <?php echo ($get_alba['wr_beginner'])?'checked':'';?>>
						<label for="wr_beginner">초보가능</label>
						</em> 					


						<div class="mt3">
						<select class="ipSelect" style="width:110px;" id="wr_jobtype_10" name="wr_job_type3" title="1차 직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type4');" required hname="1차직종">
						<option value="">= 1차 직종선택 =</option>
						<?php 
						if($job_type_list){
							foreach($job_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_job_type3 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						} // if end.
						?>
						</select>
						<span id="wr_job_type4_display">
							<select class="ipSelect" style="width:140px;" id="wr_jobtype_11" name="wr_job_type4" title="2차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type5');">
							<option value="">= 2차 직종선택 =</option>
							<?php
							if($wr_job_type4){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type3);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type4 == $val['code']) ? "selected" : "";
							?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">1차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>
						<span id="wr_job_type5_display">
							<select class="ipSelect" style="width:140px;" id="wr_jobtype_12" name="wr_job_type5" title="3차직종선택">
							<option value="">= 3차 직종선택 =</option>
							<?php
							if($wr_job_type5){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type4);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type5 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
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
						<select class="ipSelect" style="width:110px;" id="wr_jobtype_20" name="wr_job_type6" title="1차 직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type7');" required hname="1차직종">
						<option value="">= 1차 직종선택 =</option>
						<?php 
						if($job_type_list){
							foreach($job_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_job_type6 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						} // if end.
						?>
						</select>
						<span id="wr_job_type7_display">
							<select class="ipSelect" style="width:140px;" id="wr_jobtype_21" name="wr_job_type7" title="2차직종선택" onchange="insert_job_type_sel_first(this,'wr_job_type8');">
							<option value="">= 2차 직종선택 =</option>
							<?php
							if($wr_job_type7){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type6);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type7 == $val['code']) ? "selected" : "";
							?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">1차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>
						<span id="wr_job_type8_display">
							<select class="ipSelect" style="width:140px;" id="wr_jobtype_22" name="wr_job_type8" title="3차직종선택">
							<option value="">= 3차 직종선택 =</option>
							<?php
							if($wr_job_type8){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type7);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type8 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
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
					<td class="ctlt">근무지 주소<b class="col">*</b></td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:82px;" id="wr_area_00" name="wr_area_0[]" title="시·도 선택" onchange="insert_area_sel_first(this,'wr_area_01');" required hname="근무지 시·도">
						<option value="">시·도</option>
						<?php 
						if($area_list){
							foreach($area_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_area_0[0] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</select>
						<span id="wr_area_01_display">
							<select class="ipSelect" style="width:82px;" id="wr_area_01" name="wr_area_0[]" title="시군구 선택">
								<option value="">시군구</option>
								<?php
								if($wr_area_0[1]){
									$pcodeList = $category_control->category_pcodeList('area', $wr_area_0[0]);
									if($pcodeList){
										foreach($pcodeList as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_area_0[1] == $val['code']) ? "selected" : "";
								?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
										}	// foreach end.
									}	// if end.
								}	// if end.
								?>
							</select>
						</span>
						<span id="wr_area_02_display">
							<select class="ipSelect" style="width:82px;" id="wr_area_02" name="wr_area_0[]" title="읍면동 선택">
								<option value="">읍면동</option>
								<?php
								if($wr_area_0[2]){
									$pcodeList = $category_control->category_pcodeList('area', $wr_area_0[1]);
									if($pcodeList){
										foreach($pcodeList as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_area_0[2] == $val['code']) ? "selected" : "";
								?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
										}	// foreach end.
									}	// if end.
								}	// if end.
								?>
							</select>
						</span>

						<input type="text" maxlength="16" class="txt" style="width:135px;" id="wr_area_03" name="wr_area_0[]" value="<?php echo $wr_area_03_val;?>">

						<div class="mt3">
							<select class="ipSelect" style="width:82px;" id="wr_area_10" name="wr_area_1[]" title="시·도 선택" onchange="insert_area_sel_first(this,'wr_area_11');" required hname="근무지 시·도">
							<option value="">시·도</option>
							<?php 
							if($area_list){
								foreach($area_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area_1[0] == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
							</select>
							<span id="wr_area_11_display">
								<select class="ipSelect" style="width:82px;" id="wr_area_11" name="wr_area_1[]" title="시군구 선택">
									<option value="">시군구</option>
									<?php
									if($wr_area_1[1]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_1[0]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_1[1] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>
							<span id="wr_area_12_display">
								<select class="ipSelect" style="width:82px;" id="wr_area_12" name="wr_area_1[]" title="읍면동 선택">
									<option value="">읍면동</option>
									<?php
									if($wr_area_1[2]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_1[1]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_1[2] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>

							<input type="text" maxlength="16" class="txt" style="width:135px;" id="wr_area_13" name="wr_area_1[]" value="<?php echo $wr_area_13_val;?>">
						</div>

						<div class="mt3">
							<select class="ipSelect" style="width:82px;" id="wr_area_20" name="wr_area_2[]" title="시·도 선택" onchange="insert_area_sel_first(this,'wr_area_21');" required hname="근무지 시·도">
							<option value="">시·도</option>
							<?php 
							if($area_list){
								foreach($area_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area_2[0] == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
							</select>
							<span id="wr_area_21_display">
								<select class="ipSelect" style="width:82px;" id="wr_area_21" name="wr_area_2[]" title="시군구 선택">
									<option value="">시군구</option>
									<?php
									if($wr_area_2[1]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_2[0]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_2[1] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>
							<span id="wr_area_22_display">
								<select class="ipSelect" style="width:82px;" id="wr_area_22" name="wr_area_2[]" title="읍면동 선택">
									<option value="">읍면동</option>
									<?php
									if($wr_area_2[2]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_2[1]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_2[2] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>

							<input type="text" maxlength="16" class="txt" style="width:135px;" id="wr_area_23" name="wr_area_2[]" value="<?php echo $wr_area_23_val;?>">
						</div>

					</td>
				</tr>
				<tr>
					<td class="ctlt">인근지하철</td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:82px;" id="wr_subway_area_0" name="wr_subway_area_0" title="지역 선택" onchange="subway_sel_area(this,'wr_subway_line_0');" <?php echo ($form_subway['etc_0'])?'required':'';?> hname="지하철 지역">
						<option value="">지역</option>
						<?php 
						if($subway_list){
							foreach($subway_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_subway_area_0 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect" style="width:82px;" id="wr_subway_line_0" name="wr_subway_line_0" title="호선 선택" onchange="subway_sel_line(this,'wr_subway_station_0');" <?php echo ($form_subway['etc_0'])?'required':'';?> hname="지하철 호선">
						<option value="">호선</option>
						<?php
						if($wr_subway_line_0){
							$pcodeList = $category_control->category_pcodeList('subway', $wr_subway_area_0);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_subway_line_0 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect" style="width:82px;" id="wr_subway_station_0" name="wr_subway_station_0" title="지하철역 선택" <?php echo ($form_subway['etc_0'])?'required':'';?> hname="지하철역">
						<option value="">지하철역</option>
						<?php
						if($wr_subway_station_0){
							$pcodeList = $category_control->category_pcodeList('subway', $wr_subway_line_0);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_subway_station_0 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
						<input type="text" maxlength="16" class="txt" style="width:135px;" id="wr_subway_content_0" name="wr_subway_content_0" value="<?php echo $wr_subway_content_0_val;?>">
						<!-- <em style="right:0; top:5px;" class="positionA insert"> <a class="button white" onclick="add_subway();"><span>+추가</span></a> </em>  -->					
					</td>
				</tr>
				<tr>
					<td class="ctlt">근무지 지도위치</td>
					<td class="pdlnb2">
						<input type="radio" class="chk" name="wr_area_company" value="0" id="wr_area_company_0" checked onclick="wr_areas(this);"><label for="wr_area_company_0">직접입력</label>&nbsp;
						<input type="radio" class="chk" name="wr_area_company" value="1" id="wr_area_company_1" <?php echo ($get_alba['wr_area_company'])?'checked':'';?> onclick="wr_areas(this);"><label for="wr_area_company_1">기업정보위치</label>
					</td>
				</tr>
				<tr id="wr_area_block" style="display:<?php echo ($get_alba['wr_area_company'])?'none':'';?>;">
					<td class="ctlt">지도검색</td>
					<td class="pdlnb2">
						<input type="text" class="txt" style="width:480px;" id="wr_area" name="wr_area" value="<?php echo $wr_area;?>" placeholder="주소">
						<em><a class="button" onclick="execDaumPostcode();"><span>주소검색</span></a></em> 
						<div id="map" style="margin-top:5px;width:490px;height:250px;"></div>
					</td>
				</tr>
				<tr>
					<td class="ctlt">인근대학</td>
					<td class="pdlnb2">
						<select class="ipSelect" style="width:82px;" id="wr_college_area" name="wr_college_area" title="지역 선택" onchange="college_area(this,'wr_college_vicinity');" <?php echo ($form_college['etc_0'])?'required':'';?> hname="인근대학 지역">
						<option value="">지역</option>
						<?php 
						if($area_list){
							foreach($area_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_college_area == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect" style="width:310px;" id="wr_college_vicinity" name="wr_college_vicinity" title="인근대학 선택" <?php echo ($form_college['etc_0'])?'required':'';?> hname="인근대학">
						<option value="">인근대학 선택</option>
						<?php
						if($wr_college_vicinity){
							$pcodeList = $category_control->category_pcodeList('job_college', $wr_college_area);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_college_vicinity == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>					
					</td>
				</tr>
				<tr>
					<td class="ctlt">근무회사 이미지</td>
					<td class="pdlnb2">

					<!--  사진등록 layer  -->
					<div class="layerPop  lnb_col" style="display:none; border:2px solid #ddd; background:#fff; position:absolute; width:420px; top:20%; left:25%; text-align:left; z-index:9999;" id="albaPhotoPop">
						<input type="hidden" name="alba_photos" id="alba_photos"/>
						<dl style="">
							<dt style="background:#eee; padding:20px 15px;cursor:pointer;" class="" id="albaPhotoPop_handle">
								<strong>근무회사 이미지 등록</strong>
								<em class="closeBtn" onclick="close_alba_photos()"><img width="11" height="11" class="pb5" src="../../images/icon/icon_close2.gif" alt="close"></em>
							</dt>
							<dd style="padding:10px 15px;">
								<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
								<strong>500KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
								<div class="box2" style="border:1px solid #ddd; padding:10px;">
									<input type="file" name="alba_photo_files" id="alba_photo_files" size="32" style="height:20px;" class="txtForm">
								</div>
								<div  style="width:100px; margin:20px auto; " class=" btn font_gray bg_white block"><a class="block" style="padding:10px 20px;" href="javascript:alba_photo_submit();">등록하기</a></div>
							</dd>
						</dl>
					</div>
					<!--  //사진등록 layer   -->

					<div class="photoWrap positionR clearfix">
						<ul class="clearfix">
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="photo"> <img src="<?php echo $wr_photo_0;?>" width="100%" height="100%"  alt="photo" id="alba_photo_0"> </div>
								<input type="hidden" name="wr_photo_0" id="wr_photo_0"/>
								<div class="mt5 tc buttonWrap"> 
									<a class="btn white" style="padding:2px 15px;" onclick="update_alba_photos('update', 0);" id="alba_update_0"> <span>등록</span> </a> 
								</div>
							</li>
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="photo"> <img src="<?php echo $wr_photo_1;?>" width="100%"height="100%"   alt="photo" id="alba_photo_1"> </div>
								<input type="hidden" name="wr_photo_1" id="wr_photo_1"/>
								<div class="mt5 tc buttonWrap"> 
									<a class="btn white" style="padding:2px 15px;" onclick="update_alba_photos('update', 1);" id="alba_update_1"> <span>등록</span> </a> 
								</div>
							</li>
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="photo"> <img src="<?php echo $wr_photo_2;?>" width="100%" height="100%" alt="photo" id="alba_photo_2"> </div>
								<input type="hidden" name="wr_photo_2" id="wr_photo_2"/>
								<div class="mt5 tc buttonWrap"> 
									<a class="btn white"  style="padding:2px 15px;" onclick="update_alba_photos('update', 2);" id="alba_update_2"> <span>등록</span> </a> 
								</div>
							</li>
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="photo"> <img src="<?php echo $wr_photo_3;?>" width="100%" height="100%" alt="photo" id="alba_photo_3"> </div>
								<input type="hidden" name="wr_photo_3" id="wr_photo_3"/>
								<div class="mt5 tc buttonWrap"> 
									<a class="btn white"  style="padding:2px 15px;"  onclick="update_alba_photos('update', 3);" id="alba_update_3"> <span>등록</span> </a> 
								</div>
							</li>
							<li style="padding-right:10px;float:left;width:120px;">
								<div class="photo"> <img src="<?php echo $wr_photo_4;?>" width="100%" height="100%" alt="photo" id="alba_photo_4"> </div>
								<input type="hidden" name="wr_photo_4" id="wr_photo_4"/>
								<div class="mt5 tc buttonWrap"> 
									<a class="btn white"  style="padding:2px 15px;"  onclick="update_alba_photos('update', 4);" id="alba_update_4"> <span>등록</span> </a> 
								</div>
							</li>
						</ul>
						<!-- <em class="positionA" style="right:80px; top:40px;">
							<input type="checkbox"  class="typeCheckbox" id="wr_use_photo" name="wr_use_photo" value="1" onclick="use_photo(this);" <?php echo ($get_alba['wr_use_photo'])?'checked':'';?>>
							<label for="wr_use_photo">회사이미지 사용</label>
						</em>  -->
					</div>					
					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">근무기간<b class="col">*</b></td>
					<td class="pdlnb2">
						<?php 
						if($alba_date_list){
							foreach($alba_date_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = ($get_alba['wr_date'] == $val['code']) ? "checked" : "";
						?>
						<input type="radio" class="chk" id="wr_date_<?php echo $val['code'];?>" name="wr_date" value="<?php echo $val['code'];?>" required hname="근무기간" option="radio" <?php echo $checked;?>><label for="wr_date_<?php echo $val['code'];?>"><?php echo $name;?></label>
						<?php 
							}	// foreach end.
						}	// if end.
						?>					
					</td>
				</tr>
				<tr>
					<td class="ctlt">근무요일<b class="col">*</b></td>
					<td class="pdlnb2">
						<?php 
						if($alba_week_list){
							foreach($alba_week_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = ($get_alba['wr_week'] == $val['code']) ? "checked" : "";
						?>
						<input type="radio" title="<?php echo $name;?>" class="chk" id="wr_week_<?php echo $val['code'];?>" name="wr_week" value="<?php echo $val['code'];?>" required hname="근무기간" option="radio" <?php echo $checked;?>><label for="wr_week_<?php echo $val['code'];?>"><?php echo $name;?></label>&nbsp;
						<?php 
							}	// foreach end.
						}	// if end.
						?>					
					</td>
				</tr>
				<tr>
					<td class="ctlt">근무시간<b class="col">*</b></td>
					<td class="pdlnb2">
						<select style="width:82px;" class="ipSelect wr_time" name="wr_stime[]" id="wr_stime" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
						<option value="">선택</option>
						<?php for($i=0;$i<=23;$i++){ ?>
						<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_stime[0]&&$wr_stime[0]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
						<?php } ?>
						</select>
						<select style="width:82px;"class="ipSelect wr_time" name="wr_stime[]" id="wr_smin" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
						<option value="">선택</option>
						<?php for($i=0;$i<=5;$i++){?>
						<option value="<?php echo $i;?>0" <?php echo ($wr_stime[1]==$i.'0')?'selected':'';?>><?php echo $i;?>0분</option>
						<?php } ?>
						</select>
						<span id="nextworktime">~</span>
						<select style="width:82px;"class="ipSelect wr_time" name="wr_etime[]" id="wr_etime" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
						<option value="">선택</option>
						<?php for($i=0;$i<=23;$i++){ ?>
						<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_etime[0]&&$wr_etime[0]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
						<?php } ?>
						</select>
						<select style="width:82px;"class="ipSelect wr_time" name="wr_etime[]" id="wr_emin" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
						<option value="">선택</option>
						<?php for($i=0;$i<=5;$i++){?>
						<option value="<?php echo $i;?>0" <?php echo ($wr_etime[1]==$i.'0')?'selected':'';?>><?php echo $i;?>0분</option>
						<?php } ?>
						</select>
						<input type="checkbox" class="typeCheckbox" id="wr_time_conference" name="wr_time_conference" value="1" onclick="time_conference(this);"  <?php echo ($wr_time_conference)?'checked':'';?>>
						<label for="wr_time_conference">시간협의</label>					
					</td>
				</tr>
				<tr>
					<td class="ctlt">급여<b class="col">*</b></td>
					<td class="pdlnb2">
						<select style="width:82px;" class="ipSelect" name="wr_pay_type" id="wr_pay_type" hname="급여조건" option="select" onchange="pay_types(this,'type');">
						<option value="">= 급여 =</option>
						<?php 
						if($alba_pay_list){
							foreach($alba_pay_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_alba['wr_pay_type'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</select>
						<input style="width:155px;" type="text" maxlength="10" class="txt" name="wr_pay" id="wr_pay" style="ime-mode:inactive;" <?php echo ($get_alba['wr_pay_conference'])?'disabled':'required';?> hname="급여금액" value="<?php echo $get_alba['wr_pay'];?>" placeholder="0" data-v-min="0" data-v-max="10000000000">
						<label for="wr_pay">원</label>
						<?php if($env['pay_view']){?><em class="text_help"> 최저임금 : 시급 <strong class="txtEng"><?php echo number_format($env['time_pay']);?>원</strong></em><?php } ?>
						<p class="pt10 pb3"> 
							<span class="lowpay">
								<input type="radio" class="chk" name="wr_pay_conference" value="1" id="wr_pay_conference_1" <?php echo ($get_alba['wr_pay_conference']=='1')?'checked':'';?> onclick="pay_types(this,'conference');"/><label for="wr_pay_conference_1">추후협의</label>&nbsp;
								<input type="radio" class="chk" name="wr_pay_conference" value="2" id="wr_pay_conference_2" <?php echo ($get_alba['wr_pay_conference']=='2')?'checked':'';?> onclick="pay_types(this,'conference');"/><label for="wr_pay_conference_2">면접후결정</label>
								<!-- <input type="checkbox" class="chk" id="wr_pay_conference" name="wr_pay_conference" value="1" <?php echo ($get_alba['wr_pay_conference'])?'checked':'';?>>
								<label for="wr_pay_conference">협의가능</label> -->
								<?php if($env['pay_view']){?><em class="text_help"> (당사는 본 채용건과 관련하여 '최저임금법'을 준수합니다.)</em> <?php } ?>
							</span> 
						</p>
						<p class="pb3">
							<?php
							if($alba_pay_type_list){
								foreach($alba_pay_type_list as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$checked = (@in_array($val['code'],$wr_pay_support)) ? "checked" : "";
							?>
							<input type="checkbox" class="chk" id="wr_pay_support_<?php echo $val['code'];?>" name="wr_pay_support[]" value="<?php echo $val['code'];?>" <?php echo (@in_array($val['code'],$wr_pay_support))?'checked':'';?>><label for="wr_pay_support_<?php echo $val['code'];?>"><?php echo $name;?></label>&nbsp;
							<?php 
								}	// foreach end.
							}	// if end.
							?>
						</p>				
					</td>
				</tr>

				<tr>
					<td class="ctlt">근무형태<b class="col">*</b></td>
					<td class="pdlnb2">
						<?php 
						if($work_type_list){ 
							foreach($work_type_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_work_type)) ? 'checked' : '';
						?>
							<input type="checkbox" class="chk" name="wr_work_type[]" value="<?php echo $val['code'];?>" id="wr_work_type_<?php echo $val['code'];?>" required hname="근무형태" option="checkbox" <?php echo $checked;?>><label for="wr_work_type_<?php echo $val['code'];?>"><?php echo $name;?></label>&nbsp;
						<?php
							}	// foreach end.
						}	// if end.
						?>
					</td>
				</tr>


				<tr>
					<td class="ctlt">복리후생</td>
					<td class="pdlnb2">
						<input type="text" style="width:255px;" class="txt" id="welfare_read" name="welfare_read" readonly onfocus="welfare_open();" value="<?php echo $get_alba['wr_welfare_read'];?>" hname="복리후생">
						<em class="pr10"><a class="btn" style="padding:0 10px;" onclick="welfare_open();"><span >선택</span></a></em>

						<!-- 복리후생 선택 -->          
						<div style="z-index:10000;  display:none; position:absolute; top:25%; left:20%; background:#fff;"  class=" dev_lywel" id="welfareLayer"> 
							<div id="welfar" class="layerGireg border_color5">
							<dl>
								<dt class="positionL bg_color4">복리후생 선택</dt>
								<dd class="lgBody">
									<table summary="복리후생을 선택할 수 있습니다.">
									<colgroup><col width="100px"><col width="*"></colgroup>
									<tbody>
									<?php
									if($job_welfare){
										$i = 1;
										foreach($job_welfare as $val){
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$tbg = ($i%2==0)?"class='tbg'":"";
										$bbend = ($i==$job_welfare_cnt) ? "class='bbend'" : "";
										$wrlfare = $wr_welfare[$val['code']];
									?>
									<tr <?php echo $tbg;?>>
										<th scope="row" <?php echo $bbend;?>><?php echo $name;?></th>
										<td <?php echo $bbend;?>>
											<ul>
												<?php
													$pcodeList = $category_control->category_pcodeList('job_welfare', $val['code']);
													foreach($pcodeList as $pval){
													$p_name = $utility->remove_quoted($pval['name']);	 // (쌍)따옴표 등록시 필터링
													$checked = (@in_array($pval['code'],$wrlfare)) ? "checked" : "";
												?>
												<li>
													<input type="checkbox" value="<?php echo $pval['code'];?>" id="wr_welfare_<?php echo $pval['code'];?>" name="wr_welfare[<?php echo $val['code'];?>][]" onclick="welfare_sel(this);" class="welfare_check" <?php echo $checked;?>><label for="wr_welfare_<?php echo $pval['code'];?>" id="label_welfare_<?php echo $pval['code'];?>"><?php echo $p_name;?></label>&nbsp;
												</li>
												<?php } ?>
											</ul>
										</td>
									</tr>
									<?php 
										$i++;
										}	// foreach end.
									}	// if end.
									?>
									</tbody>
									</table>
								</dd>
							</dl>
							<span class="closeBtn">
								<img class="onclick" alt="닫기" src="../../images/icon/icon_close3.gif" width="11" height="11" onclick="welfare_close();">
							</span> 
							</div>
						</div>
						<!-- 복리후생 선택 -->   

					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">성별<b class="col">*</b></td>
					<td class="pdlnb2">
						<input type="radio" class="chk" value="0" id="wr_gender_0" name="wr_gender" hname="성별" option="radio" <?php echo ($get_alba['wr_gender']=='0')?'checked':'';?>><label for="wr_gender_0">성별무관</label>&nbsp;
						<input type="radio" class="chk" value="1" id="wr_gender_1" name="wr_gender" hname="성별" option="radio" <?php echo ($get_alba['wr_gender']=='1')?'checked':'';?>><label for="wr_gender_1">남자</label>&nbsp;
						<input type="radio" class="chk" value="2" id="wr_gender_2" name="wr_gender" hname="성별" option="radio" <?php echo ($get_alba['wr_gender']=='2')?'checked':'';?>><label for="wr_gender_2">여자</label>
					</td>
				</tr>
				<tr>
					<td class="ctlt">연령<b class="col">*</b></td>
					<td class="pdlnb2">
						<label><input type="radio" class="chk" id="wr_age_limit_0" name="wr_age_limit" value="0" onclick="age_sel(this);" <?php echo ($form_age['etc_0'])?'required':'';?> hname="연령" option="radio" <?php echo ($wr_age_limit=='0')?'checked':'';?>>연령무관</label>&nbsp;
						<label><input type="radio"  class="chk" id="wr_age_limit_1" name="wr_age_limit" value="1" onclick="age_sel(this);" <?php echo ($form_age['etc_0'])?'required':'';?> hname="연령" option="radio" <?php echo ($wr_age_limit=='1')?'checked':'';?>>연령제한 있음</label>&nbsp;

						<span id="wr_age_display" style="display: <?php echo ($wr_age_limit)?'':'none';?>;">
							<input type="text"  maxlength="2" style="width:30px;text-align:center;" class="txt wr_age" id="wr_sage" name="wr_sage" value="<?php echo $wr_age[0];?>" <?php echo ($wr_age_limit)?'required':'';?> hname="제한연령">
							<label>세 이상~</label>
							<input type="text"  maxlength="2" style="width:30px;text-align:center;" class="txt wr_age" id="wr_eage" name="wr_eage" value="<?php echo $wr_age[1];?>" <?php echo ($wr_age_limit)?'required':'';?> hname="제한연령">
							<label>세 이하</label>
							<!-- <span class="age">(<strong class="selectCnt" name="YearConv1" id="YearConv1"></strong>년생 이상~<strong class="selectCnt" name="YearConv2" id="YearConv2"></strong>년생 이하)
							</span> -->
						</span>
						<span class="addCnt">
							<?php
							if($job_age) {
								foreach($job_age as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$checked = (@in_array($val['code'],$wr_age_etc)) ? "checked" : "";
							?>
							<label><input type="checkbox" id="wr_age_etc_<?php echo $val['code'];?>" name="wr_age_etc[]" value="<?php echo $val['code'];?>" <?php echo $checked;?>> <?php echo $name;?></label>&nbsp;
							<?php 
								} // foreach end.
							}	// if end.
							?>
						
						</span>					
					</td>
				</tr>
				<tr>
					<td class="ctlt">학력조건<b class="col">*</b></td>
					<td class="pdlnb2">
						<?php
						if($job_ability_list) {
							foreach($job_ability_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = ($get_alba['wr_ability']==$val['code']) ? "checked" : "";
						?>
						<label><input type="radio" id="wr_ability_<?php echo $val['code'];?>" name="wr_ability" value="<?php echo $val['code'];?>" required hname="학력조건" option="radio" <?php echo $checked;?>> <?php echo $name;?></label>&nbsp;
						<?php 
							} // foreach end.
						}	// if end.
						?>					
					</td>
				</tr>
				<tr>
					<td class="ctlt">경력사항<b class="col">*</b></td>
					<td class="pdlnb2">
						<label><input type="radio" id="wr_career_type_0" name="wr_career_type" value="0" onclick="career_sels(this);" required hname="경력사항" option="radio" <?php echo ($wr_career_type=='0')?'checked':'';?>> 경력무관</label>&nbsp;
						<label><input type="radio" id="wr_career_type_1" name="wr_career_type" value="1" onclick="career_sels(this);" required hname="경력사항" option="radio" <?php echo ($wr_career_type=='1')?'checked':'';?>> 신입</label>&nbsp;
						<label><input type="radio" id="wr_career_type_2" name="wr_career_type" value="2" onclick="career_sels(this);" required hname="경력사항" option="radio" <?php echo ($wr_career_type=='2')?'checked':'';?>> 경력</label>

						<span id="wr_careers_display" style="display: <?php echo ($wr_career_type=='2')?'':'none';?>;">
							<select class="ipSelect" name="wr_career" id="wr_career" <?php echo ($get_alba['wr_career_type']=='2')?'required':'';?> hname="경력" option="select">
							<option value="">= 경력선택 =</option>
							<?php
							if($job_career_list) {
								foreach($job_career_list as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($get_alba['wr_career']==$val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								} // foreach end.
							}	// if end.
							?>
							</select>
							이상
						</span>					
					</td>
				</tr>
				<tr>
					<td class="ctlt">우대조건</td>
					<td class="pdlnb2">
						<ul class="preferenceTerms">
						<?php
						if($preferential_list) {
							$i = 0;
							foreach($preferential_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$end = ($i==$preferential_list_cnt)?"class='end'":"";
							$checked = (@in_array($val['code'],$wr_preferential)) ? "checked" : "";
						?>
							<li class="fl pr10"<?php echo $end;?>>
								<input type="checkbox" class="chk" id="wr_preferential_<?php echo $val['code'];?>" name="wr_preferential[]" value="<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_preferential_<?php echo $val['code'];?>"><?php echo $name;?></label>&nbsp;
							</li>
						<?php 
							$i++;
							} // foreach end.
						}	// if end.
						?>
						</ul>					
					</td>
				</tr>
				<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
				<tr>
					<td class="ctlt">모집인원<b class="col">*</b></td>
					<td class="pdlnb2">
						<input type="text" maxlength="5" style="width:110px;text-align:center;" class="txt" id="wr_volume" name="wr_volume" value="<?php echo $get_alba['wr_volume'];?>" <?php echo (@in_array('0',$wr_volumes)||@in_array('00',$wr_volumes))?'':'required';?> hname="모집인원"> <label>명</label>&nbsp;
						<input type="checkbox" class="chk" id="volume_0" name="wr_volumes[]" value="0" onclick="volume_sel(this);" <?php echo (@in_array('0',$wr_volumes))?'checked':'';?>><label for="volume_0">0명</label>&nbsp;
						<input type="checkbox" class="chk" id="volume_00" name="wr_volumes[]" value="00" onclick="volume_sel(this);" <?php echo (@in_array('00',$wr_volumes))?'checked':'';?>><label for="volume_00">00명</label>
					</td>
				</tr>
				<tr>
					<td class="ctlt">모집대상</td>
					<td class="pdlnb2">
						<?php
							foreach($job_target as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						?>
						<input type="checkbox" class="chk" name="wr_target[]" value="<?php echo $val['code'];?>" id="wr_target_<?php echo $val['code'];?>"/><label for="wr_target_<?php echo $val['code'];?>"><?php echo $name;?></label>&nbsp;
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td class="ctlt">모집종료일<b class="col">*</b></td>
					<td class="pdlnb2">
						<input type="radio" class="chk" name="volume_check" value="wr_volume_dates" checked/>
						<input type="text" style="width:165px;" class="txt" id="wr_volume_dates" name="wr_volume_date" hname="모집종료일" value="<?php echo $get_alba['wr_volume_date'];?>">
						<em class="pr10"><a class="btn" id="volume_date_sels"><span>날짜선택</span></a></em>
						<label><input type="radio" class="chk" name="volume_check" value="wr_volume_always" id="wr_volume_always" <?php echo ($get_alba['wr_volume_always'])?'checked':'';?>/>상시모집</label>&nbsp;
						<label><input type="radio" class="chk" name="volume_check" value="wr_volume_end" id="wr_volume_end" <?php echo ($get_alba['wr_volume_end'])?'checked':'';?>/>채용시까지</label>
					</td>
				</tr>
				<tr>
					<td class="ctlt">접수방법<b class="col">*</b></td>
					<td class="pdlnb2">
						<div class="passtypeWrap pb5 clearfix">
							<ul>
								<li class="fl pr10">
									<input type="checkbox" class="chk requisition_chk" id="wr_requisition_online" name="wr_requisition[]" value="online" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('online',$wr_requisition))?'checked':'';?>><label for="wr_requisition_online"><strong class="text_orange">온라인지원</strong></label>
								</li>
								<li class="fl pr10">
									<input type="checkbox" class="chk requisition_chk" id="wr_requisition_email" name="wr_requisition[]" value="email" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('email',$wr_requisition))?'checked':'';?>><label for="wr_requisition_email"><strong class="text_orange">e-메일지원</strong></label>
								</li>
								<li class="fl pr10">
									<input type="checkbox" class="chk" id="wr_requisition_phone" name="wr_requisition[]" value="phone" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('phone',$wr_requisition))?'checked':'';?>><label for="wr_requisition_phone">전화연락</label>
								</li>
								<li class="fl pr10">
									<input type="checkbox" class="chk" id="wr_requisition_meet" name="wr_requisition[]" value="meet" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('meet',$wr_requisition))?'checked':'';?>><label for="wr_requisition_meet">방문접수</label>
								</li>
								<li class="fl pr10">
									<input type="checkbox" class="chk" id="wr_requisition_post" name="wr_requisition[]" value="post" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('post',$wr_requisition))?'checked':'';?>><label for="wr_requisition_post">우편</label>
								</li>                
								<li class="fl pr10">
									<input type="checkbox" class="chk" id="wr_requisition_fax" name="wr_requisition[]" value="fax" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('fax',$wr_requisition))?'checked':'';?>><label for="wr_requisition_fax">팩스</label>
								</li>
								<li class="fl pr10">
									<input type="checkbox" class="chk" id="wr_requisition_homepage" name="wr_requisition[]" value="homepage" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('homepage',$wr_requisition))?'checked':'';?>><label for="wr_requisition_homepage">홈페이지</label>
								</li>
							</ul>
						</div>

						<div class="homepage requisition" id="homepage_input" style="display: <?php echo (@in_array('homepage',$wr_requisition))?'':'none';?>;">
							http:// <input type="text" style="width:400px;" class="txt" id="wr_homepage" name="wr_homepage" value="<?php echo $get_alba['wr_homepage'];?>">
						</div>
						<div class="emailLayer requisition" id="form_input" style="display: <?php echo (@in_array('online',$wr_requisition)||@in_array('email',$wr_requisition))?'':'none';?>;">
							<input type="checkbox" class="chk" id="wr_form" name="wr_form" value="1" <?php echo ($get_alba['wr_form'])?'checked':'';?> onclick="attach_view(this);"> 
							<label for="wr_form">자사양식지원</label>
								<span id="acceptmethod2AttachChoice">
								(
								<input type="radio" id="wr_form_required_1" class="chk" name="wr_form_required" value="1" checked> 
								<label for="wr_form_required_1">필수</label>,
								<input type="radio" id="wr_form_required_0" class="chk" name="wr_form_required" value="0" <?php echo (!$get_alba['wr_form_required'])?'checked':'';?>> 
								<label for="wr_form_required_0">선택</label>
								)
								<input type="file" class="txtForm" style="width:200px; height:20px;display:none;" size="32" id="wr_form_attach" name="wr_form_attach" value="<?php echo $get_alba['wr_form_attach'];?>">
								<?php if($get_alba['wr_form_attach']){ // 등록된 양식 파일이 있다면?>
								<div style="padding-top:5px;">등록된 파일 :: <a href="javascript:file_download('<?php echo $alice['alba_path'];?>/download.php?no=<?php echo $no;?>','<?php echo $get_alba['wr_form_attach'];?>');"><?php echo $wr_form_attach[1];?></a></div>
								<?php } ?>
							</span>
						</div>				
					</td>
				</tr>
				<tr>
					<td class="ctlt">제출서류</td>
					<td class="pdlnb2">
						<ul>
						<?php 
							foreach($pt_papers as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						?>
							<li class="fl pr10">
								<input type="checkbox" class="chk" id="wr_papers_<?php echo $val['code'];?>" name="wr_papers[]" value="<?php echo $name;?>" <?php echo (@in_array($name,$wr_papers))?'checked':'';?> hname="제출서류" option="checkbox"><label for="wr_papers_<?php echo $val['code'];?>"><?php echo $name;?></label>
							</li>
						<?php } ?>
						</ul>					
					</td>
				</tr>
				<tr>
					<td class="ctlt">사전질문</td>
					<td class="pdlnb2">
						<em class="text_help">사전인터뷰 질문을 등록하시면 온라인 입사지원시 지원자가 이력서와 함께 질문에 대한 답변을 작성해서 보냅니다.</em>
						<textarea style="width:100%; height:100px;  border:1px solid #ddd;" id="wr_pre_question" class="txt" name="wr_pre_question" <?php echo ($form_question['etc_0'])?'required':'';?> hname="사전질문"><?php echo stripslashes($get_alba['wr_pre_question']);?></textarea>
					</td>
				</tr>
				<tr>
					<td class="ctlt">상세모집요강<b class="col">*</b></td>
					<td class="pdlnb2">
						<?php echo $utility->make_cheditor("wr_content", stripslashes($get_alba['wr_content']));	// 에디터 생성?>
					</td>
				</tr>
				</table>

				<dl class="pbtn">  
					<!-- <input type='image' src="../../images/btn/b23_02.png" class="ln_col"> -->
					<img src="../../images/btn/b23_02.png" class="ln_col hand" onclick="AlbaFrm_submit();">&nbsp;
					<a onClick="MM_showHideLayers('add_form','','hide')"><img src="../../images/btn/23_10.gif"></a></a>
				</dl>
			
			</form>
			</div>

			<script>
			var wr_areas = function( vals ){
				var sel = vals.value;
				if(sel=='1'){
					$('#wr_area_block').hide();
				} else {
					$('#wr_area_block').show();
					<?php if($use_map=='naver'){ ?>
					var area_point_length = Number(<?php echo $area_point_length;?>);
					if(area_point_length <= 24){
						map_api.map_use("map", "", true);	// 지도 띄우기
						map_api.map_location_move(<?php echo $wr_area_point;?>);
						map_api.marker_false();
						map_api.addMark();
						map_api.click_event('','',<?php echo $wr_area_point;?>,'wr_area_point');
					} else {
						var search_addr = "<?php echo $wr_areas[0].$wr_areas[1].$wr_areas[2].$wr_areas[3];?>";
						$.post('../../company/views/_ajax/area_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
							var data = eval("(" + result + ")");
							var point_y = data.mapy;
							var point_x = data.mapx;
							map_api.map_use("map", "", true);	// 지도 띄우기
							map_api.map_location_move(point_x,point_y);
							map_api.marker_false();
							map_api.addMark();
							map_api.click_event('','',point_x,point_y,'wr_area_point');
						});
					}
					<?php } ?>
				}
			}

			<?php if($use_map=='daum'){ ?>
				var mapContainer = document.getElementById('map'), // 지도를 표시할 div
					mapOption = {
						center: new daum.maps.LatLng(<?php echo $wr_area_point;?>), // 지도의 중심좌표
						level: 5 // 지도의 확대 레벨
					};
				//지도를 미리 생성
				var map = new daum.maps.Map(mapContainer, mapOption);
				// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
				var mapTypeControl = new daum.maps.MapTypeControl();
				// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
				// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
				map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);
				// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
				var zoomControl = new daum.maps.ZoomControl();
				map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);
				//주소-좌표 변환 객체를 생성
				var geocoder = new daum.maps.services.Geocoder();
				//마커를 미리 생성
				var marker = new daum.maps.Marker({
					position: new daum.maps.LatLng(<?php echo $wr_area_point;?>),
					map: map
				});
			<?php } else if($use_map=='naver'){ ?>
				var area_point_length = Number(<?php echo $area_point_length;?>);
				if(area_point_length <= 24){
					map_api.map_use("map", "", true);	// 지도 띄우기
					map_api.map_location_move(<?php echo $wr_area_point;?>);
					map_api.marker_false();
					map_api.addMark();
					map_api.click_event('','',<?php echo $wr_area_point;?>,'wr_area_point');
				} else {
					var search_addr = "<?php echo $wr_areas[0].$wr_areas[1].$wr_areas[2].$wr_areas[3];?>";
					$.post('../../company/views/_ajax/area_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
						var data = eval("(" + result + ")");
						var point_y = data.mapy;
						var point_x = data.mapx;
						map_api.map_use("map", "", true);	// 지도 띄우기
						map_api.map_location_move(point_x,point_y);
						map_api.marker_false();
						map_api.addMark();
						map_api.click_event('','',point_x,point_y,'wr_area_point');
					});
				}
			<?php } else if($use_map=='google'){ ?>
				map_api.map_point = [<?php echo $wr_area_point;?>,'18'];
				map_api.map_use("map", "", true);
				map_api.click_event('','',<?php echo $wr_area_point;?>,'wr_area_point');
				map_api.addMark();
			<?php } ?>

			// 우편번호 찾기 화면을 넣을 element
			function execDaumPostcode() {
				new daum.Postcode({
					oncomplete: function(data) {
						// 각 주소의 노출 규칙에 따라 주소를 조합한다.
						// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
						var fullAddr = data.address; // 최종 주소 변수
						var extraAddr = ''; // 조합형 주소 변수

						// 기본 주소가 도로명 타입일때 조합한다.
						if(data.addressType === 'R'){
							//법정동명이 있을 경우 추가한다.
							if(data.bname !== ''){
								extraAddr += data.bname;
							}
							// 건물명이 있을 경우 추가한다.
							if(data.buildingName !== ''){
								extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
							}
							// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
							fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
						}

						// 주소 정보를 해당 필드에 넣는다.
						document.getElementById("wr_area").value = fullAddr;

						<?php if($use_map=='daum'){ ?>

							// 주소로 좌표를 검색
							geocoder.addr2coord(data.address, function(status, result) {
								// 정상적으로 검색이 완료됐으면
								if (status === daum.maps.services.Status.OK) {
									// 해당 주소에 대한 좌표를 받아서
									var coords = new daum.maps.LatLng(result.addr[0].lat, result.addr[0].lng);
									// 지도를 보여준다.
									mapContainer.style.display = "block";
									map.relayout();
									// 지도 중심을 변경한다.
									map.setCenter(coords);
									// 마커를 결과값으로 받은 위치로 옮긴다.
									marker.setPosition(coords);
									$('#wr_area_point').val(result.addr[0].lat+","+result.addr[0].lng);
								}
							});
							daum.maps.event.addListener(map, 'click', function(mouseEvent) {
								// 클릭한 위도, 경도 정보를 가져옵니다 
								var latlng = mouseEvent.latLng; 
								// 마커 위치를 클릭한 위치로 옮깁니다
								marker.setPosition(latlng);
								var message = '클릭한 위치의 위도는 ' + latlng.getLat() + ' 이고, ';
								message += '경도는 ' + latlng.getLng() + ' 입니다';
								$('#wr_area_point').val( latlng.getLat() +","+latlng.getLng() );
							});

						<?php } else if($use_map=='naver'){ ?>
							var search_addr = fullAddr;
							$.post('../../company/views/_ajax/area_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
								$('#map').html("");
								var data = eval("(" + result + ")");
								var point_y = data.mapy;
								var point_x = data.mapx;
								map_api.map_use("map", "", true);	// 지도 띄우기
								map_api.map_location_move(point_x,point_y);
								map_api.marker_false();
								map_api.addMark();
								map_api.click_event();
								$('#wr_area_point').val( point_x+","+point_y );
							});
						<?php } else if($use_map=='google'){ ?>
							var search_addr = fullAddr;
							$.post('../../company/views/_ajax/area_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
								point = result.split('/');
								var point_x = point[0];
								var point_y = point[1];
								map_api.map_point = [point_x,point_y,'18'];
								map_api.map_use("map", "", true);
								map_api.click_event('','',point_x,point_y,'wr_area_point');
								map_api.addMark();
								$('#wr_area_point').val( point_x+","+point_y );
							});
						<?php } ?>

					}
				}).open();
			}
			</script>
<?php

			break;

			## 2/3차 직종 select 생성
			case 'second_job_type':
				
				if($target=='wr_job_type_1' || $target=='wr_job_type_4' || $target=='wr_job_type_7'){
					$title = "= 2차 직종선택 =";
					$option = "<option value=\"\">1차 직종을 먼저 선택해 주세요</option>";
				} else if($target=='wr_job_type_2' || $target=='wr_job_type_5' || $target=='wr_job_type_8'){
					$title = "= 3차 직종선택 =";
					$option = "<option value=\"\">2차 직종을 먼저 선택해 주세요</option>";
				}

				$targets = array( "wr_job_type_1" => "wr_job_type_2", "wr_job_type_2" => "wr_job_type_3", "wr_job_type_3" => "wr_job_type_4", "wr_job_type_4" => "wr_job_type_5","wr_job_type_5" => "wr_job_type_6", "wr_job_type_6" => "wr_job_type_7", "wr_job_type_7" => "wr_job_type_8" );

				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				$result  = "<select class=\"ipSelect\" style=\"width:180px;\" id=\"".$target."\" name=\"".$target."\" title=\"".$title."\"  onchange=\"job_type_sel_first(this,'".$targets[$target]."');\">";
				$result .= "<option value=\"\">".$title."</option>";
				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				} else {
					$result .= $option;
				}
				$result .= "</select>";

				echo $result;

			break;

			case 'insert_second_job_type':

				if($target=='wr_job_type1' || $target=='wr_job_type4' || $target=='wr_job_type7'){
					$title = "= 2차 직종선택 =";
					$option = "<option value=\"\">1차 직종을 먼저 선택해 주세요</option>";
				} else if($target=='wr_job_type2' || $target=='wr_job_type5' || $target=='wr_job_type8'){
					$title = "= 3차 직종선택 =";
					$option = "<option value=\"\">2차 직종을 먼저 선택해 주세요</option>";
				}

				$targets = array( "wr_job_type1" => "wr_job_type2", "wr_job_type2" => "wr_job_type3", "wr_job_type3" => "wr_job_type4", "wr_job_type4" => "wr_job_type5","wr_job_type5" => "wr_job_type6", "wr_job_type6" => "wr_job_type7", "wr_job_type7" => "wr_job_type8" );

				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				$result  = "<select class=\"ipSelect\" style=\"width:180px;\" id=\"".$target."\" name=\"".$target."\" title=\"".$title."\"  onchange=\"insert_job_type_sel_first(this,'".$targets[$target]."');\">";
				$result .= "<option value=\"\">".$title."</option>";
				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				} else {
					$result .= $option;
				}
				$result .= "</select>";

				echo $result;

			break;

			## 2차 지역 select 생성
			case 'second_area':
				
				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				$result  = "<select class=\"ipSelect\" style=\"width:180px;\" id=\"".$target."\" name=\"".$target."\" title=\"시·군·구 선택\">";
				$result .= "<option value=\"\"> -- 시·군·구 --</option>";
				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				} else {
					$result .= "<option value=\"\">시·도 를 먼저 선택해 주세요</option>";
				}
				$result .= "</select>";

				echo $result;

			break;

			case 'insert_second_area':

				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				if($target=='wr_area_01'){
					$title = "시군구 선택";
					$option = "<option value=\"\">시군구</option>";
					$name = "wr_area_0[]";
					$targets = "wr_area_02";
				} else if($target=='wr_area_02'){
					$title = "읍면동 선택";
					$option = "<option value=\"\">읍면동</option>";
					$name = "wr_area_0[]";
					$targets = "";
				}

				if($target=='wr_area_11'){
					$title = "시군구 선택";
					$option = "<option value=\"\">시군구</option>";
					$name = "wr_area_1[]";
					$targets = "wr_area_12";
				} else if($target=='wr_area_12'){
					$title = "읍면동 선택";
					$option = "<option value=\"\">읍면동</option>";
					$name = "wr_area_1[]";
					$targets = "";
				}

				if($target=='wr_area_21'){
					$title = "시군구 선택";
					$option = "<option value=\"\">시군구</option>";
					$name = "wr_area_2[]";
					$targets = "wr_area_22";
				} else if($target=='wr_area_22'){
					$title = "읍면동 선택";
					$option = "<option value=\"\">읍면동</option>";
					$name = "wr_area_2[]";
					$targets = "";
				}

				$result  = "<select class=\"ipSelect\" style=\"width:70px;\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"insert_area_sel_first(this,'".$targets."');\">";
				$result .= $option;
				if($pcodeList){
					//$result .= "<option value=\"\">전체</option>";
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				}
				$result .= "</select>";

				echo $result;

			break;

			case 'subway_line':			## 지하철 호선 리턴
			case 'subway_station':	## 지하철 역 리턴

				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				if($mode=='subway_line')
					$result = "<option value=\"\">호선</option>";
				else if($mode=='subway_station')
					$result = "<option value=\"\">지하철역</option>";

				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				}

				echo $result;

			break;

			## 인근대학 지역 선택
			case 'college_vicinity':
			
				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				$result = "<option value=\"\">인근대학 선택</option>";

				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				}

				echo $result;

			break;

			## 서비스승인
			case 'service':

				if(is_array($no)){	// 배열로 넘어온 경우 '선택 서비스승인' 으로 넘어온것임
					$no = implode($no,",");
					$is_array = true;
				} else {
					$is_array = false;
					$get_alba = $alba_control->get_alba($no);
					$get_payment = $payment_control->get_payment_for_oid($get_alba['wr_oid']);
				}

				$alba_option_neon = $service_control->service_check('alba_option_neon');	// 알바 형광펜 옵션
				$alba_option_neon_service = $service_control->__ServiceList($alba_option_neon['service']);	// 알바 형광펜 서비스 리스트
				$alba_option_neon_color = explode("/",$alba_option_neon['neon_color']);	 // 색상
				$alba_option_neon_color_cnt = count($alba_option_neon_color);

				$alba_option_icon = $service_control->service_check('alba_option_icon');	// 알바 아이콘 옵션
				$alba_option_icon_service = $service_control->__ServiceList($alba_option_icon['service']);	// 알바 아이콘 서비스 리스트
				$alba_option_icon_list = $category_control->category_codeList($alba_option_icon['service']);

				$alba_option_color = $service_control->service_check('alba_option_color');	// 알바 글자색 옵션
				$alba_option_color_service = $service_control->__ServiceList($alba_option_color['service']);	// 알바 글자색 서비스 리스트
				$alba_option_colors = explode("/",$alba_option_color['font_color']);	// 색상
				$alba_option_colors_cnt = count($alba_option_colors);

				$main_basic_check = $service_control->service_check('main_basic');
				$alba_basic_check = $service_control->service_check('alba_basic');

				$alba_option_icon_sel = $get_payment['pay_alba_option_icon_sel'];
?>
<style>
.aniLogo li{float:left; padding-right:10px;} 
</style>
				<div id="pop_service" class="bocol lnb_col" style="top:5%;left:33%;display:none;">

				<form name="AlbaServiceFrm" method="post" id="AlbaServiceFrm" action="./process/regist.php" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="service" id="mode"/>
				<input type="hidden" name="no" value="<?php echo $no;?>"/>
				<input type="hidden" name="ajax" value="1"/><!-- ajax mode 유무 -->
				<input type="hidden" name="is_array" value="<?php echo $is_array;?>"/>


					<dl class="ntlt lnb_col m0 hand" id="serviceHandle">
						<img src="../../images/comn/bul_10.png" class="t">서비스승인
						<a onClick="MM_showHideLayers('pop_service','','hide')"><img src="../../images/comn/pclose.png" class="lclose ln_col"></a>
					</dl>

					<table width="700" class="bg_col tf">
					<col width="110"><col width="180"><col>
					<tr>
						<td class="ctlt" colspan="3">메인 페이지</td>
					</tr>
					<tr>
						<td class="ctlt">플래티넘</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_platinums" name="wr_service_platinum" value="<?php echo ($get_alba['wr_service_platinum'])?$get_alba['wr_service_platinum']:'0000-00-00';?>"/>
						</td>
					</tr>
					</tr>
						<td class="ctlt">플래티넘 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_platinum_main_gold" name="wr_service_platinum_main_gold" value="<?php echo ($get_alba['wr_service_platinum_main_gold'])?$get_alba['wr_service_platinum_main_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					</tr>
						<td class="ctlt">플래티넘 로고강조</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_platinum_main_logo" name="wr_service_platinum_main_logo" value="<?php echo ($get_alba['wr_service_platinum_main_logo'])?$get_alba['wr_service_platinum_main_logo']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<ul class="aniLogo platinum_logo">
								<li>
									<input type="radio" class="chk" name="platinum_logo_effect" value="0" id="platinum_logo_0" checked>
									<label for="platinum_logo_0"><img class="vm platinum_fade_image"  width="72"  alt="반짝로고1" src="../../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="platinum_logo_effect" value="1" id="platinum_logo_1" <?php echo ($get_payment['pay_main_platinum_logo_effect']=='1')?'checked':'';?>>
									<label for="platinum_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="platinum_logo_effect" value="2" id="platinum_logo_2" <?php echo ($get_payment['pay_main_platinum_logo_effect']=='2')?'checked':'';?>>
									<label for="platinum_logo_2">
										<div style="float:right;margin-left:5px;" class="slide_image">
											<img src="../../images/basic/img_aniLogo3.gif" width="72" height="26"/>
											<img src="../../images/basic/img_aniLogo3.gif" width="72" height="26"/>
										</div>
									</label>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td class="ctlt">프라임</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_primes" name="wr_service_prime" value="<?php echo ($get_alba['wr_service_prime'])?$get_alba['wr_service_prime']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">프라임 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_prime_main_gold" name="wr_service_prime_main_gold" value="<?php echo ($get_alba['wr_service_prime_main_gold'])?$get_alba['wr_service_prime_main_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">프라임 로고강조</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_prime_main_logo" name="wr_service_prime_main_logo" value="<?php echo ($get_alba['wr_service_prime_main_logo'])?$get_alba['wr_service_prime_main_logo']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<ul class="aniLogo prime_logo">
								<li>
									<input type="radio" class="chk" name="prime_logo_effect" value="0" id="prime_logo_0" checked>
									<label for="prime_logo_0"><img class="vm prime_fade_image"  width="72"  alt="반짝로고1" src="../../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="prime_logo_effect" value="1" id="prime_logo_1" <?php echo ($get_payment['pay_main_prime_logo_effect']=='1')?'checked':'';?>>
									<label for="prime_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="prime_logo_effect" value="2" id="prime_logo_2" <?php echo ($get_payment['pay_main_prime_logo_effect']=='2')?'checked':'';?>>
									<label for="prime_logo_2">
										<div style="float:right;margin-left:5px;" class="slide_image">
											<img src="../../images/basic/img_aniLogo3.gif" width="72" />
											<img src="../../images/basic/img_aniLogo3.gif" width="72"/>
										</div>
									</label>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td class="ctlt">그랜드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_grands" name="wr_service_grand" value="<?php echo ($get_alba['wr_service_grand'])?$get_alba['wr_service_grand']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">그랜드 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_grand_main_gold" name="wr_service_grand_main_gold" value="<?php echo ($get_alba['wr_service_grand_main_gold'])?$get_alba['wr_service_grand_main_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">그랜드 로고강조</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_grand_main_logo" name="wr_service_grand_main_logo" value="<?php echo ($get_alba['wr_service_grand_main_logo'])?$get_alba['wr_service_grand_main_logo']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<ul class="aniLogo grand_logo">
								<li>
									<input type="radio" class="chk" name="grand_logo_effect" value="0" id="grand_logo_0" checked>
									<label for="grand_logo_0"><img class="vm grand_fade_image"  width="72"  alt="반짝로고1" src="../../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="grand_logo_effect" value="1" id="grand_logo_1" <?php echo ($get_payment['pay_main_grand_logo_effect']=='1')?'checked':'';?>>
									<label for="grand_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="grand_logo_effect" value="2" id="grand_logo_2" <?php echo ($get_payment['pay_main_grand_logo_effect']=='2')?'checked':'';?>>
									<label for="grand_logo_2">
										<div style="float:right;margin-left:5px;" class="slide_image">
											<img src="../../images/basic/img_aniLogo3.gif" width="72"/>
											<img src="../../images/basic/img_aniLogo3.gif" width="72" />
										</div>
									</label>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td class="ctlt">배너형</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_banners" name="wr_service_banner" value="<?php echo ($get_alba['wr_service_banner'])?$get_alba['wr_service_banner']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">배너형 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_banner_main_gold" name="wr_service_banner_main_gold" value="<?php echo ($get_alba['wr_service_banner_main_gold'])?$get_alba['wr_service_banner_main_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">리스트형</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_lists" name="wr_service_list" value="<?php echo ($get_alba['wr_service_list'])?$get_alba['wr_service_list']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">리스트형 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_list_main_gold" name="wr_service_list_main_gold" value="<?php echo ($get_alba['wr_service_list_main_gold'])?$get_alba['wr_service_list_main_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<?php if($main_basic_check['is_pay']){ ?>
					<tr>
						<td class="ctlt">일반리스트</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_basics" name="wr_service_basic" value="<?php echo ($get_alba['wr_service_basic'])?$get_alba['wr_service_basic']:'0000-00-00';?>"/>
						</td>
					</tr>
					<?php } ?>
					<tr><td colspan="3" class="lnb wbg" height="5"></td></tr>
					<tr>
						<td class="ctlt" colspan="3">채용정보 메인</td>
					</tr>
					<tr>
						<td class="ctlt">플래티넘</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_platinum_sub" name="wr_service_platinum_sub" value="<?php echo ($get_alba['wr_service_platinum_sub'])?$get_alba['wr_service_platinum_sub']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">플래티넘 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_platinum_sub_gold" name="wr_service_platinum_sub_gold" value="<?php echo ($get_alba['wr_service_platinum_sub_gold'])?$get_alba['wr_service_platinum_sub_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">플래티넘 로고강조</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_platinum_sub_logo" name="wr_service_platinum_sub_logo" value="<?php echo ($get_alba['wr_service_platinum_sub_logo'])?$get_alba['wr_service_platinum_sub_logo']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<ul class="aniLogo sub_platinum_logo">
								<li>
									<input type="radio" class="chk" name="sub_platinum_logo_effect" value="0" id="sub_platinum_logo_0" checked>
									<label for="sub_platinum_logo_0"><img class="vm sub_platinum_fade_image"  width="72"  alt="반짝로고1" src="../../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="sub_platinum_logo_effect" value="1" id="sub_platinum_logo_1" <?php echo ($get_payment['pay_alba_platinum_logo_effect']=='1')?'checked':'';?>>
									<label for="sub_platinum_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="sub_platinum_logo_effect" value="2" id="sub_platinum_logo_2" <?php echo ($get_payment['pay_alba_platinum_logo_effect']=='2')?'checked':'';?>>
									<label for="sub_platinum_logo_2">
										<div style="float:right;margin-left:5px;" class="slide_image">
											<img src="../../images/basic/img_aniLogo3.gif" width="72"/>
											<img src="../../images/basic/img_aniLogo3.gif" width="72" />
										</div>
									</label>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td class="ctlt">배너형</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_banner_sub" name="wr_service_banner_sub" value="<?php echo ($get_alba['wr_service_banner_sub'])?$get_alba['wr_service_banner_sub']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">배너형 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_banner_sub_gold" name="wr_service_banner_sub_gold" value="<?php echo ($get_alba['wr_service_banner_sub_gold'])?$get_alba['wr_service_banner_sub_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">리스트형</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_list_sub" name="wr_service_list_sub" value="<?php echo ($get_alba['wr_service_list_sub'])?$get_alba['wr_service_list_sub']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">리스트형 골드</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_list_sub_gold" name="wr_service_list_sub_gold" value="<?php echo ($get_alba['wr_service_list_sub_gold'])?$get_alba['wr_service_list_sub_gold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<?php if($alba_basic_check['is_pay']){ ?>
					<tr>
						<td class="ctlt">일반리스트</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_basic_sub" name="wr_service_basic_sub" value="<?php echo ($get_alba['wr_service_basic_sub'])?$get_alba['wr_service_basic_sub']:'0000-00-00';?>"/>
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
							<input type="text" style="width:165px;" class="txt" id="wr_service_neons" name="wr_service_neon" value="<?php echo ($get_alba['wr_service_neon'])?$get_alba['wr_service_neon']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<div class="boxRadio bg_color2 ml10 mt10  pt5 pb5 alba_option_neon" ><strong>칼라선택:</strong>
							<?php 
								for($i=0;$i<$alba_option_neon_color_cnt;$i++){ 
								if($post_neon_option){
									$checked = ($alba_option_neon_color[$i]==$post_neon_option)?'checked':'';
								} else {
									$checked = ($i==0) ? 'checked' : '';
								}
							?>
								<span class="">
									<input type="radio" value="<?php echo $alba_option_neon_color[$i];?>" name="alba_option_neon_sel" id="alba_option_neon_<?php echo $i;?>" class="chk" <?php echo $checked;?>>
									<label for="alba_option_neon_<?php echo $i;?>" style="background:#<?php echo $alba_option_neon_color[$i];?>;">형광펜</label>
								</span>
							<?php } ?>
							</div>						
						</td>
					</tr>
					<tr>
						<td class="ctlt">굵은글자</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_bolds" name="wr_service_bold" value="<?php echo ($get_alba['wr_service_bold'])?$get_alba['wr_service_bold']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">아이콘</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_icons" name="wr_service_icon" value="<?php echo ($get_alba['wr_service_icon'])?$get_alba['wr_service_icon']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<div class="boxIcon  mt10  pt5 pb5 alba_option_icon">
							<?php 
								foreach($alba_option_icon_list as $key => $val){ 
								/*
								if($_POST['alba_option_icon']){
									$checked = ($val['no']==$_POST['alba_option_icon'])?'checked':'';
								} else {
									$checked = ($key==0) ? 'checked' : '';
								}
								*/
								if($alba_option_icon_sel){
									$checked = ($val['no']==$alba_option_icon_sel)?'checked':'';
								} else {
									$checked = ($key==0) ? 'checked' : '';
								}
							?>
								<span class="pr15"><input type="radio" name="alba_option_icon_sel" value="<?php echo $val['no'];?>" id="alba_option_icon_<?php echo $key;?>" class="chk" <?php echo $checked;?>>
									<label for="alba_option_icon_<?php echo $key;?>" id="alba_option_icon_<?php echo $val['no'];?>"><img src="<?php echo "../../data/icon/".$val['name'];?>"></label>
								</span>
							<?php } ?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="ctlt">글자색</td>
						<td class="pdlnb2 num11">
							<input type="text" style="width:165px;" class="txt" id="wr_service_colors" name="wr_service_color" value="<?php echo ($get_alba['wr_service_color'])?$get_alba['wr_service_color']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">
							<div class="boxRadio bg_color2 ml10 mt10  pt5 pb5 alba_option_color"><strong>칼라선택:</strong>
							<?php 
								for($i=0;$i<$alba_option_colors_cnt;$i++){
								if($_POST['alba_option_color']){
									$checked = ($_POST['alba_option_color']==$alba_option_colors[$i])?'checked':'';
								} else {
									$checked = ($i==0) ? 'checked' : '';
								}
							?>
								<span class=""><input type="radio" name="alba_option_color_sel" id="alba_option_color_sel_<?php echo $i;?>" value="<?php echo $alba_option_colors[$i];?>" class="chk" <?php echo $checked;?>><label for="alba_option_color_sel_<?php echo $i;?>" style="color:#<?php echo $alba_option_colors[$i];?>"> 글자색</label></span>
							<?php } ?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="ctlt">반짝칼라</td>
						<td class="pdlnb2 num11" >
							<input type="text" style="width:165px;" class="txt" id="wr_service_blinks" name="wr_service_blink" value="<?php echo ($get_alba['wr_service_blink'])?$get_alba['wr_service_blink']:'0000-00-00';?>"/>
						</td>
						<td class="pdlnb2 num11">&nbsp;</td>
					</tr>
					<tr><td colspan="3" class="lnb wbg" height="5"></td></tr>
					<tr>
						<td class="ctlt">급구</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_busys" name="wr_service_busy" value="<?php echo ($get_alba['wr_service_busy'])?$get_alba['wr_service_busy']:'0000-00-00';?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">점프</td>
						<td class="pdlnb2 num11" colspan="2">
							<input type="text" style="width:165px;" class="txt" id="wr_service_jumps" name="wr_service_jump" value="<?php echo ($get_alba['wr_service_jump'])?$get_alba['wr_service_jump']:'0000-00-00';?>"/>
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
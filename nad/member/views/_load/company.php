<?php
		/*
		* /application/nad/member/views/_load/company.php
		* @author Harimao
		* @since 2014/08/12
		* @last update 2015/04/20
		* @Module v3.5 ( Alice )
		* @Brief :: Company load layer
		* @Comment :: 기업정보에 지정에 다른 정보 추출
		*/

		$alice_path = "../../../../";
		
		$cat_path = "../../../../";

		include_once $alice_path . "_core.php";

		$admin_control->is_admin( true );	// 관리자 체크

		$mode = $_POST['mode'];
		$no = $_POST['no'];
		$mb_id = $_POST['mb_id'];

		if($mb_id) {
			$company = $member_control->get_company_member($mb_id);	 // mb_id 기준
		} else {
			$company = $member_control->get_company_memberNo($no);	// no 기준
			$mb_id = $company['mb_id'];
		}
		
		$member_list = $member_control->member_list("",""," where `mb_type` = 'company' and `is_delete` = 0 ");

		// 기업정보를 기준으로 로고 추출
		$company_logo = $alba_user_control->get_logo($company);

		$logo_con = "";
		$logo_list = $logo_control->__EmploylogoList("","",$logo_con);

		$use_map = $env['use_map'];
		$daum_local_key = $env['daum_local_key'];
		$naver_map_key = $env['naver_map_key'];

		$mb_phone = explode('-',$company['mb_biz_phone']);
		$mb_hphone = explode('-',$company['mb_biz_hphone']);
		$mb_zipcode = explode('-',$company['mb_biz_zipcode']);

		$tel_num_option = "";	 //전화번호
		foreach($config->tel_num as $tel){
			$selected = ($tel==$mb_phone[0]) ? 'selected' : '';
			$tel_num_option .= "<option value='".$tel."' ".$selected.">".$config->local_num[$tel]."</option>";
		}

		$hp_num_option = "";	 //휴대폰 번호
		foreach($config->hp_num as $hp){
			$selected = ($hp==$mb_hphone[0]) ? 'selected' : '';
			$hp_num_option .= "<option value='".$hp."' ".$selected.">".$hp."</option>";
		}

		/*
		$email_list = $category_control->category_codeList('email', " `rank` asc ");
		$email_option = "";	//이메일
		foreach($email_list as $email){
			$email_option .= "<option value='".$email['name']."'>".$email['name']."</option>";
		}
		*/

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

		$biz_type_list = $category_control->category_codeList('biz_type', " `rank` asc ");
		$biz_type_option = "";	//회사분류
		foreach($biz_type_list as $biz_type){
			$selected = ($biz_type['code']==$company['mb_biz_type'])?'selected':'';
			$biz_type_option .= "<option value='".$biz_type['code']."' ".$selected.">".$biz_type['name']."</option>";
		}
		$mb_biz_no = explode('-',$company['mb_biz_no']);
		$mb_biz_fax = explode('-',$company['mb_biz_fax']);

		$biz_success = $category_control->category_codeList('biz_success', " `rank` asc ");
		$biz_success_option = "";	//상장여부
		foreach($biz_success as $option){
			$selected = ($option['code']==$company['mb_biz_success'])?'selected':'';
			$biz_success_option .= "<option value='".$option['code']."' ".$selected.">".$option['name']."</option>";
		}
		$biz_form = $category_control->category_codeList('biz_form', " `rank` asc ");
		$biz_form_option = "";	//기업형태
		foreach($biz_form as $option){
			$selected = ($option['code']==$company['mb_biz_form'])?'selected':'';
			$biz_form_option .= "<option value='".$option['code']."' ".$selected.">".$option['name']."</option>";
		}
		$foundation_option = "";	 //설립연도
		for($i=date('Y');$i>=1900;--$i){
			$selected = ($i==$company['mb_biz_foundation'])?'selected':'';
			$foundation_option .= "<option value='".$i."' ".$selected.">".$i." 년</option>";
		}

		// 업체 로고
		$wr_mb_logo_file = "../../../../data/alba/" . $get_alba['etc_0'];
		$wr_mb_logo = (is_file($wr_mb_logo_file)) ? "../../data/alba/" . $get_alba['etc_0'] : "../../images/comn/no_profileimg.gif";

		// 등록 이미지 정보 추출
		//$wr_photo = $user_control->member_photo_list($get_alba['wr_id']," and `data_no` = '".$no."' ", " order by `photo_no` asc ");
		
		$alice['images_path'] = "../../images";
		$alice['data_member_path'] = "../../data/member";
		$photo_con =  ($no) ? " and `company_no` = '".$no."' " : "";
		$photo_0 = $user_control->get_member_photo($mb_id, 0, $photo_con);
		$photo_0_file = "../../../../data/member/" . $mb_id . "/photos/" . $photo_0;
		$photo_0_name = $photo_0;
		$photo_0 = (is_file($photo_0_file)) ? "../../data/member/" . $mb_id . "/photos/" . $photo_0 : $alice['images_path'] . "/comn/no_profileimg.gif";

		$photo_1 = $user_control->get_member_photo($mb_id, 1, $photo_con);
		$photo_1_file = "../../../../data/member/" . $mb_id . "/photos/" . $photo_1;
		$photo_1_name = $photo_1;
		$photo_1 = (is_file($photo_1_file)) ? "../../data/member/" . $mb_id . "/photos/" . $photo_1 : $alice['images_path'] . "/comn/no_profileimg.gif";

		$photo_2 = $user_control->get_member_photo($mb_id, 2, $photo_con);
		$photo_2_file = "../../../../data/member/" . $mb_id . "/photos/" . $photo_2;
		$photo_2_name = $photo_2;
		$photo_2 = (is_file($photo_2_file)) ? "../../data/member/" . $mb_id . "/photos/" . $photo_2 : $alice['images_path'] . "/comn/no_profileimg.gif";

		$photo_3 = $user_control->get_member_photo($mb_id, 3, $photo_con);
		$photo_3_file = "../../../../data/member/" . $mb_id . "/photos/" . $photo_3;
		$photo_3_name = $photo_3;
		$photo_3 = (is_file($photo_3_file)) ? "../../data/member/" . $mb_id . "/photos/" . $photo_3 : $alice['images_path'] . "/comn/no_profileimg.gif";

		$photo_4 = $user_control->get_member_photo($mb_id, 4, $photo_con);
		$photo_4_file = "../../../../data/member/" . $mb_id . "/photos/" . $photo_4;
		$photo_4_name = $photo_4;
		$photo_4 = (is_file($photo_4_file)) ? "../../data/member/" . $mb_id . "/photos/" . $photo_4 : $alice['images_path'] . "/comn/no_profileimg.gif";

		/*
		$photo_0_file = "../../../../data/alba/" . $wr_photo[0]['photo_name'];
		$photo_0 = (is_file($photo_0_file)) ? "../../data/alba/" . $wr_photo[0]['photo_name'] : "../../images/comn/no_profileimg.gif";
		$photo_1_file = "../../../../data/alba/" . $wr_photo[1]['photo_name'];
		$photo_1 = (is_file($photo_1_file)) ? "../../data/alba/" . $wr_photo[1]['photo_name'] : "../../images/comn/no_profileimg.gif";
		$photo_2_file = "../../../../data/alba/" . $wr_photo[2]['photo_name'];
		$photo_2 = (is_file($photo_2_file)) ? "../../data/alba/" . $wr_photo[2]['photo_name'] : "../../images/comn/no_profileimg.gif";
		$photo_3_file = "../../../../data/alba/" . $wr_photo[3]['photo_name'];
		$photo_3 = (is_file($photo_3_file)) ? "../../data/alba/" . $wr_photo[3]['photo_name'] : "../../images/comn/no_profileimg.gif";
		*/

		//echo $mode." <==<br/>";

		switch($mode){
			
			## 기업정보 입력/수정
			case 'insert':
			case 'update':
?>
				<div id="add_form" class="bocol lnb_col" style="top:10%;left:33%;display:none;">

					<form name="CompanyFrm" method="post" id="CompanyFrm" action="./process/company.php" enctype="multipart/form-data">
					<input type="hidden" name="mode" value="<?php echo $mode;?>" id="mode"/>
					<input type="hidden" name="ajax" value="1"/><!-- ajax mode 유무 -->
					<?php if($mode=='update'){ ?>
					<input type="hidden" name="no" value="<?php echo $no;?>"/>
					<?php } ?>
					<input type="hidden" name="mb_type" id="mb_type" value="company"/><!-- 무조건 기업회원 -->
					<input type="hidden" name="mb_latlng" id="mb_latlng" value="<?php echo $company['mb_latlng'];?>"/>

					<div class="lnb_col positionA" style="border:2px solid #ddd; background:#fff; width:450px; top:20%;left:40%;text-align:left;display:none;z-index:9999;" id="postSearchPop">
						<dl>
							<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="postSearchPop_handle">
								<strong>우편번호 검색</strong>
								<em class="closeBtn" onclick="postClose();"><img width="11" height="11" class="pb5" src="../../images/icon/icon_close2.gif" alt="arrow"></em>
							</dt>

							<dd style="padding:20px 15px 30px;width:425px;height:275px;" id="addressResult"></dd>

							<div class="mt5" id="mapBlock" style="display:none;">
								<table cellpadding="0" cellspacing="0" align="center">
								<tr><td style="padding:15px 0 10px;"><b>회사위치(약도)</b> - 클릭시 위치가 지정됩니다.</td></tr>
								<tr>
									<td>
										<div style="border:3px solid <?php echo $map_color;?>">
											<div id="map" style="width:420px;height:230px;"></div>
										</div>
									</td>
								</tr>
								<tr align="center">
									<td style="padding-top:10px;">
										<img src="../../images/btn/btn23_ok.gif" align="absmiddle" style='cursor:pointer;' class='close' onclick="postClose();">
										<img src="../../images/btn/btn23_08.gif" align="absmiddle" style='cursor:pointer;' class='close' onclick="postClose();">
									</td>
								</tr>
								</table>
							</div>

						</dl>
					</div>

					<dl class="ntlt lnb_col m0 hand" id="companyFrmHandle">
						<img src="../../images/comn/bul_10.png" class="t">기업 정보<?php echo ($mode=='insert')?'입력':'수정';?>
						<span>( <b class="col">*</b> 표시는 필수 입력사항 )</span>
						<a onClick="MM_showHideLayers('add_form','','hide')"><img src="../../images/comn/pclose.png" class="lclose ln_col"></a>
					</dl>

					<table width="750" class="bg_col">
					<col width=100><col>
					<?php if($mode=='insert'){ ?>
					<tr class="input_type_load" style="display:;">
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
					<?php } else if($mode=='update') { ?>
					<tr>
						<td class="ctlt">아이디 <b class="col">*</b></td>
						<td class="pdlnb2">
							<input name="mb_id" type="text" class="tnum w50" value="<?php echo $company['mb_id'];?>" required hname='아이디' <?php echo ($mode=='update')?'readonly':'';?>>
							<?php if($mode=='update') { ?><span class="subtlt">아이디는 수정이 불가능 합니다.</span><?php } ?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td class="ctlt">대표기업정보</td>
						<td class="pdlnb2">
							<label><input type="checkbox" class="check" id="is_public" name="is_public" value="1" <?php echo ($company['is_public'])?'checked':'';?>>대표 선택</label>
							<span class="subtlt">대표로 선택하시면 <?php echo $company['mb_id'];?> 회원이 설정한 대표기업정보가 현재 기업정보로 변경됩니다.</span>
						</td>
					</tr>
					<?php if($company['mb_logo'] || $company['mb_logo_sel']){ ?>
					<tr>
						<td class="ctlt">로고 미리보기</td>
						<td class="pdlnb2">
							<img src="<?php echo $company_logo;?>" style="max-width:200px;max-height:100px;"/>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td class="ctlt">회사로고</td>
						<td class="pdlnb2">
							<label><input type="radio" name="wr_logo" class="radio" id="wr_logo_0" value="0" checked/>직접</label> <input type="file" class="txtForm" style="height:20px;" size="30" id="mb_logo" name="mb_logo"> [ 권장 : 넓이 200px 이하, 높이 100px 이하 ]
							<div class="mt20">
							<?php 
							$n = 1;
							foreach($logo_list['result'] as $val){ 
							?>
								<label><input type="radio" name="wr_logo" class="radio" id="wr_logo_<?php echo $val['no'];?>" value="<?php echo $val['no'];?>"/><img src="<?php echo $alice['data_logo_path']."/".$val['wr_content'];?>"/></label><?php echo ($n%4==0)?'<br/>':'';?>
							<?php 
							$n++;
							}	// foreach end.
							?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="ctlt">대표자명(ceo) <b class="col">*</b></td>
						<td class="pdlnb2"><input name="mb_ceo_name" type="text" class="txt w50" value="<?php echo stripslashes($company['mb_ceo_name']);?>" required hname='대표자명' style="ime-mode:active;"></td>
					</tr>
					<tr>
						<td class="ctlt">회사/점포명 <b class="col">*</b></td>
						<td class="pdlnb2"><input type="text" class="txt w50" id="mb_company_name" name="mb_company_name" value="<?php echo $company['mb_company_name'];?>" hname="회사/점포명" required style="ime-mode:active;"></td>
					</tr>
					<tr>
						<td class="ctlt">회사분류 <b class="col">*</b></td>
						<td class="pdlnb2">
							<select style="width:200px;" id="mb_biz_type" name="mb_biz_type" title="회사분류 선택" required hname="회사분류">
							<option value="">회사분류 선택</option>
							<?php echo $biz_type_option; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="ctlt">전화번호 <b class="col">*</b></td>
						<td class="pdlnb2">
							<select style="width:95px;" id="mb_phone0" name="mb_phone[]" title="지역번호 선택" required hname="지역번호">
							<option value="">지역번호 선택</option>
							<?php echo $tel_num_option; ?>
							</select>
							<span class="delimiter">-</span>
							<input style="width:95px;" type="text" class="tnum" title="전화번호 앞자리" maxlength="4" id="mb_phone1" name="mb_phone[]" required hname="전화번호 앞자리" value="<?php echo $mb_phone[1];?>">
							<span class="delimiter">-</span>
							<input style="width:95px;" type="text" class="tnum" title="전화번호 뒷자리" maxlength="4" id="mb_phone2" name="mb_phone[]" required hname="전화번호 뒷자리" value="<?php echo $mb_phone[2];?>">
						</td>
					</tr>
					<tr>
						<td class="ctlt">휴대폰번호</td>
						<td class="pdlnb2">
							<select style="width:95px;" id="mb_hphone0" name="mb_hphone[]" title="휴대폰 국번">
							<?php echo $hp_num_option; ?>
							</select>
							<span class="delimiter">-</span>
							<input style="width:95px;" type="text" class="tnum" title="휴대폰 앞자리" maxlength="4" id="mb_hphone1" name="mb_hphone[]" hname="휴대폰 앞자리" value="<?php echo $mb_hphone[1];?>">
							<span class="delimiter">-</span>
							<input style="width:95px;" type="text" class="tnum" title="휴대폰 뒷자리" maxlength="4" id="mb_hphone2" name="mb_hphone[]" hname="휴대폰 뒷자리" value="<?php echo $mb_hphone[2];?>">
						</td>
					</tr>
					<tr>
						<td class="ctlt">회사/점포 주소 <b class="col">*</b></td>
						<td class="pdlnb2">

							<div class="addresWrap" id="address_block">
								<input type="text" style="width:55px;" class="tnum" title="우편번호 앞자리" maxlength="3" id="mb_zipcode0" name="mb_zipcode[]" readonly hname="우편번호 앞자리" value="<?php echo $mb_zipcode[0];?>">
								<span class="delimiter">-</span>
								<input type="text" style="width:55px;" class="tnum" title="우편번호 뒷자리" maxlength="4" id="mb_zipcode1" name="mb_zipcode[]" readonly hname="우편번호 뒷자리" value="<?php echo $mb_zipcode[1];?>">
								<a class="btn" style="padding:0 10px;" onclick="execDaumPostcode();"><span>우편번호 검색</span></a>
								<div class="adress2 mt3">
									<input type="text" class="tnum w100 mb3" title="주소" id="mb_address0" name="mb_address0" hname="주소" value="<?php echo $company['mb_biz_address0'];?>">
									<input type="text" class="tnum w100" title="상세주소" id="mb_address1" name="mb_address1" hname="상세주소" value="<?php echo $company['mb_biz_address1'];?>">
								</div>
							</div>

						</td>
					</tr>
					<tr>
						<td class="ctlt">사업자번호</td>
						<td class="pdlnb2">
							<input type="text"  style="width:50px;" class="tnum" title="사업자번호1" maxlength="3" id="mb_biz_no0" name="mb_biz_no[]" value="<?php echo $mb_biz_no[0];?>" hname="사업자번호"> 
							<span class="delimiter">-</span> 
							<input type="text" style="width:40px;" class="tnum" title="사업자번호2" maxlength="2" id="mb_biz_no1" name="mb_biz_no[]" value="<?php echo $mb_biz_no[1];?>" hname="사업자번호"> 
							<span class="delimiter">-</span> 
							<input type="text" style="width:70px;" class="tnum" title="사업자번호3" maxlength="5" id="mb_biz_no2" name="mb_biz_no[]" value="<?php echo $mb_biz_no[2];?>" hname="사업자번호">
						</td>
					</tr>
					<tr>
						<td class="ctlt">팩스번호</td>
						<td class="pdlnb2">
							<select style="width:95px;" id="mb_biz_fax0" name="mb_biz_fax[]" title="지역번호 선택" hname="팩스 지역번호">
							<option value="">지역번호 선택</option>
							<?php echo $tel_num_option; ?>
							</select> 
							<span class="delimiter">-</span> 
							<input style="width:95px;" type="text" class="tnum" title="팩스번호 앞자리" maxlength="4" id="mb_biz_fax1" name="mb_biz_fax[]" hname="팩스번호 앞자리" value="<?php echo $mb_biz_fax[1];?>"> 
							<span class="delimiter">-</span> 
							<input style="width:95px;" type="text" class="tnum" title="팩스번호 뒷자리" maxlength="4" id="mb_biz_fax2" name="mb_biz_fax[]" hname="팩스번호 뒷자리" value="<?php echo $mb_biz_fax[2];?>">
						</td>
					</tr>
					<tr>
						<td class="ctlt">홈페이지주소</td>
						<td class="pdlnb2">
							<input name="mb_homepage" type="text" class="tnum w50" value="<?php echo $utility->add_http($company['mb_homepage']);?>"/>
						</td>
					</tr>
					<tr>
						<td class="ctlt">e-mail</td>
						<td class="pdlnb2">
							<input name="mb_email" type="text" class="tnum w50" value="<?php echo stripslashes($company['mb_biz_email']);?>">
						</td>
					</tr>
					<tr>
						<td class="ctlt">상장여부</td>
						<td class="pdlnb2">
							<select style="width:200px;" id="mb_biz_success" name="mb_biz_success" title="상장여부 선택" hname="상장여부">
							<option value="">상장여부 선택</option>
							<?php echo $biz_success_option;?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="ctlt">기업형태</td>
						<td class="pdlnb2">
							<select style="width:200px;" id="mb_biz_form" name="mb_biz_form" title="기업형태 선택" hname="기업형태">
							<option value="">기업형태 선택</option>
							<?php echo $biz_form_option;?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="ctlt">주요사업내용</td>
						<td class="pdlnb2">
							<input type="text" maxlength="16" class="tnum" style="width:350px;" id="mb_biz_content" name="mb_biz_content" value="<?php echo $company['mb_biz_content'];?>"> <span class="subtlt">(예 : 네트워크 트래픽 관리제품 개발 및 판매)</span>
						</td>
					</tr>
					<tr>
						<td class="ctlt">설립년도</td>
						<td class="pdlnb2">
							<select style="width:200px;" id="mb_biz_foundation" name="mb_biz_foundation" title="설립연도 선택" hname="설립연도">
							<option value="">선택</option>
							<?php echo $foundation_option;?>
							</select> 설립
						</td>
					</tr>
					<tr>
						<td class="ctlt">사원수</td>
						<td class="pdlnb2">
							<input type="text" maxlength="16" class="tnum" style="width:200px;" id="mb_biz_member_count" name="mb_biz_member_count" hname="사원수" value="<?php echo $company['mb_biz_member_count'];?>"> 명 <span class="subtlt">(예 : 200)</span>
						</td>
					</tr>
					<tr>
						<td class="ctlt">자본금</td>
						<td class="pdlnb2">
							<input type="text" maxlength="16" class="tnum" style="width:200px;" id="mb_biz_stock" name="mb_biz_stock" hname="자본금" value="<?php echo $company['mb_biz_stock'];?>"> 원 <span class="subtlt">(예 : 3억 5천만)</span>
						</td>
					</tr>
					<tr>
						<td class="ctlt">매출액</td>
						<td class="pdlnb2">
							<input type="text" maxlength="16" class="tnum" style="width:200px;" id="mb_biz_sale" name="mb_biz_sale" hname="매출액" value="<?php echo $company['mb_biz_sale'];?>"> 원 <span class="subtlt">(예 : 3억 5천만)</span>
						</td>
					</tr>
					<tr>
						<td class="ctlt">기업개요 및 비전</td>
						<td class="pdlnb2"><?php echo $utility->make_cheditor('mb_biz_vision',$company['mb_biz_vision']);?></td>
					</tr>
					<tr>
						<td class="ctlt">기업연혁 및 실적</td>
						<td class="pdlnb2"><?php echo $utility->make_cheditor('mb_biz_result',$company['mb_biz_result']);?></td>
					</tr>
					<tr>
						<td class="ctlt">근무회사 이미지</td>
						<td class="pdlnb2">

						<!--  사진등록 layer  -->
						<div class="layerPop  lnb_col" style="display:none; border:2px solid #ddd; background:#fff; position:absolute; width:420px; bottom:10%; left:25%; text-align:left; z-index:9999;" id="albaPhotoPop">
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
										<input type="file" name="photo_files" id="photo_files" size="32" style="height:20px;" class="txtForm">
									</div>
									<div  style="width:100px; margin:20px auto; " class=" btn font_gray bg_white block"><a class="block" style="padding:10px 20px;" href="javascript:alba_photo_submit();">등록하기</a></div>
								</dd>
							</dl>
						</div>
						<!--  //사진등록 layer   -->

						<div class="photoWrap positionR clearfix">
							<ul class="clearfix">
								<li style="padding-right:10px;float:left;width:110px;">
									<div class="photo"> <img src="<?php echo $photo_0;?>" style="width:110px;height:80px;" alt="photo" id="alba_photo_0"> </div>
									<input type="hidden" name="photos_0" id="photos_0" value="<?php echo $photo_0;?>"/>
									<div class="mt5 tc buttonWrap"> 
										<a class="btn white" style="padding:2px 15px;" onclick="update_alba_photos('update', 0);" id="alba_update_0"> <span>등록</span> </a> 
									</div>
								</li>
								<li style="padding-right:10px;float:left;width:110px;">
									<div class="photo"> <img src="<?php echo $photo_1;?>" style="width:110px;height:80px;" alt="photo" id="alba_photo_1"> </div>
									<input type="hidden" name="photos_1" id="photos_1" value="<?php echo $photo_1;?>"/>
									<div class="mt5 tc buttonWrap"> 
										<a class="btn white" style="padding:2px 15px;" onclick="update_alba_photos('update', 1);" id="alba_update_1"> <span>등록</span> </a> 
									</div>
								</li>
								<li style="padding-right:10px;float:left;width:110px;">
									<div class="photo"> <img src="<?php echo $photo_2;?>" style="width:110px;height:80px;" alt="photo" id="alba_photo_2"> </div>
									<input type="hidden" name="photos_2" id="photos_2" value="<?php echo $photo_2;?>"/>
									<div class="mt5 tc buttonWrap"> 
										<a class="btn white"  style="padding:2px 15px;" onclick="update_alba_photos('update', 2);" id="alba_update_2"> <span>등록</span> </a> 
									</div>
								</li>
								<li style="padding-right:10px;float:left;width:110px;">
									<div class="photo"> <img src="<?php echo $photo_3;?>" style="width:110px;height:80px;" alt="photo" id="alba_photo_3"> </div>
									<input type="hidden" name="photos_3" id="photos_3" value="<?php echo $photo_3;?>"/>
									<div class="mt5 tc buttonWrap"> 
										<a class="btn white"  style="padding:2px 15px;"  onclick="update_alba_photos('update', 3);" id="alba_update_3"> <span>등록</span> </a> 
									</div>
								</li>
								<li style="padding-right:10px;float:left;width:110px;">
									<div class="photo"> <img src="<?php echo $photo_4;?>" style="width:110px;height:80px;" alt="photo" id="alba_photo_4"> </div>
									<input type="hidden" name="photos_4" id="photos_4" value="<?php echo $photo_4;?>"/>
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
					</table>

					<script>
					<?php if($use_map=='daum'){ ?>
						var mapContainer = document.getElementById('map'), // 지도를 표시할 div
							mapOption = {
								center: new daum.maps.LatLng(37.537187, 127.005476), // 지도의 중심좌표
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
							position: new daum.maps.LatLng(37.537187, 127.005476),
							map: map
						});
					<?php } ?>
						var element_layer = document.getElementById('addressResult');

						// 우편번호 찾기 화면을 넣을 element
						function execDaumPostcode() {
							
							// 초기화
							//$('#map').html("");	
							$('#mapBlock').hide();
							$('#addressResult').show();

							new daum.Postcode({
								oncomplete: function(data) {
									// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
									// 각 주소의 노출 규칙에 따라 주소를 조합한다.
									// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
									var fullAddr = data.address; // 최종 주소 변수
									var extraAddr = ''; // 조합형 주소 변수
									var printAddr = '';	// 상세 구주소
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
										//fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
										printAddr += (extraAddr !== '' ? '('+ extraAddr +')' : '');
									}
									$('#mb_zipcode0').val( data.postcode1 );
									$('#mb_zipcode1').val( data.postcode2 );
									$('#mb_address0').val( fullAddr );
									$('#mb_address1').val( printAddr );
								<?php if($use_map=='daum'){ ?>
									// 주소로 좌표를 검색
									geocoder.addr2coord(data.address, function(status, result) {
										$('#addressResult').hide();
										$('#mapBlock').show();
										// 정상적으로 검색이 완료됐으면
										if (status === daum.maps.services.Status.OK) {
											//alert( result.addr[0].lat +" "+result.addr[0].lng);
											$('#mb_latlng').val(result.addr[0].lat +","+result.addr[0].lng);
											// 해당 주소에 대한 좌표를 받아서
											var coords = new daum.maps.LatLng(result.addr[0].lat, result.addr[0].lng);
											// 지도를 보여준다.
											//mapContainer.style.display = "block";
											map.relayout();
											// 지도 중심을 변경한다.
											map.setCenter(coords);
											// 마커를 결과값으로 받은 위치로 옮긴다.
											marker.setPosition(coords);
										}
									});
									daum.maps.event.addListener(map, 'click', function(mouseEvent) {
										// 클릭한 위도, 경도 정보를 가져옵니다 
										var latlng = mouseEvent.latLng; 
										// 마커 위치를 클릭한 위치로 옮깁니다
										marker.setPosition(latlng);
										var message = '클릭한 위치의 위도는 ' + latlng.getLat() + ' 이고, ';
										message += '경도는 ' + latlng.getLng() + ' 입니다';
										$('#mb_latlng').val( latlng.getLat() +","+latlng.getLng() );
									});
								<?php } else if($use_map=='naver'){ ?>
									$('#map').html("");
									$('#addressResult').hide();
									$('#mapBlock').show();
									var search_addr = fullAddr;
									$.post('./views/_ajax/post_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
										var data = eval("(" + result + ")");
										var point_y = data.mapy;
										var point_x = data.mapx;
										map_api.map_use("map", "", true);	// 지도 띄우기
										map_api.map_location_move(point_x,point_y);
										map_api.marker_false();
										map_api.addMark();
										map_api.click_event();
										$('#mb_latlng').val( point_x+","+point_y );	// 좌표값 할당
									});
								<?php } else if($use_map=='google'){ ?>
									$('#map').html("");
									$('#addressResult').hide();
									$('#mapBlock').show();
									var search_addr = fullAddr;
									$.post('./views/_ajax/post_search.php', { mode:'google_map_search', search_addr:search_addr }, function(result){
										point = result.split('/');
										$('#mb_latlng').val(point[0]+","+point[1]);
										map_api.map_point = [point[0],point[1],'18'];
										map_api.map_use("map", "", true);
										map_api.click_event();
										map_api.addMark();
										$('#mb_latlng').val(point[0]+","+point[1]);	// 좌표값 할당
									});
								<?php } ?>
									// iframe을 넣은 element를 안보이게 한다.
									//element_layer.style.display = 'none';
									//$('#postSearchPop').hide();
									$('#mb_address1').focus();
								},
								width : '100%',
								height : '100%'
							}).embed(element_layer);

							// iframe을 넣은 element를 보이게 한다.
							$('#postSearchPop').show();
						}
					</script>

					<dl class="pbtn">  
						<input type='image' src="../../images/btn/b23_02.png" class="ln_col">&nbsp;
						<a onClick="MM_showHideLayers('add_form','','hide')"><img src="../../images/btn/23_10.gif"></a></a>
					</dl>

					</form>

				</div>
<?php
			break;

		}
?>
<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<script>
var mb_type = "<?php echo $mb_type;?>";
console.log(mb_type);
var mb_id_duplicate = false;
var mb_nick_duplicate = false;
var use_map = "<?php echo $use_map;?>";
var daum_local_APIKEY = "<?php echo $daum_local_key;?>";
var naver_map_KEY = "<?php echo $naver_map_key;?>";
var is_new_post = true;
</script>
<script type="text/javascript" src="<?php echo $alice['member_path'];?>/skins/default/register_form.js"></script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 

		<?php 
			include_once $alice['include_path']."/banner.php"; 
			include_once $alice['include_path']."/navigation.php"; 
		?>

		<?php /* sec navigation */ ?>
		<div class="secNav mt10 clearfix">
			<ul>
				<li class="mn1"><em><img src="../images/basic/img_step1_off.png" width="69" height="24" alt="step1"></em><img src="../images/basic/img_tit_step1_off.png" width="150" height="19" alt="약관동의 및 본인확인"></li>
				<li class="mn2 on"><em><img src="../images/basic/img_step2_on.png" width="69" height="24" alt="step2"></em><img src="../images/basic/img_tit_step2_on.png" width="100" height="19" alt="정보입력"></li>
				<li class="mn3 Rend"><em><img src="../images/basic/img_step3_off.png" width="69" height="24" alt="step3"></em><img src="../images/basic/img_tit_step3_off.png" width="64" height="19" alt="가입완료"></li>
			</ul>
		</div>
		<?php /* //sec navigation */ ?>
		
		<form name="MemberRegistFrm" method="post" action="./process/regist.php" id="MemberRegistFrm" onsubmit="return validate(this);">
		<input type="hidden" name="mode" value="member_regist"/>
		<input type="hidden" name="ajax" value="0"/>
		<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
		<input type="hidden" name="mb_ssn" value="<?php echo $virtualno;?>"/>

		<?php if($mb_type=='individual'){ // 강사회원 가입폼 ?>

		<div class="layerPop positionA border_color5" style="display:none; width:440px; top:550px; left:50%; text-align:left;" id="postSearchPop">
			<dl>
				<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="postSearchPop_handle">
					<strong>우편번호 검색</strong>
					<em class="closeBtn"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
				</dt>

				<dd style="padding:20px 15px 30px;width:420px;height:275px;" id="addressResult"></dd>

			</dl>
		</div>

		<div class="person mt30" id="individual_form">
			<h2 class="pb5"> <img src="../images/tit/member_nav_tit_04.gif" width="109" height="21" alt="회원정보 입력"> </h2>
			<p class="help">
			ID는 변경할 수 없으니 신중하게 선택해 주시기 바랍니다.<br/>
			연락처와 e-메일 정보는 이력서와 입사지원 시에 사용되므로 반드시 실제 정보를 입력하시기 바랍니다.<br/>
			<img alt="필수입력사항" src="../images/icon/icon_b.gif" >표시는 필수 입력사항 입니다. 
			</p>
			<div class="registWrap mt10">
				<table>
				<caption><span class="skip">개인회원정보 입력폼</span></caption>
				<colgroup><col width="214px"><col width="*"></colgroup>
				<tbody>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >회원아이디</label>
						</th>
						<td>
							<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:disabled;" id="mb_id" name="mb_id" required hname="아이디">
							<a class="button" onclick="mbID_duplicateCheck();"><span>아이디 중복 확인</span></a>
						</td>
					</tr>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >비밀번호</label>
						</th>
						<td>
							<input type="password" class="ipText" style="width:200px;" maxlength="16" id="mb_password" name="mb_password" required hname="비밀번호" option="userpw">
							<em class="help">* 8~20자 사이의 영문, 숫자, 특수문자등으로 조합</em>
						</td>
					</tr>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >비밀번호확인</label>
						</th>
						<td>
							<input type="password" class="ipText checkPwd" style="width:200px;" maxlength="16" id="mb_password_re" name="mb_password_re" required hname="비밀번호확인" option="userpw" matching="mb_password">
							<em class="help">* 비밀번호를 한번 더 입력해 주십시오.</em>
						</td>
					</tr>
					<?php if($use_ipin || $use_hphone){?>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >이름</label>
						</th>
						<td><?php echo $realname;?></td>
					</tr>
					<input type="hidden" name="mb_name" value="<?php echo $realname;?>"/>
					<tr>
						<th scope="row">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >생년월일/성별</label>
						</th>
						<td><?php echo $birth_year;?>년 <?php echo $birth_month;?>월 <?php echo $birth_day;?>일생  (<?php echo $sex_text;?>)</td>
					</tr>
					<input type="hidden" name="mb_birth_year" value="<?php echo $birth_year;?>"/>
					<input type="hidden" name="mb_birth_month" value="<?php echo $birth_month;?>"/>
					<input type="hidden" name="mb_birth_day" value="<?php echo $birth_day;?>"/>
					<input type="hidden" name="mb_gender" value="<?php echo $sex_sel;?>"/>
					<?php } else { ?>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >이름</label>
						</th>
						<td>
							<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:active;" id="mb_name" name="mb_name" required hname="이름">
						</td>
					</tr>
					<!--
					<tr>
						<th scope="row">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >생년월일/성별</label>
						</th>
						<td>
							<select title="년도선택" class="ipSelect" name="mb_birth_year" id="mb_birth_year" style="width:80px" required hname="생년">
							<option value="">년도</option>
							<?php for($i=date('Y')-15;$i>=1900;--$i){ ?>
								<option value='<?=$i?>'><?=$i?></option>
							<?php } ?>
							</select> 년 
							<select title="월 선택" class="ipSelect" name="mb_birth_month" id="mb_birth_month" style="width:59px" required hname="생월">
							<option value="">월</option>
							<?php for($i=1;$i<=12;$i++){?>
							<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
							<?php } ?>
							</select> 월 
							<select title="일 선택" class="ipSelect" name="mb_birth_day" id="mb_birth_day" style="width:59px" required hname="생일">
							<option value="">일</option>
							<?php for($i=1;$i<=31;$i++){?>
							<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
							<?php } ?>
							</select> 일 
							<input type="radio" value="0" name="mb_gender" id="mb_gender_0" required hname="성별">
							<label for="mb_gender_0">남</label>
							<input type="radio" value="1" name="mb_gender" id="mb_gender_1" required hname="성별">
							<label for="mb_gender_1">여</label>
						</td>
					</tr>
					<?php } ?> -->
					<!-- <tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >닉네임</label>
						</th>
						<td>
							<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:active;" id="mb_nick" name="mb_nick" required hname="닉네임">
							<a class="button" onclick="mbNICK_duplicateCheck();"><span>닉네임 중복 확인</span></a>
							<em class="help">* 커뮤니티(게시판)등 익명성이 필요한 곳에서 사용됩니다.</em>
						</td>
					</tr> -->
					<tr>
						<th scope="row" class="vt">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >연락처</label>
						</th>
						<td class="contact">
							<div class="telWrap">
								<!-- <div class="tel">
									<label>전화번호</label>
									<select class="ipSelect" style="width:111px;" id="mb_phone0" name="mb_phone[]" title="지역번호 선택" required hname="지역번호">
									<option value="">지역번호 선택</option>
									<?php echo $tel_num_option; ?>
									</select>
									<span class="delimiter">-</span>
									<input type="text" class="ipText" title="전화번호 앞자리" maxlength="4" id="mb_phone1" name="mb_phone[]" required hname="전화번호 앞자리">
									<span class="delimiter">-</span>
									<input type="text" class="ipText" title="전화번호 뒷자리" maxlength="4" id="mb_phone2" name="mb_phone[]" required hname="전화번호 뒷자리">
								</div> -->
								<div class="mobile mt2">
									<label>휴대폰</label>
									<select class="ipSelect" style="width:111px;" id="mb_hphone0" name="mb_hphone[]" title="휴대폰 국번">
									<option value="">국번</option>
									<?php echo $hp_num_option; ?>
									</select>
									<span class="delimiter">-</span>
									<input type="text" class="ipText" title="휴대폰 앞자리" maxlength="4" id="mb_hphone1" name="mb_hphone[]" required hname="휴대폰 앞자리" value="<?php echo $hp_nums[1];?>">
									<span class="delimiter">-</span>
									<input type="text" class="ipText" title="휴대폰 뒷자리" maxlength="4" id="mb_hphone2" name="mb_hphone[]" required hname="휴대폰 뒷자리" value="<?php echo $hp_nums[2];?>">
								</div>
							</div>
							<!-- <p>
								<input type="checkbox" class="typeCheckbox" id="mb_receive_sms" name="mb_receive[]" value="sms" checked>
								<label class="help">취업/채용관련 소식 등의 SMS 수신</label>
							</p> -->
						</td>
					</tr>
					<!-- <tr>
						<th scope="row" class="vt">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >주소</label>
						</th>
						<td class="addres">
							<div class="addresWrap" id="address_block">
								<div class="adress1">
									<label class="skip">우편번호</label>
									<input type="text" style="width:55px;" class="ipText" title="우편번호 앞자리" maxlength="3" id="mb_zipcode0" name="mb_zipcode[]" readonly required hname="우편번호 앞자리">
									<span class="delimiter">-</span>
									<input type="text" style="width:55px;" class="ipText" title="우편번호 뒷자리" maxlength="4" id="mb_zipcode1" name="mb_zipcode[]" readonly required hname="우편번호 뒷자리">
									<a class="button" onclick="execDaumPostcode();"><span>우편번호 검색</span></a> </div>
									<div class="adress2 mt3">
									<label class="skip">주소</label>
									<input type="text" style="width:300px;" class="ipText" title="주소" id="mb_address0" name="mb_address0" required hname="주소">
									<input type="text" style="width:350px;" class="ipText" title="상세주소" id="mb_address1" name="mb_address1" required hname="상세주소">
								</div>
							</div>
						</td>
					</tr>-->             
					<tr>
						<th scope="row" class="vt">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >e-mail</label>
						</th>
						<td>
							<div class="mbrHelpWrap">
								<input type="text" class="ipText" style="width:150px;ime-mode:disabled;" maxlength="30" id="mb_email" name="mb_email[]" required hname="이메일">
								<span class="delimiter">@</span>
								<input type="text" style="width:185px;ime-mode:disabled;" class="ipText" maxlength="25" title="이메일 서비스 제공자" id="mb_email_tail" name="mb_email[]" required hname="이메일 서비스 제공자">
								<select class="ipSelect" style="width:105px;" id="email_service" onchange="email_sel(this);">
								<option value="">직접입력</option>
								<?php echo $email_option; ?>
								</select>
								<!-- <p>
									<input type="checkbox" class="typeCheckbox" style="ime-mode:disabled;" id="mb_receive_email" name="mb_receive[]" value="email" checked>
									<label class="help">채용정보 등의 이메일 수신</label>
								</p> -->
							</div>
						</td>
					</tr>
					<!-- <tr>
						<th scope="row" class="vt">
							<label>쪽지수신</label>
						</th>
						<td>
							<div class="mbrHelpWrap">
								<p>
									<input type="checkbox" class="typeCheckbox" style="ime-mode:disabled;" id="mb_receive_memo" name="mb_receive[]" value="memo" checked>
									<label class="help">회원간 쪽지 수신</label>
								</p>
							</div>
						</td>
					</tr>
					<tr>
						<th class="bbend" scope="row"> <label>홈페이지주소</label></th>
						<td class="bbend"> 
							http:// <input type="text" style="width:490px;" class="ipText" title="홈페이지주소" maxlength="80" id="mb_homepage" name="mb_homepage">
						</td>
					</tr> -->
				</tbody>
				</table>
			</div>
		</div>

		<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
		<script>
		var element_layer = document.getElementById('addressResult');

		// 우편번호 찾기 화면을 넣을 element
		function execDaumPostcode() {
			
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

					// iframe을 넣은 element를 안보이게 한다.
					//element_layer.style.display = 'none';
					$('#postSearchPop').hide();
					$('#mb_address1').focus();

				},
				width : '100%',
				height : '100%'
			}).embed(element_layer);

			// iframe을 넣은 element를 보이게 한다.
			$('#postSearchPop').show();
		}

		</script>
		<?php } else if($mb_type=='student'){ // 학생 회원 가입폼 ?>

		<div class="layerPop positionA border_color5" style="display:none; width:440px; top:550px; left:50%; text-align:left;" id="postSearchPop">
			<dl>
				<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="postSearchPop_handle">
					<strong>우편번호 검색</strong>
					<em class="closeBtn"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
				</dt>

				<dd style="padding:20px 15px 30px;width:420px;height:275px;" id="addressResult"></dd>

			</dl>
		</div>

		<div class="person mt30" id="individual_form">
			<h2 class="pb5"> <img src="../images/tit/member_nav_tit_04.gif" width="109" height="21" alt="회원정보 입력"> </h2>
			<p class="help">
			ID는 변경할 수 없으니 신중하게 선택해 주시기 바랍니다.<br/>
			연락처와 e-메일 정보는 이력서와 입사지원 시에 사용되므로 반드시 실제 정보를 입력하시기 바랍니다.<br/>
			<img alt="필수입력사항" src="../images/icon/icon_b.gif" >표시는 필수 입력사항 입니다. 
			</p>
			<div class="registWrap mt10">
				<table>
				<caption><span class="skip">개인회원정보 입력폼</span></caption>
				<colgroup><col width="214px"><col width="*"></colgroup>
				<tbody>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >회원아이디</label>
						</th>
						<td>
							<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:disabled;" id="mb_id" name="mb_id" required hname="아이디">
							<a class="button" onclick="mbID_duplicateCheck();"><span>아이디 중복 확인</span></a>
						</td>
					</tr>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >비밀번호</label>
						</th>
						<td>
							<input type="password" class="ipText" style="width:200px;" maxlength="16" id="mb_password" name="mb_password" required hname="비밀번호" option="userpw">
							<em class="help">* 8~20자 사이의 영문, 숫자, 특수문자등으로 조합</em>
						</td>
					</tr>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >비밀번호확인</label>
						</th>
						<td>
							<input type="password" class="ipText checkPwd" style="width:200px;" maxlength="16" id="mb_password_re" name="mb_password_re" required hname="비밀번호확인" option="userpw" matching="mb_password">
							<em class="help">* 비밀번호를 한번 더 입력해 주십시오.</em>
						</td>
					</tr>
					<?php if($use_ipin || $use_hphone){?>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >이름</label>
						</th>
						<td><?php echo $realname;?></td>
					</tr>
					<input type="hidden" name="mb_name" value="<?php echo $realname;?>"/>
					<tr>
						<th scope="row">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >생년월일/성별</label>
						</th>
						<td><?php echo $birth_year;?>년 <?php echo $birth_month;?>월 <?php echo $birth_day;?>일생  (<?php echo $sex_text;?>)</td>
					</tr>
					<input type="hidden" name="mb_birth_year" value="<?php echo $birth_year;?>"/>
					<input type="hidden" name="mb_birth_month" value="<?php echo $birth_month;?>"/>
					<input type="hidden" name="mb_birth_day" value="<?php echo $birth_day;?>"/>
					<input type="hidden" name="mb_gender" value="<?php echo $sex_sel;?>"/>
					<?php } else { ?>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >이름</label>
						</th>
						<td>
							<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:active;" id="mb_name" name="mb_name" required hname="이름">
						</td>
					</tr>
					<!--
					<tr>
						<th scope="row">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >생년월일/성별</label>
						</th>
						<td>
							<select title="년도선택" class="ipSelect" name="mb_birth_year" id="mb_birth_year" style="width:80px" required hname="생년">
							<option value="">년도</option>
							<?php for($i=date('Y')-15;$i>=1900;--$i){ ?>
								<option value='<?=$i?>'><?=$i?></option>
							<?php } ?>
							</select> 년 
							<select title="월 선택" class="ipSelect" name="mb_birth_month" id="mb_birth_month" style="width:59px" required hname="생월">
							<option value="">월</option>
							<?php for($i=1;$i<=12;$i++){?>
							<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
							<?php } ?>
							</select> 월 
							<select title="일 선택" class="ipSelect" name="mb_birth_day" id="mb_birth_day" style="width:59px" required hname="생일">
							<option value="">일</option>
							<?php for($i=1;$i<=31;$i++){?>
							<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
							<?php } ?>
							</select> 일 
							<input type="radio" value="0" name="mb_gender" id="mb_gender_0" required hname="성별">
							<label for="mb_gender_0">남</label>
							<input type="radio" value="1" name="mb_gender" id="mb_gender_1" required hname="성별">
							<label for="mb_gender_1">여</label>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th scope="row"> 
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >닉네임</label>
						</th>
						<td>
							<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:active;" id="mb_nick" name="mb_nick" required hname="닉네임">
							<a class="button" onclick="mbNICK_duplicateCheck();"><span>닉네임 중복 확인</span></a>
							<em class="help">* 커뮤니티(게시판)등 익명성이 필요한 곳에서 사용됩니다.</em>
						</td>
					</tr> -->
					<tr>
						<th scope="row" class="vt">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >연락처</label>
						</th>
						<td class="contact">
							<div class="telWrap">
								<!-- <div class="tel">
									<label>전화번호</label>
									<select class="ipSelect" style="width:111px;" id="mb_phone0" name="mb_phone[]" title="지역번호 선택" required hname="지역번호">
									<option value="">지역번호 선택</option>
									<?php echo $tel_num_option; ?>
									</select>
									<span class="delimiter">-</span>
									<input type="text" class="ipText" title="전화번호 앞자리" maxlength="4" id="mb_phone1" name="mb_phone[]" required hname="전화번호 앞자리">
									<span class="delimiter">-</span>
									<input type="text" class="ipText" title="전화번호 뒷자리" maxlength="4" id="mb_phone2" name="mb_phone[]" required hname="전화번호 뒷자리">
								</div> -->
								<div class="mobile mt2">
									<label>휴대폰</label>
									<select class="ipSelect" style="width:111px;" id="mb_hphone0" name="mb_hphone[]" title="휴대폰 국번">
									<option value="">국번</option>
									<?php echo $hp_num_option; ?>
									</select>
									<span class="delimiter">-</span>
									<input type="text" class="ipText" title="휴대폰 앞자리" maxlength="4" id="mb_hphone1" name="mb_hphone[]" required hname="휴대폰 앞자리" value="<?php echo $hp_nums[1];?>">
									<span class="delimiter">-</span>
									<input type="text" class="ipText" title="휴대폰 뒷자리" maxlength="4" id="mb_hphone2" name="mb_hphone[]" required hname="휴대폰 뒷자리" value="<?php echo $hp_nums[2];?>">
								</div>
							</div>
							<!-- <p>
								<input type="checkbox" class="typeCheckbox" id="mb_receive_sms" name="mb_receive[]" value="sms" checked>
								<label class="help">SMS 수신</label>
							</p> -->
						</td>
					</tr>
					<!-- <tr>
						<th scope="row" class="vt">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >주소</label>
						</th>
						<td class="addres">
							<div class="addresWrap" id="address_block">
								<div class="adress1">
									<label class="skip">우편번호</label>
									<input type="text" style="width:55px;" class="ipText" title="우편번호 앞자리" maxlength="3" id="mb_zipcode0" name="mb_zipcode[]" readonly required hname="우편번호 앞자리">
									<span class="delimiter">-</span>
									<input type="text" style="width:55px;" class="ipText" title="우편번호 뒷자리" maxlength="4" id="mb_zipcode1" name="mb_zipcode[]" readonly required hname="우편번호 뒷자리">
									<a class="button" onclick="execDaumPostcode();"><span>우편번호 검색</span></a> </div>
									<div class="adress2 mt3">
									<label class="skip">주소</label>
									<input type="text" style="width:300px;" class="ipText" title="주소" id="mb_address0" name="mb_address0" required hname="주소">
									<input type="text" style="width:350px;" class="ipText" title="상세주소" id="mb_address1" name="mb_address1" required hname="상세주소">
								</div>
							</div>
						</td>
					</tr>-->             
					<tr>
						<th scope="row" class="vt">
							<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >e-mail</label>
						</th>
						<td>
							<div class="mbrHelpWrap">
								<input type="text" class="ipText" style="width:150px;ime-mode:disabled;" maxlength="30" id="mb_email" name="mb_email[]" required hname="이메일">
								<span class="delimiter">@</span>
								<input type="text" style="width:185px;ime-mode:disabled;" class="ipText" maxlength="25" title="이메일 서비스 제공자" id="mb_email_tail" name="mb_email[]" required hname="이메일 서비스 제공자">
								<select class="ipSelect" style="width:105px;" id="email_service" onchange="email_sel(this);">
								<option value="">직접입력</option>
								<?php echo $email_option; ?>
								</select>
								<!-- <p>
									<input type="checkbox" class="typeCheckbox" style="ime-mode:disabled;" id="mb_receive_email" name="mb_receive[]" value="email" checked>
									<label class="help">채용정보 등의 이메일 수신</label>
								</p> -->
							</div>
						</td>
					</tr>
					<!--
					<tr>
						<th scope="row" class="vt">
							<label>쪽지수신</label>
						</th>
						<td>
							<div class="mbrHelpWrap">
								<p>
									<input type="checkbox" class="typeCheckbox" style="ime-mode:disabled;" id="mb_receive_memo" name="mb_receive[]" value="memo" checked>
									<label class="help">회원간 쪽지 수신</label>
								</p>
							</div>
						</td>
					</tr> -->
					<!-- <tr>
						<th class="bbend" scope="row"> <label>홈페이지주소</label></th>
						<td class="bbend"> 
							http:// <input type="text" style="width:490px;" class="ipText" title="홈페이지주소" maxlength="80" id="mb_homepage" name="mb_homepage">
						</td>
					</tr> -->
				</tbody>
				</table>
			</div>
		</div>

		<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
		<script>
		var element_layer = document.getElementById('addressResult');

		// 우편번호 찾기 화면을 넣을 element
		function execDaumPostcode() {
			
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

					// iframe을 넣은 element를 안보이게 한다.
					//element_layer.style.display = 'none';
					$('#postSearchPop').hide();
					$('#mb_address1').focus();

				},
				width : '100%',
				height : '100%'
			}).embed(element_layer);

			// iframe을 넣은 element를 보이게 한다.
			$('#postSearchPop').show();
		}

		</script>
		<?php } else if($mb_type=='company'){ //기업회원 가입폼 ?>
		
		<input type="hidden" name="mb_birth_year" value="<?php echo $birth_year;?>"/>
		<input type="hidden" name="mb_birth_month" value="<?php echo $birth_month;?>"/>
		<input type="hidden" name="mb_birth_day" value="<?php echo $birth_day;?>"/>
		<input type="hidden" name="mb_gender" value="<?php echo $sex_sel;?>"/>
		<input type="hidden" name="mb_latlng" id="mb_latlng"/>

		<div class="layerPop positionA border_color5" style="display:none; width:460px; top:550px; left:50%; text-align:left;" id="postSearchPop">
			<dl>
				<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="postSearchPop_handle">
					<strong>우편번호 검색</strong>
					<em class="closeBtn"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
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
							<img src="../images/btn/btn23_ok.gif" align="absmiddle" style='cursor:pointer;' class='close' onclick="map_close();">
							<img src="../images/btn/btn23_08.gif" align="absmiddle" style='cursor:pointer;' class='close' onclick="map_close();">
						</td>
					</tr>
					</table>
				</div>

			</dl>
		</div>

		<div class="company mt30" id="company_form">
			<h2 class="pb5"> <img src="../images/tit/member_nav_tit_05.gif" width="114" height="21" alt="회원정보 입력"> </h2>
			<p class="help">
			ID는 변경할 수 없으니 신중하게 선택해 주시기 바랍니다.<br/>
			연락처와 e-메일 정보는 채용공고에 사용되므로 반드시 실제 정보를 입력하시기 바랍니다.<br/>
			<img alt="필수입력사항" src="../images/icon/icon_b.gif" >표시는 필수 입력사항 입니다. 
			</p>
			<div class="registWrap mt10">
				<table>
				<caption><span class="skip">기업회원정보 입력폼</span></caption>
				<colgroup><col width="214px"><col width="*"><col width="214px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >회원아이디</label>
					</th>
					<td colspan="3">
							<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:disabled;" id="mb_id" name="mb_id" required hname="아이디">
							<a class="button" onclick="mbID_duplicateCheck();"><span>아이디 중복 확인</span></a>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >비밀번호</label>
					</th>
					<td colspan="3">
						<input type="password" class="ipText" style="width:200px;" maxlength="16" id="mb_password" name="mb_password" required hname="비밀번호" option="userpw">
						<em class="help  text_help icon">8~20자 사이의 영문, 숫자, 특수문자등으로 조합</em>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >비밀번호확인</label>
					</th>
					<td colspan="3">
						<input type="password" class="ipText checkPwd" style="width:200px;" maxlength="16" id="mb_password_re" name="mb_password_re" required hname="비밀번호확인" option="userpw" matching="mb_password">
						<em class="help  text_help icon">비밀번호를 한번 더 입력해 주십시오.</em>
					</td>
				</tr>
				<tr>
					<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >담당자명</label></th>
					<td colspan="3">
						<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:active;" id="mb_name" name="mb_name" required hname="가입자명">
					</td>
				</tr>

				<?php /* member extend infomation */ ?>
				<!-- <tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >대표자명(ceo)</label>
					</th>
					<td colspan="3">
						<input type="text" maxlength="16" class="ipText" style="width:200px;" id="mb_ceo_name" name="mb_ceo_name" required hname="대표자명">
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >닉네임</label>
					</th>
					<td colspan="3">
						<input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:active;" id="mb_nick" name="mb_nick" required hname="닉네임">
						<a class="button" onclick="mbNICK_duplicateCheck();"><span>닉네임 중복 확인</span></a>
						<em class="help  text_help icon">커뮤니티(게시판)등 익명성이 필요한 곳에서 사용됩니다.</em>
					</td>
				</tr> -->
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >학원/업체명</label>
					</th>
					<td colspan="3">
						<input type="text" maxlength="16" class="ipText" style="width:200px;" id="mb_company_name" name="mb_company_name" required hname="회사/점포명">
					</td>
				</tr>
				<!-- <tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >회사분류</label>
					</th>
					<td colspan="3">
						<select class="ipSelect" style="width:200px;" id="mb_biz_type" name="mb_biz_type" title="회사분류 선택" required hname="업종">
						<option value="">회사분류 선택</option>
						<?php echo $biz_type_option; ?>
						</select>
					</td>
				</tr> -->
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >전화번호</label>
					</th>
					<td colspan="3"><div class="telWrap">
						<div class="tel">
						<select class="ipSelect" style="width:111px;" id="mb_phone0" name="mb_phone[]" title="지역번호 선택" required hname="지역번호">
						<option value="">지역번호 선택</option>
						<?php echo $tel_num_option; ?>
						</select>
						<span class="delimiter">-</span>
						<input type="text" class="ipText" title="전화번호 앞자리" maxlength="4" id="mb_phone1" name="mb_phone[]" required hname="전화번호 앞자리">
						<span class="delimiter">-</span>
						<input type="text" class="ipText" title="전화번호 뒷자리" maxlength="4" id="mb_phone2" name="mb_phone[]" required hname="전화번호 뒷자리">
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>휴대폰번호</label>
					</th>
					<td colspan="3"><div class="telWrap">
						<div class="tel">
							<select class="ipSelect" style="width:111px;" id="mb_hphone0" name="mb_hphone[]" title="휴대폰 국번">
							<option value="">국번</option>
							<?php echo $hp_num_option; ?>
							</select>
							<span class="delimiter">-</span>
							<input type="text" class="ipText" title="휴대폰 앞자리" maxlength="4" id="mb_hphone1" name="mb_hphone[]" hname="휴대폰 앞자리" value="<?php echo $hp_nums[1];?>">
							<span class="delimiter">-</span>
							<input type="text" class="ipText" title="휴대폰 뒷자리" maxlength="4" id="mb_hphone2" name="mb_hphone[]" hname="휴대폰 뒷자리" value="<?php echo $hp_nums[2];?>">
							<!-- <em class="help  text_help icon" style="letter-spacing:-1px;">채용담당자 연락처와는 다른 대표 휴대폰번호 입니다.</em> -->
								
							<p>
								<input type="checkbox" class="typeCheckbox" id="mb_receive_sms" name="mb_receive[]" value="sms" checked>
								<label class="help">인재정보/이력서 관련 소식 등의 SMS 수신</label>
							</p>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"  class="vt">
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >학원/업체 주소</label>
					</th>
					<td class="addres" colspan="3">

						<div class="addresWrap" id="address_block">
							<div class="adress1">
								<label class="skip">우편번호</label>
								<input type="text" style="width:55px;" class="ipText" title="우편번호 앞자리" maxlength="3" id="mb_zipcode0" name="mb_zipcode[]" readonly required hname="우편번호 앞자리">
								<span class="delimiter">-</span>
								<input type="text" style="width:55px;" class="ipText" title="우편번호 뒷자리" maxlength="4" id="mb_zipcode1" name="mb_zipcode[]" readonly required hname="우편번호 뒷자리">
								<a class="button" onclick="execDaumPostcode();"><span>우편번호 검색</span></a> 
							</div>
							<div class="adress2 mt3">
								<label class="skip">주소</label>
								<input type="text" style="width:260px;" class="ipText" title="주소" id="mb_address0" name="mb_address0" required hname="주소">
								<input type="text" style="width:260px;" class="ipText" title="상세주소" id="mb_address1" name="mb_address1" required hname="상세주소">
							</div>
						</div>
					</td>
				</tr>
				<?php
					/* 관리자가 설정한 폼 순서대로 출력 */
					foreach($form_list as $form){
						if($form['view']=='yes') echo $user_control->form_make($form);
					}	// foreach end.
					/* //관리자가 설정한 폼 순서대로 출력 */

				/* //member extend infomation */
				?>
				<!-- <tr>
					<th scope="row" class="vt">
						<label>쪽지수신</label>
					</th>
					<td>
						<div class="mbrHelpWrap">
							<p>
								<input type="checkbox" class="typeCheckbox" style="ime-mode:disabled;" id="mb_receive_memo" name="mb_receive[]" value="memo" checked>
								<label class="help">회원간 쪽지 수신</label>
							</p>
						</div>
					</td>
				</tr> -->
				</tbody>
				</table>
			</div>
			
			<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
			<?php echo $map_script;?>
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

			<?php } ?>

			<div class="joinbtn clearfix mt30">
				<ul> 
					<li id="submit_btn"><a href="javascript:memberFrm_submit();"><div class="btn font_white bg_blueBlack" style="color:#fff;">확인<img class="pb5"src="../images/icon/icon_arrow_right2.png" width="30" height="9" alt="arrow"></div></a></li>
					<li><a href="/"><div class="btn font_gray bg_white" style="color:#474747;">취소<img class="pb5" src="../images/icon/icon_arrow_right3.png" width="30" height="9" alt="arrow"></div></a></li>
				</ul>
			</div>
		</div>
		</form>
		<?php /* //company content form */ ?>

	</div>
</section>

<script>
var memberFrm_submit = function(){	// 폼 전송
	var MemberRegistFrm = document.getElementById('MemberRegistFrm');
	if(validate(MemberRegistFrm)){
		if(mb_type=='company'){	// 기업회원일때만
			if( document.getElementById('tx_mb_biz_vision') ){
				<?php echo $utility->input_cheditor('mb_biz_vision');?>	// 기업개요 및 비전 에디터 내용 전달
			}
			if( document.getElementById('tx_mb_biz_result') ){
				<?php echo $utility->input_cheditor('mb_biz_result');?>	// 기업연혁 및 실적 에디터 내용 전달
			}

			if(mb_id_duplicate==false){
				alert('아이디 중복 확인을 실행해 주세요.');
				return;
			}
			// if(mb_nick_duplicate==false){
				// alert('닉네임 중복 확인을 실행해 주세요.');
				// return;
			// }

		}
	}
	$('#MemberRegistFrm').submit();
}

var showRequest = function(formData, jqForm, member_options){	 // 폼 전송 전
	var queryString = $.param(formData); 
	var MemberRegistFrm = document.getElementById('MemberRegistFrm');
	if(validate(MemberRegistFrm)){
		if(mb_type=='company'){	// 기업회원일때만
			if( document.getElementById('tx_mb_biz_vision') ){
				<?php echo $utility->input_cheditor('mb_biz_vision');?>	// 기업개요 및 비전 에디터 내용 전달
			}
			/* 필수 항목일 경우 주석 제거 하세요.
			if (document.getElementById('tx_mb_biz_vision')) {
				if (!ed_mb_biz_vision.outputBodyText()) { 
					alert('기업개요 및 비전을 입력하십시오.'); 
					ed_mb_biz_vision.returnFalse();
					return;
				}
			}
			*/
			if( document.getElementById('tx_mb_biz_result') ){
				<?php echo $utility->input_cheditor('mb_biz_result');?>	// 기업연혁 및 실적 에디터 내용 전달
			}
			/* 필수 항목일 경우 주석 제거 하세요.
			if (document.getElementById('tx_mb_biz_result')) {
				if (!ed_mb_biz_result.outputBodyText()) { 
					alert('기업개요 및 비전을 입력하십시오.'); 
					ed_mb_biz_result.returnFalse();
					return;
				}
			}
			*/
		}
		if(mb_id_duplicate==false){
			alert('아이디 중복 확인을 실행해 주세요.');
			return;
		}
		
		// nickname 제거 khkim 06.09.17
		// if(mb_nick_duplicate==false){
			// alert('닉네임 중복 확인을 실행해 주세요.');
			// return;
		// }
	}
	$('#'+mb_type+'_form').block({
		message: "<div style='height:50px;margin-top:7%;'>회원가입 중 입니다...</div>",
		css: { border: '2px solid #c0c0c0', height: '50px' },
		overlayCSS: { opacity: 0.5, backgroundColor:'#fff' }
	});
	$('#submit_btn').hide();

	return true;
}
var showResponse = function(responseText, statusText, xhr, $form){	 // 폼 전송 후
	alert(responseText);
	return false;
	var results = responseText.split('/');
	var msg = results[0], result = results[1];
	if(result=='1'){
		location.href = "./result.php";
	} else {
		alert("<?php echo $user_control->_errors('0014');?>");
		$('#'+mb_type+'_form').unblock();
		$('#submit_btn').show();
	}
}
</script>
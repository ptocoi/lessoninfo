<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var insert_mode = "<?php echo $mode;?>";
var mb_type = "<?php echo $mb_type;?>";
var use_map = "<?php echo $use_map;?>";
var daum_local_APIKEY = "<?php echo $daum_local_key;?>";
var naver_map_KEY = "<?php echo $naver_map_key;?>";
var map_color = "<?php echo $map_color;?>";
$(function(){
	<?php if($member['mb_type']=='company'){	// 기업회원일때만 에디터 내용 전달 ?>
	$('#companyFrm').submit(function(){
		<?php 
		if($mb_biz_vision['view']=='yes'){ 
			echo $utility->input_cheditor('mb_biz_vision');	// 기업개요 및 비전 에디터 내용 전달
		}
		?>
		<?php 
		if($mb_biz_result['view']=='yes'){ 
			echo $utility->input_cheditor('mb_biz_result');	// 기업연혁 및 실적 에디터 내용 전달
		}
		?>			
	});
	<?php } ?>
});
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/company_info.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
			<?php /* navigation */ ?>
			<div class="NowLocation mt35 clearfix">
				<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_list.php">채용공고 관리</a> > <strong>기업정보 입력</strong> </p>
			</div>
			<?php /* //navigation */ ?>

			<div class="listWrap positionR mt20">

				<h2 class="pb5"><img src="../images/tit/company_tit_13.gif" alt="기업정보 입력"></h2>
				<div class="companyContentWrap"><!--  컨텐츠  -->

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
										<img src="../images/btn/btn23_ok.gif" align="absmiddle" style='cursor:pointer;' class='close'>
										<img src="../images/btn/btn23_08.gif" align="absmiddle" style='cursor:pointer;' class='close'>
									</td>
								</tr>
								</table>
							</div>

						</dl>
					</div>


					<div id="listForm" class="mainTopBorder positionR mt40 clearfix"> <!--  기업정보 관리   --> 
					<h2 class="skip">기업정보 관리</h2>

						<form method="post" name="companyFrm" action="./process/company.php" id="companyFrm" onsubmit="return validate(this);" enctype="multipart/form-data">
						<input type="hidden" name="mode" value="<?php echo $mode;?>" id="company_mode"/>
						<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
						<input type="hidden" name="no" value="<?php echo $no;?>"/>

						<input type="hidden" name="mb_latlng" id="mb_latlng" value="<?php echo $get_company['mb_latlng'];?>"/>

						<div class="customList2 mb30">

						<!--  로고등록 창 layer -->
						<div style="display:none<?//php echo ($get_company['mb_logo'])?'':'none';?>; width:300px; top:0; right:0%; text-align:left;" class="layerPop positionA border_color3" id="LogoPop">
							<dl style="">
								<dt class="bg_gray1" style="padding:10px 10px;">
									<strong>회사로고</strong>
									<!-- <em class="closeBtn" onclick="logo_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> -->
								</dt>
								<dd style="padding:5px 10px;">
									<div style="border:1px solid #ddd; padding:5px;text-align:center;" class="box2">
										<img src="<?php echo $alice['data_member_path'] . '/' . $member['mb_id'] . '/logo/' . $get_company['mb_logo'];?>" style="max-width:200px;max-height:100px;"/>
									</div>
									<!-- <p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br><strong>200*100픽셀, 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
									<div style="border:1px solid #ddd; padding:10px;" class="box2">
										<input type="file" class="txtForm" style="height:20px;" size="32" id="mb_logo" name="mb_logo">
									</div>
									<div class="btn font_gray bg_white" style="margin:20px auto;">
										<a href="javascript:logo_submit();">등록하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a>
									</div> -->
								</dd>
							</dl>
						</div> 
						<!--  //로고등록 창 layer -->

							<div class="companyRegistWrap">
							<table>
							<caption><span class="skip">담당자정보입력</span></caption>
							<colgroup><col width="140px"><col width="*"></colgroup>
							<tbody>
							<?php if($get_company['mb_logo'] || $get_company['mb_logo_sel']){ ?>
							<tr>
								<th scope="row"> <label>로고 미리보기</label></th>
								<td>
									<img src="<?php echo $company_logo;?>" style="max-width:200px;max-height:100px;"/>
								</td>
							</tr>
							<?php } ?>
							<tr>
								<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >회사로고</label></th>
								<td>
									<label><input type="radio" name="wr_logo" id="wr_logo_0" value="0" checked/>직접</label> <input type="file" class="txtForm" style="height:20px;" size="30" id="mb_logo" name="mb_logo"> [ 권장 : 넓이 200px 이하, 높이 100px 이하 ]
									<!-- <input type="file" maxlength="16" class="ipText" id="mb_logo" name="mb_logo"> -->
									<div class="mt20">
									<?php 
									$n = 1;
									foreach($logo_list['result'] as $val){ 
									?>
										<label><input type="radio" name="wr_logo" id="wr_logo_<?php echo $val['no'];?>" value="<?php echo $val['no'];?>"/><img src="<?php echo $alice['data_logo_path']."/".$val['wr_content'];?>"/></label><?php echo ($n%4==0)?'<br/>':'';?>
									<?php 
									$n++;
									}	// foreach end.
									?>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >대표자명(ceo)</label></th>
								<td><input type="text" class="ipText" style="width:200px;" id="mb_ceo_name" name="mb_ceo_name" value="<?php echo $get_company['mb_ceo_name'];?>" hname="대표자명" required></td>
							</tr>
							<tr>
								<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >회사/점포명</label></th>
								<td><input type="text" class="ipText" style="width:200px;" id="mb_company_name" name="mb_company_name" value="<?php echo $get_company['mb_company_name'];?>" hname="회사/점포명" required></td>
							</tr>
							<tr>
								<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >회사분류</label></th>
								<td>
									<select class="ipSelect" style="width:200px;" id="mb_biz_type" name="mb_biz_type" title="회사분류 선택" required hname="회사분류" option="select">
									<option value="">회사분류 선택</option>
									<?php echo $biz_type_option; ?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >전화번호</label></th>
								<td>
									<div class="telWrap">
										<select class="ipSelect" style="width:111px;" id="mb_biz_phone0" name="mb_biz_phone[]" title="지역번호 선택" required hname="지역번호">
										<option value="">지역번호 선택</option>
										<?php echo $phone_num_option; ?>
										</select>
										<span class="delimiter">-</span>
										<input type="text" class="ipText" title="전화번호 앞자리" maxlength="4" id="mb_biz_phone1" name="mb_biz_phone[]" required hname="전화번호 앞자리" value="<?php echo $mb_biz_phone[1];?>">
										<span class="delimiter">-</span>
										<input type="text" class="ipText" title="전화번호 뒷자리" maxlength="4" id="mb_biz_phone2" name="mb_biz_phone[]" required hname="전화번호 뒷자리" value="<?php echo $mb_biz_phone[2];?>">
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row"> <label>휴대폰번호</label></th>
								<td>
									<div class="telWrap">
										<select class="ipSelect" style="width:111px;" id="mb_biz_hphone0" name="mb_biz_hphone[]" title="휴대폰 국번">
										<?php echo $hphone_num_option; ?>
										</select>
										<span class="delimiter">-</span>
										<input type="text" class="ipText" title="휴대폰 앞자리" maxlength="4" id="mb_biz_hphone1" name="mb_biz_hphone[]" hname="휴대폰 앞자리" value="<?php echo $mb_biz_hphone[1];?>">
										<span class="delimiter">-</span>
										<input type="text" class="ipText" title="휴대폰 뒷자리" maxlength="4" id="mb_biz_hphone2" name="mb_biz_hphone[]" hname="휴대폰 뒷자리" value="<?php echo $mb_biz_hphone[2];?>">
										<em class="help  text_help icon " style="letter-spacing:-0.1em;">채용담당자 연락처와는 다른 대표 휴대폰번호 입니다.</em>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >회사/점포 주소</label>
								</th>
								<td class="addres">

									<div class="addresWrap" id="address_block">
										<div class="adress1">
											<label class="skip">우편번호</label>
											<input type="text" style="width:55px;" class="ipText" title="우편번호 앞자리" id="mb_zipcode0" name="mb_zipcode[]" readonly required hname="우편번호 앞자리" value="<?php echo $mb_zipcode[0];?>">
											<span class="delimiter">-</span>
											<input type="text" style="width:55px;" class="ipText" title="우편번호 뒷자리" id="mb_zipcode1" name="mb_zipcode[]" readonly required hname="우편번호 뒷자리" value="<?php echo $mb_zipcode[1];?>">
											<a class="button" onclick="execDaumPostcode();"><span>우편번호 검색</span></a> 
										</div>
										<div class="adress2 mt3">
											<label class="skip">주소</label>
											<input type="text" style="width:350px;" class="ipText" title="주소" id="mb_address0" name="mb_address0" required hname="주소" value="<?php echo $mb_address0;?>">
											<input type="text" style="width:320px;" class="ipText" title="상세주소" id="mb_address1" name="mb_address1" required hname="상세주소" value="<?php echo $mb_address1;?>">
										</div>
									</div>
								</td>
							</tr>
							<?php
								/* 관리자가 설정한 폼 순서대로 출력 */
								foreach($form_list as $form){
									if($form['view']=='yes') echo $user_control->form_make($form,$mode,$no);
								}	// foreach end.
								/* //관리자가 설정한 폼 순서대로 출력 */

							/* //member extend infomation */
							?>
							<tr>
								<th scope="row" class="bbend"><label>회사이미지</label></th>
								<td class="bbend">
									<div class="photoWrap clearfix">

										<div class="layerPop positionA border_color5" style="width:420px; top:-70%; left:0;display:none;" id="companyPhotoPop">
											<input type="hidden" name="mb_photos" id="mb_photos"/>
											<dl style="">

											<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="companyPhotoPop_handle">
												<strong>회사이미지 등록</strong>
												<em class="closeBtn">
													<img class="pb5" src="../images/icon/icon_close2.gif" width="11" height="11" alt="arrow">
												</em>
											</dt>
											<dd style="padding:10px 15px;">
												<p style="padding-bottom:20px;">
													<strong>GIF,JPEG,JPG</strong> 파일형식으로,<br/>
													<strong>500KB</strong> 용량 이내의 파일만 등록 가능합니다.<br/>
												</p>
												<div class="box2" style="border:1px solid #ddd; padding:10px;">
													<input type="file" name="photo_files" id="photo_files" size="32" style="height:20px;" class="txtForm">
												</div>
												<div  style="margin:20px auto;" class="btn font_gray bg_white">
													<a href="javascript:photos_submit();">등록하기<img class="pb5" src="../images/icon/icon_arrow_right3.png" width="30" height="9" alt="arrow"></a>
												</div>
											</dd>
											</dl>
										</div>

										<ul>
											<li>
												<input type="hidden" name="photos_0" id="photos_0" value="<?php echo $photo_0;?>"/>
												<div class="photo" id="photo_0">
													<img src="<?php echo $photo_0;?>" width="155" height="100" alt="photo">
												</div>
												<div class="buttonWrap">
													<a class="button white" onclick="update_photos('update', 0);" id="update_0">
														<span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
													<a class="button white" onclick="update_photos('delete', 0,'<?php echo $no;?>');" id="delete_0">
														<span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
												</div>
											</li>
											<li>
												<input type="hidden" name="photos_1" id="photos_1" value="<?php echo $photo_1;?>"/>
												<div class="photo" id="photo_1">
													<img src="<?php echo $photo_1;?>" width="155" height="100" alt="photo">
												</div>
												<div class="buttonWrap">
													<a class="button white" onclick="update_photos('update', 1);" id="update_1">
														<span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
													<a class="button white" onclick="update_photos('delete', 1,'<?php echo $no;?>');" id="delete_1">
														<span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
												</div>
											</li>
											<li>
												<input type="hidden" name="photos_2" id="photos_2" value="<?php echo $photo_2;?>"/>
												<div class="photo" id="photo_2">
													<img src="<?php echo $photo_2;?>" width="155" height="100" alt="photo">
												</div>
												<div class="buttonWrap">
													<a class="button white" onclick="update_photos('update', 2);" id="update_2">
														<span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
													<a class="button white" onclick="update_photos('delete', 2,'<?php echo $no;?>');" id="delete_2">
														<span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
												</div>
											</li>
											<li>
												<input type="hidden" name="photos_3" id="photos_3" value="<?php echo $photo_3;?>"/>
												<div class="photo" id="photo_3">
													<img src="<?php echo $photo_3;?>" width="155" height="100" alt="photo">
												</div>
												<div class="buttonWrap">
													<a class="button white" onclick="update_photos('update', 3);" id="update_3">
														<span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
													<a  class="button white" onclick="update_photos('delete', 3,'<?php echo $no;?>');" id="delete_3">
														<span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
												</div>
											</li>
											<li>
												<input type="hidden" name="photos_4" id="photos_4" value="<?php echo $photo_4;?>"/>
												<div class="photo" id="photo_4">
													<img src="<?php echo $photo_4;?>" width="155" height="100" alt="photo">
												</div>
												<div class="buttonWrap">
													<a class="button white" onclick="update_photos('update', 4);" id="update_4">
														<span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
													<a  class="button white" onclick="update_photos('delete', 4,'<?php echo $no;?>');" id="delete_4">
														<span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span>
													</a>
												</div>
											</li>
										</ul>

									</div>
								</td>
							</tr>

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
												printAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
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
											$.post('../member/views/_ajax/post_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
												var data = eval("(" + result + ")");
												var point_y = data.mapy;
												var point_x = data.mapx;
												map_api.map_use("map", "", true);	// 지도 띄우기
												map_api.map_location_move(point_x,point_y);
												map_api.marker_false();
												map_api.addMark();
												map_api.click_event();
												$('#mb_latlng').val(point_y+","+point_x);	// 좌표값 할당
											});
										<?php } else if($use_map=='google'){ ?>
											$('#map').html("");
											$('#addressResult').hide();
											$('#mapBlock').show();
											var search_addr = fullAddr;
											$.post('../member/views/_ajax/post_search.php', { mode:'google_map_search', search_addr:search_addr }, function(result){
												point = result.split('/');
												$('#mb_latlng').val(point[0]+","+point[1]);
												map_api.map_point = [point[0],point[1],'18'];
												map_api.map_use("map", "", true);
												map_api.click_event();
												map_api.addMark();
											});
										<?php } ?>
											// iframe을 넣은 element를 안보이게 한다.
											//element_layer.style.display = 'none';
											//$('#postSearchPop').hide();
										},
										width : '100%',
										height : '100%'
									}).embed(element_layer);

									// iframe을 넣은 element를 보이게 한다.
									$('#postSearchPop').show();
								}
							</script>

							<div style="margin:30px auto;" class="doubleBtn clearfix">
								<ul> 
									<li><div class="btn font_white bg_blueBlack"><a href="javascript:memberFrm_submit();">저장<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
									<li><div class="btn font_gray bg_white"><a href="javascript:history.go(-1);">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
								</ul>
							</div>

						</div>

						</form>

						<div id='zipcode_info'></div>

					</div>

				</div><!--  컨텐츠 end   --> 
			</div><!-- //listWrap -->

		</div><!-- // rightContent -->
	</div>  
</section>
<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var map_load = function(){
	map_api.map_use("map", "", false);
}
</script>

<script type="text/javascript" src="<?php echo $alice['alba_path'];?>/skins/default/company_info.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['alba_path'];?>/">채용정보</a> > <strong>회사정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<div id="popup" class="positionF content_wrap clearfix" style="z-index:9999; display: block; left: 50%; top: 40%; margin-left: -250px; margin-top: -250px;"></div>

		<!--  회사정보 안내  -->
		<div class="listWrap positionR mt10">
			<h2 class="skip">회사정보  </h2>
			<div class="readBtn clearfix">
				<ul class="clearfix">
				<li class="Btn mb5">
				<ul class="snsWrap">
				<em class="scrap_1" onclick="<?php echo ($get_favorite_list['total_count'])?"is_scrap();":"company_scrap('".$no."');";?>"><img  src="../images/icon/icon_scrap3<?php echo ($get_favorite_list['total_count'])?"_on":"";?>.gif" width="81" height="18" alt="관심기업등록" id="scrap_icon"/></em>
				<em class="print_1" onclick="window.print();"><img  src="../images/icon/icon_print1.gif" width="43" height="18" alt="인쇄" /></em>
				</ul>
				</li>
				</ul>
			</div>
			<div class="companyInfo clearfix positionR">
				<!--  회사정보내용  -->
				<ul>
					<li class="compinfoContWrap clearfix">
						<ul style="overflow:hidden;">
							<li class="compinfoLeft" style="height:auto">
								<!--  left: 내용  --> 
								<div class="pt20 pb20 logoImg positionR">
									<?php if(is_file($alice['data_member_path']."/".$mb_id."/logo/".$company_info['mb_logo'])){ ?>
										<img class="vb" src="<?php echo $alice['data_member_path'];?>/<?php echo $mb_id;?>/logo/<?php echo $company_info['mb_logo'];?>" width="<?php echo $mb_logo_width;?>" height="<?php echo $mb_logo_height;?>" alt="<?php echo stripslashes($company_info['mb_company_name']);?> 로고" />
									<?php } else { ?>
										<img class="vb" src="<?php echo $alice['data_logo_path']."/".$employ_logo['wr_content'];?>"/>
									<?php } ?>
								</div>
								<div class="companyPhoto">
									<?php 
									$i = 0;
									foreach($photo_list as $val){ 
										if($val['photo_source']){
											if($i==0){
									?>
									<p class="photo"><a href="javascript:photo_view('<?php echo $mb_id;?>','<?php echo $i;?>','<?php echo $no;?>');"><img alt="회사이미지<?php echo $i+1;?>" src="<?php echo $alice['data_member_path'];?>/<?php echo $mb_id;?>/photos/<?php echo $val['photo_name'];?>"></a>
									<?php } else { ?>
									<a href="javascript:photo_view('<?php echo $mb_id;?>','<?php echo $i;?>','<?php echo $no;?>');"><img alt="회사이미지<?php echo $i+1;?>" src="<?php echo $alice['data_member_path'];?>/<?php echo $mb_id;?>/photos/<?php echo $val['photo_name'];?>"></a>
									<?php
											}
										}	// if end.
									$i++;
									}	// foreach end.
									?>
								</p>
								</div>
								<!--  left: 내용 end -->
							</li>
							<li class="compinfoRight ">
								<!--  right: 내용  --> 
								<div class="compinfoContent pb10">
									<div class="companyTit">
										<h3 class="mb3"><?php echo stripslashes($company_info['mb_company_name']);?></h3>
										<?php if($biz_homepage['view']=='yes'){ ?>
										<p><a target="_blank" href="<?php echo $member_info['mb_homepage'];?>"><?php echo $member_info['mb_homepage'];?></a></p> 
										<?php } ?>
									</div>
									<ul class="mt10"> 
										<li><span><strong>대표자명</strong></span>: <?php echo $company_info['mb_ceo_name'];?></li>                  
										<li><span><strong>회사주소</strong></span>: <?php echo $mb_address;?></li>

										<?php if($biz_content['view']=='yes'){ ?>
											<?php if($company_info['mb_biz_content']){ ?>
											<li><span><strong>사업내용</strong></span>: <?php echo $company_info['mb_biz_content'];?></li>
											<?php } ?>
										<?php } ?>

										<?php if($biz_foundation['view']=='yes'){ ?>
											<?php if($company_info['mb_biz_foundation']){ ?>
											<li><span><strong>설립일</strong></span>: <?php echo $company_info['mb_biz_foundation'];?>년</li>
											<?php } ?>
										<?php } ?>

										<?php if($biz_member_count['view']=='yes'){ ?>
											<?php if($company_info['mb_biz_member_count']){ ?>
											<li><span><strong>직원수</strong></span>: <?php echo $company_info['mb_biz_member_count'];?>명</li>
											<?php } ?>
										<?php } ?>
										<li><span><strong>회사분류</strong></span>: <?php echo $mb_biz_type;?></li>
									</ul>
								</div>
								<!--  right: 내용 end  --> 
							</li>
						</ul>
					</li>
					<li class="summaryBox">
						<?php if($biz_form_option['view']=='yes'){ ?>
						<dl>
							<dt class=""><strong>기업형태</strong></dt>
							<dd><?php echo $mb_biz_form;?></dd>
						</dl>
						<?php } ?>
						<?php if($biz_success['view']=='yes'){ ?>
						<dl>
							<dt class=""><strong>상장여부</strong></dt>
							<dd><?php echo $mb_biz_success;?></dd>
						</dl>
						<?php } ?>
						<?php if($biz_stock['view']=='yes'){ ?>
						<dl>
							<dt class=""><strong>자본금</strong></dt>
							<dd><?php echo $company_info['mb_biz_stock'];?></dd>
						</dl>
						<?php } ?>
						<?php if($biz_sale['view']=='yes'){ ?>
						<dl>
							<dt class="brend"><strong>매출액</strong></dt>
							<dd class="brend"><?php echo $company_info['mb_biz_sale'];?></dd>
						</dl>
						<?php } ?>
						<li></li>
						<li></li>
						<li></li>
						</ul>
					</li>
				</ul>
			<!--  회사정보내용 end -->                 
			</div>
		</div>
		<!--  회사정보 end --> 

		<?php if($biz_vision['view']=='yes'){ ?>
		<!--  기업개요 -->
		<div class="infoContWrap positionR mt50">
			<h2 class=""><img src="../images/tit/job_companyInfo_tit_01.gif" width="182" height="25" alt="기업개요및비전" /></h2>
			<ul id="tab1" class="infoContTab positionA clearfix" style="top:0; right:0;">
				<li class="tab1 on"><a href="#tab1">기업개요</a></li>
				<?php if($biz_result['view']=='yes'){ ?><li class="tab2"><a href="#tab2">기업연혁</a></li><?php } ?>
				<li class="tab3"><a href="#tab3">회사위치</a></li>
				<li class="tab4"><a href="#tab4">진행중인채용정보</a></li>
			</ul> 
			<div class="infoContDetail clearfix positionR mt10">
				<ul>
					<li><?php echo nl2br(stripslashes($company_info['mb_biz_vision']));?></li>
				</ul>
			</div>
		</div>
		<!--  기업개요 end--> 
		<?php } ?>

		<!--  기업연혁 -->
		<?php if($biz_result['view']=='yes'){ ?>
		<div class="infoContWrap positionR mt50">
			<h2 class="">
				<img src="../images/tit/job_companyInfo_tit_02.gif" width="182" height="25" alt="기업연혁 및 실적" />
			</h2>
			<ul id="tab2" class="infoContTab positionA clearfix" style="top:0; right:0;">
				<?php if($biz_vision['view']=='yes'){ ?><li class="tab1 "><a href="#tab1">기업개요</a></li><?php } ?>
				<li class="tab2 on"><a href="#tab2">기업연혁</a></li>
				<li class="tab3"><a href="#tab3">회사위치</a></li>
				<li class="tab4"><a href="#tab4">진행중인채용정보</a></li>
			</ul> 
			<div class="infoContDetail clearfix positionR mt10">
				<ul>
					<li><?php echo nl2br(stripslashes($company_info['mb_biz_result']));?></li>
				</ul>
			</div>
		</div>
		<!--  기업연혁 end--> 
		<?php } ?>

		<!--  회사위치 -->
		<div class="infoContWrap positionR mt50">
			<h2 class=""><img src="../images/tit/job_companyInfo_tit_03.gif" width="92" height="25" alt="회사위치" /></h2>
			<ul id="tab3" class="infoContTab positionA clearfix" style="top:0; right:0;">
				<?php if($biz_vision['view']=='yes'){ ?><li class="tab1 "><a href="#tab1">기업개요</a></li><?php } ?>
				<?php if($biz_result['view']=='yes'){ ?><li class="tab2"><a href="#tab2">기업연혁</a></li><?php } ?>
				<li class="tab3 on"><a href="#tab3">회사위치</a></li>
				<li class="tab4"><a href="#tab4">진행중인채용정보</a></li>
			</ul> 
			<div class="infoContDetail clearfix positionR mt10">
				<dl class="mb10">
					<dt><strong>주소.</strong></dt>
					<dd><?php echo $mb_address;?></dd> 
				</dl>                  
				<dl class="mb10">
					<dt><strong>TEL.</strong></dt>
					<dd><?php echo $wr_mb_phone;?></dd> 
				</dl>
				<?php if($biz_fax['view']=='yes'){ ?>
				<dl class="mb10">
					<dt><strong>FAX.</strong></dt>
					<dd><?php echo $wr_mb_fax;?></dd> 
				</dl>
				<?php } ?>
				<dl>
				<dt class="skip"><strong>회사위치</strong></dt>
				<dd  class="map pt5" style="">
					<div id="map" style="border:1px solid #999; width:780px; height:319px;"></div>
				</dd> 
				</dl>
			</div>
		</div>
		<!--  회사위치 end--> 

		<!--채용리스트-->
		<div id="tab4">
			<dl>
				<dt class="companyline pt20"><img src="/images/icon/company_name_list.gif"></dt>
				<dd>
				<div>
					<table  class="mt20 cpnybox tc" width="100%"cellpadding="0" class="borderCL" cellspacing="0">
						<colgroup><col width="168px"><col width="514px;"><col width=""></colgroup>
						<tr>
						 <td>접수기간</td>
						 <td>채용내용</td>
						 <td>경력</td>
						</tr>
					</table>
				</div>
				<div>
					<table width="100%" cellpadding="0" cellspacing="0">
					<?php if(!$continue_list['total_count']){ ?>
					<tr>
						<td class="tc basic" colspan="5" >진행중인 채용공고가 없습니다.</td>
					</tr>
					<?php } else { 
						foreach($continue_list['result'] as $val){
						$lists = $alba_user_control->get_alba_service($val['no'],"sub_list",94);
						$wr_career = ($val['wr_career_type']) ? $category_control->get_categoryCodeName($val['wr_career']) : "경력무관";	// 경력
						$wr_pay_type = $category_control->get_categoryCodeName($val['wr_pay_type']);	// 급여조건
					?>
					<tr>
						<td class="pt15 font11 tc" style="width:165px;"><font color="#87877f"><?php echo $lists['volume'];?></font></td>
						<td class="pt15 font14 b fontBK">
							<span class="text1"><?php echo $lists['service_icon'];?><a href="./alba_detail.php?no=<?php echo $val['no'];?>"><?php echo $lists['subject'];?></a></span>
						</td>
						<td class="pt15 fontBK" style="width:72px;"><?php echo $wr_career;?></td>
					</tr>
					<tr class="cpnyline">
						<td></td>
						<td class="pb15">
							<table class="font11 b mt5" cellpadding="0" cellspacing="0">
								<tr>
									<td class="pb5">
									<?php if($lists['wr_pay_conference']){ ?>
										<span class="skitbtn1">급여</span> <span><?php echo $alba_user_control->pay_conference[$lists['wr_pay_conference']];?></span>
									<?php } else { ?>
										<span class="skitbtn1"><?php echo $lists['wr_pay_type'];?></span> <span><?php echo $lists['wr_pay'];?>원</span>
									<?php } ?>
									<span class="pl5 skitbtn2">지역</span> <span><?php echo $lists['wr_area'];?></span>
									</td>
								</tr>
								<tr>
									<td></td>
								</tr>
							</table>
						</td>
						<td></td>
					</tr>
					<?php
						}	// foreach end.
					}	// if end.
					?>		
					</table>
				</div>
				</dd>
			</dl>
		</div>
		<!--채용리스트//-->

		<!--  주의사항   -->
		<div style="display:block;" class="Caution mt50 mb20">
			<h3 class="skip">주의사항</h3>
			<ul>
				<li>본 정보는 <?php echo stripslashes($company_info['mb_company_name']);?>에서 <?php echo strtr(substr($member_info['mb_wdate'],0,11),'-','/');?> 이후로 제공한 자료이며, <?php echo $env['site_name'];?>(은)는 그 내용상의 오류 및 지연, 그 내용을 신뢰하여 취해진 조치에 대하여 책임을 지지 않습니다.</li> 
			<li>본 정보는 <?php echo $env['site_name'];?>의 동의없이 재배포할 수 없습니다.&lt;저작권자 ⓒ <?php echo $env['site_name'];?>. 무단전재-재배포 금지&gt;</li> 
			</ul>
		</div>
		<!--  주의사항 end   -->
		</div>

	</div>
</section>
<?php echo $map_script;?>
<script>
<?php if($use_map=='daum'){ ?>
	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = { 
			center: new daum.maps.LatLng(<?php echo $area_point;?>), // 지도의 중심좌표
			level: 3 // 지도의 확대 레벨
		};

	var map = new daum.maps.Map(mapContainer, mapOption);
	// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
	var mapTypeControl = new daum.maps.MapTypeControl();
	// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
	// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
	map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);
	// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
	var zoomControl = new daum.maps.ZoomControl();
	map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);
	// 마커가 표시될 위치입니다 
	var markerPosition  = new daum.maps.LatLng(<?php echo $area_point;?>); 
	// 마커를 생성합니다
	var marker = new daum.maps.Marker({
		position: markerPosition
	});
	// 마커가 지도 위에 표시되도록 설정합니다
	marker.setMap(map);
	<?php if($company_info){?>
	var iwContent = '<div style="padding:5px;margin:0 auto;min-width:135px;text-align:center;"><?php echo $mb_company_name;?></div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
		iwPosition = new daum.maps.LatLng(<?php echo $area_point;?>); //인포윈도우 표시 위치입니다
	// 인포윈도우를 생성합니다
	var infowindow = new daum.maps.InfoWindow({
		position : iwPosition, 
		content : iwContent 
	});  
	// 마커 위에 인포윈도우를 표시합니다. 두번째 파라미터인 marker를 넣어주지 않으면 지도 위에 표시됩니다
	infowindow.open(map, marker);
	<?php } ?>

<?php } else if($use_map=='naver'){ ?>
	
	map_api.map_use("map", "", true);	// 지도 띄우기
	map_api.map_location_move(<?php echo $area_point;?>);
	map_api.addMark();

<?php } else if($use_map=='google'){ ?>

	map_api.map_point = [<?php echo $area_point;?>,'18'];
	map_api.map_use("map", "", true);
	map_api.addMark();

<?php } ?>

</script>
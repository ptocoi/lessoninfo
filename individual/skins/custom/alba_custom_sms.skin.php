<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_scrap.php">맞춤서비스 관리</a> > <strong>맞춤 SMS</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_12.gif" width="102" height="25" alt="맞춤SMS"></h2>
			<em class="titEm mb20">
			<ul><li>맞춤 조건별 채용공고가 등록되면, 문자메시지로 알려드리는 서비스입니다.</li></ul>
			</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt30 clearfix"> <!--  맞춤SMS 관리   --> 
					<h2 class="ml2 font14 clearfix">
					<strong><img width="13" height="13" class="vm mr5 bg_blue4" src="../images/icon/icon_arrow_4.png" alt="">맞춤 조건 선택</strong>
					</h2>
					<em class="positionA" style="top:-5px; right:0;"><a class="button"><span>맞춤정보 설정<img width="7" height="9" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_6.gif" class="pl5"></span></a></em>        
					<div class="smartSetup positionR mb30"><!--  맞춤SMS   --> 
						<ul>
							<li class="setupView  bg_blue2"><span class="tit"><strong>ilovwerse</strong></span> 님의 설정 정보는 <span><strong class="pl10 tit text_orange">웹디자인,연예,쇼핑몰</strong></span>입니다.<em class="pl10 pr10"><!--<img width="68" height="17" alt="sms수신중" src="../images/icon/icon_customSMS_01.gif" class="bg_orange vt">--><img width="78" height="17" alt="sms비수신중" src="../images/icon/icon_customSMS_02.gif" class="bg_orange vt"></em></li>
							<li class="setupSelect">
							<label for="item1"><strong class="pr10">맞춤 조건 선택</strong></label>        
							<select title="맞춤조건 선택" name="" id="" style="width:280px;" class="ipSelect">
							<option value="">---------------------------------------</option>
							<option value="02">02</option>
							</select>      
							</li>
						</ul>
					</div>
				</div>        
			</div><!--  맞춤채용정보 end   -->

			<div id="listForm" class="mainTopBorder positionR mt30 clearfix"> <!--  조건설정수정   --> 
				<h2 class="ml2 font14 clearfix">
					<strong><img width="13" height="13" class="vm mr5 bg_blue4" src="../images/icon/icon_arrow_4.png" alt="">맞춤SMS 수신설정</strong>
				</h2>        
				<div class="customList2 mb30"><!--  조건설정수정   --> 
					<div class="personRegistWrap">          
					<table>
					<caption><span class="skip">희망근무조건출력</span></caption>
					<colgroup><col width="159px"><col width="*"></colgroup>
					<tbody>
					<tr>
						<th scope="row"><label>휴대폰 번호</label></th>
						<td>
							<div class="mobile">
								<select class="ipSelect" style="width:60px;" id="" name="" title="휴대폰 국번">
								<option value="010">010</option>
								<option value="011">011</option>
								<option value="016">016</option>
								<option value="017">017</option>
								<option value="018">018</option>
								<option value="019">019</option>
								</select>
								<span class="delimiter">-</span>
								<input type="text" class="ipText" style="width:50px;" placeholder="1544" title="휴대폰 앞자리" maxlength="4" id="" name="">
								<span class="delimiter">-</span>
								<input type="text" class="ipText" style="width:50px;" placeholder="1544" title="휴대폰 뒷자리" maxlength="4" id="" name="">
								<a href="" class="button"><span class="bg_orange">인증번호 받기</span></a>
								<em class="help text_help  icon ml10 mt5">맞춤 sms를 받으시려면 휴대폰인증이 필요합니다.</em>
							</div>                
						</td>
					</tr>
					<tr>
						<th scope="row"><label>수신설정</label></th>
						<td>
							<div class="smsstate">
								<input type="radio" checked="" class="chk" value="" id="smsstate1" name="state"><label for="smsstate1" class="pr10">신청</label>
								<input type="radio" class="chk" value="" id="smsstate2" name="state"><label for="smsstate2">신청해지</label>
							</div>
						</td>
					</tr>
					<tr>
						<th scope="row"> <label>수신기간</label></th>
						<td>
							<div class="publishdayWrap positionR">
								<select id="publishday" class="ipSelect" name="publishday">
								<option value="">선택</option>
								<option value="2">2일</option>
								<option value="3">3일</option>
								<option value="5">5일</option>
								<option value="7">7일</option>
								</select> 
								<em class="help text_help  icon ml10 mt5">오늘부터 선택한 기간동안에만 문자가 발송됩니다.</em>
							</div>
						</td>
					</tr>
					<tr>
						<th scope="row"><label>수신시간</label></th>
						<td>
							<div class="stimeWrap">
								<select name="stime" class="ipSelect" id="stime">
								<option value="0800">08:00</option><option value="0900">09:00</option><option value="1000">10:00</option><option value="1100">11:00</option><option value="1200">12:00</option><option value="1300">13:00</option><option value="1400">14:00</option><option value="1500">15:00</option><option value="1600">16:00</option><option value="1700">17:00</option><option value="1800">18:00</option><option value="1900">19:00</option><option value="2000">20:00</option><option value="2100">21:00</option><option value="2200">22:00</option>
								</select> ~
								<select name="etime" class="ipSelect" id="etime">
								<option value="0800">08:00</option><option value="0900">09:00</option><option value="1000">10:00</option><option value="1100">11:00</option><option value="1200">12:00</option><option value="1300">13:00</option><option value="1400">14:00</option><option value="1500">15:00</option><option value="1600">16:00</option><option value="1700">17:00</option><option value="1800">18:00</option><option value="1900">19:00</option><option value="2000">20:00</option><option value="2100">21:00</option><option value="2200">22:00</option>
								</select>
								<em class="help text_help  icon ml10 mt5">지정된 시간에만 문자가 발송됩니다.</em>
							</div>
						</td>
					</tr>              
					<tr>
						<th class="vt" scope="row"> <label>수신건수</label></th>
						<td>
							<div class="smsCountWrap positionR">
								<select style="width:70px;" class="ipSelect" name="smsCount">
								<option value="1">1개</option>
								<option value="2">2개</option>
								<option value="3">3개</option>
								<option value="4">4개</option>
								<option selected="" value="5">5개</option>
								</select>
								<em class="help text_help  icon ml10 mt5">1일 최대 5건까지 설정 가능합니다.</em>
							</div>
						</td>
					</tr>              
					<tr>
						<th class="bbend" scope="row"><label>수신형태</label></th>
						<td class="customSms bbend">
							<div class="typeUrl">
								<input type="radio" value="2" class="typeRadio" name="smstype" id="smstype1"> <label for="smstype1">URL형</label>
								<p class="pt10"><img width="257" height="87" alt="맞춤SMS" src="../images/basic/img_customSms_01.gif"></p>
								</div>
								<div class="typeNormal">
								<input type="radio" value="1" class="typeRadio" name="smstype" id="smstype2"> <label for="smstype2">일반형</label>
								<p class="pt10"><img width="211" height="87" alt="맞춤SMS" src="../images/basic/img_customSms_02.gif"></p>
							</div>
						</td>
					</tr>
					</tbody>
					</table>
					</div>
					<div style="margin:50px auto;" class="doubleBtn clearfix">
						<ul> 
							<li><div class="btn font_white bg_blueBlack"><a href="#">설정완료<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
							<li><div class="btn font_gray bg_white"><a href="#">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
						</ul>
					</div>        
					</div>
					</div><!--  조건설정수정 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>
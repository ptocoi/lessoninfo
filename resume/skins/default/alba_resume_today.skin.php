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
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['resume_path'];?>/">인재정보</a> > <a href="#">일반 인재정보</a> > <strong>이력서 관리·수정</strong></p>
		</div>
		<?php /* //navigation */ ?>

		<!--  오늘의 인재 검색영역 -->
		<div class="listWrap mt20">
			<h2 class=""><img src="../images/tit/resume_tit_05.gif"  alt="오늘의인재"></h2>
			<div class="resumeContentWrap positionR mt10 clearfix" style="border-top:3px solid #404660;">
				<div class="searchBox">
				<ul>
				<li class="Info clearfix">
					<div class="school">
						<dl>
							<dt class="pb5"><strong>학력</strong></dt>
							<dd>
								<select title="근무기간" name="" id="" style="width:90px;" class="ipSelect2">
								<option value="0">근무기간</option>
								</select>
								~
								<select title="근무요일" name="" id="" style="width:90px;" class="ipSelect2">
								<option value="0">근무요일</option>
								</select>
							</dd>
						</dl>
					</div>
					<div class="career">
						<dl>
							<dt class="pb5"><strong>경력</strong></dt>
							<dd>
								<select title="근무기간" name="" id="" style="width:90px;" class="ipSelect2">
								<option value="0">근무기간</option>
								</select>
								~
								<select title="근무요일" name="" id="" style="width:90px;" class="ipSelect2">
								<option value="0">근무요일</option>
								</select>
							</dd>
						</dl>
					</div>
					<div class="age">
						<dl>
							<dt class="pb5"><strong>나이</strong></dt>
							<dd>
								<select title="근무기간" name="" id="" style="width:90px;" class="ipSelect2">
								<option value="0">근무기간</option>
								</select>
								~
								<select title="근무요일" name="" id="" style="width:90px;" class="ipSelect2">
								<option value="0">근무요일</option>
								</select>
							</dd>
						</dl>
					</div>

					<div class="gender">
						<dl>
							<dt class="pb5"><strong>성별</strong></dt>
							<dd>
								<input type="radio" value="1" id="gender1" name="gender"><label for="gender1">남자</label>
								<input type="radio" value="2" id="gender2" name="gender"><label for="gender2">여자</label>
							</dd>
						</dl>
					</div>
				</li>
				<li class="workArea clearfix">
					<dl>
					<dt><strong>희망근무지역</strong></dt>
					<dd class="itemBoxArea">
						<div class="bigArea clearfix">
							<ul class="listArea">
							<li><span><input type="checkbox"  name="bigArea" id="bigArea1" ><label for="bigArea1">서울</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea2" ><label for="bigArea2">경기</label></span></li>
							<li><span class="checkOn"><input  checked="checked" type="checkbox"  name="bigArea" id="bigArea3" ><label for="bigArea3">인천</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea4" ><label for="bigArea4">대전</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea5" ><label for="bigArea5">세종</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea6" ><label for="bigArea6">충남</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea7" ><label for="bigArea7">충북</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea8" ><label for="bigArea8">광주</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea9" ><label for="bigArea9">전남</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea10" ><label for="bigArea10">전북</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea11" ><label for="bigArea11">대구</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea12" ><label for="bigArea12">경북</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea13" ><label for="bigArea13">부산</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea14" ><label for="bigArea14">울산</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea15" ><label for="bigArea15">경남</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea16" ><label for="bigArea16">강원</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea17" ><label for="bigArea17">제주</label></span></li>
							<li><span><input type="checkbox"  name="bigArea" id="bigArea18" ><label for="bigArea18">전국</label></span></li>
							</ul>
						</div>
						<div class="mt5 middleArea border_blue clearfix" style="display:none;">
							<ul class="listArea">
								<li><span><input type="checkbox"  name="middleArea" id="middleArea1" ><label for="middleArea1">전체</label></span></li>
								<li><span ><input  type="checkbox"  name="middleArea" id="middleArea2" ><label for="middleArea2">강화군</label></span></li>
								<li><span class="checkOn"><input type="checkbox"  checked="checked" name="middleArea" id="middleArea3" ><label for="middleArea3">계양구</label></span></li>
								<li><span><input type="checkbox"  name="middleArea" id="middleArea4" ><label for="middleArea4">남구</label></span></li>
								<li><span><input type="checkbox"  name="middleArea" id="middleArea5" ><label for="middleArea5">남동구</label></span></li>
							</ul>
						</div>
						<div class="mt5 smallArea border_blue bg_blue2 clearfix" style="display:none;">
							<ul class="listArea">
								<li><span><input type="checkbox"  name="smallArea" id="smallArea1" ><label for="smallArea1">계양구</label></span></li>
								<li><span class="checkOn"><input type="checkbox"  checked="checked" name="smallArea" id="smallArea2" ><label  for="smallArea2">남구</label></span></li>
								<li><span><input type="checkbox"  name="smallArea" id="smallArea3" ><label for="smallArea3">남동구</label></span></li>
								<li><span><input type="checkbox"  name="smallArea" id="smallArea4" ><label for="smallArea4">동구</label></span></li>
								<li><span><input type="checkbox"  name="smallArea" id="smallArea5" ><label for="smallArea5">부평구</label></span></li>
							</ul>
						</div>   
					</dd>
					</dl>
				</li>
				<li class="partSet clearfix">
					<dl>
						<dt><strong>희망 업직종</strong></dt>
						<dd class="itemBoxPartSet">
							<div class="bigPartSet clearfix">
								<ul class="listArea">
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet1" ><label for="bigPartSet1">경영·사무</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet2" ><label for="bigPartSet2">영업·TM</label></span></li>
								<li><span class="checkOn"><input type="checkbox"  checked="checked"  name="bigPartSet" id="bigPartSet3" ><label for="bigPartSet3">IT·인터넷</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet4" ><label for="bigPartSet4">디자인</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet5" ><label for="bigPartSet5">서비스</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet6" ><label for="bigPartSet6">전문직</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet7" ><label for="bigPartSet7">의료</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet8" ><label for="bigPartSet8">생산·제조</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet9" ><label for="bigPartSet9">건설</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet10" ><label for="bigPartSet10">유통·무역</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet11" ><label for="bigPartSet11">미디어</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet12" ><label for="bigPartSet12">교육</label></span></li>
								<li><span><input type="checkbox"  name="bigPartSet" id="bigPartSet13" ><label for="bigPartSet13">특수계층·공공</label></span></li>
								</ul>
							</div>
							<div class="mt5 middlePartSet border_blue clearfix" style="display:none;">
								<ul class="listArea">
								<li><span><input type="checkbox"  name="middlePartSet" id="middlePartSet1" ><label for="middlePartSet1">웹마스터</label></span></li>
								<li><span><input type="checkbox"  name="middlePartSet" id="middlePartSet2" ><label for="middlePartSet2">서버·네트워크·보안</label></span></li>
								<li><span><input type="checkbox"  name="middlePartSet" id="middlePartSet3" ><label for="middlePartSet3">웹기획·웹마케팅·PM</label></span></li>
								<li><span><input type="checkbox"  name="middlePartSet" id="middlePartSet4" ><label for="middlePartSet4">웹프로그래머</label></span></li>
								<li><span><input type="checkbox"  name="middlePartSet" id="middlePartSet5" ><label for="middlePartSet5">게임·Game</label></span></li>
								<li><span><input type="checkbox"  name="middlePartSet" id="middlePartSet6" ><label for="middlePartSet6">컨텐츠·사이트운영</label></span></li>
								<li><span><input type="checkbox"  name="middlePartSet" id="middlePartSet7" ><label for="middlePartSet7">응용프로그래머</label></span></li>
								<li><span><input type="checkbox"  name="middlePartSet" id="middlePartSet8" ><label for="middlePartSet8">시스템프로그래머</label></span></li>
								</ul>
							</div>
						</dd>
					</dl>    
				</li>
				<li class="workTerms clearfix">
					<dl>
					<dt><strong>희망 근무조건</strong></dt>
						<dd class="workTermsBox clearfix">
							<span class="pr10"><input type="checkbox" value="1" id="atOnce" name="atOnce"><label for="atOnce">즉시출근가능</label></span>
							<select title="근무기간" name="" id="" style="width:150px;" class="ipSelect2">
							<option value="0">근무기간</option>
							</select>
							<select title="근무요일" name="" id="" style="width:150px;" class="ipSelect2">
							<option value="0">근무요일</option>
							</select>
							<select title="근무시간" name="" id="" style="width:150px;" class="ipSelect2">
							<option value="0">근무시간</option>
							</select>
						</dd>
					</dl>
				</li>
				<li class="search clearfix">
					<dl>
						<dt><strong>검색어</strong></dt>
						<dd class="keywordSearch"><input type="text" value="" maxlength="20" style="width:400px;" class="ipText2" id="Keyword"  name="Keyword"></dd>
					</dl>
				</li>
				<li class="resultSet clearfix">
					<div class="resultBox">
					<dl class="selectBox  clearfix" style="display:none;"><!-- 선택조건 있을때 display-->
					<dt class="pb5"><strong>선택된 조건</strong></dt>
						<dd>
							<ul class="selectList">
								<li>의료·보건·복지<button type="button" class="close">x</button></li>
								<li>1111111<button type="button" class="close">x</button></li>
								<li>의료·보건·복지<button type="button" class="close">x</button></li>
								<li>1111111<button type="button" class="close">x</button></li>                                
								<li>의료·보건·복지<button type="button" class="close">x</button></li>
								<li>1111111<button type="button" class="close">x</button></li>                                
								<li>의료·보건·복지<button type="button" class="close">x</button></li>
								<li>1111111<button type="button" class="close">x</button></li>
								<li>의료·보건·복지<button type="button" class="close">x</button></li>
								<li>1111111<button type="button" class="close">x</button></li>                                
								<li>의료·보건·복지<button type="button" class="close">x</button></li>
								<li>1111111<button type="button" class="close">x</button></li>                                
								<li>의료·보건·복지<button type="button" class="close">x</button></li>
								<li>1111111<button type="button" class="close">x</button></li>
							</ul>
						</dd>
					</dl>
					<p class="noSelect" style="display:block;">선택된 조건이 없습니다.</p><!-- 선택조건 없을때 display-->
					<p class="btnAction">
						<a href="#" class="searchBtn"><span class="Btn bg_blue4">검색</span></a>
						<a class="resetBtn"><span class="Btn">초기화</span></a>
					</p>
					</div>
				</li>
				</ul>
				</div>
			</div>
		</div>
		<!--  채용정보 메인 검색영역 end -->

				<!--  오늘의인재   --> 
				<div id="listForm" class="positionR mt30 clearfix">
				<h2 class="clearfix">
				<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_blue4"> 오늘의 인재</strong><em class="pl10">1,150건</em>
				</h2>
				<span class="positionA" style="top:-5px; right:0;">
				<select title="pagesize" name="" id="" style="width:100px;" class="ipSelect2">
				<option selected="selected" value="20">20개씩 보기</option>
				<option value="30">30개씩 보기</option>
				<option value="50">50개씩 보기</option>
				</select>
				</span>
				<table cellspacing="0" summary="일반인재 정보입니다">
				<caption class="skip">일반 인재</caption>
				<colgroup>
				<col width="105px">
				<col width="*">
				<col width="100px">
				<col width="90px">
				<col width="70px">
				</colgroup>
				<thead>
				<tr>
				<th class="name" scope="col">이름</th>
				<th class="title" scope="col">이력서정보</th>
				<th class="pay" scope="col">희망급여</th>
				<th class="local" scope="col">희망지역</th>
				<th class="modDate" scope="col">수정일</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td scope="row" class="name">
				<span>김○○<em class="pl5 photo"><img class="vb" src="../images/icon/icon_photo1.gif" width="16" height="16"></em></span>
				<span class="block">(男 <span>30</span>세)</span>
				</td>
				<td class="title">
				<a href="/resume/Detail.asp?adid=4619612">
				<span class="title">알바 정규직 원합니다</span>
				<span class="kind text_blue">제조·가공,포장·조립,품질검사·관리</span>
				<span class="career"><img  class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	<span>1</span>년 	<span>4</span>개월</span>
				<span class="license"><img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> 자동차운전면허</span>

				</a>
				</td>
				<td class="pay">
				<span class="pay">1,300,000 <img class="vb" alt="월" src="../images/icon/icon_pay_month.gif" width="13" height="15"></span>
				</td>
				<td class="local">광주 > 서구 <br>광주 > 북구 </td>
				<td class="modDate"><span>today</span></td>
				</tr>
				</tbody>
				</table>
				<div class="paging">
				<span class="page ">
				<a class="prev" href="#">&lt;</a>
				<a class="page now" href="#">1</a><a class="page" href="#">2</a>
				<a class="next" href="#">&gt;</a>
				<span class="location">[<strong>11</strong>/136]</span>
				</span>
				</div>

			</div>
			<!--  일반인재 end   --> 
		</div>
	</div>
</section>
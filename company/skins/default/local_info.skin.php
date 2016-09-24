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
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_list.php">채용공고 관리</a> > <strong>근무처 관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
		<h2 class="pb5">
		<img src="../images/tit/company_tit_06.gif" width="120" height="25" alt="근무처 관리">
		</h2>
		<em class="titEm mb20">
		<ul>
		<li>근무처를 등록하시면 채용공고 등록 시 근무처를 입력하실 필요가 없어 채용공고 등록 시간을 단축하실 수 있습니다.</li>
		<li>지점이 여러 곳이거나 파견업체에서 활용하시면 더욱 효과적입니다.</li>
		</ul>
		</em>
		<div class="companyContentWrap"><!--  컨텐츠  -->
		<div id="listForm" class="mainTopBorder positionR mt40 clearfix"> <!--  근무처 관리   --> 
		<h2 class="skip">근무처 관리</h2>
		<div class="customList1 mb30"><!--  맞춤인재정보   --> 
		<em class="positionA" style="top:-25px; right:0;"><a class="button"><span>근무처정보 추가<img width="7" height="9" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_6.gif" class="pl5"></span></a></em>      <table cellspacing="0" summary="오늘 등록된 인재의  정보입니다">
		<caption class="skip">근무처 관리</caption>
		<colgroup>
		<col width="10px">
		<col width="*">
		<col width="150px">
		<col width="150px">
		</colgroup>
		<thead>
		<tr>
		<th scope="col"><input type="checkbox"  value="1" name="chkAll"></th>
		<th scope="col">근무지주소</th>
		<th scope="col">근무회사/점포명</th>
		<th scope="col">근무처관리</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td class="tc"><input type="checkbox"  value="1" name="chkAll"></td>
		<td class="tl"><span class="pl10">광주 서구 쌍촌동 1542</span></td>
		<td class="tc"><span>넷퓨2</span></td>
		<td class="tc"><span><a href="" class="url">보기</a> <a href="" class="url">수정</a></span></td>          
		</tr>
		</tbody>
		</table>
		<div class="btnBottom mt10">
		<a class="button white"><span>삭제</span></a> 
		</div>        
		<div class="paging"><!--  페이지번호  --> 
		<span class="page ">
		<a class="prev" href="#">&lt;</a>
		<a class="page now" href="#">1</a><a class="page" href="#">2</a>
		<a class="next" href="#">&gt;</a>
		<span class="location">[<strong>11</strong>/136]</span>
		</span>
		</div><!--  페이지번호 end   -->
		</div><!--  근무처 관리 end   --> 
		<div id="listForm" class="positionR mt30 clearfix" style="display:none;"> <!--  근무처정보입력   --> 
		<h2 class="ml2 font14 clearfix">
		<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vm mr5 bg_blue4">근무처정보 입력</strong>
		</h2>
		<div class="customList2 mb30">
		<div class="companyRegistWrap">
		<table>
		<caption>
		<span class="skip">근무처정보입력</span>
		</caption>
		<colgroup>
		<col width="159px">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
		<th scope="row"> <label>근무회사/점포명<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
		</th>
		<td><input type="text" name="" id="" style="width:200px;" class="ipText" placeholder="넷퓨" maxlength="16"></td>
		</tr>
		<tr>
		<th class="vt" scope="row"> <label>근무지 주소<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label></th>
		<td>
		<div class="addressWrap pb5 positionR">
		<select title="시·도 선택" name="" id="" style="width:70px;" class="ipSelect">
		<option value="0">시·도</option>
		</select>
		<select title="시군구 선택" name="" id="" style="width:70px;" class="ipSelect">
		<option value="0">시군구</option>
		</select>
		<select title="읍면동 선택" name="" id="" style="width:70px;" class="ipSelect">
		<option value="0">읍면동</option>
		</select>
		<input type="text" name="" id="" style="width:160px;" class="ipText" maxlength="16">
		<em><a class="button"><span>지도위치확인</span></a></em> 
		</div>
		</td>
		</tr>
		<tr>
		<th scope="row"> <label>인근지하철</label></th>
		<td>
		<div class="subwayWrap pb5 positionR">
		<select title="호선 선택" name="" id="" style="width:75px;" class="ipSelect">
		<option value="0">호선</option>
		</select>
		<select title="지하철역 선택" name="" id="" style="width:100px;" class="ipSelect">
		<option value="0">지하철역</option>
		</select>
		<input type="text" name="" id="" style="width:200px;" class="ipText" placeholder="출구, 소요시간을 입력해주세요." maxlength="16">
		<em class="positionA insert" style="right:0; top:5px;"> <a class="button white"><span>+추가</span></a> </em> 
		</div></td>
		</tr>
		<tr>
		<th scope="row"> <label>인근대학</label></th>
		<td>
		<div class="schoolWrap pb5 positionR">
		<select title="지역 선택" name="" id="" style="width:75px;" class="ipSelect">
		<option value="0">지역</option>
		</select>
		<select title="인근대학 선택" name="" id="" style="width:305px;" class="ipSelect">
		<option value="0">인근대학 선택</option>
		</select>
		</div>
		</td>
		</tr>
		<tr>
		<th class="bbend vt" scope="row"> <label>근무회사 이미지</label>
		</th>
		<td class="bbend">
		<div class="photoWrap positionR clearfix">
		<ul>
		<li>
		<div class="photo"> <img alt="photo" src="../images/basic/img_photo.jpg"> </div>
		<div class="buttonWrap"> <a class="button white"> <span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span> </a> <a class="button white"> <span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span> </a> </div>
		</li>
		<li>
		<div class="photo"> <img  alt="photo" src="../images/basic/img_photo.jpg"> </div>
		<div class="buttonWrap"> <a class="button white"> <span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span> </a> <a class="button white"> <span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span> </a> </div>
		</li>
		<li>
		<div class="photo"> <img  alt="photo" src="../images/basic/img_photo.jpg"> </div>
		<div class="buttonWrap"> <a class="button white"> <span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span> </a> <a class="button white"> <span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span> </a> </div>
		</li>
		<li>
		<div class="photo"> <img  alt="photo" src="../images/basic/img_photo.jpg"> </div>
		<div class="buttonWrap"> <a class="button white"> <span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span> </a> <a class="button white"> <span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span> </a> </div>
		</li>
		</ul>
		<em style="right:80px; top:40px;" class="positionA">
		<input type="checkbox" id="" class="typeCheckbox">
		<label class="help">회사이미지 사용</label>
		</em> 
		</div></td>
		</tr>
		</tbody>
		</table>
		</div>
		<div style="margin:30px auto;" class="doubleBtn clearfix">
		<ul> 
		<li><div class="btn font_white bg_blueBlack"><a href="#">저장<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
		<li><div class="btn font_gray bg_white"><a href="#">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
		</ul>
		</div>        
		</div>
		</div> <!--  근무처정보입력 end   --> 

		</div><!--  컨텐츠 end   --> 
		</div>
		</div>
		</div>
	</div>  
</section>
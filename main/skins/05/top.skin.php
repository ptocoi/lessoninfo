<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<style type="text/css">
/* === logo === */
#globalSearch .logo{position:absolute; bottom:-2px; left:0;}

/* === search === */
#globalSearch{position:relative; width:960px; margin:30px auto 8px; }
.search_wrap{width:290px; margin:0 auto;}
.search_wrap input#stext{float:left; margin-left:5px; margin-top:5px; width:220px; height:23px; border:none;  font-size:12px; text-indent:5px;}
.search_wrap dd a.btn{display:inline-block; width:54px; height:33px; line-height:33px;  margin-left:0; background:none repeat scroll 0 0; background-color:transparent !important;}
/* === search word === */
.topKey{height:20px; margin-top:5px;}
.topKey li{display:inline-block;zoom:1;*display:inline/*IE7 HACK*/; padding:0 5px; font-size:11px; background:url("../images/main/bg_line_1.gif") no-repeat scroll 0 45%;}
.topKey li.last{background:none;}



/* === main navigation === */
#main_nav{position:relative; width:100%;filter:none; }

#main_nav .mainnavWrap{position:relative; width:960px; margin:0 auto;/* overflow:hidden;*/}
#main_nav .ml_nav{width:706px; height:39px; border:0;}
#main_nav .ml_nav > li{display:inline-block;zoom:1;*display:inline/*IE7 HACK*/; padding:0 10px; z-index:50; background:url("../images/main/bg_line_1.png") no-repeat scroll 0 50%;}
#main_nav .ml_nav > li > a{line-height:35px;}
#main_nav .ml_nav > li.bgLayer > a{background:url("../images/icon/icon_arrow_bottom1.png") no-repeat scroll 0 50%; padding-left:9px;}
#main_nav .ml_nav > li.bgLayer.on > a{background:url("../images/icon/icon_arrow_bottom2.png") no-repeat scroll 0 50%; padding-left:9px;}

.mr_nav{ width:240px; height:47px; border:1px solid #ddd;}
.mr_nav li{display:inline-block;zoom:1;*display:inline/*IE7 HACK*/; margin-top:10px; padding:0 10px; background:url("../images/main/bg_line_1.png") no-repeat scroll 0 50%; }
.mr_nav li.first {background:none;}

#main_nav .s_nav{position:absolute; right:7px; top:-3px; text-align:center; } 
#main_nav .s_nav li{float:left; display:inline; padding:0 3px;line-height:21px; height:21px; border:1px solid #ddd;  box-shadow:inset 0px 0px 1px #ddd; background-color:#ddd; }
#main_nav .s_nav li img{vertical-align:middle;}
#main_nav img{vertical-align:middle;}
#main_nav li.first {background:none;}
</style>
<script>
var individual_service = function( regist ){
	if(is_member){
		if(mb_type=='company'){
			alert("<?php echo $user_control->_errors('0030');?>");
			return;
		} else {
			if(regist)
				location.href = "<?php echo $alice['individual_path'];?>/alba_resume_regist.php";
			else
				location.href = "<?php echo $alice['individual_path'];?>/";
		}
	} else {
		alert("<?php echo $user_control->_errors('0015');?>");
		if(regist)
			location.href = "<?php echo $alice['member_path'] . '/login.php?type=individual&url=../../'.$alice['individual_path'];?>/alba_resume_regist.php";
		else
			location.href = "<?php echo $alice['member_path'] . '/login.php?type=individual&url='.$urlencode;?>";

	}
}
var company_service = function( regist ){
	if(is_member){
		if(mb_type=='individual'){
			alert("<?php echo $user_control->_errors('0031');?>");
			return;
		} else {
			if(regist)
				location.href = "<?php echo $alice['company_path'];?>/alba_regist.php";
			else 
				location.href = "<?php echo $alice['company_path'];?>/";
		}
	} else {
		alert("<?php echo $user_control->_errors('0015');?>");
		if(regist)
			location.href = "<?php echo $alice['member_path'] . '/login.php?type=company&url=../../'.$alice['company_path'];?>/alba_regist.php";
		else
			location.href = "<?php echo $alice['member_path'] . '/login.php?type=company&url='.$urlencode;?>";
	}
}
</script>
<script type="text/javascript" src="<?php echo $alice['main_path'];?>/skins/05/top.skin.js"></script>

<header id="firstheader" class="clearfix">

	<!-- 우측날개 -->
	<div style="display:;z-index:9999;" class="RightWing" >
		<div class="rightWrap">
			<ul class="rightMenu">
				<?php if($mb_type=='individual'){ ?>
				<li><a class="star" href="<?php echo $alice['individual_path'];?>/alba_scrap.php"> 스크랩 채용정보</a></li>
				<!-- <li><a href="">오늘 본 채용정보</a></li> -->
				<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php">이력서 등록</a></li>
				<?php } ?>
				<?php if($mb_type=='company'){ ?>
				<li><a class="star" href="<?php echo $alice['company_path'];?>/alba_scrap.php"> 스크랩 인재정보</a></li>
				<li><a href="<?php echo $alice['company_path'];?>/alba_customized.php">맞춤 인재정보</a></li>
				<li><a href="<?php echo $alice['company_path'];?>/alba_regist.php">채용공고 등록</a></li>
				<?php } ?>
			</ul>
			<ul class="rightTip">
				<li><a target="_blank" href="<?php echo $alice['service_path'];?>/cs_center.php">고객센터</a></li>
				<li><a target="_blank" href="<?php echo $alice['service_path'];?>/">서비스안내</a></li>
			</ul>
			<div class="topBtn"><a href="javascript:scroll_top();"></a></div>
			<div class="right_ad mt15">
				<?php echo ($right_wing_banner) ? stripslashes($right_wing_banner) : ""; ?>
			</div>
		</div>
	</div>
	<!-- 우측날개 // --> 

	<!-- 좌측날개 -->
	<div style="display:block;z-index:9999;" class="leftWing">
		<div class="leftWrap">
			<div>
				<?php echo ($left_wing_banner) ? stripslashes($left_wing_banner) : ""; ?>
			</div>
		</div>
	</div>
	<!-- 좌측날개 // -->   

	<?php if($atop_banner){ // 최상단 배너?>
	<div class="header_ad">
		<ul>
			<li class="ad" id="ad_banner">
				<?php echo $atop_banner;?>
			</li>
		</ul>
	</div>
	<div id="topBanner_question" style="display:none; cursor: default; z-index:999;">
		<div id='topBanner_quest_info'></div>
		<p align='center' id='topBanner_confirm_msg'></p><br/>
		<p align='center'>
			<span id='topBanner_questionAnswerYes'><input type="button" onClick="questionAnswer('yes');" value="예" /> </span>
			<input type="button" onClick="topBanner_questionAnswer('no');" value="아니오" />
		</p>
	</div> 
	<?php } ?>

	<div id="globalBar" class="clearfix">
		<div class="innerBar">
			<ul class="func">
				<li class="iconbg start pr10"><a href="javascript:addStart();">시작페이지로</a></li>
				<li class="iconbg fav"><a href="javascript:addFavorite('<?php echo $env['site_title'];?>');">즐겨찾기</a></li>
			</ul>
			<ul class="lnb">
				<?php 
					if($is_member){ // 회원인 경우 
						if($mb_type=='company'){	// 기업회원
				?>
				<li class="last more devMore"><a href="javascript:devMores('layer_2');">기업회원</a>
					<div class="layer layer_2" style="display:none;">
						<ul class="link">
							<li><strong ><a class="color" href="<?php echo $alice['company_path'];?>/">기업회원 홈</a></strong></li>
							<li><em><a href="<?php echo $alice['company_path'];?>/alba_regist.php">채용공고 등록</a></em></li>
							<li><a href="<?php echo $alice['company_path'];?>/alba_list.php">채용공고 관리</a></li>
							<li><a href="<?php echo $alice['company_path'];?>/alba_apply_list.php">지원자 관리</a></li>
							<li><a href="<?php echo $alice['company_path'];?>/alba_customized.php">맞춤 인재 정보</a></li>
							<li><a href="<?php echo $alice['member_path'];?>/update_form.php">기업정보 관리</a></li>
							<li><a href="<?php echo $alice['company_path'];?>/service.php">결제내역 관리</a></li>
						</ul>
					</div>
				</li>
				<?php } else if($mb_type=='individual') { // 개인회원 ?>
				<li class="last more devMore"><a href="javascript:devMores('layer_1');">개인회원</a>
					<div class="layer layer_1" style="display:none;">
						<ul class="link">
							<li><strong ><a class="color" href="<?php echo $alice['individual_path'];?>">개인회원 홈</a></strong></li>
							<li><em><a href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php">이력서 등록</a></em></li>
							<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_list.php">이력서 관리</a></li>
							<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php">입사지원 관리</a></li>
							<li><a href="<?php echo $alice['individual_path'];?>/alba_customized.php">맞춤 채용 정보</a></li>
							<li><a href="<?php echo $alice['member_path'];?>/update_form.php">회원정보 관리</a></li>
						</ul>
					</div>
				</li>
				<?php } // mb type if end. ?>
				<?php if($env['memo_use']){ ?>
				<li><img class="pt5" style="border: 0px currentColor; border-image: none; cursor: pointer;" onclick="win_open('/send/memo_from.php','send_window',721,500);" src="/images/icon/sand_tlt.png"> <font class="b" color="3b94fc"><?php echo number_format($viewed_memo['total_count']);?></font></li>
				<?php } ?>
				<li class="last btnbox logout"><a href="javascript:member_logout();">로그아웃</a></li>
				<?php } else { // 회원이 아닌 경우 ?>
				<li class="last btnbox login"><a href="<?php echo $alice['member_path'];?>/login.php?url=<?php echo $urlencode;?>">로그인</a></li>
				<li class="last btnbox member"><a href="<?php echo $alice['member_path'];?>/register.php">회원가입</a></li>
				<?php } // is member if end. ?>
				<li class="Bgend"><a href="<?php echo $alice['service_path'];?>/cs_center.php">고객센터</a></li>
				<li><a href="<?php echo $alice['service_path'];?>/">서비스안내</a></li>
			</ul>
		</div>
	</div>

	<!--   로고,검색영역   -->    
	<div id="globalSearch" class="clearfix" style="display:block;">
		<h1 class="logo"><a href="/"><?php echo $design_control->view_logo($logo['top']);?></a></h1>
		<div class="search_wrap clearfix">
			<div class="search bg_color4" style="width:290px; height:36px; background:url(../images/basic/bg_search_1.png) no-repeat 0 0">
			<form name="SearchFrm" method="GET" id="SearchFrm" action="<?php echo $alice['main_path'];?>/search.php">
			<input type="hidden" name="mode" value="search"/>
				<fieldset>
				<legend>통합검색</legend>
				<h3 class="blind">통합검색</h3>
				<dl>
					<dt class="blind"><label for="stext">검색어 입력</label></dt>	
					<dd ><input class="mr5" type="text" maxlength="50" name="search_keyword" id="stext" style="background:none repeat scroll 0% 0% transparent;" value="<?php echo urldecode($search_keyword);?>"></dd>
					<dd><a href="javascript:serchFrm_submit();" class="btn" title="검색"></a></dd>
				</dl>
				</fieldset>
			</form>
			</div>
			<div class="topKey">
				<h4 class="blind">인기검색어 :</h4>
				<ul class="tc">
				<?php $i = 0; foreach($popular_search as $_search){ ?>
					<li <?php if($i==0){ ?>class="last"<?php } ?>><a href="<?php echo $alice['main_path'];?>/search.php?mode=search&search_keyword=<?php echo urlencode($_search['wr_content']);?>"><?php echo $_search['wr_content'];?></a></li>
				<?php $i++; if($i > 4) break; } ?>
				</ul>
			</div>
		</div>
	</div>

	<!--   메인메뉴영역   --> 
	<div class="positionR clearfix" style="width:960px; margin:0 auto; z-index:4001; ">
		<ul class="mr_nav tc positionA clearfix" style="bottom:-38px; right:0;">
			<li class="first"><a href="javascript:company_service(1);"><img src="../images/main/btn_nav_10.png" width="94" height="33" alt="채용공고등록"></a></li>
			<li><a href="javascript:individual_service(1);"><img src="../images/main/btn_nav_11.png" width="94" height="33" alt="이력서등록"></a></li>
		</ul>
	</div>
	<div id="main_nav" class="positionR" style="display:block; z-index:4000;">
		<div class="mainnavWrap clearfix" style="z-index:4000;">
			<ul class="ml_nav fl tl">

<!--   채용정보버튼 레이어box   --> 
			<div class="layGi positionA menu_layer clearfix" style="display:none; top:38px; left:0;*left:-1px;  z-index:5000;" >
				<h3 class="positionA" style="top:-38px; left:-2px; *left:-2px; width:90px; height:36px; line-height:33px; ">
				<a href="<?php echo $alice['alba_path'];?>/"><img class="pl15" src="../images/main/btn_nav_01.png" width="59" height="17" alt="채용정보"></a>
			
				</h3>
					<div class="layWrap clearfix">	
						<div class="giNav1">
							<h4><a href="<?php echo $alice['alba_path'];?>/">채용정보 홈 바로가기</a></h4>
							<h4>일반채용정보</h4>   
							<ul>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list.php">전체 채용정보</a></li>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_today.php">오늘의 채용정보</a></li>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_busy.php">급구 채용정보</a></li>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_search.php">상세검색</a></li>
							</ul>
						</div>
						<div class="giNav2">
							<h4>지역별 채용정보</h4>
							<ul>										
								<li>
									<a href="<?php echo $alice['alba_path'];?>/alba_list_area.php">지역별 채용정보</a>
									<ul class="Area clearfix">
									<?php 
										foreach($category_area as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									?>
									<li><a href="<?php echo $alice['alba_path'];?>/alba_list_area.php?area=<?php echo $val['code'];?>" class=""><?php echo $name;?></a></li>
									<?php } ?>
									<!-- <li><a href="<?php echo $alice['alba_path'];?>/alba_list_area.php" class="">전국</a></li> -->
									</ul>
								</li>										
								<li class="mt10"><a href="<?php echo $alice['alba_path'];?>/alba_list_subway.php">역세권 채용정보</a></li>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_college.php">대학가 채용정보</a></li>
							</ul>
						</div>
						<div class="giNav3">
							<h4>업직종별 채용정보</h4>
							<ul>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_type.php">업직종별 채용정보</a></li>
							</ul>
							<h4 class="mt20">기간별 채용정보</h4>
							<ul>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_term.php">근무기간·요일·시간별</a></li>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_term.php?type=short">단기 채용정보</a></li>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_term.php?type=long">장기 채용정보</a></li>
							</ul>
						</div>
						<div class="giNav3 brend">
							<h4>급여별 채용정보</h4>
							<ul>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_pay.php">급여별 채용정보</a></li>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_pay.php?type=day">지원별 채용정보</a></li> 
							</ul>
							<h4 class="mt20">대상별 채용정보</h4>
							<ul class="target clearfix pt5 pl5 pr5 pb5">
								<?php 
									foreach($job_targets as $key => $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								?>
								<li><a href="<?php echo $alice['alba_path'];?>/alba_list_target.php?type=<?php echo $val['code'];?>"><?php echo $name;?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<em class="positionA" style="bottom:0; right:5px;"><a href="javascript:layer_close();"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close2.gif" class="pb5"></a></em>
				</div> 
				<!--   채용정보버튼 레이어box // -->
				<!--   인재정보버튼 레이어box   --> 
				<div class="layGg positionA menu_layer" style="display:none; top:38px; left:0; z-index:5000;" >
				<h3 class="positionA" style="top:-38px; left:90px; *left:83px; width:90px; height:36px; line-height:33px; ">
					<a href="<?php echo $alice['resume_path'];?>/"><img class="pl15" src="../images/main/btn_nav_02.png" width="59" height="17" alt="인재정보"></a>
					</h3>
					<div class="layWrap clearfix">	
						<div class="ggNav1">
							<h4><a href="<?php echo $alice['resume_path'];?>/">인재정보 홈 바로가기</a></h4>
							<h4>일반인재정보</h4>   
							<ul>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_list.php">전체 인재정보</a></li>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_type.php">업직종별 인재정보</a></li>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_busy.php">급구 인재정보</a></li>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_search.php">상세검색</a></li>
							</ul>
						</div>
						<div class="ggNav2">
							<h4>지역별 인재정보</h4>
							<ul class="Area clearfix">
								<?php 
									foreach($category_area as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								?>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_area.php?area=<?php echo $val['code'];?>" class=""><?php echo $name;?></a></li>
								<?php } ?>
							</ul>
							<h4 class="mt20">기간별 인재정보</h4>
							<ul>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_term.php">근무기간·요일·시간별</a></li>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_term.php?type=short">단기 인재정보</a></li>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_term.php?type=long">장기 인재정보</a></li>    
							</ul>
						</div>
						<div class="ggNav3">
							<h4>능력별 인재정보</h4>
							<ul>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_specialty.php">특기별 인재정보</a></li>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_license.php">자격증별 인재정보</a></li>
								<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_language.php">외국어별 인재정보</a></li> 
							</ul>
						</div>
						<div class="ggNav3 brend">
							<h4>전문 인재정보</h4>
							<ul class="">
								<?php 
								if($professional_indi[0]!=''){
									for($i=0;$i<$professional_indi_cnt;$i++){ 
									$professional_vals = $utility->remove_quoted( $category_control->get_categoryCodeName($professional_indi[$i]) );
									$classes = (($professional_indi_cnt-1) == $i) ? "class='last'" : "";
								?>
								<li <?php echo $classes;?>><a href="<?php echo $alice['resume_path'];?>/alba_resume_type.php?type=<?php echo $professional_indi[$i];?>"><?php echo $professional_vals;?></a></li>
								<?php 
									} // for end.
								}	// if end.
								?>
							</ul>
						</div>
					</div>
					<em class="positionA" style="bottom:0; right:5px;"><a href="javascript:layer_close();"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close2.gif" class="pb5"></a></em>
				</div> 
				<!-- // 인재정보버튼 레이어 box  -->
				<!--   개인서비스버튼 레이어box   --> 
				<div class="layPe positionA menu_layer" style="display:none; top:38px; left:0; z-index:5000;" >
				<h3 class="positionA" style="top:-38px; left:<?php echo ($is_adult)?'247':'178';?>px;*left:<?php echo ($is_adult)?'240':'170';?>px; width:109px; height:36px; line-height:33px; " id="layPe_position">
					<a href="javascript:individual_service();"><img  class="pl15" src="../images/main/btn_nav_04.png" width="74" height="17" alt="개인서비스"></a>
					</h3>

					<div class="layWrap clearfix">	
						<div class="peNav1">
							<h4><a href="javascript:individual_service();">개인서비스 홈 바로가기</a></h4>
							<h4>이력서관리</h4>   
							<ul>
								<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php">새 이력서 작성</a></li>
								<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_list.php">이력서 관리·수정</a></li>
								<li class="last"><a href="<?php echo $alice['individual_path'];?>/photo.php">내 사진 관리</a></li>
							</ul>								
						</div>
						<div class="peNav2">
							<h4>입사지원관리</h4>
							<ul>
								<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php">온라인 지원 현황</a></li>
								<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php?type=email">이메일 지원 현황</a></li>
								<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_open.php">내 이력서 열람기업</a></li>
								<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_denied.php">이력서 열람제한 설정</a></li>
								<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_interview.php">면접제의·입사요청 기업</a></li>
								<li class="last"><a href="<?php echo $alice['individual_path'];?>/alba_resume_applycert.php">취업활동 증명서</a></li>
							</ul>                                    
						</div>
						<div class="peNav3">
							<h4>맞춤서비스관리</h4>
							<ul>
								<li><a href="<?php echo $alice['individual_path'];?>/alba_scrap.php">스크랩한 채용정보</a></li>
								<li><a href="<?php echo $alice['individual_path'];?>/favorite_company.php">관심기업 정보</a></li>
								<li class="last"><a href="<?php echo $alice['individual_path'];?>/alba_customized.php">맞춤 채용정보</a></li>
							</ul>                                    
						</div>
						<div class="peNav3 brend">
							<h4>개인정보관리</h4>
							<ul>
								<?php if($mb_type=='individual'){ // 개인 회원일때만 ?>
								<li><a href="<?php echo $alice['member_path'];?>/update_form.php">개인정보 수정</a></li>
								<li><a href="<?php echo $alice['member_path'];?>/password_form.php">비밀번호 변경</a></li>
								<?php } ?>
								<li class="last"><a href="<?php echo $alice['individual_path'];?>/service.php">유료 이용내역</a></li>
							</ul>
						</div>
					</div>
					<em class="positionA" style="bottom:0; right:5px;"><a href="javascript:layer_close();"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close2.gif" class="pb5"></a></em>
				</div> 
				<!--  // 개인서비스버튼 레이어box  -->   
				<!--   기업서비스버튼 레이어box   --> 
				<div class="layCo positionA menu_layer" style="display:none; top:38px; left:0; z-index:5000;" >
				<h3 class="positionA" style="top:-38px; left:<?php echo ($is_adult)?'356':'287';?>px;*left:<?php echo ($is_adult)?'344':'270';?>px; width:110px; height:36px; line-height:33px; ">
					<a href="javascript:company_service();" class="info_btn"><img class="pl15" src="../images/main/btn_nav_05.png" width="74" height="17" alt="기업서비스"></a>
					</h3>

					<div class="layWrap clearfix">	
						<div class="coNav1">
							<h4><a href="javascript:company_service();">기업서비스 홈 바로가기</a></h4>
							<h4>채용공고관리</h4>   
							<ul>
								<li><a href="<?php echo $alice['company_path'];?>/alba_regist.php">채용공고 등록</a></li>
								<li><a href="<?php echo $alice['company_path'];?>/alba_list.php">진행중인 공고</a></li>
								<li><a href="<?php echo $alice['company_path'];?>/alba_list.php?type=finish">마감된 공고</a></li>
								<li><a href="<?php echo $alice['company_path'];?>/alba_apply_list.php">지원자 관리</a></li> 
								<li class="last"><a href="<?php echo $alice['company_path'];?>/manager_info.php">채용담당자 관리</a></li>
							</ul>
						</div>
						<div class="coNav2">
							<h4>서비스관리</h4>
							<ul>
								<li><a href="<?php echo $alice['company_path'];?>/alba_scrap.php">스크랩한 인재정보</a></li>
								<li><a href="<?php echo $alice['company_path'];?>/alba_resume_info.php">열람한 인재정보</a></li>
								<li class="last"><a href="<?php echo $alice['company_path'];?>/alba_customized.php">맞춤 인재정보</a></li>         
							</ul>
						</div>
						<div class="coNav3">
							<h4>기업정보관리</h4>
							<ul>
								<?php if($mb_type=='company'){ // 기업 회원일때만 ?>
								<li><a href="<?php echo $alice['member_path'];?>/update_form.php">기업정보 수정</a></li>
								<li><a href="<?php echo $alice['member_path'];?>/password_form.php">비밀번호 변경</a></li>
								<?php /* ?><!-- <li><a href="<?php echo $alice['company_path'];?>/photo.php">기업로고·사진관리</a></li> --><?php */ ?>
								<?php } ?>
								<li><a href="<?php echo $alice['company_path'];?>/service.php">유료 이용내역</a></li>
								<li class="last"><a href="<?php echo $alice['member_path'];?>/tax.php">세금계산서 발행신청</a></li>
							</ul>
						</div>
						<div class="coNav3 brend">
							<ul>
								<li><a href="<?php echo $alice['company_path'];?>/alba_service.php">유료서비스 신청</a></li>
							</ul>
						</div>
					</div>
					<em class="positionA" style="bottom:0; right:5px;"><a href="javascript:layer_close();"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close2.gif" class="pb5"></a></em>
				</div> 
				<!--  // 기업서비스버튼 레이어box -->			

				<li  id="layGi" class="first bgLayer" style="position:relative;">
					<a href="<?php echo $alice['alba_path'];?>/"><img src="../images/main/btn_nav_01.png" width="59" height="17" alt="채용정보"></a>
				</li>
				<li class="bgLayer" id="layGg">
					<a href="<?php echo $alice['resume_path'];?>/"><img src="../images/main/btn_nav_02.png" width="59" height="17" alt="인재정보"></a>
				</li>
				<?php if($is_adult){	// 성인직종을 사용한다면 ?>
				<li><a href="<?php echo $alice['alba_path'];?>/alba_list_adult.php?type=<?php echo $adult_job_types[0]['code'];?>"><img src="../images/main/btn_nav_03.png" width="47" height="17" alt="19채용"></a></li>
				<?php } ?>
				<li class="bgLayer" id="layPe">
					<a href="javascript:individual_service();"><img src="../images/main/btn_nav_04.png" width="74" height="17" alt="개인서비스"></a>
				</li>
				<li class="bgLayer" id="layCo">
					<a href="javascript:company_service();" class="info_btn"><img src="../images/main/btn_nav_05.png" width="74" height="17" alt="기업서비스"></a>
				</li>
				<li><a href="<?php echo $board_href;?>"><img src="../images/main/btn_nav_06.png" width="59" height="17" alt="커뮤니티"></a></li>
				<?php if($design['map_use']){?>
				<li><a href="<?php echo $alice['map_path'];?>/"><img src="../images/main/btn_nav_07.png" width="59" height="17" alt="지도검색"></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</header>
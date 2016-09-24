<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<style type="text/css">
/* === logo === */
#globalLogo {width:960px; margin:30px auto 8px;}
#globalLogo .logo{margin:auto 0;}

/* === search === */
#globalSearch{position:relative; width:718px;}
.search_wrap{margin-right:154px; margin-top:12px;}
.search_wrap input#stext{float:left; width:270px; height:23px; border:2px solid #ddd; font-size:12px; text-indent:5px;}
.search_wrap .search dd a.btn{display:inline-block; width:54px; height:29px; line-height:29px; text-align:center; color:#fff; background: none repeat scroll 0 0 #ddd; font-weight:bold;}
/* === search word === */
.topKey{/*width:270px;*/ height:20px; margin-top:5px; margin-left:10px; padding-left:30px; background:url("../images/icon/icon_keyword_1.gif") no-repeat 0 50%;}
.topKey li{float:left;padding:3px 5px; font-size:11px; background:url("../images/main/bg_line_1.gif") no-repeat scroll 0 45%;}
.topKey li.last{background:none;}
 

#main_nav{background:none; filter:none;}
#main_nav .mainnavWrap{position:relative; width:960px; margin:0 auto;/* overflow:hidden;*/}
#main_nav .ml_nav{ width:650px; margin-top:-8px; height:45px;line-height:45px; border:1px solid #ddd;}

#main_nav .ml_nav li{display:inline-block;zoom:1;*display:inline/*IE7 HACK*/; padding:0 10px; z-index:50;}
#main_nav .ml_nav li{background:url("../images/main/bg_line_1.png") no-repeat scroll 0 50%;}
#main_nav .mr_nav{width:152px; height:37px; line-height:35px;  border:1px solid #ddd;}

#main_nav .mr_nav li{display:inline; padding:0 12px; background:url("../images/main/bg_line_1.png") no-repeat scroll 0 50%; }
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
<script type="text/javascript" src="<?php echo $alice['main_path'];?>/skins/04/top.skin.js"></script>

<header id="firstheader" class="clearfix">

	<!-- 우측날개 -->
	<div style="display:;" class="RightWing" >
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
	<div style="display:block;" class="leftWing">
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
				<?php }	 // is member if end. ?>
				<li class="Bgend"><a href="<?php echo $alice['service_path'];?>/cs_center.php">고객센터</a></li>
				<li><a href="<?php echo $alice['service_path'];?>/">서비스안내</a></li>
			</ul>
		</div>
	</div>
	<div id="globalLogo" class="clearfix" style="display:block;">
		<h1 class="logo fl"><a href="/"><?php echo $design_control->view_logo($logo['top']);?></a></h1>
		<!--  검색영역   -->    
		<div class="search_wrap fr clearfix">
			<div class="topKey fl">
				<h4 class="blind">인기검색어</h4>
				<ul>
				<?php $i = 0; foreach($popular_search as $_search){ ?>
					<li <?php if($i==0){ ?>class="last"<?php } ?>><a href="<?php echo $alice['main_path'];?>/search.php?mode=search&search_keyword=<?php echo urlencode($_search['wr_content']);?>"><?php echo $_search['wr_content'];?></a></li>
				<?php $i++; if($i > 4) break; } ?>
				</ul>
			</div>		
			<div class="search fl">
			<form name="SearchFrm" method="GET" id="SearchFrm" action="<?php echo $alice['main_path'];?>/search.php">
			<input type="hidden" name="mode" value="search"/>
				<fieldset>
				<legend>통합검색</legend>
				<h3 class="blind">통합검색</h3>
				<dl>
					<dt class="blind"><label for="stext">검색어 입력</label></dt>	
					<dd class="fl" ><input class="" type="text" maxlength="50" name="search_keyword" id="stext" style="background:none repeat scroll 0% 0% transparent;" value="<?php echo urldecode($search_keyword);?>"></dd>
					<dd class="fl"><a href="javascript:serchFrm_submit();" class="btn bg_color4" title="검색">검색</a></dd>
				</dl>
				</fieldset>
			</form>
			</div>
		</div>
	</div>

	<!--   메인메뉴영역   --> 
	<div id="main_nav" class="clearfix" style="display:block;">
		<div class="mainnavWrap">
			<ul class="mr_nav fl tc">
				<li class="first"><a href="javascript:company_service(1);"><img src="../images/main/btn_nav_12.png" width="94" height="17" alt="채용공고등록"></a></li>
			</ul>
			<ul class="ml_nav fl tc">
				<li class="first"><a href="<?php echo $alice['alba_path'];?>/"><img src="../images/main/btn_nav_01.png" width="59" height="17" alt="채용정보"></a></li>  
				<li class="bgimg"><a href="<?php echo $alice['resume_path'];?>/"><img src="../images/main/btn_nav_02.png" width="59" height="17" alt="인재정보"></a></li>
				<?php if($is_adult){	// 성인직종을 사용한다면 ?>
				<li class="bgimg"><a href="<?php echo $alice['alba_path'];?>/alba_list_adult.php?type=<?php echo $adult_job_types[0]['code'];?>"><img src="../images/main/btn_nav_03.png" width="47" height="17" alt="19채용"></a></li>
				<?php } ?>
				<li><a href="javascript:individual_service();"><img src="../images/main/btn_nav_04.png" width="74" height="17" alt="개인서비스"></a></li>
				<li><a href="javascript:company_service();" class="info_btn"><img src="../images/main/btn_nav_05.png" width="74" height="17" alt="기업서비스"></a></li>
				<li><a href="<?php echo $board_href;?>"><img src="../images/main/btn_nav_06.png" width="59" height="17" alt="커뮤니티"></a></li>
				<?php if($design['map_use']){?>
				<li><a href="<?php echo $alice['map_path'];?>"><img src="../images/main/btn_nav_07.png" width="59" height="17" alt="지도검색"></a></li>
				<?php } ?>
			</ul>
			<ul class="mr_nav fl tc">
				<li class="first"><a href="javascript:individual_service(1);"><img src="../images/main/btn_nav_13.png" width="94" height="17" alt="이력서등록"></a></li>
			</ul>
		</div>
	</div>  
</header>
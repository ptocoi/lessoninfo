<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<style type="text/css">
/* === logo === */
#globalSearch .logo{position:absolute; bottom:-2px; left:0 !important;}

/* === search === */
#globalSearch{position:relative; width:960px; margin:30px auto 8px; }
.search_wrap{width:350px; margin:0 auto;}
.search_wrap input#stext{float:left; width:270px; height:23px; border:4px solid ; font-size:12px; text-indent:5px;}
.search_wrap .search dd a.btn{display:inline-block;width:54px; height:33px; line-height:33px; text-align:center; color:#fff;  font-weight:bold;}
/* === search word === */
.topKey{padding-left:40px; background:url("../images/icon/icon_keyword_1.gif") no-repeat 9px 3px;width:300px; height:20px; margin:2px auto 0; /*말줄임*/ white-space:nowrap; overflow:hidden; }
.topKey li{float:left;padding:3px 5px; font-size:11px; background:url("../images/main/bg_line_1.gif") no-repeat scroll 0 45%;}
.topKey li.last{background:none;}

/* === 메인 네비게이션 칼라설정 === */

/*#main_nav{position:relative; width:960px; margin:0 auto;}*/
#main_nav{background:none; filter:none;}
#main_nav .mainnavWrap{position:relative; width:960px; margin:0 auto;/* overflow:hidden;*/}
#main_nav .mainnavWrap > ul.ml_nav{width:724px; height:37px; border:1px solid #ddd;}


#main_nav .ml_nav > li{display:inline-block;zoom:1;*display:inline/*IE7 HACK*/; padding:0 9px; z-index:50;background:url("../images/main/bg_line_1.png") no-repeat scroll 0 50%;}
#main_nav .ml_nav > li > a{line-height:35px;}
#main_nav .ml_nav > li.bgLayer > a{background:url("../images/icon/icon_arrow_bottom1.png") no-repeat scroll 0 50%; padding-left:8px;}
#main_nav .ml_nav > li.bgLayer.on > a{background:url("../images/icon/icon_arrow_bottom2.png") no-repeat scroll 0 50%; padding-left:8px;}

#main_nav .mainnavWrap > .mr_nav{width:232px; height:37px; border:1px solid #ddd;}

#main_nav .mr_nav > li{display:inline-block;zoom:1;*display:inline/*IE7 HACK*/;line-height:35px;padding:0 12px; background:url("../images/main/bg_line_1.png") no-repeat scroll 0 50%; }
#main_nav .mr_nav > li > a {}
#main_nav .s_nav{position:absolute; right:7px; top:50%; margin-top:-10px; text-align:center; } 
#main_nav .s_nav li{float:left; display:inline; padding:0 3px;line-height:21px; height:21px; border:1px solid #ddd;  box-shadow:inset 0px 0px 1px #ddd;  background-color:#ddd; }
#main_nav .s_nav li img{vertical-align:middle;}
#main_nav img{vertical-align:middle;}
#main_nav li.first {background:none;}

/* ====================================================================== */
/*                             right wing, left wing                      */
/* ====================================================================== */
.RightWing {position:fixed; left:50%; top:175px; z-index:2; margin-left:488px; width:120px;}

.RightWing .rightMenu li {height:23px; line-height:23px; border:1px solid #33374a; margin-top:-1px; background:url(../images/icon/icon_arrow_7.gif) no-repeat 95% 50% #404660;}
.RightWing .rightMenu li a {color:#fff; letter-spacing:-0.1em; padding-left:7px;}
.RightWing .rightMenu li a.star{background:url(../images/icon/icon_star2.png) no-repeat 3px 50%; padding-left:19px;}
.RightWing .rightTip{ border:1px solid #dfdfdf; margin-top:-1px; padding:10px 0; background-color:#fff;}
.RightWing .rightTip li{line-height:20px;}
.RightWing .rightTip li a{ background:url(../images/main/blank3.gif) no-repeat 10px 50%; padding-left:15px; color:#adadad;}
.topBtn a{display:block; width:118px; height:20px; border:1px solid #dfdfdf; margin-top:-1px; background:url(../images/icon/icon_top1.gif) no-repeat 50% 50% #fff;}

.leftWing {position:fixed; left:50%; top:170px; z-index:2; margin-left:-608px; width:120px;}

</style>
<script>
var individual_service = function( regist ){
	if(is_member){
		if(mb_type!='individual'){
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
var student_service = function( regist ){
	if(is_member){
		if(mb_type!='student'){
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

var company_service = function( regist ){
	if(is_member){
		if(mb_type!='company'){
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
<script type="text/javascript" src="<?php echo $alice['main_path'];?>/skins/07/top.skin.js"></script>

<header id="firstheader" class="clearfix" style=" z-index:1000;">

	<!-- 우측날개 -->
	<div style="display:;" class="RightWing" >
		<div class="rightWrap">
			<ul class="rightMenu">
				<?php if($mb_type=='individual'){ ?>
				<li><a class="star" href="<?php echo $alice['individual_path'];?>/alba_scrap.php"> 스크랩 채용정보</a></li>
				<!-- <li><a href="">오늘 본 채용정보</a></li> -->
				<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php">이력서 등록</a></li>
				<?php } ?>
				<?php if($mb_type=='company'||$mb_type=='student'){ ?>
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
			<li class="last more devMore"><a href="javascript:devMores('layer_1');">선생님</a>
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
			<?php } else if($mb_type=='student') { // 개인회원 ?>
			<li class="last more devMore"><a href="javascript:devMores('layer_3');">학생(학부모)회원</a>
				<div class="layer layer_3" style="display:none;">
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


<?php /* 로고/검색 영역 */ ?>
<div id="globalSearch" class="clearfix" style="display:block;  z-index:100;">
	<h1 class="logo"><a href="/"><?php echo $design_control->view_logo($logo['top']);?></a></h1>
	<form name="SearchFrm" method="GET" id="SearchFrm" action="<?php echo $alice['main_path'];?>/search.php">
	<input type="hidden" name="mode" value="search"/>
	<div class="search_wrap">
		<div class="search">
			<fieldset>
			<legend>통합검색</legend>
			<h3 class="blind">통합검색</h3>
			<dl>
				<dt class="blind"><label >검색어 입력</label></dt>	
				<dd >
					<input class="mr5" type="text" maxlength="50" name="search_keyword" id="stext" style="background:#fff;" value="<?php echo urldecode($search_keyword);?>">
				</dd>
				<dd><a href="javascript:serchFrm_submit();" class="btn bg_color6" title="검색">검색</a></dd>
			</dl>
			</fieldset>
		</div>
		<div class="topKey">
			<h4 class="blind">인기검색어 :</h4>
			<ul>
				<?php $i = 0; foreach($popular_search as $_search){ ?>
				<li <?php if($i==0){ ?>class="last"<?php } ?>><a href="<?php echo $alice['main_path'];?>/search.php?mode=search&search_keyword=<?php echo urlencode($_search['wr_content']);?>"><?php echo $_search['wr_content'];?></a></li>
				<?php $i++; } ?>
			</ul>
		</div>
	</div>
	</form>
</div>
<?php /* //로고/검색 영역 */ ?>

<?php /* 메인메뉴 영역 */ ?>
<div id="main_nav" class="clearfix" style="display:block; z-index:4000;">
	<div class="mainnavWrap" style="z-index:4000;">
		<ul class="ml_nav fl tl">
			<li class="first"><a href="/resume/">음악선생님 찾기</a></li>
			<li><a href="/board/board.php?board_code=20160903185624_3553&code=20160903190810_8401&bo_table=20160903191027_3936">학원매매</a></li>
			<li><a href="/board/board.php?board_code=20160903185624_3553&code=20160903190817_3858&bo_table=20160903191126_9334">악기매매</a></li>
			<li><a href="/board/board.php?board_code=20160903185624_3553&code=20160903192455_2245&bo_table=20160903192526_9193">연습실</a></li>
		</ul>
		<ul class="mr_nav fr tc">
			<li class="first"><a href="javascript:individual_service(1);">이력서 등록</a></li>
			<li><a href="javascript:company_service(1);">채용공고 등록</a></li>
		</ul>
	</div>
</div>  
<?php /* //메인메뉴 영역 */ ?>
</header>
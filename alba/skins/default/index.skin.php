<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
</script>

<style type="text/css">
/* ========================  기본컬러설정   ========================= */
#list li .icons div img{background-color:#c9c9c9;}

#photo li {border-color:#7dc2f6;}
#photo li dd.icons > div > a > img{background-color:#7dc2f6;}
#photo .name_wrap{background-color:#F5FAFF;}

#platinum dd.icons > div > a > img{background-color:#<?php echo $design['sub_platinum_border_color'];?>;}
#platinum  > ul > li{border-color:#<?php echo $design['sub_platinum_border_color'];?>;}
#platinum .text1{background-color:#<?php echo $design['sub_platinum_background_color'];?>;}
#platinum .text2{background-color:#<?php echo $design['sub_platinum_background_color'];?>;}
#platinum.number5  > ul > li .logo_tit{background-color:#<?php echo $design['sub_platinum_background_color'];?>;}

#box dd.icons > div > a > img{background-color:#<?php echo $design['sub_banner_border_color'];?>;}
#box  > ul > li{border-color:#<?php echo $design['sub_banner_border_color'];?>;}
#box .text1{background-color:#<?php echo $design['sub_banner_background_color'];?>;}
#box .text2{background-color:#<?php echo $design['sub_banner_background_color'];?>;}
/* ========================  기본컬러설정 // ========================= */

/* ========================  골드컬러설정 ========================= */
.border1 > ul > li.gold {z-index:1000;}
.border2 > ul > li.gold {z-index:1000;}

#list > ul > li.gold {background:#<?php echo $design['sub_list_background_gold_color'];?>;/*border-color:#c3b39e;*/}
#list > ul > li.gold .icons div img{background-color:#fdb301;}

#photo  > ul > li.gold {border-color:#ff8f00; /*border:1px solid #afc0ff;*/}
#photo  > ul > li.gold .icons div img{background-color:#ff8f00;}
#photo  > ul > li.gold .name_wrap{background-color:#fdb301; color:#fff;}

#platinum  > ul > li.gold {border-color:#<?php echo $design['sub_platinum_border_gold_color'];?>;}
#platinum  > ul > li.gold .icons div img{background-color:#<?php echo $design['sub_platinum_border_gold_color'];?>;}
#platinum  > ul > li.gold .text1 a{color:#fff;}
#platinum  > ul > li.gold .text1,#platinum li.gold .text2{background-color:#<?php echo $design['sub_platinum_background_gold_color'];?>; color:#fff;}
#platinum  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['sub_platinum_background_gold_color'];?>;}
#platinum.number5  > ul > li.gold .logo_tit{background-color:#<?php echo $design['sub_platinum_background_gold_color'];?>;color:#fff;}

#box  > ul > li.gold {border-color:#<?php echo $design['sub_banner_border_gold_color'];?>;}
#box  > ul > li.gold .icons div img{background-color:#<?php echo $design['sub_banner_border_gold_color'];?>;}
#box  > ul > li.gold .text1 a{color:#fff;}
#box  > ul > li.gold .text1,#box li.gold .text2{background-color:#<?php echo $design['sub_banner_background_gold_color'];?>; color:#fff;}
#box  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['sub_banner_background_gold_color'];?>;}
/* ========================  골드컬러설정 // ========================= */
</style>  

<script>
var cycle_direction = "<?php echo $alba_option_logo_effects[1];?>";
</script>
<script type="text/javascript" src="<?php echo $alice['alba_path'];?>/skins/default/index.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
<!--  navigation  -->
      <div class="NowLocation mt35 clearfix">
        <p> <a href="/">HOME</a> > <strong>채용정보</strong> </p>
      </div>
<!--  navigation end  --> 			
<!--  채용정보 메인 검색영역 -->
			<div class="listWrap mt20">
				<h2 class="skip">정규직 채용정보 검색 box</h2>
				<div class="jobContentWrap clearfix positionR mt10 clearfix">
				     <div class="searchTop clearfix">
						 <ul class="titleBox">
						 <li class="tit fl">
							<h2><img style="*padding-top:10px;" class="pl10 vm" src="../images/tit/job_tit_15.gif" alt="채용정보메인"></h2>
						 </li>
						 <li class="btn fr">
								<span><a href="<?php echo $alice['alba_path'];?>/alba_list_type.php"><img class="vm" src="../images/tit/job_tit_03_1.gif" alt="업직종별"></a></span>
								<span class="pl10 pr10"><img class="vm" src="../images/main/bg_line_1.png" alt=""></span>
								<span><a href="<?php echo $alice['alba_path'];?>/alba_list_area.php"><img  class="vm" src="../images/tit/job_tit_03_2.gif" alt="지역별"></a></span>
						   </li>
						  </ul>
					</div>

<!--  채용정보 메인 전체 정규직 카운트  
					<div class="searchTop clearfix">
						<dl class="All pt20 pl20">
							<dt>
								<img src="../images/tit/job_tit_01.gif" width="62" height="17" alt="전체 정규직">
								<em class="pl5">
									<a href="<?php echo $alice['alba_path'];?>/alba_list.php"><img src="../images/icon/icon_go1.gif" width="32" height="14" alt="go"></a>
								</em>
							</dt>
							<dd class="AllNumber"><?php echo stripslashes($all_count);?></dd>
						</dl>
						<dl class="Today pt20 ">
							<dt>
								<img src="../images/tit/job_tit_02.gif" width="75" height="17" alt="오늘의 정규직">
								<em class="pl5">
									<a href="<?php echo $alice['alba_path'];?>/alba_list_today.php"><img src="../images/icon/icon_go1.gif" width="32" height="14" alt="go"></a>
								</em>
							</dt>
							<dd class="TodayNumber"><?php echo $today_count;?></dd>
						</dl>
						<dl class="Area">
							<dt class="pl10 pt10"><img src="../images/tit/job_tit_03.gif" width="90" height="21" alt="지역별 정규직 정보"></dt>
							<dd>
								<ul class="text_color1">
								<?php 
									foreach($category_area as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								?>
									<li><a class="text_color1" href="<?php echo $alice['alba_path'];?>/alba_list_area.php?area=<?php echo $val['code'];?>"><?php echo $name;?></a></li>
								<?php } ?>
								</ul>
							</dd>
						</dl>
					</div>
-->
				<?php include_once "./views/_include/search.php";?>
				</div>
			</div>
			<!--  // 채용정보 메인 검색영역 -->

			<?php echo ($employ_platinum_banner) ? "<div class='mt15 mb10'>".$employ_platinum_banner."</div>" : ""; ?>
			<?php if($sub_platinum_use) include_once "./views/_include/platinum.php"; // 플래티넘 ?>

			<?php echo ($employ_banner_banner) ? "<div class='mt15 mb10'>".$employ_banner_banner."</div>" : ""; ?>
			<?php if($sub_banner_use) include_once "./views/_include/banner.php"; // 배너형 ?>

			<?php echo ($employ_list_banner) ? "<div class='mt15 mb10'>".$employ_list_banner."</div>" : ""; ?>
			<?php if($sub_list_use) include_once "./views/_include/list.php"; // 리스트형 ?>

			<?php echo ($employ_basic_banner) ? "<div class='mt15 mb10'>".$employ_basic_banner."</div>" : ""; ?>
	
			<div id="JobListForm" class="positionR mt30 clearfix">
				<a name="result"></a>
				<h2 class="clearfix">
					<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 일반채용정보</strong>
					<em class="pl10" style="background: url(../images/main/bg_line_2.gif) no-repeat scroll 3px 50% ;">총 <span class="b"><?php echo number_format($sub_list['total_count']);?></span> 건</em>
				</h2>
		
				<div id="list_view">
					<!--  일반보기  -->   
					<table cellspacing="0" summary="정규직 정보입니다">
					<caption class="skip">일반채용</caption>
					<colgroup><col width="90px"><col width="50px"><col width="*"><col width="110px"><col width="60px"><col width="100px"><col width="55px"><col width="60px">  </colgroup>
					<thead>
					<tr>
						<th class="local" scope="col">근무지</th>
						<th class="icons" scope="col"></th>
						<th class="title" scope="col">채용제목</th>
						<th class="company" scope="col">기업명</th>
						<th class="gender" scope="col">성별</th>
						<th class="pay" scope="col">급여</th>
						<th class="date" scope="col">등록일</th>
						<th class="finish" scope="col" width="60px">마감일</th>
					</tr>
					</thead>
					<tbody>
					<?php 
					if($sub_list['result']){
						foreach($sub_list['result'] as $key => $val){ 
						$no = $val['no'];
						$lists = $alba_user_control->get_alba_service($no,"sub_list",49);
						$wdate = strtr($lists['datetime3'],"-","/");
						if($lists['volume_result']==false) continue;
					?>
					<tr id="sub_list_<?php echo $no;?>" style="display:;">
						<td class="local"><?php echo $lists['wr_area_cut'];?></td>
						<td  class="icons">
							<div><a class="window" href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
							<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
							<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
							<?php } ?>
							<div><a class="plus" href="javascript:sub_list_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png" class="bg_orang"></a></div>
						</td>        
						<td class="title"><?php echo $lists['service_busy'];?><?php echo $lists['service_icon'];?><a href="./alba_detail.php?no=<?php echo $no;?>"><span><?php echo $lists['subject'];?> </span></a></td>
						<td class="company"><a href="./alba_detail.php?no=<?php echo $no;?>"><span><?php echo $lists['company_name'];?> </span></a></td>
						<td class="gender"><?php echo $lists['wr_gender'];?>&nbsp;</td>
						<td class="pay">
							<?php
							if($lists['wr_pay_conference']){
								echo $alba_user_control->pay_conference[$lists['wr_pay_conference']];
							} else {
							?>
								<span class="number"><?php echo $lists['wr_pay'];?>원</span> <em class="icon"><?php echo $lists['wr_pay_type'];?></em>
							<?php } ?>
						</td>
						<td class="date"><?php echo $wdate;?></td>
						<td class="finish"><?php echo $lists['volume'];?></td>
					</tr>
					<?php 
						} // foreach end.
					} else {
					?>
					<tr><td colspan="8" class="tc no_listText"><span>채용정보가 없습니다.</span></td></tr>
					<?php } // if end.?>

					</tbody>
					</table>
					<!--  // 일반보기 --> 

				<!-- view layer -->
				<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="sub_list_quickView"><div class="positionA" style="top:0;right:0;">close</div></div>
				<!-- // view layer -->
                <?php include_once $alice['include_path']."/paging.php";?>
				</div>

		</div>
	</div>
</section>
<script>
var sub_list_open = function( no ){	// 공고 상세보기
	var $sub_list = $('#sub_list_'+no);
	var position_top = $sub_list.position().top;

	$('#sub_list_quickView').hide();
	$('#sub_list_quickView').load('./views/_load/alba.php', { mode:'basic', no:no }, function(){
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});
}
var sub_list_close = function(){	// 플래티넘 레이어 닫기
	$('#sub_list_quickView').hide();
}
</script>
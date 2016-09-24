<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var send_url = "<?php echo $today_list['send_url'];?>";
</script>

<script type="text/javascript" src="<?php echo $alice['resume_path'];?>/skins/default/alba.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
<!--  navigation  -->
      <div class="NowLocation mt35 clearfix">
        <p> <a href="/">HOME</a> > <strong>인재정보</strong> </p>
      </div>
<!--  navigation end  --> 			
<!--  인재정보 메인 검색영역 -->
			<div class="listWrap mt20">
				<h2 class="skip">알바인재정보 검색 box</h2>
				<div class="resumeContentWrap positionR mt10 clearfix">
					<div class="searchTop clearfix">
						 <ul class="titleBox clearfix">
						 <li class="tit fl">
							<h2><img style="*padding-top:10px;" class="pl10 vm" src="../images/tit/resume_tit_15.gif" alt="인재정보메인"></span></h2>
						 </li>
						 <li class="btn fr">
								<span><a href="<?php echo $alice['resume_path'];?>/alba_resume_type.php"><img class="vm" src="../images/tit/job_tit_03_1.gif" alt="업직종별"></a></span>
								<span class="pl10 pr10"><img class="vm" src="../images/main/bg_line_1.png" alt=""></span>
								<span><a href="<?php echo $alice['resume_path'];?>/alba_resume_area.php"><img  class="vm" src="../images/tit/job_tit_03_2.gif" alt="지역별"></a></span>
						   </li>
						  </ul>
					</div>					
<!--  채용정보 메인 전체알바 카운트 					
					<div class="searchTop clearfix">
						<dl class="All pt20 pl20">
							<dt>
								<img src="../images/tit/resume_tit_01.gif" width="62" height="17" alt="전체인재">
								<em class="pl5">
									<a href="<?php echo $alice['resume_path'];?>/alba_resume_list.php"><img src="../images/icon/icon_go1.gif" width="32" height="14" alt="go"></a>
								</em>
							</dt>
							<dd class="AllNumber"><?php echo $all_count;?></dd>
						</dl>
						<dl class="Today pt20 ">
							<dt>
								<img src="../images/tit/resume_tit_02.gif" width="95" height="17" alt="오늘등록인재">
									<em class="pl5"><a href="<?php echo $alice['resume_path'];?>/alba_resume_today.php">
									<img src="../images/icon/icon_go1.gif" width="32" height="14" alt="go"></a>
								</em>
							</dt>
							<dd class="TodayNumber"><?php echo $today_count;?></dd>
						</dl>
						<dl class="Area">
							<dt class="pl10 pt10"><img src="../images/tit/resume_tit_03.gif" width="90" height="21" alt="지역별인재정보"></dt>
							<dd><!-- http://alba.netfu.co.kr/n_alba/resume/alba_resume_area.php?area=20130716174853_3466 
								<ul class="text_color1">
								<?php 
									foreach($category_area as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								?>
								<li><a class="text_color1" href="<?php echo $alice['resume_path'];?>/alba_resume_area.php?area=<?php echo $val['code'];?>"><?php echo $name;?></a></li>
								<?php } ?>
								</ul>
							</dd>
						</dl>
					</div>-->
					<?php include_once "./views/_include/search.php";?>
				</div>
			</div>
			<!--  //인재정보 메인 검색영역 -->

			<!--  photo banner  -->   
			<?php echo ($sresume_focus_banner) ? "<div class='mt15 mb10'>".$sresume_focus_banner."</div>" : ""; ?>
			<?php if($design['sub_focus_use']) include_once "./views/_include/alba_focus.php";	 // 알바 포커스 인재정보 ?>
			<!--  //photo end  --> 

			<?php echo ($sresume_today_banner) ? "<div class='mt15 mb10'>".$sresume_today_banner."</div>" : ""; ?>
			<?php if($design['today_resume_use']){ ?>
			<!--  오늘의 인재   --> 
			<div id="listForm" class="positionR mt30 clearfix">
				<h2 class="clearfix">
					<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 오늘의 인재</strong>
				<em class="pl10" style="background: url(../images/main/bg_line_2.gif) no-repeat scroll 3px 50% ;">총 <span class="b"><?php echo number_format($today_list['total_count']);?></span> 건</em>
				</h2>
				<!-- <span class="positionA" style="top:-5px; right:0;">
					<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this,'index');">
					<option value="">출력수선택</option>
					<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
					<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
					<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
					</select>
				</span> -->
				<table cellspacing="0" summary="오늘 등록된 인재의  정보입니다">
				<caption class="skip">오늘의 인재</caption>
				<colgroup><col width="105px"><col width="*"><col width="100px"><col width="90px"><col width="70px"></colgroup>
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
				<?php 
				if($today_list['total_count']){
					foreach($today_list['result'] as $val){
					$no = $val['no'];
					$list = $alba_resume_user_control->get_resume_service($no,"",80);
				?>
				<tr>
					<td scope="row" class="name">
						<span><?php echo $list['name'];?>
							<?php if($list['is_photo']){?>
							<em class="pl5 photo"><img class="vb" src="../images/icon/icon_photo1.gif" width="16" height="16"></em>
							<?php } ?>
						</span>
						<span class="block">(<?php echo $list['wr_gender'];?> <span><?php echo $list['wr_age'];?></span>세)</span>
					</td>
					<td class="title">
						<a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>">
						<span class="title"><?php echo $list['subject'];?></span>
						<span class="kind text_color1"><?php echo $list['job_type'];?></span>
						<span class="career">
							<img class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	
							<?php echo $list['career'];?>
						</span>
						<?php if($list['license']){ ?>
						<span class="license">
							<img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> <?php echo $list['license'];?>
						</span>
						<?php } ?>
						</a>
					</td>
					<td class="pay">
						<span class="pay"><em class="number"><?php echo $list['wr_pay'];?></em> <em class="icon"><?php echo $list['wr_pay_type'];?></em></span>
					</td>
					<td class="local"><?php echo $utility->str_cut($list['wr_area'],18,"");?></td>
					<td class="modDate"><span><?php echo $list['last2'];?></span></td>
				</tr>
				<?php 
					}	// foreach end.
				} else {
				?>
				<tr><td colspan="5" class="tc no_listText"><span>오늘 등록된 인재정보가 없습니다.</span></td></tr>
				<?php } // if end.?>
				</tbody>
				</table>
				<?php include_once $alice['include_path']."/paging.php";?>
			</div>
			<!--  // 오늘의 인재 --> 
			<?php } ?>

			<?php echo ($sresume_basic_banner) ? "<div class='mt15 mb10'>".$sresume_basic_banner."</div>" : ""; ?>

			<!--  일반인재   --> 
			<div id="listForm" class="positionR mt30 clearfix">
				<a name="result"></a>
				<h2 class="clearfix">
					<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 일반인재정보</strong>
					<em class="pl10" style="background: url(../images/main/bg_line_2.gif) no-repeat scroll 3px 50% ;">총 <span class="b"><?php echo number_format($sub_list['total_count']);?></span> 건</em>
				</h2>
				<table cellspacing="0" summary="일반인재 정보입니다">
				<caption class="skip">일반 인재</caption>
				<colgroup><col width="105px"><col width="*"><col width="50px"><col width="100px"><col width="90px"><col width="70px"></colgroup>
				<thead>
				<tr>
					<th class="name" scope="col">이름</th>
					<th class="title" scope="col">이력서정보</th>
					<th scope="col"></th>
					<th class="pay" scope="col">희망급여</th>
					<th class="local" scope="col">희망지역</th>
					<th class="modDate" scope="col">수정일</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				if($sub_list['total_count']){
					foreach($sub_list['result'] as $val){
					$no = $val['no'];
					$list = $alba_resume_user_control->get_resume_service($no,"",80);
				?>
				<tr id="sub_list_<?php echo $no;?>">
					<td class="name">
						<span><?php echo $list['name'];?>
							<?php if($list['is_photo']){?>
							<em class="photo"><img class="vb pb2" src="../images/icon/icon_photo1.gif" width="16" height="16"></em>
							<?php } ?>
						</span>
						<span class="block">(<?php echo $list['wr_gender'];?> <span><?php echo $list['wr_age'];?></span>세)</span>
					</td>
					<td class="title">
						<a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>">
						<?php echo $list['service_busy'];?>
						<?php echo $list['service_icon'];?>
						<span class="title"><?php echo $list['subject'];?></span>
						<span class="kind text_color1"><?php echo $list['job_type'];?></span>
						<span class="career">
							<img class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	
							<?php echo $list['career'];?>
						</span>
						<?php if($list['license']){ ?>
						<span class="license">
							<img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> <?php echo $list['license'];?>
						</span>
						<?php } ?>
						</a>
					</td>
					<td class="icons">
						<div><a target="_blank" href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>" class="window" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_newWindow.png" alt="새창으로 열기"></a></div>
						<div><a href="javascript:resume_scrap('<?php echo $no;?>');" class="star" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
						<div><a href="javascript:sub_list_open('<?php echo $no;?>');" class="plus" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_plus.png" alt="상세보기"></a></div>
					</td>
					<td class="pay">
						<span class="pay">
							<em class="number"><?php echo $list['wr_pay'];?></em> 
							<em class="icon"><?php echo $list['wr_pay_type'];?></em>
						</span>
					</td>
					<td class="local"><?php echo $utility->str_cut($list['wr_area'],18,"");?> </td>
					<td class="modDate"><span><?php echo $list['last2'];?></span></td>
				</tr>
				<?php 
					}	// foreach end.
				} else {
				?>
				<tr><td colspan="6" class="tc no_listText"><span>인재정보가 없습니다.</span></td></tr>
				<?php } // if end.?>
				</tbody>
				</table>

				<!-- view layer -->
				<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="sub_list_quickView"></div>
				<!-- // view layer -->

			</div>
			<!--  // 일반인재  --> 

		</div>
	</div>
</section>
<script>
var sub_list_open = function( no ){	// 공고 상세보기
	var $sub_list = $('#sub_list_'+no);
	var position_top = $sub_list.position().top;
	$('#sub_list_quickView').hide();
	$('#sub_list_quickView').load('./views/_load/alba_resume.php', { mode:'focus', no:no }, function(){
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});
}
var list_close = function(){	// 플래티넘 레이어 닫기
	$('#list_quickView, #sub_list_quickView').hide();
}
</script>
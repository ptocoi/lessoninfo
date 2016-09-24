<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var type = "<?php echo $type;?>";	// 근무기간 :: 단기/장기 구분
var search_mode = "<?php echo $search_mode;?>";
var search_title = "기간별";
var send_url = "<?php echo $list_list['send_url'];?>";
var category_top = [];
</script>

<script type="text/javascript" src="<?php echo $alice['resume_path'];?>/skins/default/search.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['resume_path'];?>/">인재정보</a> > <a href="<?php echo $alice['resume_path'];?>/alba_resume_specialty.php">능력별 인재정보</a> > <strong>외국어별 인재정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  능력별인재정보 검색영역 -->
		<form method="get" name="resumeSearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="resumeSearchFrm">
		<input type="hidden" name="mode" value="search"/>
		<input type="hidden" name="search_mode" value="<?php echo $search_mode;?>"/>
		<!-- <input type="hidden" name="page" value="<?php echo $page;?>"/>
		<input type="hidden" name="page_rows" value="<?php echo $page_rows;?>"/>
		<input type="hidden" name="sort" value="<?php echo $sort;?>"/>
		<input type="hidden" name="flag" value="<?php echo $flag;?>"/> -->

		<div class="listWrap mt20">
			<h2 class=""><img src="../images/tit/resume_tit_11.gif"  alt="외국어별인재정보"></h2>
			<div class="resumeContentWrap positionR mt10 clearfix">

				<div class="foreignlanguageWrap clearfix">
					<dl class="type">
						<dt class="pr5"><strong>외국어 종류 :</strong></dt>
						<dd class="pr20">
							<select name="wr_language_name" id="wr_language_name" class="ipSelect2">
							<option value="">외국어 선택</option>
							<?php 
								foreach($indi_language_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($val['code']==$wr_language_name) ? 'selected' : '';
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php } // foreach end. ?>
							</select>
						</dd>
						<dd>
							<input type="radio" name="wr_language_level" id="wr_language_level_0" value='level";s:1:"0"' <?php echo ($wr_language_level=='level";s:1:"0"')?'checked':'';?>> <label for="wr_language_level_0">상 <span>(회화능숙)</span></label>
							<input type="radio" name="wr_language_level" id="wr_language_level_1" value='level";s:1:"1"'> <label for="wr_language_level_1" <?php echo ($wr_language_level=='level";s:1:"1"')?'checked':'';?>>중 <span>(일상대화)</span></label>
							<input type="radio" name="wr_language_level" id="wr_language_level_2" value='level";s:1:"2"'> <label for="wr_language_level_2" <?php echo ($wr_language_level=='level";s:1:"2"')?'checked':'';?>>하 <span>(간단대화)</span></label>
							<input type="checkbox" name="wr_language_study" id="wr_language_study_1" value="1" class="typeCheckbox"> 
							<label class="experience" for="wr_language_study_1">어학연수 경험있음</label>
						</dd>
					</dl>
				</div>
				<?php include_once "./views/_include/language_search.php"; ?>
			</div>
		</div>

		</form>
		<!--  // 채용정보 메인 검색영역 -->

		<!--  일반인재   --> 
		<div id="listForm" class="positionR mt30 clearfix">
			<a name="result"></a>
			<h2 class="clearfix">
				<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 일반인재정보</strong>
				<em class="pl10" style="background: url(../images/main/bg_line_2.gif) no-repeat scroll 3px 50% ;">총 <span class="b"><?php echo number_format($list_list['total_count']);?></span> 건</em>
			</h2>
			<span class="positionA" style="top:-5px; right:0;">
				<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this,'alba_resume_language');">
				<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
				<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
				<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
				</select>
			</span>
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
			if($list_list['total_count']){
				foreach($list_list['result'] as $val){
				$no = $val['no'];
				$list = $alba_resume_user_control->get_resume_service($no,"",80);
			?>
			<tr id="list_<?php echo $no;?>">
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
					<div><a href="javascript:list_open('<?php echo $no;?>');" class="plus" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_plus.png" alt="상세보기"></a></div>
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
			<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="list_quickView"></div>
			<!-- // view layer -->

			<?php include_once $alice['include_path']."/paging.php";?>

		</div>
		<!--  // 일반인재  --> 

		</div>
	</div>
</section>
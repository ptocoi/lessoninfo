<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var search_mode = "<?php echo $search_mode;?>";
var search_title = "업.직종별";
var send_url = "<?php echo $list_list['send_url'];?>";
var category_top = [];
<?php 
if($category_top_val){ 
	$category_top_val_cnt = count($category_top_val);
	for($i=0;$i<$category_top_val_cnt;$i++){
?>
	category_top.push('<?php echo $category_top_val[$i];?>');
<?php 
	} 
}
?>
</script>

<script type="text/javascript" src="<?php echo $alice['resume_path'];?>/skins/default/alba_resume_type.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['resume_path'];?>/">인재정보</a> > <a href="<?php echo $alice['resume_path'];?>/alba_resume_list.php">일반 인재정보</a> > <strong>업·직종별 인재정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  업직종별인재정보 검색영역 -->
		<form method="get" name="resumeSearchFrm" id="resumeSearchFrm" <?php echo $_SERVER['PHP_SELF'];?>>
		<input type="hidden" name="mode" value="search"/>
		<input type="hidden" name="search_mode" value="<?php echo $search_mode;?>"/>
		<!-- <input type="hidden" name="page" value="<?php echo $page;?>"/>
		<input type="hidden" name="page_rows" value="<?php echo $page_rows;?>"/>
		<input type="hidden" name="sort" value="<?php echo $sort;?>"/>
		<input type="hidden" name="flag" value="<?php echo $flag;?>"/> -->

		<input type="hidden" name="category_top_val" id="category_top_val" value="<?php echo ($mode=='search')?$_GET['category_top_val']:$job_types[0]['code'];?>"/>
		<input type="hidden" name="category_middle_val" id="category_middle_val" value="<?php echo $_GET['category_middle_val'];?>"/>
		<input type="hidden" name="category_sub_val" id="category_sub_val" value="<?php echo $_GET['category_sub_val'];?>"/>

		<div class="listWrap mt20">
			<h2 class="skip"><img src="../images/tit/resume_tit_08.gif" width="150" height="21" alt="업직종별 인재정보"></h2>
			<div class="resumeContentWrap positionR mt10 clearfix">
				<div class="partSetWrap clearfix">
					<ul class="tabMenu clearfix">						
						<!-- 
							<li class="check"><a href="#">외식·식음료</a></li>
							<li class="on check"><a href="#">IT·디자인</a></li>
						 -->
						<?php 
						if($job_types){
							$job_types_cnt = count($job_types);
							$i = 0;
							foreach($job_types as $key => $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링

							if($mode=='search' && $category_top_val[0]){	 // 검색일때
								$checked = (@in_array($val['code'],$category_top_val)) ? 'check' : '';
								$on = ( @in_array($val['code'],$category_top_val)  && $val['code'] == $category_top_val[0] ) ? 'on' : '';
							} else {	 // 검색이 아닐때
								$checked = "";
								$on = ($i==0) ? "on" : "";
							}

							$last_class = (($i +1) % 4 == 0) ? "last" : "";
						?>
						<li id="category_top_<?php echo $val['code'];?>" class="<?php echo $checked;?> <?php echo $on;?> <?php echo $last_class;?>" code="<?php echo $val['code'];?>"><a href="javascript:category_tops('<?php echo $val['code'];?>');"><?php echo $name;?></a></li>
						<?php 
							$i++;
							} // job_type foreach end.
						}	// job_type if end.
						?>
					</ul>
					<div id="category_second">
					
						<?php 
						if($mode=='search'){ // 검색일때 
							if($resume_type_1){
							$checked_arr = array();
							foreach($resume_type_1 as $type_key => $type_val){
							$pcode_list = $category_control->category_pcodeList('job_type',$type_key,""," and `view` = 'yes' ");
							$display = ($type_key == $category_top_val[0]) ? 'block' : 'none';
						?>
							<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $type_key;?>" style="display:<?php echo $display;?>;">
								<div class="mt5 middlePartSet clearfix">
									<ul class="listArea">
						<?php
									foreach($pcode_list as $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$category_count = $alba_resume_user_control->get_category_count($val['code'],'wr_job_type1');
									if(@in_array($val['code'],$category_middle_val)){
										$checked = 'checked';
										array_push($checked_arr,$val['code']);
									} else {
										$checked = '';
									}
									//$checked = (@in_array($val['code'],$category_middle_val)) ? 'checked' : '';
						?>
									<li id="category_middle_list_<?php echo $val['code'];?>">
										<span>
											<input type="checkbox" name="<?php echo $search_mode;?>_1[<?php echo $val['p_code'];?>][]" id="<?php echo $search_mode;?>_1_<?php echo $val['code'];?>" class="<?php echo $search_mode;?>_1_<?php echo $val['p_code'];?>" value="<?php echo $val['code'];?>" onclick="category_middles(this,'<?php echo $val['p_code'];?>');" <?php echo $checked;?>/>
											<label for="<?php echo $search_mode;?>_1_<?php echo $val['code'];?>"><?php echo $name;?></label>
										</span>
										<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
									</li>
						<?php
								}	// pcode_list foreach end.
						?>
									</ul>
								</div>
								<div id="category_third_<?php echo $type_key;?>">

								<?php
								if($category_middle_val){
									foreach($category_middle_val as $val){
									$sub_list = $category_control->category_pcodeList('job_type',$val,""," and `view` = 'yes' ");
									$display = (@in_array($val,$checked_arr)) ? 'block' : 'none';
								?>
									<div class="mt5 smallPartSet border_color1 bg_color2 clearfix category_sub category_sub_<?php echo $val;?>" id="category_sub_<?php echo $val;?>" style="display:<?php echo $display;?>;">
										<ul class="listArea">
										<?php
											foreach($sub_list as $val){
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$category_count = $alba_resume_user_control->get_category_count($val['code'],'wr_job_type2');
											$middle_category = $category_control->get_categoryCode($code);
											$checked = (@in_array($val['code'],$category_sub_val)) ? 'checked' : '';
										?>
										<li id="category_sub_list_<?php echo $val['code'];?>">
											<span>
												<input type="checkbox" name="<?php echo $mode;?>_2[<?php echo $middle_category['p_code'];?>][<?php echo $val['p_code'];?>][]" id="<?php echo $mode;?>_2_<?php echo $val['code'];?>" class="<?php echo $mode;?>_2_<?php echo $val['p_code'];?>" value="<?php echo $val['code'];?>" onclick="category_subs(this,'<?php echo $val['p_code'];?>','<?php echo $middle_category['p_code'];?>');" <?php echo $checked;?>/>
												<label for="<?php echo $mode;?>_2_<?php echo $val['code'];?>"><?php echo $name;?></label>
											</span>
											<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
										</li>
										<?php } ?>
										</ul>
									</div>
								<?php
									} // category_middle_val foreach end.
								}
								?>

								</div>
							</div>
						<?php
							}	// type foreach end.
						} else {
							$pcode_list = $category_control->category_pcodeList('job_type',$_GET['category_top_val'],""," and `view` = 'yes' ");
						?>
						<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $type_key;?>" style="display:<?php echo $display;?>;">
							<div class="mt5 middlePartSet clearfix">
								<ul class="listArea">
						<?php
								foreach($pcode_list as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type1');
								
								if(@in_array($val['code'],$category_middle_val)){
									$checked = 'checked';
									array_push($checked_arr,$val['code']);
								} else {
									$checked = '';
								}
						?>
								<li id="category_middle_list_<?php echo $val['code'];?>">
									<span>
										<input type="checkbox" name="<?php echo $search_mode;?>_1[<?php echo $val['p_code'];?>][]" id="<?php echo $search_mode;?>_1_<?php echo $val['code'];?>" class="<?php echo $search_mode;?>_1_<?php echo $val['p_code'];?>" value="<?php echo $val['code'];?>" onclick="category_middles(this,'<?php echo $val['p_code'];?>');" <?php echo $checked;?>/>
										<label for="<?php echo $search_mode;?>_1_<?php echo $val['code'];?>"><?php echo $name;?></label>
									</span>
									<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
								</li>
						<?php
							}	// pcode_list foreach end.
						}
						?>
								</ul>
							</div>
						</div>								
						<?php } else { // 검색이 아닐때 ?>

						<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $job_types[0]['code'];?>" style="display:;">
							<div class="mt5 middlePartSet clearfix">
								<ul class="listArea">
								<?php
								$pcode_list = $category_control->category_pcodeList('job_type',$job_types[0]['code'],""," and `view` = 'yes' ");
								foreach($pcode_list as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$category_count = $alba_resume_user_control->get_category_count($val['code'],'wr_job_type1');
								?>
								<li id="category_middle_list_<?php echo $val['code'];?>">
									<span>
										<input type="checkbox" name="<?php echo $search_mode;?>_1[<?php echo $val['p_code'];?>][]" id="<?php echo $search_mode;?>_1_<?php echo $val['code'];?>" class="<?php echo $search_mode;?>_1_<?php echo $job_types[0]['code'];?>" value="<?php echo $val['code'];?>" onclick="category_middles(this,'<?php echo $job_types[0]['code'];?>');"/>
										<label for="<?php echo $search_mode;?>_1_<?php echo $val['code'];?>"><?php echo $name;?></label>
									</span>
									<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
								</li>
								<?php 
								} // pcode list foreach end.
								?>
								</ul>
							</div>
							<div id="category_third_<?php echo $job_types[0]['code'];?>"></div>
						</div>

						<?php } // mode if end. ?>
					
					</div>

				</div>

				<?php include_once "./views/_include/type_search.php";?>

			</div>
		</div>
		</form>
		<!--  // 업직종별인재정보 검색영역 -->

		<!--  일반인재   --> 
		<div id="listForm" class="positionR mt30 clearfix">
			<a name="result"></a>
			<h2 class="clearfix">
				<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 일반인재정보</strong>
				<em class="pl10" style="background: url(../images/main/bg_line_2.gif) no-repeat scroll 3px 50% ;">총 <span class="b"><?php echo number_format($list_list['total_count']);?></span> 건</em>
			</h2>
			<span class="positionA" style="top:-5px; right:0;">
				<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this,'alba_resume_type');">
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

<script>
var list_open = function( no ){	// 공고 상세보기
	var $list = $('#list_'+no);
	var position_top = $list.position().top;

	$('#list_quickView').hide();
	$('#list_quickView').load('./views/_load/alba_resume.php', { mode:'list', no:no }, function(){
		position_tops = position_top;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});

}
var list_close = function(){	// 플래티넘 레이어 닫기
	$('#list_quickView').hide();
}
</script>
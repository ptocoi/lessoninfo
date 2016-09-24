<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script type="text/javascript" src="<?php echo $alice['main_path'];?>/skins/search.skin.js"></script>

<section id="content" class="content_wrap clearfix">

	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
	<?php include_once $alice['include_path'] . "/left_search.php"; ?>
	<div id="rightContent">

	<!--  전체알바정보 검색영역 -->
	<div class="listWrap mt20">
		<h2 class="skip">검색페이지</h2>
		<div class="keywordWrap positionR mt10 clearfix" style="">

			<form method="get" name="totalSearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="totalSearchFrm">
			<input type="hidden" name="mode" value="search"/>
			<input type="hidden" name="type" value="<?php echo $type;?>"/>
			<input type="hidden" name="search_keyword" value="<?php echo $search_keyword;?>"/>
			<div class="searchBox">
			<ul>
			<?php /* ?>
			<li class="keyword clearfix">
				<dl>
					<dt><strong>재검색</strong></dt>
					<dd class="keywordSearch">
						<input type="radio" name="wsearch_mode" class="typeRadio" id="wsearch_in" value="in"><label for="wsearch_in">결과내검색</label>
						<input type="radio" name="wsearch_mode" class="typeRadio" id="wsearch_out" value="out"><label for="wsearch_out">제외키워드</label>
						<span class="selectWrap">
							<input type="text" name="contain_keyword" id="contain_keyword" class="ipText2 pl5 ml5" style="width:200px;" >
							<span class="btn">
								<a class="keywordBtn" href="javascript:totalSearchFrm_submit();"><span class="Btn bg_color6">검색</span></a>
							</span>
						</span>
					</dd>
				</dl>
			</li>
			<?php */ ?>

			<?php if($type=='alba' || $type==''){ ?>
			<li class="workArea clearfix" style="display:block;"><!--  시도별알바정보,대학가알바정보에서 display:none -->
				<dl>
					<dt><strong>지역</strong></dt>
					<dd class="itemBoxArea">
					<div class="bigArea clearfix">
						<ul class="listArea">
						<?php
						if($category_area){
							foreach($category_area as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_area_0)) ? "checked" : "";
						?>
							<li id="area_top_<?php echo $val['code'];?>"><span><input type="checkbox" name="wr_area_0[]" id="wr_area_0_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" onclick="javascript:area_firsts(this);" <?php echo $checked;?>/><label for="wr_area_0_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
						<?php 
							}	// category_area foreach end.
						}	// category_area if end.
						?>
						</ul>
					</div>
					<?php
					if($category_area){
						foreach($category_area as $val){ 
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$pcode_list = $category_control->category_pcodeList('area',$val['code']);
						$third_area_list = array();
						if($pcode_list){
							$display = ($wr_area_1[$val['code']]) ? "block" : "none";
					?>
					<div class="mt5 middleArea border_blue clearfix" id="area_second_<?php echo $val['code'];?>" style="display:<?php echo $display;?>;">
						<ul class="listArea">
						<?php
							foreach($pcode_list as $p_val){
							$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
							$third_area = $category_control->category_pcodeList('area',$p_val['code']);
							$third_area_list[$p_val['code']] = $third_area;
							$checked = (@in_array($p_val['code'],$wr_area_1[$val['code']])) ? "checked" : "";
						?>
							<li id="area_middle_<?php echo $p_val['code'];?>" class="area_middle_<?php echo $val['code']?>"><span><input type="checkbox" name="wr_area_1[<?php echo $val['code'];?>][]" id="wr_area_1_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="area_seconds(this,'<?php echo $val['code']?>');" class="<?php echo $val['code'];?>" <?php echo $checked;?>/><label for="wr_area_1_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } // pcode_list foreach end. ?>
						</ul>
					</div>
					<?php }	 // pcode_list if end. ?>
					<?php
					if($third_area_list){
						foreach($third_area_list as $t_key => $t_list){
						if($t_list) { 
							$display = ($wr_area_2[$val['code']][$t_key]) ? "block" : "none";
					?>
					<div class="mt5 smallArea border_blue bg_blue2 clearfix area_third_<?php echo $val['code'];?>" id="area_third_<?php echo $t_key;?>" style="display:<?php echo $display;?>;">
						<ul class="listArea">
						<?php 
							foreach($t_list as $t_val){ 
							$name = $utility->remove_quoted($t_val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($t_val['code'],$wr_area_2[$val['code']][$t_val['p_code']])) ? "checked" : "";
						?>
							<li id="area_sub_<?php echo $t_val['code'];?>"><span><input type="checkbox" name="wr_area_2[<?php echo $val['code']?>][<?php echo $t_key;?>][]" id="wr_area_2_<?php echo $t_val['code'];?>" value="<?php echo $t_val['code'];?>" onclick="area_thirds(this,'<?php echo $t_val['p_code'];?>','<?php echo $val['code'];?>');" class="<?php echo $val['code'];?>_<?php echo $t_key;?> <?php echo $val['code'];?>" <?php echo $checked;?>/><label for="wr_area_2_<?php echo $t_val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } // third area foreach end.?>
						</ul>
					</div>
					<?php 
						}	// t_list if end.
						}	// third_area foreach end.
					} // third_area if end. 
					?>
				<?php 
					} // category_area foreach end.
				}	// category_area if end.
				?>
					</dd>
				</dl>
			</li>

			<li class="resultSet clearfix">
				<div class="resultBox clearfix">
					<dl class="selectBox  clearfix" style="display:<?php echo ($mode=='search'&&$wr_area_0)?'':'none';?>;"><!-- 선택조건 있을때 display-->
						<dt class="pb5"><strong>선택된 지역</strong></dt>
						<dd>
							<ul class="selectList">
							<?php
							if( $mode=='search' ){
								if($area_sels){	// 지역검색
									$k = 0;
									foreach($area_sels as $val){
										$vals_id = strtr($val,'/','_');
										$val_exp = explode('/',$val);
										$val_exp_cnt = count($val_exp);
										$area_sel = array();
										for($i=0;$i<$val_exp_cnt;$i++){
											$area_sel[$k][$i] = $category_control->get_categoryCodeName($val_exp[$i]);
										}
										$area_text = implode($area_sel[$k]," > ");
										if($val_exp[2]){
											$select_id = $val_exp[0]."_".$val_exp[1]."_".$val_exp[2];
										} else if($val_exp[1]){
											$select_id = $val_exp[0]."_".$val_exp[1];
										} else if($val_exp[0]){
											$select_id = $val_exp[0];
										}
										echo "<li id=\"select_".$select_id."\" class=\"area\">".$area_text."&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','".$val_exp[0]."','".$val_exp[1]."','".$val_exp[2]."');\">x</button><input type=\"hidden\" name=\"area_sels[]\" value=\"".$val."\" id=\"area_sels_".$vals_id."\"></li>";

									$k++;
									}
								}
							}
							?>
							</ul>
						</dd>
					</dl>
					<p class="noSelect" style="display:<?php echo ($mode=='search'&&$wr_area_0)?'none':'';?>;">선택된 지역이 없습니다.</p><!-- 선택조건 없을때 display-->
					<p class="btnAction">
						<a href="javascript:totalSearchFrm_submit();" class="searchBtn"><span class="Btn border_color3 bg_color6">검색</span></a><a class="resetBtn"><span class="Btn">초기화</span></a>							
					</p>
				</div>
			</li>
			<?php } ?>
			</ul>
			</div>
			</form>

		</div>
	</div>
	<!--  전체알바정보 검색영역 end -->

	<?php if($search_middle_banner){ ?>
	<!-- 배너 -->
	<div class="content_banner mt30 clearfix">
	<ul>
		<?php echo stripslashes($search_middle_banner);?>
	</ul>
	</div> 
	<!-- //배너 -->
	<?php } ?>

	<?php if($type=='alba' || $type==''){ ?>
	<!--  채용검색리스트   --> 
	<div class="keywordList positionR mt30 clearfix">
		<h2 class="clearfix pb5" style="border-bottom:1px solid #ddd;">
			<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 채용정보 검색결과</strong><em class="pl10">(총 <?php echo number_format($alba_search['total_count']);?>건)</em>
		</h2>
		<div>
			<?php if(!$alba_search['total_count']){ ?>
			<dl class="keywordNo"><dd class="tc">검색결과가 없습니다.</dd></dl> 
			<?php } else { 
				foreach($alba_search['result'] as $val){
				$list = $alba_user_control->get_alba_list($val['no']);
				$wdate = strtr($list['last2'],'-','/');
			?>
			<dl class="listWrap">
				<dd class="local"><?php echo $list['job_area_2'];?></dd>
				<dt class="tit">
					<span class="company"><a target="_blank" href="<?php echo $alice['alba_path'];?>/company_info.php?mb_id=<?php echo $val['wr_id'];?>"><?php echo stripslashes($list['company_name']);?></a></span>
					<span class="title"><a target="_blank" href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $val['no'];?>"><?php echo $list['subject'];?></a></span>
				</dt>    
				<dd class="etc">
					<span class="number"><?php echo $list['wr_pay_type'];?> : <?php echo $list['wr_pay'];?></span>
					<span class="date">등록일 : <?php echo $wdate;?></span>
					<span class="finish">마감일 : <?php echo ($list['volume_date']['date'])?$list['volume_date']['date']:$list['volume_date']['text'];?></span>
				</dd>
			</dl> 
			<?php 
				}	// foreach end.
			} // if end.
			?>
			<div class="more">총 <?php echo number_format($alba_search['total_count']);?>건<a target="_blank" href="<?php echo $alice['alba_path'];?>/alba_list.php?mode=search&search_mode=alba_list&search_keyword=<?php echo urlencode($_GET['search_keyword']);?>">채용정보 더보기</a></div> 
		</div>
	</div>
	<!--  채용검색리스트 end   --> 
	<?php } ?>

	<?php if($type=='alba_resume' || $type==''){ ?>
	<!--  인재검색리스트   --> 
	<div class="keywordList positionR mt30 clearfix">
		<h2 class="clearfix pb5" style="border-bottom:1px solid #ddd;">
			<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 인재정보 검색결과</strong>
		</h2>
		<div>
			<?php if(!$alba_resume_search['total_count']){ ?>
			<dl class="keywordNo"><dd class="tc">검색결과가 없습니다.</dd></dl>
			<?php } else { 
				foreach($alba_resume_search['result'] as $val){
				$list = $alba_resume_user_control->get_resume_service($val['no']);
			?>
			<dl class="hrListWrap">
				<dt class="name">
					<span><?php echo $list['name'];?>
					<?php if($list['is_photo']){?>
					<em class="pl5 photo"><img width="16" height="16" src="../images/icon/icon_photo1.gif" class="vb"></em>
					<?php } ?>
					</span>
					<span class="block">(<?php echo $list['wr_gender'];?> <span><?php echo $list['wr_age'];?></span>세)</span>        
				</dt>    
				<dd class="tit">
					<a target="_blank"  href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $val['no'];?>"><span class="title"><?php echo $list['wr_subject'];?></span></a>
					<span class="modDate">수정일 : <?php echo $list['last2'];?></span>
				</dd>
				<dd class="etc">
					<span class="kind"><?php echo $list['job_type'];?></span>
				</dd>
				<dd class="etc">
					<span class="local">희망 근무지 : <?php echo $list['wr_area_0'];?> </span>
				</dd>
				<dd class="etc">
					<span class="career">경력 : <?php echo $list['career'];?></span>
					<span class="license">자격증 : <?php echo $list['license'];?></span>
				</dd>
			</dl>
			<?php 
				}	// foreach end.
			} // if end.
			?>
			<div class="more">총 <?php echo number_format($alba_resume_search['total_count']);?>건<a target="_blank"  href="<?php echo $alice['resume_path'];?>/alba_resume_list.php?mode=search&search_mode=&search_keyword=<?php echo urlencode($_GET['search_keyword']);?>">인재정보 더보기</a></div> 
		</div>
	</div>
	<!--  인재검색리스트 end   -->  
	<?php } ?>

	<?php if($type=='board' || $type==''){ ?>
	<!--  커뮤니티검색리스트   --> 
	<div class="keywordList positionR mt30 clearfix">
		<h2 class="clearfix pb5" style="border-bottom:1px solid #ddd;">
			<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 커뮤니티 검색결과</strong><em class="pl10">(총 <?php echo number_format($board_search['total_count']);?>건)</em>
		</h2>
		<div>
			<?php if(!$board_search['total_count']){ ?>
			<dl class="keywordNo"><dd class="tc">검색결과가 없습니다.</dd></dl>
			<?php } else { 
				foreach($board_search['result'] as $key => $boards){
				$get_board = $board_config_control->get_boardTable($key);
					foreach($boards as $val){
					$wdate = strtr(substr($val['wr_datetime'],0,11),'-','.');
			?>
			<dl class="tolkListWrap clearfix">
				<dt>[<?php echo stripslashes($get_board['bo_subject']);?>]</dt>
				<dd><a target="_blank" href="<?php echo $alice['board_path'];?>/board.php?board_code=<?php echo $board_code;?>&code=<?php echo $get_board['code'];?>&bo_table=<?php echo $get_board['bo_table'];?>&wr_no=<?php echo $val['wr_no'];?>" target="_blank"><?php echo stripslashes($val['wr_subject']);?></a><span><?php echo $wdate;?></span></dd>
			</dl>
			<?php 
					}	// foreach end.
				}	// foreach end.
			} // if end.
			?>
			<div class="more">총 <?php echo number_format($board_total_count);?>건<a target="_blank" href="<?php echo $alice['board_path'];?>/">커뮤니티 더보기</a></div> 
		</div>
	</div>
	<!--  커뮤니티검색리스트 end   -->
	<?php } ?>

	</div>
	</div>
</section>
<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>


<script>
var mode = "<?php echo $mode;?>";
var search_mode = "<?php echo $search_mode;?>";
var search_title = "대학가";
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

<script type="text/javascript" src="<?php echo $alice['alba_path'];?>/skins/default/alba_list_adult.skin.js"></script>

<style type="text/css">
/* ========================  기본컬러설정   ========================= */
#list li .icons div img{background-color:#c9c9c9;}

#platinum dd.icons > div > a > img{background-color:#<?php echo $design['adult_platinum_border_color'];?>;}	/* 테두리 일반 */
#platinum  > ul > li{border-color:#<?php echo $design['adult_platinum_border_color'];?>;}	/* 테두리 일반 */
#platinum .text1{background-color:#<?php echo $design['adult_platinum_background_color'];?>;}	/* 배경칼라 일반 */
#platinum .text2{background-color:#<?php echo $design['adult_platinum_background_color'];?>;}	/* 배경칼라 일반 */
#platinum.number5  > ul > li .logo_tit{background-color:#<?php echo $design['adult_platinum_background_color'];?>;}	/* 배경칼라 일반 */

#prime dd.icons > div > a > img{background-color:#<?php echo $design['adult_prime_border_color'];?>;}
#prime  > ul > li{border-color:#<?php echo $design['adult_prime_border_color'];?>;}
#prime .text1{background-color:#<?php echo $design['adult_prime_background_color'];?>;}
#prime .text2{background-color:#<?php echo $design['adult_prime_background_color'];?>;}
#prime.number5  > ul > li .logo_tit{background-color:#<?php echo $design['adult_prime_background_color'];?>;}

#grand dd.icons > div > a > img{background-color:#<?php echo $design['adult_grand_border_color'];?>;}
#grand  > ul > li{border-color:#<?php echo $design['adult_grand_border_color'];?>;}
#grand .text1{background-color:#<?php echo $design['adult_grand_background_color'];?>;}
#grand .text2{background-color:#<?php echo $design['adult_grand_background_color'];?>;}
#grand.number5  > ul > li .logo_tit{background-color:#<?php echo $design['adult_grand_background_color'];?>;}

#box dd.icons > div > a > img{background-color:#<?php echo $design['adult_banner_border_color'];?>;}
#box  > ul > li{border-color:#<?php echo $design['adult_banner_border_color'];?>;}
#box .text1{background-color:#<?php echo $design['adult_banner_background_color'];?>;}
#box .text2{background-color:#<?php echo $design['adult_banner_background_color'];?>;}
/* ========================  기본컬러설정 // ========================= */

/* ========================  골드컬러설정 ========================= */
.border1 > ul > li.gold {z-index:1000;}
.border2 > ul > li.gold {z-index:1000;}

#list > ul > li.gold {background:#<?php echo $design['adult_list_background_gold_color'];?>;border-color:#c3b39e;}
#list > ul > li.gold .icons div img{background-color:#fdb301;}

#platinum  > ul > li.gold {border-color:#<?php echo $design['adult_platinum_border_gold_color'];?>;}	/* 테두리 골드 */
#platinum  > ul > li.gold .icons div img{background-color:#<?php echo $design['adult_platinum_border_gold_color'];?>;}	/* 테두리 골드 */
#platinum  > ul > li.gold .text1 a{color:#fff;}
#platinum  > ul > li.gold .text1,#platinum li.gold .text2{background-color:#<?php echo $design['adult_platinum_background_gold_color'];?>; color:#fff;}	/* 배경칼라 골드 */
#platinum  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['adult_platinum_background_gold_color'];?>;}	/* 배경칼라 골드 */
#platinum.number5  > ul > li.gold .logo_tit{background-color:#<?php echo $design['adult_platinum_background_gold_color'];?>;color:#fff;}	/* 배경칼라 골드 */

#prime  > ul > li.gold {border-color:#<?php echo $design['adult_prime_border_gold_color'];?>;}
#prime  > ul > li.gold .icons div img{background-color:#<?php echo $design['adult_prime_border_gold_color'];?>;}
#prime  > ul > li.gold .text1 a{color:#fff;}
#prime  > ul > li.gold .text1,#prime li.gold .text2{background-color:#<?php echo $design['adult_prime_background_gold_color'];?>; color:#fff;}
#prime  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['adult_prime_background_gold_color'];?>;}
#prime.number5  > ul > li.gold .logo_tit{background-color:#<?php echo $design['adult_prime_background_gold_color'];?>;color:#fff;}

#grand  > ul > li.gold {border-color:#<?php echo $design['adult_grand_border_gold_color'];?>;}
#grand  > ul > li.gold .icons div img{background-color:#<?php echo $design['adult_grand_border_gold_color'];?>;}
#grand  > ul > li.gold .text1 a{color:#fff;}
#grand  > ul > li.gold .text1,#grand li.gold .text2{background-color:#<?php echo $design['adult_grand_background_gold_color'];?>; color:#fff;}
#grand  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['adult_grand_background_gold_color'];?>;}
#grand.number5  > ul > li.gold .logo_tit{background-color:#<?php echo $design['adult_grand_background_gold_color'];?>;color:#fff;}

#box  > ul > li.gold {border-color:#<?php echo $design['adult_banner_border_gold_color'];?>;}
#box  > ul > li.gold .icons div img{background-color:#<?php echo $design['adult_banner_border_gold_color'];?>;}
#box  > ul > li.gold .text1 a{color:#fff;}
#box  > ul > li.gold .text1,#box li.gold .text2{background-color:#<?php echo $design['adult_banner_background_gold_color'];?>; color:#fff;}
#box  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['adult_banner_background_gold_color'];?>;}
/* ========================  골드컬러설정 // ========================= */
</style>  

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['alba_path'];?>/">채용정보</a> > <a href="<?php echo $alice['alba_path'];?>/alba_list_type.php">업직종별 채용정보</a> > <strong>19 채용</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  19정규직 검색영역 -->
		<form method="get" name="albaSearchFrm" id="albaSearchFrm" <?php echo $_SERVER['PHP_SELF'];?>>
		<input type="hidden" name="mode" value="search"/>
		<input type="hidden" name="search_mode" value="<?php echo $search_mode;?>"/>
		<!-- <input type="hidden" name="view_type" value="<?php echo $view_type;?>"/>
		<input type="hidden" name="page" value="<?php echo $page;?>"/>
		<input type="hidden" name="page_rows" value="<?php echo $page_rows;?>"/>
		<input type="hidden" name="sort" value="<?php echo $sort;?>"/>
		<input type="hidden" name="flag" value="<?php echo $flag;?>"/> -->
		<input type="hidden" name="type" value="<?php echo $type;?>"/>

		<input type="hidden" name="category_top_val" id="category_top_val" value="<?php echo $_GET['category_top_val'];?>"/>
		<input type="hidden" name="category_middle_val" id="category_middle_val"/>
		<input type="hidden" name="category_sub_val" id="category_sub_val"/>

		<div class="listWrap mt20">
			<a name="result"></a>
			<h2 class="skip">19 정규직</h2>
			<div class="jobContentWrap positionR mt10 clearfix">
				<div class="adultWrap clearfix">
					<ul class="tabMenu clearfix">
					<?php
					$first_pcode = "";
					if($adult_pcode_list){
						$i = 0 ;
						foreach($adult_pcode_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						if($mode=='search' && $category_top_val[0]){	 // 검색일때
							$checked = (@in_array($val['code'],$category_top_val)) ? 'check' : '';
							$on = ( @in_array($val['code'],$category_top_val)  && $val['code'] == $category_top_val[0] ) ? 'on' : '';
						} else {	 // 검색이 아닐때
							$checked = "";
							$on = ($i==0) ? "on" : "";
						}
						
						if($mode!='search' && $i==0){
							$first_pcode = $val['code'];
						}

						$last_class = (($i +1) % 4 == 0) ? "last" : "";
					?>
						<li id="category_top_<?php echo $val['code'];?>" class="<?php echo $checked;?> <?php echo $on;?> <?php echo $last_class;?>" code="<?php echo $val['code'];?>"><a href="javascript:category_tops('<?php echo $val['code'];?>');"><?php echo $name;?></a></li>
					<?php 
						$i++;
						} // adult job foreach end. 
					}	// adult job if end.
					?>
					</ul>

					<div id="category_second">
					
						<?php 
						if($mode=='search' && $alba_list_adult_1){ // 검색일때 
							$checked_arr = array();
							foreach($alba_list_adult_1 as $type_key => $type_val){
							$pcode_list = $category_control->category_codeLists('job_type'," and `p_code` = '".$type_key."' and `view` = 'yes' and `etc_0` = '1' ");
							//$display = ($type_key == $category_top_val[0]) ? 'block' : 'none';
						?>
							<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $type_key;?>" style="display:<?php echo $display;?>;">
								<div class="mt5 mediumArea clearfix">
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
								foreach($category_middle_val as $val){
								$sub_list = $category_control->category_pcodeList('job_type',$val,"", " and `view` = 'yes' ");
								$display = (@in_array($val,$checked_arr)) ? 'block' : 'none';
								?>
								<div class="mt5 smallPartSet border_color1 bg_color2 clearfix category_sub category_sub_<?php echo $val;?>" id="category_sub_<?php echo $val;?>" style="display:<?php echo $display;?>;">
									<ul class="listArea">
									<?php
										foreach($sub_list as $val){
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type2');
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
								?>

								</div>
							</div>
						<?php
							}	// type foreach end.
						?>
								
						<?php } else { // 검색이 아닐때 ?>

						<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $first_pcode;?>" style="display:;">
							<div class="mt5 mediumArea clearfix">
								<ul class="listArea">
								<?php
								$pcode_list = $category_control->category_pcodeList('job_type',$first_pcode,"", " and `view` = 'yes' ");
								if($pcode_list) {
									foreach($pcode_list as $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type1');
								?>
								<li id="category_middle_list_<?php echo $val['code'];?>">
									<span>
										<input type="checkbox" name="<?php echo $search_mode;?>_1[<?php echo $val['p_code'];?>][]" id="<?php echo $search_mode;?>_1_<?php echo $val['code'];?>" class="<?php echo $search_mode;?>_1_<?php echo $first_pcode;?>" value="<?php echo $val['code'];?>" onclick="category_middles(this,'<?php echo $first_pcode;?>');"/>
										<label for="<?php echo $search_mode;?>_1_<?php echo $val['code'];?>"><?php echo $name;?></label>
									</span>
									<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
								</li>
								<?php 
									} // pcode list foreach end.
								}	// if end.
								?>
								</ul>
							</div>
							<div id="category_third_<?php echo $job_types[0]['code'];?>"></div>
						</div>

						<?php } // mode if end. ?>
					
					</div>

				</div>
				<?php include_once "./views/_include/adult_search.php";?>
				</div>
			</div>
		</form>
		<!--  19정규직 검색영역 end -->

		<?php if($adult_platinum_use && $platinum_list_total) include_once $alice['alba_path'] . "/views/_include/adult_platinum.php";	// 플래티넘 채용정보 ?>
		<?php if($adult_prime_use && $prime_list_total) include_once $alice['alba_path'] . "/views/_include/adult_prime.php";		// 프라임 채용정보 ?>
		<?php if($adult_grand_use && $grand_list_total) include_once $alice['alba_path'] . "/views/_include/adult_grand.php";		// 그랜드 채용정보 ?>
		<?php if($adult_banner_use && $banner_list_total) include_once $alice['alba_path'] . "/views/_include/adult_banner.php";		// 배너형 채용정보 ?>
		<?php if($adult_list_use && $lists_list_total) include_once $alice['alba_path'] . "/views/_include/adult_list.php";			// 리스트형 채용정보 ?>

		<!--  일반채용   --> 
		<div id="JobListForm" class="positionR mt30 clearfix">
			<a name="result"></a>
			<h2 class="clearfix">
				<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 일반채용정보</strong>
				<em class="pl10" style="background: url(../images/main/bg_line_2.gif) no-repeat scroll 3px 50% ;">총 <span class="b"><?php echo number_format($list_list['total_count']);?></span> 건</em>
			</h2>
			<div class="ListFunc positionA" style="top:-5px; right:0;">
				<span class="choiceLink pr5">
					<span class="Link1"><a href="./alba_list_adult.php?<?php echo $list_list['send_url'];?>&view_type=list#result"><img width="25" height="19" alt="" src="../images/icon/icon_choiceLink1_<?php echo (!$view_type||$view_type=='list')?'on':'off';?>.gif" class="vb" id="choiceLink_list"></a></span>
					<span class="Link2"><a href="./alba_list_adult.php?<?php echo $list_list['send_url'];?>&view_type=gallery#result"><img width="25" height="19" alt="" src="../images/icon/icon_choiceLink2_<?php echo ($view_type=='gallery')?'on':'off';?>.gif" class="vb" id="choiceLink_gallery"></a></span>
				</span>
				<span>
					<select title="pagesize" name="sort" style="width:100px;" class="ipSelect2" onchange="list_sorting(this,'alba_list_adult');">
					<option value="wr_wdate" <?php echo ($sort=='wr_wdate')?'selected':'';?>>최근등록순</option>
					<option value="wr_volume_date" <?php echo ($sort=='wr_volume_date')?'selected':'';?>>마감임박순</option>
					</select>
				</span>
				<span>
					<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this,'alba_list');">
					<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
					<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
					<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
					</select>
				</span>
			</div>
			</span>

			<?php if(!$view_type || $view_type=='list'){?>
			<div id="list_view">
				<!--  일반보기  -->   
				<table cellspacing="0" summary="정규직 정보입니다">
				<caption class="skip">일반채용</caption>
				<colgroup><col width="90px"><col width="50px"><col width="*"><col width="110px"><col width="60px"><col width="90px"><col width="55px"><col width="60px">  </colgroup>
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
				if($list_list['result']){
					foreach($list_list['result'] as $key => $val){ 
					$no = $val['no'];
					$lists = $alba_user_control->get_alba_service($no,"sub_list",49);
					$wdate = strtr($lists['datetime3'],"-","/");
				?>
				<tr id="list_<?php echo $no;?>" style="display:;">
					<td class="local"><?php echo $utility->str_cut($lists['wr_area'],19,"");?></td>
					<td  class="icons">
						<div><a class="window" href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
						<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
						<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
						<?php } ?>
						<div><a class="plus" href="javascript:list_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png" class="bg_orang"></a></div>
					</td>        
					<td class="title"><?php echo $lists['service_busy'];?><?php echo $lists['service_icon'];?><a href="./alba_detail.php?no=<?php echo $no;?>"><span><?php echo $lists['subject'];?> </span></a></td>
					<td class="company"><a href="./alba_detail.php?no=<?php echo $no;?>"><span><?php echo $lists['company_name'];?> </span></a></td>
					<td class="gender"><?php echo $lists['wr_gender'];?>&nbsp;</td>
					<td class="pay">
						<?php 
						if(!$lists['wr_pay'] || $lists['wr_pay']==0){ 
							echo "협의";
						} else { 
						?>
						<span class="number"><?php echo $lists['wr_pay'];?>원</span>
						<em class="icon"><?php echo $lists['wr_pay_type'];?></em>
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
			</div>

			<!-- view layer -->
			<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="list_quickView"></div>
			<!-- // view layer -->

			<?php } else if($view_type=='gallery'){ ?>

			<div id="gallery_view">
			<?php 
			if($list_list['result']){
				foreach($list_list['result'] as $key => $val){ 
				$no = $val['no'];
				$list = $alba_user_control->get_alba_list($no);

				$biz_foundation = $category_control->get_categoryCode('20130626171611_2769');	// 설립일
				$biz_sale = $category_control->get_categoryCode('20130626172556_1808');	 // 매출액
				$biz_member_count = $category_control->get_categoryCode('20130626172544_6551');	 // 사원수
				$form_option = $category_control->get_categoryCode('20130626171524_3156');	// 기업형태

				if($biz_foundation['view']=='yes'){
					$mb_biz_foundation = ($list['company_info']['mb_biz_foundation']) ? "<li>설립일 : ".$list['company_info']['mb_biz_foundation']."년 설립(".$list['company_year']."년차)</li>" : "";
				}
				if($biz_sale['view']=='yes'){
					$mb_biz_sale = ($list['company_info']['mb_biz_sale']) ? "<li>매출액 : ".$list['company_info']['mb_biz_sale']."원</li>":"";
				}
				if($biz_member_count['view']=='yes'){
					$mb_biz_member_count = ($list['company_info']['mb_biz_member_count']) ? "<li>사원수 : ".$list['company_info']['mb_biz_member_count']."명</li>" : "";
				}
				if($form_option['view']=='yes'){
					$biz_form_option = ($list['biz_form_option']) ? "<li>기업형태 : ".$list['biz_form_option']."</li>" : "";
				}
			?>
				<div class="quickView clearfix">
					<div class="leftView positionR">
						<p class="logo"> 
							<span class="spacer"></span> 
							<a target="blank" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo $list['wr_logo'];?></a> 
						</p>
						<p class="companySubject pt10"> <strong><?php echo stripslashes($get_alba['wr_company_name']);?></strong></p>
						<ul class="companyDesc pt5">
							<?php echo $mb_biz_foundation;?>
							<?php echo $mb_biz_sale;?>
							<?php echo $mb_biz_member_count;?>
							<?php echo $biz_form_option;?>
						</ul>
						<?//php if($member['mb_type'] != 'company' && $list['is_online']){	// 개인회원만 온라인입사지원 가능 ( 온라인, 이메일 )?>
						<div class="tag mt20">
							<a href="javascript:online_becomes('<?php echo $no;?>','<?php echo $list['wr_requisition']?>');"><img width="145" height="42" alt="온라인입사지원" src="../images/basic/btn_online1.gif"></a>
						</div>
						<?//php } ?>
					</div>

					<div class="contView">
						<div class="titleArea positionR">
							<p class="title"><strong><a target="_blank" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?></a></strong></p>
							<p class="desc"><?php echo $list['job_type'];?></p>
							<div class="icons positionA" style="bottom:5px; right:5px;">
								<div><a target="_blank" href="./alba_detail.php?no=<?php echo $no;?>" class="window" id=""><img width="13" height="13" class="bg_orang" src="../images/icon/icon_newWindow.png" alt="새창으로 열기"></a></div>
								<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
								<div><a href="javascript:alba_scrap('<?php echo $no;?>');" class="star" id=""><img width="13" height="13" class="bg_orang" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
								<?php } ?>
							</div>
						</div>
						<div class="infoArea">
							<ul class="detailItem">
								<li>
									<strong><img alt="근무지역" src="../images/icon/ico_job_quickView1.gif" width="43" height="14"></strong> 
									<?php echo $list['job_subway'];?>
									<span class="district" title="<?php echo $list['job_area'];?>"><?php echo $list['job_area'];?></span>
								</li>

								<li><strong><img alt="근무기간" src="../images/icon/ico_job_quickView2.gif" width="43" height="14"></strong> <?php echo $list['wr_date'];?></li>
								<li><strong><img alt="근무요일" src="../images/icon/ico_job_quickView3.gif" width="43" height="14"></strong> <?php echo $list['wr_week'];?>, <?php echo $list['wr_time'];?> </li>
								<?php if($list['welfare_read']){ ?>
								<li><strong><img alt="복리후생" src="../images/icon/ico_job_quickView4.gif" width="43" height="14"></strong> <?php echo $list['welfare_read'];?> </li>
								<?php } ?>
								<li><strong><img alt="마감일" src="../images/icon/ico_job_quickView5.gif" width="43" height="14"></strong> <?php echo $list['volume_date']['text'];?> </li>
							</ul>
						</div> 
						<div class="item clearfix">
							<ul>
								<li class="first">
									<div class="boxTxt">
									<strong>급여조건</strong> 
									<span class="txt">
									<dd class="text2 clearfix">
										<span class="pay">
										<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?>원</em>
										</span>
									</dd>
									</div>
								</li>
								<li> 
									<div class="boxTxt">
									<strong>성별</strong> 
									<span class="txt"><?php echo $list['wr_gender'];?></span> 
									</div>
								</li>
								<li> 
									<div class="boxTxt">
									<strong>연령</strong>
									<span class="txt"><?php echo $list['age']['result'];?><?php echo ($list['age']['etc'])?"<p>[".$list['age']['etc']."]</p>":'';?></span> 
									</div>
								</li>
								<li class="shape"> 
									<div class="boxTxt">
									<strong>모집인원</strong> 
									<span class="txt"><?php echo $list['volmue'];?></span> 
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php 
				} // foreach end.
			} else {	
			?>
				<div class="quickView clearfix"><div class="tc no_listText">채용정보가 없습니다.</div></div></div>
			<?php } // if end.?>
			</div>

			<?php } // view_type if end. ?>

			<?php include_once $alice['include_path']."/paging.php";?>
		</div>
		<!--  일반채용 end   --> 
		</div>
	</div>
</section>

<script>
var list_open = function( no ){	// 공고 상세보기
	var $list = $('#list_'+no);
	var position_top = $list.position().top;

	$('#list_quickView').hide();
	$('#list_quickView').load('./views/_load/alba.php', { mode:'basic', no:no }, function(){
		position_tops = position_top - 2;
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
var sub_list_close = function(){	// 리스트 레이어 닫기
	$('#list_quickView').hide();
}
</script>
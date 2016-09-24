<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var page_rows = function(sels){	// 출력 갯수
	/*
	var sel = sels.value, send_url = "<?php echo $list_row['send_url'];?>";
	var code = "<?php echo $code;?>", bo_table = "<?php echo $bo_table;?>", sca = "<?php echo $sca;?>";
	var mode = "<?php echo $mode;?>", search_field = "<?php echo $search_field;?>", search_keyword = "<?php echo $search_keyword;?>";
	var sort = "<?php echo $sort;?>";
	location.href = "./list.php?mode="+mode+"&search_field="+search_field+"&search_keyword="+search_keyword+"&code="+code+"&bo_table="+bo_table+"&sca="+sca+"&"+send_url+"&sort="+sort+"&page_rows=" + sel;
	*/
}
var boardList_submit = function(){
	$('#boardListFrm').submit();
}
</script>

<div class="rightWrap mt20 mb30" style="border:0px solid #000;">
	<h2 class="skip"><?php echo $bo_subject;?></h2><div class="community positionR"><h3 class="pb5 pl5 h3">
		<img class="" src="../images/icon/icon_star1.gif" width="18" height="17" alt=""> <strong><?php echo $bo_subject;?></strong>
	</h3>
	<div class="mainTopBorder positionR mt20 clearfix" id="listForm">
		
		<form name="boardListFrm" method="GET" id="boardListFrm" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<input type="hidden" name="mode" value="search"/>
		<input type="hidden" name="board_code" value="<?php echo $board_code;?>"/>
		<input type="hidden" name="code" value="<?php echo $code;?>"/>
		<input type="hidden" name="bo_table" value="<?php echo $bo_table;?>"/>
		<input type="hidden" name="sca" value="<?php echo $sca;?>"/>
		<input type="hidden" name="sort" value="<?php echo $sort;?>"/>
		
		<?php if($use_category){?>
		<ul style="top:0px;left:0;" class="boardTap clearfix">
			<li class="<?php echo (!$sca)?"on":"";?>"><a href="./board.php?<?php echo $category_location."&page=".$page;?>">전체</a></li>
			<?php foreach($bo_category as $_cate){ ?>
				<li <?php echo ($sca==$_cate['code'])?"class='on'":"";?>><a href="./board.php?<?php echo $category_location."&sca=".$_cate['code']."&page=".$page;?>"><?php echo stripslashes($_cate['name']);?></a></li>
			<?php } ?>
		</ul>
		<?php } ?>

		<div style="top:-30px; right:0;" class="positionA">
			<span class="pl10">
				<select class="ipSelect2" style="width:50px;" id="search_field" name="search_field" title="검색선택">
				<option value="wr_subject" <?php echo ($_GET['search_field']=='wr_subject')?'selected':'';?>>제목</option>
				<option value="wr_content" <?php echo ($_GET['search_field']=='wr_content')?'selected':'';?>>내용</option>
				<option value="wr_subject||wr_content" <?php echo ($_GET['search_field']=='wr_subject||wr_content')?'selected':'';?>>제목+내용</option>
				<option value="wr_name" <?php echo ($_GET['search_field']=='wr_name')?'selected':'';?>>작성자</option>
				</select>      
				<input type="text" class="ipText2" style="margin-top:-2px;width:100px;" value="<?php echo $search_keyword;?>" name="search_keyword"> 
				<a class="button" onclick="boardList_submit();"><span>검색</span></a>
			</span>	

			<span class="pl10">    
				<select title="출력수설정" name="page_rows" id="page_rows" style="width:100px;" class="ipSelect2" onchange="page_rows(this);">
				<option value='15' <?php echo ($page_rows==15)?'selected':'';?>>15개 출력</option>
				<option value='30' <?php echo ($page_rows==30)?'selected':'';?>>30개 출력</option>
				<option value='50' <?php echo ($page_rows==50)?'selected':'';?>>50개 출력</option>
				<option value='70' <?php echo ($page_rows==70)?'selected':'';?>>70개 출력</option>
				<option value='100' <?php echo ($page_rows==100)?'selected':'';?>>100개 출력</option>
				</select>
			</span>

		</div>

		</form>

		<table cellspacing="0" >
		<colgroup><col width="110px"><col width="*"><col width="80px"><col width="80px"></colgroup>
		<thead>
		<tr>
			<th scope="col" class="tl pl15">등록일</th>
			<th scope="col">제목</th>
			<th scope="col">작성자</th>
			<th scope="col" class="tr pr15">조회수</th>
		</tr>
		</thead>
		<tbody>
		<?php if(!$list){ ?>
		<tr>
			<td class="tc" colspan="4" style="height:100px;background:#fafafa;"><span>게시물이 없습니다.</span></td>
		</tr>
		<?php } else { 
			$i_no = 0;
			foreach($list as $val){

				//2016-04-22 회원등급 아이콘 작업 추가됨
				$wr_id = $val['wr_id'];
				$wr_member = $member_control->get_member($wr_id);
				$mb_level = $wr_member['mb_level'];				
				$mb_level_cate = $category_control->get_categoryRank($mb_level," and `type` =  'mb_level' ");
				$img_src = explode('/',$mb_level_cate['etc_1']);
				$level_icon_sum = ($mb_level_cate['etc_1']) ? "http://".$_SERVER['HTTP_HOST'] . "/data/peg/" . $img_src[0]. "/".$img_src[1] : "";
				$level_icon = $mb_level ? "<img src='".$level_icon_sum."' class='vm'/>":"";	

			$i_no++;

			preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $val['content'], $_img);

			if(!$_img){	 // 내용상 이미지가 없다면

				if($val['file'][0]['view']){
					$src = $val['file'][0]['path']."/".$val['file'][0]['file'];
					$get_img = @getimagesize($src); // 파일정보를 가져옴

					// 관리자가 이미지 사이즈를 바꾸었을때를 대비하여 리사이징 크기를 이름에 포함과 이미지 재 첨부시 바뀜
					$img_step1 = explode("_",$val[file][0][file]);
					$img_step2 = explode(".",$img_step1[1]);
					$new_imgname = $img_step2[0];
					$thumb_file_list = $thumb_path . "/187x170_".$new_imgname."_".$val['wr_no'];
					if(!file_exists($thumb_file_list)){
						$gd = gd_info();		// gd lib 체크
						$gdversion = substr(preg_replace("/[^0-9]/", "", $gd['GD Version']), 0, 2); // gd 버전이 2.0 이상인지 체크
						if(!$gdversion){ 
							$thumb_file_list = $src; // gd 2.0 이하면 강제적으로 줄임
						}else{
							if($get_img[0] <= $re_img_width){
								$thumb_file_list = $src;
								$img_height = $re_img_height;
								$img_width = $re_img_width;
							}else{
								// 정비율
								if ($get_img[0] >= $re_img_width){
									$rate = $re_img_width / $get_img[0];
									$img_width = $re_img_width;
									$img_height = (int)($get_img[1] * $rate);
								}

								// 섬네일 파일 체크
								if(!file_exists($thumb_file_list)){
									$utility->createThumb_list(187,170,$src, $thumb_file_list); // list 페이지 썸네일
								}
							}
						}
					}

					$img = $thumb_file_list;

				} else {

					$img = "../images/basic/img_01.gif";

				}

			} else {

				$img = ($_img[1]) ? $_img[1] : "../images/basic/img_01.gif";	// 169 x 100

			}

			$datetime3 = strtr(substr($val['datetime3'],0,11),'-','.');		
		?>
		<tr>
			<td class="tl pl10"><span><?php echo $datetime3;?></span></td>
			<td class="tl">
				<dl>
					<dt><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $code;?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $val['wr_no'];?>"> <?php echo stripslashes($val['subject']);?> </a></dt>
					<dd class="content">
						<a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $code;?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $val['wr_no'];?>"> <?php echo $val['content'];?> </a>
					</dd>
					<dd class="image"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $code;?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $val['wr_no'];?>"><img class="vm" src="<?php echo $img;?>"/></a></dd>
				</dl>
			</td>
			<td class="tc"><?php echo $level_icon; ?><span><?php echo $val['name'];?></span></td>
			<td class="tr pr15"><span><?php echo $val['hit'];?></span></td>
		</tr>
		<?php 
			} // foreach end.
		} //  if end.
		?>
		</tbody>
		</table>
		</div>
		<?php if(empty($wr_no)){ ?>
		<div class="btnBottom mt10 clearfix">
			<a class="fr button white" href="<?php echo $write_href;?>"><span>글쓰기</span></a> 
		</div>
		<?php } ?>
		<?php include_once $alice['include_path'] . "/paging.php"; ?>
	</div>
</div>
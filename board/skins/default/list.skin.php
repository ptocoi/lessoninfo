<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var page_rows = function(sels){	// 출력 갯수
}
var boardList_submit = function(){
	$('#boardListFrm').submit();
}
</script>
<div class="rightWrap mt20 mb30">
	<h2 class="skip"><?php echo $bo_subject;?></h2>
	<div class="community positionR">
		<?php if(empty($wr_no)){ ?>
		<h3 class="pb5 pl5 h3">
			<img class="" src="../images/icon/icon_star1.gif" width="18" height="17" alt=""> <strong><?php echo $bo_subject;?></strong>
		</h3>
		<?php } ?>
		<div class="mainTopBorder positionR mt20 clearfix" id="listForm">

		<?php if(empty($wr_no)){ ?>
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
					<select class="ipSelect2" style="width:70px;" id="search_field" name="search_field" title="검색선택">
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
		<?php }	 // wr_no empty if end. ?>

			<table cellspacing="0" >
			<colgroup><col width="110px"><col width="*"><col width="100px"><col width="100px"></colgroup>
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
				foreach($list as $val){
				$wr_category = $category_control->get_categoryCode($val['wr_category']);
				$datetime = strtr($val['datetime'],'-','.');

				//2016-04-22 회원등급 아이콘 작업 추가됨
				$wr_id = $val['wr_id'];
				$wr_member = $member_control->get_member($wr_id);
				$mb_level = $wr_member['mb_level'];				
				$mb_level_cate = $category_control->get_categoryRank($mb_level," and `type` =  'mb_level' ");
				$img_src = explode('/',$mb_level_cate['etc_1']);
				$level_icon_sum = ($mb_level_cate['etc_1']) ? "http://".$_SERVER['HTTP_HOST'] . "/data/peg/" . $img_src[0]. "/".$img_src[1] : "";
				$level_icon = $mb_level ? "<img src='".$level_icon_sum."' class='vm'/>":"";	

				if($val['is_notice']){
			?>
			<tr class="notice">
				<td class="tl pl10"><span style="font-weight:bold;"><img class="vm" src="../images/icon/icon_notice1.gif" alt="공지"></span></td>
				<td class="tl">
					<span><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $code;?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $val['wr_no'];?>" style="font-weight:bold;"><?php echo stripslashes($val['subject']);?>
					<?php if($val['comment_cnt'] && $is_comment_write){ ?><em class="pl10 replyBtn"><img width="11" height="9" alt="댓글" src="../images/icon/icon_reply1.gif" class="vm bg_blue4 mr3">(<?php echo $val['comment_cnt'];?>)</em><?php } // 코멘트 ?>
					</a></span>
					<?php if($val['icon_new']){ ?><img src="../images/ic/new.gif"><?php } ?>
				</td>
				<td class="tc"><span><?php echo $val['name'];?></span></td>
				<td class="tr pr15"><span><?php echo $val['hit'];?></span></td>
			</tr>
			<?php } else { ?>
			<tr>
				<td class="tl pl10"><span><?php echo $datetime;?></span></td>
				<td class="tl">
					<?php if($val['wr_category']){?><b class="fon11">[<?php echo stripslashes($wr_category['name']);?>]</b><?php } ?>
					<?php
						echo $nobr_begin;
						echo $val['reply']; // 간격은 스페이스바 2칸 정도?
						echo $val['icon_reply'];
					?>
					<span><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $code;?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $val['wr_no'];?>"><?php echo stripslashes($val['subject']);?>
					<?php if($val['comment_cnt'] && $is_comment_write){ ?><em class="pl10 replyBtn"><img width="11" height="9" alt="댓글" src="../images/icon/icon_reply1.gif" class="vm bg_blue4 mr3">(<?php echo $val['comment_cnt'];?>)</em><?php } ?>
					</a></span>
					<?php if($val['icon_secret']){ ?><img src="../images/ic/lock.gif"><?php } ?>
					<?php if($val['icon_file']){ ?><img src="../images/ic/file.gif"><?php } ?>
					<?php if($val['icon_img']){ ?><img src="../images/ic/pic.gif"><?php } ?>
					<?php if($val['icon_new']){ ?><img src="../images/ic/new.gif"><?php } ?>
				</td>
				<td class="tc"><?php echo $level_icon; ?><span><?php echo $val['name'];?></span></td>
				<td class="tr pr15"><span><?php echo $val['hit'];?></span></td>
			</tr>
			<?php 
					}	// is notice if end.
				}	// foreach end.
			}	// if end.
			?>
			</tbody>
			</table>
		</div>
		<?php if(empty($wr_no) && $write_href){ ?>
		<div class="btnBottom mt10 clearfix">
			<a class="fr button white" href="<?php echo $write_href;?>"><span>글쓰기</span></a> 
		</div>
		<?php } ?>
		<?php include_once $alice['include_path'] . "/paging.php"; ?>
	</div>
</div>
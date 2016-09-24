<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<script>
// 삭제 검사 확인
function del(href) {
	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
		document.location.href = encodeURI(href);
	}
}

</script>
<div class="rightWrap mt20 mb30">
	<h2 class="skip"><?php echo $bo_subject;?></h2>
	<div class="community positionR">
		<h3 class="pb5 pl5 h3">
			<img class="" src="../images/icon/icon_star1.gif" width="18" height="17" alt=""> <strong><?php echo $bo_subject;?></strong>
		</h3>
		<div class="mainTopBorder positionR mt20 clearfix" id="viewForm">

			<div class="titleA pt15 pl15 pb10 pr15 clearfix">
				<h4 class="pb5"><?php echo $view['subject'];?> </h4>
				<ul class="wInfo">
					<li class="BgNo name"><?php echo $view['name'];?></li>
					<li class="date"><?php echo $datetime;?></li>
				</ul>
				<ul class="cInfo2 fr">
				<li class="BgNo">추천<span class="pl5 ansCount"><?php echo $view['wr_good'];?></span></li>
				<li>댓글<span class="pl5"><?php echo $view['wr_comment'];?></span></li>
				<li>조회<span class="pl5"><?php echo $view['wr_hit'];?></span></li>
				</ul>
			</div> 

			<?php if($view['file']['count']){ ?>
			<dl class="f11 psr mt7 dot psr" style="background-position:bottom;padding:5px 0 7px 5px">
			<table>
			<?php
				// 가변 파일
				$cnt = 0;
				for ($i=0; $i<$view['file']['count']; $i++) {
					if ($view['file'][$i]['source'] && !$view[file][$i]['view']) {
						$cnt++;
						echo "<tr><td>&nbsp;&nbsp;<img src='../images/ic/file.gif' align=absmiddle border='0'>";
						echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'>";
						echo "&nbsp;<span style=\"color:#888;\">{$view[file][$i][source]} ({$view[file][$i][size]})</span>";
						echo "&nbsp;<span style=\"color:#ff6600; font-size:11px;\">[{$view[file][$i][download]}]</span>";
						echo "&nbsp;<span style=\"color:#d3d3d3; font-size:11px;\">DATE : {$view[file][$i][datetime]}</span>";
						echo "</a></td></tr>";
					}
				}
			?>
			</table>
			</dl>
			<?php } ?>
			
			<!-- 내용 -->
			<div class="editorView">
				<?php
				// 파일 출력
				for ($i=0; $i<=$view['file']['count']; $i++) {	// 이미지의 경우 그냥 출력한다.
					if ($view['file'][$i]['view']) 
					echo $view['file'][$i]['view'] . "<br/><br/>";
				}
				?>
				<span id="writeContents"><?php echo $view['content'];?></span>
			</div>
			<!-- //내용 -->

		</div>

		<div class="btnBottom mt10 mb50 clearfix">
			<span class="fl">
			<a class=" button white" href="<?php echo $list_href;?>"><span>목록보기</span></a>
			<a class=" button white" href="<?php echo $delete_href;?>"><span>삭제</span></a>
			<a class=" button white" href="<?php echo $update_href;?>"><span>수정</span></a>
			</span>
			<span class="fr">
			<a class=" button white" href="<?php echo $write_href;?>"><span>글쓰기</span></a>
			<a class=" button white" onclick="is_good('good');"><span>추천</span></a> 
			</span>
		</div>

		<?php include_once "./view_comment.php"; ?>

		<?php // 하단 게시글 리스트
			if($board['bo_use_list_view']){
				$page = ($page) ? $page : 1;
				$page_rows = ($page_rows) ? $page_rows: $board['bo_page_rows'];
				$sorting = ($board_sort) ? "&board_sort=" . $board_sort . "&board_flag=desc&" : "";
				$con = " where `wr_is_comment` = 0 ";
				$list_row = $board_control->__TableList($bo_table,$page,$page_rows,$con);
				$pages = $utility->user_get_paging($page_rows, $page, $list_row['total_page'],"./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&".$sorting."page_rows=".$page_rows."&".$list_row['send_url']."&page=");

				$list = array();
				$i = 0;
				/* 공지사항 리스트 */
				$arr_notice = explode("\n", trim($board['bo_notice']));
				$notice_cnt = count($arr_notice);
				for($n=0;$n<$notice_cnt;$n++){
					if (trim($arr_notice[$n])=='') continue;
					// 공지사항 리스트
					$notices = $board_control->get_boardArticle( $bo_table, " where `wr_no` = '".$arr_notice[$n]."' order by `wr_no` desc ");
					$list[$i] = $board_control->get_list( $notices, $board, $board_skin, $board['bo_subject_len'] );
					$list[$i]['is_notice'] = true;
				$i++;
				}
				/* //공지사항 리스트 */
				/* 게시물 리스트 */
				$n = 0;
				foreach($list_row['result'] as $val){	// 리스팅
					$list[$i] = $board_control->get_list($val, $board, "./skins/board/" . $board['bo_skin'], $board['bo_subject_len'] );
					$list[$i]['subject'] = $utility->search_font($search_keyword, $list[$i]['subject']);
					$list[$i]['is_notice'] = false;
					$list[$i]['num'] = $list_row['total_count'] - ($page - 1) * $board['bo_page_rows'] - $n;
					$len = strlen($val['wr_reply']);
					if($len < 0):
						$len = 0;
					endif;
					$reply = substr($val['wr_reply'], 0, $len);
					$list[$i]['reply_cnt'] = $db->_queryR(" select count(*) from `".$alice['write_prefix'].$board['bo_table']."` where `wr_reply` like '".$reply."%' and `wr_no` <> '".$val['wr_no']."' and `wr_num` = '".$val['wr_num']."' and `wr_is_comment` = 0 ");

				$i++;
				$n++;
				}
				/* //게시물 리스트 */
				if(is_file($alice['self'] . 'skins/'.$board['bo_skin'].'/list.skin.php'))
					include_once $alice['self'] . 'skins/'.$board['bo_skin'].'/list.skin.php';
				else
					$config->error_info( $alice['self'] . 'skins/'.$board['bo_skin'].'/list.skin.php' );		
			}
		?>

	</div>
</div>

<script>
function file_download(link, file) {
    document.location.href=link;
}
window.onload=function() {
    resizeBoardImage(<?php echo $board[bo_image_width];?>);
}
var is_good = function( good ){

	$.post("./process/good.php", { ajax:'true', good:good, board_code:"<?php echo $board_code;?>", code:"<?php echo $code;?>", bo_table:"<?php echo $bo_table;?>", wr_no:"<?php echo $wr_no;?>" }, function(result){

		switch(result){
			case '0046': alert("<?php echo $board_control->_errors('0046'); ?>"); break;
			case '0047': alert("<?php echo $board_control->_errors('0047'); ?>"); break;
			case '0048': alert("<?php echo $board_control->_errors('0048'); ?>"); break;
			case '0049': alert("<?php echo $board_control->_errors('0049'); ?>"); break;
			case '0050': alert("<?php echo $board_control->_errors('0050'); ?>"); break;
			case '0051': alert("<?php echo $board_control->_errors('0051'); ?>"); break;
			case '0052': alert("<?php echo $board_control->_errors('0052'); ?>"); break;
			default :
				alert(result);
			break;
		}

	});
}
</script>
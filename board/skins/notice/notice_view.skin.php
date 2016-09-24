<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['board_path'] . "/views/_include/left_navi.php"; ?>
		<div id="rightContent"> 
			<?php /* navigation */ ?>
			<div class="NowLocation mt35 clearfix">
				<p> <a href="/">HOME</a> > <strong>공지사항</strong> </p>
			</div>
			<?php /* //navigation */ ?>

			<div class="rightWrap mt20 mb30">
				<h2 class="skip">공지사항</h2>
				<div class="community positionR">
					<h3 class="pb5 pl5 h3">
						<img class="" src="../images/icon/icon_star1.gif" width="18" height="17" alt=""> <strong>공지사항</strong>
					</h3>
					<div class="mainTopBorder positionR mt20 clearfix" id="viewForm">
						<div class="titleA pt15 pl15 pb10 pr15 clearfix">
							<h4 class="pb5"><?php echo $wr_type;?><?php echo stripslashes($notice['wr_subject']);?></h4>
							<ul class="wInfo">
								<li class="BgNo name"><?php echo stripslashes($notice['wr_name']);?></li>
								<li class="date"><?php echo substr($notice['wr_date'],0,16);?></li>
							</ul>
							<ul class="cInfo2 fr">
								<li>조회<span class="pl5"><?php echo number_format($notice['wr_hit']);?></span></li>
							</ul>
						</div> 
						<?php if($wr_file_cnt){ ?>
							<dl class="f11 psr mt7 dot psr" style="background-position:bottom;padding:5px 0 7px 5px">
							<table>
							<?php 
							for($i=0;$i<$wr_file_cnt;$i++){ 
							$yms = str_replace('-','',substr($notice['wr_date'],2,5));
							?>
							<tr>
								<td>첨부파일 : <a href="javascript:file_download('<?php echo $alice['data_notice_path']."/".$yms."/".$wr_file[$i];?>');" class="text_blue3"><?php echo $utility->str_cut($wr_file[$i],100);?></a></td>
							</tr>
							<?php } ?>
							</table>
							</dl>
						<?php } ?>
						<div class="editorView"><?php echo stripslashes($notice['wr_content']);?></div>
					</div>

					<div class="btnBottom mt10 mb50 clearfix">
						<span class="fl">
							<a class=" button white" href="./notice_list.php"><span>목록보기</span></a>
						</span>
					</div>

					<?php include_once $alice['include_path']."/paging.php";?>
				</div>
			</div>
		</div>
	</div> 
</section>
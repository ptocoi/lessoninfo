<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div id="leftmenu" class="clearfix">
<!--  커뮤니티 layout  --> 
<div class="mt20" style="display:block;">
    <ul>
        <li class="keywordLeft <?php echo ($type=='all'||$type=='')?'on':'';?>">
			<a href="<?php echo $alice['main_path'];?>/search.php?mode=search&search_keyword=<?php echo urlencode($search_keyword);?>">
			<h2><img width="59" height="17" alt="통합검색" src="../images/main/btn_nav_14.png"></h2>
			</a>
        </li>
        <li class="keywordLeft <?php echo ($type=='alba')?'on':'';?>">
			<a href="<?php echo $alice['main_path'];?>/search.php?mode=search&type=alba&search_keyword=<?php echo urlencode($search_keyword);?>">
			<h2><img width="59" height="17" alt="채용정보" src="../images/main/btn_nav_01.png"></h2>
			</a>
        </li>
        <li class="keywordLeft <?php echo ($type=='alba_resume')?'on':'';?>">
			<a href="<?php echo $alice['main_path'];?>/search.php?mode=search&type=alba_resume&search_keyword=<?php echo urlencode($search_keyword);?>">
			<h2 ><img width="59" height="17" alt="인재정보" src="../images/main/btn_nav_02.png"></h2>
			</a>
        </li>
        <li class="keywordLeft <?php echo ($type=='board')?'on':'';?>">
			<a href="<?php echo $alice['main_path'];?>/search.php?mode=search&type=board&search_keyword=<?php echo urlencode($search_keyword);?>">
			<h2><img width="59" height="17" alt="커뮤니티" src="../images/main/btn_nav_06.png"></h2>
			</a>
        </li>
    </ul>
</div>

<div class="mt20 popularity">
	<h2 style="border:1px solid #ddd; background-color:#f5f5f5;height:28px;">
		<img  src="../images/tit/left_tit_04.gif" alt="인기검색어" class="pl10 pt5">
	</h2>
	<ul style="border:1px solid #ddd; margin-top:-1px;" class="pl4 pr4 pt5 pb5">
	<?php 
		foreach($realtime_search as $val){ 
		$search_rank = sprintf('%02d',$val['rank']);
		if($val['rank'] <= 3 ){
			$bg_color = "bg_color4";
		} else if($val['rank'] <= 6){
			$bg_color = "bg_color5";
		} else if($val['rank'] > 6){
			$bg_color = "bg_color8";
		}
	?>
		<li><img width="14" height="14" class="mr5 vb <?php echo $bg_color;?>" src="../images/icon/icon_no_<?php echo $search_rank;?>.png" alt=""><a href="<?php echo $val['wr_url'];?>" <?php if($val['wr_blank']){ ?>target="_blank"<?php } ?>><?php echo stripslashes($val['wr_content']);?></a></li>
	<?php } ?>
	</ul>
</div>


<?php include_once $alice['include_path']."/left_banner.php";	// 서브 좌측 배너 ?>


</div>

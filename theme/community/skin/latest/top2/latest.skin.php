<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

?>
<link rel="stylesheet" href="<?php echo $latest_skin_url ?>/style.top2.css">
<script type="text/javascript">


//네비게이션 레이아웃 적용
 $(document).ready(function(){
	 $("div.layerBox").slideDown();
	 
	 $("#close").click(function() {					
		  $("div.layerBox").slideUp();					
       });
  })

</script>
<div class="layerBox">
  <div class="layerBanner"> 
		<ul style="height:<?=$options[1]?>px;">
<?
for ($i=0; $i<count($list); $i++) { 
	$noimage = "$latest_skin_url/img/no-image.gif";
	$list[$i][file] =get_file($bo_table, $list[$i][wr_id]);
	$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
?>
			<li>
				
					
<?if(strlen($list[$i][wr_link1]) > 0){?><a href="<?=set_http($list[$i][wr_link1])?>"><?}?><img src="<?=$imagepath?>" alt="<?=$list[$i][wr_subject]?>" style='width:<?=$options[0]?>px;height:<?=$options[1]?>px;'><?if(strlen($list[$i][wr_link1]) > 0){?></a><?}?>
<?}?>
			</li>
		</ul>
    <span id="close"><a href="#"><img src="<?php  echo $latest_skin_url ?>/img/btn_top_close.gif" width="41" height="41" alt="닫기" /></a></span>
  </div>
</div>
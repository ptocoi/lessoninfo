<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

?>
<link rel="stylesheet" href="<?php echo $latest_skin_url ?>/style.top5.css">
<script type="text/javascript" src="<?php echo $latest_skin_url ?>/jquery.cookie.js"></script>

<script type="text/javascript">
	function tick2(){
		$('#ticker_02 li:first').slideUp( function () { $(this).appendTo($('#ticker_02')).slideDown(); });
	}
	setInterval(function(){ tick2 () }, 3000);
</script>

<script type="text/javascript">

// 메인 탑배너 쿠키 적용
 $(document).ready(function(){
	if( $.cookie("show_popup") == "false" ) close_popup(); // show_popup의 값이 false이면 배너창을 닫도록한다
	else $("div.layerBox").slideDown();// 그렇지않으면 배너창이 표시되도록한다
 })
 /* 배너창을 보이지 않도록하는 함수(이 함수는 닫기링크를 클릭했을 때, 오늘하루 보이지 않음링크를 클릭했을 때 호출되는 함수) */
 function close_popup() {
	$("div.layerBox").slideUp();
}
/*오늘하루 보이지 않음 링크를 클릭했을 때 호출되는 함수 show_popup 쿠키의 값을 false로 지정하고 유효기간을 하루 뒤로설정하고 배너창을 닫는다*/
function popup_hide_cookie() {
	today = new Date();	
	$.cookie( "show_popup", "false", { path: "/", expires : 1 } );
	close_popup();
}

</script>

<div class="layerBox">
  <div class="layerBanner"> 
	<ul id="ticker_02" style="width:<?=$options[0]?>px;height:<?=$options[1]?>px; position:relative; overflow:hidden; ">
<?
for ($i=0; $i<count($list); $i++) { 
	$noimage = "$latest_skin_url/img/no-image.gif";
	$list[$i][file] =get_file($bo_table, $list[$i][wr_id]);
	$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
?>
<li><?if(strlen($list[$i][wr_link1]) > 0){?><a href="<?=set_http($list[$i][wr_link1])?>"><?}?><img src="<?=$imagepath?>" alt="<?=$list[$i][wr_subject]?>" style='width:<?=$options[0]?>px;height:<?=$options[1]?>px;'><?if(strlen($list[$i][wr_link1]) > 0){?></a><?}?>
</li>
<?}?>
	</ul>
    <span id="close"><a href="javascript:popup_hide_cookie()"><img src="<?php  echo $latest_skin_url ?>/img/btn_top_close.gif" width="41" height="41" alt="닫기" /></a></span>
  </div>
</div>
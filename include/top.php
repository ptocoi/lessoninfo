
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css?t=<?php echo date('YmdH');?>"/>
<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
<?php if($is_popup){?>
var popup_Close = function(no){	// 팝업창 닫기
	var popupToday = $('#popupClose_' + no).is(':checked');	 // 하루동안 열지 않기 체크 유무
	if(popupToday==true)	// 체크 했다면
		$.cookie('popupClose_'+no, popupToday, { expires:1, domain:domain, path:'/', secure:0});	// 쿠키 저장
	$('#popup_' + no).hide();
}
<?php } ?>
</script>

<body>
<?php 
/* Browser checking */
if($ie_version <= 7 && $ie_version != false){	// ie 버전 7 이하일때 ?>
<dl id="tnot">
	<span>사용하시는 브라우저 버전이 너무 낮아 <?php echo $env['site_name'];?> 서비스를 제대로 사용하실 수 없습니다.<br>
	최신브라우저로 업데이트 하여 원활하게 <?php echo $env['site_name'];?> 서비스를 이용하세요~</span>
	<dt class="prb" title="클릭하시면 해당 브라우저 업데이트 페이지로 연결 됩니다.">
		<a href="https://www.google.com/chrome" target="_blank"><img src="../images/ic/chrome.png" class="ml10"></a>
		<a href="http://windows.microsoft.com/ko-KR/internet-explorer/downloads/ie" target="_blank"><img src="../images/ic/ie.png" class="ml10"></a>
		<a href="http://www.apple.com/kr/safari/" target="_blank"><img src="../images/ic/safari.png" class="ml10"></a>
		<a href="http://www.mozilla.or.kr/ko/" target="_blank"><img src="../images/ic/firefox.png" class="ml10"></a>
	</dt>
</dl>
<?php 
} 
/* //Browser checking */ 
?>

<?php 
	if($is_popup) // 팝업 
		$popup_control->get_PopList($page_name);

	include_once $alice['main_path'] . "/skins/".$menu_skin."/top.skin.php";	// 상단 TOP 스킨을 불러온다.
?>
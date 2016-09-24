<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<body>

<script>
$(function(){
	$(":input[placeholder]").placeholder();
});
window.resizeTo(620,180)
</script>

<div id="popup" class="positionR content_wrap clearfix">
	<div class="popupLoginBox" style="display:block; width:620px; height: 200px; margin:0 auto; text-align:left; ">
		<div style="margin-left:160px;width:480px;margin-top:30px;">문의하신 아이디는 [<strong class="col"><?php echo $mb_id;?></strong>] 입니다.</div><br/><br/>
		<div style="margin-left:40px;width:600px;">자세한 정보는 고객님의 이메일 <strong><?php echo $member_info['mb_email'];?></strong> 로 발송 되었으니 확인하시기 바랍니다</div>
	</div>
</div>
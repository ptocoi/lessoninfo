<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div class="rightWrap mt20 mb30">
	<h2 class="skip">패스워드</h2>
	<div class="community positionR">

	<form name="boardPasswordFrm" method="post" id="boardPasswordFrm" action="<?php echo $action;?>" onsubmit="return validate(this);">
	<input type="hidden" name="mode" value="<?php echo $mode?>"/>
	<input type="hidden" name="board_code" value="<?php echo $board_code?>"/>
	<input type="hidden" name="code" value="<?php echo $code?>"/>
	<input type="hidden" name="bo_table" value="<?php echo $bo_table?>"/>
	<input type="hidden" name="wr_no" value="<?php echo $wr_no;?>"/>
	<input type="hidden" name="comment_id" value="<?php echo $comment_id;?>"/>
	<input type="hidden" name="token" value="<?php echo $token;?>"/>

	<!--  패스워드확인   -->            
	<div style="width:60%;margin:100px auto 20px;" class="passwordBox positionR clearfix" >
		<dl class="BoxWrap clearfix">
			<dt class="tc">선택한 게시물의 패스워드를 입력해주세요.</dt>
			<dd class="tc">
				<span class="pr3">
				<label style="font-weight:bold;" class="pr5">입력한 패스워드</label>
					<input type="password" name="wr_password" id="password_wr_password" class="ipText2" style="width:110px;" hname='패스워드' required>
				</span>
				<span class="btn"><a class="text_color1 bg_color2 border_color1 tc" onclick="boardPasswordFrm_submit();" style="cursor:pointer;">확인</a></span> 
			</dd>
		</dl> 
	</div>
	<!--  패스워드확인 //  -->

	</form>

	</div>
</div>

<script>
var boardPasswordFrm_submit = function(){
	$('#boardPasswordFrm').submit();
}
</script>
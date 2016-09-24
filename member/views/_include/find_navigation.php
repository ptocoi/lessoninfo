<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

	<div class="secNav mt10 clearfix">
		<ul>
			<li class="mn1 <?php echo ($navi_page=='find_id')?'on':'';?>"><a href="./find_id.php"><em><img src="../images/basic/img_step7_<?php echo ($navi_page=='find_id')?'on':'off';?>.png" width="69" height="31" alt="step1"></em><img src="../images/basic/img_tit_search_step1_<?php echo ($navi_page=='find_id')?'on':'off';?>.png" width="84" height="19" alt="아이디찾기"></a></li>
			<li class="mn2 <?php echo ($navi_page=='find_pw')?'on':'';?>"><a href="./find_pw.php"><em><img src="../images/basic/img_step8_<?php echo ($navi_page=='find_pw')?'on':'off';?>.png" width="69" height="31" alt="step2"></em><img src="../images/basic/img_tit_search_step2_<?php echo ($navi_page=='find_pw')?'on':'off';?>.png" width="100" height="19" alt="비밀번호찾기"></a></li>
			<li class="mn3 Rend"></li>
		</ul>
	</div>

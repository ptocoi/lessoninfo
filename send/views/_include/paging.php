<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<tr>
	<td height="40" align="center" class="pb15" colspan="2">
		<div class="paging">
			<span class="page ">
			<?php
				$pages = str_replace("처음", "&lt;&lt;", $pages);
				$pages = str_replace("이전", "&lt;", $pages);
				$pages = str_replace("다음", "&gt;", $pages);
				$pages = str_replace("맨끝", "&gt;&gt;", $pages);
				$pages = preg_replace("/<b>([0-9]*)<\/b>/", "$1", $pages);
				echo $pages;
			?>
			</span>
		</div>
	</td>
</tr>
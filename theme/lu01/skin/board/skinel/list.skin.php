<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

include_once "inc/inc.list.php";
?>

<?php gp_do_action('sl_before_list'); ?>

<?php if($sl_no_list) return; ?>

<?php if(!$wr_id) { ?>
<link rel="stylesheet" href="<?php echo $board_skin_url;?>/style.css.php?bo_table=<?php echo $bo_table;?>" type="text/css"/>
<?php } ?>

<div class="skin_l<?php echo (G5_IS_MOBILE ? ' skin_l_mobile' : '');?> theme_<?php echo $sl_theme->theme;?> skin_<?php echo $sl_skin->skin;?> skin_l_g5">

<div id="skin_l_list" style="width:<?php echo $width;?>">

	<?php gp_do_action('sl_list_before_top'); ?>

	<div class="sll_top">

    <?php
    if ($is_category) { 
      $categories = explode('|', $board['bo_category_list']);
    ?>
    <div class="sll_tab">
      <ul>
        <?php gp_do_action('sl_list_first_category_item'); ?>
        <li <?php if (!$sca) echo "class=\"on\"";?>><a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>">전체</a></li>
        <?php      
        for($i=0, $to=count($categories); $i<$to; $i++) {
          $cls = ( $i==$to-1 ? 'last' : '' );
          $cls .= ($categories[$i] == $sca ? ' on' : '');
          if($cls) $cls = ' class = "'.$cls.'"';
          ?>
        <li<?php echo $cls;?>><a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>&sca=<?php echo urlencode($categories[$i]);?>"><?php echo $categories[$i];?></a></li>
        <?php } ?>
        <?php gp_do_action('sl_list_last_category_item'); ?>
      </ul>
    </div>
    <select name="sca" class="sll_category">
    <option value="">전체</option>
    <?php for($i=0, $to=count($categories); $i<$to; $i++) {
    echo '<option>'.$categories[$i].'</option>';
    } ?>
      
    </select> 
    <?php } ?>
		
		<div class="sll_total">
			<span class="total_count">글 <span class="number"><?php echo number_format($total_count);?></span> 개</span>
        <?php if ($rss_href) { ?>
        <a href="<?php echo $rss_href;?>">
          <img src="<?php echo $board_skin_url;?>/img/btn_rss.gif" border="0" align="absmiddle">
        </a>
        <?php }?>
		</div>

	</div>

	<?php gp_do_action('sl_list_after_top'); ?>

	<?php gp_do_action('sl_list_before_body'); ?>

	<div class="sll_body">

		<form name="fboardlist" method="post">
		<input type="hidden" name="bo_table" value="<?=$bo_table?>">
		<input type="hidden" name="sfl"  value="<?=$sfl?>">
		<input type="hidden" name="stx"  value="<?=$stx?>">
		<input type="hidden" name="spt"  value="<?=$spt?>">
		<input type="hidden" name="page" value="<?=$page?>">
		<input type="hidden" name="sw"   value="">

		<?php gp_do_action('sl_list_hidden_form'); ?>
		
		<?php gp_print('class="sll_list_head"', $list_head); ?>

		<?php
		for($i=0, $to=count($list); $i<$to; $i++) {
			$row = $list[$i];
			$cls = ($i % 2) + 1;
			$row_class = "sll_row sll_row_".$cls.($row['is_notice'] ? ' sll_row_notice' : '').($wr_id == $row['wr_id'] ? ' sll_row_current' : ''); 
			gp_print('class="'.$row_class.'"', $list_items, 'li', $row);
		}
	
		if(empty($list)) {
			echo '<div class="empty_list">게시물이 없습니다.</div>';
		} 
		?>
		</form>
	</div> <!--// sll_body -->

	<?php gp_do_action('sl_list_after_body'); ?>	

	<?php gp_do_action('sl_list_before_tail'); ?>	
	<div class="sll_tail">

		<?php gp_do_action('sl_list_before_user_menu'); ?>
		<div class="sll_user_menu">

			<?php gp_do_action('sl_list_before_search'); ?>
			<div class="sll_search">
				<form name="fsearch" method="get">
				<input type="hidden" name="bo_table" value="<?=$bo_table?>">
				<input type="hidden" name="sca"      value="<?=$sca?>">
        <label for="slt_sfl" class="sound_only">검색필드 선택</label> 
				<select name="sfl" id="slt_sfl">
					<?php
					foreach($search_options as $sopt) {
						echo '<option value="'.$sopt['value'].'">'.$sopt['text'].'</option>';
					}
					?>
				</select>
        <label for="input_stx" class="sound_only">검색어</label> 
				<span><input type="text" class="sll_search_txt" id="input_stx" name="stx" placeholder="Search..." maxlength="15" itemname="검색어"  value="<?php stripslashes($stx);?>"></span>
				<span><input type="image" class="sll_search_btn" src="<?=$board_skin_url?>/img/search.png" alt="검색하기 버튼"/></span>
				</form>
			</div>

			<?php gp_do_action('sl_list_after_search'); ?>

			<?php gp_do_action('sl_list_before_command'); ?>

			<?php gp_print(array('ul', 'class="sll_command"'), $list_buttons); ?>

			<?php gp_do_action('sl_list_after_command'); ?>

		</div> <!--// sll_user_menu -->		

		<?php gp_do_action('sl_list_after_user_menu'); ?>

		<?php gp_do_action('sl_list_before_paging'); ?>
		<div class="board_page">
			<?php if ($prev_part_href) { echo "<a href=\"$prev_part_href\">이전검색</a>"; } ?>
			<?php
			$write_pages = str_replace("&nbsp;", "", $write_pages);
			echo sl_bootstrap_paging($write_pages);
			?>
			<?php if ($next_part_href) { echo "<a href=\"$next_part_href\">다음검색</a>"; } ?>
		</div> <!--// board_page -->
		<?php gp_do_action('sl_list_after_paging'); ?>
	
    <?php 
    if($is_admin) {
		  gp_do_action('sl_list_before_admin_menu');
		  gp_print(array('ul', 'class="sll_admin_menu"'), $list_admin_menu);
		  gp_do_action('sl_list_after_admin_menu');
    } 
    ?>
	</div> <!--// sll_tail -->

	<?php gp_do_action('sl_list_after_tail'); ?>

</div> <!--// skin_l_list -->

</div><!--// skin_l -->

<?php gp_do_action('sl_after_list'); ?>

<?php gp_do_action('sl_list_before_script'); ?>

<script type="text/javascript">
if ('<?php echo $sca; ?>') $('select[name=sca]').val('<?php echo $sca; ?>');
if ('<?php echo $stx; ?>') {
    document.fsearch.sfl.value = '<?php echo $sfl;?>';
}
$('select[name=sca]').change(function() {
  location.href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>&sca="+$(this).val();
});
</script>

<?php if ($is_checkbox) { ?>
<script type="text/javascript">
function all_checked(sw) {
  var f = document.fboardlist;
  for (var i=0; i<f.length; i++) {
    if (f.elements[i].name == "chk_wr_id[]")
    f.elements[i].checked = sw;
  }
}
function check_confirm(str) {
  var f = document.fboardlist;
  var chk_count = 0;

  for (var i=0; i<f.length; i++) {
    if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
      chk_count++;
  }

  if (!chk_count) {
    alert(str + "할 게시물을 하나 이상 선택하세요.");
    return false;
  }
  return true;
}

// 선택한 게시물 삭제
function select_delete() {
  var f = document.fboardlist;
  str = "삭제";
  if (!check_confirm(str)) return;
  if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다")) return;
  f.action = "./delete_all.php";
  f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
  var f = document.fboardlist;
  if (sw == "copy") str = "복사";
  else str = "이동";
  if (!check_confirm(str)) return;
  var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
  f.sw.value = sw;
  f.target = "move";
  f.action = "./move.php";
  f.submit();
}
</script>
<?php } ?>
<!--// 게시판 목록 끝 -->

<?php gp_do_action('sl_list_after_script'); ?>

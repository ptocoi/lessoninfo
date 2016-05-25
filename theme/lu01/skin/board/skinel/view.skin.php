<?php 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

include_once "inc/inc.view.php";
?>

<?php gp_do_action('sl_before_view'); ?>

<?php if ($sl_no_view) return; ?>

<link rel="stylesheet" href="<?php echo $board_skin_url;?>/style.css.php?bo_table=<?php echo $bo_table;?>" type="text/css">

<div class="skin_l<?php echo (G5_IS_MOBILE ? ' skin_l_mobile' : '');?> theme_<?php echo $sl_theme->theme;?> skin_<?php echo $sl_skin->skin;?> skin_l_g5">

  <div id="skin_l_view" style="width:<?php echo $width;?>;">

    <?php gp_do_action('sl_view_before_top'); ?>
    <div class="slv_top">
      <div class="slv_top_menu slv_menu">
        <?php gp_print(array('ul', 'class="slv_left_menu"'), $view_menu1); ?>
        <?php gp_print(array('ul', 'class="slv_right_menu"'), $view_menu2); ?>
      </div>  <!--// slv_menu -->
    </div> <!--// slv_top -->
    <?php gp_do_action('sl_view_after_top'); ?>

    <?php gp_do_action('sl_view_before_body'); ?>
    <div class="slv_body">

      <?php gp_do_action('view_before_title'); ?>
      <div class="slv_title">

        <div class="slv_profile">
          <?php
          if ($member['mb_id'] && $member['mb_id'] == $view['mb_id']) echo '<a href="javascript:member_photo();">';
          else echo '<a href="javascript:;">';
          ?>
          <img src="<?php echo $mb_photo_url;?>" border="0" class="slv_mb_photo"/>
          </a>
        </div>

        <h1>
          <?php if ($is_category) {
            echo ($category_name ? "[{$view['ca_name']}] " : "");
          } ?>
          <?php echo cut_hangul_last(get_text($view['wr_subject'])); ?>
        </h1>

        <?php gp_print(array('ul', 'class="slv_info"'), $view_info); ?>

      </div>  <!--// slv_title -->
      <?php gp_do_action('sl_view_after_title'); ?>

      <?
      // 가변 파일
      $cnt = 0;
      ob_start();
        for ($i = 0; $i < count($view['file']); $i++) {
          if ($view['file'][$i]['source'] && !$view['file'][$i]['view']) 
          {
            $cnt++;
            echo "<div class=\"slv_file\"><img src=\"{$board_skin_url}/img/icon_file.gif\" align=\"absmiddle\" border=\"0\">";
            echo "<a href=\"javascript:file_download('{$view['file'][$i]['href']}&js=on', '" . urlencode($view['file'][$i]['source']) . "');\" title=\"{$view['file'][$i]['content']}\">";
            echo "&nbsp;{$view['file'][$i]['source']} ({$view['file'][$i]['size']})";
            echo "&nbsp;<span class=\"download\">[{$view['file'][$i]['download']}]</span>";
            echo "&nbsp;<span class=\"date\">{$view['file'][$i]['datetime']}</span>";
            echo "</a></div>";
          }
        }
      $out = ob_get_contents();
      ob_end_clean();
      if ($cnt > 0) { ?>
        <?php gp_do_action('sl_view_before_files'); ?>
        <div class="slv_files">
          <h2>첨부파일</h2>
          <?php echo $out ?>
        </div>
        <?php gp_do_action('sl_view_after_files'); ?>
      <?php } ?>

      <?php
      // 링크
      $cnt = 0;
      ob_start();
        for ($i = 1; $i <= G5_LINK_COUNT; $i++) {
          if ($view['link'][$i]) 
          {
            $cnt++;
            $link = cut_str($view['link'][$i], 70);
            echo "<div class=\"slv_link\">";
            echo "<img src=\"{$board_skin_url}/img/icon_link.gif\" align=\"absmiddle\" border=\"0\">";
            echo "<a href=\"{$view['link_href'][$i]}\" target=\"_blank\">";
            echo "&nbsp;{$link}";
            echo "&nbsp;<span class=\"hit\">[{$view['link_hit'][$i]}]</span>";
            echo "</a></div>";
          }
        }
      $out = ob_get_contents();
      ob_end_clean();
      if ($cnt > 0) { ?>
        <?php gp_do_action('sl_view_before_links'); ?>
        <div class="slv_links">
          <h2>관련링크</h2>
          <?php echo $out; ?>
          <?php unset($out); ?>
        </div>
        <?php gp_do_action('sl_view_after_links'); ?>
      <?php } ?>

      <?php gp_do_action('sl_view_before_contents'); ?>
      <div class="slv_contents">

        <?php gp_do_action('sl_view_before_image_print'); ?>
        <?php
        // 파일 출력
        for ($i = 0; $i <= count($view['file']); $i++) 
        {
            if ($view['file'][$i]['view'])
                echo $view['file'][$i]['view'] . "<p>";
        }
        ?>
        <?php gp_do_action('sl_view_after_image_print'); ?>


        <?php gp_do_action('sl_view_content_top'); ?>
        <span id="writeContents"><?php echo $view['content']; ?></span>			
        <?php gp_do_action('sl_view_content_bottom'); ?>

        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a>

      </div> <!--// slv_contents -->
      <?php gp_do_action('sl_view_after_contents'); ?>

      <?php gp_do_action('sl_view_before_contents_menu'); ?>
      <div class="slv_contents_menu">
        <div class="slv_menu">
          <?php gp_print(array('ul', 'class="slv_left_menu"'), $view_menu3); ?>
          <?php gp_print(array('ul', 'class="slv_right_menu"'), $view_menu4); ?>
        </div>  <!--// slv_menu -->		
      </div> <!--// slv_contents_menu -->
      <?php gp_do_action('sl_view_after_contents_menu'); ?>

      <?php gp_do_action('sl_view_before_comment'); ?>
      <div id="slv_comments">
        <?php include_once "view_comment.php"; ?>
      </div>
      <?php gp_do_action('sl_view_after_comment'); ?>

    </div> <!--// sl_body -->
    <?php gp_do_action('sl_view_after_body'); ?>

    <?php gp_do_action('sl_view_before_bottom_menu'); ?>
    <div class="slv_bottom_menu slv_menu">
      <?php gp_print(array('ul', 'class="slv_left_menu"'), $view_menu1); ?>
      <?php gp_print(array('ul', 'class="slv_right_menu"'), $view_menu2); ?>
    </div>  <!--// slv_menu -->
    <?php gp_do_action('sl_view_after_bottom_menu'); ?>

  </div> <!--// #skin-l-view -->

</div><!--// skin_l -->
<?php gp_do_action('sl_after_view'); ?>

<?php gp_do_action('sl_view_before_script'); ?>
<script type="text/javascript">
function file_download(link, file) {
  <?php gp_do_action('sl_view_download_script'); ?>
  <?php if ($board['bo_download_point'] < 0) { ?>
    if(confirm("'" + decodeURIComponent(file) + "' 파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))
  <?php } ?>
  document.location.href = link;
}

function board_move(href)
{
  window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

function member_photo()
{
  window.open("<?php echo $board_skin_url;?>/member_photo/member.photo.php?bo_table=<?php echo $bo_table;?>", "회원사진변경", "width=450, height=220, scrollbars=auto, menubar=no");
}

$(document).ready(function() {
  setTimeout(function() {
    var $content = $('.slv_contents');
    var width = $content.width();
    $content.find('img').each(function() { 
      if ( width < $(this).width())
      {
        $(this).css('width', '98%');
      }                
    });
  }, 500);
});
</script>

<?php gp_do_action('sl_view_after_script'); ?>


<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once "inc/inc.write.php";
?>

<?php gp_do_action('sl_before_write'); ?>

<?php if ($sl_no_write) return; ?>

<link rel="stylesheet" href="<?php echo $board_skin_url;?>/style.css.php?bo_table=<?php echo $bo_table;?>" type="text/css">

<div class="skin_l<?php echo (G5_IS_MOBILE ? ' skin_l_mobile' : '');?> theme_<?php echo $sl_theme->theme;?> skin_<?php echo $sl_skin->skin;?> skin_l_g5">

  <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">

    <input type="hidden" name="null"> 
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">

    <?php gp_do_action('sl_write_hidden_forms'); ?>

    <?php gp_do_action('sl_write_before_form_list'); ?>
    <fieldset class="slw_form">
        <legend>글작성</legend>
        <?php gp_print_write($write_items); ?>
    </fieldset>
    <?php gp_do_action('sl_write_after_form_list'); ?>

    <?php gp_do_action('sl_write_before_buttons'); ?>
    <div class="slw_btns">
        <?php gp_print(array('ul', 'class="slw_left_menu"'), $write_menu1); ?>
        <?php gp_print(array('ul', 'class="slw_right_menu"'), $write_menu2); ?>
    </div>
    <?php gp_do_action('write_after_buttons'); ?>

  </form>

</div><!--// skin_l -->
<?php gp_do_action('sl_after_write'); ?>

<?php gp_do_action('sl_write_before_script'); ?>

<script type="text/javascript">

<?php if ($write_min || $write_max) { ?>
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");
$(function() {
  $("#wr_content").on("keyup", function() {
    check_byte("wr_content", "char_count");
  });
});
<?php } ?>

function html_auto_br(obj)
{
  if (obj.checked) {
    result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
    if (result) obj.value = "html2";
    else obj.value = "html1";
  }
  else obj.value = "";
}

function fwrite_submit(f)
{
  <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함     ?>
  var subject = "";
  var content = "";
  $.ajax({
    url: g5_bbs_url + "/ajax.filter.php",
    type: "POST",
    data: {
      "subject": f.wr_subject.value,
      "content": f.wr_content.value
    },
    dataType: "json",
    async: false,
    cache: false,
    success: function(data, textStatus) {
      subject = data.subject;
      content = data.content;
    }
  });

  if (subject) {
    alert("제목에 금지단어('" + subject + "')가 포함되어있습니다");
    f.wr_subject.focus();
    return false;
  }

  if (content) {
    alert("내용에 금지단어('" + content + "')가 포함되어있습니다");
    if (typeof(ed_wr_content) != "undefined") ed_wr_content.returnFalse();
    else f.wr_content.focus();
    return false;
  }

  if (document.getElementById("char_count")) {
    if (char_min > 0 || char_max > 0) {
      var cnt = parseInt(check_byte("wr_content", "char_count"));
      if (char_min > 0 && char_min > cnt) {
        alert("내용은 " + char_min + "글자 이상 쓰셔야 합니다.");
        return false;
      }
      else if (char_max > 0 && char_max < cnt) {
        alert("내용은 " + char_max + "글자 이하로 쓰셔야 합니다.");
        return false;
      }
    }
  }

  <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함    ?>

  document.getElementById("btn_submit").disabled = "disabled";

  return true;
}
</script>
<?php gp_do_action('sl_write_after_script'); ?>

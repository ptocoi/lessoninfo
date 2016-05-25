<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject; ?></a></h3>
  </div>
  <div class="panel-body">

    <ul class="list-group">
    <?php for ($i=0; $i<count($list); $i++) {  ?>

      <li class="list-group-item">
        <?php if($list[$i]['comment_cnt']) { ?>
        <span class="badge"><?php echo $list[$i]['comment_cnt']; ?></span>
        <?php } ?>
        <a href="<?php echo $list[$i]['href']; ?>"><?php echo $list[$i]['subject']; ?></a>
      </li>
    <?php } ?>
    </ul>

  </div>
</div>


<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->

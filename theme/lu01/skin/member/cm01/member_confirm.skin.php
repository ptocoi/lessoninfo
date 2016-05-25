<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원 비밀번호 확인 시작 { -->
<div class="container">
    <h2><?php echo $g5['title'] ?></h2>

    <div class="panel panel-default">
      <div class="panel-body">
        <strong>비밀번호를 한번 더 입력해주세요.</strong>
        <?php if ($url == 'member_leave.php') { ?>
        비밀번호를 입력하시면 회원탈퇴가 완료됩니다.
        <?php }else{ ?>
        회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.
        <?php }  ?>
      </div>
    </div>

    <form role="form" name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post">
    <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
    <input type="hidden" name="w" value="u">

    <div class="form-group">
      <label> 회원아이디</label>
      <div class="form-control-static"><?php echo $member['mb_id'] ?></div>
    </div>
    <div class="form-group">
      <label for="confirm_mb_password">비밀번호<strong class="sound_only">필수</strong></label>
      <input type="password" name="mb_password" id="confirm_mb_password" required class="required form-control" maxLength="20">
    </div>

    <input type="submit" value="확인" id="btn_submit" class="btn btn-primary">

    </form>

    <div class="text-center">
      <a class="btn btn-success btn-xs" href="javascript:history.go(-1);">뒤로</a>
      <a class="btn btn-info btn-xs" href="<?php echo G5_URL ?>">메인으로 돌아가기</a>
    </div>

</div>

<script>
function fmemberconfirm_submit(f)
{
    document.getElementById("btn_submit").disabled = true;

    return true;
}
</script>
<!-- } 회원 비밀번호 확인 끝 -->

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<div class="container">
    <div class="page-header">
      <h1><?php echo $g5['title']; ?> </h1>
    </div>
    <form role="form" name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value='<?php echo $login_url ?>'>

      <div class="form-group">
        <label for="login_id">회원아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="form-control required" maxLength="20">
      </div>
      <div class="form-group">
        <label for="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="form-control required" maxLength="20">
      </div>
      <div class="checkbox">
        <label>
            <input type="checkbox" name="auto_login" id="login_auto_login"> 자동로그인
        </label>
      </div>
      <button type="submit" class="btn btn-primary btn-responsive">로그인</button>
      <div class="pull-right">
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank" id="login_password_lost" class="btn btn-default btn-responsive">아이디 비밀번호 찾기</a>
            <a href="./register.php" class="btn btn-success btn-responsive">회원 가입</a>
      </div>
    </form>
    
    <?php if(function_exists('socialLoginUrls')) { ?>
    <div class="row center-block text-center">
    <br/><br/>
    -- 또는 --
    <br/><br/>
    </div>

    <div class="center-block text-center">
        <p>아래 사이트들을 통한 소셜로그인을 사용하실 수 있습니다.</p>
          <?php
          $loginUrls = socialLoginUrls($set_redirect=true, $redirect_url=urldecode($login_url));
          ?>
            <a href="<?php echo $loginUrls['google'];?>" title="구글로 로그인" class="btn btn-primary btn-responsive"><i class="fa fa-google fa-fw"></i>구글 (Google)</a>
            <a href="<?php echo $loginUrls['facebook'];?>" title="페이스북으로 로그인" class="btn btn-primary btn-responsive"><i class="fa fa-facebook fa-fw"></i>페이스북 (Facebok)</a>
            <a href="<?php echo $loginUrls['twitter'];?>" title="트위터로 로그인" class="btn btn-primary btn-responsive"><i class="fa fa-twitter fa-fw"></i>트위터 (Twitter)</a>
            <a href="<?php echo $loginUrls['kakao'];?>" title="카카오톡 로그인" class="btn btn-primary btn-responsive"><i class="fa fa-user fa-fw"></i>카카오톡 (KakaoTalk)</a>
            <a href="<?php echo $loginUrls['naver'];?>" title="네이버 로그인" class="btn btn-primary btn-responsive"><i class="fa fa-sign-in fa-fw"></i>네이버 (Naver)</a>
    </div>
    <?php } ?>

    <div class="center-block text-center">
      <br/><br/>
      <a class="btn btn-success btn-xs" href="javascript:history.go(-1);">뒤로</a>
      <a class="btn btn-info btn-xs" href="<?php echo G5_URL ?>">메인으로 돌아가기</a>
      <br/><br/>
    </div>

</div>

<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 끝 -->

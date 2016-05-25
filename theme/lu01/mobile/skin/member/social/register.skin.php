<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원가입약관 동의 시작 { -->
<div class="container">
  <form  role="form" name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">

    <div class="alert alert-info" role="alert">회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.</div>

    <h2>회원가입약관</h2>
    <textarea readonly class="form-control" rows="5"><?php echo get_text($config['cf_stipulation']) ?></textarea>
    <div class="checkbox">
        <label for="agree11">
         <input type="checkbox" name="agree" value="1" id="agree11">
          회원가입약관의 내용에 동의합니다.
        </label>
    </div>

    <h2>개인정보처리방침안내</h2>
    <textarea readonly class="form-control" rows="5"><?php echo get_text($config['cf_privacy']) ?></textarea>
    <div class="checkbox">
        <label for="agree21">
         <input type="checkbox" name="agree2" value="1" id="agree21">
          개인정보처리방침안내의 내용에 동의합니다.
        </label>
    </div>

    <div class="btn_confirm">
        <input type="submit" class="btn btn-primary" value="회원가입">
    </div>

    </form>

    <script>
    function fregister_submit(f)
    {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }
    </script>
</div>
<!-- } 회원가입 약관 동의 끝 -->

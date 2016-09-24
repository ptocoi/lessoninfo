<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<dl class="srchb lnb4_col bg2_col">
<table class="bg_col">
  <col width=80><col>
  <tr>
    <td class="ctlt bno"><img src="../../images/comn/bul_08.png" class="t">사이트 설정</td>
    <td class="wbg pl7">
    <ul class="List">
    <li class="f"><a href='./index.php' <?=(!$type)?"class='none b col' ":"";?>>기본설정</a></li>
    <li><a href='./content.php?type=site_introduce' <?=($type=='site_introduce')?"class='none b col' ":"";?>>사이트소개</a></li>
    <li><a href='./content.php?type=site_agreement' <?=($type=='site_agreement')?"class='none b col' ":"";?>>회원약관</a></li>
    <li><a href='./content.php?type=site_privacy' <?=($type=='site_privacy')?"class='none b col' ":"";?>>개인정보취급방침</a></li>
    <li><a href='./content.php?type=board_criterion' <?=($type=='board_criterion')?"class='none b col' ":"";?>>게시판관리기준</a></li>
    <li><a href='./content.php?type=email_denied' <?=($type=='email_denied')?"class='none b col' ":"";?>>이메일무단수집거부</a></li>
    <li><a href='./content.php?type=site_bottom' <?=($type=='site_bottom')?"class='none b col' ":"";?>>사이트하단</a></li>
    <li><a href='./content.php?type=email_bottom' <?=($type=='email_bottom')?"class='none b col' ":"";?>>메일하단</a></li>
    </ul>
    </td>
  </tr>		 
</table>
</dl>
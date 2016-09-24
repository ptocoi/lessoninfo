<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<style>
ul{list-style:none;padding-left:0;}
.pt10{padding-top:10px;}
.pb10{padding-bottom:10px;}
.font{font-family: 'Gothic', sans-serif;font-size:24px;font-weight:bold;}
.red{color:#ea0c0c;}
.gray{background-color:#d7d7d7;}
.font12{font-family: 'Gothic', sans-serif;font-size:14px;}
.grablue{/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#2d91e2+0,7db9e8+100 */
background: #2d91e2; /* Old browsers */
background: -moz-linear-gradient(top, #2d91e2 0%, #7db9e8 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#2d91e2), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #2d91e2 0%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #2d91e2 0%,#7db9e8 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #2d91e2 0%,#7db9e8 100%); /* IE10+ */
background: linear-gradient(to bottom, #2d91e2 0%,#7db9e8 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2d91e2', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
border-radius:8px;
line-height:30px;
vertical-align:middle;
border:1px solid #3494e3;}
.gragray{/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#efefef+1,bababa+100 */
background: rgb(239,239,239); /* Old browsers */
background: -moz-linear-gradient(top, rgba(239,239,239,1) 1%, rgba(186,186,186,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,rgba(239,239,239,1)), color-stop(100%,rgba(186,186,186,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(239,239,239,1) 1%,rgba(186,186,186,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(239,239,239,1) 1%,rgba(186,186,186,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(239,239,239,1) 1%,rgba(186,186,186,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(239,239,239,1) 1%,rgba(186,186,186,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#bababa',GradientType=0 ); /* IE6-9 */
border-radius:8px;
line-height:30px;
vertical-align:middle;
border:1px solid #bababa;}
.ml10{margin-left:10px;}
.m10{margin-top:10px;margin-bottom:10px;}
.b{font-weight:bold;}
.wht{color:#fff;}
</style>
<ul style="border:2px solid #d9d9d9;width:600px;text-align:center;display: table;
        margin-left: auto;
        margin-right: auto;">
<li class="font pt10 pb10"><strong><?php echo $env['site_name'];?></strong> 에서 정상적으로 <strong class="red">수신거부</strong> 신청을 <strong class="red">완료</strong>하였습니다.</li>
<li class="gray pt10 pb10 font12">수신거부 후, 다시 메일을 수신하고 싶으실때에는 <?php echo $env['site_name'];?> 사이트에 접속하여<br>
로그인 후, <strong>마이페이지 > 회원정보 수정</strong>에서 이메일 수신여부 변경해주시기 바랍니다.</li>
<li class="m10">
<a href="#" onClick="javascript:self.close();"><div class="b ml10 gragray" style="width:80px;display:inline-block;">닫기(Close)</div></a>
</li>
</ul>

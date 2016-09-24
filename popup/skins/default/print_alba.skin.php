<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title><?php echo $wr_subject;?></title>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/n_alba/_helpers/_js/jquery.min.js"></script>
</head>
<!--   본문 내용 영역   -->
<style type="text/css">
/* reset */
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	/*vertical-align: baseline;*/
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}

ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}
/* end
*/


em{ font-style:normal;}


li { list-style-type:none; }
img,fieldset,iframe{border:0;}
img,fieldset { border:none; }

li img, dd img { vertical-align:top; }
input { vertical-align:middle; }
hr{display:none;}

#skip, .skip {font-size:0; width:0; height:0; line-height:0; position:absolute; left:-9999px; }

form, fieldset, iframe, button {
    border:0 none;
}
/* base */
a {text-decoration:none; color:#666; }
a:hover { color:#666; }

h1,h2,h3,h4,h5,h6 {font-size:100%; }
address,strong{font-style:normal; font-weight:normal; }


   @font-face{font-family:'NGothic'; src:url('../font/NanumGothic.woff') format('woff'); }
   @font-face{font-family:'NGothicB'; src:url('../font/NanumGothicBold.woff') format('woff'); }
   @font-face{font-family:'NGothicEB'; src:url('../font/NanumGothicExtraBold.woff') format('woff'); }


body {font-family:dotum,Gulim,Arial,Tahoma,"Nanum Gothic","NGothic",sans-serif;  font-size:12px; color:#666;}
button {background: none repeat scroll 0 0 transparent; cursor: pointer;  overflow: visible;}
strong {font-weight: bold;}
span.Btn{display:inline-block; color:#fff; cursor:pointer;}


#accessibility, .skip, .blind, legend {
    font-size: 0;
    height: 1px;
    line-height: 0;
    overflow: hidden;
    position: absolute;
    top: -5000em;
    visibility: hidden;
    width: 1px;
}

.titEm {display:block; border:1px solid #E7E7E9; padding:10px 15px;}
.titEm li { padding-top:2px; padding-left:7px; background:url(../images/main/blank2.gif) no-repeat 0 50%;}


/**** Clearfix ****/
.clearfix:before, .clearfix:after { content: ""; display: table; }
.clearfix:after { clear: both; }
.clearfix { zoom: 1; }

/**** float ****/
.fl{float:left;}
.fr{float:right;}
a.url{ text-decoration:underline;}

.titBox{border:1px solid #e7e7e9; padding:15px; line-height:1.5em;}
.color{color:#06C;}	


label {
    /*cursor: pointer;*/
    vertical-align: middle !important;
	/*padding-top:5px;*/
}

/* === padding === */
.pt1 {padding-top: 1px!important;}.pt2 {padding-top: 2px!important;}.pt3 {padding-top: 3px!important;}.pt4{padding-top:4px!important;;}.pt5{padding-top:5px !important;}
.pt10{padding-top:10px;}.pt12{padding-top:12px;}.pt20 {padding-top: 20px!important;}.pt30 {padding-top: 30px!important;}.pt40 {padding-top: 40px!important;}.pt50 {padding-top: 50px!important;}.pt100 {padding-top: 100px!important;}

.pb1{padding-bottom:1px !important;}.pb2{padding-bottom:2px !important;}.pb3{padding-bottom:3px !important;}.pb4{padding-bottom:4px!important;}.pb5{padding-bottom:5px !important;}
.pb10{padding-bottom:10px;}.pb12{padding-bottom:12px;}.pb20{padding-bottom:20px !important;}.pb40{padding-bottom:40px !important;}.pb50{padding-bottom:50px !important;}.pb100{padding-bottom:100px !important;}.pb160{padding-bottom:160px !important;}

.pr1{padding-right:1px !important;}.pr2{padding-right:2px !important;}.pr3{padding-right:3px !important;}.pr4{padding-right:4px !important;}.pr5{padding-right:5px !important;}
.pr10{padding-right:10px;}.pr12{padding-right:12px;}.pr15{padding-right:15px;}.pr20{padding-right:20px !important;}

.pl1{padding-left:1px !important;}.pl2{padding-left:2px !important;}.pl3{padding-left:3px !important;}.pl4{padding-left:4px !important;}.pl5{padding-left:5px !important;}
.pl10{padding-left:10px;}.pl12{padding-left:12px;}.pl15{padding-left:15px;}.pl20{padding-left:20px;}.pl25{padding-left:25px;}.pl30{padding-left:30px;}.pl50{padding-left:50px;}

.ml2{margin-left:2px;}.ml3{margin-left:3px;}.ml5{margin-left:5px;}.ml8{margin-left:8px;}.ml10{margin-left:10px;}.ml15{margin-left:15px;}.ml20{margin-left:20px;}.ml25{margin-left:25px;}.ml30{margin-left:30px;}.ml35{margin-left:35px;}
.mr1{margin-right:1px;}.mr2{margin-right:2px;}.mr3{margin-right:3px;}.mr5{margin-right:5px;}.mr8{margin-right:8px;}.mr10{margin-right:10px;}
.mb1{margin-bottom:1px;}.mb2{margin-bottom:2px;}.mb3{margin-bottom:3px;}.mb5{margin-bottom:5px;}.mb8{margin-bottom:8px;}.mb10{margin-bottom:10px;}.mb15{margin-bottom:15px;}.mb20{margin-bottom:20px;}.mb25{margin-bottom:25px;}.mb30{margin-bottom:30px;}
.mt2{margin-top:2px;}.mt3{margin-top:3px;}.mt5{margin-top:5px;}.mt8{margin-top:8px;}.mt10{margin-top:10px!important;}.mt15{margin-top:15px;}.mt20{margin-top:20px;}.mt25{margin-top:25px;}.mt30{margin-top:30px;}.mt35{margin-top:35px;}.mt40{margin-top:40px;}.mt50{margin-top:50px;}.mt100{margin-top:100px;}.mt120{margin-top:120px!important;}


/* === input === */
.chk {height: 13px; margin: 0;  padding: 0; vertical-align: middle;  width: 13px;}

/* color */
.text_red{color:#ff0000 !important;}
.text_blue{color:#9abee2 !important;}
.text_blue2{color:#F5FAFF !important;}
.text_blue3{color:#078eeb !important;}

.text_help{color:#ffa498 !important;}
.text_gray{color:#aaa !important;}
.text_orange{color:#F60!important;}

.border_blue{border-color:#9abee2 !important;}
.border_blue2{border-color:#F5FAFF !important;}
.border_blue2{border-color:#F5FAFF !important;}
.border_black{border-color:#404660 !important;}

.font_gray a{color:#474747 !important;}
.font_gray a:hover {color:#474747 !important;}
.font_white a{color:#fff !important;}
.font_white a:hover {color:#fff !important;}


.bg_blue{background:#9abee2 !important;}
.bg_blue2{background:#F5FAFF !important;}
.bg_blue3{background:#af8cff !important;}
.bg_blue4{background:#8b9eff !important;}
.bg_blue5{background:#6c43c2 !important;}
.bg_white{border:1px solid #d9d9d9;	background:#fff !important;}

.bg_orange{background:#F60 !important;}	
.bg_blueBlack{
	border:1px solid #000;
	background: #5e7786; /* Old browsers */
	background: -moz-linear-gradient(top,  #5e7786 0%, #525d63 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#5e7786), color-stop(100%,#525d63)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #5e7786 0%,#525d63 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #5e7786 0%,#525d63 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #5e7786 0%,#525d63 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #5e7786 0%,#525d63 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5e7786', endColorstr='#525d63',GradientType=0 ); /* IE6-9 */}
	
	/* align */
.vt{vertical-align:top;}
.vm{vertical-align:middle;}
.vb{vertical-align:bottom;}

.tc{ text-align:center;}
.tl{ text-align:left;}
.tr{ text-align:right;}

.font11{ font-size:11px;}
.font12{ font-size:12px;}
.font13{ font-size:13px;}
.font14{ font-size:14px;}
.font18{ font-size:18px;}

.lineH35 {line-height:1.3em;}

.positionR{ position:relative;}
.positionA{ position:absolute;}
.positionF{ position:fixed;}

.displayB{ display:block;}
.displayI{ display:inline;}
.displayIB{ display:inline-block;}

.singleBtn{width:160px; margin:50px auto 10px;}
.doubleBtn{width:360px; margin:50px auto 10px;}
.doubleBtn ul > li {float: left;  margin-left:10px;}


em.help.icon {/*margin-left:10px;*/line-height:12px; padding-left:15px; background:url(../images/icon/icon_bul_!1.gif) no-repeat 0 0; font-size:11px; }


.bbend{border-bottom:0 !important;}
.brend{border-right:0 !important;}
.Rend{margin-right:0px !important;}
.Bgend{background:none !important;}
.b {font-weight:bold!important;}
.BgNo {background:none!important; padding-left:0!important;}

input.ipText2{ padding: 1px 0 1px 1px;}
select.ipSelect {height: 27px;  letter-spacing: 0 !important;  padding: 3px 2px 2px 2px;}
select.ipSelect2 {letter-spacing: 0 !important; }
input.ipText {height: 15px;  padding: 5px 0 5px 3px;}
input.ipText,input.ipText2, textarea.ipTextarea, select.ipSelect, select.ipSelect2 {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #999999 #DDDDDD #DDDDDD #999999;
	font-size:12px;
    border-image: none;  border-style: solid;  border-width: 1px;  color: #666666;}
/**/

.jobDetail table{width:100%;}
.listWrap .jobDetail{border:1px solid #e7e7e9; border-top:3px solid #404660; background: none repeat scroll 0 0 #f8f8f8; position:relative;}
.listWrap .jobDetail .url a{ text-decoration:underline;}

.jobDetail ul li.jobDleft{width:290px; float:left; background: none repeat scroll 0 0 #fff; border-right: 1px solid #E7E7E9;}
.jobDetail ul li.jobDright{width:506px; float:left; margin-left:-1px; border-left: 1px solid #E7E7E9; background:none repeat scroll 0 0 #F8F8F8;}

.jobDetail .jobDright ul li{padding:0 20px;}
.jobDetail .jobDright ul li span{display:inline-block; width:70px;}

.jobDetail .title{ 
    font: bold 20px/24px nGothic,Dotum,sans-serif;
    letter-spacing: -1px;
    padding: 15px 8px;
    text-align: left;
    word-wrap: break-word;
	border-bottom:1px solid #E7E7E9;
	}

.listWrap .jobContentWrap > ul{line-height: 22px; padding:10px 5px;/* border-top:1px solid #E7E7E9;*/}
.listWrap .jobContentWrap > ul > li > span{float:left; width:100px;}

.listWrap .jobContentWrap > ul > li.gibReadSum {margin-top:10px; border-top:1px solid #E7E7E9; }
.listWrap .jobContentWrap > ul > li.gibReadSum > div > ul > li{float:left; padding:0 20px; }
.listWrap .jobContentWrap > ul > li.gibReadSum > div.imgBtn{margin-top:5px;margin-left:100px; }
.listWrap .jobContentWrap > ul > li.gibReadSum > div.imgBtn > ul > li{padding-right:10px; padding-left:0; }

.listWrap .jobContentWrap > ul > li ul.welfarelist {float:left;}
.listWrap .jobContentWrap > ul > li.gibReadSum .online{float:left;}

.listWrap .jobContentWrap > ul > li ul li.on {background:url(../images/icon/icon_checkBox_on.gif) no-repeat 0 50%; }
.listWrap .jobContentWrap > ul > li ul li.off{background:url(../images/icon/icon_checkBox_off.gif) no-repeat 0 50%; color:#ddd;}




.print#rightContent  {width:645px !important; height:100%; margin:0 auto; float:none!important; }
.print#rightContent .listWrap .jobContentWrap{border-top:3px solid #404660;}
.print#rightContent .listWrap .jobContentWrap > ul > li{border-bottom:1px solid #e7e7e9; padding:3px 0;}
.print#rightContent .listWrap .jobContentWrap > ul > li > span{font-weight:bold;}
.print#rightContent .listWrap .jobContentWrap > ul > li > ul.welfarelist > li > span{display:inline-block; width:100px;}


/*  ==============   print(채용공고 상단 테이블설정)  ==============   */
.print#rightContent .listWrap .jobDetail table{width:100%; background:#fff;}
.print#rightContent .listWrap .jobDetail table  tbody  tr  th {
    background-color: #F8F8F8;
    border-bottom: 1px solid #E7E7E9;
    border-right: 1px solid #E7E7E9;
    color: #333333;
    font-weight: bold;
    height: 36px;
    letter-spacing: -1px;
    line-height: 36px;
    padding: 0 5px 0 23px;
    text-align: left;}
	
.print#rightContent .listWrap .jobDetail > table > tbody > tr > td {
    border-bottom: 1px solid #E7E7E9;
    color: #333333;
    height: 36px;
    padding: 0 0 0 23px;
    text-align: left;}
	
.print#rightContent .listWrap .jobDetail > table > tbody > tr > td.first {border-right: 1px solid #E7E7E9;  text-align: center; padding: 0 5px;}
.print#rightContent .listWrap .jobDetail.table > table > tbody > tr > th {text-align: center;  padding: 0 5px;}
.print#rightContent .listWrap .jobDetail.table > table > tbody > tr > td {border-right: 1px solid #E7E7E9;  text-align: center; padding: 0 5px;}
.print#rightContent .listWrap .jobDetail.table > table > tbody > tr > td.tl {text-align: left; padding: 5px 10px;}
.print#rightContent .listWrap .jobDetail .title {border-bottom:none;}

.Caution{background: none repeat scroll 0 0 #f8f8f8;  border:1px solid #E7E7E9; padding:15px;}
.Caution li{background:url(../images/main/blank2.gif) no-repeat 0 5px ; color:#999; padding-left:5px; line-height:15px; font-size:11px; letter-spacing:-1px;}
</style>

<body scroll="auto" style="overflow-x:hidden">

<script>
var map_load = function(){
	map_api.map_use("map", "", false);
}
</script>

<script type="text/javascript" src="<?php echo $alice['alba_path'];?>/skins/default/alba_detail.skin.js"></script>

<section id="print" class="content_wrap clearfix">
    <div  class="print" id="rightContent"> 
      <div class="listWrap positionR mt30">
        <div class="readBtn clearfix">
        <ul class="clearfix" style="clear:both;">
            <li class="pb5"><p>등록일 : <?php echo $wdate;?></p></li>
        </ul>
        </div>
        <div class="jobDetail clearfix positionR">
<!--  기타정보  -->
          <table>
            <caption>
            <span class="skip">회사정보출력</span>
            </caption>
            <colgroup>
            <col width="250px">
            <col width="126px">
            <col width="*">
            </colgroup>
            <tbody>
              <tr>
                <th colspan="3" class="brend">
                <div class="positionR"> 
                <p class="title"><?php echo $wr_subject;?></p>
                </div>
                </th>
              </tr>              
              <tr>
                <td rowspan="5" class="first bbend">
                <span class="logoImg positionR"><?php echo $wr_logo;?></span>
				</td>
                <th scope="row"> 
                    <p>회사명</p>
                </th>
                <td><strong><?php echo $company_name;?></strong></td>
              </tr>
              <tr>
                <th scope="row"> 
                <p>담당자</p>
                </th>
                <td><p style="display:block;"><?php echo $get_alba['wr_person'];?> <em class="pl5"><?php echo $get_alba['wr_email'];?></em></p></td>
              </tr>
              <tr>
                <th scope="row"> 
                <p>전화번호</p>
                </th>
                <td><p style="display:block;"><?php echo $get_alba['wr_phone'];?></p></td>
              </tr>
              <tr>
                <th scope="row"> 
                <p>휴대폰</p>
                </th>
                <td><p style="display:block;"><?php echo $get_alba['wr_hphone'];?></p></td>
              </tr>
              <tr>
                <th scope="row" class="bbend"> 
                <p>홈페이지</p>
                </th>
                <td class="bbend"><?php echo $wr_homepage;?></td>
              </tr>
            </tbody>
          </table>
      </div>
<!--  채용공고 end -->
<!--  근무조건및자격조건 -->
      <div class="listWrap mt30">
      <h2 class="pb5">
      <img width="220" height="25" class="vb" src="../images/tit/job_print_tit_04.gif" alt="">
      </h2>		
        <div class="jobContentWrap clearfix positionR ">
                            <ul> 
                            	<li>
                                <span>근무기간</span>
                                <?php echo $wr_date;?>
                                </li>                  
                            	<li>
                                <span>근무요일</span>
                                <?php echo $wr_week;?>
                                </li>                  
                            	<li>
                                <span>근무시간</span>
                                <?php echo $wr_time;?>
                                </li>
								<?php if($is_preferential){ ?>
								<li><span>우대조건</span>
								<?php echo $wr_preferential;?></li>
								<?php } ?>
                            	<li>
                                <span><strong>급여</strong></span>
                                <?php echo $pay_type;?> <?php echo $wr_pay;?> <?php echo ($pay_conference)?'(협의가능)':'';?>
                                </li>                  
                            	<li>
                                <span>모집인원</span>
                                <?php echo $volmue;?>
                                </li>
                            	<!-- <li>
                                <span>고용형태</span>
                                아르바이트
                                </li> -->
                            	<li>
                                <span>경력</span>
                                <?php echo $wr_career;?>
                                </li>                  
                            	<li>
                                <span>성별</span>
                                <?php echo $wr_gender;?>
                                </li>
                            	<li>
                                <span>연령</span>
                                <?php echo $age;?>
                                </li>                  
                            	<li>
                                <span>학력</span>
                                <?php echo $wr_ability;?>
                                </li> 
                                <li>
                                <span>모집직종</span>
                                <p><?php echo $wr_job_type0;?> <?php echo $wr_job_type1;?> <?php echo $wr_job_type2;?></p>
                                </li>
                            </ul>
          </div>
       </div>
<!--  근무조건및자격조건 end--> 
<!--  접수기간방법 -->
      <div class="listWrap mt30">
      <h2 class="pb5">
      <img width="145" height="25" class="vb" src="../images/tit/job_print_tit_02.gif" alt="">
      </h2>		
        <div class="jobContentWrap clearfix positionR ">
                             <ul>
                            	<li>
                                <span><strong>모집마감일</strong></span>
                                 <strong><?php echo $volume_end_date;?></strong>
                                </li>
                            	<li>
                                <span><strong>담당자명</strong></span>
                                 <?php echo $get_alba['wr_person'];?>
                                </li>                  
                            	<li>
                                <span><strong>연락처</strong></span>
                                 <em><strong>TEL:</strong> <?php echo $get_alba['wr_phone'];?></em> <em><strong>HP:</strong><?php echo $get_alba['wr_hphone'];?></em> <em><strong>FAX:</strong><?php echo $get_alba['wr_fax'];?></em>
                                </li>                  
								<?php if($is_papers){?>
                            	<li>
                                <span><strong>제출서류</strong></span>
                                 <?php echo $papers;?>
                                </li>                  
								<?php } ?>
                                <li>
                                <span><strong>지원방법</strong></span>
                                <?php echo $wr_requisitions;?>
                                </li> 
                            </ul>
          </div>
       </div>
<!--  접수기간방법 end--> 
<!--  근무환경 -->
      <div class="listWrap mt30">
      <h2 class="pb5">
      <img width="90" height="25" class="vb" src="../images/tit/job_print_tit_03.gif" alt="">
      </h2>	
        <div class="jobContentWrap clearfix positionR ">
                             <ul>
							<?php if($wr_welfare){ ?>
                                <li class="positionR clearfix">
                                    <span><strong>복리후생</strong></span>
                                    <ul class="welfarelist">
									<?php 
										foreach($wr_welfare as $key => $val){ 
										$keys = $category_control->get_categoryCodeName($key);
										$vals_cnt = count($val);
										$vals_arr = array();
										for($i=0;$i<$vals_cnt;$i++){
											$val_name = $category_control->get_categoryCodeName($val[$i]);
											array_push($vals_arr,$val_name);
										}
									?>
										<li class="">
											<span><strong><?php echo $keys;?></strong></span>
											<?php echo implode($vals_arr,", ");?>
										</li>
									<?php }	// foreach end. ?>
                                    </ul>
                               </li>
							   <?php } ?>       
							   <?php if($job_subway['line_icon']){ ?>
                            	<li>
                                <span><strong>인근지하철</strong></span>
                                <img class="vm pr5" src="<?php echo $job_subway['line_icon'];?>" width="35" height="15"/><?php echo $job_subway['station'];?> <?php echo $job_subway['content'];?>
                                </li>                  
								<?php } ?>
                            	<li class="clearfix">
                                <span><strong>근무지역</strong></span>
								<?php echo $job_area;?>
								<?php if($get_alba['wr_area_0_point']){ ?>
								<div class="map pt5">
									<div id="map" style="border:1px solid #999; width:635px;height:319px;"></div>
									<em>※ 지도는 근무지 위치를 나타내며 회사 소재지와 일치하지 않을 수 있습니다.</em>
								</div> 
								<?php } ?>
                                </li>
                            </ul>
          </div>
       </div>
<!--  근무환경 end--> 
<!--  상세요강 -->
      <div class="listWrap mt30">
      <h2 class="pb5">
      <img width="92" height="25" class="vb" src="../images/tit/job_print_tit_01.gif" alt="">
      </h2>		
        <div class="jobContentWrap clearfix positionR mt10">
        <p class="mt10 mb10"><?php echo $wr_content;?></p>
		</div>
       </div>
<!--  상세요강end--> 
		
		<div style="text-align:center;margin-top:10px;">
		<a href="javascript:window.print();"><img src="<?php echo $alice['images_path'];?>/icon/icon_print1.gif"/></a>
		</div>

<!--  주의사항   -->
    <div style="display:block;" class="Caution mt50 mb20">
    <h3 class="skip">주의사항</h3>
    <ul>
        <li>본 정보는 취업활동을 위해 등록한 이력서 정보이며 <?php echo $env['site_name'];?>는(은) 기재된 내용에 대한 오류와 사용자가 신뢰하여 취한 조치에 대한 책임을 지지 않습니다.</li> 
        <li>누구든 본 정보를 <?php echo $env['site_name'];?>의 동의없이 재배포할 수 없으며 본 정보를 출력 및 복사하더라도 채용목적 이외의 용도로 사용할 수 없습니다.</li> 
        <li>아울러 본 정보를 출력 및 복사한 경우의 개인정보보호에 대한 책임은 출력 및 복사한 당사자에게 있으며 정보통신부 고시 제2005-18호 (개인정보의 기술적·관리적 보호조치 기준)에 따라 개인정보가 담긴 이력서 등을 불법유출 및 배포하게 되면 법에 따라 책임지게 됨을 양지하시기 바랍니다. <저작권자 ⓒ <?php echo $env['site_name'];?>. 무단전재-재배포 금지></li>
    </ul>
    </div>
<!--  주의사항 end   -->
  </div>  
  </div>
</section>

<?php if($is_map){ ?>
<script>
$(document).ready(function() {
 	map_load();

	map_api.mapapi_point_is = [<?php echo $wr_area_point[0];?>];
	map_api.detail_func_map_child('0','<?php echo $no;?>', '<?php echo $alice[images_path];?>/icon/map_blue_point.png', 26, 32);

});
</script>
<?php } ?>

</body>
</html>
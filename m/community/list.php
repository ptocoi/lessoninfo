<?php 
include_once "../include/top.html";
include_once "../include/header.html";
include_once "../include/top_menu.html";

$is_write = false;
// 글작성 레벨 체크
if($member['mb_level'] >= $board['bo_write_level']){
	$is_write = true;
}
$is_category = false;
if ($board['bo_use_category']) {	// 분류 사용 유무
	$ca_name = $write['wr_category'];
	$category_option = $category_control->getOption_add('board'," and `p_code` = '".$bo_table."' ", $write['wr_category']);
	$is_category = true;
}
$is_name = false;
$is_password = false;
$is_email = false;
if (!$member['mb_id'] || ($mode == 'update' && $member['mb_id'] != $write['wr_id'])) {	// 비회원의 경우 작성 항목이 늘어난다.
	$is_name = true;
	$is_password = true;
	$is_email = true;
	$is_homepage = true;
	$wr_name = stripslashes($write['wr_name']);
	$wr_password = $_GET['password'];
}
$subject = preg_replace("/\"/", "&#034;", $utility->get_text($utility->cut_str($write['wr_subject'], 255), 0));
$is_file = false;	// 파일 첨부
//if($board['bo_use_upload'] && $is_member)	 // 파일 첨부 기능을 사용하고, 회원일때만 (보안상 비회원은 파일첨부 안됨)
if($board['bo_use_upload'])	
	$is_file = true;
$is_file_content = false;	// 업로드 이미지 파일에 해당 하는 내용 (지금 버전에선 없다)
$is_kcaptcha = false;	// 자동등록방지
if($is_guest && $env['article_denied']==1 && $mode!='update'){	// 비회원 이고, 관리자가 사용체크 했고, 수정이 아닐때
	$is_kcaptcha = true;
}
$is_number = false;	// 임의의 난수
if($is_guest && $env['article_denied']==2 && $mode!='update'){	// 비회원 이고, 관리자가 사용체크 했고, 수정이 아닐때
	$is_number = true;
	$rand_num = rand(0,9).' '.rand(0,9).' '.rand(0,9).' '.rand(0,9);
	$sess_num = explode(' ',$rand_num);
	$_SESSION['rand_nums'] = $sess_num[0].$sess_num[1].$sess_num[2].$sess_num[3];
}
?>
</header>
<script> /* 솔루션 구축환경  리눅스,윈도우 클릭시 이벤트 */
var board_path = "<?php echo $alice['board_path'];?>";
$(".topMenu.list4").addClass("on");
var write_layers = function(){
	$("select[name='wr_category'] option:first").attr('selected',true);
	$('#wr_name').val("");
	$('#wr_password').val("");
	$('#wr_subject').val("");
	$('#wr_content').val("");
	$('#file_name').val("");
	$('#wr_key').val("");
	<?php if($is_kcaptcha){ ?>$.kcaptcha_run();<?php } ?>
	$('.popLayerWrap').fadeIn("4000");
}
var write_cancel = function(){
	$('.popLayerWrap').fadeOut();
}
</script>

<section class="contentWrap">

<!-- 레이어 팝업-->
<div class="popLayerWrap" style="display:none;">
<form name="fwrite" method="post" enctype="multipart/form-data" style="margin:0px;" id="boardwriteFrm">
<input type="hidden" name=null> 
<input type="hidden" name="mode" value="insert">
<input type="hidden" name='board_code' value='<?=$_GET['board_code']?>'>
<input type="hidden" name='code' value='<?=$_GET['code']?>'>
<input type="hidden" name='bo_table' value='<?=$_GET['bo_table']?>'>
<input type="hidden" name='wr_no' value='<?=$_GET['wr_no']?>'>
<input type="hidden" name="sca" value="<?=$_GET['sca']?>">
<input type="hidden" name="page" value="<?=$_GET['page']?>">

	<div class="LayerWrap">
		<div class="popLayer">
			<h2>
				<em class="icon"><img src="../images/icon/icon_mList1.png" class="bg_color1"></em>
				<span>글쓰기</span>
				<div style="top:0; right:0;" class="closeBtn layerBtn bg_color1  clearfix positionA">
					<a><img src="../images/btn/btn_close1.png" alt=""></a>	
				</div>
			</h2>

			<div class="LayerContent">
				<div class="contentBoxWrap clearfix positionR" style="margin-top:-1px;">
					<table cellspacing="1" cellpadding="0" border="0" style=" margin:0; padding:0px;">
					<tbody>
					<?php if($is_category){ ?>
					<tr>
						<th class="pl5">분류</th>
						<td  style="width:75%;">
						<div style="width:55%;" class="styled-select list5  clearfix positionR">
							<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
							<select name="wr_category" required hname='분류' option='select' class="ipSelect">
								<option value="">분류선택</option>
								<?php echo $category_option;?>
							</select>
							</div>
						</td>
					</tr>
					<?php } ?>
					<?php if($is_name){ ?>
					<tr>
						<th class="pl5">작성자</th>
						<td  style="width:75%;">
							<input type="text" name="wr_name" class='ipText' size="20" value='<?=$wr_name?>' required hname='작성자명' id="wr_name">
						</td>
					</tr>
					<?php } ?>
					<?php if($is_password){ ?>
					<tr>
						<th class="pl5">비밀번호</th>
						<td  style="width:75%;">
							<input type="password" name="wr_password" class='ipText' size="20" value='<?=$wr_password?>' required hname='비밀번호' id="wr_password">
							<span class="st11">*비회원의 경우 비밀번호를 꼭 입력하고 기억하셔야 합니다.</span>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th class="pl5">제목</th>
						<td  style="width:75%;">
							<label class="skip">제목</label>
							<input type="text" class="ipText" style="width:95%;" id="wr_subject" name="wr_subject" value="<?php echo $subject;?>">
						</td>
					</tr>
					<tr>
						<th class="pl5">내용</th>
						<td>
							<textarea style="width:95%; height:90px;" id="wr_content" class="ipTextarea" name="wr_content" required hname="내용"></textarea>	
						</td>
					</tr>
					<?php if ($is_file) { ?>
					<tr>
						<th class="pl5 ">썸네일 이미지</th>
						<td class="">
							<input type="file" name="file_name[]" id="file_name"><br/>
							<em class="text_help">
								<strong><?php echo strtoupper(strtr($board['bo_upload_ext_img'],'|',','));?></strong> 파일형식으로,
								<strong><?php echo number_format(intval(substr(ini_get('post_max_size'),0,-1)) * 1024);?>KB</strong> 용량 이내의 파일만 등록 가능합니다.
							</em>
						</td>
					</tr>
					<?php } ?>
					<?php if($is_kcaptcha){ ?>
					<tr>
						<th class="pl5">자동등록방지</th>
						<td>
							<p class="pt5"><b class="fon13 red"><img id='kcaptcha_image' /></b>
							<input name='wr_key' type='input' class="ipText" size='15'  hname="자동등록방지" required id='wr_key'></p>
							<p class="pm5 st11">*왼쪽에 보이는 문자대로 입력해주세요.</p>
						</td>
					</tr>
					<?php } else if($is_number){ ?>
					<tr>
						<th class="pl5">자동등록방지</th>
						<td>
							<p class="pt5"><b class="fon13 red"><?php echo $rand_num;?></b>
							<input name='wr_key' type='input' class="txt" size='15'  hname="자동등록방지" required id='wr_key'></p>
							<p class="pm5 st11">*왼쪽에 보이는 숫자를 입력해주세요.</p>
						</td>
					</tr>
					<?php } ?>
					</tbody>
					</table>
				</div>
				<div class="btnBottom">
					<ul class="clearfix" style="margin:0 auto;">
						<li><a class="button bg_color1 border_color1 text_white" onclick="fwrite_submit();"><span>등록</span><img alt="" src="../images/btn/btn_rightArrow3.png" class="bg_color1"></a>
						</li> 
						<li><a href="javascript:write_cancel();" class="button white"><span>취소</span><img alt="" src="../images/btn/btn_rightArrow2.png" class="bg_gray1"></a>
						</li> 
					</ul>
				</div>
			</div>

		</div>
	</div>

</form>
</div>
<?php if($is_kcaptcha){ ?><script type="text/javascript" src="<?php echo $alice['js_plugin']."/jquery.kcaptcha.js"?>"></script><?php } ?>
<script>
function fwrite_submit() {

	var f = document.fwrite;

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?php echo $alice['board_path'];?>/skins/default/ajax.filter.php",
        type: "POST",
        data: {
			"bo_table" : "<?php echo $bo_table;?>",
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
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined") 
            ed_wr_content.returnFalse();
        else 
            f.wr_content.focus();
        return false;
    }

	<?php if($is_kcaptcha){?>
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }
	<?php } ?>

	var boardwriteFrm = document.getElementById('boardwriteFrm');
	
	if(validate(boardwriteFrm)){
		<?php
		/*
		if ($alice[https_url])	// 보안서버
			echo "f.action = '$alice[https_url]/$alice[app]/$alice[board]/process/regist.php';";
		else
			echo "f.action = './process/regist.php';";
		*/
		?>

		f.action = './process/regist.php';
		f.submit();
		
	} else {
		return false;
	}

}
</script>
<!-- 레이어 팝업 //-->

<?php
	$board = $board_control->get_boardTable($_GET['bo_table']);
	$bo_skin = $board['bo_skin'];
	$wr_page = $sub_board[$_GET['bo_table']]['wr_page'];

	$list_con = " where `wr_is_comment` = 0 ";
	$list_row = $board_control->__TableList($_GET['bo_table'],$page,$wr_page,$list_con);

	$bo_table = $board['bo_table'];
	$bo_subject = $board['bo_subject'];
	$bo_write_count = $board['bo_write_count'];

	switch($bo_skin){
		case 'default':
			include_once "./_include/board_default.skin.php";
		break;
		case 'webzine':
			include_once "./_include/board_webzine.skin.php";
		break;
		case 'image':
			include_once "./_include/board_image.skin.php";
		break;
	}

	$pages = $mobile_control->get_paging($wr_page, $page, $list_row['total_page'], "./list.php?bo_table=".$bo_table."&page_rows=".$wr_page."&page=");
?>


<?php include_once "../include/page.html";?>
</section>

<?php include_once "../include/footer.html";?>
</body>
</html>
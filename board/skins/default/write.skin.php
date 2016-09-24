<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div class="rightWrap mt20 mb30">
	<h2 class="skip"><?php echo $bo_subject;?></h2>
	<div class="community positionR">
		<h3 class="pb5 pl5 h3">
			<img class="" src="../images/icon/icon_star1.gif" width="18" height="17" alt=""> <strong><?php echo $bo_subject;?></strong>
		</h3>
		<em class="titEm mb20">
		<ul>
			<li>개인정보(연락처나 이메일 주소, 상호명을 포함한 글)은 사전 동의 없이 삭제됩니다.</li>
			<li>특정인 또는 특정 업체 비방성 글, 성인 광고, 사이트 홍보글, 지적 재산권 침해 게시물을 등록하는 경우 게시글 삭제 후 이용제한 처리됩니다.</li>
			<li>커뮤니티 게시물에 대한 모든 법적인 책임은 작성자에게 있습니다.</li>
		</ul>
		</em>

		<form name="fwrite" method="post" enctype="multipart/form-data" style="margin:0px;" id="boardwriteFrm">
		<input type="hidden" name=null> 
		<input type="hidden" name="mode" value="<?=$mode?>">
		<input type="hidden" name='board_code' value='<?=$board_code?>'>
		<input type="hidden" name='code' value='<?=$code?>'>
		<input type="hidden" name='bo_table' value='<?=$bo_table?>'>
		<input type="hidden" name='wr_no' value='<?=$wr_no?>'>
		<input type="hidden" name="sca" value="<?=$sca?>">
		<input type="hidden" name="page" value="<?=$page?>">

		<div class="registWrap positionR mt30">
		<em style="top:-22px; right:0;" class="positionA"><span><img alt="필수입력사항" src="../images/icon/icon_b.gif" style="margin-top:-2px;" class="vm">표시는 필수 입력사항 입니다.</span></em>
		<table>
		<caption><span class="skip">취업이야기 입력폼</span></caption>
		<colgroup><col width="159px"><col width="*"></colgroup>
		<tbody>
		<?php if($is_category){ ?>
		<tr>
			<th scope="row"> <label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">분류 </label></th>
			<td>
			<select name="wr_category" required hname='분류' option='select' class="ipSelect">
				<option value="">분류선택</option>
				<?php echo $category_option;?>
			</select>
			</td>
		</tr>
		<?php } ?>
		<?php if ($is_name) { ?>
		<tr>
			<th scope="row"> <label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">작성자 </label></th>
			<td>
				<input type="text" name="wr_name" class='ipText' size="20" value='<?=$wr_name?>' required hname='작성자명'>
			</td>
		</tr>
		<?php } ?>
		<?php if ($is_password) { ?>
		<tr>
			<th scope="row"> <label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">비밀번호 </label></th>
			<td>
				<input type="password" name="wr_password" class='ipText' size="20" value='<?=$wr_password?>' required hname='비밀번호'>
				<span class="st11">비회원의 경우 비밀번호를 꼭 입력하고 기억하셔야 합니다.</span>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<th scope="row"> <label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">제목 </label></th>
			<td>
				<input type="text" name="wr_subject" id="wr_subject" style="width:595px;" class="ipText" value='<?=$subject?>' required hname='제목'>
				<?php
					$option = "";
					$option_hidden = "";
					if ($is_html || $is_secret) { 
						$option = "";

						if ($is_html) {
							if ($is_dhtml_editor) {
								$option_hidden .= "<input type=hidden value='html1' name='html'>";
							} else {
								$option .= "<input onclick='html_auto_br(this);' type=checkbox value='".$html_value."' name='html' ".$html_checked."> <label class=w_title>html</label> &nbsp;";
							}
						}

						if ($is_secret) {
							if ($is_secret==1) {
								$option .= "<input type=checkbox value='1' name='wr_secret' ".$secret_checked."> <label class=w_title>비밀글</label>&nbsp;";
							} else {
								$option_hidden .= "<input type=hidden value='secret' name='secret'>";
							}
						}
					}

					echo $option_hidden;

					if ($option) {
						echo $option;
					}
				?>
			</td>
		</tr>
		<tr>
			<th scope="row"> <label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">내용</label></th>
			<td><?php echo $utility->make_cheditor('wr_content', $content);	// 에디터 생성?></td>
		</tr>
		
		<?php if ($is_file) { ?>
		<tr>
			<th scope="row"><label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">썸네일 이미지 </label></th>
			<td>
				<table id="variableFiles" cellpadding=0 cellspacing=0></table>
				<script type="text/javascript">
				var flen = 0;
				function add_file(delete_code){
					var upload_count = <?=(int)$board[bo_upload_count]?>;
					if (upload_count && flen >= upload_count){
						alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
						return;
					}

					var objTbl;
					var objRow;
					var objCell;
					if (document.getElementById)
						objTbl = document.getElementById("variableFiles");
					else
						objTbl = document.all["variableFiles"];

					objRow = objTbl.insertRow(objTbl.rows.length);
					objCell = objRow.insertCell(0);

					objCell.innerHTML = "<input type='file' class='ed' name='file_name[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
					if (delete_code)
						objCell.innerHTML += delete_code;
					else{
						<? if ($is_file_content) { ?>
						objCell.innerHTML += "<br><input type='text' class='ed' size=50 name='file_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
						<? } ?>
						;
					}

					flen++;
				}

				<?=$file_script; //수정시에 필요한 스크립트?>

				function del_file(){
					// file_length 이하로는 필드가 삭제되지 않아야 합니다.
					var file_length = <?=(int)$file_length?>;
					var objTbl = document.getElementById("variableFiles");
					if (objTbl.rows.length - 1 > file_length){
						objTbl.deleteRow(objTbl.rows.length - 1);
						flen--;
					}
				}
				</script>

				<p id="ImageAttach0">
					<a class="btn commentBtn add" href="javascript:add_file();" style="display:;"><span class="btn commentBtnBg">추가</span></a>
					<a class="btn commentBtn del" href="javascript:del_file();" style="display:;"><span class="btn commentBtnBg">삭제</span></a>
				</p>
				<p class="pt10 pb10"><strong><?php echo strtoupper(strtr($board['bo_upload_ext_img'],'|',','));?></strong> 파일형식으로,<br>
				<strong>파일당 <?php echo number_format(intval(substr(ini_get('post_max_size'),0,-1)) * 1024);?>KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
			</td>
		</tr>
		<?php } ?>
		<?php if($is_kcaptcha){ ?>
		<tr>
			<th scope="row"> <label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">자동등록방지</label></th>
			<td>
				<b class="fon13 red"><img id='kcaptcha_image' /></b>&nbsp;
				<input name='wr_key' type='input' class="ipText" size='15'  hname="자동등록방지" required id='wr_key'>
				<span class="st11">왼쪽에 보이는 문자대로 입력해주세요.</span>			
			</td>
		</tr>
		<?php } else if($is_number){ ?>
		<tr>
			<th scope="row"> <label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">자동등록방지</label></th>
			<td>
				<b class="fon13 red"><?php echo $rand_num;?></b>&nbsp;
				<input name='wr_key' type='input' class="txt" size='15'  hname="자동등록방지" required id='wr_key'>
				<span class="st11">왼쪽에 보이는 숫자를 입력해주세요.</span>
			</td>
		</tr>
		<?php } ?>
		</tbody>
		</table>
		</div>
		<div style="margin:70px auto;" class="doubleBtn clearfix">
			<ul> 
			<li><div class="btn font_white bg_blueBlack"><a onclick="fwrite_submit();" style="cursor:pointer;">등록<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
			<li><div class="btn font_gray bg_white"><a href="<?php echo $list_href;?>">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
			</ul>
		</div>

		</form>

	</div>
</div>

<?php if($is_kcaptcha){ ?><script type="text/javascript" src="<?php echo $alice['js_plugin']."/jquery.kcaptcha.js"?>"></script><?php } ?>
<script>
function html_auto_br(obj) {
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit() {

	var f = document.fwrite;

	if (document.getElementById('tx_wr_content')) {
		if (!ed_wr_content.outputBodyText()) { 
			alert('내용을 입력하십시오.'); 
			ed_wr_content.returnFalse();
			return false;
		}
    }

    <?php if ($is_dhtml_editor) echo $utility->input_cheditor('wr_content');	// 에디터 내용 전달 ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: "./skins/<?php echo $board['bo_skin']?>/ajax.filter.php",
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
		if ($alice[https_url])	// 보안서버
			echo "f.action = '$alice[https_url]/$alice[app]/$alice[board]/process/regist.php';";
		else
			echo "f.action = './process/regist.php';";
		?>

		f.submit();
		
	} else {
		return false;
	}

}
</script>
<script type="text/javascript" src="<?php echo $alice['js_path'] . "/board.js"?>"></script>
<script type="text/javascript"> window.onload=function() { drawFont(); } </script>
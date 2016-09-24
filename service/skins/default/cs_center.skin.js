$(function(){

});

var email_sel = function( vals ){	// 이메일 서비스 선택
	var sel = vals.value;
	$('#wr_email_tail').val(sel);
}

var csSubmit = function(){	// 고객센터 내용 전송
	//$('#serviceFrm').submit();
	document.getElementById('tx_wr_content').value = ed_wr_content.outputBodyHTML();	// 에디터 내용 전달
	$('#serviceFrm').ajaxSubmit(form_options);

}

var form_options = { beforeSubmit: showRequest, success : showResponse };

// 폼 전송전
function showRequest(formData, jqForm, form_options){

	var serviceFrm = document.getElementById('serviceFrm');

	var queryString = $.param(formData);

	return validate(serviceFrm);

    if (document.getElementById('tx_wr_content')) {
        if (!ed_wr_content.outputBodyText()) { 
            alert("내용을 작성해 주세요.")
            ed_wr_content.returnFalse();
            return false;
        }
    }

}
// 폼 전송후
function showResponse(responseText, statusText, xhr, $form){
	switch(responseText){
		case '0046':
			alert("자동등록방지 글을 정확히 입력해 주세요.");
			$.kcaptcha_run();
		break;
		case '0034':
			alert("내용에 올바르지 않은 코드가 다수 포함되어 있습니다.");
		break;
		case '0005':
			alert("이름을 입력해 주세요.");
		break;
		case '0006':
			alert("이메일 주소를 입력해 주세요.");
		break;
		case '0007':
			alert("휴대폰 번호를 입력해 주세요.");
		break;
		case '0008':
			alert("업체명을 입력해 주세요.");
		break;
		case '0009':
			alert("제목을 입력해 주세요.");
		break;
		case '0010':
			alert("내용을 입력해 주세요.");
		break;
		default:
			var results = responseText.split('/');
			var mode = results[0], result = results[1];
			alert("문의가 접수 되었습니다.");
			location.reload();
		break;
	}

}
$(function(){

});

var proof_submit = function( mode ){	// 폼 전송 (모드별)

	var proof_options = { beforeSubmit : proofRequest, success : proofResponse }

	if(mode=='email'){	 // 이메일 전송
		$('#mode').val('email');
	} else if(mode=='print'){	// 인쇄
		$('#mode').val('print');
	}

	$('#proofFrm').ajaxSubmit(proof_options);

}
var proofRequest = function(formData, jqForm, proof_options){	 // 로고 전송 전
	return true;
}
var proofResponse = function(responseText, statusText, xhr, $form){	// 로고 전송 후
	var results = responseText.split('/');
	var result = results[0], mode = results[1];

	if(result){
		if(mode=='email'){
			alert("메일 발송이 완료 되었습니다\n\n메일을 확인하세요.");
		} else if(mode=='print'){
			window.print();
		}
	} else {
		if(mode=='email'){
			alert("메일 발송중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
		}
	}
}

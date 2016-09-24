$(function(){
	
});

var resume_proposal = function( no, wr_type ){

	$('#popup').load('./views/_load/popup.php', { mode:'proposal', wr_type:wr_type, mb_id:mb_id, no:no }, function(){

		$(this).show();

	});

	/*
	$.post('./process/proposal.php', { mb_id:mb_id, wr_type:wr_type, }, function(){
	});
	*/

}
var denied_resume_proposal = function( wr_type ){
	
	if(wr_type=='become'){
		if(confirm('이력서 열람권이 있어야 입사지원 요청 가능합니다.\n\n열람서비스를 신청하시겠습니까?')){
			location.href = "../company/open_service.php";
		}
	} else if(wr_type=='interview'){
		if(confirm('이력서 열람권이 있어야 면접제의 가능합니다.\n\n열람서비스를 신청하시겠습니까?')){
			location.href = "../company/open_service.php";
		}
	}
	
}
var get_alba = function( vals ){	// 채용공고 선택
	var sel = vals.value;

	if(sel){

		$.post('./process/proposal.php', { mode:'get_alba', no:sel }, function(result){

			var data = eval("(" + result + ")");

			var wr_person = data.wr_person;	// 담당자
			var wr_phone = data.wr_phone;		// 담당자 전화번호
			var wr_hphone = data.wr_hphone;	// 담당자 휴대폰번호
			var wr_email = data.wr_email;		// 회신 이메일
			var wr_pre_question = data.wr_pre_question;	// 사전질문

			$('#wr_person').val(wr_person);
			$('#wr_phone').val(wr_phone);
			$('#wr_hphone').val(wr_hphone);
			$('#wr_email').val(wr_email);
			$('#wr_content').val(wr_pre_question);

		});

	}

}
var proposalFrmSubmit = function(){
	var proposal_options = { target : '', beforeSubmit : proposalRequest, success : proposalResponse }
	$('#proposalFrm').ajaxSubmit(proposal_options);
	//$('#proposalFrm').submit();
}
var proposalRequest = function(formData, jqForm, proposal_options){	 // 전송 전
	var proposalFrm = document.getElementById('proposalFrm');
	var queryString = $.param(formData);
	return validate(proposalFrm);
}
var proposalResponse = function(responseText, statusText, xhr, $form){	// 전송 후
	
	var results = responseText.split('/');
	var result = results[0], wr_type = results[1];

	if(wr_type=='become'){
		var msg = "입사지원요청";
		var success_msg = "이 완료 되었습니다.";
	} else if(wr_type=='interview') {
		var msg = "면접제의";
		var success_msg = "가 완료 되었습니다.";
	}
	var fail_msg = " 중 오류가 발생하였습니다.";

	if(result){
		alert(msg+success_msg);
		if(wr_type=='become'){
			$('#become_btn').attr("src","../images/icon/icon_scrap4_on.gif");
		} else if(wr_type=='interview'){
			$('#interview_btn').attr("src","../images/icon/icon_scrap5_on.gif");
		}
	} else {
		alert(msg+fail_msg);
	}

	$('#popup').hide();
}
var popup_close = function(){
	$('#popup').hide();
}

var resume_print = function( no ){	// 이력서 인쇄
	
	alert(no+" @@ 이력서 인쇄");

}

var is_scrap = function(){
	
	alert("이미 스크랩 하셨습니다.");

}

var resume_scrap = function( no ){	// 알바 공고 스크랩

	if(is_member){
		if(mb_type=='individual'){
			alert("이력서 스크랩은 기업회원만 가능합니다.");
			return;
		}
	} else {
		alert("회원만 스크랩 가능합니다.");
		win_open("../popup/login.php", "pop_login", 480, 200);
		return;
	}

	$.post('./process/scrap.php', { mb_id:mb_id, no:no }, function(result){
		
		alert(result);

		$('#scrap_btn').attr('src','../images/icon/icon_scrap1_on.gif');

	});

}


var resume_report = function(){	// 신고하기

	$('#report_popup').show();

}
var resume_report_close = function(){	// 신고창 닫기 (초기화)
	$('#reportFrm').resetForm();
	$('#report_self').hide();
	$('#report_popup').hide();
}
var report_sel = function( vals ){
	var sel = vals.value;
	if(sel=='self'){	// 직접 입력
		$('#report_self').show();
		$("input[name='wr_report']").attr('required',true);
		$('#wr_report_content').attr('required',true);
	} else {
		$('#report_self').hide();
		$("input[name='wr_report']").removeAttr('required');
		$('#wr_report_content').removeAttr('required');
	}
}

var reportFrmSubmit = function(){
	var report_options = { target : '', beforeSubmit : reportRequest, success : reportResponse }
	if(confirm("신고하시겠습니까?\n\n신고된 공고는 사이트 운영자가 확인하기 전까지 출력되지 않습니다.")){
		$('#reportFrm').ajaxSubmit(report_options);
	}
}
var reportRequest = function(formData, jqForm, report_options){	 // 신고 전송 전
	var reportFrm = document.getElementById('reportFrm');
	var queryString = $.param(formData);
	return validate(reportFrm);
}
var reportResponse = function(responseText, statusText, xhr, $form){	// 신고 전송 후
	if(responseText){
		alert("신고되었습니다.\n\n사이트 운영자 확인 전까지 출력되지 않습니다.");
		location.href = base_path;
	}
}
var resume_print = function(){
	
	window.print();

}

var photo_view = function( mb_id, photo_no ){
	$('#popup').load('./views/_load/photo.php', { mb_id:mb_id, photo_no:photo_no }, function(){
		$(this).show();
	});
}

var photo_close = function(){
	$('#popup').hide();
}

var photo_on = function( no, width, height ){
	var photo_src = $('#photo_'+no).attr('src');
	$('#target_photo').html("<img src=\""+photo_src+"\" onclick=\"image_window_view(this,"+width+","+height+");\"/>");
}

var open_resume = function( no, wr_id, type, open_count ){

	if(confirm('사용가능한 열람권이 '+open_count+'건 있습니다\n\n열람권을 사용 하여 이력서를 열람하시겠습니까?')){

		//alert(no+" @ "+wr_id+" @ "+type);

		$.post('./process/open.php', { no:no, wr_id:wr_id, type:type }, function(result){
			
			if(result=='0003'){
				alert("사용가능한 이력서 열람권이 없습니다.");
				return false;
			} else {
				location.reload();	// 새로고침
			}

		});

	}

}

var length_count = function(filed, max_count) { 
    var str; 
    var str_count = 0; 
    var cut_count = 0; 
    var max_length = max_count; 
    var str_length = filed.value.length; 

    for (k=0;k<str_length;k++) { 
        str = filed.value.charAt(k); 
        if (escape(str).length > 4) { 
            str_count += 2; 
            max_length -= 2; 
        } else { 
            // (\r\n은 1byte 처리) 
            if (escape(str) == '%0A') { 
            } else { 
                str_count++; 
                max_length--; 
            } 
        } 

        if (max_count < str_count) { 
            alert("글자수가 "+ max_count +" byte 이상은 사용불가능 합니다"); 
            if (escape(str).length > 4) { 
                str_count -= 2; 
                max_length += 2; 
            } else { 
                str_count--; 
                max_length++; 
            } 
            filed.value = filed.value.substring(0,k); 
            break; 
        } 
    } 
	max_length=max_count-max_length;
	 eval("this.msg_bytes.innerText = max_length;"); 
} 

var sms_send = function( no, wr_id ){	// 담당자 문자보내기
	$('#mobileWrap').show();
	$('#send_msg').focus();
}

var smsSendFrmSubmit = function(){	// 문자 폼 전송
	var sms_options = { target : '', beforeSubmit : smsRequest, success : smsResponse }
	$('#smsSendFrm').ajaxSubmit(sms_options);

}
var smsSendFrmClose = function(){	// 문자 폼 닫기
	$('#smsSendFrm').resetForm();
	$('#mobileWrap').hide();
}
var smsRequest = function(formData, jqForm, sms_options){	 // 문자 전송 전
	var smsSendFrm = document.getElementById('smsSendFrm');
	var queryString = $.param(formData);
	return validate(smsSendFrm);
}
var smsResponse = function(responseText, statusText, xhr, $form){	// 문자 전송 후
	var results = responseText.split('/');
	var result = results[0], msg = results[1];
	if(result=='success'){
		alert(msg);
		smsSendFrmClose();
	} else {
		//alert("SMS 발송중 오류가 발생하였습니다.\n\n사이트 운영자에 문의하세요.");
		alert(msg);
	}

}

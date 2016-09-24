$(function(){

});

var alba_scrap = function( no ){	// 정규직 공고 스크랩

	if(is_member){
		if(mb_type=='company'){
			alert("채용정보 스크랩은 개인회원만 가능합니다.");
			return;
		}
	} else {
		alert("회원만 스크랩 가능합니다.");
		win_open("../popup/login.php", "pop_login", 480, 200);
		return;
	}

	$.post('./process/scrap.php', { mb_id:mb_id, no:no }, function(result){
		
		alert(result);

		$('#scrap_icon').attr('src','../images/icon/icon_scrap2_on.gif');

	});

}

var is_scrap = function(){
	
	alert("이미 스크랩 하셨습니다.");

}

var is_mail = function(){
	if(confirm("이메일 전달은 회원만 가능합니다.\n\n로그인 하겠습니까?")){
		win_open("../popup/login.php", "pop_login", 480, 200);
	}
}

var alba_mail = function( no ){
	
	$('#popup').load('./views/_load/alba.php', { mode:'post_email', no:no }, function(){
		$(this).show();
	});

}
var alba_mail_close = function(){
	
	$('#popup').hide();

}

var mailFrmSubmit = function(){	// 메일 전달 폼 전송

	var email_options = { target : '', beforeSubmit : emailRequest, success : emailResponse }
	$('#MailFrm').ajaxSubmit(email_options);
	//$('#MailFrm').submit();

}

var emailRequest = function(formData, jqForm, email_options){
	var queryString = $.param(formData);
	return true;
}
var emailResponse = function(responseText, statusText, xhr, $form){

	alert("채용정보가 e-메일로 전달되었습니다.");
	alba_mail_close();

}

var alba_print = function( wr_no ){
	
	//window.print();
	win_open("../popup/print_alba.php?no="+wr_no,"alba_print",700,930);

}

var content_print = function(){
    
	var initBody = document.body.innerHTML;
	window.onbeforeprint = function(){
		document.body.innerHTML = document.getElementById('jobDetail').innerHTML;
	}
	window.onafterprint = function(){
		document.body.innerHTML = initBody;
	}
	window.print();

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

var online_becomes = function( no, requisition ){	// 온라인 입사지원

	if(mb_type=='company' || mb_type==''){
		alert("입사지원은 개인회원만 가능합니다.");
		return;
	}

	switch(requisition){

		// 온라인 입사지원
		case 'online':
			$('#popup').html("");	// 초기화
			$('#popup').load('./views/_load/alba.php', { mode:'become_online', no:no }, function(){
				$(this).show();
			});
		break;

		// 이메일 입사지원
		case 'email':
			$('#popup').html("");	// 초기화
			$('#popup').load('./views/_load/alba.php', { mode:'become_email', no:no }, function(){
				$(this).show();
			});
		break;
	}

}
var wr_forms = function( vals ){	// 이력서 양식 선택
	var sel = vals.value;

	if(sel=='user'){
		$('#user_form').show();
		$('#company_form').hide();
		$('#alba_resume').attr('required',true);
	} else if(sel=='company'){
		$('#user_form').hide();
		$('#company_form').show();
		$('#alba_resume').removeAttr('required');
	}

}
var BecomeFrmSubmit = function(){ // 입사지원 폼 전송
	var become_options = { target : '', beforeSubmit : becomeRequest, success : becomeResponse }
	$('#BecomeFrm').ajaxSubmit(become_options);
	//$('#BecomeFrm').submit();
}

var BecomeFrmCancel = function(){	// 입사지원 취소
	$('#popup').hide();
	$('#popup').html("");
}

var becomeRequest = function(formData, jqForm, become_options){	 // 입사지원 전송 전
	var BecomeFrm = document.getElementById('BecomeFrm');
	var queryString = $.param(formData);
	return validate(BecomeFrm);
}
var becomeResponse = function(responseText, statusText, xhr, $form){	// 입사지원 전송 후
	if(responseText=='0000'){
		alert("이미 지원하셨습니다.");
		$("#popup").hide();
		$("#popup").html("");
	} else {
		if(responseText == 'become_online'){	// 온라인 입사지원 결과
			alert("온라인 입사지원이 완료 되었습니다.");
		} else if(responseText == 'become_email'){	// 이메일 입사지원 결과
			alert("이메일 입사지원이 완료 되었습니다.");
		}
		$('#popup').hide();
		$('#popup').html("");
	}
}

var alba_report = function(){	// 신고하기

	$('#report_popup').show();

}
var alba_report_close = function(){	// 신고창 닫기 (초기화)
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
	if(confirm("신고하시겠습니까?\n\n신고가 접수되면 사이트 운영자가 확인 후 처리됩니다.")){
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
		alert("신고되었습니다.");
		location.href = base_path;
	}
}

var open_alba = function( no, wr_id, type, open_count ){

	if(confirm('사용가능한 열람권이 '+open_count+'건 있습니다\n\n열람권을 사용 하여 채용공고를 열람하시겠습니까?')){
		
		$.post('./process/open.php', { no:no, wr_id:wr_id, type:type }, function(result){
			
			if(result=='0005'){
				alert("사용가능한 채용공고 열람권이 없습니다.");
				return false;
			} else {
				location.reload();	// 새로고침
			}

		});

	}

}
var photo_view = function( mb_id, photo_no, company_no, data_no ){
	$('#popup').load('./views/_load/photo.php', { mb_id:mb_id, photo_no:photo_no, company_no:company_no, data_no:data_no }, function(){
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

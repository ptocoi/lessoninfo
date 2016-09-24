$(function(){

});

var certify_types = function( vals, user ){	 // 인증 방법 체크에 따른 알림.
	var sel = vals.value;	
	if(user=='company'){	 // 기업회원 아이디 찾기
		if(sel=='ipin'){
			$('#certify_type_ipins').show();
			$('.hphone_set').hide();
			$('#company_ipin_button').show();	// 기업회원 아이핀 인증 버튼
			$('#company_hphone_button').hide();	// 기업회원 휴대폰 인증 버튼
		} else if(sel=='hphone'){
			$('#certify_type_ipins').hide();
			$('.hphone_set').show();
			$('#company_ipin_button').hide();	// 기업회원 아이핀 인증 버튼
			$('#company_hphone_button').show();	// 기업회원 휴대폰 인증 버튼
		}
	} else if(user=='individual'){	// 개인회원 아이디 찾기

	}
}

// 아이핀 폼 실행
var jsSubmit = function(){
	var popupWindow = window.open("", "kcbPop", "left=200, top=100, status=0, width=450, height=550");
	var ipinStepFrm = document.ipinStepFrm;
	ipinStepFrm.target = "kcbPop";
	ipinStepFrm.submit();

	popupWindow.focus()	;
}


var certify_hphone = function(){	// 휴대폰으로 찾기

	var certify_type = $("input[name='certify_type']:checked").val();
	var certify_name = $('#certify_name').val();
	var certify_year = $('#certify_year option:selected').val();
	var certify_month = $('#certify_month option:selected').val();
	var certify_day = $('#certify_day option:selected').val();
	var certify_gender = $("input[name='certify_gender']:checked").val();

	var certify_mobile_0 = $('#certify_mobile_0 :selected').val();
	var certify_mobile_1 = $('#certify_mobile_1').val();
	var certify_mobile_2 = $('#certify_mobile_2').val();

	
	if(certify_name=='' || !certify_name){
		alert("이름을 입력해 주세요.");
		$('#certify_name').focus();
		return;
	}
	if(certify_year=='' || !certify_year){
		alert("생년월일을 선택해 주세요.");
		$('#certify_year').focus();
		return;
	}
	if(certify_month=='' || !certify_month){
		alert("생년월일을 선택해 주세요.");
		$('#certify_month').focus();
		return;
	}
	if(certify_day=='' || !certify_day){
		alert("생년월일을 선택해 주세요.");
		$('#certify_day').focus();
		return;
	}
	if(certify_gender=='' || !certify_gender){
		alert("성별을 선택해 주세요.");
		$('#certify_gender_0').focus();
		return;
	}
	if(!certify_mobile_1 || certify_mobile_1=='' || !certify_mobile_2 || certify_mobile_2==''){
		alert("휴대폰 번호를 입력해 주세요.");
		if(!certify_mobile_1 || certify_mobile_1==''){
			$('#certify_mobile_1').focus();
			return;
		}
		if(!certify_mobile_2 || certify_mobile_2==''){
			$('#certify_mobile_2').focus();
			return;
		}
	}

	$('#cnFrm #cnfrm_name').val(certify_name);	// 인증 이름
	$('#cnFrm #cnfrm_birthday').val(certify_year+certify_month+certify_day);	// 인증 생년월일
	cnfrm_gender = (certify_gender=='0') ? 1 : 0;
	$('#cnFrm #cnfrm_gender').val(cnfrm_gender);	// 인증 성별
	$('#cnFrm #cnfrm_nation').val(1);	// 1 :: 내국인, 2 :: 외국인
	//tel_com_cd = $("input[name='telecom_cd']:checked").val();
	tel_com_cd = $("#telecom_cd :selected").val();
	$('#cnFrm #tel_com_cd').val(tel_com_cd);	// 통신사
	$('#cnFrm #tel_no').val(certify_mobile_0+certify_mobile_1+certify_mobile_2);	// 휴대폰번호

	//alert(certify_name+"\n\n"+certify_year+"\n\n"+certify_month+"\n\n"+certify_day+"\n\n"+cnfrm_gender+"\n\n"+tel_com_cd+"\n\n"+certify_mobile_0+"\n\n"+certify_mobile_1+"\n\n"+certify_mobile_2);

	jsSubmit_cnfrm();	// 휴대폰 인증 실행
	return;

}
// 휴대폰인증 폼 실행
var jsSubmit_cnfrm = function(){

	var cnFrm = document.cnFrm;
	var isChecked = false;
	//var inTpBit = $("#cnFrm input[name='in_tp_bit']").val();	// 입력유형

	window.open("", "auth_popup", "width=430,height=590,scrollbar=yes");

	var cnFrm = document.cnFrm;
	cnFrm.target = "auth_popup";
	cnFrm.submit();
}


// 개인회원 아이디찾기 
var individual_find_sets = function( vals ){
	var sel = vals.value;
	$('#individual_box').show();
	$('.boxes, .individual_button').hide();
	switch(sel){
		case 'email':	// 이메일
			$('.email_box').show();
			$('#individual_email_button').show();
		break;
		case 'hphone':	// 휴대폰
			$('.hphone_box').show();
			$('#individual_hphone_button').show();
		break;
		case 'ipin':	 // 아이핀
			$('#ipin_box').show();
			$('#individual_ipin_button').show();
		break;
		case 'foreigner':	 // 외국인
			$('.foreigner_box').show();
			$('#individual_foreigner_button').show();
		break;
	}
}

// 개인회원 이메일로 아이디찾기
var individual_find_id_email = function(){
	var individual_certify_name = $('#individual_certify_name').val();
	var individual_email = $('#individual_email').val();
	var individual_email_tail = $('#individual_email_tail').val();

	var find_email = individual_email+"@"+individual_email_tail;

	$.post('./process/regist.php', { mode:'email_find_id', find_name:individual_certify_name, find_email:find_email }, function(result){

		if(result=='1'){
			alert("이메일 주소 ["+find_email+"] 로 메일이 발송 되었습니다.");
		} else {
			alert("가입된 정보가 확인되지 않습니다.\n\n가입하신 회원명, 이메일주소를 확인하세요.");
		}		

	});
}

var individual_certify_hphone = function(){	// 개인회원 휴대폰으로 찾기

	var certify_name = $('#individual_certify_name').val();
	var certify_year = $('#individual_certify_year option:selected').val();
	var certify_month = $('#individual_certify_month option:selected').val();
	var certify_day = $('#individual_certify_day option:selected').val();
	var certify_gender = $("input[name='individual_certify_gender']:checked").val();

	var certify_mobile_0 = $('#individual_certify_mobile_0 :selected').val();
	var certify_mobile_1 = $('#individual_certify_mobile_1').val();
	var certify_mobile_2 = $('#individual_certify_mobile_2').val();

	//alert(certify_name+"\n\n"+certify_year+"\n\n"+certify_month+"\n\n"+certify_day+"\n\n"+certify_gender+"\n\n"+certify_mobile_0+"\n\n"+certify_mobile_1+"\n\n"+certify_mobile_2);

	if(certify_name=='' || !certify_name){
		alert("이름을 입력해 주세요.");
		$('#individual_certify_name').focus();
		return;
	}
	if(certify_year=='' || !certify_year){
		alert("생년월일을 선택해 주세요.");
		$('#individual_certify_year').focus();
		return;
	}
	if(certify_month=='' || !certify_month){
		alert("생년월일을 선택해 주세요.");
		$('#individual_certify_month').focus();
		return;
	}
	if(certify_day=='' || !certify_day){
		alert("생년월일을 선택해 주세요.");
		$('#individual_certify_day').focus();
		return;
	}
	if(certify_gender=='' || !certify_gender){
		alert("성별을 선택해 주세요.");
		$('#individual_certify_gender_0').focus();
		return;
	}
	if(!certify_mobile_1 || certify_mobile_1=='' || !certify_mobile_2 || certify_mobile_2==''){
		alert("휴대폰 번호를 입력해 주세요.");
		if(!certify_mobile_1 || certify_mobile_1==''){
			$('#individual_certify_mobile_1').focus();
			return;
		}
		if(!certify_mobile_2 || certify_mobile_2==''){
			$('#individual_certify_mobile_2').focus();
			return;
		}
	}

	$('#cnFrm #cnfrm_name').val(certify_name);	// 인증 이름
	$('#cnFrm #cnfrm_birthday').val(certify_year+certify_month+certify_day);	// 인증 생년월일
	cnfrm_gender = (certify_gender=='0') ? 1 : 0;
	$('#cnFrm #cnfrm_gender').val(cnfrm_gender);	// 인증 성별
	$('#cnFrm #cnfrm_nation').val(1);	// 1 :: 내국인, 2 :: 외국인
	tel_com_cd = $("#individual_telecom_cd :selected").val();
	$('#cnFrm #tel_com_cd').val(tel_com_cd);	// 통신사
	$('#cnFrm #tel_no').val(certify_mobile_0+certify_mobile_1+certify_mobile_2);	// 휴대폰번호

	jsSubmit_cnfrm();	// 휴대폰 인증 실행
	return;

}


var company_find_pw = function(){

	var find_name = $('#mb_name').val();
	var find_email = $('#company_email').val() + "@" + $('#company_email_tail').val();

	$.post('./process/regist.php', { mode:'email_find_id', find_name:find_name, find_email:find_email }, function(result){

		if(result=='1'){
			alert("이메일 주소 ["+find_email+"] 로 메일이 발송 되었습니다.");
		} else {
			alert("가입된 정보가 확인되지 않습니다.\n\n가입하신 회원명, 이메일주소를 확인하세요.");
		}
		

	});

}
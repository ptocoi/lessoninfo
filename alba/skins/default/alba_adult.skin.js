$(function(){
	
});

var certify_types = function( vals ){	 // 인증 방법 체크에 따른 알림.
	var sel = vals.value;
	
	if(sel=='ipin'){	// 아이핀
		
		$('#certify_info').hide();
		jsSubmit();

	} else if(sel=='hphone'){	// 휴대폰인증

		$('#certify_info').show();

	}

	/*
	$('.Tip').hide();
	if(sel=='hphone'){
		$('#hphone_set').show();
		$('#Tip_hphone').show();
	} else {
		$('#hphone_set').hide();
		$('#Tip_ipin').show();
	}
	*/
}

// 아이핀 폼 실행
var jsSubmit = function(){
	var popupWindow = window.open("", "kcbPop", "left=200, top=100, status=0, width=450, height=550");
	var ipinStepFrm = document.ipinStepFrm;
	ipinStepFrm.target = "kcbPop";
	ipinStepFrm.submit();

	popupWindow.focus()	;
}

var certify_check = function(){	// 휴대폰 인증
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
	tel_com_cd = $("input[name='telecom_cd']:checked").val();
	$('#cnFrm #tel_com_cd').val(tel_com_cd);	// 통신사
	$('#cnFrm #tel_no').val(certify_mobile_0+certify_mobile_1+certify_mobile_2);	// 휴대폰번호

	jsSubmit_cnfrm();	// 휴대폰 인증 실행
	return;

}

// 실명인증 폼 실행
var jsSubmit_cnfrm = function(){

	var cnFrm = document.cnFrm;
	var isChecked = false;
	//var inTpBit = $("#cnFrm input[name='in_tp_bit']").val();	// 입력유형

	window.open("", "auth_popup", "width=430,height=590,scrollbar=yes");

	var cnFrm = document.cnFrm;
	cnFrm.target = "auth_popup";
	cnFrm.submit();
}
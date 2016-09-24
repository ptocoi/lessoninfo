$(function(){

	$('#pay_use_point').keydown(function(event){
		if(event.keyCode==13){	
			use_points();
			return false;
		}
	});

});

var pay_submit = function(){	// 선택 서비스 정보 form ajax 전송
	var total_price = $('#total_price').val();
	/*
	if(!total_price || total_price == '' || total_price == '0'){
		alert("결제할 서비스를 하나라도 선택해 주세요.");
		return;
	}
	*/

	var pay_options = { target: '', paySubmit: payRequest, success : payResponse };
	var pay_methods = $("input[name='pay_methods']").is(':checked');
	if( pay_methods == false ) {
		alert("결제수단을 선택해 주세요.");
		$("input[name='pay_methods']:first").focus();
		return;
	} else {
		var pay_method = $("input[name='pay_methods']:checked").val();
		$('#ServicePayment > #pay_method').val(pay_method);
		$('#PayGateFrm > #pay_method').val(pay_method);
	}
	$('#ServicePayment').attr("action", "./process/open_pay.php");
	$('#ServicePayment').ajaxSubmit(pay_options);
}

var payRequest = function(formData, jqForm, pay_options){
	var ServicePayment = document.getElementById('ServicePayment');
	var queryString = $.param(formData);
	return validate(ServicePayment);
}
var payResponse = function(responseText, statusText, xhr, $form){
	
	if(responseText == '0006' ){
		alert("결제 데이터 입력중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
	} else {
		var result = responseText.split('/');
		var pay_no = result[0], oid = result[1], price = result[2], pay_method = result[3];

		if(pay_method=='bank'){	// 무통장 입금
			var PayGateFrm = document.getElementById('PayGateFrm');
			if(validate(PayGateFrm)){
				$('#PayGateFrm').attr("action","./process/alba_pay_bank.php");
				$('#PayGateFrm').removeAttr("onsubmit");
				//location.href = "./success.php?oid=" + oid;
			}
		}

		if(price=='0'){	// 무료일때
			location.href = "./success.php?oid="+oid;
			return false;
		}

		$('#pay_no').val(pay_no);
		$('#oid').val(oid);	// 주문번호
		$('#price').val(price);

		if(pg_company=='inicis'){	// 이니시스

			$('#mid').val(mid);	 // 상점 아이디
			$('#PayGateFrm').submit();

		} else if(pg_company=='allthegate'){	// 올더게이트

			if(pay_method=='bank'){
				$('#PayGateFrm').submit();
			} else {
				return Pay(frmAGS_pay);
			}

		} else if(pg_company=='kcp'){	// KCP

			if(pay_method=='bank'){
				$('#PayGateFrm').submit();
			} else {
				return onload_pay();
			}

		}

	}

}
var use_points = function(){	 // 결제시 포인트 사용
	var pay_price = $('#pay_price').val();
	var $pay_use_point = $('#pay_use_point');
	if( !$pay_use_point.val() || $pay_use_point.val() == '' || $pay_use_point.val() == '0' ){
		alert("사용할 포인트를 입력해 주세요.");
		$pay_use_point.focus();
		return;
	} else {
		var use_point = $pay_use_point.val();
		if( Number(use_point) > Number(mb_point) ){
			alert("보유하신 포인트가 사용하고자 하시는 포인트보다 부족합니다.");
			return;
		} else {
			if(confirm( use_point.number_format() +" 포인트를 사용하시겠습니까?")){
				var total_price = Number(pay_price) - Number(use_point);
				$('#sumTotal_price').html( String(total_price).number_format() );
				$('#total_price').val(total_price);
				$('#use_point').val(use_point);
				return;
			}
		}
	}
}
var bank_lists = function( vals ){
	var sel = vals.value;
	if(sel || sel!=''){
		$('#tax_info').show();
	} else {
		$('#tax_info').hide();
	}
}
var sel_methods = function( vals ){		// 결제수단 선택시
	var method = vals.value;
	if( method == 'bank' ){	// 무통장 입금일때
		$('#bank_list').attr('required',true);
		$('#bank_info').show();
	} else {	 // 그외
		$('#bank_list').removeAttr('required');
		$('#bank_info').hide();
	}
}
var tax_uses = function( vals ){	// 현금영수증 발급
	var sel = vals.value;
	var checked = vals.checked;

	var pay_tax_type = $("input[name='pay_tax_type']:checked").val();

	if(checked == true ){	// 체크시
		$('#receipt').show();
		
		if(pay_tax_type=='1'){	// 일반개인용
			var pay_tax_num_type_sel = $("#pay_tax_num_type :selected").val();
			switch(pay_tax_num_type_sel){
				case '0': $('#pay_tax_num_person').attr('hname','주민등록번호'); break;
				case '1': $('#pay_tax_num_person').attr('hname','휴대폰번호'); break;
				case '2': $('#pay_tax_num_person').attr('hname','카드번호'); break;
			}
			$('#pay_tax_num_person').attr('required',true);
			$("input[name='pay_tax_num_biz[]']").removeAttr('required');
			$('#receipt_person').show();
			$('#receipt_biz').hide();
		} else {	 // 사업자용
			$('#pay_tax_num_person').removeAttr('required');
			$("input[name='pay_tax_num_biz[]']").attr('required',true);
			$('#receipt_person').hide();
			$('#receipt_biz').show();
		}

	} else {	 // 체크 해지시
		$('#pay_tax_num_person').removeAttr('required');
		$("input[name='pay_tax_num_biz[]']").removeAttr('required');
		$('#receipt').hide();
	}

}
var tax_num_type = function( vals ){
	var sel = vals.value;
	var $pay_tax_num_person = $('#pay_tax_num_person');
	switch(sel){
		case '0': $pay_tax_num_person.attr('hname','주민등록번호'); break;
		case '1': $pay_tax_num_person.attr('hname','휴대폰번호'); break;
		case '2': $pay_tax_num_person.attr('hname','카드번호'); break;
	}
	$pay_tax_num_person.attr('required',true);
}
var tax_type = function( vals ){	// 소득공제용 / 지출증빙용
	var sel = vals.value;
	if(sel=='1'){
		var pay_tax_num_type_sel = $("#pay_tax_num_type :selected").val();
		
		alert(pay_tax_num_type_sel);

		switch(pay_tax_num_type_sel){
			case '0': $('#pay_tax_num_person').attr('hname','주민등록번호'); break;
			case '1': $('#pay_tax_num_person').attr('hname','휴대폰번호'); break;
			case '2': $('#pay_tax_num_person').attr('hname','카드번호'); break;
		}
		$('#pay_tax_num_person').attr('required',true);
		$("input[name='pay_tax_num_biz[]']").removeAttr('required');
		$('#receipt_person').show();
		$('#receipt_biz').hide();
	} else {
		$('#pay_tax_num_person').removeAttr('required');
		$("input[name='pay_tax_num_biz[]']").attr('required',true);
		$('#receipt_person').hide();
		$('#receipt_biz').show();
	}
}


var total_sum_price = 0;	 // 최종 결제금액
var service_price_print = function( service, vals ){

	var sel = vals.value;
	var service_info = sel.split('/');
	var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];

	var $service_price_info = $("#"+service+"_price_info");

	var main_platinum_sel_price = 0, main_prime_sel_price = 0, main_grand_sel_price = 0, main_banner_sel_price = 0, main_list_sel_price = 0, alba_platinum_sel_price = 0, alba_banner_sel_price = 0, alba_list_sel_price = 0, alba_option_busy_sel_price = 0, alba_option_logo_sel_price = 0, alba_option_neon_sel_price = 0, alba_option_bold_sel_price = 0, alba_option_icon_sel_price = 0, alba_option_color_sel_price = 0, alba_option_blink_sel_price = 0, alba_option_jump_sel_price = 0, etc_open_sel_price = 0, alba_open_sel_price = 0;

	if(sel){

		$service_price_info.show();
	
	} else {

		$service_price_info.hide();

	}

	if(service_price && service_price!=0){	// 무료가 아닐때

		$('#'+service+"_price_info .won").show();

		if(service_percent!=0){	// 할인율 있을때

			$('#'+service+"_price_info em").show();
			$('#'+service+"_price_info .price").html( service_info[2].number_format() );
			$('#'+service+"_price_info .priceDc").html( service_percent + "%" );
			$('#'+service+"_price_info .pay .text_orange").html( total_price.number_format() );

		} else {	 // 할인율 없을때

			$('#'+service+"_price_info em").hide();
			$('#'+service+"_price_info .pay .text_orange").html( total_price.number_format() );

		}
		
	} else {	 // 무료일때

		$('#'+service+"_price_info em").hide();
		$('#'+service+"_price_info .pay .text_orange").html( "무료" );
		$('#'+service+"_price_info .won").hide();

	}

	var main_focus_sel = $('#main_focus_date :selected').attr('price');	// 메인 포커스
	var main_focus_sel_price = (main_focus_sel) ? Number(main_focus_sel) : 0;

	var alba_resume_focus_sel = $('#alba_resume_focus_date :selected').attr('price');	// 알바 포커스
	var alba_resume_focus_sel_price = (alba_resume_focus_sel) ? Number(alba_resume_focus_sel) : 0;

	var resume_option_busy_sel = $('#resume_option_busy_date :selected').attr('price');	// 급구 옵션
	var resume_option_busy_sel_price = (resume_option_busy_sel) ? Number(resume_option_busy_sel) : 0;

	var resume_option_neon_sel = $('#resume_option_neon_date :selected').attr('price');	// 형광펜 옵션
	var resume_option_neon_sel_price = (resume_option_neon_sel) ? Number(resume_option_neon_sel) : 0;

	var resume_option_bold_sel = $('#resume_option_bold_date :selected').attr('price');	// 굵은글자 옵션
	var resume_option_bold_sel_price = (resume_option_bold_sel) ? Number(resume_option_bold_sel) : 0;

	var resume_option_icon_sel = $('#resume_option_icon_date :selected').attr('price');	// 아이콘 옵션
	var resume_option_icon_sel_price = (resume_option_icon_sel) ? Number(resume_option_icon_sel) : 0;

	var resume_option_color_sel = $('#resume_option_color_date :selected').attr('price');	// 색상 옵션
	var resume_option_color_sel_price = (resume_option_color_sel) ? Number(resume_option_color_sel) : 0;

	var resume_option_blink_sel = $('#resume_option_blink_date :selected').attr('price');	// 반짝임 옵션
	var resume_option_blink_sel_price = (resume_option_blink_sel) ? Number(resume_option_blink_sel) : 0;

	var resume_option_jump_sel = $('#resume_option_jump_date :selected').attr('price');	// 점프 옵션
	var resume_option_jump_sel_price = (resume_option_jump_sel) ? Number(resume_option_jump_sel) : 0;

	var alba_open_sel = $('#etc_alba_date :selected').attr('price');	// 채용공고 열람 옵션
	var alba_open_sel_price = (alba_open_sel) ? Number(alba_open_sel) : 0;


	var sum_price = main_focus_sel_price + alba_resume_focus_sel_price + resume_option_busy_sel_price + resume_option_neon_sel_price + resume_option_bold_sel_price + resume_option_icon_sel_price + resume_option_color_sel_price + resume_option_blink_sel_price + resume_option_jump_sel_price + alba_open_sel_price;


	// 건별 결제일때 '오늘+' 없애기
	if( service_unit=='count' ){
		$('#etc_alba_today').hide();
	} else {
		$('#etc_alba_today').show();
	}

	total_sum_price = String(sum_price);

	$('#sumTotal_Price').html( total_sum_price.number_format() );
	$('#total_price').val(sum_price);	// 합산 결제 금액

}

var serviceFrm_submit = function( service ){	// 폼 전송
	
	if(service){
		var service_sel = $('#'+service+'_date :selected').val();
		if(service_sel=='' || !service_sel){
			alert("서비스 기간을 선택해 주세요.");
			$('#'+service+'_date').focus();
			return;
		}
		$('#sel_service').val(service);
	} else {
		var service_sel_cnt = 0;
		$('select').each(function(){
			if( $(this).val() != ""){
				service_sel_cnt++;
			}
		});
		if(service_sel_cnt==0){
			alert("서비스를 하나라도 선택해 주세요.");
			return;
		}
		$('#sel_service').val("");
	}
	$('#ServiceFrm').submit();
}
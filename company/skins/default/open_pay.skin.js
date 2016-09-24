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

	if( !total_price || total_price == 0 ){
		$('#ServicePayment > #pay_method').val('bank');
		$('#PayGateFrm > #pay_method').val('bank');
	} else {
		if( pay_methods == false ) {
			alert("결제수단을 선택해 주세요.");
			$("input[name='pay_methods']:first").focus();
			return;
		} else {
			var pay_method = $("input[name='pay_methods']:checked").val();
			$('#ServicePayment > #pay_method').val(pay_method);
			$('#PayGateFrm > #pay_method').val(pay_method);
		}
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
		
		//alert(pay_tax_num_type_sel);

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
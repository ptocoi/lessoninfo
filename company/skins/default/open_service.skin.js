$(function(){


});

var service_price_print = function( service, vals ){	// 서비스별 금액 출력
	var sel = vals.value;
	var service_info = sel.split('/');
	var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];

	var $service_price_info = $('#'+service+"_price_info");

	var etc_open_sel_price = 0;

	if(sel){
		$service_price_info.show();
	} else {
		$service_price_info.hide();
	}

	if(service_price && service_price!=0){	// 무료가 아닐때

		$('#'+service+"_price_info .won").show();

		if(service_percent!=0){	// 할인율 있을때

			$('#'+service+"_price_info .positionA").show();
			$('#'+service+"_price_info .price").html( service_info[2].number_format() );
			$('#'+service+"_price_info .priceDc").html( service_percent + "%" );
			$('#'+service+"_price_info .pay .text_orange").html( total_price.number_format() );

		} else {	 // 할인율 없을때

			$('#'+service+"_price_info .positionA").hide();
			$('#'+service+"_price_info .pay .text_orange").html( total_price.number_format() );

		}
		
	} else {	 // 무료일때

		$('#'+service+"_price_info .pay .text_orange").html( "무료" );
		$('#'+service+"_price_info .won").hide();

	}

	var etc_open_sel = $('#etc_open_date :selected').attr('price');	// 이력서 열람
	var etc_open_sel_price = (etc_open_sel) ? Number(etc_open_sel) : 0;

	var sum_price = etc_open_sel_price;

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
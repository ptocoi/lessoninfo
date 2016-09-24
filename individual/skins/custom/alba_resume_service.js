$(function(){

	var colour;
	setInterval(function(){
		colour = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);	
		$('.jumble').animate({
			color: colour
		});
	}, 500);

	var package_no_length = $("input[name='package_no']").length;

});

var total_sum_price = 0;	 // 최종 결제금액
var service_price_print = function( service, vals ){

	var sel = vals.value;
	var service_info = sel.split('/');
	var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];

	var $service_price_info = $("#"+service+"_price_info");

	var main_platinum_sel_price = 0, main_prime_sel_price = 0, main_grand_sel_price = 0, main_banner_sel_price = 0, main_list_sel_price = 0, alba_platinum_sel_price = 0, alba_banner_sel_price = 0, alba_list_sel_price = 0, alba_option_busy_sel_price = 0, alba_option_logo_sel_price = 0, alba_option_neon_sel_price = 0, alba_option_bold_sel_price = 0, alba_option_icon_sel_price = 0, alba_option_color_sel_price = 0, alba_option_blink_sel_price = 0, alba_option_jump_sel_price = 0, etc_open_sel_price = 0, alba_open_sel_price = 0, etc_sms_sel_price = 0;

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

	var main_rbasic_date_sel = $('#main_rbasic_date :selected').attr('price');	// 정규직 일반리스트
	var main_rbasic_date_sel_price = (main_rbasic_date_sel) ? Number(main_rbasic_date_sel) : 0;

	var alba_resume_focus_sel = $('#alba_resume_focus_date :selected').attr('price');	// 정규직 포커스
	var alba_resume_focus_sel_price = (alba_resume_focus_sel) ? Number(alba_resume_focus_sel) : 0;

	var alba_resume_basic_date_sel = $('#alba_resume_basic_date :selected').attr('price');	// 정규직 일반리스트
	var alba_resume_basic_date_sel_price = (alba_resume_basic_date_sel) ? Number(alba_resume_basic_date_sel) : 0;

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

	var etc_sms_sel = $('#etc_sms_date :selected').attr('price');	// SMS 충전 옵션
	var etc_sms_sel_price = (etc_sms_sel) ? Number(etc_sms_sel) : 0;


	var sum_price = main_focus_sel_price + alba_resume_focus_sel_price + resume_option_busy_sel_price + resume_option_neon_sel_price + resume_option_bold_sel_price + resume_option_icon_sel_price + resume_option_color_sel_price + resume_option_blink_sel_price + resume_option_jump_sel_price + alba_open_sel_price + main_rbasic_date_sel_price + alba_resume_basic_date_sel_price + etc_sms_sel_price;


	// 건별 결제일때 '오늘+' 없애기
	if( service == 'etc_alba' && service_unit=='count' ){
		$('#etc_alba_today').hide();
	} else {
		$('#etc_alba_today').show();
	}

	total_sum_price = String(sum_price);

	$('#sumTotal_Price').html( total_sum_price.number_format() );
	$('#total_price').val(sum_price);	// 합산 결제 금액

}

var option_neon_sel = function( vals ){	// 형광펜 칼라선택시 미리보기
	var sel = vals.value;
	$('.neon_preview').css( "background-color" , '#'+sel );
}
var option_icon_sel = function( name ){
	$('.icon_preview').attr('src',data_icon_path+"/"+name);
}
var option_color_sel = function( vals ){
	var sel = vals.value;
	$('.color_preview').css( "color" , '#'+sel );
}
var serviceFrm_submit = function( service, is_package ){	// 폼 전송
	if(is_package){
		$("input[name='package_no']").each(function(){
			$(this).removeAttr('checked');
		});
		$('#package_'+service).attr('checked','checked');
	} else {
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
			$("input[name='package_no']").each(function(){
				if( $(this).is(' :checked') ){
					service_sel_cnt++;
				}
			});
			if(service_sel_cnt==0){
				alert("서비스를 하나라도 선택해 주세요.");
				return;
			}
			$('#sel_service').val("");
		}
	}
	$('#ServiceFrm').submit();
}

var service_preview = function( service ){

	$('#'+service+'_preview').toggle();

}

var serviceFrm_ended = function(){	 // 서비스 마감
	alert("서비스가 마감되어 더이상 등록 불가능 합니다");
	return;
}

var package_on = function( vals ){
	var checked = vals.checked;
	$("input[name='package_no']").each(function(){
		$(this).removeAttr('checked');
	});
	if(checked==true){
		vals.checked = true;
	} else {
		vals.checked = false;
	}
}

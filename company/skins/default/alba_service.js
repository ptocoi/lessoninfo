$(function(){

	fade_images('fade_image');	// 페이드 형태
	setInterval(function(){
		fade_images('fade_image');
	}, 3000);

	blink('blink_image',900000,1500);	// 깜빡임

	$('.slide_image').cycle({ 
		fx:     cycle_direction, 
		easing: 'easeInOutBack',
		delay:  -2000 
	});

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
var service_price_print = function( service, vals ){	// 서비스별 금액 출력
	var sel = vals.value;
	var service_info = sel.split('/');
	var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];

	var $service_price_info = $('#'+service+"_price_info");

	var main_platinum_sel_price = 0, main_prime_sel_price = 0, main_grand_sel_price = 0, main_banner_sel_price = 0, main_list_sel_price = 0, alba_platinum_sel_price = 0, alba_banner_sel_price = 0, alba_list_sel_price = 0, alba_option_busy_sel_price = 0, alba_option_logo_sel_price = 0, alba_option_neon_sel_price = 0, alba_option_bold_sel_price = 0, alba_option_icon_sel_price = 0, alba_option_color_sel_price = 0, alba_option_blink_sel_price = 0, alba_option_jump_sel_price = 0, etc_open_sel_price = 0, etc_sms_sel_price = 0;

	if(sel){

		$service_price_info.show();
	
	} else {

		$service_price_info.hide();

	}

	if(service_price && service_price!=0){	// 무료가 아닐때

		$('#'+service+"_price_info .won").show();

		if(service_percent!=0){	// 할인율 있을때
			
			$("#"+service+"_price_info em .price").html(service_info[2].number_format());
			$("#"+service+"_price_info em .priceDc").html(service_percent + "%");
			$("#"+service+"_price_info em").show();
			$("#"+service+"_price_info .pay > .text_orange").html( total_price.number_format() );

			/*
			$('#'+service+"_price_info .positionA").show();
			$('#'+service+"_price_info .price").html( service_info[2].number_format() );
			$('#'+service+"_price_info .priceDc").html( service_percent + "%" );
			$('#'+service+"_price_info .pay .text_orange").html( total_price.number_format() );
			*/

		} else {	 // 할인율 없을때

			$("#"+service+"_price_info em").hide();
			$("#"+service+"_price_info .pay > .text_orange").html( total_price.number_format() );

			/*
			$('#'+service+"_price_info .positionA").hide();
			$('#'+service+"_price_info .pay .text_orange").html( total_price.number_format() );
			*/

		}

		//alert( service_price + " @ " + total_price );

		//total_sum_price += total_price;
		
	} else {	 // 무료일때

		$("#"+service+"_price_info .text_orange").html( "무료" );
		$("#"+service+"_price_info em, #"+service+"_price_info .won").hide();

	}

	var main_platinum_sel = $('#main_platinum_date :selected').attr('price');	// 메인 플래티넘
	var main_platinum_sel_price = (main_platinum_sel) ? Number(main_platinum_sel) : 0;
	/*
	if( $main_platinum_sel.val() ){	// 선택 값이 있을때
		var main_platinum_sel_price = Number( $main_platinum_sel.attr('price') ) ;
	}
	*/
	var main_prime_sel = $('#main_prime_date :selected').attr('price');	// 메인 프라임
	var main_prime_sel_price = (main_prime_sel) ? Number(main_prime_sel) : 0;
	var main_grand_sel = $('#main_grand_date :selected').attr('price');	// 메인 그랜드
	var main_grand_sel_price = (main_grand_sel) ? Number(main_grand_sel) : 0;
	var main_banner_sel = $('#main_banner_date :selected').attr('price');	// 메인 배너형
	var main_banner_sel_price = (main_banner_sel) ? Number(main_banner_sel) : 0;
	var main_list_sel = $('#main_list_date :selected').attr('price');	// 메인 배너형
	var main_list_sel_price = (main_list_sel) ? Number(main_list_sel) : 0;

	var alba_platinum_sel = $('#alba_platinum_date :selected').attr('price');	// 서브 플래티넘
	var alba_platinum_sel_price = (alba_platinum_sel) ? Number(alba_platinum_sel) : 0;
	var alba_banner_sel = $('#alba_banner_date :selected').attr('price');	// 서브 배너형
	var alba_banner_sel_price = (alba_banner_sel) ? Number(alba_banner_sel) : 0;
	var alba_list_sel = $('#alba_list_date :selected').attr('price');	// 서브 리스트형
	var alba_list_sel_price = (alba_list_sel) ? Number(alba_list_sel) : 0;

	var alba_option_busy_sel = $('#alba_option_busy_date :selected').attr('price');	// 급구 옵션
	var alba_option_busy_sel_price = (alba_option_busy_sel) ? Number(alba_option_busy_sel) : 0;

	var alba_option_logo_sel = $('#alba_option_logo_date :selected').attr('price');	// 로고강조 옵션
	var alba_option_logo_sel_price = (alba_option_logo_sel) ? Number(alba_option_logo_sel) : 0;

	var alba_option_neon_sel = $('#alba_option_neon_date :selected').attr('price');	// 형광펜 옵션
	var alba_option_neon_sel_price = (alba_option_neon_sel) ? Number(alba_option_neon_sel) : 0;
	var alba_option_bold_sel = $('#alba_option_bold_date :selected').attr('price');	// 굵은글자 옵션
	var alba_option_bold_sel_price = (alba_option_bold_sel) ? Number(alba_option_bold_sel) : 0;
	var alba_option_icon_sel = $('#alba_option_icon_date :selected').attr('price');	// 아이콘 옵션
	var alba_option_icon_sel_price = (alba_option_icon_sel) ? Number(alba_option_icon_sel) : 0;
	var alba_option_color_sel = $('#alba_option_color_date :selected').attr('price');	// 글자색 옵션
	var alba_option_color_sel_price = (alba_option_color_sel) ? Number(alba_option_color_sel) : 0;
	var alba_option_blink_sel = $('#alba_option_blink_date :selected').attr('price');	// 반짝 옵션
	var alba_option_blink_sel_price = (alba_option_blink_sel) ? Number(alba_option_blink_sel) : 0;

	var alba_option_jump_sel = $('#alba_option_jump_date :selected').attr('price');	// 점프 옵션
	var alba_option_jump_sel_price = (alba_option_jump_sel) ? Number(alba_option_jump_sel) : 0;

	var etc_open_sel = $('#etc_open_date :selected').attr('price');	// 이력서 열람
	var etc_open_sel_price = (etc_open_sel) ? Number(etc_open_sel) : 0;

	var etc_sms_sel = $('#etc_sms_date :selected').attr('price');	// SMS 충전
	var etc_sms_sel_price = (etc_sms_sel) ? Number(etc_sms_sel) : 0;

	var sum_price = main_platinum_sel_price+main_prime_sel_price+main_grand_sel_price+main_banner_sel_price+main_list_sel_price+alba_platinum_sel_price+alba_banner_sel_price+alba_list_sel_price+alba_option_busy_sel_price+alba_option_logo_sel_price+alba_option_neon_sel_price+alba_option_bold_sel_price+alba_option_icon_sel_price+alba_option_color_sel_price+alba_option_blink_sel_price+alba_option_jump_sel_price+etc_open_sel_price+etc_sms_sel_price;


	//alert( service_cnt+"\n\n"+service_unit );

	// 건별 결제일때 '오늘+' 없애기
	if( service == 'etc_open' && service_unit == 'count' ){
		$('#etc_open_today').hide();
	} else {
		$('#etc_open_today').show();
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
/*
var service_location = function( service ){	// 서비스 메뉴 선택
	$('#service_loc a').removeClass('on');
	$('#'+service+'_on').addClass('on');

	if( service == 'all' ){	// 전체
		$('.serviceListWrap').show();
	} else {
		$('.serviceListWrap').hide();
		switch(service){
			case 'main': $('#main_service').show(); break;
			case 'main': $('#main_service').show(); break;
		}
	}
}
*/
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

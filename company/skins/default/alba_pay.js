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

	var colour;
	setInterval(function(){
		colour = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);	
		$('.text1 a.blink, .title a.blink').animate({
			color: colour
		});
	}, 500);

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

	var pay_options = { target: '', beforeSubmit: payRequest, success : payResponse };
	var pay_methods = $("input[name='pay_methods']").is(':checked');
	
	if(total_price!=0){
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
	$('#ServicePayment').attr("action", "./process/alba_pay.php");
	$('#ServicePayment').ajaxSubmit(pay_options);
	//$('#ServicePayment').submit();
	//document.ServicePayment.submit();
}
var payRequest = function(formData, jqForm, pay_options){
	var ServicePayment = document.getElementById('ServicePayment');
	var PayGateFrm = document.getElementById('PayGateFrm');
	var queryString = $.param(formData);
	if(validate(PayGateFrm)){
		return validate(ServicePayment);
	} else {
		return false;
	}
}
var payResponse = function(responseText, statusText, xhr, $form){

	if(responseText == '0006' ){
		alert("결제 데이터 입력중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
	} else {
		var result = responseText.split('/');
		var pay_no = result[0], oid = result[1], price = result[2], pay_method = result[3];

		/*
		alert(pay_no+"\n\n"+oid+"\n\n"+price+"\n\n"+pay_method);
		return false;
		*/

		if(pay_method=='bank'){	// 무통장 입금
			var PayGateFrm = document.getElementById('PayGateFrm');
			if(validate(PayGateFrm)){
				$('#PayGateFrm').attr("action","./process/alba_pay_bank.php");
				$('#PayGateFrm').removeAttr("onsubmit");
				//location.href = "./success.php?oid=" + oid;
			}/* else {
				return;
			}*/
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
var once_service_price_print = function( service, vals ){	// 단일 서비스 금액

	var sel = vals.value;
	var service_info = sel.split('/');
	var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];

	var $service_price_info = $('#'+service+"_price_info");
	var service_text = $("#"+service+"_date :selected").text();

	if(sel){

		$service_price_info.show();

		var $service_list = $('#service_list > #'+service);
		var service_length = $service_list.length;	// 기본 서비스 존재 유무
		var service_list = "";

		var date = new Date();
		var end_date = new Date();

		// 날짜 단위
		if(service_unit=='day') {
			units = "일";
			end_date.setDate( end_date.getDate() + Number(service_cnt) );
		} else if(service_unit=='week') {
			units = "주";
			end_date.setDate( end_date.getDate() + (Number(service_cnt) * 7 ) );
		} else if(service_unit=='month') {
			units = "월";
			end_date.setMonth( end_date.getMonth() + Number(service_cnt) );
		} else if(service_unit=='year') {
			units = "년";
			end_date.setYear( end_date.getYear() + Number(service_cnt) );
		}

		if(service=='main_platinum'){
			var service_title = "메인 플래티넘";
		} else if(service=='main_prime'){
			var service_title = "메인 프라임";
		} else if(service=='main_grand'){
			var service_title = "메인 그랜드";
		} else if(service=='main_banner'){
			var service_title = "메인 배너형";
		} else if(service=='main_list'){
			var service_title = "메인 리스트형";
		} else if(service=='main_basic'){
			var service_title = "메인 일반리스트";
		} else if(service=='alba_platinum'){
			var service_title = "채용정보 플래티넘";
		} else if(service=='alba_banner'){
			var service_title = "채용정보 배너형";
		} else if(service=='alba_list'){
			var service_title = "채용정보 리스트형";
		} else if(service=='alba_basic'){
			var service_title = "채용정보 일반리스트";
		} else if(service=='alba_option_busy'){
			var service_title = "일반 리스트 급구 아이콘";
		} else if(service=='alba_option_neon'){
			var service_title = "일반 리스트 제목 강조";
		} else if(service=='alba_option_bold'){
			var service_title = "일반 리스트 제목 굵게";
		} else if(service=='alba_option_icon'){
			var service_title = "일반 리스트 아이콘 강조";
		} else if(service=='alba_option_color'){
			var service_title = "일반 리스트 제목 글자색";
		} else if(service=='alba_option_blink'){
			var service_title = "일반 리스트 제목 반짝칼라";
		}

		if(service_price!=0){	// 무료가 아닐때

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

			$("#"+service+"_orange_block").show();
			$("#"+service+"_orange").html( "<strong class=\"unitPrice text_orange\">"+total_price.number_format()+"</strong>원" );

			// 날짜
			var cur_month = '%02d' . sprintf( ( date.getMonth()+1 ) ), cur_day = '%02d' . sprintf( date.getDate() );
			var cur_date = date.getFullYear() + "." + cur_month + "." + cur_day;
			var eur_month = '%02d' . sprintf( end_date.getMonth()+1 ), eur_day = '%02d' . sprintf( end_date.getDate() );
			var eur_date = end_date.getYear() + "." + eur_month + "." + eur_day;
			var total_prices = String(service_price).number_format() + "원";

			if( service_length > 0 ){	// 서비스가 있다면
				$service_list.remove();
			}

			service_list += "<tr id=\""+service+"\">";
			service_list += "<td class=\"tc\" height=\"50\"><span><strong>"+service_title+"</strong></span></td>";
			service_list += "<td class=\"tl\"><span>오늘 +"+service_cnt+units+" ("+cur_date+"~"+eur_date+")</span></td>";
			service_list += "<td class=\"tc\"><span id=\""+service+"_price_val\">"+total_prices+"</span></td>";
			service_list += "<td class=\"tc\"><span class=\"text_red\"><strong id=\""+service+"_total_val\">\\"+String(total_price).number_format()+"</strong></span></td>";
			service_list += "</tr>";
			
		} else {	 // 무료일때

			$('#'+service+'_price_val').html("무료");
			$('#'+service+'_total_val').html("\\0");

			$('#'+service+"_price_info .pay .text_orange").html( "무료" );
			$('#'+service+"_price_info .won").hide();

			$("#"+service+"_orange_block").show();
			$("#"+service+"_orange").html( "<strong class=\"unitPrice text_orange\">무료</strong>" );
		}

		$('#service_list').append( service_list );

	} else {

		$service_price_info.hide();

		$("#"+service+"_orange_block").hide();
		$("#"+service).remove();

	}

	total_service_sum_price();

}
var once_gold_service = function( service, vals ){	// 단일 골드 서비스
	
	var sel = vals.value;
	var checked = vals.checked;

	var $service_price_info = $('#'+sel_service+"_gold_price_info");
	var service_text = $("#"+sel_service+"_gold_date :selected").text();

	var $service_list = $('#service_list > #'+service);
	var service_length = $service_list.length;	// 기본 서비스 존재 유무
	var service_list = "";

	if(checked==true){

		$('.'+service).show();
		$('#'+service+'_date').change(function(){
			var service_info = $(this).val().split('/');
			var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];
			var $service_price_info = $('#'+service+"_price_info");
			var service_text = $("#"+service+"_date :selected").text();
			
			$service_price_info.show();

			var $service_list = $('#service_list > #'+service);
			var service_length = $service_list.length;	// 기본 서비스 존재 유무

			var service_list = "";

			var date = new Date();
			var end_date = new Date();

			// 날짜 단위
			if(service_unit=='day') {
				units = "일";
				end_date.setDate( end_date.getDate() + Number(service_cnt) );
			} else if(service_unit=='week') {
				units = "주";
				end_date.setDate( end_date.getDate() + (Number(service_cnt) * 7 ) );
			} else if(service_unit=='month') {
				units = "월";
				end_date.setMonth( end_date.getMonth() + Number(service_cnt) );
			} else if(service_unit=='year') {
				units = "년";
				end_date.setYear( end_date.getYear() + Number(service_cnt) );
			}

			switch(service){
				case 'main_platinum_gold':
					var service_title = "메인 플래티넘 Gold";
				break;
				case 'main_prime_gold':
					var service_title = "메인 프라임 Gold";
				break;
				case 'main_grand_gold':
					var service_title = "메인 그랜드 Gold";
				break;
				case 'main_banner_gold':
					var service_title = "메인 배너형 Gold";
				break;
				case 'main_list_gold':
					var service_title = "메인 리스트형 Gold";
				break;
				case 'alba_platinum_gold':
					var service_title = "채용정보 플래티넘 Gold";
				break;
				case 'alba_banner_gold':
					var service_title = "채용정보 배너형 Gold";
				break;
				case 'alba_list_gold':
					var service_title = "채용정보 리스트형 Gold";
				break;
			}

			if( service_length > 0 ){	// 서비스가 있다면
				$service_list.remove();
			}

			// 날짜
			var cur_month = '%02d' . sprintf( ( date.getMonth()+1 ) ), cur_day = '%02d' . sprintf( date.getDate() );
			var cur_date = date.getFullYear() + "." + cur_month + "." + cur_day;
			var eur_month = '%02d' . sprintf( end_date.getMonth()+1 ), eur_day = '%02d' . sprintf( end_date.getDate() );
			var eur_date = end_date.getYear() + "." + eur_month + "." + eur_day;
			var total_prices = String(service_price).number_format() + "원";

			if( $(this).val() != "" ){

				if(service_price!=0){	// 무료가 아닐때

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

					service_list += "<tr id=\""+service+"\">";
					service_list += "<td class=\"tc\" height=\"50\"><span><strong>"+service_title+"</strong></span></td>";
					service_list += "<td class=\"tl\"><span>오늘 +"+service_cnt+units+" ("+cur_date+"~"+eur_date+")</span></td>";
					service_list += "<td class=\"tc\"><span id=\""+service+"_price_val\">"+total_prices+"</span></td>";
					service_list += "<td class=\"tc\"><span class=\"text_red\"><strong id=\""+service+"_total_val\">\\"+String(total_price).number_format()+"</strong></span></td>";
					service_list += "</tr>";

					$('#'+service+'_msg').html("(배경색으로 강조 : <strong>+"+total_price.number_format()+"</strong>원/"+service_cnt+units+")");

				} else if(service_price==0){	 // 무료 일때

					service_list += "<tr id=\""+service+"\">";
					service_list += "<td class=\"tc\" height=\"50\"><span><strong>"+service_title+"</strong></span></td>";
					service_list += "<td class=\"tl\"><span>오늘 +"+service_cnt+units+" ("+cur_date+"~"+eur_date+")</span></td>";
					service_list += "<td class=\"tc\"><span id=\""+service+"_price_val\">무료</span></td>";
					service_list += "<td class=\"tc\"><span class=\"text_red\"><strong id=\""+service+"_total_val\">\\0</strong></span></td>";
					service_list += "</tr>";

					$('#'+service+'_msg').html("(배경색으로 강조 : <strong>무료</strong>/"+service_cnt+units+")");

					$('#'+service+"_price_info .pay .text_orange").html( "무료" );
					$('#'+service+"_price_info .won").hide();

				} else {	 // 아무것도 선택하지 않았을때

					$('#'+service+'_msg').html("배경색으로 강조");
					$('#'+service+"_price_info .won").hide();

				}

				$('#service_list').append( service_list );

			} else {	 // 아무것도 선택하지 않았을때

				$('#'+service+'_msg').html("배경색으로 강조");
				$service_price_info	.hide();
				$('#'+service+"_price_info .won").hide();

			}

			total_service_sum_price();

		});

		$('.'+service+' .is_gold > li:first').addClass('gold');	// gold class add (gold service)
		
	} else {

		// 초기화
		$('#'+service+'_msg').html("배경색으로 강조");
		$service_price_info	.hide();
		$("#"+service+"_date :eq(0)").attr("selected",true);
		//$('.'+service).hide();
		$('#'+service+'_msg, .'+service+'_info').hide();

		$service_list.remove();

		$('.'+service+' .is_gold > li:first').removeClass('gold');	// gold class remove (gold service)

		total_service_sum_price();

	}

}
var once_option_logo = function( vals, id_name ){	// 단일 로고 강조 옵션
	var sel = vals.value;
	var checked = vals.checked;

	var $service_price_info = $("#"+id_name+"_logo_price_info");
	var service_text = $("#"+id_name+"_logo_date :selected").text();

	var $service_list = $("#service_list > #"+id_name+"_logo");
	var service_length = $service_list.length;	// 기본 서비스 존재 유무
	var service_list = "";

	if(checked==true){

		$("."+id_name+"_logo").show();

		// 미리보기에 애니 적용한다.
		var logo_effects = $("input[name='"+id_name+"_logo_effect']:checked").val();
		if(logo_effects=='0'){	// 페이드 형태
			$("#"+id_name+"_preview_logo").show();
			$("."+id_name+"_slide_preview").hide();
			$("."+id_name+"_logo_preview").addClass(id_name+"_fade_preview");
			fade_images(id_name+"_fade_preview");
			setInterval(function(){
				fade_images(id_name+"_fade_preview");
			}, 3000);
		} else if(logo_effects=='1'){	 // 깜빡임
			$("#"+id_name+"_preview_logo").show();
			$("."+id_name+"_slide_preview").hide();
			$("."+id_name+"_logo_preview").addClass(id_name+"_blink_preview");
			blink(id_name+"_blink_preview",900000,1500);
		} else if(logo_effects=='2'){	 // 슬라이드
			$("#"+id_name+"_preview_logo").hide();
			$("."+id_name+"_slide_preview").show();
			$("."+id_name+"_slide_preview").cycle({ 
				fx:     cycle_direction, 
				easing: 'easeInOutBack',
				delay:  -2000 
			});
		}

		$("#"+id_name+"_logo_date").change(function(){
			var service_info = $(this).val().split('/');
			var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];
			var $service_price_info = $("#"+id_name+"_logo_price_info");
			var service_text = $("#"+id_name+"_logo_date :selected").text();

			$service_price_info.show();

			var $service_list = $("#service_list > #"+id_name+"_logo");
			var service_length = $service_list.length;	// 기본 서비스 존재 유무
			var service_list = "";

			var date = new Date();
			var end_date = new Date();
			/* Netscape 계열 에서 getFullYear() 조차 작동하지 않을때
			var browserName = navigator.appName;
			if(browserName=='Netscape'){
				end_date_year = end_date.getYear() + 1900;
			}
			*/

			// 날짜 단위
			if(service_unit=='day') {
				units = "일";
				end_date.setDate( end_date.getDate() + Number(service_cnt) );
			} else if(service_unit=='week') {
				units = "주";
				end_date.setDate( end_date.getDate() + (Number(service_cnt) * 7 ) );
			} else if(service_unit=='month') {
				units = "개월";
				end_date.setMonth( end_date.getMonth() + Number(service_cnt) );
			} else if(service_unit=='year') {
				units = "년";
				end_date.setYear( end_date.getFullYear() + Number(service_cnt) );
			}

			switch(id_name){
				case 'main_platinum':
					var service_title = "메인 플래티넘 로고강조";
				break;
				case 'main_prime':
					var service_title = "메인 프라임 로고강조";
				break;
				case 'main_grand':
					var service_title = "메인 그랜드 로고강조";
				break;
				case 'alba_platinum':
					var service_title = "채용정보 플래티넘 로고강조";
				break;
			}


			if( service_length > 0 ){	// 서비스가 있다면
				$service_list.remove();
			}

			// 날짜
			var cur_month = '%02d' . sprintf( ( date.getMonth()+1 ) ), cur_day = '%02d' . sprintf( date.getDate() );
			var cur_date = date.getFullYear() + "." + cur_month + "." + cur_day;
			var eur_month = '%02d' . sprintf( end_date.getMonth()+1 ), eur_day = '%02d' . sprintf( end_date.getDate() );
			var eur_date = end_date.getFullYear() + "." + eur_month + "." + eur_day;
			var total_prices = String(service_price).number_format() + "원";

			if( $(this).val() != "" ){

				if(service_price!=0){	// 무료가 아닐때

					$("#"+id_name+"_logo_price_info .won").show();

					if(service_percent!=0){	// 할인율 있을때

						$("#"+id_name+"_logo_price_info .positionA").show();
						$("#"+id_name+"_logo_price_info .price").html( service_info[2].number_format() );
						$("#"+id_name+"_logo_price_info .priceDc").html( service_percent + "%" );
						$("#"+id_name+"_logo_price_info .pay .text_orange").html( total_price.number_format() );

					} else {	 // 할인율 없을때

						$("#"+id_name+"_logo_price_info .positionA").hide();
						$("#"+id_name+"_logo_price_info .pay .text_orange").html( total_price.number_format() );

					}

					service_list += "<tr id=\""+id_name+"_logo\">";
					service_list += "<td class=\"tc\" height=\"50\"><span><strong>"+service_title+"</strong></span></td>";
					service_list += "<td class=\"tl\"><span>오늘 +"+service_cnt+units+" ("+cur_date+"~"+eur_date+")</span></td>";
					service_list += "<td class=\"tc\"><span id=\"alba_option_logo_price_val\">"+total_prices+"</span></td>";
					service_list += "<td class=\"tc\"><span class=\"text_red\"><strong id=\"alba_option_logo_total_val\">\\"+String(total_price).number_format()+"</strong></span></td>";
					service_list += "</tr>";

					$("#"+id_name+"_logo_msg").html("(움직이는 로고가 노출 : <strong>+"+total_price.number_format()+"</strong>원/"+service_cnt+units+")");

				} else if(service_price==0){	 // 무료 일때

					service_list += "<tr id=\""+id_name+"_logo\">";
					service_list += "<td class=\"tc\" height=\"50\"><span><strong>"+service_title+"</strong></span></td>";
					service_list += "<td class=\"tl\"><span>오늘 +"+service_cnt+units+" ("+cur_date+"~"+eur_date+")</span></td>";
					service_list += "<td class=\"tc\"><span id=\"alba_option_logo_price_val\">무료</span></td>";
					service_list += "<td class=\"tc\"><span class=\"text_red\"><strong id=\"alba_option_logo_total_val\">\\0</strong></span></td>";
					service_list += "</tr>";

					$("#"+id_name+"_logo_msg").html("(배경색으로 강조 : <strong>무료</strong>/"+service_cnt+units+")");

					$("#"+id_name+"_logo_price_val").html("무료");
					$("#"+id_name+"_logo_total_val").html("\\0");

					$("#"+id_name+"_logo_price_info .pay .text_orange").html( "무료" );
					$("#"+id_name+"_logo_price_info .won").hide();

				} else {	 // 아무것도 선택하지 않았을때

					$("#"+id_name+"_logo_msg").html("움직이는 로고가 노출");
					$("#"+id_name+"_logo_price_info .won").hide();

				}

				$("#service_list").append( service_list );

			} else {	 // 아무것도 선택하지 않았을때

				$("#"+id_name+"_logo_msg").html("움직이는 로고가 노출");
				$service_price_info	.hide();
				$("#"+id_name+"_logo_price_info .won").hide();

			}

			total_service_sum_price();

		});

	} else {

		// 미리보기에 애니 해제한다.
		$("."+id_name+"_logo").removeClass(id_name+"_fade_preview");	// 클래스 초기화
		$("."+id_name+"_logo").removeClass(id_name+"_blink_preview");
		$("."+id_name+"_logo").removeClass(id_name+"_slide_preview");

		// 초기화
		$("#"+id_name+"_logo_msg").html("움직이는 로고가 노출");
		$service_price_info	.hide();
		$("#"+id_name+"_logo_date :eq(0)").attr("selected",true);
		$("."+id_name+"_logo").hide();
		$service_list.remove();

		total_service_sum_price();

	}

}
var option_service = function( service, vals, is_option ){	// 강조 옵션
	var sel = vals.value;
	var checked = vals.checked;

	var $service_list = $('#service_list > #alba_option_'+service);
	var $service_price_info = $('#alba_option_'+service+"_price_info");

	if(checked==true){

		switch(service){
			case 'neon':	// 형광펜
				var alba_option_neon_sel = $("input[name='alba_option_neon_sel']:checked").val();
				$('.text1 a, .title a').css( "background-color", "#"+alba_option_neon_sel );
			break;
			case 'bold':	// 굵은글자
				$('.text1 a, .title a').css( "font-weight", "bold");
			break;
			case 'icon':	// 아이콘
				var alba_option_icon_sel = $("input[name='alba_option_icon_sel']:checked").val();
				var alba_option_icon = $('#alba_option_icon_'+alba_option_icon_sel).html();
				if( $('.title span.icon').length ){	// 급구로 선택한 경우
					$('.text1 span.icon').html(alba_option_icon);
					$('.title span.icons').html(alba_option_icon);
				} else {
					$('.text1 span.icon').html(alba_option_icon);
				}
			break;
			case 'color':	// 글자색
				var alba_option_color_sel = $("input[name='alba_option_color_sel']:checked").val();
				$('.text1 a, .title a').css( "color", "#"+alba_option_color_sel );
			break;
			case 'blink':	// 반짝칼라
				$('.text1 a, .title a').addClass('blink');
				var colour;
				setInterval(function(){
					colour = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);	
					$('.text1 a.blink, .title a.blink').animate({
						color: colour
					});
				}, 500);
			break;
		}

		$('.alba_option_'+service).show();

	} else {

		switch(service){
			case 'neon':	// 형광펜
				var alba_option_neon_sel = $("input[name='alba_option_neon_sel']:checked").val();
				$('.text1 a, .title a').css( "background-color", "" );
				$('#alba_option_neon_msg').html("알바공고 제목을 형광펜 강조 효과");
			break;
			case 'bold':	// 굵은글자
				$('.text1 a, .title a').css( "font-weight", "");
				$('#alba_option_bold_msg').html("알바공고 제목을 굵은 글자로 강조 효과");
			break;
			case 'icon':	// 아이콘
				$('.text1 span.icon, .title span.icons').html("");
				$('#alba_option_icon_msg').html("알바공고 제목을 아이콘으로 강조 효과");
			break;
			case 'color':	// 글자색
				$('.text1 a, .title a').css( "color", "" );
				$('#alba_option_color_msg').html("알바공고 제목을 글자색으로 강조 효과");
			break;
			case 'blink':	// 반짝칼라
				$('.text1 a, .title a').stop();
				$('.text1 a, .title a').removeClass('blink');
				var alba_option_color_sel = $("input[name='alba_option_color_sel']:checked").val();
				$('.text1 a, .title a').css( "color", "#"+alba_option_color_sel );
				$('#alba_option_blink_msg').html("알바공고 제목을  반짝컬러 강조 효과");
			break;
		}

		$service_list.remove();
		$service_price_info.hide();
		$("#alba_option_"+service+"_date :eq(0)").attr("selected",true);
		$('.alba_option_'+service).hide();
		$service_list.remove();

	}

	if(!is_option) total_service_sum_price( true );

}
var option_price_print = function( service, vals ){		// 강조옵션 체크
	
	var sel = vals.value;

	var sel = vals.value;
	var service_info = sel.split('/');
	var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];

	var $service_price_info = $('#'+service+"_price_info");
	var service_text = $("#"+service+"_date :selected").text();

	var $service_list = $('#service_list > #'+service);
	var service_length = $service_list.length;	// 기본 서비스 존재 유무
	var service_list = "";

	var date = new Date();
	var end_date = new Date();

	// 날짜 단위
	if(service_unit=='day') {
		units = "일";
		end_date.setDate( end_date.getDate() + Number(service_cnt) );
	} else if(service_unit=='week') {
		units = "주";
		end_date.setDate( end_date.getDate() + (Number(service_cnt) * 7 ) );
	} else if(service_unit=='month') {
		units = "월";
		end_date.setMonth( end_date.getMonth() + Number(service_cnt) );
	} else if(service_unit=='year') {
		units = "년";
		end_date.setYear( end_date.getYear() + Number(service_cnt) );
	}

	// 날짜
	var cur_month = '%02d' . sprintf( ( date.getMonth()+1 ) ), cur_day = '%02d' . sprintf( date.getDate() );
	var cur_date = date.getFullYear() + "." + cur_month + "." + cur_day;
	var eur_month = '%02d' . sprintf( end_date.getMonth()+1 ), eur_day = '%02d' . sprintf( end_date.getDate() );
	var eur_date = end_date.getYear() + "." + eur_month + "." + eur_day;
	var total_prices = (service_price==0) ? "무료" : String(service_price).number_format() + "원";

	if( service_length > 0 ){	// 서비스가 있다면
		$service_list.remove();
	}

	if(sel){

		$service_price_info.show();

		if(service_price!=0){	// 무료가 아닐때

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

			if(service=='alba_option_neon'){	// 형광펜
				var service_title = "형광펜";
				$('#'+service+"_msg").html("(형광펜 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
			
			if(service=='alba_option_bold'){	// 굵은글자
				var service_title = "굵은글자";
				$('#'+service+"_msg").html("(굵은 글자로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
		
			if(service=='alba_option_icon'){	// 아이콘
				var service_title = "아이콘";
				$('#'+service+"_msg").html("(아이콘으로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if(service=='alba_option_color'){	// 글자색
				var service_title = "글자색";
				$('#'+service+"_msg").html("(글자색으로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if(service=='alba_option_blink'){	// 반짝칼라
				var service_title = "반짝칼라";
				$('#'+service+"_msg").html("(반짝컬러 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			service_list += "<tr id=\""+service+"\">";
			service_list += "<td class=\"tc\" height=\"50\"><span><strong>"+service_title+"</strong></span></td>";
			service_list += "<td class=\"tl\"><span>오늘 +"+service_cnt+units+" ("+cur_date+"~"+eur_date+")</span></td>";
			service_list += "<td class=\"tc\"><span id=\""+service+"_price_val\">"+total_prices+"</span></td>";
			service_list += "<td class=\"tc\"><span class=\"text_red\"><strong id=\""+service+"_total_val\">\\"+String(total_price).number_format()+"</strong></span></td>";
			service_list += "</tr>";

		} else {	 // 무료일때

			if(service=='alba_option_neon'){	// 형광펜
				var service_title = "형광펜";
				$('#'+service+"_msg").html("(형광펜 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
			
			if(service=='alba_option_bold'){	// 굵은글자
				var service_title = "굵은글자";
				$('#'+service+"_msg").html("(굵은 글자로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
			
			if(service=='alba_option_color'){	// 글자색
				var service_title = "글자색";
				$('#'+service+"_msg").html("(글자색으로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if(service=='alba_option_icon'){	// 아이콘
				var service_title = "아이콘";
				$('#'+service+"_msg").html("(아이콘으로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if(service=='alba_option_blink'){	// 반짝칼라
				var service_title = "반짝칼라";
				$('#'+service+"_msg").html("(반짝컬러 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if( service_length > 0 ){	// 서비스가 있다면
				$service_list.remove();
			}

			service_list += "<tr id=\""+service+"\">";
			service_list += "<td class=\"tc\" height=\"50\"><span><strong>"+service_title+"</strong></span></td>";
			service_list += "<td class=\"tl\"><span>오늘 +"+service_cnt+units+" ("+cur_date+"~"+eur_date+")</span></td>";
			service_list += "<td class=\"tc\"><span id=\""+service+"_price_val\">"+total_prices+"</span></td>";
			service_list += "<td class=\"tc\"><span class=\"text_red\"><strong id=\""+service+"_total_val\">\\"+String(total_price).number_format()+"</strong></span></td>";
			service_list += "</tr>";

			$('#'+service+"_price_info .pay .text_orange").html( "무료" );
			$('#'+service+"_price_info .won").hide();


		}

		$('#service_list').append( service_list );

	} else {

		// 초기화
		$service_price_info	.hide();
		$service_list.remove();

	}

	total_service_sum_price( true );

}

var total_service_sum_price = function( is_option ){	// 전체 서비스 금액 합계
	var total_sum_price = 0;	 // 최종 결제금액

	var main_platinum_length = $("#main_platinum_date").length;
	if(main_platinum_length){
		var main_platinum = $("#main_platinum_date :selected").val().split('/');	// 메인 플래티넘
		var main_platinum_price = (main_platinum[4]) ? Number(main_platinum[4]) : 0;
	} else {
		var main_platinum_price = 0;
	}
	total_sum_price += main_platinum_price;

	//alert(total_sum_price+" :: 메인 플래티넘 "+main_platinum_price);

	var $main_platinum_gold = $("#main_platinum_gold");	 // 메인 플래티넘 골드 서비스
	var main_platinum_gold_length = $main_platinum_gold.length;
	if(main_platinum_gold_length){
		if( $main_platinum_gold.is(':checked') ){	// 체크했다면
			var main_platinum_gold = $("#main_platinum_gold_date :selected").val().split('/');
			var main_platinum_gold_price = (main_platinum_gold[4]) ? Number(main_platinum_gold[4]) : 0;
		} else {
			var main_platinum_gold_price = 0;
		}
	} else {
		var main_platinum_gold_price = 0;
	}
	total_sum_price += main_platinum_gold_price;

	//alert(total_sum_price+" :: 메인 플래티넘 골드 "+main_platinum_gold_price);

	var $main_platinum_logo = $("#main_platinum_logo");	 // 메인 플래티넘 로고강조 서비스
	var main_platinum_logo_length = $main_platinum_logo.length;
	if(main_platinum_logo_length){
		if( $main_platinum_logo.is(':checked') ){	// 체크했다면
			var main_platinum_logo = $("#main_platinum_logo_date :selected").val().split('/');
			var main_platinum_logo_price = (main_platinum_logo[4]) ? Number(main_platinum_logo[4]) : 0;
		} else {
			var main_platinum_logo_price = 0;
		}
	} else {
		var main_platinum_logo_price = 0;
	}
	total_sum_price += main_platinum_logo_price;

	//alert(total_sum_price+" :: 메인 플래티넘 로고강조 "+main_platinum_logo_price);

	var main_prime_length = $("#main_prime_date").length;
	if(main_prime_length){
		var main_prime = $("#main_prime_date :selected").val().split('/');	// 메인 프라임
		var main_prime_price = (main_prime[4]) ? Number(main_prime[4]) : 0;
	} else {
		var main_prime_price = 0;
	}
	total_sum_price += main_prime_price;

	//alert(total_sum_price+" :: 메인 프라임 "+main_prime_price);

	var $main_prime_gold = $("#main_prime_gold");	 // 메인 프라임 골드 서비스
	var main_prime_gold_length = $main_prime_gold.length;
	if(main_prime_gold_length){
		if( $main_prime_gold.is(':checked') ){	// 체크했다면
			var main_prime_gold = $("#main_prime_gold_date :selected").val().split('/');
			var main_prime_gold_price = (main_prime_gold[4]) ? Number(main_prime_gold[4]) : 0;
		} else {
			var main_prime_gold_price = 0;
		}
	} else {
		var main_prime_gold_price = 0;
	}
	total_sum_price += main_prime_gold_price;

	//alert(total_sum_price+" :: 메인 프라임 골드 "+main_prime_gold_price);

	var $main_prime_logo = $("#main_prime_logo");	 // 메인 프라임 로고강조 서비스
	var main_prime_logo_length = $main_prime_logo.length;
	if(main_prime_logo_length){
		if( $main_prime_logo.is(':checked') ){	// 체크했다면
			var main_prime_logo = $("#main_prime_logo_date :selected").val().split('/');
			var main_prime_logo_price = (main_prime_logo[4]) ? Number(main_prime_logo[4]) : 0;
		} else {
			var main_prime_logo_price = 0;
		}
	} else {
		var main_prime_logo_price = 0;
	}
	total_sum_price += main_prime_logo_price;

	//alert(total_sum_price+" :: 메인 프라임 로고강조 "+main_prime_logo_price);

	var main_grand_length = $("#main_grand_date").length;
	if(main_grand_length){
		var main_grand = $("#main_grand_date :selected").val().split('/');	// 메인 그랜드
		var main_grand_price = (main_grand[4]) ? Number(main_grand[4]) : 0;
	} else {
		var main_grand_price = 0;
	}
	total_sum_price += main_grand_price;

	//alert(total_sum_price+" :: 메인 그랜드 "+main_grand_price);

	var $main_grand_gold = $("#main_grand_gold");	 // 메인 그랜드 골드 서비스
	var main_grand_gold_length = $main_grand_gold.length;
	if(main_grand_gold_length){
		if( $main_grand_gold.is(':checked') ){	// 체크했다면
			var main_grand_gold = $("#main_grand_gold_date :selected").val().split('/');
			var main_grand_gold_price = (main_grand_gold[4]) ? Number(main_grand_gold[4]) : 0;
		} else {
			var main_grand_gold_price = 0;
		}
	} else {
		var main_grand_gold_price = 0;
	}
	total_sum_price += main_grand_gold_price;

	//alert(total_sum_price+" :: 메인 그랜드 골드 "+main_grand_gold_price);

	var $main_grand_logo = $("#main_grand_logo");	 // 메인 그랜드 로고강조 서비스
	var main_grand_logo_length = $main_grand_logo.length;
	if(main_grand_logo_length){
		if( $main_grand_logo.is(':checked') ){	// 체크했다면
			var main_grand_logo = $("#main_grand_logo_date :selected").val().split('/');
			var main_grand_logo_price = (main_grand_logo[4]) ? Number(main_grand_logo[4]) : 0;
		} else {
			var main_grand_logo_price = 0;
		}
	} else {
		var main_grand_logo_price = 0;
	}
	total_sum_price += main_grand_logo_price;

	//alert(total_sum_price+" :: 메인 그랜드 로고강조 "+main_grand_logo_price);

	var main_banner_length = $("#main_banner_date").length;
	if(main_banner_length){
		var main_banner = $("#main_banner_date :selected").val().split('/');	// 메인 배너형
		var main_banner_price = (main_banner[4]) ? Number(main_banner[4]) : 0;
	} else {
		var main_banner_price = 0;
	}
	total_sum_price += main_banner_price;

	//alert(total_sum_price+" :: 메인 배너형 "+main_banner_price);

	var $main_banner_gold = $("#main_banner_gold");	 // 메인 배너형 골드 서비스
	var main_banner_gold_length = $main_banner_gold.length;
	if(main_banner_gold_length){
		if( $main_banner_gold.is(':checked') ){	// 체크했다면
			var main_banner_gold = $("#main_banner_gold_date :selected").val().split('/');
			var main_banner_gold_price = (main_banner_gold[4]) ? Number(main_banner_gold[4]) : 0;
		} else {
			var main_banner_gold_price = 0;
		}
	} else {
		var main_banner_gold_price = 0;
	}
	total_sum_price += main_banner_gold_price;

	//alert(total_sum_price+" :: 메인 배너형 골드 "+main_banner_gold_price);

	var main_list_length = $("#main_list_date").length;
	if(main_list_length){
		var main_list = $("#main_list_date :selected").val().split('/');	// 메인 리스트형
		var main_list_price = (main_list[4]) ? Number(main_list[4]) : 0;
	} else {
		var main_list_price = 0;
	}
	total_sum_price += main_list_price;

	//alert(total_sum_price+" :: 메인 리스트형 "+main_list_price);

	var $main_list_gold = $("#main_list_gold");	 // 메인 리스트형 골드 서비스
	var main_list_gold_length = $main_list_gold.length;
	if(main_list_gold_length){
		if( $main_list_gold.is(':checked') ){	// 체크했다면
			var main_list_gold = $("#main_list_gold_date :selected").val().split('/');
			var main_list_gold_price = (main_list_gold[4]) ? Number(main_list_gold[4]) : 0;
		} else {
			var main_list_gold_price = 0;
		}
	} else {
		var main_list_gold_price = 0;
	}
	total_sum_price += main_list_gold_price;

	//alert(total_sum_price+" :: 메인 리스트형 골드 "+main_list_gold_price);

	var alba_platinum_length = $("#alba_platinum_date").length;
	if(alba_platinum_length){
		var alba_platinum = $("#alba_platinum_date :selected").val().split('/');	// 알바 플래티넘
		var alba_platinum_price = (alba_platinum[4]) ? Number(alba_platinum[4]) : 0;
	} else {
		var alba_platinum_price = 0;
	}
	total_sum_price += alba_platinum_price;

	//alert(total_sum_price+" :: 알바 플래티넘 "+alba_platinum_price);

	var $alba_platinum_gold = $("#alba_platinum_gold");	 // 알바 플래티넘 골드 서비스
	var alba_platinum_gold_length = $alba_platinum_gold.length;
	if(alba_platinum_gold_length){
		if( $alba_platinum_gold.is(':checked') ){	// 체크했다면
			var alba_platinum_gold = $("#alba_platinum_gold_date :selected").val().split('/');
			var alba_platinum_gold_price = (alba_platinum_gold[4]) ? Number(alba_platinum_gold[4]) : 0;
		} else {
			var alba_platinum_gold_price = 0;
		}
	} else {
		var alba_platinum_gold_price = 0;
	}
	total_sum_price += alba_platinum_gold_price;

	//alert(total_sum_price+" :: 알바 플래티넘 골드 "+alba_platinum_gold_price);


	var $alba_platinum_logo = $("#alba_platinum_logo");	 // 알바 플래티넘 로고강조 서비스
	var alba_platinum_logo_length = $alba_platinum_logo.length;
	if(alba_platinum_logo_length){
		if( $alba_platinum_logo.is(':checked') ){	// 체크했다면
			var alba_platinum_logo = $("#alba_platinum_logo_date :selected").val().split('/');
			var alba_platinum_logo_price = (alba_platinum_logo[4]) ? Number(alba_platinum_logo[4]) : 0;
		} else {
			var alba_platinum_logo_price = 0;
		}
	} else {
		var alba_platinum_logo_price = 0;
	}
	total_sum_price += alba_platinum_logo_price;

	//alert(total_sum_price+" :: 알바 플래티넘 로고강조 "+alba_platinum_logo_price);


	var alba_banner_length = $("#alba_banner_date").length;
	if(alba_banner_length){
		var alba_banner = $("#alba_banner_date :selected").val().split('/');	// 알바 배너형
		var alba_banner_price = (alba_banner[4]) ? Number(alba_banner[4]) : 0;
	} else {
		var alba_banner_price = 0;
	}
	total_sum_price += alba_banner_price;

	//alert(total_sum_price+" :: 알바 배너형 "+alba_banner_price);

	var $alba_banner_gold = $("#alba_banner_gold");	 // 알바 배너형 골드 서비스
	var alba_banner_gold_length = $alba_banner_gold.length;
	if(alba_banner_gold_length){
		if( $alba_banner_gold.is(':checked') ){	// 체크했다면
			var alba_banner_gold = $("#alba_banner_gold_date :selected").val().split('/');
			var alba_banner_gold_price = (alba_banner_gold[4]) ? Number(alba_banner_gold[4]) : 0;
		} else {
			var alba_banner_gold_price = 0;
		}
	} else {
		var alba_banner_gold_price = 0;
	}
	total_sum_price += alba_banner_gold_price;

	//alert(total_sum_price+" :: 알바 배너형 골드 "+alba_banner_gold_price);


	var alba_list_length = $("#alba_list_date").length;
	if(alba_list_length){
		var alba_list = $("#alba_list_date :selected").val().split('/');	// 알바 리스트형
		var alba_list_price = (alba_list[4]) ? Number(alba_list[4]) : 0;
	} else {
		var alba_list_price = 0;
	}
	total_sum_price += alba_list_price;

	//alert(total_sum_price+" :: 알바 리스트형 "+alba_list_price);

	var $alba_list_gold = $("#alba_list_gold");	 // 알바 리스트형 골드 서비스
	var alba_list_gold_length = $alba_list_gold.length;
	if(alba_list_gold_length){
		if( $alba_list_gold.is(':checked') ){	// 체크했다면
			var alba_list_gold = $("#alba_list_gold_date :selected").val().split('/');
			var alba_list_gold_price = (alba_list_gold[4]) ? Number(alba_list_gold[4]) : 0;
		} else {
			var alba_list_gold_price = 0;
		}
	} else {
		var alba_list_gold_price = 0;
	}
	total_sum_price += alba_list_gold_price;

	//alert(total_sum_price+" :: 알바 리스트형 골드 "+alba_list_gold_price);


	var main_basic_length = $("#main_basic_date").length;
	if(main_basic_length){
		var main_basic = $("#main_basic_date :selected").val().split('/');	// 알바 리스트형
		var main_basic_price = (main_basic[4]) ? Number(main_basic[4]) : 0;
	} else {
		var main_basic_price = 0;
	}
	total_sum_price += main_basic_price;

	//alert(total_sum_price+" :: 메인 일반리스트 "+main_basic_price);

	var alba_basic_length = $("#alba_basic_date").length;
	if(alba_basic_length){
		var alba_basic = $("#alba_basic_date :selected").val().split('/');	// 알바 리스트형
		var alba_basic_price = (alba_basic[4]) ? Number(alba_basic[4]) : 0;
	} else {
		var alba_basic_price = 0;
	}
	total_sum_price += alba_basic_price;

	//alert(total_sum_price+" :: 메인 일반리스트 "+alba_basic_price);


	var alba_option_busy_date_length = $("#alba_option_busy_date").length;
	if(alba_option_busy_date_length){
		var alba_option_busy = $("#alba_option_busy_date :selected").val().split('/');	// 급구 아이콘
		var alba_option_busy_price = (alba_option_busy[4]) ? Number(alba_option_busy[4]) : 0;
	} else {
		var alba_option_busy_price = 0;
	}
	total_sum_price += alba_option_busy_price;

	//alert(total_sum_price+" :: 알바 급구 아이콘 "+alba_option_busy_price);

	var $alba_option_jump = $("#alba_option_jump");	 // 점프 서비스
	var alba_option_jump_length = $alba_option_jump.length;
	if(alba_option_jump_length){
		var alba_option_jump = $("#alba_option_jump_price").val().split('/');
		var alba_option_jump_price = (alba_option_jump[4]) ? Number(alba_option_jump[4]) : 0;
	} else {
		var alba_option_jump_price = 0;
	}
	total_sum_price += alba_option_jump_price;

	//alert(total_sum_price+" :: 점프 서비스 "+alba_option_jump_price);

	var $etc_open = $("#etc_open");	 // 이력서 열람 서비스
	var etc_open_length = $etc_open.length;
	if(etc_open_length){
		var etc_open = $("#etc_open_price").val().split('/');
		var etc_open_price = (etc_open[4]) ? Number(etc_open[4]) : 0;
	} else {
		var etc_open_price = 0;
	}
	total_sum_price += etc_open_price;

	//alert(total_sum_price+" :: 이력서 열람 서비스 "+etc_open_price);

	if(is_option){	// 강조옵션 선택으로 선택된 경우

		var $alba_option_neon = $("#alba_option_neon");	 // 형광펜 옵션 서비스
		var alba_option_neon_length = $alba_option_neon.length;
		if(alba_option_neon_length){
			if( $alba_option_neon.is(':checked') ){	// 체크했다면
				var alba_option_neon = $("#alba_option_neon_date :selected").val().split('/');
				//alert(alba_option_neon);
				var alba_option_neon_price = (alba_option_neon[4]) ? Number(alba_option_neon[4]) : 0;
			} else {
				var alba_option_neon_price = 0;
			}
		} else {
			var alba_option_neon_price = 0;
		}
		total_sum_price += alba_option_neon_price;

	//alert(total_sum_price+" :: 형광펜 "+alba_option_neon_price);

		var $alba_option_bold = $("#alba_option_bold");	 // 굵은글자 옵션 서비스
		var alba_option_bold_length = $alba_option_bold.length;
		if(alba_option_bold_length){
			if( $alba_option_bold.is(':checked') ){	// 체크했다면
				var alba_option_bold = $("#alba_option_bold_date :selected").val().split('/');
				var alba_option_bold_price = (alba_option_bold[4]) ? Number(alba_option_bold[4]) : 0;
			} else {
				var alba_option_bold_price = 0;
			}
		} else {
			var alba_option_bold_price = 0;
		}
		total_sum_price += alba_option_bold_price;

	//alert(total_sum_price+" :: 굵은글자 "+alba_option_bold_price);

		var $alba_option_icon = $("#alba_option_icon");	 // 아이콘 옵션 서비스
		var alba_option_icon_length = $alba_option_icon.length;
		if(alba_option_icon_length){
			if( $alba_option_icon.is(':checked') ){	// 체크했다면
				var alba_option_icon = $("#alba_option_icon_date :selected").val().split('/');
				var alba_option_icon_price = (alba_option_icon[4]) ? Number(alba_option_icon[4]) : 0;
			} else {
				var alba_option_icon_price = 0;
			}
		} else {
			var alba_option_icon_price = 0;
		}
		total_sum_price += alba_option_icon_price;

	//alert(total_sum_price+" :: 아이콘 "+alba_option_icon_price);

		var $alba_option_color = $("#alba_option_color");	 // 글자색 옵션 서비스
		var alba_option_color_length = $alba_option_color.length;
		if(alba_option_color_length){
			if( $alba_option_color.is(':checked') ){	// 체크했다면
				var alba_option_color = $("#alba_option_color_date :selected").val().split('/');
				var alba_option_color_price = (alba_option_color[4]) ? Number(alba_option_color[4]) : 0;
			} else {
				var alba_option_color_price = 0;
			}
		} else {
			var alba_option_color_price = 0;
		}
		total_sum_price += alba_option_color_price;

	//alert(total_sum_price+" :: 글자색 "+alba_option_color_price);

		var $alba_option_blink = $("#alba_option_blink");	 // 반짝칼라 옵션 서비스
		var alba_option_blink_length = $alba_option_blink.length;
		if(alba_option_blink_length){
			if( $alba_option_blink.is(':checked') ){	// 체크했다면
				var alba_option_blink = $("#alba_option_blink_date :selected").val().split('/');
				var alba_option_blink_price = (alba_option_blink[4]) ? Number(alba_option_blink[4]) : 0;
			} else {
				var alba_option_blink_price = 0;
			}
		} else {
			var alba_option_blink_price = 0;
		}
		total_sum_price += alba_option_blink_price;

	//alert(total_sum_price+" :: 반짝칼라 "+alba_option_blink_price);

	} else {	 // 옵션이 서비스로 선택된 경우

		var alba_option_neon_date_length = $("#alba_option_neon_date").length;
		if(alba_option_neon_date_length){
			var alba_option_neon = $("#alba_option_neon_date :selected").val().split('/');	// 형광펜 옵션
			var alba_option_neon_price = (alba_option_neon[4]) ? Number(alba_option_neon[4]) : 0;
		} else {
			var alba_option_neon_price = 0;
		}
		total_sum_price += alba_option_neon_price;

	//alert(total_sum_price+" :: 형광펜 "+alba_option_neon_price);

		var alba_option_bold_date_length = $("#alba_option_bold_date").length;
		if(alba_option_bold_date_length){
			var alba_option_bold = $("#alba_option_bold_date :selected").val().split('/');	// 굵은글자 옵션
			var alba_option_bold_price = (alba_option_bold[4]) ? Number(alba_option_bold[4]) : 0;
		} else {
			var alba_option_bold_price = 0;
		}
		total_sum_price += alba_option_bold_price;

	//alert(total_sum_price+" :: 굵은글자 "+alba_option_bold_price);

		var alba_option_icon_date_length = $("#alba_option_icon_date").length;
		if(alba_option_icon_date_length){
			var alba_option_icon = $("#alba_option_icon_date :selected").val().split('/');	// 아이콘 옵션
			var alba_option_icon_price = (alba_option_icon[4]) ? Number(alba_option_icon[4]) : 0;
		} else {
			var alba_option_icon_price = 0;
		}
		total_sum_price += alba_option_icon_price;

	//alert(total_sum_price+" :: 아이콘 "+alba_option_icon_price);

		var alba_option_color_date_length = $("#alba_option_color_date").length;
		if(alba_option_color_date_length){
			var alba_option_color = $("#alba_option_color_date :selected").val().split('/');	// 글자색 옵션
			var alba_option_color_price = (alba_option_color[4]) ? Number(alba_option_color[4]) : 0;
		} else {
			var alba_option_color_price = 0;
		}
		total_sum_price += alba_option_color_price;

	//alert(total_sum_price+" :: 글자색 "+alba_option_color_price);

		var alba_option_blink_date_length = $("#alba_option_blink_date").length;
		if(alba_option_blink_date_length){
			var alba_option_blink = $("#alba_option_blink_date :selected").val().split('/');	// 반짝칼라 옵션
			var alba_option_blink_price = (alba_option_blink[4]) ? Number(alba_option_blink[4]) : 0;
		} else {
			var alba_option_blink_price = 0;
		}
		total_sum_price += alba_option_blink_price;

	//alert(total_sum_price+" :: 반짝칼라 "+alba_option_blink_price);

	}

	var package_price = ( $('#package_price').val() ) ? Number( $('#package_price').val() ) : 0;
	if( package_price ){
		total_sum_price += package_price;
	}

	$('#pay_use_point').val('0');	// 할인내역 포인트 필드
	$('#sumTotal_Price, #total_pay_price, #sumTotal_price').html( String(total_sum_price).number_format() );
	$('#total_price').val(total_sum_price);
	$('#pay_price').val(total_sum_price);

	if(total_sum_price==0){
		$('#payFrm').hide();
	} else {
		$('#payFrm').show();
	}
}

var logo_effects = function( vals, id_name ){	// 로고 효과 선택
	var sel = vals.value;

	$("."+id_name+"_logo_preview").removeClass(id_name+"_fade_preview");	// 클래스 초기화
	$("."+id_name+"_logo_preview").removeClass(id_name+"_blink_preview");
	$("."+id_name+"_logo_preview").removeClass(id_name+"_slide_preview");

	if(sel=='0'){	// 페이드 형태
		$("#"+id_name+"_preview_logo").show();
		$("."+id_name+"_slide_preview").hide();
		$("."+id_name+"_logo_preview").addClass(id_name+"_fade_preview");
		fade_images(id_name+"_fade_preview");
		setInterval(function(){
			fade_images(id_name+"_fade_preview");
		}, 3000);
	} else if(sel=='1'){	 // 깜빡임
		$("#"+id_name+"_preview_logo").show();
		$("."+id_name+"_slide_preview").hide();
		$("."+id_name+"_logo_preview").addClass(id_name+"_blink_preview");
		blink(id_name+"_blink_preview",900000,1500);
	} else if(sel=='2'){	 // 슬라이드
		$("#"+id_name+"_preview_logo").hide();
		$("."+id_name+"_slide_preview").show();
		$("."+id_name+"_slide_preview").cycle({ 
			fx:     cycle_direction, 
			easing: 'easeInOutBack',
			delay:  -2000 
		});
	}

}
var alba_option_neons = function( vals ){	// 형광펜 칼라 선택
	var sel = vals.value;
	$('.text1 a').css( "background-color", "#"+sel );
	$('.title a').css( "background-color", "#"+sel );
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
				$('#price').val(total_price);
				return;
			}
		}
	}
}

/*
var once_service_price_print = function( service, vals ){	// 서비스별 금액 출력
	var sel = vals.value;
	var service_info = sel.split('/');
	var service_cnt = service_info[0], service_unit = service_info[1], service_price = Number(service_info[2]), service_percent = Number(service_info[3]), total_price = service_info[4];

	var $service_price_info = $('#'+service+"_price_info");
	var service_text = $("#"+service+"_date :selected").text();

	if(sel){

		$service_price_info.show();

		if(service_price!=0){	// 무료가 아닐때

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

			if(service=='main_platinum_gold'){	// 메인 플래티넘 골드
				$('#'+service+"_msg").html("(배경색으로 강조 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
			
			if(service=='alba_option_logo'){	// 메인 플래티넘 로고 강조
				$('#'+service+"_msg").html("(움직이는 로고가 노출 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
			
		} else {	 // 무료일때

			$('#'+service+"_price_info .pay .text_orange").html( "무료" );
			$('#'+service+"_price_info .won").hide();

		}

		var main_platinum_sel = $('#main_platinum_date :selected').attr('price');	// 메인 플래티넘
		var main_platinum_sel_price = (main_platinum_sel) ? Number(main_platinum_sel) : 0;
		var main_platinum_gold_sel = $('#main_platinum_gold_date :selected').attr('price');	// 메인 플래티넘 골드
		var main_platinum_gold_sel_price = (main_platinum_gold_sel) ? Number(main_platinum_gold_sel) : 0;

		var main_prime_sel = $('#main_prime_date :selected').attr('price');	// 메인 프라임
		var main_prime_sel_price = (main_prime_sel) ? Number(main_prime_sel) : 0;
		var main_prime_gold_sel = $('#main_prime_gold_date :selected').attr('price');	// 메인 플래티넘 골드
		var main_prime_gold_sel_price = (main_prime_gold_sel) ? Number(main_prime_gold_sel) : 0;

		var main_grand_sel = $('#main_grand_date :selected').attr('price');	// 메인 그랜드
		var main_grand_sel_price = (main_grand_sel) ? Number(main_grand_sel) : 0;
		var main_grand_gold_sel = $('#main_grand_gold_date :selected').attr('price');	// 메인 플래티넘 골드
		var main_grand_gold_sel_price = (main_grand_gold_sel) ? Number(main_grand_gold_sel) : 0;

		var main_banner_sel = $('#main_banner_date :selected').attr('price');	// 메인 배너형
		var main_banner_sel_price = (main_banner_sel) ? Number(main_banner_sel) : 0;
		var main_banner_gold_sel = $('#main_banner_gold_date :selected').attr('price');	// 메인 플래티넘 골드
		var main_banner_gold_sel_price = (main_banner_gold_sel) ? Number(main_banner_gold_sel) : 0;

		var main_list_sel = $('#main_list_date :selected').attr('price');	// 메인 배너형
		var main_list_sel_price = (main_list_sel) ? Number(main_list_sel) : 0;
	
		var alba_platinum_sel = $('#alba_platinum_date :selected').attr('price');	// 서브 플래티넘
		var alba_platinum_sel_price = (alba_platinum_sel) ? Number(alba_platinum_sel) : 0;
		var alba_platinum_gold_sel = $('#alba_platinum_gold_date :selected').attr('price');	// 메인 플래티넘 골드
		var alba_platinum_gold_sel_price = (alba_platinum_gold_sel) ? Number(alba_platinum_gold_sel) : 0;

		var alba_banner_sel = $('#alba_banner_date :selected').attr('price');	// 서브 배너형
		var alba_banner_sel_price = (alba_banner_sel) ? Number(alba_banner_sel) : 0;
		var alba_banner_gold_sel = $('#alba_banner_gold_date :selected').attr('price');	// 메인 플래티넘 골드
		var alba_banner_gold_sel_price = (alba_banner_gold_sel) ? Number(alba_banner_gold_sel) : 0;

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

		var sum_price = main_platinum_sel_price+main_platinum_gold_sel_price+main_prime_sel_price+main_prime_gold_sel_price+main_grand_sel_price+main_grand_gold_sel_price+main_banner_sel_price+main_banner_gold_sel_price+main_list_sel_price+alba_platinum_sel_price+alba_platinum_gold_sel_price+alba_banner_sel_price+alba_banner_gold_sel_price+alba_list_sel_price+alba_option_busy_sel_price+alba_option_logo_sel_price+alba_option_neon_sel_price+alba_option_bold_sel_price+alba_option_icon_sel_price+alba_option_color_sel_price+alba_option_blink_sel_price+alba_option_jump_sel_price+etc_open_sel_price;
		
		total_sum_price = String(sum_price);

	} else {

		$service_price_info.hide();

	}

	//alert(total_sum_price);

	$('#sumTotal_Price').html( total_sum_price.number_format() );
	$('#total_price').val(sum_price);	// 합산 결제 금액

}

*/
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
		$('#tax_use').attr('required',true);
		$('#bank_info').show();
	} else {	 // 그외
		$('#bank_list').removeAttr('required');
		$('#tax_use').removeAttr('required');
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

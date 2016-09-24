$(function(){

	$('#pay_use_point').keydown(function(event){
		if(event.keyCode==13){	
			use_points();
			return false;
		}
	});

});

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

		if(service=='main_focus'){
			var service_title = "메인 포커스";
		} else if(service=='main_basic'){
			var service_title = "메인 일반리스트";
		} else if(service=='alba_resume_focus'){
			var service_title = "인재정보 포커스";
		} else if(service=='alba_resume_basic'){
			var service_title = "인재정보 일반리스트";
		} else if(service=='resume_option_busy'){
			var service_title = "급구 아이콘";
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
		//if( service != 'resume_option_busy' ) {
			$("#"+service).remove();
		//}

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
				case 'main_focus_gold':
					var service_title = "메인 포커스 Gold";
				break;
				case 'alba_resume_focus_gold':
					var service_title = "인재정보 포커스 Gold";
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

var option_service = function( service, vals, is_option ){	// 강조 옵션
	var sel = vals.value;
	var checked = vals.checked;

	var $service_list = $('#service_list > #resume_option_'+service);
	var $service_price_info = $('#resume_option_'+service+"_price_info");

	if(checked==true){

		switch(service){
			case 'busy':	// 급구 아이콘
				$pre_busy_icon = $('#pre_busy_icon');
				$('#busy_icon').attr('src',$pre_busy_icon.html());
				$('#busy_icon').show();
			break;
			case 'neon':	// 형광펜
				var resume_option_neon_sel = $("input[name='resume_option_neon_sel']:checked").val();
				$('.text1 a, .title a').css( "background-color", "#"+resume_option_neon_sel );
			break;
			case 'bold':	// 굵은글자
				$('.text1 a, .title a').css( "font-weight", "bold");
			break;
			case 'icon':	// 아이콘
				var resume_option_icon_sel = $("input[name='resume_option_icon_sel']:checked").val();
				var resume_option_icon = $('#resume_option_icon_'+resume_option_icon_sel).html();
				if( $('.title span.icon').length ){	// 급구로 선택한 경우
					$('.text1 span.icon').html(resume_option_icon);
					$('.title span.icon').html(resume_option_icon);
				} else {
					$('.text1 span.icon').html(resume_option_icon);
				}
			break;
			case 'color':	// 글자색
				var resume_option_color_sel = $("input[name='resume_option_color_sel']:checked").val();
				$('.text1 a, .title a').css( "color", "#"+resume_option_color_sel );
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

		$('.resume_option_'+service).show();

	} else {

		switch(service){
			case 'busy':	// 급구 아이콘
				$('#busy_icon').hide();
			break;
			case 'neon':	// 형광펜
				var resume_option_neon_sel = $("input[name='resume_option_neon_sel']:checked").val();
				$('.text1 a, .title a').css( "background-color", "" );
				$('#resume_option_neon_msg').html("형광펜 강조 효과");
			break;
			case 'bold':	// 굵은글자
				$('.text1 a, .title a').css( "font-weight", "");
				$('#resume_option_bold_msg').html("굵은 글자로 강조 효과");
			break;
			case 'icon':	// 아이콘
				$('.text1 span.icon, .title span.icon').html("");
				$('#resume_option_icon_msg').html("아이콘으로 강조 효과");
			break;
			case 'color':	// 글자색
				$('.text1 a, .title a').css( "color", "" );
				$('#resume_option_color_msg').html("글자색으로 강조 효과");
			break;
			case 'blink':	// 반짝칼라
				$('.text1 a, .title a').stop();
				$('.text1 a, .title a').removeClass('blink');
				var resume_option_color_sel = $("input[name='resume_option_color_sel']:checked").val();
				$('.text1 a, .title a').css( "color", "#"+resume_option_color_sel );
				$('#resume_option_blink_msg').html("반짝컬러 강조 효과");
			break;
		}

		$service_list.remove();
		$service_price_info.hide();
		$("#resume_option_"+service+"_date :eq(0)").attr("selected",true);
		$('.resume_option_'+service).hide();
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

			if(service=='resume_option_neon'){	// 형광펜
				var service_title = "형광펜";
				$('#'+service+"_msg").html("(형광펜 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
			
			if(service=='resume_option_bold'){	// 굵은글자
				var service_title = "굵은글자";
				$('#'+service+"_msg").html("(굵은 글자로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
		
			if(service=='resume_option_icon'){	// 아이콘
				var service_title = "아이콘";
				$('#'+service+"_msg").html("(아이콘으로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if(service=='resume_option_color'){	// 글자색
				var service_title = "글자색";
				$('#'+service+"_msg").html("(글자색으로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if(service=='resume_option_blink'){	// 반짝칼라
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

			if(service=='resume_option_neon'){	// 형광펜
				var service_title = "형광펜";
				$('#'+service+"_msg").html("(형광펜 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
			
			if(service=='resume_option_bold'){	// 굵은글자
				var service_title = "굵은글자";
				$('#'+service+"_msg").html("(굵은 글자로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}
			
			if(service=='resume_option_color'){	// 글자색
				var service_title = "글자색";
				$('#'+service+"_msg").html("(글자색으로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if(service=='resume_option_icon'){	// 아이콘
				var service_title = "아이콘";
				$('#'+service+"_msg").html("(아이콘으로 강조 효과 : <strong>+"+total_price.number_format()+"</strong>원/"+service_text+")");
			}

			if(service=='resume_option_blink'){	// 반짝칼라
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

var resume_option_neons = function( vals ){	// 형광펜 칼라 선택
	var sel = vals.value;
	$('.text1 a').css( "background-color", "#"+sel );
	$('.title a').css( "background-color", "#"+sel );
}


var total_service_sum_price = function( is_option ){

	var total_sum_price = 0;	 // 최종 결제금액

	var main_focus_length = $("#main_focus_date").length;
	if(main_focus_length){
		var main_focus = $("#main_focus_date :selected").val().split('/');	// 메인 포커스
		var main_focus_price = (main_focus[4]) ? Number(main_focus[4]) : 0;
	} else {
		var main_focus_price = 0;
	}
	total_sum_price += main_focus_price;

	//alert(total_sum_price+" :: 메인 포커스 "+main_focus_price);

	var $main_focus_gold = $("#main_focus_gold");	 // 메인 포커스 골드 서비스
	var main_focus_gold_length = $main_focus_gold.length;
	if(main_focus_gold_length){
		if( $main_focus_gold.is(':checked') ){	// 체크했다면
			var main_focus_gold = $("#main_focus_gold_date :selected").val().split('/');
			var main_focus_gold_price = (main_focus_gold[4]) ? Number(main_focus_gold[4]) : 0;
		} else {
			var main_focus_gold_price = 0;
		}
	} else {
		var main_focus_gold_price = 0;
	}
	total_sum_price += main_focus_gold_price;

	//alert(total_sum_price+" :: 메인 포커스 골드 "+main_focus_gold_price);


	var main_basic_length = $("#main_rbasic_date").length;
	if(main_basic_length){
		var main_basic = $("#main_rbasic_date :selected").val().split('/');	// 메인 포커스
		var main_basic_price = (main_basic[4]) ? Number(main_basic[4]) : 0;
	} else {
		var main_basic_price = 0;
	}
	total_sum_price += main_basic_price;

	//alert(total_sum_price+" :: 메인 일반리스트 "+main_basic_price);


	var alba_resume_focus_length = $("#alba_resume_focus_date").length;
	if(alba_resume_focus_length){
		var alba_resume_focus = $("#alba_resume_focus_date :selected").val().split('/');	// 메인 포커스
		var alba_resume_focus_price = (alba_resume_focus[4]) ? Number(alba_resume_focus[4]) : 0;
	} else {
		var alba_resume_focus_price = 0;
	}
	total_sum_price += alba_resume_focus_price;

	//alert(total_sum_price+" :: 인재정보 포커스 "+alba_resume_focus_price);


	var $alba_resume_focus_gold = $("#alba_resume_focus_gold");	 // 서브 포커스 골드 서비스
	var alba_resume_focus_gold_length = $alba_resume_focus_gold.length;
	if(alba_resume_focus_gold_length){
		if( $alba_resume_focus_gold.is(':checked') ){	// 체크했다면
			var alba_resume_focus_gold = $("#alba_resume_focus_gold_date :selected").val().split('/');
			var alba_resume_focus_gold_price = (alba_resume_focus_gold[4]) ? Number(alba_resume_focus_gold[4]) : 0;
		} else {
			var alba_resume_focus_gold_price = 0;
		}
	} else {
		var alba_resume_focus_gold_price = 0;
	}
	total_sum_price += alba_resume_focus_gold_price;

	//alert(total_sum_price+" :: 인재정보 포커스 골드 "+alba_resume_focus_gold_price);


	var alba_resume_basic_length = $("#alba_resume_basic_date").length;
	if(alba_resume_basic_length){
		var alba_resume_basic = $("#alba_resume_basic_date :selected").val().split('/');	// 메인 포커스
		var alba_resume_basic_price = (alba_resume_basic[4]) ? Number(alba_resume_basic[4]) : 0;
	} else {
		var alba_resume_basic_price = 0;
	}
	total_sum_price += alba_resume_basic_price;

	//alert(total_sum_price+" :: 인재정보 일반리스트 "+alba_resume_basic_price);


	var resume_option_busy_date_length = $("#resume_option_busy_date").length;
	if(resume_option_busy_date_length){
		var resume_option_busy = $("#resume_option_busy_date :selected").val().split('/');	// 급구 아이콘
		var resume_option_busy_price = (resume_option_busy[4]) ? Number(resume_option_busy[4]) : 0;
	} else {
		var resume_option_busy_price = 0;
	}
	total_sum_price += resume_option_busy_price;

	//alert(total_sum_price+" :: 인재정보 급구 아이콘 "+resume_option_busy_price);

	var $resume_option_jump = $("#resume_option_jump");	 // 점프 서비스
	var resume_option_jump_length = $resume_option_jump.length;
	if(resume_option_jump_length){
		var resume_option_jump = $("#resume_option_jump_price").val().split('/');
		var resume_option_jump_price = (resume_option_jump[4]) ? Number(resume_option_jump[4]) : 0;
	} else {
		var resume_option_jump_price = 0;
	}
	total_sum_price += resume_option_jump_price;

	//alert(total_sum_price+" :: 점프 서비스 "+alba_option_jump_price);


	if(is_option){	// 옵션으로 선택된 경우

		var $resume_option_neon = $("#resume_option_neon");	 // 형광펜 옵션 서비스
		var resume_option_neon_length = $resume_option_neon.length;
		if(resume_option_neon_length){
			if( $resume_option_neon.is(':checked') ){	// 체크했다면
				var resume_option_neon = $("#resume_option_neon_date :selected").val().split('/');
				var resume_option_neon_price = (resume_option_neon[4]) ? Number(resume_option_neon[4]) : 0;
			} else {
				var resume_option_neon_price = 0;
			}
		} else {
			var resume_option_neon_price = 0;
		}
		total_sum_price += resume_option_neon_price;

		//alert(total_sum_price+" :: 형광펜 "+resume_option_neon_price);


		var $resume_option_bold = $("#resume_option_bold");	 // 굵은글자 옵션 서비스
		var resume_option_bold_length = $resume_option_bold.length;
		if(resume_option_bold_length){
			if( $resume_option_bold.is(':checked') ){	// 체크했다면
				var resume_option_bold = $("#resume_option_bold_date :selected").val().split('/');
				var resume_option_bold_price = (resume_option_bold[4]) ? Number(resume_option_bold[4]) : 0;
			} else {
				var resume_option_bold_price = 0;
			}
		} else {
			var resume_option_bold_price = 0;
		}
		total_sum_price += resume_option_bold_price;

		//alert(total_sum_price+" :: 굵은글자 "+resume_option_bold_price);


		var $resume_option_icon = $("#resume_option_icon");	 // 아이콘 옵션 서비스
		var resume_option_icon_length = $resume_option_icon.length;
		if(resume_option_icon_length){
			if( $resume_option_icon.is(':checked') ){	// 체크했다면
				var resume_option_icon = $("#resume_option_icon_date :selected").val().split('/');
				var resume_option_icon_price = (resume_option_icon[4]) ? Number(resume_option_icon[4]) : 0;
			} else {
				var resume_option_icon_price = 0;
			}
		} else {
			var resume_option_icon_price = 0;
		}
		total_sum_price += resume_option_icon_price;

		//alert(total_sum_price+" :: 아이콘 "+resume_option_icon_price);


		var $resume_option_color = $("#resume_option_color");	 // 글자색 옵션 서비스
		var resume_option_color_length = $resume_option_color.length;
		if(resume_option_color_length){
			if( $resume_option_color.is(':checked') ){	// 체크했다면
				var resume_option_color = $("#resume_option_color_date :selected").val().split('/');
				var resume_option_color_price = (resume_option_color[4]) ? Number(resume_option_color[4]) : 0;
			} else {
				var resume_option_color_price = 0;
			}
		} else {
			var resume_option_color_price = 0;
		}
		total_sum_price += resume_option_color_price;

		//alert(total_sum_price+" :: 글자색 "+resume_option_color_price);


		var $resume_option_blink = $("#resume_option_blink");	 // 반짝칼라 옵션 서비스
		var resume_option_blink_length = $resume_option_blink.length;
		if(resume_option_blink_length){
			if( $resume_option_blink.is(':checked') ){	// 체크했다면
				var resume_option_blink = $("#resume_option_blink_date :selected").val().split('/');
				var resume_option_blink_price = (resume_option_blink[4]) ? Number(resume_option_blink[4]) : 0;
			} else {
				var resume_option_blink_price = 0;
			}
		} else {
			var resume_option_blink_price = 0;
		}
		total_sum_price += resume_option_blink_price;

		//alert(total_sum_price+" :: 반짝칼라 "+resume_option_blink_price);

	} else {	 // 옵션이 서비스로 선택된 경우

		var $resume_option_neon = $("#resume_option_neon");	 // 형광펜 옵션 서비스
		var resume_option_neon_length = $resume_option_neon.length;
		if(resume_option_neon_length){
			if( $resume_option_neon.is(':checked') ){	// 체크했다면
				var resume_option_neon = $("#resume_option_neon_date :selected").val().split('/');
				var resume_option_neon_price = (resume_option_neon[4]) ? Number(resume_option_neon[4]) : 0;
			} else {
				var resume_option_neon_price = 0;
			}
		} else {
			var resume_option_neon_price = 0;
		}
		total_sum_price += resume_option_neon_price;

		//alert(total_sum_price+" :: 형광펜 "+resume_option_neon_price);


		var $resume_option_bold = $("#resume_option_bold");	 // 굵은글자 옵션 서비스
		var resume_option_bold_length = $resume_option_bold.length;
		if(resume_option_bold_length){
			if( $resume_option_bold.is(':checked') ){	// 체크했다면
				var resume_option_bold = $("#resume_option_bold_date :selected").val().split('/');
				var resume_option_bold_price = (resume_option_bold[4]) ? Number(resume_option_bold[4]) : 0;
			} else {
				var resume_option_bold_price = 0;
			}
		} else {
			var resume_option_bold_price = 0;
		}
		total_sum_price += resume_option_bold_price;

		//alert(total_sum_price+" :: 굵은글자 "+resume_option_bold_price);


		var $resume_option_icon = $("#resume_option_icon");	 // 아이콘 옵션 서비스
		var resume_option_icon_length = $resume_option_icon.length;
		if(resume_option_icon_length){
			if( $resume_option_icon.is(':checked') ){	// 체크했다면
				var resume_option_icon = $("#resume_option_icon_date :selected").val().split('/');
				var resume_option_icon_price = (resume_option_icon[4]) ? Number(resume_option_icon[4]) : 0;
			} else {
				var resume_option_icon_price = 0;
			}
		} else {
			var resume_option_icon_price = 0;
		}
		total_sum_price += resume_option_icon_price;

		//alert(total_sum_price+" :: 아이콘 "+resume_option_icon_price);


		var $resume_option_color = $("#resume_option_color");	 // 글자색 옵션 서비스
		var resume_option_color_length = $resume_option_color.length;
		if(resume_option_color_length){
			if( $resume_option_color.is(':checked') ){	// 체크했다면
				var resume_option_color = $("#resume_option_color_date :selected").val().split('/');
				var resume_option_color_price = (resume_option_color[4]) ? Number(resume_option_color[4]) : 0;
			} else {
				var resume_option_color_price = 0;
			}
		} else {
			var resume_option_color_price = 0;
		}
		total_sum_price += resume_option_color_price;

		//alert(total_sum_price+" :: 글자색 "+resume_option_color_price);


		var $resume_option_blink = $("#resume_option_blink");	 // 반짝칼라 옵션 서비스
		var resume_option_blink_length = $resume_option_blink.length;
		if(resume_option_blink_length){
			if( $resume_option_blink.is(':checked') ){	// 체크했다면
				var resume_option_blink = $("#resume_option_blink_date :selected").val().split('/');
				var resume_option_blink_price = (resume_option_blink[4]) ? Number(resume_option_blink[4]) : 0;
			} else {
				var resume_option_blink_price = 0;
			}
		} else {
			var resume_option_blink_price = 0;
		}
		total_sum_price += resume_option_blink_price;

		//alert(total_sum_price+" :: 반짝칼라 "+resume_option_blink_price);

	}
	
	var package_price = ( $('#package_price').val() ) ? Number( $('#package_price').val() ) : 0;
	if( package_price ){
		total_sum_price += package_price;
	}

	$('#pay_use_point').val('0');	// 할인내역 포인트 필드
	$('#sumTotal_Price, #total_pay_price, #sumTotal_price').html( String(total_sum_price).number_format() );
	$('#total_price').val(total_sum_price);
	$('#pay_price').val(total_sum_price)

	if(total_sum_price==0){
		$('#payFrm').hide();
	} else {
		$('#payFrm').show();
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
				$('#price').val(total_price);
				return;
			}
		}
	}
}
var pay_submit = function(){	// 선택 서비스 정보 form ajax 전송
	var total_price = $('#total_price').val();
	var pay_options = { target: '', paySubmit: payRequest, success : payResponse };
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

	$('#ServicePayment').attr("action", "./process/alba_resume_pay.php");
	$('#ServicePayment').ajaxSubmit(pay_options);
	//$('#ServicePayment').submit();
	//document.getElementById('ServicePayment').submit();
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
				$('#PayGateFrm').attr("action","./process/alba_resume_bank.php");	// 무통장 입금일때 submit 경로가 바뀐다.
				$('#PayGateFrm').removeAttr("onsubmit");
				//location.href = "./success.php?oid=" + oid;
			}
		}

		if(price=='0'){	// 무료일때
			location.href = "./success.php?oid="+oid;
			return false;
		}

		$('#pay_no').val(pay_no);
		$('#oid').val(oid);
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

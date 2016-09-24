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

});

var service_preview = function( service ){
	
	$('#'+service+'_preview').toggle();

}

var service_submit = function( service, no ){

	switch(service){

		// 알바 공고 등록 신청
		case 'alba':

			if(is_member){
				if(mb_type=='individual'){	// 개인회원일 경우
					alert("기업회원 서비스 입니다.");
					return;
				} else {
					location.href = "../company/alba_regist.php";
				}
			} else {
				alert("회원만 서비스 등록 가능합니다.\n\n회원 이시라면 로그인해 보세요.");
				win_open("../popup/login.php?type=company", "pop_login", 480, 200);
			}
		
		break;

		// 알바 이력서 등록 신청
		case 'alba_resume':

			if(is_member){
				if(mb_type=='company'){	// 기업회원일 경우
					alert("개인회원 서비스 입니다.");
					return;
				} else {
					location.href = "../individual/alba_resume_regist.php";
				}
			} else {
				alert("회원만 서비스 등록 가능합니다.\n\n회원 이시라면 로그인해 보세요.");
				win_open("../popup/login.php?type=individual", "pop_login", 480, 200);
			}

		break;

		// 이력서 열람 서비스
		case 'resume_open':

			if(is_member){
				if(mb_type=='individual'){	// 개인회원일 경우
					alert("기업회원 서비스 입니다.");
					return;
				} else {
					serviceFrm_submit('etc_open');
				}
			} else {
				alert("회원만 열람 가능합니다.\n\n회원 이시라면 로그인해 보세요.");
				win_open("../popup/login.php?type=company", "pop_login", 480, 200);
			}

		break;

		// SMS 충전 서비스
		case 'etc_sms':

			if(is_member){
				var service_sel = $('#etc_sms_date :selected').val();
				if(service_sel=='' || !service_sel){
					alert("충전 건수를 선택해 주세요.");
					$('#etc_sms_date').focus();
					return;
				} else {
					//serviceFrm_submit('etc_sms');
					$('#ServiceSMSFrm').submit();
				}
			} else {
				alert("회원만 충전 가능합니다.\n\n회원 이시라면 로그인해 보세요.");
				win_open("../popup/login.php?type=company", "pop_login", 480, 200);
			}

		break;

		// 채용공고 패키지 서비스
		case 'alba_package':

			$("input[name='employ_package_no']").each(function(){
				$(this).removeAttr('checked');
			});
			$('#employ_package_'+no).attr('checked','checked');

			if(is_member){
				if( mb_type == 'individual' ){
					alert("기업회원 서비스 입니다.");
					return;
				} else {
					location.href = "../company/alba_regist.php";
				}
			} else {
				alert("회원만 서비스 등록 가능합니다.\n\n회원 이시라면 로그인해 보세요.");
				win_open("../popup/login.php?type=company", "pop_login", 480, 200);
			}
		
		break;

		// 이력서 패키지 서비스
		case 'resume_package':

			$("input[name='individual_package_no']").each(function(){
				$(this).removeAttr('checked');
			});
			$('#individual_package_'+no).attr('checked','checked');

			if(is_member){
				if( mb_type == 'company' ){
					alert("개인회원 서비스 입니다.");
					return;
				} else {
					location.href = "../individual/alba_resume_regist.php";
				}
			} else {
				alert("회원만 서비스 등록 가능합니다.\n\n회원 이시라면 로그인해 보세요.");
				win_open("../popup/login.php?type=individual", "pop_login", 480, 200);
			}
		
		break;

	}

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

	if(service=='etc_sms'){
		$('#ServiceSMSFrm').submit();
	} else {
		$('#ServiceFrm').submit();
	}

}

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

			$('#'+service+"_price_info .positionA").show();
			$('#'+service+"_price_info .price").html( service_info[2].number_format() );
			$('#'+service+"_price_info .priceDc").html( service_percent + "%" );
			$('#'+service+"_price_info .mr5").show();
			$('#'+service+"_price_info .pay .text_orange").html( total_price.number_format() );

		} else {	 // 할인율 없을때

			$('#'+service+"_price_info .positionA").hide();
			$('#'+service+"_price_info .mr5").hide();
			$('#'+service+"_price_info .pay .text_orange").html( total_price.number_format() );

		}

		//alert( service_price + " @ " + total_price );

		//total_sum_price += total_price;
		
	} else {	 // 무료일때

		$('#'+service+"_price_info .pay .text_orange").html( "무료" );
		$('#'+service+"_price_info .won").hide();

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

	var etc_sms_sel = $('#etc_sms_date :selected').attr('price');	// 이력서 열람
	var etc_sms_sel_price = (etc_sms_sel) ? Number(etc_sms_sel) : 0;


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

	var resume_option_color_sel = $('#resume_option_color_date :selected').attr('price');	// 아이콘 옵션
	var resume_option_color_sel_price = (resume_option_color_sel) ? Number(resume_option_color_sel) : 0;

	var resume_option_blink_sel = $('#resume_option_blink_date :selected').attr('price');	// 아이콘 옵션
	var resume_option_blink_sel_price = (resume_option_blink_sel) ? Number(resume_option_blink_sel) : 0;

	var resume_option_jump_sel = $('#resume_option_jump_date :selected').attr('price');	// 아이콘 옵션
	var resume_option_jump_sel_price = (resume_option_jump_sel) ? Number(resume_option_jump_sel) : 0;


	var sum_price = main_platinum_sel_price+main_prime_sel_price+main_grand_sel_price+main_banner_sel_price+main_list_sel_price+alba_platinum_sel_price+alba_banner_sel_price+alba_list_sel_price+alba_option_busy_sel_price+alba_option_logo_sel_price+alba_option_neon_sel_price+alba_option_bold_sel_price+alba_option_icon_sel_price+alba_option_color_sel_price+alba_option_blink_sel_price+alba_option_jump_sel_price+etc_open_sel_price+etc_sms_sel_price;

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

var service_tabs = function( tabs ){

	var etc_alba_sms_content = $('#etc_alba_sms_content').val();
	var etc_resume_sms_content = $('#etc_resume_sms_content').val();
	if(tabs=='tab1'){
		$('#sms_content').html(etc_alba_sms_content);
	} else if(tabs=='tab2'){
		$('#sms_content').html(etc_resume_sms_content);
	}

	$('.tab1, .tab2').removeClass('on');
	$('.serviceContentWrap').hide();

	$('.'+tabs).addClass('on');
	$('#'+tabs).show();

}

var serviceFrm_ended = function(){	 // 서비스 마감
	alert("서비스가 마감되어 더이상 등록 불가능 합니다");
	return;
}

var package_on = function( type, vals ){
	var checked = vals.checked;
	$("input[name='"+type+"_package_no']").each(function(){
		$(this).removeAttr('checked');
	});
	if(checked==true){
		vals.checked = true;
	} else {
		vals.checked = false;
	}
}

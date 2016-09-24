$(function(){

	fade_images('fade_image');	// 페이드 형태
	setInterval(function(){
		fade_images('fade_image');
	}, 3000);

	blink('blink_image',900000,1500);	// 깜빡임

	var $slide_image = $('.slide_image');
	if($slide_image.length > 0 ) {
		$slide_image.cycle({		// 슬라이드
			fx:     cycle_direction, 
			easing: 'easeInOutBack',
			delay:  -2000 
		});
	}

	var colour;
	setInterval(function(){
		colour = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);	
		$('.jumble').animate({
			color: colour
		});
	}, 500);

	$('.second_all').each(function(){
		var checked = $(this).is(':checked');
		var sel = $(this).val();
		var sel_class = $(this).attr('class').split(' ');
		if(checked){
			$('.'+sel_class[0]).attr('disabled',true);
		}
	});
	$('.second_all').attr('disabled',false);

	$('.third_all').each(function(){
		var checked = $(this).is(':checked');
		var sel = $(this).val();
		var sel_class = $(this).attr('class').split(' ');
		if(checked){
			$('.'+sel_class[2]).attr('disabled',true);
		}
	});
	$('.third_all').attr('disabled',false);

});

var searchFrm_submit = function(){	 // 검색 시~작!
	
	$('#albaSearchFrm').submit();

}

var searchFrm_reset = function(){	// 초기화

	/*
	$(".listArea li > span").removeClass('checkOn');
	$(".listArea li > span input[type='checkbox']").attr('checked',false);
	$('.middleArea, .smallArea').hide();
	$(".listSubway li > span").removeClass('checkOn');
	$(".listSubway li > span input[type='checkbox']").attr('checked',false);
	$('.middleSubway, .smallSubway').hide();
	$(".listJobtype li > span").removeClass('checkOn');
	$(".listJobtype li > span input[type='checkbox']").attr('checked',false);
	$('.middlePartSet, .smallPartSet').hide();

	$('.selectList').html("");
	$('.selectBox').hide();
	$('.noSelect').show();

	$('#wr_date :eq(0)').attr('selected',true);
	$('#wr_week :eq(0)').attr('selected',true);
	$('#wr_stime :eq(0), #wr_smin :eq(0), #wr_etime :eq(0), #wr_emin :eq(0)').attr('selected',true);
	$('#wr_time_conference').attr('checked',false);
	$('#wr_ability :eq(0)').attr('selected',true);
	$("input[name='wr_career_type']").attr('checked',false);
	$('#wr_age').val('');
	$('#wr_age_limit').attr('checked',false);
	$("input[name='wr_gender']").attr('checked',false);

	$('#alba_search_keyword').val('');
	*/

}

var area_search_limit = 5;	// 근무지역 검색 조건 선택 제한 (제한을 두지 않으면 검색시 DB 과부하가 발생할수 있습니다)
var area_first = [];
var area_second = [];
var area_third = [];
var area_firsts = function( vals ){	// 1차 지역 검색 선택
	var code = vals.value;
	var checked = vals.checked;
	var text = $('#area_top_'+code+' label').text();

	var area_first_length = area_first.length;

	if( checked == true ){	// 체크했다면 2차 항목 추가
		
		if( $('.area').length >= area_search_limit ){
			alert("근무지역 검색 조건은 최대 5가지 입니다.");
			$('#wr_area_0_'+code).attr('checked',false);
			return false;
		}

		// 2차 지역값 출력
		//$('#area_second').load('./views/_load/area.php', { mode:'default', first_area:code }, function(result){
		$.post('./views/_load/area.php', { mode:'default', type:'second_area', first_area:code }, function(result){

			$('#area_second').append(result);

			// 검색 조건
			var append_list = "<li id=\"select_"+code+"\" class=\"area\">"+text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+code+"\" id=\"area_sels_"+code+"\" class=\"area_sel_"+code+"\" />");

			$('.noSelect').hide();
			$('.selectBox').show();

			for(i=0;i<area_first_length;i++){
				if( area_first[i] == code ){	// 기존에 동일한 값이 있다면 제거
					area_first.splice(i,1);
				}
			}
			area_first.push(code);

		});

		//alert( $('.area').length );

	} else { // 체크를 껐다면 2차 항목 제거

		$('#area_second_'+code+', #area_third_'+code).remove();

		// 검색 조건
		$("#select_"+code+", .select_"+code).remove();
		$('#area_sels_'+code).remove();

		for(i=0;i<area_first_length;i++){
			if( area_first[i] == code ){	// 기존에 동일한 값이 있다면 제거
				area_first.splice(i,1);
			}
		}

		var checked_length = $("input[name='wr_area_0[]']:checked").length;
		if(checked_length >= 1){	// 체크 갯수가 있다면
			$('.noSelect').hide();
			$('.selectBox').show();
		} else {	 // 체크 갯수가 없다면 선택된 조건이 없다한다.
			$('.noSelect').show();
			$('.selectBox').hide();
		}

		//alert( $('.area').length );

	}
	
}
var area_seconds = function( vals, p_code ){	// 2차 지역 검색 선택
	var code = vals.value;
	var checked = vals.checked;
	var first_text = $('#area_top_'+p_code+' label').text();	 // 1차 지역값 명칭
	var first_code = $('#wr_area_0_'+p_code).val();
	var second_text = $('#area_middle_'+code+' label').text();	// 2차 지역값 명칭

	var first_length = $("#select_"+p_code).length;	 // 1차 지역 선택값 수

	var code_all = code.match(/all/);	 // 전체 체크시

	if(checked == true){	// 체크했다면

		if( $('.area').length >= area_search_limit ){
			alert("근무지역 검색 조건은 최대 5가지 입니다.");
			$('#wr_area_1_'+code).attr('checked',false);
			return false;
		}

		//if(code=='all'){	// 전체 체크

		if(code_all) {

			$('.'+p_code).each(function(){

				if( $(this).is(':checked') == true ){
					var checked_code = $(this).val();
					var area_second_length = area_second.length;
					for(i=0;i<area_second_length;i++){
						if( area_second[i] == checked_code ){	// 기존에 동일한 값이 있다면 제거
							area_second.splice(i,1);
						}
					}
				}
				
				var sel_all = $(this).val().match(/all/);
				if( !sel_all){	// 전체가 아닌 2차 지역
					$(this).attr('checked',false);	// 체크 해제
					$(this).attr('disabled',true);		// 비활성
				}
			});
			
			$('#area_third_'+p_code+' > div').remove();	// 3차 제거
			$('.select_'+p_code+', .area_sel_'+p_code).remove();	// 기존 선택들 모두 제거
			$('.area_'+p_code+', #select_'+p_code).remove();

			//alert(code+" @ "+p_code);
			// area_sel_20130716174853_3466_20130716174928_9257
			// 20131126132601_5023_all @ 20130716174916_3863

			area_second.push(code);	// 2차 선택 배열에 값 입력
			var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" area\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+p_code+"','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#area_sels_'+p_code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"/"+code+"\" id=\"area_sels_"+p_code+"_"+code+"\" class=\"area_sel_"+p_code+"\" />");

		} else {	 // 일반 체크

			$.post('./views/_load/area.php', { mode:'default', type:'third_area', first_area:p_code, second_area:code }, function(result){

				$('#area_third_'+p_code).append(result);
				area_second.push(code);	// 2차 선택 배열에 값 입력
				$("#select_"+p_code).remove();	 // 우선 기존 1차 지역 선택값을 삭제하고
				var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" area\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+p_code+"','"+code+"');\">x</button></li>";
				$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
				$('#area_sels_'+p_code).remove();
				$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"/"+code+"\" id=\"area_sels_"+p_code+"_"+code+"\" class=\"area_sel_"+p_code+"\" />");

			});

		}

	} else {

		if(code_all){	// 전체 체크 해제

			var area_second_length = area_second.length;
			for(i=0;i<area_second_length;i++){
				var sel_all = area_second[i].match(/all/);
				if( sel_all ){	// 기존에 동일한 값이 있다면 제거
					area_second.splice(i,1);
				}
			}

			$('.'+p_code).attr('disabled',false);
			$('#select_'+p_code).remove();
			$('.select_'+p_code+', .area_sel_'+p_code).remove();

			// 검색 조건
			var append_list = "<li id=\"select_"+p_code+"\" class=\"area\">"+first_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+p_code+"');\">x</button></li>";
			$('.selectList').append(append_list);
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"\" id=\"area_sels_"+p_code+"\" class=\"area_sel_"+p_code+"\" />");

		} else {	 // 일반 체크 해제

			$('#area_third_'+code).remove();

			// 검색 조건
			$("#select_"+p_code+"_"+code+", .select_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제

			var area_second_length = area_second.length;
			for(i=0;i<area_second_length;i++){
				if( area_second[i] == code ){	// 기존에 동일한 값이 있다면 제거
					area_second.splice(i,1);
				}
			}

			var checked_length = $("input[name='wr_area_1["+p_code+"][]']:checked").length;

			if(checked_length == 0){
				var append_list = "<li id=\"select_"+p_code+"\" class=\"area\">"+first_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+p_code+"');\">x</button></li>";
				$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
				$('#area_sels_'+p_code+"_"+code).remove();
				$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"\" id=\"area_sels_"+p_code+"\" class=\"area_sel_"+p_code+"\" />");
			}

		}

	}

}
var area_thirds = function( vals, p_code, first_code ){	// 3차 지역 검색 선택 third code, second code, first code
	var code = vals.value;	// 개포동 //var p_code = 강남구; //var first_code = 서울; 이렇듯 거꾸로 간다
	var checked = vals.checked;

	var first_text = $('#area_top_'+first_code+' label').text();	 // 1차 지역값 명칭
	var second_text = $('#area_middle_'+p_code+' label').text();	 // 2차 지역값 명칭
	var third_text = $('#area_sub_'+code+' label').text();	 // 3차 지역값 명칭

	//alert(first_code+" @ "+p_code+" @ "+code+"\n\n"+first_text+" @ "+second_text+" @ "+third_text);

	var code_all = code.match(/all/);	 // 전체 체크시


	if(checked == true){	// 체크했다면

		if( $('.area').length >= area_search_limit ){
			alert("근무지역 검색 조건은 최대 5가지 입니다.");
			$('#wr_area_2_'+code).attr('checked',false);
			return false;
		}

		if(code_all){	// 전체 체크

			$('.'+first_code+'_'+p_code).each(function(){
				var checked_code = $(this).val();
				var area_third_length = area_third.length;
				for(i=0;i<area_third_length;i++){
					if( area_third[i] == checked_code ){	// 기존에 동일한 값이 있다면 제거
						area_third.splice(i,1);
					}
				}
				var sel_all = $(this).val().match(/all/);
				if( !sel_all){	// 전체가 아닌 3차 지역
					$(this).attr('checked',false);	// 체크 해제
					$(this).attr('disabled',true);		// 비활성
				}
			});

			$('.area_sel_'+first_code).remove();
			$('.select_'+first_code+'_'+p_code+', .area_sel_'+first_code+'_'+p_code).remove();

			// 검색 조건
			area_third.push(code);
			$("#select_"+first_code+"_"+p_code).remove();	 // 우선 기존 1,2차 지역 선택값을 삭제하고
			var append_list = "<li id=\"select_"+first_code+"_"+p_code+"_"+code+"\" class=\"select_"+first_code+"_"+p_code+" select_"+first_code+" area\">"+first_text+" > "+second_text+" > "+third_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+first_code+"','"+p_code+"','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 + 3차 지역값을 합쳐서 추가
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"/"+p_code+"/"+code+"\" id=\"area_sels_"+first_code+"_"+p_code+"_"+code+"\" class=\"area_sel_"+first_code+"_"+p_code+" area_"+first_code+"\" />");

		} else {	 // 일반 체크

			if( $('.area').length >= area_search_limit ){
				alert("근무지역 검색 조건은 최대 5가지 입니다.");
				$('#wr_area_2_'+code).attr('checked',false);
				return false;
			}

			$('.select_'+p_code+', .area_sel_'+p_code).remove();

			// 검색 조건
			area_third.push(code);
			$("#select_"+first_code+"_"+p_code).remove();	 // 우선 기존 1,2차 지역 선택값을 삭제하고
			var append_list = "<li id=\"select_"+first_code+"_"+p_code+"_"+code+"\" class=\"select_"+first_code+"_"+p_code+" select_"+first_code+" area\">"+first_text+" > "+second_text+" > "+third_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+first_code+"','"+p_code+"','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 + 3차 지역값을 합쳐서 추가
			$('#area_sels_'+first_code+"_"+p_code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"/"+p_code+"/"+code+"\" id=\"area_sels_"+first_code+"_"+p_code+"_"+code+"\" class=\"area_sel_"+first_code+"_"+p_code+" area_"+first_code+"\" />");

		}

	} else {	 

		if(code_all){	// 전체 체크 해제

			var area_third_length = area_third.length;
			for(i=0;i<area_third_length;i++){
				var sel_all = area_third[i].match(/all/);
				if( sel_all ){	// 기존에 동일한 값이 있다면 제거
					area_third.splice(i,1);
				}
			}

			$('.'+first_code+'_'+p_code).attr('disabled',false);
			$('.select_'+first_code+'_'+p_code+', .area_sel_'+first_code+'_'+p_code).remove();

			var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" area\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+p_code+"','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#area_sels_'+p_code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"/"+code+"\" id=\"area_sels_"+p_code+"_"+code+"\" class=\"area_sel_"+p_code+"\" />");

		} else {	 // 일반 체크 해제

			// 검색 조건
			$("#select_"+first_code+"_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제
			$('#area_sels_'+first_code+'_'+p_code+'_'+code).remove();
			var area_third_length = area_third.length;
			for(i=0;i<area_third_length;i++){
				if( area_third[i] == code ){	// 기존에 동일한 값이 있다면 제거
					area_third.splice(i,1);
				}
			}

			var checked_length = $("input[name='wr_area_2["+first_code+"]["+p_code+"][]']:checked").length;

			if(checked_length == 0){
				var append_list = "<li id=\"select_"+first_code+"_"+p_code+"\" class=\"select_"+first_code+" area\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+first_code+"','"+p_code+"');\">x</button></li>";
				$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
				$('#area_sels_'+first_code+"_"+p_code+"_"+code).remove();
				$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"/"+p_code+"\" id=\"area_sels_"+first_code+"_"+p_code+"\" class=\"area_sel_"+first_code+"_"+p_code+" area_"+first_code+"\" />");
			}

		}

	}

}
var area_middle_all = function( vals, first_code, text ){
	var sel = vals.value;
	var checked = vals.checked;
	if(checked){
		$('.'+first_code).attr('checked',false);		// 체크 필드 초기화
		$('.'+first_code).attr('disabled',true);		// 체크 필드 사용제한
		$('#area_third_'+first_code).html("");		// 3차 지역값 제거
		$('.select_'+first_code).remove();			// 선택된 조건 지역값 제거
		$('.area_sel_'+first_code).remove();

		// 선택된 조건 전체 추가
		$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"\" id=\"area_sels_"+first_code+"\" class=\"area_sel_"+first_code+" area_second_"+sel+"\" />");
	} else {
		$('.'+first_code).attr('disabled',false);
		$('.area_second_'+sel).remove();
	}
}
var area_sub_all = function( vals, first_code, second_code, first_text, second_text ){
	var sel = vals.value;
	var checked = vals.checked;
	// all @ 20130716174853_3466 @ 20130716174927_3418 @ 강남구
	// all @ 20130716174853_3466 @ 20130716174928_9257 @ 강동구
	//alert( sel+" @ "+first_code+" @ "+second_code+" @ "+text );
	if(checked){
		$('.'+first_code+'_'+second_code).attr('checked',false);		// 체크 필드 초기화
		$('.'+first_code+'_'+second_code).attr('disabled',true);		// 체크 필드 사용제한

		// 선택된 조건 전체 추가
		$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"/"+second_code+"\" id=\"area_sels_"+first_code+"_"+second_code+"\" class=\"area_sel_"+first_code+"_"+second_code+" area_third_"+sel+"\" />");
	} else {
		$('.'+first_code+'_'+second_code).attr('disabled',false);
		$('.area_third_'+sel).remove();
	}
}
var subway_search_limit = 5;	// 역세권 검색 조건 선택 제한 (제한을 두지 않으면 검색시 DB 과부하가 발생할수 있습니다)
var subway_first = [];
var subway_second = [];
var subway_third = [];
var subway_firsts = function( vals ){	// 1차 지하철 검색 선택
	var code = vals.value;
	var checked = vals.checked;
	var text = $('#subway_top_'+code+' label').text();

	var subway_first_length = subway_first.length;

	if( checked == true ){	// 체크했다면
		
		if( $('.subways').length >= subway_search_limit ){
			alert("역세권 검색 조건은 최대 5가지 입니다.");
			$('#wr_subway_0_'+code).attr('checked',false);
			return false;
		}

		$.post('./views/_load/subway.php', { mode:'default', type:'second_subway', first_subway:code }, function(result){

			$('#subway_second').append(result);

			// 검색 조건
			var append_list = "<li id=\"select_"+code+"\" class=\"subways\">"+text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('subway','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);
			$('.selectList').append("<input type=\"hidden\" name=\"subway_sels[]\" value=\""+code+"\" id=\"subway_sels_"+code+"\"/>");

			$('.noSelect').hide();
			$('.selectBox').show();

			for(i=0;i<subway_first_length;i++){
				if( subway_first[i] == code ){	// 기존에 동일한 값이 있다면 제거
					subway_first.splice(i,1);
				}
			}
			subway_first.push(code);

		});

	} else { // 체크를 껐다면

		$('#subway_second_'+code+', #subway_third_'+code).remove();

		// 검색 조건
		$("#select_"+code+", .select_"+code).remove();
		$('#subway_sels_'+code).remove();

		for(i=0;i<subway_first_length;i++){
			if( subway_first[i] == code ){	// 기존에 동일한 값이 있다면 제거
				subway_first.splice(i,1);
			}
		}

		var checked_length = $("input[name='wr_subway_0[]']:checked").length;
		if(checked_length >= 1){	// 체크 갯수가 있다면
			$('.noSelect').hide();
			$('.selectBox').show();
		}

	}

}
var subway_seconds = function( vals, p_code ){
	var code = vals.value;
	var checked = vals.checked;
	var first_text = $('#subway_top_'+p_code+' label').text();	 // 1차 지역값 명칭
	var second_text = $('#subway_middle_'+code+' label').text();	// 2차 지역값 명칭

	var first_length = $("#select_"+p_code).length;	 // 1차 지역 선택값 수

	if( checked == true ){	// 체크했다면

		if( $('.subways').length >= subway_search_limit ){
			alert("역세권 검색 조건은 최대 5가지 입니다.");
			$('#wr_subway_1_'+code).attr('checked',false);
			return false;
		}

		$.post('./views/_load/subway.php', { mode:'default', type:'third_subway', first_subway:p_code, second_subway:code }, function(result){
			
			$('#subway_third_'+p_code).append(result);

			// 검색 조건
			subway_second.push(code);	// 2차 선택 배열에 값 입력
			$("#select_"+p_code).remove();	 // 우선 기존 1차 지역 선택값을 삭제하고
			var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" subways\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('subway','"+p_code+"','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#subway_sels_'+p_code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"subway_sels[]\" value=\""+p_code+"/"+code+"\" id=\"subway_sels_"+p_code+"_"+code+"\"/>");

		});

	} else {	 // 체크를 껐다면

		$('#subway_third_'+code).remove();

		// 검색 조건
		$("#select_"+p_code+"_"+code+", .select_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제
		$('#subway_sels_'+p_code+'_'+code).remove();

		var subway_second_length = subway_second.length;
		for(i=0;i<subway_second_length;i++){
			if( subway_second[i] == code ){	// 기존에 동일한 값이 있다면 제거
				subway_second.splice(i,1);
			}
		}

		var checked_length = $("input[name='wr_subway_1["+p_code+"][]']:checked").length;

		if(checked_length == 0){
			var append_list = "<li id=\"select_"+p_code+"\" class=\"subways\">"+first_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('subway','"+p_code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#subway_sels_'+p_code+"_"+code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"subway_sels[]\" value=\""+p_code+"\" id=\"subway_sels_"+p_code+"\"/>");
		}

	}

}
var subway_thirds = function( vals, p_code, first_code ){	// 3차 지역 검색 선택 third code, second code, first code
	var code = vals.value;	// 개포동 //var p_code = 강남구; //var first_code = 서울; 이렇듯 거꾸로 간다
	var checked = vals.checked;

	var first_text = $('#subway_top_'+first_code+' label').text();	 // 1차 지역값 명칭
	var second_text = $('#subway_middle_'+p_code+' label').text();	 // 2차 지역값 명칭
	var third_text = $('#subway_sub_'+code+' label').text();	 // 3차 지역값 명칭

	if( checked == true ){	// 체크했다면

		if( $('.subways').length >= subway_search_limit ){
			alert("역세권 검색 조건은 최대 5가지 입니다.");
			$('#wr_subway_2_'+code).attr('checked',false);
			return false;
		}

		// 검색 조건
		subway_third.push(code);
		$("#select_"+first_code+"_"+p_code).remove();	 // 우선 기존 1,2차 지역 선택값을 삭제하고
		var append_list = "<li id=\"select_"+first_code+"_"+p_code+"_"+code+"\" class=\"select_"+first_code+"_"+p_code+" select_"+first_code+" subways\">"+first_text+" > "+second_text+" > "+third_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('subway','"+first_code+"','"+p_code+"','"+code+"');\">x</button></li>";
		$('.selectList').append(append_list);	// 1차 + 2차 + 3차 지역값을 합쳐서 추가
		$('#subway_sels_'+first_code+"_"+p_code).remove();
		$('.selectList').append("<input type=\"hidden\" name=\"subway_sels[]\" value=\""+first_code+"/"+p_code+"/"+code+"\" id=\"subway_sels_"+first_code+"_"+p_code+"_"+code+"\"/>");

	} else {	 // 체크를 껐다면

		// 검색 조건
		$("#select_"+first_code+"_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제
		var subway_third_length = subway_third.length;
		for(i=0;i<subway_third_length;i++){
			if( subway_third[i] == code ){	// 기존에 동일한 값이 있다면 제거
				subway_third.splice(i,1);
			}
		}

		var checked_length = $("input[name='wr_subway_2["+first_code+"]["+p_code+"][]']:checked").length;

		if(checked_length == 0){
			var append_list = "<li id=\"select_"+first_code+"_"+p_code+"\" class=\"select_"+first_code+" subways\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('subway','"+first_code+"','"+p_code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#subway_sels_'+first_code+"_"+p_code+"_"+code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"subway_sels[]\" value=\""+first_code+"/"+p_code+"\" id=\"subway_sels_"+first_code+"_"+p_code+"\"/>");
		}

	}

}

var search_college = function( vals ){	// 대학가 선택
	var sel = vals.value;

	$('#college_vicinity').load('./views/_load/search.php', { mode:'college_vicinity', code: sel }, function(){

	});

}

var jobtype_search_limit = 5;	// 직종 검색 조건 선택 제한 (제한을 두지 않으면 검색시 DB 과부하가 발생할수 있습니다)
var jobtype_first = [];
var jobtype_second = [];
var jobtype_third = [];
var jobtype_firsts = function( vals ){
	var code = vals.value;
	var checked = vals.checked;
	var text = $('#jobtype_top_'+code+' label').text();

	var jobtype_first_length = jobtype_first.length;

	if( checked == true ){	// 체크했다면

		if( $('.jobtypes').length >= jobtype_search_limit ){
			alert("업직종 검색 조건은 최대 5가지 입니다.");
			$('#wr_jobtype_0_'+code).attr('checked',false);
			return false;
		}

		$.post('./views/_load/jobtype.php', { mode:'default', type:'second_jobtype', first_jobtype:code }, function(result){

			$('#jobtype_second').append(result);

			// 검색 조건
			var append_list = "<li id=\"select_"+code+"\" class=\"jobtypes\">"+text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('jobtype','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);
			$('.selectList').append("<input type=\"hidden\" name=\"jobtype_sels[]\" value=\""+code+"\" id=\"jobtype_sels_"+code+"\"/>");

			$('.noSelect').hide();
			$('.selectBox').show();

			for(i=0;i<jobtype_first_length;i++){
				if( jobtype_first[i] == code ){	// 기존에 동일한 값이 있다면 제거
					jobtype_first.splice(i,1);
				}
			}
			jobtype_first.push(code);

		});	

	} else { // 체크를 껐다면

		$('#jobtype_second_'+code+', #jobtype_third_'+code).remove();

		// 검색 조건
		$("#select_"+code+", .select_"+code).remove();
		$('#jobtype_sels_'+code).remove();

		for(i=0;i<jobtype_first_length;i++){
			if( jobtype_first[i] == code ){	// 기존에 동일한 값이 있다면 제거
				jobtype_first.splice(i,1);
			}
		}

		var checked_length = $("input[name='wr_jobtype_0[]']:checked").length;
		if(checked_length >= 1){	// 체크 갯수가 있다면
			$('.noSelect').hide();
			$('.selectBox').show();
		}

	}

}
var jobtype_seconds = function( vals, p_code ){
	var code = vals.value;
	var checked = vals.checked;
	var first_text = $('#jobtype_top_'+p_code+' label').text();	 // 1차 지역값 명칭
	var second_text = $('#jobtype_middle_'+code+' label').text();	// 2차 지역값 명칭

	var first_length = $("#select_"+p_code).length;	 // 1차 지역 선택값 수

	if( checked == true ){	// 체크했다면

		if( $('.jobtypes').length >= jobtype_search_limit ){
			alert("업직종 검색 조건은 최대 5가지 입니다.");
			$('#wr_jobtype_1_'+code).attr('checked',false);
			return false;
		}

		$.post('./views/_load/jobtype.php', { mode:'default', type:'third_jobtype', first_jobtype:p_code, second_jobtype:code }, function(result){
			
			$('#jobtype_third_'+p_code).append(result);

			jobtype_second.push(code);	// 2차 선택 배열에 값 입력
			$("#select_"+p_code).remove();	 // 우선 기존 1차 지역 선택값을 삭제하고
			var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" jobtypes\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('jobtype','"+p_code+"','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#jobtype_sels_'+p_code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"jobtype_sels[]\" value=\""+p_code+"/"+code+"\" id=\"jobtype_sels_"+p_code+"_"+code+"\"/>");

		});

	} else {	 // 체크를 껐다면

		$('#jobtype_third_'+code).remove();

		// 검색 조건
		$("#select_"+p_code+"_"+code+", .select_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제
		$('#jobtype_sels_'+p_code+'_'+code).remove();

		var jobtype_second_length = jobtype_second.length;
		for(i=0;i<jobtype_second_length;i++){
			if( jobtype_second[i] == code ){	// 기존에 동일한 값이 있다면 제거
				jobtype_second.splice(i,1);
			}
		}

		var checked_length = $("input[name='wr_jobtype_1["+p_code+"][]']:checked").length;

		if(checked_length == 0){
			var append_list = "<li id=\"select_"+p_code+"\" class=\"jobtypes\">"+first_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('jobtype','"+p_code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#jobtype_sels_'+p_code+"_"+code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"jobtype_sels[]\" value=\""+p_code+"\" id=\"jobtype_sels_"+p_code+"\"/>");
		}

	}

}
var jobtype_thirds = function( vals, p_code, first_code ){	// 3차 지역 검색 선택 third code, second code, first code
	var code = vals.value;	// 개포동 //var p_code = 강남구; //var first_code = 서울; 이렇듯 거꾸로 간다
	var checked = vals.checked;

	var first_text = $('#jobtype_top_'+first_code+' label').text();	 // 1차 지역값 명칭
	var second_text = $('#jobtype_middle_'+p_code+' label').text();	 // 2차 지역값 명칭
	var third_text = $('#jobtype_sub_'+code+' label').text();	 // 3차 지역값 명칭

	if( checked == true ){	// 체크했다면

		if( $('.jobtypes').length >= jobtype_search_limit ){
			alert("업직종 검색 조건은 최대 5가지 입니다.");
			$('#wr_jobtype_2_'+code).attr('checked',false);
			return false;
		}

		// 검색 조건
		jobtype_third.push(code);
		$("#select_"+first_code+"_"+p_code).remove();	 // 우선 기존 1,2차 지역 선택값을 삭제하고
		var append_list = "<li id=\"select_"+first_code+"_"+p_code+"_"+code+"\" class=\"select_"+first_code+"_"+p_code+" select_"+first_code+" jobtypes\">"+first_text+" > "+second_text+" > "+third_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('jobtype','"+first_code+"','"+p_code+"','"+code+"');\">x</button></li>";
		$('.selectList').append(append_list);	// 1차 + 2차 + 3차 지역값을 합쳐서 추가
		$('#jobtype_sels_'+first_code+"_"+p_code).remove();
		$('.selectList').append("<input type=\"hidden\" name=\"jobtype_sels[]\" value=\""+first_code+"/"+p_code+"/"+code+"\" id=\"jobtype_sels_"+first_code+"_"+p_code+"_"+code+"\"/>");

	} else {	 // 체크를 껐다면

		// 검색 조건
		$("#select_"+first_code+"_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제
		$('#jobtype_sels_'+first_code+'_'+p_code+'_'+code).remove();

		var jobtype_third_length = jobtype_third.length;
		for(i=0;i<jobtype_third_length;i++){
			if( jobtype_third[i] == code ){	// 기존에 동일한 값이 있다면 제거
				jobtype_third.splice(i,1);
			}
		}

		var checked_length = $("input[name='wr_jobtype_2["+first_code+"]["+p_code+"][]']:checked").length;

		if(checked_length == 0){
			var append_list = "<li id=\"select_"+first_code+"_"+p_code+"\" class=\"select_"+first_code+" jobtypes\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('jobtype','"+first_code+"','"+p_code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#jobtype_sels_'+first_code+"_"+p_code+"_"+code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"jobtype_sels[]\" value=\""+first_code+"/"+p_code+"\" id=\"jobtype_sels_"+first_code+"_"+p_code+"\"/>");
		}

	}

}

var search_close = function( type, first_code, second_code, third_code ){	// 선택된 조건 없애기
	
	// 3차 부터 거꾸로 작업~
	if( third_code ){
		
		$('#wr_'+type+'_2_'+third_code).attr('checked',false);
		
		var second_checked_length = $("input[name='wr_"+type+"_1["+first_code+"][]']:checked").length;
		var third_checked_length = $("input[name='wr_"+type+"_2["+first_code+"]["+second_code+"][]']:checked").length;

		if(third_checked_length == 0){	// 3차 카테고리 체크값이 하나도 없으면

			$('#wr_'+type+'_1_'+second_code).attr('checked',false);
			$('#'+type+'_middle_'+second_code+' > span').removeClass('checkOn');
			$('#'+type+'_third_'+second_code).hide();	// 3차 카테고리 감추기
			
			if(second_checked_length <= 1){	// 2차 카테고리 체크값이 하나도 없으면
				$('#wr_'+type+'_0_'+first_code).attr('checked',false);
				$('#'+type+'_top_'+first_code+' > span').removeClass('checkOn');
				$('#'+type+'_second_'+first_code).hide();	// 2차 카테고리 감추기
			}

		}

		$('#select_'+first_code+'_'+second_code+'_'+third_code).remove();	// 선택 조건 없애기
		$('#'+type+'_sels_'+first_code+'_'+second_code+'_'+third_code).remove();

	} else if( second_code ){	// 2차 카테고리 까지 있는 값 선택시

		$('#wr_'+type+'_1_'+second_code).attr('checked',false);

		var second_checked_length = $("input[name='wr_"+type+"_1["+first_code+"][]']:checked").length;

		if(second_checked_length == 0 ){	// 2차 카테고리 체크값이 하나도 없으면
			$('#wr_'+type+'_0_'+first_code).attr('checked',false);
			$('#'+type+'_top_'+first_code+' > span').removeClass('checkOn');
			$('#'+type+'_second_'+first_code).hide();	// 2차 카테고리 감추기
		}

		$('#'+type+'_third_'+second_code).hide();	// 3차 카테고리 감추기
		$('#'+type+'_middle_'+second_code+' > span').removeClass('checkOn');	// 선택 클래스 빼기

		$('#select_'+first_code+'_'+second_code).remove();	// 선택 조건 없애기
		$('#area_sels_'+first_code+'_'+second_code).remove();

	} else if( first_code ){	 // 1차 카테고리 까지 있는 값 선택시
	
		$('#wr_'+type+'_0_'+first_code).attr('checked',false);
		$('#'+type+'_top_'+first_code+' > span').removeClass('checkOn');
		$('#'+type+'_second_'+first_code).hide();	// 2차 카테고리 감추기

		$('#select_'+first_code).remove();	// 선택 조건 없애기
		$('#'+type+'_sels_'+first_code).remove();

	}

	if(type=='wr_date'){
		$('#wr_date :eq(0)').attr('selected',true);
	} else if(type=='wr_week'){
		$('#wr_week :eq(0)').attr('selected',true);
	}

	var first_checked_length = $("input[name='wr_"+type+"_0[]']:checked").length;

	if(first_checked_length >= 1){	// 체크 갯수가 있다면
		$('.noSelect').hide();
		$('.selectBox').show();
	}/* else {	 // 체크 갯수가 없다면 선택된 조건이 없다한다.
		$('.noSelect').show();
		$('.selectBox').hide();
	}*/

	// alert( type+" :: "+first_code+" "+second_code+" "+third_code );

}

var time_conference = function( vals ){	// 근무 시간협의
	var sel = vals.value;
	var checked = vals.checked;
	if(checked == true){
		$('.wr_time').attr('disabled',true);
		//$('.wr_time :eq(0)').attr('selected',true);
		$('#wr_stime :eq(0), #wr_smin :eq(0), #wr_etime :eq(0), #wr_emin :eq(0)').attr('selected',true);
	} else {
		$('.wr_time').attr('disabled',false);
	}
}

var alba_scrap = function( no ){	// 정규직 공고 스크랩

	if(mb_type=='company'){
		alert("채용정보 스크랩은 개인회원만 가능합니다.");
		return;
	}

	if(mb_id){
		$.post('./process/scrap.php', { mb_id:mb_id, no:no }, function(result){
			alert(result);
		});
	} else {
		alert("회원만 스크랩 가능합니다.");
		win_open("../popup/login.php", "pop_login", 480, 200);
	}

}

var online_becomes = function( no, requisition ){	// 온라인 입사지원

	var requisitions = requisition.split(',');

	if(mb_type=='company' || mb_type==''){
		alert("입사지원은 개인회원만 가능합니다.");
		return;
	}

	var is_online = ( $.inArray('online',requisitions) != -1) ? true : false;
	var is_email = ( $.inArray('email',requisitions) != -1 ) ? true : false;

	var windowW = $(window).width();	// 현재 윈도우 가로 사이즈

	if( is_online && is_email ){	// 온라인, 이메일 둘다 있다면 온라인만 가능토록~
		
		$('#popup').html("");	// 초기화
		$('#popup').load('./views/_load/alba.php', { mode:'become_online', no:no }, function(){
			$(this).show();
		});

	} else if(is_online){

		$('#popup').html("");	// 초기화
		$('#popup').load('./views/_load/alba.php', { mode:'become_online', no:no }, function(){
			$(this).show();
		});

	} else if(is_email){

		$('#popup').html("");	// 초기화
		$('#popup').load('./views/_load/alba.php', { mode:'become_email', no:no }, function(){
			$(this).show();
		});

	} else {

		alert("온라인 입사지원이 불가한 공고 입니다.");
		return;

	}

}

var wr_forms = function( vals ){	// 이력서 양식 선택
	var sel = vals.value;

	if(sel=='user'){
		$('#user_form').show();
		$('#company_form').hide();
		$('#alba_resume').attr('required',true);
	} else if(sel=='company'){
		$('#user_form').hide();
		$('#company_form').show();
		$('#alba_resume').removeAttr('required');
	}

}

var BecomeFrmSubmit = function(){ // 입사지원 폼 전송
	var become_options = { target : '', beforeSubmit : becomeRequest, success : becomeResponse }
	$('#BecomeFrm').ajaxSubmit(become_options);
	//$('#BecomeFrm').submit();
}

var BecomeFrmCancel = function(){	// 입사지원 취소
	$('#popup').hide();
	$('#popup').html("");
}

var becomeRequest = function(formData, jqForm, become_options){	 // 입사지원 전송 전
	var BecomeFrm = document.getElementById('BecomeFrm');
	var queryString = $.param(formData);
	return validate(BecomeFrm);
}
var becomeResponse = function(responseText, statusText, xhr, $form){	// 입사지원 전송 후
	if(responseText=='0000'){
		alert("이미 지원하셨습니다.");
		$("#popup").hide();
		$("#popup").html("");
	} else {
		if(responseText == 'become_online'){	// 온라인 입사지원 결과
			alert("온라인 입사지원이 완료 되었습니다.");
		} else if(responseText == 'become_email'){	// 이메일 입사지원 결과
			alert("이메일 입사지원이 완료 되었습니다.");
		}
		$('#popup').hide();
		$('#popup').html("");
	}
}

var view_type = function( vals ){
	$('#view_type').val(vals);
	$('#albaSearchFrm').submit();
}

var list_sorting = function( vals){	// 출력순서
	var sel = vals.value;
	location.href = "./alba_search.php?" + send_url + "&sort=" + sel + "#result";
}
var list_rows = function( vals ){	// 출력건수
	var sel = vals.value;
	location.href = "./alba_search.php?" + send_url + "&page_rows=" + sel + "#result";
}
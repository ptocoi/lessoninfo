/*
* /application/alba/skins/default/alba_list_type.skin.js
* @author Harimao
* @since 2013/11/18
* @last update 2013/11/26
* @Module v3.5 ( Alice )
* @Brief :: Alba list type script
* @Comment :: 정규직 직종별 검색 스크립트 / 함수
*/
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

	// 검색어 필드 엔터 이벤트
	$('#alba_search_keyword').keydown(function(event){
		if(event.keyCode==13){	
			searchFrm_submit();
			return false;
		}
	});

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


var search_limit = 4;
var $category_0 = $("#"+search_mode+"_0");	 // 1차 (최상위) 카테고리 hidden input
var category_top = [];
var category_middle = [];
var category_sub = [];
var category_tops = function( code ){	// 1차 (최상위) 카테고리 선택
	var $category_top = $('#category_top_'+code);	// 1차 카테고리

	$('.tabMenu > li').removeClass('on');
	$category_top.addClass('on');	 // 1차 선택 카테고리

	$('#category_top_val').val(code);

	if(mode=='search'){	// 검색일때

		if( $('#category_middle_'+code).length ){

			$('.category_middle, .category_sub').hide();
			$('#category_middle_'+code).show();

			$('.'+search_mode+'_1_'+code).each(function(){
				var is_checked = $(this).is(':checked');
				if(is_checked == true){
					var sub_code = $(this).val();
					$('.category_sub_'+sub_code).show();
				}
			});

		} else {

			$.ajax({
				async : false,
				cache : true,
				url : "./views/_load/category.php",
				data : { mode:search_mode, type:'second', code:code },
				dataType : 'html',
				success : function(result){

					$('.category_middle').hide();
					if( $('#category_middle_'+code).length ){
						$('#category_middle_'+code).show();
					} else {
						$('#category_second').append(result);
					}

				}, 
				error : function(result, status, err){
					alert(status+"\n"+err);
				}
			});

		}

	} else {	 // 일반일때

		$.ajax({
			async : false,
			cache : true,
			url : "./views/_load/category.php",
			data : { mode:search_mode, type:'second', code:code },
			dataType : 'html',
			success : function(result){

				$('.category_middle').hide();
				if( $('#category_middle_'+code).length ){
					$('#category_middle_'+code).show();
				} else {
					$('#category_second').append(result);
				}

			}, 
			error : function(result, status, err){
				alert(status+"\n"+err);
			}
		});

	}

	//alert( search_mode +"@@" + code );

}
var category_middles = function( vals, p_code ){	// 2차 카테고리 선택
	var code = vals.value;
	var checked = vals.checked;

	var category_top_length = category_top.length;	// 1차 카테고리 선택값 배열
	var category_middle_length = category_middle.length;	// 2차 카테고리 선택값 배열
	var category_middle_check_length = $("."+search_mode+"_1_"+p_code+":checked").length;	// 2차 카테고리 체크 카운팅
	var category_sub_length = category_sub.length;	// 3차 카테고리 선택값 배열
	var category_sub_check_length = $("."+search_mode+"_2_"+code+":checked").length;	// 3차 카테고리 체크 카운팅


	if(checked == true){	// 2차 카테고리 checked true

		if( $('.category').length > search_limit ){
			alert(search_title + "검색 조건은 최대 5가지 입니다.");
			$("#"+search_mode+"_1_"+code).attr('checked',false);
			return false;
		}

		$("#category_top_"+p_code).addClass('check');	// 1차 카테고리 check 클래스 적용

		// 1차 카테고리 배열 입력
		if(category_top_length){
			for(i=0;i<category_top_length;i++){
				if( category_top[i] == p_code){	// 기존에 1차 카테고리에 동일한 값이 있다면 제거
					category_top.splice(i,1);
				}
			}
			category_top.push(p_code);
		} else {
			category_top.push(p_code);
		}

		category_middle.push(code);	// 2차 카테고리 배열 입력

		// 3차 출력
		$.ajax({
			async : false,
			cache : true,
			url : "./views/_load/category.php",
			data : { mode:search_mode, type:'third', code:code },
			dataType : 'html',
			success : function(result){
			
				//$('.category_sub').hide();
				if( $('#category_sub_'+code).length ){
					$('#category_sub_'+code).show();
				} else {
					$('#category_third_'+p_code).append(result);
				}

			}, 
			error : function(result, status, err){
				alert(status+"\n"+err);
			}
		});

		// 검색 조건
		var first_text = $('#category_top_'+p_code+' a').text();	 // 1차 지역값 명칭
		var second_text = $('#category_middle_list_'+code+' label').text();	// 2차 지역값 명칭

		var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" category\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('category','"+search_mode+"','"+p_code+"','"+code+"');\">x</button></li>";
		
		$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
		$('.selectList').append("<input type=\"hidden\" name=\""+search_mode+"_sels[]\" value=\""+p_code+"/"+code+"\" id=\""+search_mode+"_sels_"+p_code+"_"+code+"\" class=\""+search_mode+"_sels_"+p_code+"\" />");

		$('.noSelect').hide();
		$('.selectBox').show();

	} else {	 // 2차 카테고리 checked false

		// 2차 값 배열 제거
		for(i=0;i<category_middle_length;i++){
			if(category_middle[i] == code){
				category_middle.splice(i,1);
			}
		}

		var p_code_length = $('.'+search_mode+'_1_'+p_code+':checked').length;
		if(p_code_length == 0){	// 선택한 2차 카테고리가 없을때
			$("#category_top_"+p_code).removeClass('check');	// 1차 카테고리 check 클래스 해제
		}

		$('#category_sub_'+code).remove();	// 3차 카테고리 목록 제거

		// 검색 조건
		$("#select_"+p_code+"_"+code+", .select_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제
		$("#"+search_mode+"_sels_"+p_code+'_'+code).remove();

	}

	$("#category_top_val").val(category_top);	// 1차 선택 카테고리 값 저장
	$("#category_middle_val").val(category_middle);	// 2차 선택 카테고리 값 저장

	//alert(category_top+"\n\n"+category_middle+"\n\n"+category_sub);

}
var category_subs = function( vals, p_code, first_code ){	// 3차 카테고리 선택
	var code = vals.value;
	var checked = vals.checked;

	var category_sub_length = category_sub.length;	// 3차 카테고리 선택값 배열
	var category_sub_check_length = $("."+search_mode+"_2_"+p_code+":checked").length;	// 3차 카테고리 체크 카운팅

	var first_text = $('#category_top_'+first_code+' a').text();	 // 1차 지역값 명칭
	var second_text = $('#category_middle_list_'+p_code+' label').text();	// 2차 지역값 명칭
	var third_text = $('#category_sub_list_'+code+' label').text();	// 2차 지역값 명칭

	if( checked == true ){

		if( $('.category').length > search_limit ){
			alert(search_title + "검색 조건은 최대 5가지 입니다.");
			$("#"+search_mode+"_2_"+code).attr('checked',false);
			return false;
		}

		for(i=0;i<category_sub_check_length;i++){
			if( category_sub[i] == code ){
				category_sub.splice(i,1);
			}
		}

		category_sub.push(code);	// 3차 카테고리 배열 입력

		// 검색 조건
		$("#select_"+first_code+"_"+p_code).remove();	 // 우선 기존 1,2차 지역 선택값을 삭제하고
		var append_list = "<li id=\"select_"+first_code+"_"+p_code+"_"+code+"\" class=\"select_"+first_code+"_"+p_code+" select_"+first_code+" category\">"+first_text+" > "+second_text+" > "+third_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('category','"+search_mode+"','"+first_code+"','"+p_code+"','"+code+"');\">x</button></li>";
		$('.selectList').append(append_list);	// 1차 + 2차 + 3차 지역값을 합쳐서 추가
		$("#"+search_mode+"_sels_"+first_code+"_"+p_code).remove();
		$('.selectList').append("<input type=\"hidden\" name=\""+search_mode+"_sels[]\" value=\""+first_code+"/"+p_code+"/"+code+"\" id=\""+search_mode+"_sels_"+first_code+"_"+p_code+"_"+code+"\" class=\""+search_mode+"_sels_"+first_code+"_"+p_code+"\" />");

	} else {

		for(i=0;i<category_sub_length;i++){
			if( category_sub[i] == code ){	 // 기존 3차 카테고리에 동일한 값이 있다면 제거
				category_sub.splice(i,1);
			}
		}

		// 검색 조건
		$("#select_"+first_code+"_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제
		$("#"+search_mode+"_sels_"+first_code+'_'+p_code+'_'+code).remove();

	}

	$("#category_top_val").val(category_top);	// 1차 선택 카테고리 값 저장
	$("#category_middle_val").val(category_middle);	// 2차 선택 카테고리 값 저장
	$("#category_sub_val").val(category_sub);	// 3차 선택 카테고리 값 저장

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
// 기본 역세권 검색
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


var search_close = function( category, type, first_code, second_code, third_code ){	// 선택된 조건 없애기

	//alert( category+" @ "+type+" @ "+first_code+" @ "+second_code+" @ "+third_code );
	
	// 3차 부터 거꾸로 작업~
	if( third_code ){

		if(category){
		
			$('#'+type+'_2_'+third_code).attr('checked',false);
			var second_checked_length = $("input[name='"+type+"_1["+first_code+"][]']:checked").length;
			var third_checked_length = $("input[name='"+type+"_2["+first_code+"]["+second_code+"][]']:checked").length;

			if(third_checked_length == 0){	// 3차 카테고리 체크값이 하나도 없으면
				$('#'+type+'_1_'+second_code).attr('checked',false);
				$('#'+category+'_sub_'+second_code).hide()
				if(second_checked_length <= 1){	// 2차 카테고리 체크값이 하나도 없으면
					$('#'+type+'_0_'+first_code).attr('checked',false);
				}
			}
			$('#select_'+first_code+'_'+second_code+'_'+third_code).remove();	// 선택 조건 없애기
			$('#'+type+'_sels_'+first_code+'_'+second_code+'_'+third_code).remove();

		} else {

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

		}

	} else if( second_code ){

		if(category){

			$('#'+type+'_1_'+second_code).attr('checked',false);

			var second_checked_length = $("input[name='"+type+"_1["+first_code+"][]']:checked").length;

			if(second_checked_length == 0 ){	// 2차 카테고리 체크값이 하나도 없으면
				$('#'+type+'_0_'+first_code).attr('checked',false);
				$('#'+category+'_middle_'+first_code).hide()
			}

			$('#select_'+first_code+'_'+second_code).remove();	// 선택 조건 없애기
			$('#'+type+'_sels_'+first_code+'_'+second_code).remove();

		} else {

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
			$('#'+type+'_sels_'+first_code+'_'+second_code).remove();

		}

	} else if( first_code ){

		if(category){

			$('#'+type+'_0_'+first_code).attr('checked',false);
			$('#'+type+'_top_'+first_code+' > span').removeClass('checkOn');
			$('#'+type+'_second_'+first_code).hide();	// 2차 카테고리 감추기

			$('#select_'+first_code).remove();	// 선택 조건 없애기
			$('#'+type+'_sels_'+first_code).remove();

		} else {

			$('#wr_'+type+'_0_'+first_code).attr('checked',false);
			$('#'+type+'_top_'+first_code+' > span').removeClass('checkOn');
			$('#'+type+'_second_'+first_code).hide();	// 2차 카테고리 감추기

			$('#select_'+first_code).remove();	// 선택 조건 없애기
			$('#'+type+'_sels_'+first_code).remove();

		}

	}

	var checked_length = $("input[name='"+search_mode+"_1["+first_code+"][]']:checked").length;
	
	if(checked_length == 0){	// 체크 갯수가 없다면
		$("#category_top_"+first_code).removeClass('check');
	}

	if( $(".selectList > li").length == 0 ){
		$('.noSelect').show();
		$('.selectBox').hide();
	}

}

var wr_date_sel = function( vals ){	// 근무기간
	var sel = vals.value;
	var text = $('#wr_date :selected').text();

	if(sel!=''){
		var append_list = "<li id=\"select_"+sel+"\" class=\"wr_date\">"+text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('wr_date','"+sel+"');\">x</button></li>";
		$('.selectList').append(append_list);
		$('.selectList').append("<input type=\"hidden\" name=\"date_sels[]\" value=\""+sel+"\" id=\"date_sels_"+sel+"\"/>");
		$('.noSelect').hide();
		$('.selectBox').show();
	} else {
		$(".wr_date").remove();
		$("input[name='date_sels[]']").remove();
	}

}
var wr_week_sel = function( vals ){	 // 근무요일
	var sel = vals.value;
	var text = $('#wr_week :selected').text();

	if(sel!=''){
		var append_list = "<li id=\"select_"+sel+"\" class=\"wr_week\">"+text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('wr_week','"+sel+"');\">x</button></li>";
		$('.selectList').append(append_list);
		$('.selectList').append("<input type=\"hidden\" name=\"week_sels[]\" value=\""+sel+"\" id=\"week_sels_"+sel+"\"/>");
		$('.noSelect').hide();
		$('.selectBox').show();
	} else {
		$(".wr_date").remove();
		$("input[name='week_sels[]']").remove();
	}
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

var career_sel = function( vals ){	// 경력사항 선택
	var sel = vals.value;
	if(sel=='2'){
		$('#wr_career').attr('required',true);
		$('#wr_career_display').show();
	} else {
		$('#wr_career').attr('required',false);
		$('#wr_career :eq(0)').attr('selected',true);
		$('#wr_career_display').hide();
	}
}
var age_sel = function( vals ){	// 연령 제한 선택
	var sel = vals.value;
	if(sel=='1'){
		$('.wr_age').attr('required',true);
		$('#wr_age_display').show();
	} else {
		$('.wr_age').val('');
		$('.wr_age').attr('required',false);
		$('#wr_age_display').hide();
	}
}

var searchFrm_submit = function(){	 // 검색 시~작!
	
	$('#albaSearchFrm').submit();

}
var searchFrm_reset = function(){	// 초기화

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

var view_types = function( type ){	// 일반 리스트 뷰타입

	if(type=='gallery'){
		$('#list_view').hide();
		$('#gallery_view').show();
		$('#choiceLink_list').attr('src','../images/icon/icon_choiceLink1_off.gif');
		$('#choiceLink_gallery').attr('src','../images/icon/icon_choiceLink2_on.gif');
	} else {
		$('#list_view').show();
		$('#gallery_view').hide();
		$('#choiceLink_list').attr('src','../images/icon/icon_choiceLink1_on.gif');
		$('#choiceLink_gallery').attr('src','../images/icon/icon_choiceLink2_off.gif');
	}

}

var online_becomes = function( no, requisition ){	// 온라인 입사지원

	var requisitions = requisition.split(',');

	if(mb_type=='company'){
		alert("입사지원은 개인회원만 가능합니다.");
		return;
	}

	alert( no+"@"+requisition+"@@"+requisitions );

}

var list_sorting = function( vals, page ){	// 출력순서
	var sel = vals.value;
	location.href = "./" + page + ".php?" + send_url + "&sort=" + sel + "#result";
}
var list_rows = function( vals, page ){	// 출력건수
	var sel = vals.value;
	location.href = "./" + page + ".php?" + send_url + "&page_rows=" + sel + "#result";
}
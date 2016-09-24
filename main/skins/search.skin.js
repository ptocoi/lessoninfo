$(function(){

});

var totalSearchFrm_submit = function(){	// 재검색 폼 전송
	$('#totalSearchFrm').submit();
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

	if( checked == true ){	// 체크했다면

		if( $('.area').length >= area_search_limit ){
			alert("근무지역 검색 조건은 최대 5가지 입니다.");
			$('#wr_area_0_'+code).attr('checked',false);
			return false;
		}

		$('#area_top_'+code+' > span').addClass('checkOn');
		$('#area_second_'+code).show();	// 2차 지역 출력

		// 검색 조건
		var append_list = "<li id=\"select_"+code+"\" class=\"area\">"+text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+code+"');\">x</button></li>";
		$('.selectList').append(append_list);
		$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+code+"\" id=\"area_sels_"+code+"\"/>");

		$('.noSelect').hide();
		$('.selectBox').show();

		for(i=0;i<area_first_length;i++){
			if( area_first[i] == code ){	// 기존에 동일한 값이 있다면 제거
				area_first.splice(i,1);
			}
		}
		area_first.push(code);

	} else { // 체크를 껐다면

		$('#area_top_'+code+' > span, .area_middle_'+code+' > span').removeClass('checkOn');
		$('.'+code).attr('checked',false);
		$('.area_third_'+code).hide();
		$('#area_second_'+code).hide();

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

	}
	
}
var area_seconds = function( vals, p_code ){	// 2차 지역 검색 선택
	var code = vals.value;
	var checked = vals.checked;
	var first_text = $('#area_top_'+p_code+' label').text();	 // 1차 지역값 명칭
	var second_text = $('#area_middle_'+code+' label').text();	// 2차 지역값 명칭

	var first_length = $("#select_"+p_code).length;	 // 1차 지역 선택값 수

	if( checked == true ){	// 체크했다면

		if( $('.area').length >= area_search_limit ){
			alert("근무지역 검색 조건은 최대 5가지 입니다.");
			$('#wr_area_1_'+code).attr('checked',false);
			return false;
		}

		$('#area_middle_'+code+' > span').addClass('checkOn');
		$('#area_third_'+code).show();
		
		// 검색 조건
		//if( $.inArray(code, area_second) < 0 ){	// 2차 선택 배열에 없다면
			area_second.push(code);	// 2차 선택 배열에 값 입력
			$("#select_"+p_code).remove();	 // 우선 기존 1차 지역 선택값을 삭제하고
			var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" area\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+p_code+"','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#area_sels_'+p_code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"/"+code+"\" id=\"area_sels_"+p_code+"_"+code+"\"/>");
		//}

	} else {	 // 체크를 껐다면

		$('#area_middle_'+code+' > span').removeClass('checkOn');
		$('.'+p_code+'_'+code).attr('checked',false);
		$('#area_third_'+code).hide();

		// 검색 조건
		$("#select_"+p_code+"_"+code+", .select_"+p_code+"_"+code).remove();	 // 1차 지역 선택값 삭제
		$('#area_sels_'+p_code+'_'+code).remove();

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
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"\" id=\"area_sels_"+p_code+"\"/>");
		}

	}

}
var area_thirds = function( vals, p_code, first_code ){	// 3차 지역 검색 선택 third code, second code, first code
	var code = vals.value;	// 개포동 //var p_code = 강남구; //var first_code = 서울; 이렇듯 거꾸로 간다
	var checked = vals.checked;

	var first_text = $('#area_top_'+first_code+' label').text();	 // 1차 지역값 명칭
	var second_text = $('#area_middle_'+p_code+' label').text();	 // 2차 지역값 명칭
	var third_text = $('#area_sub_'+code+' label').text();	 // 3차 지역값 명칭

	if( checked == true ){	// 체크했다면

		if( $('.area').length >= area_search_limit ){
			alert("근무지역 검색 조건은 최대 5가지 입니다.");
			$('#wr_area_2_'+code).attr('checked',false);
			return false;
		}

		// 검색 조건
		area_third.push(code);
		$("#select_"+first_code+"_"+p_code).remove();	 // 우선 기존 1,2차 지역 선택값을 삭제하고
		var append_list = "<li id=\"select_"+first_code+"_"+p_code+"_"+code+"\" class=\"select_"+first_code+"_"+p_code+" select_"+first_code+" area\">"+first_text+" > "+second_text+" > "+third_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+first_code+"','"+p_code+"','"+code+"');\">x</button></li>";
		$('.selectList').append(append_list);	// 1차 + 2차 + 3차 지역값을 합쳐서 추가
		$('#area_sels_'+first_code+"_"+p_code).remove();
		$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"/"+p_code+"/"+code+"\" id=\"area_sels_"+first_code+"_"+p_code+"_"+code+"\"/>");

	} else {	 // 체크를 껐다면

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
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"/"+p_code+"\" id=\"area_sels_"+first_code+"_"+p_code+"\"/>");
		}

	}

}
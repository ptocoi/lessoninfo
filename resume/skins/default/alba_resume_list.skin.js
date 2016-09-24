$(function(){

	var colour;
	setInterval(function(){
		colour = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);	
		$('.jumble').animate({
			color: colour
		});
	}, 500);

});

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
	var second_text = $('#area_middle_'+code+' label').text();	// 2차 지역값 명칭

	var first_length = $("#select_"+p_code).length;	 // 1차 지역 선택값 수

	if( checked == true ){	// 체크했다면

		if( $('.area').length >= area_search_limit ){
			alert("근무지역 검색 조건은 최대 5가지 입니다.");
			$('#wr_area_1_'+code).attr('checked',false);
			return false;
		}

		/*
		$.post('./views/_load/area.php', { mode:'default', type:'third_area', first_area:p_code, second_area:code }, function(result){
			$('#area_third_'+p_code).append(result);	// 전체가 아닐때만
			area_second.push(code);	// 2차 선택 배열에 값 입력
			$("#select_"+p_code).remove();	 // 우선 기존 1차 지역 선택값을 삭제하고
			var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" area\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+p_code+"','"+code+"');\">x</button></li>";
			$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
			$('#area_sels_'+p_code).remove();
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"/"+code+"\" id=\"area_sels_"+p_code+"_"+code+"\" class=\"area_sel_"+p_code+"\" />");
		});
		*/

		area_second.push(code);	// 2차 선택 배열에 값 입력
		$("#select_"+p_code).remove();	 // 우선 기존 1차 지역 선택값을 삭제하고
		var append_list = "<li id=\"select_"+p_code+"_"+code+"\" class=\"select_"+p_code+" area\">"+first_text+" > "+second_text+"&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','"+p_code+"','"+code+"');\">x</button></li>";
		$('.selectList').append(append_list);	// 1차 + 2차 지역값을 합쳐서 추가
		$('#area_sels_'+p_code).remove();
		$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"/"+code+"\" id=\"area_sels_"+p_code+"_"+code+"\" class=\"area_sel_"+p_code+"\" />");

		//alert( $('.area').length );

	} else {	 // 체크를 껐다면

		$('#area_third_'+code).remove();

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
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+p_code+"\" id=\"area_sels_"+p_code+"\" class=\"area_sel_"+p_code+"\" />");
		}

		//alert( $('.area').length );

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
		$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"/"+p_code+"/"+code+"\" id=\"area_sels_"+first_code+"_"+p_code+"_"+code+"\" class=\"area_sel_"+first_code+"_"+p_code+"\" />");

		//alert( $('.area').length );

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
			$('.selectList').append("<input type=\"hidden\" name=\"area_sels[]\" value=\""+first_code+"/"+p_code+"\" id=\"area_sels_"+first_code+"_"+p_code+"\" class=\"area_sel_"+first_code+"_"+p_code+"\" />");
		}

		//alert( $('.area').length );

	}

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

var searchFrm_submit = function(){	 // 검색 시~작!
	
	$('#resumeSearchFrm').submit();

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

var list_rows = function( vals, page ){	// 출력건수
	var sel = vals.value;
	location.href = "./" + page + ".php?" + send_url + "&page_rows=" + sel + "#result";
}

var resume_scrap = function( no ){	 // 이력서 스크랩

	if(mb_type=='individual'){
		alert("이력서 스크랩은 기업회원만 가능합니다.");
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

var career_sel = function( vals ){	// 경력사항 선택
	var sel = vals.value;
	if(sel=='2'){
		//$('#wr_career').attr('required',true);
		$('#wr_career_display').show();
	} else {
		//$('#wr_career').attr('required',false);
		$('#wr_career :eq(0)').attr('selected',true);
		$('#wr_career_display').hide();
	}
}

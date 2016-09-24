$(function(){
	$('.closeBtn, .close').click(function(){	// 우편번호 검색창 닫기
		$('#postSearchPop').hide();
		$('#new_postSearchPop').hide();
	});
	$('#postSearchPop').draggable({	 // 우편번호 검색창 드래그
		handle: '#postSearchPop_handle'
	});
	$('#postSearchKeyword').keydown(function(event){	// 우편번호 검색창 엔터키 이벤트
		if(event.keyCode==13){	
			postSearchs('company');
			return false;
		}
	});
	$('#new_postSearchKeyword').keydown(function(event){	// 도로명 검색창 엔터키 이벤트
		if(event.keyCode==13){	
			new_postSearchs();
			return false;
		}
	});

	var new_address = $("input[name='new_address']:checked").val();
	if(new_address=='1'){
		$('#new_mb_zipcode0').attr('required');
		$('#new_mb_zipcode1').attr('required');
		$('#mb_zipcode0').removeAttr('required');
		$('#mb_zipcode1').removeAttr('required');
		$('#new_mb_address0').attr('required');
		$('#new_mb_address1').attr('required');
		$('#mb_address0').removeAttr('required');
		$('#mb_address1').removeAttr('required');
	} else {
		$('#new_mb_zipcode0').removeAttr('required');
		$('#new_mb_zipcode1').removeAttr('required');
		$('#mb_zipcode0').attr('required');
		$('#mb_zipcode1').attr('required');
		$('#new_mb_address0').removeAttr('required');
		$('#new_mb_address1').removeAttr('required');
		$('#mb_address0').attr('required');
		$('#mb_address1').attr('required');
	}

});
var postSearchPops = function(mb_type){	// 우편번호 검색창 띄우기
	
	var mode = 'zipcode_'+mb_type;
	$('#zipcode_info').load('../member/views/_load/layer.php', { mode:mode, mb_type:mb_type, map_color:map_color }, function(result){
		/*
		$('.postSearchPop').css({
			'top' : '0'
		});
		*/
		$('.closeBtn, .close').click(function(){	// 우편번호 검색창 닫기
			$('#postSearchPop').hide();
		});

		$('#postSearchPop').show();
		$('#postSearchKeyword').focus();
		$('#postSearchPop').draggable({ handle: "#postSearchPop_handle" });
		if(mb_type=='company') {
			var insert_mode = $('#MemberFrm #mode').val();

			if(use_map=='daum') zoom = '4';
			else if(use_map=='naver') zoom = '10';
			else if(use_map=='google') zoom = '18';

			map_api.map_use("mapContainer", "", true);	// 지도 띄우기
			if(use_map=='daum'){
				if(insert_mode=='insert'){
					var mb_latlng = ['37.537123', '127.005523'];
				} else {
					var mb_latlng = $('#mb_latlng').val().split(',');
				}
				map_api.register_map_location_move(mb_latlng[0],mb_latlng[1]);	// 좌표값 할당
			} else if(use_map=='naver'){
				if(insert_mode=='insert'){
					var mb_latlng = ['37.5010226', '127.0396037'];
				} else {
					var mb_latlng = $('#mb_latlng').val().split(',');
				}
				map_api.map_location_move(mb_latlng[1],mb_latlng[0]);
				map_api.marker_false();
				map_api.addMark();
				map_api.click_event();
				$('#mb_latlng').val(mb_latlng[0]+","+mb_latlng[1]);	// 좌표값 할당
			} else if(use_map=='google'){
				if(insert_mode=='insert'){
					var mb_latlng = ['37.5010226', '127.0396037'];
				} else {
					var mb_latlng = $('#mb_latlng').val().split(',');
				}
				$('#mb_latlng').val(mb_latlng[0]+","+mb_latlng[1]);
				map_api.map_point = [mb_latlng[0],mb_latlng[1],zoom];
				map_api.map_use("mapContainer", "", true);
				map_api.click_event();
				map_api.addMark();
			}
		}
		$('#postSearchKeyword').keydown(function(event){	// 우편번호 검색창 엔터키 이벤트
			if(event.keyCode==13){	
				postSearchs(mb_type);
				return false;
			}
		});
	});
}
var new_postSearchPops = function( mb_type ){
	is_new_post = true;

	var mode = 'zipcode_'+mb_type;
	$('#zipcode_info').load('../member/views/_load/layer.php', { mode:mode, type:'new', mb_type:mb_type, map_color:map_color }, function(result){
		$('.closeBtn, .close').click(function(){	// 우편번호 검색창 닫기
			$('#new_postSearchPop').hide();
		});

		$('#new_postSearchPop').show();
		$('#new_postSearchKeyword').focus();
		$('#new_postSearchPop').draggable({ handle: "#new_postSearchPop_handle" });
		if(mb_type=='company') {
			var insert_mode = $('#MemberFrm #mode').val();

			if(use_map=='daum') zoom = '4';
			else if(use_map=='naver') zoom = '10';
			else if(use_map=='google') zoom = '18';

			map_api.map_use("new_mapContainer", "", true);	// 지도 띄우기
			if(use_map=='daum'){
				if(insert_mode=='insert'){
					var mb_latlng = ['37.537123', '127.005523'];
				} else {
					var mb_latlng = $('#mb_latlng').val().split(',');
				}
				map_api.register_map_location_move(mb_latlng[0],mb_latlng[1]);	// 좌표값 할당
			} else if(use_map=='naver'){
				if(insert_mode=='insert'){
					var mb_latlng = ['37.5010226', '127.0396037'];
				} else {
					var mb_latlng = $('#mb_latlng').val().split(',');
				}
				map_api.map_location_move(mb_latlng[1],mb_latlng[0]);
				map_api.marker_false();
				map_api.addMark();
				map_api.click_event();
				$('#mb_latlng').val(mb_latlng[0]+","+mb_latlng[1]);	// 좌표값 할당
			} else if(use_map=='google'){
				if(insert_mode=='insert'){
					var mb_latlng = ['37.5010226', '127.0396037'];
				} else {
					var mb_latlng = $('#mb_latlng').val().split(',');
				}
				$('#mb_latlng').val(mb_latlng[0]+","+mb_latlng[1]);
				map_api.map_point = [mb_latlng[0],mb_latlng[1],zoom];
				map_api.map_use("new_mapContainer", "", true);
				map_api.click_event();
				map_api.addMark();
			}
		}
		$('#new_postSearchKeyword').keydown(function(event){	// 우편번호 검색창 엔터키 이벤트
			if(event.keyCode==13){	
				new_postSearchs(mb_type);
				return false;
			}
		});
	});

}

var postSearchs = function(mb_type){
	var keyword = $('#postSearchKeyword').val();
	if(!keyword || keyword==''){
		alert("동명을 입력해 주세요.");
		$('#postSearchKeyword').focus();
		return false;
	} else {
		$.post('../member/views/_ajax/post_search.php', { mode:mb_type, keyword:keyword }, function(result){
			$('#post_List').html("");
			var data = eval("(" + result + ")");
			if(data.list!=''){
				$.each(data.list, function(key,lists){
					zipcode = lists.ZIPCODE.split('-');
					sido = lists.SIDO;
					gugun = lists.GUGUN;
					dong = lists.DONG;
					ri = lists.RI;
					bunji = lists.BUNJI;
					doseo = (lists.DOSEO) ? "(도서지역)" : "";
					bldg_name = lists.BLDG;
					bldg = (bldg_name) ? " " + bldg_name : "";	// 건물명

					if(mb_type=='individual'){	// 개인회원 우편번호 검색 결과
						$('#post_List').append("<tr><td>"+lists.ZIPCODE+"</td><td class=\"address_list brend\"><a href=\"javascript:addPost('"+lists.ZIPCODE+"','"+sido+"','"+gugun+"','"+dong+"','"+ri+"','"+bunji+"', '"+bldg_name+"');\">"+lists.ADDRESS+"</a></td></tr>");
					} else if(mb_type=='company'){	// 기업회원 우편번호 검색 결과
						$('#post_List').append("<tr><td>"+lists.ZIPCODE+"</td><td class=\"address_list brend\"><a href=\"javascript:addPost_position('"+lists.ZIPCODE+"','"+sido+"','"+gugun+"','"+dong+"','"+ri+"','"+bunji+"', '"+bldg_name+"');\">"+lists.ADDRESS+"</a></td></tr>");
					}
				});

			} else {
				$('#post_List').html("<tr><td colspan=\"2\" style=\"text-align:center;height:165px;\">검색 결과가 없습니다.</td></tr>");
			}
		});

	}
}
var new_postSearchs = function(){
	var keyword = $('#new_postSearchKeyword').val();
	if(!keyword || keyword==''){
		alert("동명을 입력해 주세요.");
		$('#new_postSearchKeyword').focus();
		return false;
	} else {
		$.post('../member/views/_ajax/post_search.php', { mode:mb_type, type:'new', keyword:keyword }, function(result){
			$('#new_post_List').html("");
			var data = eval("(" + result + ")");
			if(data.list!=''){
				$.each(data.list, function(key,lists){
					zipcode = lists.zipcode;
					sido = lists.sido;
					sigungu = lists.sigungu;
					upmyon = lists.upmyon;
					road_name = lists.road_name;
					bdno_M = lists.bdno_M;
					mass_delevery = lists.mass_delevery;

					law_dong_name = lists.law_dong_name;
					ri = lists.ri;
					jibun_M = lists.jibun_M;

					if(mb_type=='individual'){
						var post_list = "<tr>";
						post_list += "<td>"+zipcode+"</td>";
						post_list += "<td><a href=\"javascript:new_addPost('"+zipcode+"','"+sido+"','"+sigungu+"','"+upmyon+"','"+road_name+"','"+bdno_M+"','"+mass_delevery+"','"+law_dong_name+"','"+ri+"','"+jibun_M+"');\">"+sido+" "+sigungu+" "+upmyon+" "+road_name+" "+bdno_M+" "+mass_delevery+"</a></td>";
						post_list += "<td>"+law_dong_name+" "+ri+" "+jibun_M+"</td>";
						post_list += "</tr>";
						$('#new_post_List').append(post_list);
					} else {
						var post_list = "<tr>";
						post_list += "<td>"+zipcode+"</td>";
						post_list += "<td><a href=\"javascript:new_addPost_position('"+zipcode+"','"+sido+"','"+sigungu+"','"+upmyon+"','"+road_name+"','"+bdno_M+"','"+mass_delevery+"','"+law_dong_name+"','"+ri+"','"+jibun_M+"');\">"+sido+" "+sigungu+" "+upmyon+" "+road_name+" "+bdno_M+" "+mass_delevery+"</a></td>";
						post_list += "<td>"+law_dong_name+" "+ri+" "+jibun_M+"</td>";
						post_list += "</tr>";
						$('#new_post_List').append(post_list);
					}

					//alert(zipcode+" "+sido+" "+sigungu+" "+upmyon+" "+road_name+" "+bdno_M+" "+mass_delevery+" "+law_dong_name+" "+ri+" "+jibun_M);
					//return false;
				});
			} else {
				$('#new_post_List').html("<tr><td colspan=\"3\" style=\"text-align:center;height:165px;\">검색 결과가 없습니다.</td></tr>");
			}
		});

	}
}

var addPost = function( zipcode, sido, gugun, dong, ri, bunji, bldg ){	// 우편번호 적용
	// 우편번호
	var zipcodes = zipcode.split('-');
	$('#mb_zipcode0').val(zipcodes[0]);
	$('#mb_zipcode1').val(zipcodes[1]);
	// 기본주소
	ris = (ri) ? ' ' + ri : '';	// 리가 없는 경우 공백이 들어올수 없다
	bunjis = (bunji) ? ' ' + bunji : '';	// 번지가 없는 경우 공백이 들어올수 없다
	$('#mb_address0').val(sido+' '+gugun+' '+dong+ris+bunjis+' '+bldg);
	$('#postSearchPop').hide();
	$('#mb_address1').focus();
}
var addPost = function( zipcode, sido, gugun, dong, ri, bunji, bldg ){	// 우편번호 적용
	// 우편번호
	var zipcodes = zipcode.split('-');
	$('#mb_zipcode0').val(zipcodes[0]);
	$('#mb_zipcode1').val(zipcodes[1]);
	// 기본주소
	ris = (ri) ? ' ' + ri : '';	// 리가 없는 경우 공백이 들어올수 없다
	bunjis = (bunji) ? ' ' + bunji : '';	// 번지가 없는 경우 공백이 들어올수 없다
	$('#mb_address0').val(sido+' '+gugun+' '+dong+ris+bunjis+' '+bldg);
	$('#postSearchPop').hide();
	$('#mb_address1').focus();
}
var addPost_position = function( zipcode, sido, gugun, dong, ri, bunji, bldg ){	// 우편번호 적용 후 지도 이동
	// 우편번호
	var zipcodes = zipcode.split('-');
	$('#mb_zipcode0').val(zipcodes[0]);
	$('#mb_zipcode1').val(zipcodes[1]);
	// 기본주소
	ris = (ri) ? ' ' + ri : '';	// 리가 없는 경우 공백이 들어올수 없다
	bunjis = (bunji) ? ' ' + bunji : '';	// 번지가 없는 경우 공백이 들어올수 없다
	$('#mb_address0').val(sido+' '+gugun+' '+dong+ris+bunjis+' '+bldg);

	if(use_map=='daum'){	// 다음
		daum_addrSearch(sido+' '+gugun+' '+dong);
	} else if(use_map=='naver'){	// 네이버
		bunji_split = (ris+bunjis).split('~');
		//sido+' '+gugun+' '+dong+ris+bunjis+' ';
		naver_addrSearch(sido+' '+gugun+' '+dong+ris+bunjis);
	} else if(use_map=='google'){	// 구글
		google_addrSearch(sido+' '+gugun+' '+dong+ris+bunjis);
	}

}
var new_addPost_position = function( zipcode, sido, sigungu, upmyon, road_name, bdno_M, mass_delevery, law_dong_name, ri, jibun_M  ){	// 도로명 우편번호 적용
	// 우편번호
	var zipcodes = zipcode.split('-');
	$('#new_mb_zipcode0').val(zipcodes[0]);
	$('#new_mb_zipcode1').val(zipcodes[1]);

	// 기본주소
	var add_address = sido + " ";
	add_address += sigungu + " ";
	add_address += (upmyon) ? upmyon + " " : "";
	add_address += road_name + " ";
	add_address += bdno_M + " ";
	add_address += (mass_delevery) ? mass_delevery : "";

	var add_address1 = (law_dong_name) ? law_dong_name + " " : "";
	add_address1 += (ri) ? ri + " " : "";
	add_address1 += (jibun_M) ? jibun_M : "";

	$('#new_mb_address0').val( add_address + "("+add_address1+")");

	if(use_map=='daum'){	// 다음
		daum_addrSearch(add_address);
	} else if(use_map=='naver'){	// 네이버
		naver_addrSearch(add_address);
	} else if(use_map=='google'){	// 구글
		google_addrSearch(add_address);
	}

}
var daum_addrSearch = function( search_addr ){	// 다음 지도 api 주소 검색
	var s = document.createElement('script');
	s.type ='text/javascript';
	s.charset ='utf-8';
	s.src = 'http://apis.daum.net/local/geo/addr2coord?apikey=' + daum_local_APIKEY + '&output=json&callback=daumSearchResult&q=' + encodeURI(search_addr);
	document.getElementsByTagName('head')[0].appendChild(s);
}
var daumSearchResult = function( result ){	// 다음 지도 api 주소 검색 결과
	var point_y = result.channel.item[0].point_y;
	var point_x = result.channel.item[0].point_x;
	map_api.register_map_location_move(point_y,point_x);	// 좌표값 할당
}
var naver_addrSearch = function( search_addr ){	 // 네이버 지도 api 주소 검색 결과
	$.post('../member/views/_ajax/post_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
		var data = eval("(" + result + ")");
		var point_y = data.mapy;
		var point_x = data.mapx;
		map_api.map_location_move(point_x,point_y);
		map_api.marker_false();
		map_api.addMark();
		map_api.click_event();
		$('#mb_latlng').val(point_y+","+point_x);	// 좌표값 할당
	});
}
var google_addrSearch = function( search_addr ){	// 구글 지도 api 주소 검색 결과
	$.post('../member/views/_ajax/post_search.php', { mode:'google_map_search', search_addr:search_addr }, function(result){
		point = result.split('/');
		$('#mb_latlng').val(point[0]+","+point[1]);
		map_api.map_point = [point[0],point[1],'18'];
		map_api.map_use("mapContainer", "", true);
		map_api.click_event();
		map_api.addMark();
	});
}
var email_sel = function( vals ){	// 이메일 서비스 선택
	var sel = vals.value;
	$('#mb_email_tail').val(sel);
}
var memberFrm_submit = function(){
	$('#companyFrm').submit();
}

// 신주소 (도로명 주소)
var new_addresses = function( vals ){
	var sel = vals.value;
	$('.addresWrap').hide();
	if(sel==1){
		$('#new_address_block').show();

		$('#new_mb_zipcode0').attr('required');
		$('#new_mb_zipcode1').attr('required');
		$('#mb_zipcode0').removeAttr('required');
		$('#mb_zipcode1').removeAttr('required');
		$('#new_mb_address0').attr('required');
		$('#new_mb_address1').attr('required');
		$('#mb_address0').removeAttr('required');
		$('#mb_address1').removeAttr('required');
	} else {
		$('#old_address_block').show();

		$('#new_mb_zipcode0').removeAttr('required');
		$('#new_mb_zipcode1').removeAttr('required');
		$('#mb_zipcode0').attr('required');
		$('#mb_zipcode1').attr('required');
		$('#new_mb_address0').removeAttr('required');
		$('#new_mb_address1').removeAttr('required');
		$('#mb_address0').attr('required');
		$('#mb_address1').attr('required');
	}

}
var new_addPost = function( zipcode, sido, sigungu, upmyon, road_name, bdno_M, mass_delevery, law_dong_name, ri, jibun_M  ){	// 도로명 우편번호 적용

	//alert(zipcode+"\n\n"+sido+"\n\n"+sigungu+"\n\n"+upmyon+"\n\n"+road_name+"\n\n"+bdno_M+"\n\n"+mass_delevery+"\n\n"+law_dong_name+"\n\n"+ri+"\n\n"+jibun_M);

	// 우편번호
	var zipcodes = zipcode.split('-');
	$('#new_mb_zipcode0').val(zipcodes[0]);
	$('#new_mb_zipcode1').val(zipcodes[1]);

	// 기본주소
	var add_address = sido + " ";
	add_address += sigungu + " ";
	add_address += (upmyon) ? upmyon + " " : "";
	add_address += road_name + " ";
	add_address += bdno_M + " ";
	add_address += (mass_delevery) ? mass_delevery : "";

	var add_address1 = (law_dong_name) ? law_dong_name + " " : "";
	add_address1 += (ri) ? ri + " " : "";
	add_address1 += (jibun_M) ? jibun_M : "";

	$('#new_mb_address0').val( add_address + "("+add_address1+")");
	$('#new_postSearchPop').hide();
	$('#new_mb_address1').focus();

}

var photo_options = "";
var update_photos = function( mode, no, company_no ){	// 회사이미지 등록/삭제
	if(mode=='update'){	// 등록
		$('#companyPhotoPop').show();
		$('#mb_photos').val(no);
		$('#companyPhotoPop').draggable({
			handle: '#companyPhotoPop_handle'
		});
		$('.closeBtn').click(function(){
			$('#companyPhotoPop').hide();
		});
		photo_options = { target : '#photo_'+no, beforeSubmit : photoRequest, success : photoResponse }
	} else if(mode=='delete'){	// 삭제
		if(confirm('회사이미지를 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
			$.post('../member/process/regist.php', { mode:'photo_delete', mb_id:mb_id, photo_no:no, company_no:company_no }, function(result){
				$('#photo_'+no).html("<img src=\""+result+"\" width=\"155\" height=\"100\" alt=\"photo\">");
			});
		}
	}
}
var photos_submit = function(){	// 회사이미지 등록하기 버튼 클릭시
	var photo_file = $('#photo_files').val();
	if(!photo_file || photo_file==''){
		alert("회사이미지를 첨부해 주세요.");
		return;
	}
	$('#company_mode').val('photo_upload');	// mode 변경
	$('#companyFrm').ajaxSubmit(photo_options);
}

var photoRequest = function(formData, jqForm, photo_options){	 // 회사이미지 전송 전
	return true;
}
var photoResponse = function(responseText, statusText, xhr, $form){	// 회사이미지 전송 후
	$('#company_mode').val(insert_mode);	// mode 변경
	var mb_photos = $('#mb_photos').val();
	$('#photo_'+mb_photos).html("<img src=\""+responseText+"\" width=\"155\" height=\"100\" alt=\"photo\">");
	$('#companyPhotoPop').hide();
	$('#photos_'+mb_photos).val(responseText);
}

var logo_pop = function(){	// 로고 등록창 띄우기
	$('#LogoPop').show();
}
var logo_close = function(){	// 로고 등록창 닫기
	$('#LogoPop').hide();
}

var company_delete = function( no ){
	if(confirm('기업정보를 삭제하시겠습니까?')){
		$.post('./process/company.php', { mode:'company_delete', no:no }, function(result){
			if(result){
				location.reload();
			} else {
				alert("기업정보 삭제중 오류가 발생했습니다.");
			}
		});
	}
}
var company_sel_delete = function(){
	var sel_length = $("input[name='no[]']:checked").length;
	if(!sel_length){
		alert("삭제할 기업정보를 1개 이상 선택해 주세요.");
		return false;
	}
	if(confirm('선택하신 기업정보 ' + sel_length + '건을 삭제하시겠습니까?')){
		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});

		$.post('./process/company.php', { mode:'company_sel_delete', no:del_no }, function(result){
			if(result){
				location.reload();
			} else {
				alert("기업정보 삭제중 오류가 발생했습니다.");
			}
		});

	}
}
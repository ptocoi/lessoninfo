$(function(){

});

var area_sel_first = function( vals, target ){	// 첫번째 지역값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('./views/_load/alba.php', { mode:'second_area', type:'area', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}

var job_type_sel_first = function( vals, target ){	// 첫번째 직종값 선택
	var sel = vals.value;	
	$('#'+target+'_display').load('./views/_load/alba.php', { mode:'second_job_type', type:'job_type', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}

var map_search = function(){	// 지도 검색

	// 지역
	var wr_area = new Array();

	var wr_area_0 = $('#wr_area_0 :selected').val();
	var wr_area_1 = $('#wr_area_1 :selected').val();
	var wr_area_2 = $('#wr_area_2 :selected').val();

	// 배열로 생성
	if(wr_area_0 || wr_area_1 || wr_area_2){

		if(wr_area_0){
			wr_area.push( wr_area_0 );
		} else {
			alert('최소한 시·도 는 선택해 주셔야 검색 가능합니다.');
			$('#wr_area_0').focus();
			return false;
		}
		if(wr_area_1){
			wr_area.push( wr_area_1 );
		}
		if(wr_area_2){
			wr_area.push( wr_area_2 );
		}

	} else {

		alert('지역검색값을 선택해 주세요.');
		$('#wr_area_0').focus();
		return false;

	}

	// 직종
	var wr_type = new Array();

	var wr_type_0 = $('#wr_job_type_0 :selected').val();
	var wr_type_1 = $('#wr_job_type_1 :selected').val();
	var wr_type_2 = $('#wr_job_type_2 :selected').val();

	// 배열로 생성
	if(wr_type_0 || wr_type_1 || wr_type_2){

		if(wr_type_0){
			wr_type.push(wr_type_0);
		}
		if(wr_type_1){
			wr_type.push(wr_type_1);
		}
		if(wr_type_2){
			wr_type.push(wr_type_2);
		}
	}

	addArea_position( wr_area, wr_type );

}

var addArea_position = function( wr_area, wr_type ){

	// 지역 검색
	var search_area = "";

	if(wr_area[0]){
		search_area += wr_area[0];
	}
	if(wr_area[1]){
		search_area += "/" + wr_area[1];
	}
	if(wr_area[2]){
		search_area += "/" + wr_area[2];
	}

	// 직종 검색
	var search_type = "";
	if(wr_type[0]){
		search_type += wr_type[0];
	}
	if(wr_type[1]){
		search_type += "/" + wr_type[1];
	}
	if(wr_type[2]){
		search_type += "/" + wr_type[2];
	}
	
	// 01. 알바 DB 지역, 직종 검색
	$.post('./views/_load/alba.php', { mode:'map_search', area:search_area, job_type:search_type }, function(result){
		
		var data = eval("(" + result + ")");

		// 01. 모든 마커 없애기
		map_api.marker_false();

		switch(use_map){

			case 'daum': // 다음

				// 02. 기본 위치, 줌
				daum_addrSearch( data.result.area );

				// 03. 마커 표시
				if(data){
					var i = 0;
					$.each(data.result, function(key, list){
						var data_no = list.data_no;

						if(data_no){

							var x = list.x;
							var y = list.y;

							map_api.mapapi_point_is = [x, y];
							map_api.search_func_map_child(i,data_no, '../images/icon/map_blue_point.png', 22, 25);

						}

					i++;
					});
				}

			break;

			case 'naver':	// 네이버

				// 02. 기본 위치, 줌
				naver_addrSearch( data.result.area );

				// 03. 마커 표시
				if(data){
					var i = 0;
					$.each(data.result, function(key, list){
						var data_no = list.data_no;

						if(data_no){

							var x = list.x;
							var y = list.y;

							map_api.mapapi_point_is = [x, y];
							map_api.search_func_map_child(i,data_no, '../images/icon/map_blue_point.png', 22, 25);

						}

					i++;
					});
				}

			break;

			case 'google':	 // 구글

				// 02. 기본 위치, 줌
				google_addrSearch( data.result.area );

				// 03. 마커 표시
				if(data){
					var i = 0;
					$.each(data.result, function(key, list){
						var data_no = list.data_no;

						if(data_no){

							var x = list.x;
							var y = list.y;

							map_api.mapapi_point_is = [x, y];
							map_api.search_func_map_child(i,data_no, '../images/icon/map_blue_point.png', 22, 25);

						}

					i++;
					});
				}

			break;
		}


	});

}
var daum_addrSearch = function( search_addr ){	// 다음 지도 api 주소 검색
	var s = document.createElement('script');
	s.type ='text/javascript';
	s.charset ='utf-8';
	s.src = 'http://apis.daum.net/local/geo/addr2coord?apikey=' + daum_local_APIKEY + '&callback=daumSearchResult&q=' + encodeURI(search_addr) + '&output=json';
	document.getElementsByTagName('head')[0].appendChild(s);
}
var daumSearchResult = function( result ){	// 다음 지도 api 주소 검색 결과 (callback)
	var point_y = "";
	var point_x = "";
	var i = 0;
	$.each(result.channel.item, function(key, lists){
		if(i==0){
			point_y = lists.lat;
			point_x = lists.lng;
		}
	i++;
	});
	map_api.map_location_move(point_y, point_x, 5);
}
var naver_addrSearch = function( search_addr ){	 // 네이버 지도 api 주소 검색 결과
	$.post('./views/_ajax/area_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){		
		var data = eval("(" + result + ")");
		var point_y = data.mapy;
		var point_x = data.mapx;
		map_api.map_location_move(point_x,point_y,9);
	});
}
var google_addrSearch = function( search_addr ){	// 구글 지도 api 주소 검색 결과
	$.post('./views/_ajax/area_search.php', { mode:'google_map_search', search_addr:search_addr }, function(result){
		point = result.split('/');
		var point_x = point[0];
		var point_y = point[1];
		var loc = new google.maps.LatLng( point_x, point_y );
		map_api.map.setCenter(loc);
		map_api.map.setZoom(15);
	});
}

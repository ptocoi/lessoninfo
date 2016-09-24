$(function(){
	$('.closeBtn, .close').click(function(){	// 우편번호 검색창 닫기
		$('#postSearchPop').hide();
	});
	$('#postSearchPop').draggable({	 // 우편번호 검색창 드래그
		handle: '#postSearchPop_handle'
	});
	$('#postSearchKeyword').keydown(function(event){	// 우편번호 검색창 엔터키 이벤트
		if(event.keyCode==13){	
			postSearchs();
			return false;
		}
	});
});
var postSearchPops = function(){	// 우편번호 검색창 띄우기
	$('#postSearchPop').show();
	$('#postSearchKeyword').focus();
}
var postSearchs = function(){
	var keyword = $('#postSearchKeyword').val();
	if(!keyword || keyword==''){
		alert("동명을 입력해 주세요.");
		$('#postSearchKeyword').focus();
		return false;
	} else {
		$.post('../member/views/_ajax/post_search.php', { mode:'individual', keyword:keyword }, function(result){
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
					$('#post_List').append("<tr valign='top'><td>"+lists.ZIPCODE+"</td><td class=\"address_list brend\"><a href=\"javascript:addPost('"+lists.ZIPCODE+"','"+sido+"','"+gugun+"','"+dong+"','"+ri+"','"+bunji+"', '"+bldg_name+"');\">"+lists.ADDRESS+"</a></td></tr>");
				});
			} else {
				$('#post_List').html("<tr><td colspan=\"2\" style=\"text-align:center;height:165px;\">검색 결과가 없습니다.</td></tr>");
			}
		});
	}
}
var addPost = function( zipcode, sido, gugun, dong, ri, bunji, bldg ){	// 우편번호 적용
	// 우편번호
	var zipcodes = zipcode.split('-');
	$('#wr_zipcode0').val(zipcodes[0]);
	$('#wr_zipcode1').val(zipcodes[1]);
	// 기본주소
	ris = (ri) ? ' ' + ri : '';	// 리가 없는 경우 공백이 들어올수 없다
	bunjis = (bunji) ? ' ' + bunji : '';	// 번지가 없는 경우 공백이 들어올수 없다
	$('#wr_address0').val(sido+' '+gugun+' '+dong+ris+bunjis+' '+bldg);
	$('#postSearchPop').hide();
	$('#wr_address1').focus();
}
var email_sel = function( vals ){	// 이메일 서비스 선택
	var sel = vals.value;
	$('#wr_email_tail').val(sel);
}

var taxFrmSubmit = function(){
	var options = { beforeSubmit: showRequest, success : showResponse };
	$('#taxFrm').ajaxSubmit(options);
}

var showRequest = function(formData, jqForm, options){
	var queryString = $.param(formData); 
	var taxFrm = document.getElementById('taxFrm');
	return validate(taxFrm);
}

var showResponse = function(responseText, statusText, xhr, $form){

	var wr_type = $('#wr_type').val();
	var responseMsg = (wr_type=='individual') ? "현금영수증" : "세금계산서";
	if(responseText){
		alert( responseMsg + " 신청이 완료 되었습니다." );
		location.reload();
	} else {
		alert( responseMsg + " 신청중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요." );
	}

}
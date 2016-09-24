$(function(){
	
});

var list_rows = function( vals ){	// 출력건수
	var sel = vals.value;
	location.href = "./favorite_company.php?type="+type+"&page_rows=" + sel;
}

var sel_favorite = function(){	// 관심기업 설정
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('관심기업으로 등록할 회사정보를 선택해 주세요.');
		return false;
	} else {
		var sel_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			sel_no[i] = $(this).val();
		i++;
		});
		if(confirm('선택하신 회사정보 '+chk_length+'건을 관심기업으로 등록 하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_favorite', no:sel_no, wr_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("관심기업 등록 중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}
}

var sel_delete = function(){	// 관심기업 삭제
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('삭제할 관심기업 회사정보를 선택해 주세요.');
		return false;
	} else {
		var sel_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			sel_no[i] = $(this).val();
		i++;
		});
		if(confirm('선택하신 회사정보 '+chk_length+'건을 관심기업에서 삭제 하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_favorite_delete', no:sel_no, wr_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("관심기업 삭제 중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}
}

var FavoriteSearchFrmSubmit = function(){

	$('#FavoriteSearchFrm').submit();

}

var is_left = function(){
	alert("탈퇴한 기업 회원 입니다.");
}
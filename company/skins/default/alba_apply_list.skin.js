$(function(){

});

var list_sort = function( vals){	// 공고선택
	var sel = vals.value;

	if(type=='finish'){
		var types = "?type=" + type + "&sel_alba=" + sel;
	} else {
		var types = "?sel_alba=" + sel;
	}
	
	location.href = "./alba_apply_list.php" + types;
}

var is_forms = function(){	// 자사양식 지원 이력서
	alert("이메일 자사 양식으로 지원한 회원 입니다.");
	return;
}

var sel_delete = function(){	// 선택 삭제

	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){

		alert('삭제 할 지원정보를 선택해 주세요.');
		return false;

	} else {

		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});

		if(confirm('선택하신 지원정보를 삭제하시겠습니까?')){

			$.post('./process/alba.php', { mode:'delete_receive', no:del_no }, function(result){
				if(result){
					location.reload();
				} else {
					alert("삭제중 오류가 발생하였습니다.");
				}
			});

		}

	}

}
var is_cancel = function(){
	alert("지원 취소된 이력서 입니다.\n\n해당 이력서로 지원한 개인회원이 지원취소 하여 내용 확인이 불가능 합니다.");
}
var is_delete = function(){
	alert("삭제된 이력서 입니다\n\n해당 이력서를 작성한 개인회원이 삭제하여 상세 내용 확인이 불가능 합니다.");
}
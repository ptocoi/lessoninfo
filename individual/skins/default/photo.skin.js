$(function(){

	$('#profilePhotoPop').draggable({	 // 프로필 등록창 드래그
		handle: '#schoolSearchPop_handle'
	});
	$('#profilePhotoPop_close').click(function(){	// 프로필 등록창 닫기
		$('#profilePhotoPop').hide();
	});

});

var profile_photo_pop = function(){	 // 프로필 사진 등록창 띄우기
	$('#profilePhotoPop').show();
}
var profile_photo_remove = function(){	// 기존 프로필 사진 삭제
	var mb_photos = $('#personphoto').attr('src').split('/');
	var mb_photo = mb_photos[4];
	if(confirm('프로필 사진을 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
		$.post('../member/process/regist.php', { mode:'profile_photo_remove', mb_id:mb_id }, function(result){
			$('#personphoto').attr('src',result);
			$('#personphoto_status').html('등록');
			$('#photo_remove').hide();
		});
	}
}
var photo_submit = function(){
	var photo_file = $('#photo_file').val();
	if(!photo_file || photo_file==''){
		alert("프로필 사진을 첨부해 주세요.");
		return;
	}
	var photo_options = { beforeSubmit : photoRequest, success : photoResponse }
	$('#MemberUpdateFrm').ajaxSubmit(photo_options);
}
var photoRequest = function(formData, jqForm, photo_options){	 // 프로필 사진 전송 전
	//var queryString = $.param(formData);
	return true;
}
var photoResponse = function(responseText, statusText, xhr, $form){	// 프로필 사진 전송 후
	$('#personphoto').attr('src',responseText);
	$('#profilePhotoPop').hide();
	$('#photo_remove').show();
}

var update_photos = function( mode, no ){	// 포토앨범 등록/삭제
	if(mode=='update'){	// 등록
		$('#individualPhotoPop').show();
		$('#mb_photos').val(no);
		$('#individualPhotoPop').draggable({
			handle: 'individualPhotoPop_handle'
		});
		$('.closeBtn').click(function(){
			$('#individualPhotoPop').hide();
		});
	} else if(mode=='delete'){	// 삭제
		if(confirm('포토앨범 사진을 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
			$.post('../member/process/regist.php', { mode:'photo_deletes', mb_id:mb_id, photo_no:no }, function(result){
				//$('#photo_'+no).html("<img src=\""+result+"\" width=\"155\" height=\"100\" alt=\"photo\">");
				$('#mb_photo_'+no).attr('src',result);
			});
		}
	}

}
var photos_submit = function(){	// 회사이미지 등록하기 버튼 클릭시
	var photo_files = $('#photo_files').val();
	if(!photo_files || photo_files==''){
		alert("등록할 사진을 첨부해 주세요.");
		return;
	}
	var photos_options = { beforeSubmit : photosRequest, success : photosResponse }
	$('#AlbaResumeFrm').attr('action','../member/process/regist.php');	// action 변경
	$('#AlbaResumeFrm #mode').val('photo_uploads');	// mode 변경
	$('#AlbaResumeFrm').ajaxSubmit(photos_options);
}

var photosRequest = function(formData, jqForm, photos_options){	 // 포토앨범 전송 전
	return true;
}
var photosResponse = function(responseText, statusText, xhr, $form){	// 포토앨범 전송 후
	$('#AlbaResumeFrm').attr('action','../individual/process/alba_resume.php');	// action 변경
	$('#AlbaResumeFrm #mode').val('insert');	// mode 변경
	var mb_photos = $('#mb_photos').val();
	$('#mb_photo_'+mb_photos).attr('src',responseText);
	$('#individualPhotoPop').hide();
}
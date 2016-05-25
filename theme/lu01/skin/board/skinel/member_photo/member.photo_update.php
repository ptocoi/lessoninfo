<?
include_once("./_common.php");

if($is_guest) {
	alert('로그인 후 사용하세요');
	exit;
}

if(!$bo_table) {
	alert('정상적인 접근이 아닙니다');
	exit;
}

include_once '../inc.skinL.php';

$mb_id = $member['mb_id'];
$mb_dir = substr($mb_id,0,2);

$img_path = G5_DATA_PATH."/member_image";
$photo_path = $img_path."/".$mb_dir; //폴더경로
$photo_file = $photo_path."/".$member['mb_id']; //이미지경로

if (!file_exists($img_path)){
	@mkdir($img_path, 0707);
	@chmod($img_path, 0707);
}
if (!file_exists($photo_path)){
	@mkdir($photo_path, 0707);
	@chmod($photo_path, 0707);
}

// 회원 이미지 삭제
if ($member_photo_del){
	@unlink($photo_file);
} else{
	if (!$_FILES['member_photo']['tmp_name']) //이미지 삭제가 아닌경우 업로드 파일체크
		alert('파일을 선택하세요');
}

// 이미지 업로드
if (is_uploaded_file($_FILES['member_photo']['tmp_name'])) {
	if (!preg_match("/(\.gif)$/i", $_FILES['member_photo']['name'])) {
		alert($_FILES['member_photo']['name'] . '은(는) gif 파일이 아닙니다.');
	}
	
	if (preg_match("/(\.gif)$/i", $_FILES['member_photo']['name'])) {
		move_uploaded_file($_FILES['member_photo']['tmp_name'], $photo_file);
		chmod($photo_file, 0606);
		
		if (file_exists($photo_file)){
			$size = getimagesize($photo_file);
			
			// 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
			if ($size[0] > 60 || $size[1] > 60) {
				@unlink($photo_file);
				alert($_FILES['member_photo']['name'] . '은(는) 기로나 세로크기가 60px보다 큽니다.');
			}
		}
	}
}
goto_url($board_skin_url."/member_photo/member.photo.php?bo_table=".$bo_table);
?>

<?
include_once("./_common.php");

if (!$is_member) exit;

include_once '../inc.skinL.php';

$g5['title'] = "회원사진변경";
include_once(G5_PATH."/head.sub.php");

if($is_guest) {
	alert('로그인 후 사용하세요');
	exit;
}

if(!$bo_table) {
	alert('정상적인 접근이 아닙니다');
	exit;
}

$mb_id = $member['mb_id'];
$mb_dir = substr($mb_id,0,2);

$img_path = G5_DATA_PATH."/member_image";
$photo_path = $img_path."/".$mb_dir; //폴더경로
$photo_file = $photo_path."/".$member['mb_id']; //이미지경로

$img_url = G5_DATA_URL."/member_image";
$photo_url = $img_url ."/".$mb_dir; //폴더경로
$photo_url = $photo_url."/".$member['mb_id']; //이미지경로

if (!file_exists($img_path)){
	@mkdir($img_path, 0707);
	@chmod($img_path, 0707);
}
if (!file_exists($photo_path)){
	@mkdir($photo_path, 0707);
	@chmod($photo_path, 0707);
}
?>
<style>
.member_photo{position:relative;padding:10px;font-size:10pt; }
.member_photo h3{margin-bottom:5px;padding:3px;border-bottom:2px solid #444;}
.img {position:absolute;text-align:center;}
.img img{padding:2px;border:1px solid #e0e0e0;}
.mp_content{margin-left:80px; }
.mp_foot{margin:10px auto;padding-top:10px;border-top:1px solid #888;text-align:center;}
.mp_btn{display:inline-block;padding:5px 10px;border:0;background-color:#333;color:#fff;}
</style>
<div class="member_photo">

	<h3>회원사진 변경</h3>

	<form name="mphoto" method="post" onsubmit="return mphoto_submit(this);" enctype="multipart/form-data">
	<input type="hidden" name="bo_table" value="<?=$bo_table?>"/>
	<div class="img">
		<?
		if (file_exists($photo_file)) {
			echo "<img src='".$photo_url."'  width='58' height='58'>";
			echo "<br/><input type=\"checkbox\" name=\"member_photo_del\" id=\"member_photo_del\" value=\"1\"> <label for=\"member_photo_del\">삭제</label>";
		} else {
			echo "<img src='{$board_skin_url}/img/no_photo.gif' width='58' height='58'></span>";
		} 
		?>		
	</div>

	<div class="mp_content">
		<div>
      <p>
        이미지 크기는 가로60px 세로60px 로 업로드해 주세요.<br/>
        확장자는gif만 가능합니다.
      </p>
			<input type="file" name="member_photo" />
      <br/><br/>
		</div>
	</div>

	<div class="mp_foot">
		<input type="submit" value="등록" class="mp_btn" onfocus="this.blur();" />
		<input type="button" value="취소" class="mp_btn" onclick="window.close()" />
	</div>

	</form>

</div>
<script type="text/javascript">
function mphoto_submit(f)
{
	f.action = '<?=$board_skin_url?>/member_photo/member.photo_update.php';
	return true;
}
</script>
<?
include_once(G5_PATH."/tail.sub.php");
?>
